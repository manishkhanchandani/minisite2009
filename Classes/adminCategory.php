<?php
include_once('../Connections/conn.php');
class adminCategory {

	public $catLink=array();
	public $catLinkChild=array();
	public $queryString;
	

	
	public function categoryParentLink($formId, $catId) {
		if(!$this->catLink) $this->catLink = array();
		$sql = "select * from categories where category_id = '".$catId."' and form_id = '".$formId."'";
		$rs = mysql_query($sql) or die('error'.__LINE__);
		$num = mysql_num_rows($rs);
		if($num>0) {
			$rec = mysql_fetch_array($rs);
			$catId = $rec['category_id'];
			$pid = $rec['parent_id'];
			$level = $rec['level'];
			$category = '<a href="'.$_SERVER['PHP_SELF'].'?form_id='.$formId.'&pid='.$catId.'&level='.$level.$this->queryString.'">'.$rec['category'].'</a>';
			array_unshift($this->catLink,$category);
			$this->categoryParentLink($formId, $pid);	
		} else {
			$this->catLinkDisplay = '<a href="'.$_SERVER['PHP_SELF'].'?form_id='.$formId.$this->queryString.'">Home</a> >> ';
			foreach($this->catLink as $value) {
				$this->catLinkDisplay .= $value.' >> ';
			}
			$this->catLinkDisplay = substr($this->catLinkDisplay,0,-4);
		}
	}
	
	public $tree;					// Clear the directory tree
	public $depth;					// Child level depth.
	public $top_level_on;			// What top-level category are we on?
	public $exclude = array();			// Define the exclusion array
	
