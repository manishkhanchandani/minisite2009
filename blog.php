<?php
try {
	$result = $Common->getConceptSettings('blog', $ID);				
	$smarty->assign('result', $result);
	if(!$result['concepts']) {	
		unset($_GET['action']);
		throw new Exception("Blog Concept does not exist for this id. ");
	}
	
	$mod_Blog = new mod_Blog($dbFrameWork, $Common);				
	$smarty->assign('action', $_GET['action']);				
	if($result['settings']) {
		foreach($result['settings'] as $k => $v) {
			$rSettings = $v;
		}
		$smarty->assign('rSettings', $rSettings);
	}
	if($rSettings['setting_value'] == 'single' || $rSettings['setting_value'] == 'multi'){
		// getting category list
		$mod_Blog->tree($ID, 0);
		$category = $mod_Blog->tree;
		$smarty->assign('category', $category);
	}
	switch($_GET['action']) {
		case 'new':
			// defining page heading and page title
			$PAGEHEADING = "Add New Blog";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			if($rSettings['setting_value'] == 'single' || $rSettings['setting_value'] == 'multi'){
				// get Categories
				$mod_Blog->treeSelectBox($ID, 0);
				$categorySelBox = "<option value='0' selected>Select Category</option>";
				$categorySelBox .= $mod_Blog->treeSelectBox;
				$smarty->assign('categorySelBox', $categorySelBox);	
			}
			
			if($_POST['MM_Insert']=="new") {							
				if(!$_SESSION['user_id']) {
					throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
				}
				// validate the fields
				$mod_Blog->validateNewBlog($_POST, $rSettings['setting_id']);
				// insert in db
				$uid = $Common->phpinsert('blog', 'blog_id', $_POST);							
				// inserting categories
				if($rSettings['setting_value'] == 'single'){
					$sql = "insert into blog_cat_rel (blog_id, id, category_id) VALUES ('".$uid."', '".$ID."', '".$_POST['category_id']."')";
					$mod_Blog->insertCategory($sql);	
				}
				if($rSettings['setting_value']=='multi'){
					$sql = "insert into blog_cat_rel (blog_id, id, category_id) VALUES ";
					foreach($_POST['category_id'] as $catId) {
						if($catId==0) continue;
						$sql .= "('".$uid."', '".$ID."', '".$catId."'), ";
					}
					$sql = substr($sql, 0, -2);
					$mod_Blog->insertCategory($sql);
				}
				// insert in tags
				if($_POST['tags']) {
					$tags = explode(',',$_POST['tags']);
					$mod_Blog->insertTags($tags, $_POST['ID'], $uid);
				}
				$success = 1;
				$smarty->assign('success', $success);
			}
			// calling body
			$body = $smarty->fetch('blog/new.html');
			break;
		case 'catview':
			// defining page heading and page title
			$PAGEHEADING = "Manage Category";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			
			if($rSettings['reference']=='nocat'){
				throw new Exception("Category is not allowed in this concept.");
			}
			$catId = $_GET['catId'];
			if(!$catId) $catId = 0;			
			$smarty->assign('catId', $catId);
			
			if($rSettings['setting_value']=='multi'){
				$breadCrumb = $mod_Blog->categoryParentLink($ID, $catId);
				$smarty->assign('breadCrumb', $mod_Blog->catLinkDisplay);		
			}
			if($_POST['MM_Insert']==1) {
				if(!trim($_POST['category'])) {
					throw new Exception("Could not add category. Please fill the category field.");
				}
				$Common->phpinsert('blog_categories', 'category_id', $_POST);
			}
			$sql = "select * from blog_categories WHERE category_id = '".$catId."' and id = '".$ID."'";
			$current = $Common->selectCacheRecord($sql);
			$smarty->assign('current', $current[0]);
			$sql = "select * from blog_categories WHERE parent_id = '".$catId."' and id = '".$ID."'";
			$records = $Common->selectCacheRecord($sql);
			$smarty->assign('records', $records);	
			
			// calling body
			$body = $smarty->fetch('blog/cat.html');
			break;
		case 'edit':
			// defining page heading and page title
			$PAGEHEADING = "Edit Blog";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			break;
		case 'delete':
			// defining page heading and page title
			$PAGEHEADING = "Delete Blog";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			break;
		case 'detail':
			$sql = "select * from blog as a LEFT JOIN users as b ON a.user_id = b.user_id WHERE a.id = '".$ID."' AND a.blog_id = '".$_GET['blog_id']."'";
			$blogDetail = $Common->selectCacheRecord($sql);
			$resDetail = $blogDetail[0];
			$smarty->assign('resDetail', $resDetail);
			
			
			$sql = "select * from blog_comments as a LEFT JOIN users as b ON a.commentor = b.user_id WHERE a.blog_id = '".$_GET['blog_id']."' order by a.comment_id DESC";
			$sqlCnt = "select count(*) as cnt from blog_comments WHERE blog_id = '".$_GET['blog_id']."'";
			$max = 5;
			$page = $_GET['page'];
			if(!$page) $page = 1;
			$pageNum = $page-1;
			$start = $pageNum * $max;
			
			$comments = $Common->selectCacheLimitRecordFull($sql, $sqlCnt, $max, $start);
			$smarty->assign('comments', $comments);
			
			if($comments['totalRows']>$max) {
				// pagination
				$PaginateIt = new PaginateIt();
				$PaginateIt->SetItemCount($comments['totalRows']);
				$PaginateIt->SetItemsPerPage($max);
				$pagination = $PaginateIt->GetPageLinks_Old();
				$smarty->assign('pagination', $pagination);
			}
			$smarty->assign('comments', $comments);
			
			// defining page heading and page title
			$PAGEHEADING = "Blog Details";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			if($_POST['MM_Insert']=="addcomment") {						
				if(!$_SESSION['user_id']) {
					throw new Exception('Please <a href="'.HTTPPATH.'/index.php?p=users&action=login&ID='.$ID.'&accesscheck='.urlencode($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).'">login</a> first to continue. ');	
				}
				$postComments = $_POST['comments'];
				$smarty->assign('postComments', $postComments);
				if(!trim($_POST['comments']) || strlen(trim($_POST['comments']))<50) {
					throw new Exception("Please add comments. Comments should be greater than 50 characters.");
				}
				// insert in db
				$Common->phpinsert('blog_comments', 'comment_id', $_POST);
				$postComments = '';
				$smarty->assign('postComments', $postComments);
				
				$errorMessage = "<div class=\"error\">Comments Added Successfully. Users can view the comments in a short while.</div>";
				$smarty->assign('errorMessage', $errorMessage);
			}
			// calling body
			$body = $smarty->fetch('blog/detail.html');
			
			
			break;
		case 'view':
		default:
			// defining page heading and page title
			$PAGEHEADING = $result['keyword'][$ID]['keyword']." Blog";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			if(is_numeric($_GET['catId']) && $_GET['catId']>0) {
				$sql = "select * from blog_categories WHERE category_id = '".$_GET['catId']."'";
				$catDetail = $Common->selectCacheRecord($sql);
				$PAGEHEADING = $result['keyword'][$ID]['keyword']." Blog :: ".$catDetail[0]['category'];
				$smarty->assign('PAGEHEADING', $PAGEHEADING);
				$sql = "select * from blog as a INNER JOIN blog_cat_rel as b ON a.blog_id = b.blog_id WHERE a.id = '".$ID."' AND b.category_id = '".$_GET['catId']."' ORDER BY a.blog_id DESC";
				$sqlCnt = "select count(*) as cnt from blog as a INNER JOIN blog_cat_rel as b ON a.blog_id = b.blog_id WHERE a.id = '".$ID."' AND b.category_id = '".$_GET['catId']."'";
				
				if($rSettings['setting_value']=='multi'){
					$breadCrumb = $mod_Blog->categoryParentLink($ID, $_GET['catId']);
					$smarty->assign('breadCrumb', $mod_Blog->catLinkDisplay);		
				}			
			} else if($_GET['kw']) {
				$sql = "select * from tags WHERE tagname = '".$_GET['kw']."'";
				$tagDetail = $Common->selectCacheRecord($sql);
				if($tagDetail) {
					foreach($tagDetail as $k => $v) {
						$tagId[] = $v['tag_id'];
					}
					$tags = implode(",", $tagId);
				}
				if(!$tags) $tags = 0;
				$PAGEHEADING = $result['keyword'][$ID]['keyword']." Blog :: ".$_GET['kw'];
				$smarty->assign('PAGEHEADING', $PAGEHEADING);
				
				$sql = "select * from blog as a INNER JOIN blog_tags as b ON a.blog_id = b.blog_id WHERE a.id = '".$ID."' AND b.tag_id IN (".$tags.") ORDER BY a.blog_id DESC";
				$sqlCnt = "select count(*) as cnt from blog as a INNER JOIN blog_tags as b ON a.blog_id = b.blog_id WHERE a.id = '".$ID."' AND b.tag_id IN (".$tags.")";
			} else {
				$sql = "select * from blog WHERE id = '".$ID."' ORDER BY blog_id DESC";
				$sqlCnt = "select count(*) as cnt from blog WHERE id = '".$ID."'";
			}
			$max = 4;
			$page = $_GET['page'];
			if(!$page) $page = 1;
			$pageNum = $page-1;
			$start = $pageNum * $max;
			
			$records = $Common->selectCacheLimitRecordFull($sql, $sqlCnt, $max, $start);
			$smarty->assign('records', $records);
			
			if($records['totalRows']>$max) {
				// pagination
				$PaginateIt = new PaginateIt();
				$PaginateIt->SetItemCount($records['totalRows']);
				$PaginateIt->SetItemsPerPage($max);
				$pagination = $PaginateIt->GetPageLinks_Old();
				$smarty->assign('pagination', $pagination);
			}
			// calling body
			$body = $smarty->fetch('blog/view.html');

			break;
	}
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	switch($_GET['action']) {
		case 'new':
			$body = $smarty->fetch('blog/new.html');
			break;
		case 'detail':
			$body = $smarty->fetch('blog/detail.html');
			break;			
		case 'edit':
			$body = $smarty->fetch('blog/edit.html');
			break;
		case 'view':
			$body = $smarty->fetch('blog/view.html');
			break;
		default:
			$body = $smarty->fetch('errorMessage.html');
			break;
	}
} 
?>