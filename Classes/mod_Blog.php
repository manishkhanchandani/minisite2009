<?php
class mod_Blog {
	
	private $cacheSecs = CACHETIME;
	private static $instance;
	
	public function __construct($dbFrameWork, $Common) {
		if(self::$instance) {
			return self::$instance;
		} else {
			self::$instance = $this;
			$this->dbFrameWork = $dbFrameWork;
			$this->Common = $Common;
		}
	}
	public function viewHomePage($ID, $data, $settings) {
		$sql = "select * from blog WHERE id = '".$ID."' ORDER BY blog_id DESC LIMIT 5";
		$result = $this->Common->selectCacheRecord($sql);
		if($result) {
			foreach($result as $k=>$v) {
				$ret[$k]['created'] = $v['created'];
				$ret[$k]['id'] = $v['blog_id'];
				$ret[$k]['title'] = $v['title'];
				$desc = substr($v['description'],0,50);
				if($desc) {
					$ret[$k]['description'] = $desc." ...";
				}	
				$ret[$k]['link'] = HTTPPATH."/index.php?p=blog&action=detail&blog_id=".$v['blog_id']."&ID=".$ID;			
			}
		}
		return $ret;
	}
	public function validateNewBlog($post, $setting) {
		if(!trim($post['title'])) {
			throw new Exception('please insert title. ');
		}
		if(!trim($post['description']) || strlen(trim($post['description']))<50) {
			throw new Exception('please insert description. description should be atleast 50 characters.');
		}
		if(!trim($post['tags'])) {
			throw new Exception('please insert tags. ');
		}
		if($setting == 4) {			
			if($post['category_id']==0) {
				throw new Exception('please select category. ');
			}
		}
		if($setting == 5) {			
			if($post['category_id'][0]==0 && count($post['category_id']) < 2) {
				throw new Exception('please select category. ');
			}
		}
	}
	public $catLink=array();
	public $catLinkChild=array();
	
	public function categoryParentLink($ID, $catId) {
		if(!$this->catLink) $this->catLink = array();
		$sql = "select * from blog_categories where category_id = '".$catId."' and id = '".$ID."'";
		$rs = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		if($rs->RecordCount()>0) {
			$rec = $rs->FetchRow();
			$catId = $rec['category_id'];
			$pid = $rec['parent_id'];
			$category = '<a href="'.HTTPPATH.'/index.php?p=blog&action=view&ID='.$ID.'&catId='.$catId.'">'.$rec['category'].'</a>';
			array_unshift($this->catLink,$category);
			$this->categoryParentLink($ID, $pid);	
		} else {
			//$this->catLinkDisplay = '<a href="'.HTTPPATH.'/index.php?p=blog&action=view&ID='.$ID.'">Home</a> >> ';
			if($this->catLink) {
				foreach($this->catLink as $value) {
					$this->catLinkDisplay .= $value.' >> ';
				}
				$this->catLinkDisplay = substr($this->catLinkDisplay,0,-4);
			}
		}
	}
	
	public $tree;					// Clear the directory tree
	public $depth;					// Child level depth.
	public $top_level_on;			// What top-level category are we on?
	public $exclude = array();			// Define the exclusion array
	
	public function tree($ID, $CatId) {
		$this->tree = "";					
		$this->depth = 1;					
		$this->top_level_on = 1;			
		$this->exclude = array(0);	
		$this->tempTree = '';		
		$sql = "select * from blog_categories where id = '".$ID."' and parent_id = '".$CatId."'";
		$nav_query = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while($nav_row = $nav_query->FetchRow()) {
			$goOn = 1;			// Resets variable to allow us to continue building out the tree.
			for($x = 0; $x < count($this->exclude); $x++)		// Check to see if the new item has been used
			{
				if ( $this->exclude[$x] == $nav_row['category_id'] )
				{
					$goOn = 0;
					break;	// Stop looking b/c we already found that it's in the exclusion list and we can't continue to process this node
				}
			}
			if ( $goOn == 1 )
			{
				$this->tree .= "<li class=\"lilinks\"><a href=\"".HTTPPATH."/index.php?p=blog&action=view&ID=".$ID."&catId=".$nav_row['category_id']."\" class=\"alinks\">".$nav_row['category'] . "</a></li>";				// Process the main tree node
				array_push($this->exclude, $nav_row['category_id']);		// Add to the exclusion list
				$this->tree .= $this->build_child($nav_row['category_id'], $ID);		// Start the recursive function of building the child tree
			}
		}
	}
	public function build_child($oldID, $ID)			// Recursive function to get all of the children...unlimited depth
	{			
		$sql = "SELECT * FROM `blog_categories` WHERE parent_id='" . $oldID . "'";		
		$child_query = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}		
		while ($child = $child_query->FetchRow())
		{
			if ( $child['category_id'] != $child['parent_id'] )
			{
				$tempTree .= "<li class=\"lilinks\"><a href=\"".HTTPPATH."/index.php?p=blog&action=view&ID=".$ID."&catId=".$child['category_id']."\" class=\"alinks\">";
				for ( $c=0;$c<$this->depth;$c++ )			// Indent over so that there is distinction between levels
				{ 
					$tempTree .= "&nbsp;&nbsp;&nbsp;&nbsp;"; 
				}
				$tempTree .= "- " . $child['category'] . "</a></li>";
				$this->depth++;		// Incriment depth b/c we're building this child's child tree  (complicated yet???)
				$tempTree .= $this->build_child($child['category_id'], $ID);		// Add to the temporary local tree
				$this->depth--;		// Decrement depth b/c we're done building the child's child tree.
				array_push($this->exclude, $child['category_id']);			// Add the item to the exclusion list
			}
		}
	 
