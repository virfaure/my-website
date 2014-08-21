<?
	/**************************************************************************/
	// AJAX Delete
	// PARAMS $_GET : LINK in LIST
	/**************************************************************************/
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/config.php');
	
	$return = 'false';
	$message = '';
	
	if(!empty($_GET['id'])){
		$obj = new bTraduction();
		
		$contentID = $_GET['id'];	
		$arrContent = $obj->getOne(array("traduction_id" => $_GET['id']));

		if(!empty($arrContent)){
			$obj->delete(array("traduction_id" => $_GET['id']));
			$message = "Traduction deleted";
			$return = 'true';
		}else{
			$message = 'Content already deleted.';
		}
	}else{
		$message = 'Error deleting, please try again.';
	}
		
	echo $return."|".$message;
?>