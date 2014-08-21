
function loadList(){	
	
	var module = $("#module").val();
	
	/////////////////////////////////////////////////////////////
	//SEARCH FORM Element
		
		// Company - Live
		$("#search_experience_company").keyup( function () {
			/* COLUMN 3 - Filter on the column (the index) of this element */
			oTable.fnFilter($(this).val(), 2);
		});
		
		// Type - change
		$("#search_experience_type").change( function () {
			/* COLUMN 3 - Filter on the column (the index) of this element */
			if($(this).val() != "") oTable.fnFilter("^"+$(this).val()+"$", 5, true);
			else oTable.fnFilter($(this).val(), 5);
		});
		
		// Status - change
		$("#search_experience_status").change( function () {
			/* COLUMN 3 - Filter on the column (the index) of this element */
			if($(this).val() != "") oTable.fnFilter("^"+$(this).val()+"$", 5, true);
			else oTable.fnFilter($(this).val(), 5);
		});


	/////////////////////////////////////////////////////////////
	// LOAD OF CONTENT LIST 
	var oTable = $('#dataTable-list');
	
	oTable.dataTable( {
		"sAjaxSource": "module/"+module+"/ajax/list.php?module="+module,						// php file to load data in ajax/build_table.php
		"aaSorting": [[3,'desc']],																// by default : sorting by 4- 'end date' ASC
		"aoColumns": [ 
			{ "sWidth" : "60px", "sClass": "border-left actions"}, 								// 0 - element id : 
			{ "sWidth" : "60px", "sClass": "actions", "bSortable": false }, 					// 1 - actions : not sortable
			null, 																				// 2 - type : by default
			{"sWidth" : "80px", "sType": "dateLainoaSimple"}, 									// 3 - date from 
			{"sWidth" : "80px", "sType": "dateLainoaSimple"}, 									// 4 - date to 
			null, 																				// 5 - company / university
			{ "sWidth" : "100px", "sClass": "actions", "bSortable": false },					// 6 - language : by default
			{ "bVisible" : false},																// 7 - status ID : HIDDEN
			{ "sWidth" : "100px", "sClass": "actions", "bSortable": false }						// 8 - status Text
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
		// url = ajax file php called (ajax/delete.php)
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


function loadForm(){
	
	//Tabs
	$('#tabs').tabs();
	
	$('#tabs').bind('tabsselect', function(event, ui) {
		var tabID = ui.panel.id;
	
		$("#"+tabID).find("textarea.full").each(function(){
			var textareaID = $(this).attr('id');	
			var textareaWidth = parseInt($('#' + textareaID).width());	
			var widthPixel = parseInt($("#"+tabID).width());
			
			var newWidth = Math.round((widthPixel * textareaWidth / 100));
			
			$("#" + textareaID + "_tbl").width(newWidth);
		});	
	});
	
	//Uploadify
	$('input.image_upload').each(function() {
		var swfWidth = $(this).outerWidth();
		var swfHeight = $(this).outerHeight();
		var queueID = $(this).parent('div').next('div.div-file').children('table.uploadifyQueue').attr('id');

		$(this).uploadify(
			{
				'swf' : '/js/jquery/uploadify/SWFUpload.swf',
				'uploader' : '/js/ajax/uploadify/uploadify.php', 
				'checkExisting' : '/js/ajax/uploadify/uploadify-check-exists.php', 
				'cancelImage' : '/themes/base/img/icons/x-delete.gif',
				'postData' : {'uploadFolder' : 'uploads'}, 
				'auto' : true,
				'buttonText' : 'Seleccionar',
				'fileTypeDesc' : 'Image Files',
				'fileTypeExts' : '*.jpg;*.jpeg;*.gif;*.png', 
				'width' : swfWidth,
				'height' : swfHeight,
				'fileSizeLimit' : 256000,
				'queueID' : queueID,
				removeCompleted : false,
				multi : true,
				onUploadComplete : function (event, data){}
			}
		);
	});
}