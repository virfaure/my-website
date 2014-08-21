<?php
class bExperience extends Base{

    private $sql = null;
   
    public function __construct() {
		$this->sql = new SQL;
    }
		
	//table Experience
	public function get($formvars = array(), $field = "") {
		$sql="SELECT *, DATE_FORMAT(experience_date_from, '%d/%m/%Y') as experience_date_from_iso, IF(experience_date_to != 'NULL', DATE_FORMAT(experience_date_to, '%d/%m/%Y'), '') as experience_date_to_iso";
		$sql.=" FROM experience e, status s";
		$sql.=" WHERE 1";
		$sql.=" AND e.status_id = s.status_id";
		
		if(!empty($formvars['experience_id'])) $sql.=" AND e.experience_id='".$formvars['experience_id']."'";

		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			return $this->sql->getRecord();
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		} 			
    }
	
	
	//table Experience_Language
	public function getTraduction($formvars = array(),$field = "") {
		$sql="SELECT *";
		$sql.=" FROM experience_language";
		$sql.=" WHERE 1";
		
		if(!empty($formvars['experience_id'])) $sql.=" AND experience_id='".$formvars['experience_id']."'";
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
		
		
	public function add($formvars = array()){
			
			if(empty($formvars['experience_date_to'])) $formvars['experience_date_to'] = NULL;
			
			$sql="INSERT INTO experience SET";
			$sql.=" experience_date_from = '".$formvars['experience_date_from']."',";
			if(empty($formvars['experience_date_to'])) $sql.=" experience_date_to = NULL,";
			else $sql.=" experience_date_to = '".$formvars['experience_date_to']."',";
			$sql.=" experience_company = '".$this->sql->escapeMDB2($formvars['experience_company'])."',";
			$sql.=" experience_type = '".$formvars['experience_type']."',";
			$sql.=" status_id = '".$formvars['status_id']."'";
			$this->sql->query($sql);
			
			$idExp = $this->sql->getLastInsertID();
			
			
			// Traductions
			foreach($formvars['experience_language'] as $key => $data){
				$sql="INSERT INTO experience_language SET";
				$sql.=" language_id='".$data."',";
				
				if(!empty($data['experience_title'])) 			$sql.=" experience_title='".$this->sql->escapeMDB2($formvars['experience_title'][$data])."',";
				if(!empty($data['experience_description'])) 	$sql.=" experience_description='".$this->sql->escapeMDB2($formvars['experience_description'][$data])."',";
				if(!empty($data['experience_place'])) 			$sql.=" experience_place='".$this->sql->escapeMDB2($formvars['experience_place'][$data])."',";
				
				$sql.=" experience_id='".$idExp."'";
				$this->sql->query($sql);
			}
		}
		
	public function update($formvars = array()){
			if(empty($formvars['experience_date_to'])) $formvars['experience_date_to'] = 'NULL';
			
			$sql="UPDATE experience SET";
			$sql.=" experience_date_from = '".$formvars['experience_date_from']."',";
			if(empty($formvars['experience_date_to'])) $sql.=" experience_date_to = NULL,";
			else $sql.=" experience_date_to = '".$formvars['experience_date_to']."',";
			$sql.=" experience_company = '".$this->sql->escapeMDB2($formvars['experience_company'])."',";
			$sql.=" experience_type = '".$formvars['experience_type']."'";
			$sql.=" WHERE experience_id=".$formvars['experience_id'];
			$this->sql->query($sql);

			//langue ?
			foreach($formvars['experience_language'] as $key => $data){
				$arrExp = $this->getTraduction(array("experience_id" => $formvars['experience_id'], "language_id" => $data));			
				
				if(!empty($arrExp)){	
					$sql="UPDATE experience_language SET";
					
					if(!empty($data['experience_title'])) 			$sql.=" experience_title='".$this->sql->escapeMDB2($formvars['experience_title'][$data])."',";
					if(!empty($data['experience_description'])) 	$sql.=" experience_description='".$this->sql->escapeMDB2($formvars['experience_description'][$data])."',";
					if(!empty($data['experience_place'])) 			$sql.=" experience_place='".$this->sql->escapeMDB2($formvars['experience_place'][$data])."'";
					
					$sql.=" WHERE experience_id = ".$formvars['experience_id'];
					$sql.=" AND language_id = '".$data."'";
					$this->sql->query($sql);
				}else{
					$sql="INSERT INTO experience_language SET";
					$sql.=" language_id='".$data."',";
					
					if(!empty($data['experience_title'])) 			$sql.=" experience_title='".$this->sql->escapeMDB2($formvars['experience_title'][$data])."',";
					if(!empty($data['experience_description'])) 	$sql.=" experience_description='".$this->sql->escapeMDB2($formvars['experience_description'][$data])."',";
					if(!empty($data['experience_place'])) 			$sql.=" experience_place='".$this->sql->escapeMDB2($formvars['experience_place'][$data])."',";
					
					$sql.=" experience_id='".$formvars['experience_id']."'";
					$this->sql->query($sql);
				}
			}	 
		}
		
	public function delete($formvars = array()){
		$sql="DELETE FROM experience";
		$sql.=" WHERE experience_id=".$formvars['experience_id']." LIMIT 1";
		$this->sql->query($sql);
		
		$sql="DELETE FROM experience_language";
		$sql.=" WHERE experience_id=".$formvars['experience_id'];
		$this->sql->query($sql);
	}	
}
?>
