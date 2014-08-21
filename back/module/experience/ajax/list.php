<?php 

	/**************************************************************************/
	// AJAX Build List
	// file called by the dataTables Jquery in list.php to load data
	/**************************************************************************/
		
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/config.php');
		
	$objExp = new bExperience();
	$arrExp = $objExp->get();
	
	$objLang = new Language();
	$arrLanguage = $objLang->get();
	
	$module = $_GET['module'];
	
	$output['aaData'] = array();	
		
	foreach($arrExp as $key => $data){
		$row = array();
		
		// O => hidden ID
		$row[] = $data['experience_id'];
	
		// 1 => Actions (view, update..)
		$action_view  = '<a href="view.php?module='.$module.'&id='.$data['experience_id'].'"><img alt="view" title="View" src="theme/img/view.gif" /></a>';
		$action_update  = '<a href="form.php?module='.$module.'&id='.$data['experience_id'].'"><img alt="update" title="Update" src="theme/img/update.gif" /></a>';
		$action_delete  = '<a href="module/'.$module.'/ajax/delete.php?module='.$module.'&id='.$data['experience_id'].'" class="ajaxDeleteRow"  title="delete-row"><img alt="delete" title="Delete" src="theme/img/delete.gif" /></a>';
		
		$row[] =  '<span class="iconAction">'.$action_view.$action_update.$action_delete.'</span>';
		
		// 2 => Type
		$row[] = $data['experience_type'];
		
		// 3 => Date From
		$row[] = $data['experience_date_from_iso'];
		
		// 4 => Date From
		$row[] = $data['experience_date_to_iso'];
		
		// 5 => Company
		$row[] = $data['experience_company'];
		
		//6 => Language
		$row_lang = '<span class="iconAction">';
		foreach($arrLanguage as $key => $lang){
			$traductionExperience = $objExp->getTraduction(array("experience_id" => $data['experience_id'], "language_id" => $lang['language_id']), "experience_description");
			if(empty($traductionExperience)) $class = "class='opacity-20'";
			else $class = "";
			
			$row_lang  .= '<a style="text-decoration:none;margin:0 5px;" href="form.php?module='.$module.'&id='.$data['experience_id'].'#'.$lang['language_locale'].'"><img alt="update" title="Update" src="theme/img/'.$lang['language_locale'].'.gif" '.$class.' /></a>';
		}
		$row_lang .= '</span>';

		$row[] = $row_lang;
		
		
		//7 => Status ID HIdden
		$row[] = $data['status_id'];
		
		
		//8 => Status Name
		$row[] = $data['status_name'];
		
		
		$output['aaData'][] = $row;
	}

	
	echo json_encode( $output );
?>	