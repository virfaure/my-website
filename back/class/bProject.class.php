<?php
class bProject {

    private $sql = null;
   
    public function __construct() {
		$this->sql = new SQL;
    }
		
	//table Project
	public function get($formvars = array(),$field = "") {
		$sql="SELECT *, DATE_FORMAT(project_date, '%d/%m/%Y') as project_date_iso";
		$sql.=" FROM project p, status s";
		$sql.=" WHERE 1";
		$sql.=" AND p.status_id = s.status_id";
		
		if(!empty($formvars['project_id'])) $sql.=" AND p.project_id='".$formvars['project_id']."'";

		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			return $this->sql->getRecord();
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		} 			
    }
	
	public function getOne($formvars = array(), $field = "") {
		$records = $this->get($formvars, $field);
		return $records[0];		
    }
		
		
	//table Project_Image_type
	public function getImageType($formvars = array(),$field = "") {
		$sql="SELECT *";
		$sql.=" FROM project_image_type";
		$sql.=" WHERE 1";
		
		if(!empty($formvars['project_image_type_value'])) $sql.=" AND project_image_type_value='".$formvars['project_image_type_value']."'";
		if(!empty($formvars['project_image_type_id'])) $sql.=" AND project_image_type_id='".$formvars['project_image_type_id']."'";

		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			return $this->sql->getRecord();
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		} 			
    }	
	
	//table Project_Image
	public function getImage($formvars = array(),$field = "") {
		$sql="SELECT *";
		$sql.=" FROM project_image";
		$sql.=" WHERE 1";
		
		if(!empty($formvars['project_id'])) $sql.=" AND project_id='".$formvars['project_id']."'";
		if(!empty($formvars['project_image_type_id'])) $sql.=" AND project_image_type_id='".$formvars['project_image_type_id']."'";

		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			$arrRecords = $this->sql->getRecord();
			if(!empty($arrRecords)) {
				foreach($arrRecords as $value) {
					$arrRecords2[$value['project_image_type_id']] = $value;
				}
				return $arrRecords2;
			}else{
				return $arrRecords;
			}
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		} 			
    }	
	
	//table Project_Language
	public function getTraduction($formvars = array(),$field = "") {
		$sql="SELECT *";
		$sql.=" FROM project_language";
		$sql.=" WHERE 1";
		
		if(!empty($formvars['project_id'])) $sql.=" AND project_id='".$formvars['project_id']."'";
		if(!empty($formvars['language_id'])) $sql.=" AND language_id='".$formvars['language_id']."'";

		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			//return $this->sql->getRecord();
			$arrTxt2 = $this->sql->getRecord();
			foreach($arrTxt2 as $value) {
				$arr2[$value['language_id']] = $value;
			}
			return $arr2;
			
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		} 			
    }	
		
		
		function add($formvars = array()){
			$sql="INSERT INTO project SET";
			$sql.=" project_date = '".$formvars['project_date']."',";
			$sql.=" project_name = '".$this->sql->escapeMDB2($formvars['project_name'])."',";
			$sql.=" project_url = '".$formvars['project_url']."'";
			$this->sql->query($sql);
			
			$idProj = $this->sql->getLastInsertID();
			
			if(!empty($formvars['project_image'])){
				//Images
				foreach($formvars['project_image'] as $key => $data){
					$sql="INSERT INTO project_image SET";
					$sql.=" project_image_type_id='".$key."',";
					$sql.=" project_image_url='".$data['project_image_url']."',";
					$sql.=" project_image_width='".$data['project_image_width']."',";
					$sql.=" project_image_height='".$data['project_image_height']."',";
					$sql.=" project_image_size='".$data['project_image_size']."',";
					$sql.=" project_id='".$idProj."'";
					$this->sql->query($sql);	
				}
			 }
			 
			 if(!empty($formvars['project_language'])){
				// Traductions
				foreach($formvars['project_language'] as $key => $data){
					$sql="INSERT INTO project_language SET";
					$sql.=" language_id='".$data."',";
					if(!empty($data['project_caption'])) 			$sql.=" project_caption='".$this->sql->escapeMDB2($formvars['project_caption'][$data])."',";
					if(!empty($data['project_description'])) 		$sql.=" project_description='".$this->sql->escapeMDB2($formvars['project_description'][$data])."',";
					if(!empty($data['project_work'])) 				$sql.=" project_work='".$this->sql->escapeMDB2($formvars['project_work'][$data])."',";
					$sql.=" project_id='".$idProj."'";
					$this->sql->query($sql);
				}
			}
		}
		
		public function update($formvars = array()){
			
			/*echo '<pre>';
				print_r($formvars);
			echo '</pre>';
			exit();*/
			
			$sql="UPDATE project SET";
			$sql.=" project_date = '".$formvars['project_date']."',";
			$sql.=" project_name = '".$this->sql->escapeMDB2($formvars['project_name'])."',";
			$sql.=" project_url = '".$formvars['project_url']."'";
			$sql.=" WHERE project_id=".$formvars['project_id'];
			$this->sql->query($sql);

			if(!empty($formvars['project_image'])){
				//Images
				foreach($formvars['project_image'] as $key => $data){
					
					$arrImage = $this->getImage(array("project_id" => $formvars['project_id'], "project_image_type_id" => $key));
					
					if(!empty($arrImage)){
						
						if(!empty($data)){
							$sql="UPDATE project_image SET";
							$sql.=" project_image_url='".$data['project_image_url']."',";
							$sql.=" project_image_width='".$data['project_image_width']."',";
							$sql.=" project_image_height='".$data['project_image_height']."',";
							$sql.=" project_image_size='".$data['project_image_size']."'";
							$sql.=" WHERE project_id='".$formvars['project_id']."'";
							$sql.=" AND project_image_type_id='".$key."'";
							$this->sql->query($sql);
						}else{
							$sql="DELETE FROM project_image";
							$sql.=" WHERE project_id=".$formvars['project_id'];
							$sql.=" AND project_image_type_id=".$key;
							$this->sql->query($sql);
						}
						
					}else{
						if(!empty($data)){
							$sql="INSERT INTO project_image SET";
							$sql.=" project_image_type_id='".$key."',";
							$sql.=" project_image_url='".$data['project_image_url']."',";
							$sql.=" project_image_width='".$data['project_image_width']."',";
							$sql.=" project_image_height='".$data['project_image_height']."',";
							$sql.=" project_image_size='".$data['project_image_size']."',";
							$sql.=" project_id='".$formvars['project_id']."'";
							$this->sql->query($sql);
						}
					}	
				}
			}
						
			if(!empty($formvars['project_language'])){
			
				//Traductions
				foreach($formvars['project_language'] as $key => $data){
				
					$arrProj = $this->getTraduction(array("project_id" => $formvars['project_id'], "language_id" => $data));
				
					if(!empty($arrProj)){	
						$sql="UPDATE project_language SET";
						
						if(!empty($data['project_caption'])) 		$sql.=" project_caption='".$this->sql->escapeMDB2($formvars['project_caption'][$data])."',";
						if(!empty($data['project_description'])) 	$sql.=" project_description='".$this->sql->escapeMDB2($formvars['project_description'][$data])."',";
						if(!empty($data['project_work'])) 			$sql.=" project_work='".$this->sql->escapeMDB2($formvars['project_work'][$data])."'";
						
						$sql.=" WHERE project_id = ".$formvars['project_id'];
						$sql.=" AND language_id = '".$data."'";
						
						$this->sql->query($sql);
					}else{
						$sql="INSERT INTO project_language SET";
						$sql.=" language_id = '".$data."', ";
						if(!empty($data['project_caption'])) 		$sql.=" project_caption='".$this->sql->escapeMDB2($formvars['project_caption'][$data])."',";
						if(!empty($data['project_description'])) 	$sql.=" project_description='".$this->sql->escapeMDB2($formvars['project_description'][$data])."',";
						if(!empty($data['project_work'])) 			$sql.=" project_work='".$this->sql->escapeMDB2($formvars['project_work'][$data])."',";
						$sql.=" project_id = ".$formvars['project_id'];
						
						$this->sql->query($sql);
					}
					
				}	
			}				
		}
		
		
		public function delete($formvars = array()){
			$sql="DELETE FROM project";
			$sql.=" WHERE project_id=".$formvars['project_id']." LIMIT 1";
			$this->sql->query($sql);

			$sql="DELETE FROM project_language";
			$sql.=" WHERE project_id=".$formvars['project_id'];

			$sql="DELETE FROM project_image";
			$sql.=" WHERE project_id=".$formvars['project_id'];

			//$this->sql->query($sql);
		}	
}
?>
