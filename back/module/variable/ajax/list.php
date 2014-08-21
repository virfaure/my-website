<?php 

	/**************************************************************************/
	// AJAX Build List
	// file called by the dataTables Jquery in list.php to load data
	/**************************************************************************/
		
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/config.php');
		
	$objVariable = new bVariable();
	$arrVariable = $objVariable->get();
	
	$module = $_GET['module'];
	
	$output['aaData'] = array();	
	
	foreach($arrVariable as $key => $data){
		$row = array();
		
		// O => hidden ID
		$row[] = $data['variable_id'];
	
		// 1 => Actions (view, update..)
		$action_view  = '<a href="view.php?module='.$module.'&id='.$data['variable_id'].'"><img alt="view" title="View" src="theme/img/view.gif" /></a>';
		$action_update  = '<a href="form.php?module='.$module.'&id='.$data['variable_id'].'"><img alt="update" title="Update" src="theme/img/update.gif" /></a>';
		$action_delete  = '<a href="module/'.$module.'/ajax/delete.php?module='.$module.'&id='.$data['variable_id'].'" class="ajaxDeleteRow" title="delete-row"><img alt="delete" title="Delete" src="theme/img/delete.gif" /></a>';
		
		$row[] =  '<span class="iconAction">'.$action_view.$action_update.$action_delete.'</span>';
		
		// 2 => Name
		$row[] = $data['variable_name'];
		
		// 3 => Value
		$row[] = $data['variable_value'];
		
		$output['aaData'][] = $row;
	}

	
	echo json_encode( $output );
?>	