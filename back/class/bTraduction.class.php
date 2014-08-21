<?php

class bTraduction extends Base{

    private $sql = null;
   
    public function __construct() {
		$this->sql = new SQL;
    }
	
	// Table traduction
	public function get($formvars = array(), $field = ""){
		$sql="SELECT t.traduction_id, traduction_key, page_id FROM traduction t";
		$sql.=" LEFT JOIN traduction_page tp ON (tp.traduction_id = t.traduction_id)";
		
		//if(!empty($formvars['list_page_id'])) $sql.=" LEFT JOIN traduction_page tp ON (tp.traduction_id = t.traduction_id AND tp.page_id IN ('".$formvars['list_page_id']."'))";

		$sql.=" WHERE 1";
		
		if(!empty($formvars['traduction_id'])) $sql.=" AND t.traduction_id='".$formvars['traduction_id']."'";
		if(!empty($formvars['traduction_key'])) $sql.=" AND t.traduction_key='".$formvars['traduction_key']."'";
		if(!empty($formvars['page_id'])) $sql.=" AND tp.page_id='".$formvars['page_id']."'";


		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			return $this->sql->getRecord();
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		}  			
	}

	
	//Table traduction_language
	public function getText($formvars = array(), $field = "") {
	
		$sql="SELECT traduction_language_id, traduction_id, language_id, traduction_text";
		$sql.=" FROM traduction_language ";
		$sql.=" WHERE 1";
		$sql.=" AND traduction_id = ".$formvars['traduction_id'];

		if(!empty($formvars['language_id'])) $sql.=" AND language_id='".$formvars['language_id']."'";
		
		//echo $sql . "<br /><br />";

		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			$arrTxt2 = $this->sql->getRecord();
			foreach($arrTxt2 as $value) {
				$arr2[$value['language_id']] = $value['traduction_text'];
			}
			return $arr2;
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		}  				
    }
	
	
	public function add($formvars = array()){
		
		$sql="INSERT INTO traduction SET traduction_key='".$formvars['traduction_key']."'";
		$this->sql->query($sql);
		$idElem = $this->sql->getLastInsertID();
		
		// Page
		if(!empty($formvars['page_id'])){ 
			$sql="INSERT INTO traduction_page SET";
			$sql.=" page_id='".$formvars['page_id']."',";
			$sql.=" traduction_id='".$idElem."'";
			$this->sql->query($sql);
		}
		
		// Text
		foreach($formvars['traduction_text'] as $key => $data){
			$sql="INSERT INTO traduction_language SET";
			$sql.=" language_id='".$key."',";
			$sql.=" traduction_text='".$this->sql->escapeMDB2($data)."',";
			$sql.=" traduction_id='".$idElem."'";
			$this->sql->query($sql);
		}
		
		return $idElem;
	}
	
	
	public function update($formvars = array()){
		
		$sql="UPDATE traduction SET";
		$sql.=" traduction_key='".$formvars['traduction_key']."'";
		$sql.=" WHERE traduction_id=".$formvars['traduction_id'];
		$this->sql->query($sql);

		// Page
		if(!empty($formvars['page_id'])){ 
			$sql="UPDATE traduction_page SET";
			$sql.=" page_id='".$formvars['page_id']."'";
			$sql.=" WHERE traduction_id=".$formvars['traduction_id'];
			$this->sql->query($sql);
		}
		
		//langue ?
		foreach($formvars['traduction_text'] as $key => $data){
			$arrText = $this->getText(array("traduction_id" => $formvars['traduction_id'], "language_id" => $key));
			
			if(!empty($arrText)){			
				$sql="UPDATE traduction_language SET";
				$sql.=" traduction_text='".$this->sql->escapeMDB2($data)."'";
				$sql.=" WHERE traduction_id=".$formvars['traduction_id'];
				$sql.=" AND language_id='".$key."'";
				$this->sql->query($sql);
			}else{
				$sql="INSERT INTO traduction_language SET";
				$sql.=" language_id='".$key."',";
				$sql.=" traduction_text='".$this->sql->escapeMDB2($data)."',";
				$sql.=" traduction_id='".$formvars['traduction_id']."'";
				$this->sql->query($sql);
			}
		}
	}
		
		
	public function delete($formvars = array()){
		$sql="DELETE FROM traduction";
		$sql.=" WHERE traduction_id=".$formvars['traduction_id']." LIMIT 1";

		$this->sql->query($sql);
		
		$sql="DELETE FROM traduction_language";
		$sql.=" WHERE traduction_id=".$formvars['traduction_id'];
	
	}		
}
?>
