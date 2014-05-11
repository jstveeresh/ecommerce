<?php
		include_once __DIR__ . '/../inc/functions.php';		//propper absolute path
		
		class Products {
			//	CRUD (Create, Read/Get, Update, Delete)
			static public function Get($id = null, $category_id = null) {	//	If $id is given a value it will be set to that if nothing is given it will be set to null
				$sql = "SELECT *
							FROM 2014Spring_Products
					       ";
				
				if($id){
				// Get one record
					$sql .= " WHERE id = $id ";
					if(($results = fetch_all($sql)) && count($results) > 0){
						return $results[0];
					}else{
						return null;
					}
				}elseif($category_id){
					$sql .= " WHERE Catergory_Keyword_id = $category_id ";
					return fetch_all($sql);
				}else{
					//	Get all records
					return fetch_all($sql);
				}
			}

			static public function GetCategories()
			{
				$sql = "SELECT id, Name FROM 2014Spring_Keywords WHERE Parent_id = 13";
				return fetch_all($sql);
			}
			
			static public function GetSupliers() {
				$sql = "SELECT * FROM 2014Spring_Supliers ";
				return fetch_all($sql);
			}
			
			static public function Save(&$row) {
				$conn = GetConnection();
				
				$row2 = escape_all($row, $conn); //you need to do this so you clean up input (prevents SQL injection)
				if (!empty($row['id'])) {
					$sql = "Update 2014Spring_Products
							set Suplier_id='$row2[Suplier_id]', Name='$row2[Name]', Price='$row2[Price]', 
							Description='$row2[Description]', Picture_Url='$row2[Picture_Url]', 
							Catergory_Keyword_id='$row2[Catergory_Keyword_id]'
							WHERE id = $row2[id]";
				}else {
					$sql = "INSERT INTO 2014Spring_Products 
						(created_at, Suplier_id, Name, Password, fbid, UserType) 
						VALUES (current_timestamp, '$row2[Suplier_id]', '$row2[Name]', '$row2[Price]', '$row2[Description]',
							 '$row2[Picture_Url]', '$row2[Catergory_Keyword_id]')";
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
				
				$sql = "DELETE FROM 2014Spring_Products WHERE id = $id";
				
				$results = $conn->query($sql);
				$error = $conn->error;
				
				$conn->close();
				
				return $error ? array ('sql error' => $error) : false;
			}
			
			static public function Validate($row) {
				$errors = array();
				
				if(empty($row['Suplier_id'])) $errors['Suplier_id'] = "is required";
				if(!is_numeric($row['Suplier_id'])) $errors['Suplier_id'] = "must be a number";
				
				if(empty($row['Name'])) $errors['Name'] = "is required";
				
				if(empty($row['Price'])) $errors['Price'] = "is required";
				if(!is_numeric($row['Price'])) $errors['Price'] = "must be a number";
				
				if(empty($row['Picture_Url'])) $errors['Picture_Url'] = "is required";
				
				if(empty($row['Catergory_Keyword_id'])) $errors['Catergory_Keyword_id'] = "is required";
				if(!is_numeric($row['Catergory_Keyword_id'])) $errors['Catergory_Keyword_id'] = "must be a number";
				
				return count($errors) > 0 ? $errors : false;			
			}
			
			
			
			//	ACCOUTNTS
			static public function GetAccountInfo($id = null){
				$sql = "SELECT U.id, U.FirstName, U.LastName, U.Password, U.fbid, K.Name AS UserType, A.Addresses, A.City, A.State, A.Zip, A.Country, KA.Name AS AddressType, A.id AS AddressId, C.Value, KC.Name AS ContactMethodType
 						FROM 2014Spring_Users U
 							JOIN 2014Spring_Keywords K ON U.UserType = K.id
 							LEFT JOIN 2014Spring_Addresses A ON U.id = A.Users_id
 							LEFT JOIN 2014Spring_Keywords KA ON A.AddressType = KA.id
 							LEFT JOIN 2014Spring_ContactMethods C ON U.id = C.User_id
 							LEFT JOIN 2014Spring_Keywords KC ON C.ContactMethodType = KC.id
  						WHERE U.id = $id ";
				$results = fetch_all($sql);
				return $results[0];
			}
			
			static public function SaveInfo(&$row) {
				$conn = GetConnection();
				
				$row2 = escape_all($row, $conn); //you need to do this so you clean up input (prevents SQL injection)
				if (!empty($row['id'])) {
					$sql = "Update 2014Spring_Users as U, 2014Spring_Addresses as A, 2014Spring_ContactMethods as C
							set FirstName='$row2[FirstName]', LastName='$row2[LastName]', Password='$row2[Password]', 
							fbid='$row2[fbid]', UserType='$row2[UserType]', 
							A.Addresses='$row2[Addresses]', A.City='$row2[City]', A.State='$row2[State]', 
							A.Zip='$row2[Zip]', A.AddressType='$row2[AddressType]', A.Country='$row2[Country]',
							ContactMethodType='$row2[ContactMethodType]', Value='$row2[Value]'
							WHERE U.id = $row2[id] AND
									A.Users_id = $row2[id] AND
									A.id = $row2[AddressId] AND
									C.User_id = $row2[id] ";
				}else {
					$sql = "";
				}	
						
				$results = $conn->query($sql);
				$error = $conn->error;
				
				if(!$error && empty($row['id'])){
					$row['id'] = $conn->insert_id;
				}
				
				$conn->close();
				
				return $error ? array ('sql error' => $error) : false;
			}

			static public function ValidateInfo($row) {
				$errors = array();
				//	User Info
				if(empty($row['FirstName'])) $errors['FirstName'] = "is required";
				if(empty($row['LastName'])) $errors['LastName'] = "is required";
				if(!is_numeric($row['UserType'])) $errors['UserType'] = "must be a number";
				if(empty($row['UserType'])) $errors['UserType'] = "is required";
				
				//	Account Info
				if(empty($row['Addresses'])) $errors['Addresses'] = "is required";
				if(empty($row['City'])) $errors['City'] = "is required";
				if(empty($row['State'])) $errors['State'] = "is required";
				if(empty($row['Zip'])) $errors['Zip'] = "is required";
				if(empty($row['Country'])) $errors['Country'] = "is required";
				if(!is_numeric($row['AddressType'])) $errors['AddressType'] = "must be a number";
				if(empty($row['AddressType'])) $errors['AddressType'] = "is required";
				
				//	Contact Info
				if(empty($row['ContactMethodType'])) $errors['ContactMethodType'] = "is required";
				if(empty($row['ContactMethodType'])) $errors['ContactMethodType'] = "is required";
				
				return count($errors) > 0 ? $errors : false;			
			}

			//	ORDERS
			static public function GetOrderInfo($id = null, $oid = null){
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
						WHERE O.User_id = $id ";
				if($oid){
					$sql .= "AND O.id = $oid ";
					$results = fetch_all($sql);
					return $results[0];
				}
				return $results = fetch_all($sql);
			}
			
			static public function GetAddresses($id = null){ //	$id needs to be the User's id
				$sql = "SELECT A.id, A.Addresses
							FROM 2014Spring_Addresses as A
								WHERE A.Users_id = $id";
				$results = fetch_all($sql);
				return $results;
			}
			
			static public function SaveOrder(&$row) {
				$conn = GetConnection();
				
				$row2 = escape_all($row, $conn); //you need to do this so you clean up input (prevents SQL injection)
				print_r($row);
				if (!empty($row['id'])) {
					$sql = "Update 2014Spring_Orders as O
							set Address_id='$row2[Addresses]'
							WHERE O.id = $row2[id] ";
				}else {
					$sql = "";
				}	
						
				$results = $conn->query($sql);
				$error = $conn->error;
				
				if(!$error && empty($row['id'])){
					$row['id'] = $conn->insert_id;
				}
				
				$conn->close();
				
				return $error ? array ('sql error' => $error) : false;
			}
			
			static public function ValidateOrder($row) {
				$errors = array();
				if(!is_numeric($row['Addresses'])) $errors['Addresses'] = "must be a number";
				if(empty($row['Addresses'])) $errors['Addresses'] = "is required";
				
				return count($errors) > 0 ? $errors : false;			
			}
			
			//	ORDER ITEMS
			static public function GetItems($id = null){
				$sql = "SELECT I.*, OT.FirstName, OT.LastName, OT.Addresses, PT.Name as ProductName
					        FROM 2014Spring_Order_Items I 
					        INNER JOIN (
								SELECT O.*, UN.FirstName, UN.LastName, AA.Addresses
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
							) as OT
							ON I.Order_id = OT.id
					        INNER JOIN (
					        	SELECT P.id, P.Name
					        		FROM 2014Spring_Products as P) as PT 
					        ON I.Product_id = PT.id
					    WHERE I.Order_id = $id ";
				
				return $results = fetch_all($sql);;
			}
			
			static public function DeleteItems($id) {
				$conn = GetConnection();
				
				$sql = "DELETE FROM 2014Spring_Order_Items WHERE id = $id";
				
				$results = $conn->query($sql);
				$error = $conn->error;
				
				$conn->close();
				
				return $error ? array ('sql error' => $error) : false;
			}
			
			static public function SaveItems(&$row) {
				$conn = GetConnection();
				
				$row2 = escape_all($row, $conn); //you need to do this so you clean up input (prevents SQL injection)
				print_r($row);
				if (!empty($row['id'])) {
					$sql = "Update 2014Spring_Orders as O
							set Address_id='$row2[Addresses]'
							WHERE O.id = $row2[id] ";
				}else {
					$sql = "";
				}	
						
				$results = $conn->query($sql);
				$error = $conn->error;
				
				if(!$error && empty($row['id'])){
					$row['id'] = $conn->insert_id;
				}
				
				$conn->close();
				
				return $error ? array ('sql error' => $error) : false;
			}
			
			static public function ValidateItems($row) {
				$errors = array();
				//implement the regular Validate
				if(isset($row[''])) { //Account
					//validate the whole god damn thing.... FML
				}
				else if(isset($row['Addresses'])) {	//Orders
					if(!is_numeric($row['Addresses'])) $errors['Addresses'] = "must be a number";
					if(empty($row['Addresses'])) $errors['Addresses'] = "is required";
				}
				else if(isset($row[''])) { //Items
					
				}
				return count($errors) > 0 ? $errors : false;			
			}
			
		}