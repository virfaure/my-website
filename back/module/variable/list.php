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
	<h1 class="h1-left">Variable</h1>

	<!-- Button Create -->
	<input type="button" class="btn btn-pink btn-create right" value="Create Variable" />				
		
	<div class="clear"></div>
	
	<!-- Form Search  -->
	<form id="searchText" action="#" class="search">
		<p class="left_search">
			<label for="search_variable_name">Name : </label>
			<input id="search_variable_name" name="search_variable_name" class="full livesearch" value="" type="text">
		</p>
		<p class="left_search">
			<label for="search_variable_value">Value : </label>
			<input id="search_variable_value" name="search_variable_value" class="full livesearch" value="" type="text">
		</p>
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
					<th>Variable ID</th>		
					<th>Actions</th>
					<th>Name</th>
					<th>Value</th>
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