<?php
		include_once __DIR__ . '/../inc/functions.php';		//propper absolute path
		
		class Users {
			//	CRUD (Create, Read/Get, Update, Delete)
			static public function Get($id = null) {	//	If $id is given a value it will be set to that if nothing is given it will be set to null
				$sql = "SELECT U.*, K.Name as UserType_Name 
					        FROM 2014Spring_Users U Join 2014Spring_Keywords K ON U.UserType = K.id
					       ";
				
				if($id == null) {
					//	Get all records
					return fetch_all($sql);
				}
				else {
					//	Get one record
					$sql .= " WHERE U.id = $id ";
					if($results = fetch_all($sql)){
						if (count($results) > 0) {
							return $results[0];
						}
					}else{
						return null;
					}
				}
			}
			
			static public function GetDetails($id) {
				$sql = "SELECT U.id, U.FirstName, U.LastName, U.Password, U.fbid, K.Name AS UserType
 						FROM 2014Spring_Users U
 							JOIN 2014Spring_Keywords K ON U.UserType = K.id
  						WHERE U.id = $id";
				
				$full_results[0] = array(fetch_all($sql));  // [0] = User Info
				
				$sql = "SELECT A.Addresses, A.City, A.State, A.Zip, A.Country, KA.Name AS AddressType, A.id AS AddressId, A.id as Aid
						FROM 2014Spring_Users U
							LEFT JOIN 2014Spring_Addresses A ON U.id = A.Users_id
							LEFT JOIN 2014Spring_Keywords KA ON A.AddressType = KA.id
						WHERE U.id = $id";
						
				$full_results[1] = fetch_all($sql);	// [1] = Address Info
				
				$sql = "SELECT C.Value, KC.Name AS ContactMethodType, C.id as Cid
						FROM 2014Spring_Users U
							LEFT JOIN 2014Spring_ContactMethods C ON U.id = C.User_id
 							LEFT JOIN 2014Spring_Keywords KC ON C.ContactMethodType = KC.id
						WHERE U.id = $id";
						
				$full_results[2] = fetch_all($sql);	//	[2] = Order Info
				 
				$sql = "SELECT O.id as Order_id, O.created_at as OrderDate, A.Addresses as OrderAddress
						FROM 2014Spring_Users U
							LEFT JOIN 2014Spring_Orders O on O.User_id = U.id
							LEFT JOIN 2014Spring_Addresses A on O.Address_id = A.id
						WHERE U.id = $id";
						
				$full_results[3] = fetch_all($sql);
						
				return 	$full_results;
			}
			
			static public function Save(&$row) {
				$conn = GetConnection();
				
				$row2 = escape_all($row, $conn); //you need to do this so you clean up input (prevents SQL injection)
				if (!empty($row['id'])) {
					$sql = "Update 2014Spring_Users
							set FirstName='$row2[FirstName]', LastName='$row2[LastName]', Password='$row2[Password]', 
							fbid='$row2[fbid]', UserType='$row2[UserType]'
							WHERE id = $row2[id]";
				}else {
					$sql = "INSERT INTO 2014Spring_Users 
						(created_at, FirstName, LastName, Password, fbid, UserType) 
						VALUES (current_timestamp, '$row2[FirstName]', '$row2[LastName]', '$row2[Password]', '$row2[fbid]', '$row2[UserType]')";
				}	
						
				$results = $conn->query($sql);
				$error = $conn->error;
				
				if(!$error && empty($row['id'])){
					$row['id'] = $conn->insert_id;
				}
				
				$conn->close();
				
				return $error ? array ('sql error' => $error) : false;
			}
			
			static public function Blank()
			{
				return array('id' => null);
			}
			
			static public function Update($row) {
				
			}
			
			static public function Delete($id) {
				$conn = GetConnection();
				
				$sql = "DELETE FROM 2014Spring_Users WHERE id = $id";
				
				$results = $conn->query($sql);
				$error = $conn->error;
				
				$conn->close();
				
				return $error ? array ('sql error' => $error) : false;
			}
			
			static public function Validate($row) {
				$errors = array();
				if(empty($row['FirstName'])) $errors['FirstName'] = "is required";
				if(empty($row['LastName'])) $errors['LastName'] = "is required";
				
				if(!is_numeric($row['UserType'])) $errors['UserType'] = "must be a number";
				if(empty($row['UserType'])) $errors['UserType'] = "is required";

				return count($errors) > 0 ? $errors : false;			
			}
		}