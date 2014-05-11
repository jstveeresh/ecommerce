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
			$model = Users::Get($_REQUEST['id']);
			break;
		case 'details':
			$model = Users::GetDetails($_REQUEST['id']);
			$view = 'details';
			break;
		case 'save':
			$sub_action = empty($_REQUEST['id']) ? 'created' : 'updated';
			$errors = Users::Validate($_REQUEST);
			if(!$errors){
				$errors = Users::Save($_REQUEST);
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
			/*$sub_action_delete = 'deleted';
			$deleted = Users::Get($_REQUEST['id']);
			$errors = Users::Delete($_REQUEST['id']);
			$model = Users::Get();
			$view = 'index';*/
			
			//Plotkin's method:
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				//prompt
				$model = Users::Get($_REQUEST['id']);
			} else{
				$errors = Users::Delete($_REQUEST['id']);
			}
			break;
		default:
			$model = Users::Get();
			if($view == null) $view = 'index';
	}

	switch ($format) {
		case 'json':
			$ret = array('success'=> empty($errors), 'errors'=> $errors, 'data'=> $model);
			echo json_encode($ret);
			break;
		case 'plain':
			include __DIR__ . "/../Views/Users/$view.php";			
			break;
		default:
			if($view == 'editAddress'){
				$view = __DIR__ . "/../Views/Addresses/edit.php";
			}
			else if($view == 'editContact'){
				$view = __DIR__ . "/../Views/Contacts/edit.php";
			}
			else {
				$view = __DIR__ . "/../Views/Users/$view.php";	
			}
			include __DIR__ . "/../Views/Shared/_Layout.php";
			break;
	}