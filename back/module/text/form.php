<?php

//Object Back
$objTrad = new bTraduction();

// Arrays
$arrData = array();
$arrErrors = array();


//POST
if(!empty($_POST)){
	$action = "";
	$return = false;
	
	$arrData = $_POST;
	$arrData['traduction_id'] = $_POST['content_id'];
	$id = $arrData['traduction_id'];
	
	if(empty($arrErrors)){	
		try {
			if(empty($arrData['traduction_id'])){
				//add
				$objTrad->add($arrData);
				$action = "create";
				
				$return = false;
			}else{				
				//update
				$objTrad->update($arrData);
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
	$arrTraduction = $objTrad->getOne(array("traduction_id" => $_GET['id']));
	
	$arrTraductionContenu = $objTrad->getText(array("traduction_id" => $_GET['id']));

	$arrData['traduction'] = $arrTraduction;
	$arrData['traduction_text'] = $arrTraductionContenu;
}

// ERRORS
if(!empty($arrErrors)){
	$arrData = $_POST;
	$arrData['traduction_id'] = $_POST['content_id'];		
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

<script type="text/javascript">
	$(document).ready(function(){
		//loadTextForm();
	});
</script>
					
<!-- Module Content -->
<div id="moduleContent" class="wrapper">
			
	<!-- Title H1 -->
	<h1 class="h1-left"><? if(!empty($arrData['traduction']['traduction_key'])){echo $arrData['traduction']['traduction_key'];}else{echo 'Create Text';}  ?></h1>
	<div class="clear"></div>

	<form id="FormText" class="validate" method="post" action="form.php?module=<?=$module?>">

		<fieldset>
			<legend>Infos</legend>
			<input type="hidden" value="<? if(!empty($arrData['traduction']['traduction_id'])){echo $arrData['traduction']['traduction_id'];}else{echo '';} ?>" name="content_id" id="content_id">
			<p>
				<label for="page_id">Page :  </label>
				<select id="page_id" name="page_id" tabindex="1">
					<option value="">-- Select --</option>
					<?php foreach($arrPage as $key => $data){
						$selected = "";
						if(!empty($arrData['traduction']['page_id']) && $arrData['traduction']['page_id']== $data['page_id']) $selected = "selected='selected'";
						
						echo '<option value="'.$data['page_id'].'" '.$selected.'>'.$data['page_name'].'</option>';
					} ?>
				</select>
			</p>
			
			<p>
				<span>
					<label for="traduction_key" class="required">Traduction Key : <span class="red"> * </span></label>
					<input type="text" maxlength="60" value="<? if(!empty($arrData['traduction']['traduction_key'])){echo $arrData['traduction']['traduction_key'];}else{echo '';} ?>" class="half" name="traduction_key" id="traduction_key" tabindex="2">
					<small>Máximo 60 caracteres</small>
				</span>
			</p>
		</fieldset>

		<fieldset>
			<legend>Texts</legend>
			<?php foreach($arrLanguage as $key => $data){ ?>
				<p>
					<span>
						<label for="traduction_text">Traduction Text : <img src="theme/img/<?=$data['language_locale']?>.gif" alt="<?=$data['language_locale']?>" /></label>
						<textarea class="full tinymce" name="traduction_text[<?=$data['language_id']?>]" id="traduction_text_<?=$data['language_locale']?>"><? if(!empty($arrData['traduction_text'][$data['language_id']])){echo $arrData['traduction_text'][$data['language_id']];}else{echo '';} ?></textarea>
					</span>
				</p>
			<? } ?>
					
		</fieldset>
		
		<!-- buttons -->
		<div class="box buttons buttons-form">
			<input type="button" class="btn small go-list"value="Back to list" /> 
			<input type="submit" class="btn btn-pink big" value="<? if(!empty($_GET['id'])){echo 'Update';}else{echo 'Create';} ?>" />
		</div>
	</form>

</div ><!-- End div wrapper-->