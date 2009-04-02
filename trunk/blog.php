<?php
try {
	$result = $Common->getConceptSettings('blog', $ID);				
	$smarty->assign('result', $result);
	
	$mod_Blog = new mod_Blog($dbFrameWork, $Common);				
	$smarty->assign('action', $_GET['action']);				
	
	if($result['settings'][0]['setting_id'] == 4 || $result['settings'][0]['setting_id']==5){
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
			if($result['settings'][0]['setting_id'] == 4 || $result['settings'][0]['setting_id']==5){
				// get Categories
				$mod_Blog->treeSelectBox($ID, 0);
				$categorySelBox = "<option value='0' selected>Select Category</option>";
				$categorySelBox .= $mod_Blog->treeSelectBox;
				$smarty->assign('categorySelBox', $categorySelBox);	
			}
			
			if($_POST['MM_Insert']=="new") {
				// validate the fields
				$mod_Blog->validateNewBlog($_POST, $result['settings'][0]['setting_id']);
				// insert in db
				$uid = $Common->phpinsert('blog', 'blog_id', $_POST);							
				// inserting categories
				if($result['settings'][0]['setting_id'] == 4){
					$sql = "insert into blog_cat_rel (blog_id, id, category_id) VALUES ('".$uid."', '".$ID."', '".$_POST['category_id']."')";
					$mod_Blog->insertCategory($sql);	
				}
				if($result['settings'][0]['setting_id']==5){
					$sql = "insert into blog_cat_rel (blog_id, category_id) VALUES ";
					foreach($_POST['category_id'] as $catId) {
						if($catId==0) continue;
						$sql .= "('".$uid."', '".$catId."'), ";
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
			$sql = "select * from blog WHERE id = '".$ID."' AND blog_id = '".$_GET['blog_id']."'";
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
			
			
			break;
		case 'view':
		default:
			// defining page heading and page title
			$PAGEHEADING = $result['keyword'][0]['keyword']." Blog";
			$smarty->assign('PAGEHEADING', $PAGEHEADING);
			if(is_numeric($_GET['catId']) && $_GET['catId']>0) {
				$sql = "select * from blog_categories WHERE category_id = '".$_GET['catId']."'";
				$catDetail = $Common->selectCacheRecord($sql);
				$PAGEHEADING = $result['keyword'][0]['keyword']." Blog :: ".$catDetail[0]['category'];
				$smarty->assign('PAGEHEADING', $PAGEHEADING);
				$sql = "select * from blog as a INNER JOIN blog_cat_rel as b ON a.blog_id = b.blog_id WHERE a.id = '".$ID."' AND b.category_id = '".$_GET['catId']."' ORDER BY a.blog_id DESC";
				$sqlCnt = "select count(*) as cnt from blog as a INNER JOIN blog_cat_rel as b ON a.blog_id = b.blog_id WHERE a.id = '".$ID."' AND b.category_id = '".$_GET['catId']."'";
				
				if($result['settings'][0]['setting_id']==5){
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
				$PAGEHEADING = $result['keyword'][0]['keyword']." Blog :: ".$_GET['kw'];
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

			break;
	}
	// calling body
	$body = $smarty->fetch('blog.html');
} catch (exception $e) { 
	$errorMessage = $e->getMessage();
	$smarty->assign('errorMessage', $errorMessage);
	$body = $smarty->fetch('blog.html');
} 
?>