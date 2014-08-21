<?php
class Status {

	private $sql = null;

	public function __construct() {
		$this->sql = new SQL;
	}

	function get($formvars = array(), $field = "") {

		$sql="SELECT *";
		$sql.="FROM status";
		$sql.=" WHERE 1";

		if(!empty($formvars['status_id'])) $sql.=" AND status_id='".$formvars['status_id']."'";
		
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
