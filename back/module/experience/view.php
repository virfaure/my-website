<?php

//Object Back
$objExp = new bExperience();

// Arrays
$arrData = array();


// VIEW : Get Data
if(!empty($_GET['id'])){
	$arrExperience = $objExp->getOne(array("experience_id" => $_GET['id']));
	
	if(!empty($arrExperience)){
		$arrExperienceTraduction = $objExp->getTraduction(array("experience_id" => $_GET['id']));

		$arrData['experience'] = $arrExperience;
		$arrData['experience_traduction'] = $arrExperienceTraduction;	
		
	}else{
		header('Location: list.php?module='.$module);
		exit();
	}
}else{
	//return to list
	header('Location: list.php?module='.$module);
	exit();
}


/*********************************************************************************/
//Status List
$objStatus = new Status();
$arrStatus = $objStatus->get();


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
					<span class="box-valid">Experience <?=$arrData['experience']['experience_id']?> has been updated successfully.</span>
					<br />
				<? }else{ ?>	
					<!-- Message Create --->
					<br />
					<span class="box-valid">Experience <?=$arrData['experience']['experience_id']?> has been created successfully.</span>
					<br />
				<? } ?>	
		<? } ?>

		<!-- Title H1 -->
		<h1>Experience <?=$arrData['experience']['experience_date_from_iso']?></h1>
		<hr />
		
		<table class="no-style full">
			<tbody>
				<tr>
					<td width="15%">From Date :</td>
					<td><? if(!empty($arrData['experience']['experience_date_from_iso'])){echo $arrData['experience']['experience_date_from_iso'];}else{echo '';} ?></td>
				</tr>
				<tr>
					<td>To Date :</td>
					<td><? if(!empty($arrData['experience']['experience_date_to_iso'])){echo $arrData['experience']['experience_date_to_iso'];}else{echo '';} ?></td>
				</tr>
				<tr>
					<td>Type :</td>
					<td><? if(!empty($arrData['experience']['experience_type'])){echo $arrData['experience']['experience_type'];}else{echo '';} ?></td>
				</tr>
				<tr>
					<td>Status :</td>
					<td><? if(!empty($arrData['experience']['status_name'])){echo $arrData['experience']['status_name'];}else{echo '';} ?></td>
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
										<div class="bold">Title : </div>
										<span>	
											<? if(!empty($arrData['experience_traduction'][$data['language_id']]['experience_title'])){echo $arrData['experience_traduction'][$data['language_id']]['experience_title'];}else{echo '';} ?>
										</span>
									</p>
									
									<p>
										<div class="bold">Place :</div>
										<span>	
											<? if(!empty($arrData['experience_traduction'][$data['language_id']]['experience_place'])){echo $arrData['experience_traduction'][$data['language_id']]['experience_place'];}else{echo '';} ?>
										</span>
									</p>
								
									<p>
										<div class="bold">Description : </div>
										<span>	
											<? if(!empty($arrData['experience_traduction'][$data['language_id']]['experience_description'])){echo $arrData['experience_traduction'][$data['language_id']]['experience_description'];}else{echo '';} ?>
										</span>
									</p>

									<br />
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