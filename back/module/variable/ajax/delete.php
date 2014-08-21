<?
	/**************************************************************************/
	// AJAX Delete
	// PARAMS $_GET : LINK in LIST
	/**************************************************************************/
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/config.php');
	
	$return = 'false';
	$message = '';
	
	if(!empty($_GET['id'])){
		$obj = new bVariable();
		
		$contentID = $_GET['id'];	
		$arrContent = $obj->getOne(array("variable_id" => $_GET['id']));

		if(!empty($arrContent)){
			$obj->delete(array("variable_id" => $_GET['id']));
			$message = "Variable ".$arrContent['variable_name']." deleted";
			$return = 'true';
		}else{
			$message = 'Content already deleted.';
		}
	}else{
		$message = 'Error deleting, please try again.';
	}
		
	echo $return."|".$message;
?>