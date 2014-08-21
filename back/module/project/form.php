<?php

//Object Back
$objProj = new bProject();

//Object Front Variable
$objVar = new Variable();
$objUtil = new Util();

// Arrays
$arrData = array();
$arrErrors = array();

//Type Images 
$arrProjectImageType = $objProj->getImageType();

//Construction Pattern Search Image
$listPost = "";
$listTypeKey = "";
$patternPost = "";
$patternTypeKey = "";

foreach($arrProjectImageType as $key => $data){
	$listPost .= "FileName-UploadifyBtn-".$data["project_image_type_value"];
	$listTypeKey .= $data["project_image_type_value"];
	
	if($key < count($arrProjectImageType) - 1){
		$listPost .= "|";
		$listTypeKey .= "|";
	}
}
$patternPost = '/('.$listPost.')/';
$patternTypeKey = '/('.$listTypeKey.')/';

//POST
if(!empty($_POST)){
	$action = "";
	$return = false;
		
	$arrData = $_POST;
	$arrData['project_id'] = $_POST['content_id'];
	$id = $arrData['project_id'];
	
	$arrData['project_date'] = $objUtil->dateLocaleToDB($_POST['project_date']);
	
		
	foreach($_POST as $key => $value)
	{
		$width = "";
		$height = "";
		
		/* 
		[FileName-Image-mini] => decoration_stickers_mini.jpg
		[FileName-Image-popup_1_0] => 1b4605b0e20ceccf91aa278d10e81fad64e24e27.jpg
		*/	
	
		//Search in Post Key For Image
		preg_match($patternPost, $key, $matches);
	
		if(count($matches) > 0){
		
			//found, check which type of image it is
			preg_match($patternTypeKey, $matches[0], $matches1);
			$project_image_type_id = $objProj->getImageType(array("project_image_type_value" => $matches1[0]), "project_image_type_id");
				
			if(!empty($project_image_type_id)){
				if(!empty($value))
				{					
					$arrData['project_image'][$project_image_type_id]['project_image_url'] = $value;
					
					// CHECK IF IMAGE IN TMP !!
					if (file_exists(SITE_DIR.IMAGE_TMP_DIR.$arrData['project_image'][$project_image_type_id]['project_image_url'])) {
						if(rename(SITE_DIR.IMAGE_TMP_DIR.$arrData['project_image'][$project_image_type_id]['project_image_url'], SITE_DIR.PROJECT_IMAGE_DIR.$arrData['project_image'][$project_image_type_id]['project_image_url'])){
							// file copied in WEBFOLIO folder
							list($width, $height) = getimagesize(SITE_DIR.PROJECT_IMAGE_DIR.$arrData['project_image'][$project_image_type_id]['project_image_url']);
							$arrData['project_image'][$project_image_type_id]['project_image_width'] = $width;
							$arrData['project_image'][$project_image_type_id]['project_image_height'] = $height;
							$arrData['project_image'][$project_image_type_id]['project_image_size'] = filesize(SITE_DIR.PROJECT_IMAGE_DIR.$arrData['project_image'][$project_image_type_id]['project_image_url']);
						}
					} else {
						//CHECK IF file already is in WEBFOLIO folder
						if (file_exists(SITE_DIR.PROJECT_IMAGE_DIR.$arrData['project_image'][$project_image_type_id]['project_image_url'])) {
							//don't update !
							list($width, $height) = getimagesize(SITE_DIR.PROJECT_IMAGE_DIR.$arrData['project_image'][$project_image_type_id]['project_image_url']);
							$arrData['project_image'][$project_image_type_id]['project_image_width'] = $width;
							$arrData['project_image'][$project_image_type_id]['project_image_height'] = $height;
							$arrData['project_image'][$project_image_type_id]['project_image_size'] = filesize(SITE_DIR.PROJECT_IMAGE_DIR.$arrData['project_image'][$project_image_type_id]['project_image_url']);
						}
					}	
				}else{							
					$arrData['project_image'][$project_image_type_id] = array();
				}
			}
		}	
	}

	
	if(empty($arrErrors)){	
		try {
			if(empty($arrData['project_id'])){
				//add
				$objProj->add($arrData);
				$action = "create";
				
				$return = false;
			}else{
				//update
				$objProj->update($arrData);
				$action = "update";	
			}
			
			header('Location: view.php?module='.$module.'&id='.$id.'&action='.$action);
			exit();
		
		} catch (Exception $e) {
			$arrErrors[] = $e->getMessage();
		}
	}
}

