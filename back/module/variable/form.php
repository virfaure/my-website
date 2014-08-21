<?php

//Object Back
$objVariable= new bVariable();

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
	$arrData['variable_id'] = $_POST['content_id'];
	
	if(empty($arrErrors)){	
		try {
			if(empty($arrData['variable_id'])){
				//add
				$objVariable->add($arrData);
				$action = "create";
				
				$return = false;
			}else{
				//update
				$objVariable->update($arrData);
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
	$arrVariable = $objVariable->getOne(array("variable_id" => $_GET['id']));
	if(empty($arrVariable)){
		header('Location: list.php?module='.$module);
		exit();
	}else{
		$arrData['variable'] = $arrVariable;
	}
}

// ERRORS
if(!empty($arrErrors)){
	$arrData = $_POST;
	$arrData['variable_id'] = $_POST['content_id'];		
}


?>

<!-- Headers -->
<? include SITE_DIR.'/back/include/header.php'; ?>	

<!-- Module Content -->
<div id="moduleContent" class="wrapper">
			
	<!-- Title H1 -->
	<h1 class="h1-left"><? if(!empty($arrData['variable']['variable_name'])){echo $arrData['variable']['variable_name'];}else{echo 'Create Variable';}?></h1>
	<div class="clear"></div>

	<form id="FormText" class="validate" method="post" action="form.php?module=<?=$module?>">

		<fieldset>
			<input type="hidden" value="<? if(!empty($arrData['variable']['variable_id'])){echo $arrData['variable']['variable_id'];}else{echo '';} ?>" name="content_id" id="content_id">
			<p>
				<span>
					<label for="variable_name" class="required">Name : <span class="red"> * </span></label>
					<input type="text" value="<? if(!empty($arrData['variable']['variable_name'])){echo $arrData['variable']['variable_name'];}else{echo '';} ?>" class="half" name="variable_name" id="variable_name" tabindex="1">
				</span>
			</p>
			
			<p>
				<span>
					<label for="variable_name" class="required">Value : <span class="red"> * </span></label>
					<input type="text" value="<? if(!empty($arrData['variable']['variable_value'])){echo $arrData['variable']['variable_value'];}else{echo '';} ?>" class="half" name="variable_value" id="variable_value" tabindex="2">
				</span>
			</p>
		</fieldset>

		
		<!-- buttons -->
		<div class="box buttons buttons-form">
			<input type="button" class="btn small go-list"value="Back to list" /> 
			<input type="submit" class="btn btn-pink big" value="<? if(!empty($_GET['id'])){echo 'Update';}else{echo 'Create';} ?>" />
		</div>
	</form>

</div ><!-- End div wrapper-->