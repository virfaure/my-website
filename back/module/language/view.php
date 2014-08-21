<?php

//Object Back
$objLang = new bLanguage();

// Arrays
$arrData = array();


// VIEW : Get Data
if(!empty($_GET['id'])){
	$arrLanguage = $objLang->getOne(array("language_id" => $_GET['id']));
	$arrData['language'] = $arrLanguage;
}else{
	//return to list
	header('Location: list.php?module='.$module);
	exit();
}


/*********************************************************************************/
//Status List
$objStatus = new Status();
$arrStatus = $objStatus->get();

?>

<!-- Headers -->
<? include SITE_DIR.'/back/include/header.php'; ?>
					
<!-- Module Content -->
<div id="moduleContent" class="wrapper">
			
	<!-- View-->
	<div id="record">
				
		<?php 
			if(!empty($_GET['action'])){

				if($_GET['action'] == 'update'){ ?>
					<!-- Message Update --->
					<br />
					<span class="box-valid">Language <?=$arrData['language']['language_name']?> has been updated successfully.</span>
					<br />
				<? }else{ ?>	
					<!-- Message Create --->
					<br />
					<span class="box-valid">Language <?=$arrData['language']['language_name']?> has been created successfully.</span>
					<br />
				<? } ?>	
		<? } ?>

		<!-- Title H1 -->
		<h1><?=$arrData['language']['language_name']?></h1>
		<hr />
		
		<table class="no-style full">
			<tbody>
				<tr>
					<td width="15%">Name :</td>
					<td><? if(!empty($arrData['language']['language_name'])){echo $arrData['language']['language_name'];}else{echo '';} ?></td>
				</tr>
				<tr>
					<td>Locale :</td>
					<td><? if(!empty($arrData['language']['language_locale'])){echo $arrData['language']['language_locale'];}else{echo '';} ?></td>
				</tr>
				<tr>
					<td>Image :</td>
					<td><? if(!empty($arrData['language']['language_locale'])){echo '<img alt="image" title="image" src="theme/img/'.$arrData['language']['language_locale'].'.gif" />';}else{echo '';} ?></td>
				</tr>
				
				<tr>
					<td>Status :</td>
					<td><? if(!empty($arrData['language']['status_name'])){echo $arrData['language']['status_name'];}else{echo '';} ?></td>
				</tr>
			</tbody>	
		</table>
		
		<br />
		
		<!-- buttons -->
		<p class="box buttons buttons-form">
			<input type="button" class="btn small go-list"value="Back to list" /> 
			<input type="hidden" value="<? if(!empty($_GET['id'])){echo $_GET['id'];}else{echo '';} ?>" name="content_id" id="content_id">
			<input type="submit" class="btn btn-pink big go-form" value="<? if(!empty($_GET['id'])){echo 'Update';}else{echo 'Create';} ?>" />
		</p>
		
	</div>	
		
</div ><!-- End div wrapper-->