	public function tree($formId, $CatId) {
		$this->tree = "";					
		$this->depth = 1;					
		$this->top_level_on = 1;			
		$this->exclude = array(0);	
		$this->tempTree = '';		
		$sql = "select * from categories where form_id = '".$formId."' and parent_id = '".$CatId."'";
		$nav_query = mysql_query($sql) or die('error'.__LINE__);
		while ($nav_row = mysql_fetch_array($nav_query)) {
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
				$this->tree .= $nav_row['category'] . "<br>";				// Process the main tree node
				array_push($this->exclude, $nav_row['category_id']);		// Add to the exclusion list
				$this->tree .= $this->build_child($nav_row['category_id']);		// Start the recursive function of building the child tree
			}
		}
	}
	public function build_child($oldID)			// Recursive function to get all of the children...unlimited depth
	{			
		$sql = "SELECT * FROM `categories` WHERE parent_id='" . $oldID . "'";
		$child_query = mysql_query($sql) or die('error'.__LINE__);
		while ( $child = mysql_fetch_array($child_query) )
		{
			if ( $child['category_id'] != $child['parent_id'] )
			{
				for ( $c=0;$c<$this->depth;$c++ )			// Indent over so that there is distinction between levels
				{ 
					$tempTree .= "&nbsp;&nbsp;&nbsp;&nbsp;"; 
				}
				$tempTree .= "- " . $child['category'] . "<br>";
				$this->depth++;		// Incriment depth b/c we're building this child's child tree  (complicated yet???)
				$tempTree .= $this->build_child($child['category_id']);		// Add to the temporary local tree
				$this->depth--;		// Decrement depth b/c we're done building the child's child tree.
				array_push($this->exclude, $child['category_id']);			// Add the item to the exclusion list
			}
		}
	 
		return $tempTree;
	}
	
	
	
	
	
	public $treeSelectBox;					// Clear the directory tree
	public $depthSelectBox;					// Child level depth.
	public $excludeSelectBox = array();			// Define the exclusion array
	
	public function treeSelectBox($formId, $CatId) {
		$this->treeSelectBox = "";					
		$this->depthSelectBox = 1;		
		$this->excludeSelectBox = array(0);	
		
		$sql = "select * from categories where form_id = '".$formId."' and parent_id = '".$CatId."'";
		$nav_query = mysql_query($sql) or die('error'.__LINE__);
		while ($nav_row = mysql_fetch_array($nav_query)) {
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
				$this->treeSelectBox .= "<option value='".$nav_row['category_id']."'>".$nav_row['category'] . "</option>";				// Process the main tree node
				array_push($this->excludeSelectBox, $nav_row['category_id']);		// Add to the exclusion list
				$this->treeSelectBox .= $this->build_childSelectBox($nav_row['category_id']);		// Start the recursive function of building the child tree
			}
		}
	}
	public function build_childSelectBox($oldID)			// Recursive function to get all of the children...unlimited depth
	{			
		$sql = "SELECT * FROM `categories` WHERE parent_id='" . $oldID . "'";
		$child_query = mysql_query($sql) or die('error'.__LINE__);
		while ( $child = mysql_fetch_array($child_query) )
		{
			if ( $child['category_id'] != $child['parent_id'] )
			{
				$tempTree .= "<option value='".$child['category_id']."'>";
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
	/*
	public function categoryChild($formId, $CatId) {
		if(!$this->catLinkChild) $this->catLinkChild = array();		
			
		echo $sql = "select * from category where form_id = '".$formId."' and parent_id = '".$CatId."'";
		$rs = $this->dbFrameWork->CacheExecute($this->cacheSecs, $sql);
		if($this->dbFrameWork->ErrorMsg()) {
			throw new Exception($this->dbFrameWork->ErrorMsg());
		}
		while ($arr = $rs->FetchRow()) { 
			$recAll[$arr['category_id']] = $arr;
		}
		echo $sql = "select b.* from category as a, category as b where b.pid = a.category_id and a.form_id = '".$formId."'";
		$rec = $this->selectCacheRecord($sql);
		print_r($rec);
		exit;
		if(count($rec)>0) {
			$catId = $rec[0]['category_id'];
			$pid = $rec[0]['pid'];
			$level = $rec[0]['level'];
			$category = '<a href="'.$_SERVER['PHP_SELF'].'?form_id='.$formId.'&pid='.$catId.'&level='.$level.$this->queryString.'">'.$rec[0]['category'].'</a>';
			array_unshift($this->catLinkChild,$category);
			$this->categoryParentLink($formId, $pid);	
		} else {
			$this->catLinkDisplayChild = '<a href="'.$_SERVER['PHP_SELF'].'?form_id='.$formId.$this->queryString.'">Home</a> >> ';
			foreach($this->catLinkChild as $value) {
				$this->catLinkDisplayChild .= $value.' >> ';
			}
			$this->catLinkDisplayChild = substr($this->catLinkDisplayChild,0,-4);
		}
	}
	*/
	public function deleteChildCategory($catId) {
	
	} 
	public function tree_add($tree2, $parent_id, $object, $cat_id)
	{
		// Only start from the given cat_id, ignore all other roots
	 
		if($parent_id == '0' and $object[category_id] == $cat_id)
		{
			$tree2[$object[category_id]] = $object;
			return $tree2;
		}
	 
		if($tree2)
		{
			foreach($tree2 as $key => $value)
			{
				$current = $tree2[$key];
	 
				// If this is the parent, add the object to it's children array
				if($current[category_id] == $parent_id)
				{
					$tree2[$key][children][$object[category_id]] = $object;
				}
				else
				{
					// If it's not in this level, look a level deeper on the current object.
					$tree2[$key][children] = $this->tree_add($current[children], $parent_id, $object, $cat_id);
				}
			}
		}
	 
		return $tree2;
	}
	public function call_tree_add() {
		echo "<pre>";
		$query = "
			select
				*
			from
				categories
			order by
				category_id
		";
		 
		$result = mysql_query($query);
		 
		while($category = mysql_fetch_array($result))
		{
			$children = array();
		 
			$category[children] = $children;
		 
			$cat_id = $category[category_id];
			$cat_parent_id = $category[parent_id];
		 
			$cat_tree = $this->tree_add($cat_tree, $cat_parent_id, $category, $cat_id);
		}
		 
		print_r($cat_tree);
		echo "<pre>";
	}
}
$c = new adminCategory;
$c->treeSelectBox(2, 0);
echo "<select>";
echo $c->treeSelectBox;
echo "</select>";

?>