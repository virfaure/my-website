<?php
class bVariable extends Base{

    private $sql = null;
   
    public function __construct() {
		$this->sql = new SQL;
    }
		
	public function get($formvars = array(),$field = "") {
       
		$sql="SELECT *";
		$sql.="FROM variable";
		$sql.=" WHERE 1";

		if(!empty($formvars['variable_id'])) $sql.=" AND variable_id='".$formvars['variable_id']."'";
		if(!empty($formvars['variable_name'])) $sql.=" AND variable_name='".$formvars['variable_name']."'";
		if(!empty($formvars['variable_value'])) $sql.=" AND variable_value='".$formvars['variable_value']."'";

		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			return $this->sql->getRecord();
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		}  
    }

	
	public function add($formvars = array()){
		$sql="INSERT INTO variable SET";
		$sql.=" variable_name='".$formvars['variable_name']."',";
		$sql.=" variable_value='".$formvars['variable_value']."'";
		$this->sql->query($sql);
		
		$idElem = @mysql_insert_id();
		
		return $idElem;
	}
		
	function update($formvars = array()){
		$sql="UPDATE variable SET";
		$sql.=" variable_name='".$formvars['variable_name']."',";
		$sql.=" variable_value='".$formvars['variable_value']."'";
		$sql.=" WHERE variable_id=".$formvars['variable_id'];
		$this->sql->query($sql);
	}

	function delete($formvars = array()){
		$sql="DELETE FROM variable";
		$sql.=" WHERE variable_id=".$formvars['variable_id']." LIMIT 1";
		$this->sql->query($sql);
	}
		 
}
?>