// UPDATE : Get Data
if(!empty($_GET['id'])){
	$arrProject = $objProj->getOne(array("project_id" => $_GET['id']));
	$arrProjectImage = $objProj->getImage(array("project_id" => $_GET['id']));
	$arrProjectTraduction = $objProj->getTraduction(array("project_id" => $_GET['id']));

	$arrData['project'] = $arrProject;
	$arrData['project_image'] = $arrProjectImage;
	$arrData['project_traduction'] = $arrProjectTraduction;	
}

// ERRORS
if(!empty($arrErrors)){
	$arrData = $_POST;
	$arrData['project_id'] = $_POST['content_id'];		
}

/*********************************************************************************/

//Language List
$objLang = new Language();
$arrLanguage = $objLang->get();

?>

<!-- Headers -->
<? include SITE_DIR.'/back/include/header.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
		loadForm();
	});
</script>
					
<!-- Module Content -->
<div id="moduleContent" class="wrapper">
			
	<!-- Title H1 -->
	<h1 class="h1-left"><? if(!empty($arrData['project']['project_name'])){echo $arrData['project']['project_name'];}else{echo 'Create Project';}  ?></h1>
	<div class="clear"></div>

	<form id="FormText" class="validate" method="post" action="form.php?module=<?=$module?>">

		<fieldset>
			<legend>Infos</legend>
			<input type="hidden" value="<? if(!empty($arrData['project']['project_id'])){echo $arrData['project']['project_id'];}else{echo '';} ?>" name="content_id" id="content_id">
			
			<p>
				<span>
					<label for="project_key" class="required">Date : <span class="red"> * </span></label>
					<input type="text" maxlength="60" value="<? if(!empty($arrData['project']['project_date_iso'])){echo $arrData['project']['project_date_iso'];}else{echo '';} ?>" class="half date-picker" name="project_date" id="project_date" tabindex="1">
				</span>
			</p>
			
			<p>
				<span>
					<label for="project_key" class="required">Name : <span class="red"> * </span></label>
					<input type="text" maxlength="60" value="<? if(!empty($arrData['project']['project_name'])){echo $arrData['project']['project_name'];}else{echo '';} ?>" class="half" name="project_name" id="project_name" tabindex="2">
				</span>
			</p>
			
			<p>
				<span>
					<label for="project_key" class="required">Url : <span class="red"> * </span></label>
					<input type="text" maxlength="60" value="<? if(!empty($arrData['project']['project_url'])){echo $arrData['project']['project_url'];}else{echo '';} ?>" class="half" name="project_url" id="project_url" tabindex="3">
				</span>
			</p>
		</fieldset>

		<fieldset>
			<legend>Texts</legend>
			
			<div id="tabs">
				<ul>
					<?php foreach($arrLanguage as $key => $data){ ?>
						<li><a href="#tabs_<?=$data['language_id']?>">Content <img src="theme/img/<?=$data['language_locale']?>.gif" alt="<?=$data['language_locale']?>" /></a></li>
					<? } ?>
				</ul>
 
				<?php foreach($arrLanguage as $key => $data){ ?>
					<input type="hidden" value="<?=$data['language_id']?>" name="project_language[<?=$key?>]" id="project_language_<?=$data['language_locale']?>">
					<div id="tabs_<?=$data['language_id']?>" style="width: 975px;">
						<p>
							<span>
								<label for="project_key" class="required">Caption : <img src="theme/img/<?=$data['language_locale']?>.gif" alt="<?=$data['language_locale']?>" /></label>
								<input type="text" maxlength="60" value="<? if(!empty($arrData['project_traduction'][$data['language_id']]['project_caption'])){echo $arrData['project_traduction'][$data['language_id']]['project_caption'];}else{echo '';} ?>" class="full" name="project_caption[<?=$data['language_id']?>]" id="project_caption_<?=$data['language_locale']?>" tabindex="2">
							</span>
						</p>
					
						<p>
							<span>
								<label for="project_text">Description : </label>
								<textarea class="full tinymce" name="project_description[<?=$data['language_id']?>]" id="project_description_<?=$data['language_locale']?>"><? if(!empty($arrData['project_traduction'][$data['language_id']]['project_description'])){echo $arrData['project_traduction'][$data['language_id']]['project_description'];}else{echo '';} ?></textarea>
							</span>
						</p>
						
						<p>
							<span>
								<label for="project_text">Work : </label>
								<textarea class="full tinymce" name="project_work[<?=$data['language_id']?>]" id="project_work<?=$data['language_locale']?>"><? if(!empty($arrData['project_traduction'][$data['language_id']]['project_work'])){echo $arrData['project_traduction'][$data['language_id']]['project_work'];}else{echo '';} ?></textarea>
							</span>
						</p>
						<br />
					</div>
				<? } ?>
			</div>					
		</fieldset>
		
		<fieldset>
			<legend>Images</legend>
			
			<?php 
			foreach($arrProjectImageType as $key => $data){		?>
				
					<?php
						$arrDataImage ="";
						
						/*Name of the SwfUploadify */
						$uploadifyName = "UploadifyBtn-".$data['project_image_type_value'];
					?>
						
					<p class="left">
						<span>
							<label for="project_text"><?=$data['project_image_type_name']?> : </label>
							<input type="hidden" value="<?=$data['project_image_type_value']?>" name="project_image_type_value[<?=$data?>]" id="project_image_type_value_<?=$data?>">
							
							
							<?php if(!empty($arrData['project_image'][$data['project_image_type_id']])){ 
								$arrDataImage = $arrData['project_image'][$data['project_image_type_id']];
							?>
								<span id="preview-<?=$uploadifyName?>" style="display:block;border:1px solid #ccc;vertical-align:middle;width:300px;height:180px;background:#fff;overflow:hidden;">
									<img style="vertical-align:middle;width:300px;" src="<?=SITE_URL.PROJECT_IMAGE_DIR.$arrDataImage['project_image_url']?>" alt="<? echo $data['project_image_type_name'];?>" />
								</span>
								<!--<a class="small-link" href="<?=SITE_URL.PROJECT_IMAGE_DIR.$arrDataImage['project_image_url']?>" target="_blank"><?=SITE_URL.PROJECT_IMAGE_DIR.$arrDataImage['project_image_url']?></a>-->
							<?}else{ ?>
								<span id="preview-<?=$uploadifyName?>" style="display:block;border:1px solid #ccc;vertical-align:middle;width:300px;height:180px;background:#fff;overflow:hidden;">
								No Image
								</span>
								<!--<a class="small-link" href="" target="_blank"></a>-->
							<?php }?>
						</span>
					</p>
				
				<div id="upload_image_wrapper" class="pform right" style="margin-left:30px;margin-top:16px;width: 60%;">
					<label class="require">Upload Image: </label>
					<br />
					<div class="div-btn-file left">

						<input id="<?=$uploadifyName?>" name="<?=$uploadifyName?>" type="button" class="btn btn-pink image_upload_single" value="Select file" />
						
						<? if(empty($arrDataImage['project_image_url'])){$count_image = 0;}else{$count_image = 1;}?>
						<input type="hidden" id="count_<?=$uploadifyName?>" value="<?=$count_image?>" />
						<input type="hidden" id="class_<?=$uploadifyName?>" value="image_upload_single" />
						<input type="hidden" id="width_<?=$uploadifyName?>" value="" /> 
						<input type="hidden" id="height_<?=$uploadifyName?>" value="" />
						<input type="hidden" id="FileName-<?=$uploadifyName?>" name="FileName-<?=$uploadifyName?>" value="<? if(!empty($arrDataImage['project_image_url'])){echo $arrDataImage['project_image_url'];}else{echo '';} ?>" />
					</div>

					<div class="div-file left">
						<table id="custom-queue-<?=$uploadifyName?>" width="100%" cellspacing="0" cellpadding="0" border="0" class="light_grey_row uploadifyQueue">
							<thead>
								<tr>
									<th colspan="4">Uploaded images</th>
								</tr>
							</thead>

							<tbody>
								<?php
								if(!empty($arrDataImage['project_image_url'])){
								?>
									<tr>
										<td class="col1 center">
											<img id="img_<?=$uploadifyName?>" title="Delete File" class="remove_image_widget" style="cursor: pointer;" src="theme/img/delete.gif" /> 
										</td>
										<td>
											<span style="font-weight: bold;"><?=$arrDataImage['project_image_url']?></span>
										</td>
									</tr>
								<?}?>
								<tr class="tr-file-none">
									<td class="border-left" colspan="2">Total : 0 Mb</td>
								</tr>
							</tbody>
						</table>
						<?php
							$variable_name = $data['project_image_type_value']."_resolution";
							$bestResolution = $objVar->getOne(array("variable_name"=>$variable_name), "variable_value");
							
							if(!empty($bestResolution)) echo '<small>Best Resolution: '.$bestResolution.'</small>';
						?>
					</div>
				</div>
				<p class="clear"></p>
				<br /><hr /><br />
			<? } ?>					
		</fieldset>
		
		
		<!-- buttons -->
		<div class="box buttons buttons-form">
			<input type="button" class="btn small go-list"value="Back to list" /> 
			<input type="submit" class="btn btn-pink big" value="<? if(!empty($_GET['id'])){echo 'Update';}else{echo 'Create';} ?>" />
		</div>
	</form>

</div ><!-- End div wrapper-->