<?php
session_start();
	include_once __DIR__ . '/../inc/functions.php';
	include_once __DIR__ . '/../inc/allModels.php';

class Accounts {
	public static function DoLogin($email, $password) {
		$sql ="	SELECT U.*,  CM.ContactMethodType, CM.Value
					FROM 2014Spring_Users U Join 
						2014Spring_ContactMethods CM on U.id=CM.User_Id
				where CM.Value = '$email'";
		$model = fetch_all($sql);

		if(!empty($model) && $model[0]['Password'] == $password)
		{
			$_SESSION['User'] = $model[0];
			return null;
		}else{
			return array('password'=>'Wrong password');
		}
	}
	
	public static function IsLoggedIn() {
		return (self::GetCurrentUser() != null);
	}
	
	public static function GetCurrentUser(){
		return isset($_SESSION['User']) ? $_SESSION['User'] : null;
	}
	
	public static function RequireLogin(){
		if(!self::IsLoggedIn()) {
			header("Location: Accounts.php?returnUrl=$_SERVER[PHP_SELF]");
			die();
		}
	}	
	
	public static function IsAdmin() {
		$user = self::GetCurrentUser();
		if(!$user) return false;
		
		return ($user['UserType'] == 14);
	}
	
	public static function RequireAdmin() {
		if(!self::IsAdmin()) { 
			header("Location: Accounts.php?action=notAdmin");
			die();
		}
		$user = self::GetCurrentUser();
		return $user;
	}
}