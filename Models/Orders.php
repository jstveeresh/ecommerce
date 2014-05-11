<?php
		include_once __DIR__ . '/../inc/functions.php';		//propper absolute path
		
		class Orders {
			//	CRUD (Create, Read/Get, Update, Delete)
			static public function Get($id = null) {	//	If $id is given a value it will be set to that if nothing is given it will be set to null
				$sql = "SELECT O.*, UN.FirstName, UN.LastName, AA.Addresses
								FROM 2014Spring_Orders as O
								INNER JOIN (
										SELECT U.id as id, U.FirstName as firstName, 
												U.LastName as lastName 
											FROM 2014Spring_Users U) as UN 
										ON O.User_id = UN.id
								INNER JOIN (
										SELECT A.id as id, A.Addresses as addresses
										FROM 2014Spring_Addresses A) as AA
										ON O.Address_id = AA.id
					        ";
				
				if($id == null) {
					//	Get all records
					return fetch_all($sql);
				}
				else {
					//	Get one record
					$sql .= " WHERE O.id = $id ";
					if($results = fetch_all($sql)){
						if (count($results) > 0) {
							return $results[0];
						}
					}else{
						return null;
					}
				}
			}
			
			static public function GetItems($id = null) {
				$sql = "SELECT I.* , O.id as Order_id, P.id as Product_id, P.Name as ProductName, U.FirstName,
							U.LastName, A.Addresses
						FROM 2014Spring_Order_Items I
							LEFT JOIN 2014Spring_Orders O ON O.id = I.Order_id
							LEFT JOIN 2014Spring_Users U ON U.id = O.User_id
							LEFT JOIN 2014Spring_Addresses A ON O.Address_id = A.id
							LEFT JOIN 2014Spring_Products P ON I.Product_id = P.id
						WHERE I.Order_id = $id";
				
				return fetch_all($sql);
			}
			
			static public function GetUsers($id = null){
				$sql = "SELECT U.id, U.FirstName, U.LastName
							FROM 2014Spring_Users as U ";
				$results = fetch_all($sql);
				return $results;
			}
			
			static public function GetAddresses($id = null){
				$sql = "SELECT A.id, A.Addresses
							FROM 2014Spring_Addresses as A ";
				$results = fetch_all($sql);
				return $results;
			}
			
			static public function Save(&$row) {
				$conn = GetConnection();
				
				$row2 = escape_all($row, $conn); //you need to do this so you clean up input (prevents SQL injection)
				if (!empty($row['id'])) {
					$sql = "Update 2014Spring_Orders
							set User_id='$row2[User_id]', Address_id='$row2[Address_id]' 
							WHERE id = $row2[id]";
				}else {
					$sql = "INSERT INTO 2014Spring_Orders
						(created_at, User_id, Address_id) 
						VALUES (current_timestamp, '$row2[User_id]', 
								'$row2[Address_id]')";
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
				
				$sql = "DELETE FROM 2014Spring_Orders WHERE id = $id";
				
				$results = $conn->query($sql);
				$error = $conn->error;
				
				$conn->close();
				
				return $error ? array ('sql error' => $error) : false;
			}
			
			
			
			static public function Validate($row) {
				$errors = array();
				if(!is_numeric($row['User_id'])) $errors['User_id'] = "must be a number";
				if(empty($row['User_id'])) $errors['User_id'] = "is required";
				
				if(!is_numeric($row['Address_id'])) $errors['Address_id'] = "must be a number";
				if(empty($row['Address_id'])) $errors['Address_id'] = "is required";

				return count($errors) > 0 ? $errors : false;			
			}
		}