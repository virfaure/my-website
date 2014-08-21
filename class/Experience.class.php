<?php
class Experience {

    private $sql = null;
   
    public function __construct() {
      $this->sql = new SQL();
    }
   
    public function get($formvars = array(), $field = "") {
       
			$sql="SELECT *";
			$sql.=" FROM (experience e, experience_language el)";
			$sql.=" WHERE 1";
			$sql.=" AND e.experience_id= el.experience_id";
			
			if(!empty($formvars['experience_id'])) $sql.=" AND e.experience_id = '".$formvars['experience_id']."'";
			if(!empty($formvars['language_id'])) $sql.=" AND el.language_id = '".$formvars['language_id']."'";
			else $sql.=" AND pl.language_id = '".$_SESSION['language_id']."'";
			
			if(!empty($formvars['experience_type'])) $sql.=" AND e.experience_type = '".$formvars['experience_type']."'";
			
			$sql.=" ORDER BY e.experience_date_from ASC";
				
			if(empty($field)) {
				$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
				return $this->sql->getRecord();
			}else{
				$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
				return $this->sql->getRecord($field);
			}  
    }
}
?>
