<?
	/**************************************************************************/
	// AJAX Delete
	// PARAMS $_GET : LINK in LIST
	/**************************************************************************/
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/config.php');
	
	$return = 'false';
	$message = '';
	
	if(!empty($_GET['id'])){
		$obj = new bProject();
		
		$contentID = $_GET['id'];	
		$arrContent = $obj->getOne(array("project_id" => $_GET['id']));

		if(!empty($arrContent)){
			$message = "Project ".$arrContent["project_name"]." deleted.";
			$obj->delete(array("project_id" => $_GET['id']));
			$return = 'true';
		}else{
			$message = 'Project does not exist.';
		}
	}else{
		$message = 'Error deleting, please try again.';
	}
		
	echo $return."|".$message;
?>