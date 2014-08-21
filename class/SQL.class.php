<?php

require_once 'pear/MDB2.php';

// define the query types
define('SQL_NONE', 1);
define('SQL_ALL', 2);
define('SQL_INIT', 3);

// define the query formats
define('SQL_ASSOC', 1);
define('SQL_INDEX', 2);

PEAR::setErrorHandling(PEAR_ERROR_CALLBACK, 'dumpError');

function dumpError($error){	
	
	if(DEBUG == 2){
		echo "<div style='width:95%; border: 1px solid #F00;padding:5px; margin:5px; background-color:#FFFCDF;font-family:arial;font-size:10px;position:absolute;z-index:9999'>";
			echo $error->getUserInfo()."<br/>";
			echo "<b>".$error->getMessage()."<b>";
		echo "</div>";
	}
	
	die();
}
	
class SQL {

    private $mdb2 = null;
    private $result = null;
    private $record = null;
    private $total = null;
    private $lastinsertId = null;
  
	

    public function __construct() {
        $dsn = DB_TYPE."://".DB_USER.":".DB_PASS."@".DB_HOST."/".DB_DATABASE;  
		
		$this->mdb2 =& MDB2::factory($dsn);
		if (PEAR::isError($this->mdb2)) {
			die($this->mdb2->getMessage());
		}
    }

	// DISCONNECT From database
    public function disconnect() {
		$this->mdb2->disconnect();
    }
   
 
	public function query($sql, $type = SQL_NONE, $format = SQL_INDEX) {	
		$this->mdb2->query('SET NAMES utf8');
		$this->record = array();
		$_data = array();
		$_fetchmode = ($format == SQL_ASSOC) ? MDB2_FETCHMODE_ASSOC : MDB2_FETCHMODE_ORDERED;

		if(preg_match("/LIMIT/",$sql)) {
			if(!preg_match("/FOUND_ROWS/",$sql)) {
				$limit=true;
				$sql=preg_replace("/^SELECT([.])*/","SELECT SQL_CALC_FOUND_ROWS\\1",$sql);
			}
		}

		$this->result = $this->mdb2->query($sql);

		if(!empty($limit)) {
			$resultLimit = $this->mdb2->query('SELECT FOUND_ROWS()');
			$total = $resultLimit->fetchRow();
			$this->total = $total[0];
		}

		switch ($type) {
			case SQL_ALL:
				// get all the records
				while($_row = $this->result->fetchRow($_fetchmode)) {
					$_data[] = $_row;  
				}
				$this->result->free();           
				$this->record = $_data;
			break;
			case SQL_INIT:
				// get the first record
				$this->record = $this->result->fetchRow($_fetchmode);
			break;
			case SQL_NONE:
			default:
				// records will be looped over with next()
			break;  
		}
		
		$this->lastinsertId = mysql_insert_id(); 
		
		$this->disconnect();
	}
	
	
	// GET all record from SELECT
	public function getRecord($field = null){ 
		if($field == null) return $this->record;
		else return $this->record[$field];	
	}
		
	// GET Total of record from SELECT
	public function getTotal(){ 
		return $this->total;
	}
	
	// GET Last Insert ID from Query : INSERT
	public function getLastInsertID(){ 
		//$this->lastinsertId = mysql_insert_id($this->result); 
		return $this->lastinsertId;
	}
	
	// GET mdb2 object 
	public function getMDB2(){ 
		return $this->mdb2;
	}
	
	// GET mdb2 object 
	public function escapeMDB2($text, $escape_wildcards = false){ 
		if(get_magic_quotes_gpc()) return $text;
		else return $this->mdb2->escape($text, $escape_wildcards);
	}
    
}
?>