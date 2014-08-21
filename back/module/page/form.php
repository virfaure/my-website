<?php

//Object Back
$objPage = new bPage();

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
	$arrData['page_id'] = $_POST['content_id'];
	
	if(empty($arrErrors)){	
		try {
			if(empty($arrData['page_id'])){
				//add
				$objPage->add($arrData);
				$action = "create";
				
				$return = false;
			}else{
				//update
				$objPage->update($arrData);
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
	$arrPage = $objPage->getOne(array("page_id" => $_GET['id']));
	$arrData['page'] = $arrPage;
}

// ERRORS
if(!empty($arrErrors)){
	$arrData = $_POST;
	$arrData['page_id'] = $_POST['content_id'];		
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
	<h1 class="h1-left"><? if(!empty($arrData['page']['page_name'])){echo $arrData['page']['page_name'];}else{echo 'Create Page';}?></h1>
	<div class="clear"></div>

	<form id="FormText" class="validate" method="post" action="form.php?module=<?=$module?>">

		<fieldset>
			<legend>Infos</legend>
			<input type="hidden" value="<? if(!empty($arrData['page']['page_id'])){echo $arrData['page']['page_id'];}else{echo '';} ?>" name="content_id" id="content_id">
			<p>
				<span>
					<label for="page_name" class="required">Name : <span class="red"> * </span></label>
					<input type="text" maxlength="60" value="<? if(!empty($arrData['page']['page_name'])){echo $arrData['page']['page_name'];}else{echo '';} ?>" class="half" name="page_name" id="page_name" tabindex="1">
					<small>Máximo 60 caracteres</small>
				</span>
			</p>
			
			<p>
				<label for="status_id">Status :  </label>
				<select id="status_id" name="status_id" tabindex="1">
					<?php foreach($arrStatus as $key => $data){ 
						$selected = "";
						if(!empty($arrData['page']['status_id']) && $arrData['page']['status_id']== $data['status_id']) $selected = "selected='selected'";
						echo '<option value="'.$data['status_id'].'" '.$selected .'>'.$data['status_name'].'</option>';
					} ?>
				</select>
			</p>
			
		</fieldset>

		
		<!-- buttons -->
		<div class="box buttons buttons-form">
			<input type="button" class="btn small go-list"value="Back to list" /> 
			<input type="submit" class="btn btn-pink big" value="<? if(!empty($_GET['id'])){echo 'Update';}else{echo 'Create';} ?>" />
		</div>
	</form>

</div ><!-- End div wrapper-->