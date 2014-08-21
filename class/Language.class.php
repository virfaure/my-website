<?php
class Language {

	private $sql = null;

	public function __construct() {
		$this->sql = new SQL;
	}

	function get($formvars = array(), $field = "") {

		$sql="SELECT *";
		$sql.="FROM language AS l, status AS s";
		$sql.=" WHERE 1";
		$sql.=" AND l.status_id = s.status_id";

		if(!empty($formvars['language_locale'])) $sql.=" AND language_locale='".$formvars['language_locale']."'";
		if(!empty($formvars['language_id'])) $sql.=" AND language_id='".$formvars['language_id']."'";
		
		$sql.=" AND l.status_id=".ENABLE;

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
