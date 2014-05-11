<?php
		include_once __DIR__ . '/../inc/functions.php';		//propper absolute path
		
		class Contacts {
			//	CRUD (Create, Read/Get, Update, Delete)
			static public function Get($id = null) {	//	If $id is given a value it will be set to that if nothing is given it will be set to null
				$sql = "SELECT C.*, UN.FirstName, UN.LastName, CT.Name as ContactTypeName
					        FROM 2014Spring_ContactMethods C 
					        INNER JOIN (
					        	SELECT U.id as id, U.FirstName as firstName, 
					        		U.LastName as lastName 
					        	FROM 2014Spring_Users U) as UN 
					        ON C.User_id = UN.id
					        INNER JOIN (
					        	SELECT K.id, K.Name
					        		FROM 2014Spring_Keywords as K) as CT 
					        ON C.ContactMethodType = CT.id
					        ";
				
				if($id == null) {
					//	Get all records
					return fetch_all($sql);
				}
				else {
					//	Get one record
					$sql .= " WHERE C.id = $id ";
					if($results = fetch_all($sql)){
						if (count($results) > 0) {
							return $results[0];
						}
					}else{
						return null;
					}
				}
			}
			
			static public function GetUsers($id = null){
				$sql = "SELECT U.id, U.FirstName, U.LastName
							FROM 2014Spring_Users as U ";
				$results = fetch_all($sql);
				return $results;
			}
			
			static public function Save(&$row) {
				$conn = GetConnection();
				
				$row2 = escape_all($row, $conn); //you need to do this so you clean up input (prevents SQL injection)
				if (!empty($row['id'])) {
					$sql = "Update 2014Spring_ContactMethods
							set ContactMethodType='$row2[ContactMethodType]', Value='$row2[Value]', User_id='$row2[User_id]' 
							WHERE id = $row2[id]";
				}else {
					$sql = "INSERT INTO 2014Spring_ContactMethods 
						(created_at, ContactMethodType, Value, User_id) 
						VALUES (current_timestamp, '$row2[ContactMethodType]', 
								'$row2[Value]', '$row2[User_id]')";
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
				
				$sql = "DELETE FROM 2014Spring_ContactMethods WHERE id = $id";
				
				$results = $conn->query($sql);
				$error = $conn->error;
				
				$conn->close();
				
				return $error ? array ('sql error' => $error) : false;
			}
			
			
			static public function Validate($row) {
				$errors = array();
				if(empty($row['ContactMethodType'])) $errors['ContactMethodType'] = "is required";
				if(empty($row['ContactMethodType'])) $errors['ContactMethodType'] = "is required";
				
				if(empty($row['Value'])) $errors['Value'] = "is required";
				
				if(!is_numeric($row['User_id'])) $errors['User_id'] = "must be a number";
				if(empty($row['User_id'])) $errors['User_id'] = "is required";

				return count($errors) > 0 ? $errors : false;			
			}
		}