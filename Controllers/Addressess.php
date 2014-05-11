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
			$model = Addresses::Get($_REQUEST['id']);
			break;
		case 'save':
			$sub_action = empty($_REQUEST['id']) ? 'created' : 'updated';
			$errors = Addresses::Validate($_REQUEST);
			if(!$errors){
				$errors = Addresses::Save($_REQUEST);
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
				$model = Addresses::Get($_REQUEST['id']);
			} else{
				$errors = Addresses::Delete($_REQUEST['id']);
			}
			break;
		default:
			$model = Addresses::Get();
			if($view == null) $view = 'index';
	}
	
	switch($format) {
		case 'json':
			$ret = array('success'=> empty($errors), 'errors'=> $errors, 'data'=> $model);
			echo json_encode($ret);
			break;
		case 'plain':
			include __DIR__ . "/../Views/Addresses/$view.php";
			break;
		default:
			$view = __DIR__ . "/../Views/Addresses/$view.php";
			include __DIR__ . "/../Views/Shared/_Layout.php";;
			break;
	}