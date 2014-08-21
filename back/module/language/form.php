<?php

//Object Back
$objLang = new bLanguage();

// Arrays
$arrData = array();
$arrErrors = array();


//POST
if(!empty($_POST)){
	$action = "";
	$return = false;
	
	// GET POST
	$arrData = $_POST;
	$id = $arrData['content_id'];
	
	//ADD Variables 
	$arrData['language_id'] = $_POST['content_id'];
	$arrData['language_image'] = '../theme/img/'.$arrData['language_locale'].'.gif';
	
	if(empty($arrErrors)){	
		try {
			if(empty($arrData['language_id'])){
				//add
				$objLang->add($arrData);
				$action = "create";
				
				$return = false;
			}else{
				//update
				$objLang->update($arrData);
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
	$arrLanguage = $objLang->getOne(array("language_id" => $_GET['id']));
	$arrData['language'] = $arrLanguage;
}

// ERRORS
if(!empty($arrErrors)){
	$arrData = $_POST;
	$arrData['language_id'] = $_POST['content_id'];		
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
			
	<!-- Title H1 -->
	<h1 class="h1-left"><? if(!empty($arrData['language']['language_name'])){echo $arrData['language']['language_name'];}else{echo 'Create Language';}?></h1>
	<div class="clear"></div>

	<form id="FormText" class="validate" method="post" action="form.php?module=<?=$module?>">

		<fieldset>
			<legend>Infos</legend>
			<input type="hidden" value="<? if(!empty($arrData['language']['language_id'])){echo $arrData['language']['language_id'];}else{echo '';} ?>" name="content_id" id="content_id">
			<p>
				<span>
					<label for="language_name" class="required">Name : <span class="red"> * </span></label>
					<input type="text" maxlength="60" value="<? if(!empty($arrData['language']['language_name'])){echo $arrData['language']['language_name'];}else{echo '';} ?>" class="half" name="language_name" id="language_name" tabindex="1">
					<small>Máximo 60 caracteres</small>
				</span>
			</p>
			
			<p>
				<span>
					<label for="language_locale" class="required">Locale : <span class="red"> * </span></label>
					<input type="text" maxlength="60" value="<? if(!empty($arrData['language']['language_locale'])){echo $arrData['language']['language_locale'];}else{echo '';} ?>" class="half" name="language_locale" id="language_locale" tabindex="2">
					<small>Máximo 5 caracteres</small>
				</span>
			</p>
			
			<p>
				<label for="status_id">Status :  </label>
				<select id="status_id" name="status_id" tabindex="1">
					<?php foreach($arrStatus as $key => $data){ 
						$selected = "";
						if(!empty($arrData['language']['status_id']) && $arrData['language']['status_id']== $data['status_id']) $selected = "selected='selected'";
						echo '<option value="'.$data['status_id'].'" '.$selected .'>'.$data['status_name'].'</option>';
					} ?>
				</select>
			</p>
			
		</fieldset>

		<? if(!empty($_GET['id'])){ ?>
			<fieldset>
				<legend>Image</legend>
				<p>
					<img alt="image" title="image" src="theme/img/<?=$arrData['language']['language_locale']?>.gif" />
				</p>		
			</fieldset>
		<?} ?>
		
		<!-- buttons -->
		<div class="box buttons buttons-form">
			<input type="button" class="btn small go-list"value="Back to list" /> 
			<input type="submit" class="btn btn-pink big" value="<? if(!empty($_GET['id'])){echo 'Update';}else{echo 'Create';} ?>" />
		</div>
	</form>

</div ><!-- End div wrapper-->