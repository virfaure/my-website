<?php
class Project extends Base{

    private $sql = null;
   
    public function __construct() {
      $this->sql = new SQL();
    }
   
    public function get($formvars = array(), $field = "") {
       
			$sql="SELECT p.project_id, p.project_url, p.project_name, pl.project_caption, pl.project_description, pl.project_work, pi.project_image_url, pi.project_image_width, pi.project_image_height";
			$sql.=" FROM (project p, project_language pl)";
			$sql.=" LEFT JOIN project_image pi ON (p.project_id = pi.project_id)";
			$sql.=" WHERE 1";
			$sql.=" AND p.project_id= pl.project_id";
			
			if(!empty($formvars['project_id'])) $sql.=" AND p.project_id = '".$formvars['project_id']."'";
			
			if(!empty($formvars['language_id'])) $sql.=" AND pl.language_id = '".$formvars['language_id']."'";
			else $sql.=" AND pl.language_id = '".$_SESSION['language_id']."'";
			
			if(!empty($formvars['project_image_type_id'])) $sql.=" AND pi.project_image_type_id = '".$formvars['project_image_type_id']."'";
			
			$sql.=" ORDER BY p.project_date DESC";
			    
				
			if(empty($field)) {
				$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
				return $this->sql->getRecord();
			}else{
				$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
				return $this->sql->getRecord($field);
			}  
    }
   
   
    public function getImage($formvars = array(), $field = ""){
			$sql="SELECT * FROM project_image";
			$sql.=" WHERE 1";
			
			if(!empty($formvars['project_id'])) $sql.=" AND project_id = '".$formvars['project_id']."'";
			if(!empty($formvars['project_image_name'])) $sql.=" AND project_image_name = '".$formvars['project_image_name']."'";
			
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
