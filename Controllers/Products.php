<?php
	include_once __DIR__ . '/../inc/functions.php';
	include_once __DIR__ . '/../inc/allModels.php';
	
	@$view 		= $action = $_REQUEST['action'];
	@$format 	= $_REQUEST['format'];
	@$id		= $_REQUEST['id'];
	@$category_id = $_REQUEST['category_id'];
	$layout		= '_Layout';
	
	
	switch ($action){
		case 'new':
			$view = 'edit';
			break;
		case 'edit':
			$model = Products::Get($_REQUEST['id']);
			break;
		case 'save':
			$sub_action = empty($_REQUEST['id']) ? 'created' : 'updated';
			//$errors = Users::Validate($_REQUEST);
			if(!$errors){
				$errors = Products::Save($_REQUEST);
			}
			if(!$errors){
				header("Location: ?sub_action=$sub_action&id=$_REQUEST[id]");
				die();
			}else{
				//print_r($errors);
				$model = $_REQUEST;
				$view = 'edit';
				
			}
			break;
		case 'delete':
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				//Promt
				$model = Products::Get($_REQUEST['id']);
			}else{
				$errors = Products::Delete($_REQUEST['id']);
			}
			break;
		case 'index':
			$model = Products::Get($id, $category_id);			
			break;
		case 'categories':
			$model = Products::GetCategories();
			break;
		default:
			$layout = '_PublicLayout';
			if($view == null) $view = 'home';
	}
	
	switch ($format) {
		case 'json':
			$ret = array('success' => empty($errors), 'errors'=> $errors, 'data'=> $model);
			echo json_encode($ret);
			break;
		case 'plain':
			include __DIR__ . "/../Views/Products/$view.php";			
			break;
		default:
			$view = __DIR__ . "/../Views/Products/$view.php";	
			include __DIR__ . "/../Views/Shared/$layout.php";
			break;
	}

