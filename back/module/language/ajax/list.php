<?php 

	/**************************************************************************/
	// AJAX Build List
	// file called by the dataTables Jquery in list.php to load data
	/**************************************************************************/
		
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/config.php');
		
	$objLang = new bLanguage();
	$arrLanguage = $objLang->get();
	
	$module = $_GET['module'];
	
	$output['aaData'] = array();	
	
	foreach($arrLanguage as $key => $data){
		$row = array();
		
		// O => hidden ID
		$row[] = $data['language_id'];
	
		// 1 => Actions (view, update..)
		$action_view  = '<a href="view.php?module='.$module.'&id='.$data['language_id'].'"><img alt="view" title="View" src="theme/img/view.gif" /></a>';
		$action_update  = '<a href="form.php?module='.$module.'&id='.$data['language_id'].'"><img alt="update" title="Update" src="theme/img/update.gif" /></a>';
		$action_delete  = '<a href="module/'.$module.'/ajax/delete.php?module='.$module.'&id='.$data['language_id'].'" class="ajaxDeleteRow" title="delete-row"><img alt="delete" title="Delete" src="theme/img/delete.gif" /></a>';
		
		$row[] =  '<span class="iconAction">'.$action_view.$action_update.$action_delete.'</span>';
		
		// 2 => Name
		$row[] = $data['language_name'];
		
		// 3 => Locale
		$row[] = $data['language_locale'];

		// 4 => Image
		$row[] = '<img alt="update" title="Update" src="theme/img/'.$data['language_locale'].'.gif" />';
		
		// 5 => Status ID
		$row[] = $data['status_id'];
		
		// 3 => Status
		$row[] = $data['status_name'];
		
		$output['aaData'][] = $row;
	}

	
	echo json_encode( $output );
?>	