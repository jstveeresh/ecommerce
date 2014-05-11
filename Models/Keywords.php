<?php

	class Keywords {

		public static function SelectListFor($TypeId) {
			$sql = "SELECT id, Name FROM 2014Spring_Keywords WHERE Parent_id = $TypeId ";
			return fetch_all($sql);
		}
	}