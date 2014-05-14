<?php
ini_set(‘display_errors’,1);
error_reporting(E_ALL|E_STRICT);

	include_once __DIR__ . '/../inc/functions.php';
	include_once __DIR__ . '/../inc/allModels.php';
	
	@$view = $action = $_REQUEST['action'];
	@$format = $_REQUEST['format'];
	
	
	
	switch ($action){
		case 'create':
			break;
		case 'update':
			break;
		case 'delete':
			break;
		default:
			$model = Suppliers::Get();
			if($view == null) $view = 'index';
	}
	
	switch ($format) {
		case 'plain':
			include __DIR__ . "/../Views/Suppliers/$view.php";			
			break;
		default:
			$view = __DIR__ . "/../Views/Suppliers/$view.php";	
			include __DIR__ . "/../Views/Shared/_Layout.php";
			break;
	}