<?php

/*********************************************************************************/
//Status List
$objStatus = new Status();
$arrStatus = $objStatus->get();

?>

<!-- Headers -->
<? include SITE_DIR.'/back/include/header.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
		loadList();
	});
</script>
					
<!-- Module Content -->
<div id="moduleContent" class="wrapper">
			
	<!-- Title H1 -->
	<h1 class="h1-left">Experiences</h1>

	<!-- Button Create -->
	<input type="button" class="btn btn-pink btn-create right" value="Create Experience" />				
		
	<div class="clear"></div>
	
	<!-- Form Search  -->
	<form id="searchList" action="#" class="search">
		<!--<p class="left_search">
		  <label for="search_menu_local">Local : </label>
		  <select class="full" name="search_menu_local" id="search_menu_local" tabindex="1">
			<option value="">-- Seleccionar --</option>
			<option value="1">SOFTWARE_02</option>
			<option value="2">beMediterranean 1 horizontal 1</option>
			<option value="3">Local Test</option>
			<option value="4">BeSense</option>
			<option value="5">Santander 1360x768</option>
		  </select>
		</p>-->
		
		<p class="left_search">
			<label for="search_experience_company">Company / University : </label>
			<input id="search_experience_company" name="search_experience_company" class="full livesearch" value="" type="text">
		</p>
	
		
		
		<p class="left_search">
			<label for="search_experience_type">Type : </label>
			<select id="search_experience_type" name="search_experience_type" class="full">
				<option value="">-- Select --</option>
				<option value="work">Work</option>
				<option value="school">School</option>
			</select>
		</p>
		
		
		<p class="left_search">
			<label for="search_experience_status">Status : </label>
			<select id="search_experience_status" name="search_experience_status" class="full">
				<option value="">-- Select --</option>
				<?php foreach($arrStatus as $key => $data){
					echo '<option value="'.$data['status_id'].'">'.$data['status_name'].'</option>';
				} ?>
			</select>
		</p>
		<p class="clear">&nbsp;</p>
	</form> 

	<!-- Table List -->
	<div id="tableList">
		
		<!-- Batch Operations left + Pagination right -->
		<div class="batch-pagination">					
			<div id="paginationRightTop" class="right"></div>
			<div class="clear"></div>
		</div>


		<!-- Table -->
		<table id="dataTable-list" width="100%" cellspacing="0" cellpadding="0" border="0" class="list">

			<thead>  
				<tr>
					<th>ID</th>		
					<th>Actions</th>
					<th>Type</th>
					<th>Date From</th>
					<th>Date To</th>
					<th>Company</th>
					<th>Languages</th>
					<th>Status ID</th>
					<th>Status</th>
				</tr>
			</thead>
			
			<tbody><tr><td></td></tr></tbody>
			
		</table>

		<!-- Pagination right -->
		<div class="batch-pagination-bottom">
			<div class="left">
				<div id="numberResult" class="number_result"></div>
			</div>

			<div id="paginationRightBottom" class="right"></div>
			
			<div class="clear"></div>
		</div>
		
	</div> <!-- End div tableList-->

</div ><!-- End div wrapper-->