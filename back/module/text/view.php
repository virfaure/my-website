<?php

//Object Back
$objTrad = new bTraduction();

// Arrays
$arrData = array();


// VIEW : Get Data
if(!empty($_GET['id'])){
	$arrTraduction = $objTrad->getOne(array("traduction_id" => $_GET['id']));
	
	$arrTraductionContenu = $objTrad->getText(array("traduction_id" => $_GET['id']));

	$arrData['traduction'] = $arrTraduction;
	$arrData['traduction_text'] = $arrTraductionContenu;
}else{
	//return to list
	header('Location: list.php?module='.$module);
	exit();
}


/*********************************************************************************/
//Page List
$objPage = new Page();
$arrPage = $objPage->get();


//Language List
$objLang = new Language();
$arrLanguage = $objLang->get();

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
					<span class="box-valid">Text <?=$arrData['traduction']['traduction_key']?> has been updated successfully.</span>
					<br />
				<? }else{ ?>	
					<!-- Message Create --->
					<br />
					<span class="box-valid">Text <?=$arrData['traduction']['traduction_key']?> has been created successfully.</span>
					<br />
				<? } ?>	
		<? } ?>

		<!-- Title H1 -->
		<h1><?=$arrData['traduction']['traduction_key']?></h1>
		<hr />
		
		<table class="no-style full">
			<tbody>
				<tr>
					<td width="15%">Traduction Key :</td>
					<td><? if(!empty($arrData['traduction']['traduction_key'])){echo $arrData['traduction']['traduction_key'];}else{echo '';} ?></td>
				</tr>
				<tr>
					<td>Page :</td>
					<td><? if(!empty($arrData['traduction']['page_id'])){echo $objPage->getOne(array("page_id" => $arrData['traduction']['page_id']), "page_name");}else{echo '';} ?></td>
				</tr>
				
				<tr>
					<td colspan="2">
						<div id="tabs">
							<ul>
								<?php foreach($arrLanguage as $key => $data){ ?>
									<li><a href="#tabs_<?=$data['language_id']?>">Content <img src="theme/img/<?=$data['language_locale']?>.gif" alt="<?=$data['language_locale']?>" /></a></li>
								<? } ?>
							</ul>
							
							<?php foreach($arrLanguage as $key => $data){ ?>
								<div id="tabs_<?=$data['language_id']?>" style="width: 975px;">
									<p>
										<? if(!empty($arrData['traduction_text'][$data['language_id']])){echo $arrData['traduction_text'][$data['language_id']];}else{echo '';} ?>
									</p>
								</div>
							<? } ?>
						</div>
					</td>
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