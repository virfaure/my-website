<?php

	class Util {

		private $sql = null;

		
		public function __construct(){
			$this->sql = new SQL;
		}

		// d/m/Y to Y-m-d
		public function dateLocaleToDB($dateString){
			preg_match('"([0-9]{2})/([0-9]{2})/([0-9]{4})"', $dateString, $match);
			$timestamp = mktime(0, 0, 0, $match[2], $match[1], $match[3]);
			
			return date("Y-m-d", $timestamp);
		}
		
		//  Y-m-d to d/m/Y
		public function dateDBToLocale($dateDB){
			preg_match('"([0-9]{4})-([0-9]{2})-([0-9]{2})"', $dateDB, $match);
			$timestamp = mktime(0, 0, 0, $match[2], $match[3], $match[1]);
			
			return date("d/m/Y", $timestamp);
		}
		
		public function dateDBToTimestamp($dateDB){
			preg_match('"([0-9]{4})-([0-9]{2})-([0-9]{2})"', $dateDB, $match);
			$timestamp = mktime(0, 0, 0, $match[2], $match[3], $match[1]);
			
			return $timestamp;
		}
		
		// Y-m-d to somehting month, year
		public function dateDBToStringShort($dateDB){
			preg_match('"([0-9]{4})-([0-9]{2})-([0-9]{2})"', $dateDB, $match);
			$timestamp = mktime(0, 0, 0, $match[2], $match[3], $match[1]);	
				
			$indexMonth = date('n', $timestamp);	// 1 - 12
			$indexMonth = $indexMonth - 1 ;
			$year = date('Y', $timestamp);
			
			switch($_SESSION['language_locale']){
				case 'ES_ES':
					$arrMonths = array("en.", "feb.", "marzo", "abr.", "mayo", "jun.", "jul.", "ag.", "sept.", "oct.", "nov.", "dic.");
					return $arrMonths[$indexMonth]." ".$year;
				break;
				
				case 'FR_FR':
					$arrMonths = array("janv.", "fév.", "mars", "avr.", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc.");
					return $arrMonths[$indexMonth]." ".$year;
				break;
				
				case 'EN_GB':
					$arrMonths = array("jan.", "feb.", "march", "apr.", "may", "june", "july", "aug.", "sept.", "oct.", "nov.", "dec.");
					return $arrMonths[$indexMonth]." ".$year;
				break;
				
				default:
					$arrMonths = array("jan.", "feb.", "march", "apr.", "may", "june", "july", "aug.", "sept.", "oct.", "nov.", "dec.");
					return $arrMonths[$indexMonth]." ".$year;
			}
		}
		
		// Y-m-d to somehting like day of month
		public function dateDBToString($dateDB){
			preg_match('"([0-9]{4})-([0-9]{2})-([0-9]{2})"', $dateDB, $match);
			$timestamp = mktime(0, 0, 0, $match[2], $match[3], $match[1]);	
				
			$indexDay = date('w', $timestamp);
			$numberDay = date('j', $timestamp);
			$indexMonth = date('n', $timestamp);	// 1 - 12
			$indexMonth = $indexMonth - 1 ;
			
			switch($_SESSION['language_locale']){
				case 'ES_ES':
					$arrDays = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
					$arrMonths = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
					return $arrDays[$indexDay]." ".$numberDay." de ".$arrMonths[$indexMonth];
				break;
				
				case 'FR_FR':
					$arrDays = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
					$arrMonths = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
	
					return $arrDays[$indexDay]." ".$numberDay." de ".$arrMonths[$indexMonth];
				break;
				
				case 'EN_GB':
					$arrDays = array("Sunday", "Monday", "Thuesday", "Wednesday", "Thursday ", "Friday", "Saturday");
					$arrMonths = array("january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december");
					return $arrDays[$indexDay].", ".ucfirst($arrMonths[$indexMonth])." ".$numberDay;
				break;
				
				default:
					$arrDays = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
					$arrMonths = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
					return $arrDays[$indexDay]." ".$numberDay." de ".$arrMonths[$indexMonth];
			}
		}
		

	}

?>
