<?php

//Object Back
$objProj = new bProject();

// Arrays
$arrData = array();


// VIEW : Get Data
if(!empty($_GET['id'])){
	$arrProject = $objProj->getOne(array("project_id" => $_GET['id']));
	$arrProjectImage = array();
	$arrProjectTraduction = array();
	
	if(!empty($arrProject)){
		$arrProjectImage = $objProj->getImage(array("project_id" => $_GET['id']));
		$arrProjectTraduction = $objProj->getTraduction(array("project_id" => $_GET['id']));

		$arrData['project'] = $arrProject;
		$arrData['project_image'] = $arrProjectImage;
		$arrData['project_traduction'] = $arrProjectTraduction;	
	}
}else{
	//return to list
	header('Location: list.php?module='.$module);
	exit();
}


/*********************************************************************************/

//Language List
$objLang = new Language();
$arrLanguage = $objLang->get();

//Type Images 
$arrProjectImageType = $objProj->getImageType();

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
					<span class="box-valid">Project <?=$arrData['project']['project_name']?> has been updated successfully.</span>
					<br />
				<? }else{ ?>	
					<!-- Message Create --->
					<br />
					<span class="box-valid">Project <?=$arrData['project']['project_name']?> has been created successfully.</span>
					<br />
				<? } ?>	
		<? } ?>

		<!-- Title H1 -->
		<h1><?=$arrData['project']['project_name']?></h1>
		<hr />
		
		<table class="no-style full">
			<tbody>
				<tr>
					<td style="width:100px;">Date :</td>
					<td><? if(!empty($arrData['project']['project_date'])){echo $arrData['project']['project_date_iso'];}else{echo '';} ?></td>
				</tr>
				<tr>
					<td>Name :</td>
					<td><? if(!empty($arrData['project']['project_name'])){echo $arrData['project']['project_name'];}else{echo '';} ?></td>
				</tr>
				<tr>
					<td>Url :</td>
					<td><? if(!empty($arrData['project']['project_url'])){echo $arrData['project']['project_url'];}else{echo '';} ?></td>
				</tr>
				<tr>
					<td>Status :</td>
					<td><? if(!empty($arrData['project']['status_name'])){echo $arrData['project']['status_name'];}else{echo '';} ?></td>
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
										<div class="bold">Caption : </div>
										<span>	
											<? if(!empty($arrData['project_traduction'][$data['language_id']]['project_caption'])){echo $arrData['project_traduction'][$data['language_id']]['project_caption'];}else{echo '';} ?>
										</span>
									</p>
									
									<p>
										<div class="bold">Description :</div>
										<span>	
											<? if(!empty($arrData['project_traduction'][$data['language_id']]['project_description'])){echo $arrData['project_traduction'][$data['language_id']]['project_description'];}else{echo '';} ?>
										</span>
									</p>
								
									<p>
										<div class="bold">Work : </div>
										<span>	
											<? if(!empty($arrData['project_traduction'][$data['language_id']]['project_work'])){echo $arrData['project_traduction'][$data['language_id']]['project_work'];}else{echo '';} ?>
										</span>
									</p>

									<br />
								</div>
							<? } ?>
						</div>
					</td>
				</tr>
				
				<?php foreach($arrProjectImageType as $key => $data){ 
						if(!empty($arrData['project_image'][$data['project_image_type_id']])){ 
							$arrDataImage = $arrData['project_image'][$data['project_image_type_id']];
						?>
							<tr>
								<td><?=$data['project_image_type_name']?> :</td>
								<td><img style="vertical-align:middle;width:100px;" src="<?=SITE_URL.PROJECT_IMAGE_DIR.$arrDataImage['project_image_url']?>" alt="<? echo $data['project_image_type_name'];?>" /></td>
							</tr>
							
						<? } ?>
				<? } ?>
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