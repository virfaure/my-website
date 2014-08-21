<?php

//Object Back
$objVar = new bVariable();

// Arrays
$arrData = array();


// VIEW : Get Data
if(!empty($_GET['id'])){
	$arrVariable = $objVar->getOne(array("variable_id" => $_GET['id']));
	$arrData['variable'] = $arrVariable;
}else{
	//return to list
	header('Location: list.php?module='.$module);
	exit();
}

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
					<span class="box-valid">Variable <?=$arrData['variable']['variable_name']?> has been updated successfully.</span>
					<br />
				<? }else{ ?>	
					<!-- Message Create --->
					<br />
					<span class="box-valid">Variable <?=$arrData['variable']['variable_name']?> has been created successfully.</span>
					<br />
				<? } ?>	
		<? } ?>

		<!-- Title H1 -->
		<h1><?=$arrData['variable']['variable_name']?></h1>
		<hr />
		
		<table class="no-style full">
			<tbody>
				<tr>
					<td width="15%">Name :</td>
					<td><? if(!empty($arrData['variable']['variable_name'])){echo $arrData['variable']['variable_name'];}else{echo '';} ?></td>
				</tr>
				<tr>
					<td>Value :</td>
					<td><? if(!empty($arrData['variable']['variable_value'])){echo $arrData['variable']['variable_value'];}else{echo '';} ?></td>
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