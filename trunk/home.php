<?php

	switch($_GET['action']) {
		case 'news':
			try {
				// defining page heading and page title
				$PAGEHEADING = $result['keyword'][0]['keyword']." News";
				// fetching concepts and settings
				$result = $Common->getConceptSettings('news', $ID);			
				$smarty->assign('result', $result);
				// if setting occurs then call news
				$news = '';
				if($result['settings']) {
					// initializing news class
					$mod_News = new mod_News($dbFrameWork, $Common);
					// fetching each news result
					$news = $mod_News->getNewsString($result);
				}		
				// assigning
				$smarty->assign('content', $news);
				
				// calling body
				$body = $smarty->fetch('home.html');
			} catch (exception $e) { 
				$errorMessage = $e->getMessage();
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('errorMessage.html');
			} 
			break;
		case 'blog':
			try {
				$result = $Common->getConceptSettings('blog', $ID);				
				$smarty->assign('result', $result);
				
				$mod_Blog = new mod_Blog($dbFrameWork, $Common);				
				$smarty->assign('section', $_GET['section']);				
				
				if($result['settings'][0]['setting_id'] == 4 || $result['settings'][0]['setting_id']==5){
					// getting category list
					$mod_Blog->tree($ID, 0);
					$category = $mod_Blog->tree;
					$smarty->assign('category', $category);
				}
				switch($_GET['section']) {
					case 'new':
						// defining page heading and page title
						$PAGEHEADING = "Add New Blog";
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
								$sql = "insert into blog_cat_rel (blog_id, category_id) VALUES ('".$uid."', '".$_POST['category_id']."')";
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
						break;
					case 'delete':
						// defining page heading and page title
						$PAGEHEADING = "Delete Blog";
						break;
					case 'detail':
						// defining page heading and page title
						$PAGEHEADING = urldecode($_GET['title']);
						break;
					case 'view':
					default:
						// defining page heading and page title
						$PAGEHEADING = $result['keyword'][0]['keyword']." Blog";
						if(is_numeric($_GET['catId']) && $_GET['catId']>0) {
							$sql = "select * from blog_categories WHERE category_id = '".$_GET['catId']."'";
							$catDetail = $Common->selectCacheRecord($sql);
							$PAGEHEADING = $result['keyword'][0]['keyword']." Blog :: ".$catDetail[0]['category'];
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
				$smarty->assign('PAGEHEADING', $PAGEHEADING);
				// calling body
				$body = $smarty->fetch('blog.html');
			
			} catch (exception $e) { 
				$errorMessage = "<div class=\"error\">".$e->getMessage()."</div>";
				$smarty->assign('errorMessage', $errorMessage);
				$body = $smarty->fetch('blog.html');
			} 
			break;
		default:
			break;
	}

?>