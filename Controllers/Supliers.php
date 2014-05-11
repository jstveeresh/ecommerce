<?php
	include_once __DIR__ . '/../inc/functions.php';
	include_once __DIR__ . '/../inc/allModels.php';
	
	$user = Accounts::RequireAdmin();
	@$view = $action = $_REQUEST['action'];
	@$format = $_REQUEST['format'];

	switch ($action){
		case 'new':
			$view = 'edit';
			break;
		case 'edit':
			$model = Supliers::Get($_REQUEST['id']);
			break;
		case 'details':
			$model = Supliers::GetProducts($_REQUEST['id']);
			$view = 'details';
			break;
		case 'save':
			$sub_action = empty($_REQUEST['id']) ? 'created' : 'updated';
			$errors = Supliers::Validate($_REQUEST);
			if(!$errors){
				$errors = Supliers::Save($_REQUEST);
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
				$model = Supliers::Get($_REQUEST['id']);
			} else{
				$errors = Supliers::Delete($_REQUEST['id']);
			}
			break;
		default:
			$model = Supliers::Get();
			if($view == null) $view = 'index';
	}
	
	switch($format) {
		case 'json':
			$ret = array('success'=> empty($errors), 'errors'=> $errors, 'data'=> $model);
			echo json_encode($ret);
			break;
		case 'plain':
			include __DIR__ . "/../Views/Supliers/$view.php";
			break;
		default:
			$view = __DIR__ . "/../Views/Supliers/$view.php";
			include __DIR__ . "/../Views/Shared/_Layout.php";;
			break;
	}