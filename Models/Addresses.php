<?php
		include_once __DIR__ . '/../inc/functions.php';		//propper absolute path
		
		class Addresses {
			//	CRUD (Create, Read/Get, Update, Delete)
			static public function Get($id = null) {	//	If $id is given a value it will be set to that if nothing is given it will be set to null
				$sql = "SELECT A.*, UN.FirstName, UN.LastName, AT.Name as AddressTypeName
					        FROM 2014Spring_Addresses A 
					        INNER JOIN (
					        	SELECT U.id as id, U.FirstName as firstName, 
					        		U.LastName as lastName 
					        	FROM 2014Spring_Users U) as UN 
					        ON A.Users_id = UN.id
					        INNER JOIN (
					        	SELECT K.id, K.Name
					        		FROM 2014Spring_Keywords as K) as AT 
					        ON A.AddressType = AT.id
					        ";
				
				if($id == null) {
					//	Get all records
					//$sql = "SELECT * FROM 2014Spring_Addresses";
					return fetch_all($sql);
				}
				else {
					//	Get one record
					$sql .= " WHERE A.id = $id ";
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
					$sql = "Update 2014Spring_Addresses
							set Addresses='$row2[Addresses]', City='$row2[City]', State='$row2[State]', 
							Zip='$row2[Zip]', AddressType='$row2[AddressType]', Users_id='$row2[Users_id]',
							Country='$row2[Country]'
							WHERE id = $row2[id]";
				}else {
					$sql = "INSERT INTO 2014Spring_Addresses 
						(created_at, Addresses, City, State, Zip, AddressType, Users_id, Country) 
						VALUES (current_timestamp, '$row2[Addresses]', '$row2[City]', '$row2[State]', '$row2[Zip]',
						 '$row2[AddressType]', '$row2[Users_id]', '$row2[Country]')";
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
				
				$sql = "DELETE FROM 2014Spring_Addresses WHERE id = $id";
				
				$results = $conn->query($sql);
				$error = $conn->error;
				
				$conn->close();
				
				return $error ? array ('sql error' => $error) : false;
			}
			
			
			//Addresses, City, State, Zip, AddressType, Users_id, Country
			static public function Validate($row) {
				$errors = array();
				if(empty($row['Addresses'])) $errors['Addresses'] = "is required";
				if(empty($row['City'])) $errors['City'] = "is required";
				if(empty($row['State'])) $errors['State'] = "is required";
				if(empty($row['Zip'])) $errors['Zip'] = "is required";
				
				if(empty($row['Country'])) $errors['Country'] = "is required";
				
				if(!is_numeric($row['AddressType'])) $errors['AddressType'] = "must be a number";
				if(empty($row['AddressType'])) $errors['AddressType'] = "is required";
				
				if(!is_numeric($row['Users_id'])) $errors['Users_id'] = "must be a number";
				if(empty($row['Users_id'])) $errors['Users_id'] = "is required";

				return count($errors) > 0 ? $errors : false;			
			}
		}