<?php 

	/**************************************************************************/
	// AJAX Build List
	// file called by the dataTables Jquery in list.php to load data
	/**************************************************************************/
		
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/config.php');
	
	$objTrad = new Traduction();
	$arrText = $objTrad->getForBack();
	
	$objLang = new Language();
	$arrLanguage = $objLang->get();
	
	$module = $_GET['module'];
	
	$objPage= new Page();
	
	$output['aaData'] = array();	
	
	foreach($arrText as $key => $data){
		$row = array();
		
		// O => hidden ID
		$row[] = $data['traduction_id'];
	
		// 1 => Actions (view, update..)
		$action_view  = '<a href="view.php?module='.$module.'&id='.$data['traduction_id'].'"><img alt="view" title="View" src="theme/img/view.gif" /></a>';
		$action_update  = '<a href="form.php?module='.$module.'&id='.$data['traduction_id'].'"><img alt="update" title="Update" src="theme/img/update.gif" /></a>';
		$action_delete  = '<a href="module/'.$module.'/ajax/delete.php?module='.$module.'&id='.$data['traduction_id'].'" class="ajaxDeleteRow" title="delete-row"><img alt="delete" title="Delete" src="theme/img/delete.gif" /></a>';
		
		$row[] =  '<span class="iconAction">'.$action_view.$action_update.$action_delete.'</span>';
		
		// 2 => Key
		$row[] = $data['traduction_key'];
		
		// 3 => Containt
		$row[] = strip_tags(substr($data['traduction_text'], 0,100));
		
		$row_lang = '<span class="iconAction">';
		foreach($arrLanguage as $key => $lang){
			
			$traductionText = $objTrad->get(array("traduction_key" => $data['traduction_key'], "language_id" => $lang['language_id']), "traduction_text");
			if(empty($traductionText)) $class = "class='opacity-20'";
			else $class = "";
			
			$row_lang  .= '<a style="text-decoration:none;margin:0 5px;" href="form.php?module=text&id='.$data['traduction_id'].'#'.$lang['language_locale'].'"><img alt="update" title="Update" src="theme/img/'.$lang['language_locale'].'.gif" '.$class.' /></a>';
		}
		$row_lang .= '</span>';
	
		//4 => Language
		$row[] = $row_lang;
		
		//5 => Page ID HIdden
		$row[] = $data['page_id'];
		
		//5 => Page Name
		$row[] = $objPage->get(array("page_id" => $data['page_id']), "page_name");
		
		$output['aaData'][] = $row;
	}

	
	echo json_encode( $output );
?>	