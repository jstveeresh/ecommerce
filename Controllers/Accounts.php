<?php
	error_reporting (E_ALL);
	ini_set("display_errors", 1);
	include_once __DIR__ . '/../inc/functions.php';
	include_once __DIR__ . '/../inc/allModels.php';
	
	@$view 		= $action = $_REQUEST['action'];
	@$format 	= $_REQUEST['format'];

	if(isset($_REQUEST['access_token'])){
		
	}
	switch ($action){
		default:	// Login
		$view = 'login';
		$errors = array();
		if(isset($_REQUEST['returnUrl']))
			$_SESSION['returnUrl'] = $_REQUEST['returnUrl'];
		if(!isset($_SESSION['returnUrl']) && isset($_SERVER['HTTP_REFERER']))
			$_SESSION['returnUrl'] = $_SERVER['HTTP_REFERER'];
			
		//print_r($_REQUEST);	
		if(isset($_POST['email']))
		{
			$model = $_REQUEST;
			$errors = Accounts::DoLogin($_POST['email'], $_POST['password']);
			
			if(!$errors)
			{
				$returnUrl = !empty($_SESSION['returnUrl']) ? $_SESSION['returnUrl'] : '../Home/';
				header("Location: $returnUrl");
				die();
			}
		}else{
			$model = array('email'=>null, 'password'=>null);
		}
	}
	
	switch ($format) { 
		case 'json':
			$ret = array('success' => empty($errors), 'errors'=> $errors, 'data'=> $model);
			echo json_encode($ret);
			break;
		case 'plain':
			include __DIR__ . "/../Views/Accounts/$view.php";			
			break;
		default:
			$view = __DIR__ . "/../Views/Accounts/$view.php";	
			include __DIR__ . "/../Views/Shared/_PublicLayout.php";
			break;
	}
	