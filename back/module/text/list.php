<?php
/*********************************************************************************/
//Page List
$objPage = new Page();
$arrPage = $objPage->get();

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
	<h1 class="h1-left">Texts</h1>

	<!-- Button Create -->
	<input type="button" class="btn btn-pink btn-create right" value="Create Text" />				
		
	<div class="clear"></div>
	
	<!-- Form Search  -->
	<form id="searchText" action="#" class="search">
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
			<label for="search_traduction_key">Traduction Key : </label>
			<input tabindex="1" id="search_traduction_key" name="search_traduction_key" class="full livesearch" value="" type="text">
		</p>
		<p class="left_search">
			<label for="search_traduction_content">Contains : </label>
			<input tabindex="2" id="search_traduction_content" name="search_traduction_content" class="full livesearch" value="" type="text">
		</p>
		<p class="left_search">
			<label for="search_traduction_page">Page : </label>
			<select id="search_traduction_page" name="search_traduction_page" tabindex="3">
				<option value="">-- Select --</option>
				<?php foreach($arrPage as $key => $data){
					echo '<option value="'.$data['page_id'].'">'.$data['page_name'].'</option>';
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
					<th>Text ID</th>		
					<th>Actions</th>
					<th>Title</th>
					<th>Text Sample</th>
					<th>Languages</th>
					<th>Page ID</th>
					<th>Page</th>
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