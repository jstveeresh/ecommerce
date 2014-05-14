<?php
	include_once __DIR__ . '/../inc/functions.php';
	
	class Addresses  {
		
		static public function Get($id = null)
		{
			if($id == null){
				//	Get all records
				
				return fetch_all("SELECT * FROM 2014Spring_Addresses");
			}else{
				// Get on record
			}
		}
		
		static public function Create($row)
		{
			
		}

		static public function Blank()
		{
			return array( 'id' => null);
		}
		
		static public function Update($row)
		{
				
		}
	
		static public function Delete($id)
		{
			
		}
		
		static public function Validate($row)
		{
			
		}
		
	}
	