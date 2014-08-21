<?php

	class Base {

		public function __construct(){
		}

		public function getOne($formvars = array(), $field = "") {
			$records = $this->get($formvars, $field);
			if(empty($field) && !empty($records)) return $records[0];	
			else return $records; 		
		}

	}

?>
