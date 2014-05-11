<?php
	include_once __DIR__ . '/../inc/functions.php';
	include_once __DIR__ . '/../inc/allModels.php';
	
	@$view = $action = $_REQUEST['action'];
	@$format = $_REQUEST['format'];
	
	$user = Accounts::RequireAdmin();
	switch ($action){
		case 'new':
			$view = 'edit';
			break;
		case 'edit':
			$model = Orders::Get($_REQUEST['id']);
			break;
		case 'details':
			$model = Orders::GetItems($_REQUEST['id']);
			$view = 'details';
			break;
		case 'save':
			$sub_action = empty($_REQUEST['id']) ? 'created' : 'updated';
			$errors = Orders::Validate($_REQUEST);
			if(!$errors){
				$errors = Orders::Save($_REQUEST);
			}
			if(!$errors){
				header("Location: ?sub_action=$sub_action&id=$_REQUEST[id]");
				die();
			}else {
				$model = $_REQUEST;
				$view = 'edit';
				
			}
			break;
		case 'delete':
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				//prompt
				$model = Orders::Get($_REQUEST['id']);
			} else{
				$errors = Orders::Delete($_REQUEST['id']);
			}
			break;
		default:
			$model = Orders::Get();
			if($view == null) $view = 'index';
	}
	
	switch($format) {
		case 'json':
			$ret = array('success'=> empty($errors), 'errors'=> $errors, 'data'=> $model);
			echo json_encode($ret);
			break;
		case 'plain':
			include __DIR__ . "/../Views/Orders/$view.php";
			break;
		default:
			$view = __DIR__ . "/../Views/Orders/$view.php";
			include __DIR__ . "/../Views/Shared/_Layout.php";;
			break;
	}