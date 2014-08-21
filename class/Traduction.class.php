<?php

class Traduction {

    private $sql = null;
   
    public function __construct() {
		$this->sql = new SQL;
    }
   
    public function get($formvars = array(), $field = "") {
       
		$sql="SELECT traduction_key, traduction_text";
		$sql.=" FROM traduction_language tl, traduction t";

		if(!empty($formvars['page_id'])) $sql.=" LEFT JOIN traduction_page tp ON (tp.traduction_id = t.traduction_id)";
		if(!empty($formvars['list_page_id'])) $sql.=" LEFT JOIN traduction_page tp ON (tp.traduction_id = t.traduction_id AND tp.page_id IN ('".$formvars['list_page_id']."'))";

		$sql.=" WHERE 1";
		$sql.=" AND t.traduction_id = tl.traduction_id ";

		if(!empty($formvars['language_id'])) $sql.=" AND language_id='".$formvars['language_id']."'";
		else $sql.=" AND language_id='".$_SESSION['language_id']."'";
		
		if(!empty($formvars['traduction_key'])) $sql.=" AND t.traduction_key='".$formvars['traduction_key']."'";
		if(!empty($formvars['page_id'])) $sql.=" AND tp.page_id='".$formvars['page_id']."'";

		//	echo $sql . "<br /><br />";

		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			$arrTxt = $this->sql->getRecord();
			foreach($arrTxt as $value) {
				$arr[$value['traduction_key']] = $value['traduction_text'];
			}
			if(!empty($arr)) return $arr;
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		}  			
    }
	
	public function getForBack($formvars = array(), $field = "") {
       
		$sql="SELECT *";
		$sql.=" FROM traduction_language tl, traduction t";
		$sql.=" LEFT JOIN traduction_page tp ON (tp.traduction_id = t.traduction_id)";
		
		if(!empty($formvars['list_page_id'])) $sql.=" LEFT JOIN traduction_page tp ON (tp.traduction_id = t.traduction_id AND tp.page_id IN ('".$formvars['list_page_id']."'))";

		$sql.=" WHERE 1";
		$sql.=" AND t.traduction_id = tl.traduction_id ";

		if(!empty($formvars['language_id'])) $sql.=" AND language_id='".$formvars['language_id']."'";
		else $sql.=" AND language_id='1'";
		
		if(!empty($formvars['traduction_key'])) $sql.=" AND t.traduction_key='".$formvars['traduction_key']."'";
		if(!empty($formvars['page_id'])) $sql.=" AND tp.page_id='".$formvars['page_id']."'";

		//	echo $sql . "<br /><br />";

		if(empty($field)) {
			$this->sql->query($sql,SQL_ALL,SQL_ASSOC);
			return $this->sql->getRecord();
		}else {
			$this->sql->query($sql,SQL_INIT,SQL_ASSOC);
			return $this->sql->getRecord($field);
		}  			
    }
	
	// GET one record
	public function getOne($traduction_key, $replaceTag = true, $tags = array()) {
		return $this->get(array('traduction_key' => $traduction_key), 'traduction_text');
	}
}
?>
