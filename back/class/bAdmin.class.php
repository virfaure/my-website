<?php
	class bAdmin extends Base {

		 var $sql = null;
		 
		  public function __construct() {
			 $this->sql = new SQL;
		 }
		 
		 public function get($formvars = array(), $field = "") {
				 
			$sql="SELECT *";
			$sql.=" FROM admin";
			$sql.=" WHERE 1";

			$sql.=" AND admin_login='".$formvars['login']."'";
			$sql.=" AND admin_mdp=MD5('".$formvars['password']."')";
					 
			if(empty($field)) {
				$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
				return $this->sql->getRecord();
			}
			else {
				$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
				return $this->sql->getRecord($field);
			}  
		}

	}
?>
