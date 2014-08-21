<?php
class Variable extends Base{

	private $sql = null;

	public function __construct() {
		$this->sql = new SQL;
	}

	function get($formvars = array(), $field = "") {

		$sql="SELECT *";
		$sql.="FROM variable";
		$sql.=" WHERE 1";

		if(!empty($formvars['variable_id'])) $sql.=" AND variable_id='".$formvars['variable_id']."'";
		if(!empty($formvars['variable_name'])) $sql.=" AND variable_name='".$formvars['variable_name']."'";
		
		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			return $this->sql->getRecord();
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		}  
	}
		
}
?>
