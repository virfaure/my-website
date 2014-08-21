<?php

class bLanguage extends Base {

    private $sql = null;
   
    public function __construct() {
		$this->sql = new SQL;
    }
		
	public function get($formvars = array(),$field = "") {
       
        $sql="SELECT *";
        $sql.=" FROM language AS l, status AS s";
		$sql.=" WHERE 1";
        $sql.=" AND l.status_id = s.status_id";
	   
		if(!empty($formvars['language_id'])) $sql.=" AND language_id='".$formvars['language_id']."'";
		if(!empty($formvars['language_locale'])) $sql.=" AND language_locale='".$formvars['language_locale']."'";
		if(!empty($formvars['status_id'])) $sql.=" AND s.status_id='".$formvars['status_id']."'";

		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			return $this->sql->getRecord();
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		}  		  
    }
	
	
	public function add($formvars = array()){
		$sql="INSERT INTO language SET";
		$sql.=" language_name='".$formvars['language_name']."',";
		$sql.=" language_locale='".$formvars['language_locale']."',";
		$sql.=" language_image='".$formvars['language_image']."',";
		$sql.=" status_id='".$formvars['status_id']."'";
		$this->sql->query($sql);
		
		$idElem = @mysql_insert_id();
		
		return $idElem;
	}
	
	public function update($formvars = array()){
		$sql="UPDATE language SET";
		$sql.=" language_name='".$formvars['language_name']."',";
		$sql.=" language_locale='".$formvars['language_locale']."',";
		$sql.=" language_image='".$formvars['language_image']."',";
		$sql.=" status_id='".$formvars['status_id']."'";
		$sql.=" WHERE language_id=".$formvars['language_id'];
		$this->sql->query($sql);
	}
	
	public function delete($formvars = array()){
		$sql="DELETE FROM language";
		$sql.=" WHERE language_id=".$formvars['language_id']." LIMIT 1";
		$this->sql->query($sql);
	}
	
}
?>
