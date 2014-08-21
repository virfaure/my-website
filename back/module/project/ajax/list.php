<?php 

	/**************************************************************************/
	// AJAX Build List
	// file called by the dataTables Jquery in list.php to load data
	/**************************************************************************/
		
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/config.php');
	
	$objProj = new bProject();
	$arrProj = $objProj->get();
	
	$objLang = new Language();
	$arrLanguage = $objLang->get();
	
	$module = $_GET['module'];
	
	$output['aaData'] = array();	
	
	foreach($arrProj as $key => $data){
		$row = array();
		
		// O => hidden ID
		$row[] = $data['project_id'];
	
		// 1 => Actions (view, update..)
		$action_view  = '<a href="view.php?module='.$module.'&id='.$data['project_id'].'"><img alt="view" title="View" src="theme/img/view.gif" /></a>';
		$action_update  = '<a href="form.php?module='.$module.'&id='.$data['project_id'].'"><img alt="update" title="Update" src="theme/img/update.gif" /></a>';
		$action_delete  = '<a href="module/'.$module.'/ajax/delete.php?module='.$module.'&id='.$data['project_id'].'" class="ajaxDeleteRow" title="delete-row"><img alt="delete" title="Delete" src="theme/img/delete.gif" /></a>';
		
		$row[] =  '<span class="iconAction">'.$action_view.$action_update.$action_delete.'</span>';
		
		// 2 => Name
		$row[] = $data['project_name'];
		
		// 3 => Url
		$row[] = $data['project_url'];
		
		//4 => Language
		$row_lang = '<span class="iconAction">';
		foreach($arrLanguage as $key => $lang){
			$row_lang  .= '<a style="text-decoration:none;margin:0 5px;" href="form.php?module='.$module.'&id='.$data['project_id'].'#'.$lang['language_locale'].'"><img alt="update" title="Update" src="theme/img/'.$lang['language_locale'].'.gif" /></a>';
		}
		$row_lang .= '</span>';

		$row[] = $row_lang;
		
		
		//5 => Status ID HIdden
		$row[] = $data['status_id'];
		
		
		//6 => Status Name
		$row[] = $data['status_name'];
		
		//7 => Date
		$row[] = $data['project_date_iso'];
		
		
		$output['aaData'][] = $row;
	}

	
	echo json_encode( $output );
?>	