		return $tempTree;
	}	
	
	public $treeSelectBox;					// Clear the directory tree
	public $depthSelectBox;					// Child level depth.
	public $excludeSelectBox = array();			// Define the exclusion array
	public $selectedSelectBox = array();			// Define the exclusion array
	
	public function treeSelectBox($ID, $CatId) {
		$this->treeSelectBox = "";					
		$this->depthSelectBox = 1;		
		$this->excludeSelectBox = array(0);	
		
		$sql = "select * from blog_categories where id = '".$ID."' and parent_id = '".$CatId."'";			
		$nav_query = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}		
		while ($nav_row = $nav_query->FetchRow()) {
			$goOn = 1;			// Resets variable to allow us to continue building out the tree.
			for($x = 0; $x < count($this->excludeSelectBox); $x++)		// Check to see if the new item has been used
			{
				if ( $this->excludeSelectBox[$x] == $nav_row['category_id'] )
				{
					$goOn = 0;
					break;	// Stop looking b/c we already found that it's in the exclusion list and we can't continue to process this node
				}
			}
			if ( $goOn == 1 )
			{
				$this->treeSelectBox .= "<option value='".$nav_row['category_id']."'";
				if(in_array($nav_row['category_id'], $this->selectedSelectBox)) {
					$this->treeSelectBox .= " selected";
				}
				$this->treeSelectBox .= ">".$nav_row['category'] . "</option>";				// Process the main tree node
				array_push($this->excludeSelectBox, $nav_row['category_id']);		// Add to the exclusion list
				$this->treeSelectBox .= $this->build_childSelectBox($nav_row['category_id']);		// Start the recursive function of building the child tree
			}
		}
	}
	public function build_childSelectBox($oldID)			// Recursive function to get all of the children...unlimited depth
	{			
		$sql = "SELECT * FROM `blog_categories` WHERE parent_id='" . $oldID . "'";
		$child_query = $this->dbFrameWork->Execute($sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}		
		while ($child = $child_query->FetchRow())
		{
			if ( $child['category_id'] != $child['parent_id'] )
			{
				$tempTree .= "<option value='".$child['category_id']."'";
				if(in_array($child['category_id'], $this->selectedSelectBox)) {
					$tempTree .= " selected";
				}
				$tempTree .= ">";
				for ( $c=0;$c<$this->depthSelectBox;$c++ )			// Indent over so that there is distinction between levels
				{ 
					$tempTree .= "&nbsp;&nbsp;&nbsp;&nbsp;"; 
				}
				$tempTree .= "- " . $child['category'] . "</option>";
				$this->depthSelectBox++;		// Incriment depth b/c we're building this child's child tree  (complicated yet???)
				$tempTree .= $this->build_childSelectBox($child['category_id']);		// Add to the temporary local tree
				$this->depthSelectBox--;		// Decrement depth b/c we're done building the child's child tree.
				array_push($this->excludeSelectBox, $child['category_id']);			// Add the item to the exclusion list
			}
		}
	 
		return $tempTree;
	}
	
	public function insertCategory($sql) {
		$this->dbFrameWork->Execute($sql); 
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->db->ErrorMsg());
		}
		return true;
	}
	
	public function insertTags($tags, $id, $blog_id) {
		if($tags) {
			foreach($tags as $tag) {				
				// insert into tags
				$sql = "select * from tags where tagname = ".$this->dbFrameWork->qstr(trim($tag),get_magic_quotes_gpc());
				$rs = $this->dbFrameWork->Execute($sql);
				if($this->dbFrameWork->ErrorMsg()) {
					throw new Exception($this->db->ErrorMsg());
				}
				if($rs->RecordCount()>0) {
					$arr = $rs->FetchRow();
					$tid = $arr['tag_id'];
				} else {
					$insertSQL = "insert into tags set tagname = ".$this->dbFrameWork->qstr(trim($tag),get_magic_quotes_gpc());
					$this->dbFrameWork->Execute($insertSQL); 
					if($this->dbFrameWork->ErrorMsg()) {
						throw new Exception($this->dbFrameWork->ErrorMsg());
					}
					$tid = $this->dbFrameWork->Insert_ID();
				}
				// insert into blog
				$sql1 .= "('".$blog_id."', '".$id."', '".$tid."'), ";
			}
			if($sql1) {
				$sql1 = substr($sql1, 0, -2);
				$sql1 = "insert into blog_tags (blog_id, id, tag_id) VALUES ".$sql1;
				$this->dbFrameWork->Execute($sql1); 
				if($this->dbFrameWork->ErrorMsg()) {
					throw new Exception($this->dbFrameWork->ErrorMsg());
				}
			}
		}		
	}
}
?>