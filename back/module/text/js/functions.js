
function loadList(){	

	var module = $("#module").val();
	
	/////////////////////////////////////////////////////////////
	//SEARCH FORM Element
		
		// Function by ID
		$("#search_traduction_key").keyup( function () {
			/* COLUMN 0 - Filter on the column (the index) of this element */
			oTable.fnFilter($(this).val(), 2);
		});
		
		// Title
		$("#search_traduction_content").keyup( function () {
			/* COLUMN 3 - Filter on the column (the index) of this element */
			oTable.fnFilter($(this).val(), 3);
		});
		
		// Page
		$("#search_traduction_page").change( function () {
			/* COLUMN 3 - Filter on the column (the index) of this element */
			if($(this).val() != "") oTable.fnFilter("^"+$(this).val()+"$", 5, true);
			else oTable.fnFilter($(this).val(), 5);
		});

	/////////////////////////////////////////////////////////////
	// LOAD OF CONTENT LIST 
	var oTable = $('#dataTable-list');
	
	oTable.dataTable( {
		"sAjaxSource": "module/"+module+"/ajax/list.php?module="+module,						// php file to load data in ajax/build_table.php
		"aaSorting": [[0,'desc']],																// by default : sorting by 4- 'end date' ASC
		"aoColumns": [ 
			{ "sWidth" : "60px", "sClass": "border-left actions"}, 								// 0 - text id : 
			{ "sWidth" : "60px", "sClass": "actions", "bSortable": false }, 					// 1 - actions : not sortable
			null, 																				// 2 - title : by default
			null, 																				// 3 - text : by default
			{ "sWidth" : "100px", "sClass": "actions", "bSortable": false },					// 4 - language : by default
			{ "bVisible" : false},																// 5 - page ID : HIDDEN
			{ "sWidth" : "100px", "sClass": "actions", "bSortable": false }						// 6 - page Name
		],
		"iDisplayLength": 25,																	// Number of items to display in one page
		"aLengthMenu": [25, 50, 100],															// Value of select list to change number of item / page
		"bAutoWidth": false,																	// as the width is put aleardy in the th part of table, we put this to false to gain time
		"sPaginationType": "full_numbers",														// pagination with next, last, numbers
		"sDom": '<"#paginationTop"p><"#paginationBottom"p><"#infoResult"i><"#selectResult"l>',	// div ID where p (pagination), i(info) and l (select list)
		"fnDrawCallback": function() {													
			// Put #paginationTop in div #paginationRightTop with class pagination for styles
			// Put #paginationBottom in div #paginationRightBottom with class pagination for styles
			$('#paginationTop').addClass('pagination');
			$('#paginationBottom').addClass('pagination');
			$('#paginationRightTop').append($('#paginationTop'));
			$('#paginationRightBottom').append($('#paginationBottom'));
				
			// Put #infoResult in div #numberResult with class nb_result for styles
			$('#infoResult').addClass('nb_result');
			$('#numberResult').append($('#infoResult'));
			
			// Put #selectResult in div #numberResult with class nb_result_page for styles
			$('#selectResult').addClass('nb_result_page');
			$('#numberResult').append($('#selectResult'));
		}
	} );	//end DataTables


	/////////////////////////////////////////////////////////////
	// AJAX ACTIONS ON BUTTON FROM LIST (UPDATE STATUS AND DELETE)
			
		// Delete a content in the list
		// url = ajax file php called (ajax/delete_row.php)
		$('a.ajaxDeleteRow').live('click', function() {
			var url = $(this).attr('href');
			$(this).fastConfirm({
				position: "right",
				action: $(this).attr('title'),
				onProceed: function(trigger) {		
					//Delete the Row
					$.get(url, function(data){
						$(trigger).fastConfirm('close');
						arrReturn = data.split('|');
						$.alerts.resultClass = arrReturn[0];
						if(arrReturn[0] == 'false'){
							// Error => Message in Alert
							jAlert(arrReturn[1]);
						}else{
							// OK => Reload Table AND Alert Message
							jAlert(arrReturn[1], null, function(r) {
								oTable.fnReloadAjax();
							}, 3);
						}
					});
				},
				onCancel: function(trigger) {
					$(trigger).fastConfirm('close');
				}
			}); 
			return false;
		});
}	