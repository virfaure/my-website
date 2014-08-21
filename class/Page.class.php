<?php
class Page extends Base{

	private $sql = null;

	public function __construct() {
		$this->sql = new SQL;
	}

	function get($formvars = array(), $field = "") {

		$sql="SELECT *";
		$sql.="FROM page";
		$sql.=" WHERE 1";

		if(!empty($formvars['page_id'])) $sql.=" AND page_id='".$formvars['page_id']."'";

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
