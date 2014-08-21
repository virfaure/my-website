<?php

	class bUtil extends Base{

		var $sql = null;

		public function __construct(){
			$this->sql = new SQL;
		}

		// d/m/Y to Y-m-d
		public function dateLocaleToDB($dateString){
			preg_match('"([0-9]{2})/([0-9]{2})/([0-9]{4})"', $dateString, $match);
			$timestamp = mktime(0, 0, 0, $match[2], $match[1], $match[3]);
			
			return date("Y-m-d", $timestamp);
		}

	}

?>
