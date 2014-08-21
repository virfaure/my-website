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
	<h1 class="h1-left">Page</h1>

	<!-- Button Create -->
	<input type="button" class="btn btn-pink btn-create right" value="Create Page" />				
		
	<div class="clear"></div>
	
	<!-- Form Search  -->
	<form id="searchText" action="#" class="search">
		<p class="left_search">
			<label for="search_page_name">Page Name : </label>
			<input tabindex="1" id="search_page_name" name="search_page_name" class="full livesearch" value="" type="text">
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
					<th>Page ID</th>		
					<th>Actions</th>
					<th>Name</th>
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