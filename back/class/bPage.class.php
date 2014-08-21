<?php
class bPage extends Base {

    private $sql = null;
   
    public function __construct() {
		$this->sql = new SQL;
    }
		
	public function get($formvars = array(),$field = "") {
       
		$sql="SELECT *";
		$sql.="FROM page AS p, status AS s";
		$sql.=" WHERE 1";
		$sql.=" AND p.status_id = s.status_id";

		if(!empty($formvars['page_id'])) $sql.=" AND page_id='".$formvars['page_id']."'";
		if(!empty($formvars['page_name'])) $sql.=" AND page_name='".$formvars['page_name']."'";
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
		$sql="INSERT INTO page SET";
		$sql.=" page_name='".$formvars['page_name']."'";
		$this->sql->query($sql);
		
		$idElem = $this->sql->getLastInsertID();
		
		return $idElem;
	}
		
	function update($formvars = array()){
		$sql="UPDATE page SET";
		$sql.=" page_name='".$formvars['page_name']."'";
		$sql.=" WHERE page_id=".$formvars['page_id'];
		$this->sql->query($sql);
	}

	function delete($formvars = array()){
		$sql="DELETE FROM page";
		$sql.=" WHERE page_id=".$formvars['page_id']." LIMIT 1";
		$this->sql->query($sql);
	}
		 
}
?>
