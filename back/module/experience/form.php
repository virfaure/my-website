<?php

//Object Back
$objExp = new bExperience();

//Object Front UTIL
$objUtil = new Util();

// Arrays
$arrData = array();
$arrErrors = array();


//POST
if(!empty($_POST)){
	$action = "";
	$return = false;
	
	
	$arrData = $_POST;
	$arrData['experience_id'] = $_POST['content_id'];
	$id = $arrData['experience_id'];
	
	//date FROM and TO
	$arrData['experience_date_from'] = $objUtil->dateLocaleToDB($_POST['experience_date_from']);
	if(!empty($_POST['experience_date_to'])) $arrData['experience_date_to'] = $objUtil->dateLocaleToDB($_POST['experience_date_to']);
	
	if(empty($arrErrors)){	
		try {
			if(empty($arrData['experience_id'])){
				//add
				$objExp->add($arrData);
				$action = "create";
				
				$return = false;
			}else{
				//update
				$objExp->update($arrData);
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
	$arrExperience = $objExp->getOne(array("experience_id" => $_GET['id']));
	
	if(!empty($arrExperience)){
		$arrExperienceTraduction = $objExp->getTraduction(array("experience_id" => $_GET['id']));

		$arrData['experience'] = $arrExperience;
		$arrData['experience_traduction'] = $arrExperienceTraduction;	
		
	}else{
		header('Location: list.php?module='.$module);
		exit();
	}
}

// ERRORS
if(!empty($arrErrors)){
	$arrData = $_POST;
	$arrData['experience_id'] = $_POST['content_id'];		
}

/*********************************************************************************/

//Language List
$objLang = new Language();
$arrLanguage = $objLang->get();

//Status List
$objStatus = new Status();
$arrStatus = $objStatus->get();

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
	<h1 class="h1"> <? if(!empty($arrData['experience']['experience_date_from_iso'])){echo $arrData['experience']['experience_date_from_iso'];}else{echo 'Create Experience';}  ?></h1>
	<div class="clear"></div>

	<br />
	<form id="FormElement" class="validate" method="post" action="form.php?module=<?=$module?>">

		<fieldset>
			<legend>Infos</legend>
			<input type="hidden" value="<? if(!empty($arrData['experience']['experience_id'])){echo $arrData['experience']['experience_id'];}else{echo '';} ?>" name="content_id" id="content_id">
			
			<p class="half"> 
				<span>
					<label for="experience_date_from">From Date : <span class="red"> * </span></label>
					<input type="text" maxlength="60" value="<? if(!empty($arrData['experience']['experience_date_from_iso'])){echo $arrData['experience']['experience_date_from_iso'];}else{echo '';} ?>" class="date-picker required" name="experience_date_from" id="experience_date_from">
				</span>
			</p>
			
			<p>
				<span>
					<label for="experience_date_to">To Date : </label>
					<input type="text" maxlength="60" value="<? if(!empty($arrData['experience']['experience_date_to_iso'])){echo $arrData['experience']['experience_date_to_iso'];}else{echo '';} ?>" class="date-picker" name="experience_date_to" id="experience_date_to">
				</span>
			</p>
			
			<p>
				<span>
					<label for="experience_key">Company / University : </label>
					<input type="text" maxlength="60" value="<? if(!empty($arrData['experience']['experience_company'])){echo $arrData['experience']['experience_company'];}else{echo '';} ?>" class="full" name="experience_company" id="experience_company">
				</span>
			</p>
			
			<p>
				<span>
					<label for="experience_type">Type : <span class="red"> * </span></label>
					<select id="experience_type" name="experience_type" class="half">
						<option value="work" <? if(!empty($arrData['experience']['experience_type']) && $arrData['experience']['experience_type'] == 'work'){echo "selected = 'selected'";}?>>Work</option>
						<option value="school" <? if(!empty($arrData['experience']['experience_type']) && $arrData['experience']['experience_type'] == 'school'){echo "selected = 'selected'";}?>>School</option>
					</select>
				</span>
			</p>
			
			<p>
				<label for="status_id">Status :  </label>
				<select id="status_id" name="status_id">
					<?php foreach($arrStatus as $key => $data){ 
						$selected = "";
						if(!empty($arrData['experience']['status_id']) && $arrData['experience']['status_id']== $data['status_id']) $selected = "selected='selected'";
						echo '<option value="'.$data['status_id'].'" '.$selected .'>'.$data['status_name'].'</option>';
					} ?>
				</select>
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
					<div id="tabs_<?=$data['language_id']?>" style="width: 975px;">
						<input type="hidden" value="<?=$data['language_id']?>" name="experience_language[<?=$key?>]" id="experience_language_<?=$data['language_locale']?>">
						<p>
							<span>
								<label for="experience_title" class="required">Title :</label>
								<input type="text" maxlength="60" value="<? if(!empty($arrData['experience_traduction'][$data['language_id']]['experience_title'])){echo $arrData['experience_traduction'][$data['language_id']]['experience_title'];}else{echo '';} ?>" class="full" name="experience_title[<?=$data['language_id']?>]" id="experience_title_<?=$data['language_locale']?>" tabindex="2">
							</span>
						</p>
						
						<p>
							<span>
								<label for="experience_place">Place :</label>
								<input type="text" maxlength="60" value="<? if(!empty($arrData['experience_traduction'][$data['language_id']]['experience_place'])){echo $arrData['experience_traduction'][$data['language_id']]['experience_place'];}else{echo '';} ?>" class="full" name="experience_place[<?=$data['language_id']?>]" id="experience_place_<?=$data['language_locale']?>" tabindex="2">
							</span>
						</p>
					
						<p>
							<span>
								<label for="experience_description">Description : </label>
								<textarea class="full tinymce" name="experience_description[<?=$data['language_id']?>]" id="experience_description_<?=$data['language_locale']?>"><? if(!empty($arrData['experience_traduction'][$data['language_id']]['experience_description'])){echo $arrData['experience_traduction'][$data['language_id']]['experience_description'];}else{echo '';} ?></textarea>
							</span>
						</p>

						<br />
					</div>
				<? } ?>
			</div>					
		</fieldset>
		
		
		<!-- buttons -->
		<div class="box buttons buttons-form">
			<input type="button" class="btn small go-list"value="Back to list" /> 
			<input type="submit" class="btn btn-pink big" value="<? if(!empty($_GET['id'])){echo 'Update';}else{echo 'Create';} ?>" />
		</div>
	</form>

</div ><!-- End div wrapper-->