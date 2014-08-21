/*******************************************************************************
* // ACTions buttons */

function goToForm() {
	$('input.btn-create, input.go-form').click(function() {
		var module = $("#module").val();

		if($("#content_id").length > 0){
			var id = $("#content_id").val();
			window.location = 'form.php?module=' + module+'&id=' + id;
		}else{
			window.location = 'form.php?module=' + module;
		}
	});
}	

function goToList() {
	$('input.go-list').click(function() {
		var module = $("#module").val();
		window.location = 'list.php?module=' + module;
	});
}	


/*******************************************************************************
 * // Date Picker */
 
function datePicker() {
	// Only one field
	$('input.date-picker').datepicker();
}
 
 
/*******************************************************************************
 * // TINYMCE Simple Settings : only Bold, Italic, Underline, Past, Paste Text */
function tinymceSettings() {

	tinyMCE.init({
		// General options
		mode : "textareas",
		editor_selector : "tinymce",
		theme : "advanced",
		entity_encoding : "raw",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,legacyoutput,template,advlist",

		//valid_elements : "b,i,u,#p",
		forced_root_block : "",
		
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,|,paste,pastetext,pasteword,code,fontsizeselect",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "",
		theme_advanced_resizing : true,

		setup : function(editor) {
			editor.onPostRender.add(function(editor, cm) {
				// Register focus and blur events on BOTH the
				// window and the doc, this way it works
				// properly in
				// IE, Firefox & Chrome
				tinymce.dom.Event.add(editor.getWin(), 'blur',
						function(e) {
							// Onblur => save and validate
							// content
							tinyMCE.activeEditor.save();
							$("#" + editor.id).valid();
						});
				tinymce.dom.Event.add(editor.getDoc(), 'blur',
						function(e) {
							// Onblur => save and validate
							// content
							tinyMCE.activeEditor.save();
							$("#" + editor.id).valid();
						});
			});

			editor.onInit.add(function(editor) {
				// OnInit => get the tabindex property
				// of textarea and put it to the tinymce
				// iframe
				var textareaId = editor.id;

				//$('#' + textareaId + '_tbl').width(textareaWidth + 30);
				//$('#' + textareaId + '_ifr').width(textareaWidth);
				
				/* Hide Button fontsizeselect
					// Hack IE7, without the button all other icon bar are hidden
					var fontsizeselect_id = editor.controlManager.get('fontsizeselect').id;
					$('#'+fontsizeselect_id).hide();
				*/
			});
		}	
	});
}

/*******************************************************************************
* // Make Tabs*/
 
function makeTabs() {
	$('#record #tabs').tabs();
}


/*******************************************************************************
 * // Validate FORM */
function validateForm(){
	$('form.validate').validate({
		 errorElement: "span",
		errorPlacement: function(error, element) {error.appendTo( element.parent("span") );},
	});
}

/*******************************************************************************
 * // for all img with class remove_image_widget // confirm + fadeout somethings :)
 */
function removeImageWidget() {
	$('img.remove_image_widget').live('click',function() {

		var imgID = "";
		var imgHTML = $(this);
		if ($(this).attr('id')) {
			imgID = $(this).attr('id');
			var uploadfyID = imgID.substring(4, imgID.length);	//ID uploadfyID
			var uploadfyClass = $('#class_'+uploadfyID).val();	//<input type="hidden" id="class_<?=$uploadifyName?>" value="image_upload_single" />
		}


		// IF SINGLE (ONLY 1 FILE) OR LIMIT (MAX IMAGE)
		if(uploadfyClass.indexOf("single") > -1 || uploadfyClass.indexOf("limit") > -1){
			$(this).fastConfirm({
				position : "right",
				action : $(this).attr('title'),
				onProceed : function(trigger) {
					$(trigger).fastConfirm('close');
					var table = $("#"+imgID).parents('table');
					var tableID = $(table).attr('id');
						
					//Remove Preview
					if ($('#preview-' + uploadfyID).length > 0){
						$('#preview-' + uploadfyID).html('No Image');
						$('#preview-' + uploadfyID).next('a.small-link').html('');
					}
					
					//Remove TR
					$(imgHTML).parent('td').parent('tr').remove();
					
					//Put empty value to the Filename
					$('#FileName-' + uploadfyID).val('');

					if(uploadfyID.indexOf("limit") > -1){
						var nbImage = parseInt($("#count_" + uploadfyID).val()) - 1;
						var limitImage = parseInt($("#limit_" + uploadfyID).val());
						
						if(nbImage <= 0){
							$(table).find('tr.tr-file-none').show();
						}
						
						if(nbImage < limitImage){
							$("#" + uploadfyID + "_button").css('display', 'block');
							$("#" + uploadfyID).children("embed, object").css('width', $("#" + uploadfyID + "_width").val())
							$("#" + uploadfyID).children("embed, object").css('height', $("#" + uploadfyID + "_height").val() )
							
							$("#" + uploadfyID).parent('div.div-btn-file').css('width', "10%");
							$("#" + uploadfyID).parent('div.div-btn-file').next('div.div-file').css('width', '90%');
							
							$("#" + uploadfyID).css('width', $("#" + uploadfyID).children("embed, object").width());
							$("#" + uploadfyID).css('height', $("#" + uploadfyID).children("embed, object").height());
							
							$("#count_"+uploadfyID).val(nbImage);
						}
					}else{ //single image
						$(table).find('tr.tr-file-none').show();

						$("#" + uploadfyID + "_button").css('display', 'block');
						$("#" + uploadfyID).children("embed, object").css('width', $("#" + uploadfyID + "_width").val())
						$("#" + uploadfyID).children("embed, object").css('height', $("#" + uploadfyID + "_height").val() )
						
						$("#" + uploadfyID).parent('div.div-btn-file').css('width', "15%");
						$("#" + uploadfyID).parent('div.div-btn-file').next('div.div-file').css('width', '85%');
						
						$("#" + uploadfyID).css('width', $("#" + uploadfyID).children("embed, object").width());
						$("#" + uploadfyID).css('height', $("#" + uploadfyID).children("embed, object").height());
						
						$("#count_"+uploadfyID).val(0);
					}
					
					// Display the image type inputs ! 
					if($("#type_"+uploadfyID).length > 0){
						$("#type_"+uploadfyID).show();
					}
				},
				onCancel : function(trigger) {
					$(trigger).fastConfirm('close');
				}
			});
		}else{
			
			// Multiple FILE UPLOAD
			$(this).fastConfirm({
				position : "right",
				action : $(this).attr('title'),
				onProceed : function(trigger) {
					$(trigger).fastConfirm('close');
					var table = $("#"+imgID).parents('table');

					//Remove TR parent of IMG
					$("#"+imgID).parent('td').parent('tr').remove();
					
					//count_file_attach_upload
					var total = parseInt($("#count_"+uploadfyID).val()) - 1 ;
					$("#count_"+uploadfyID).val(total);
					
					if(total == 0){
						//Show Empty TR
						$(table).find('tr.tr-file-none').show();
					}
				},
				onCancel : function(trigger) {
					$(trigger).fastConfirm('close');
				}
			});
		}

	});
}

/*******************************************************************************
 * // Uploadify Only One Image
 */
function uploadifyImageSingle() {
	
	$('input.image_upload_single').each(function() {
		var swfWidth = parseInt($(this).width()) + 14; //padding 6px x 2
		var swfHeight = $(this).outerHeight();
		var textBtn = $(this).val();
		var queueID = $(this).parent('div').next('div.div-file').children('table.uploadifyQueue').attr('id');
		var inputID = $(this).attr('id');
		var inputName = $(this).attr('name');
		var nameSwfUpload = inputName+"_";

		
		$("#" + inputID + "_width").val(swfWidth);
		$("#" + inputID + "_height").val(swfHeight);
			
		$(this).uploadify({
			'swf' : 'theme/js/jquery/uploadify/SWFUpload.swf',
			'uploader' : 'theme/js/jquery/uploadify/uploadify.php',
			'checkExisting' : false,
			'cancelImage' : 'theme/img/delete.gif',
			'auto' : true,
			'buttonText' : textBtn,
			'fileTypeDesc' : 'Image Files',
			'fileTypeExts' : '*.jpg;*.jpeg;*.gif;*.png',
			'width' : swfWidth,
			'height' : swfHeight,
			'fileSizeLimit' : 256000,
			'queueID' : queueID,
			'removeCompleted' : false,
			'multi' : false,
			'nameSWFUpload' : nameSwfUpload,
			'onUploadSuccess' : function(file, data, response) {
				$("#" + inputID + "_button").css('display', 'none');
				$("#" + inputID).css('width', 0);
				$("#" + inputID).css('height', 0);
				
				$("#"+queueID).find('tr.tr-file-none').hide();
				
				$("#" + inputID).parent('div.div-btn-file').css('width', 0);
				$("#" + inputID).parent('div.div-btn-file').next('div.div-file').css('width', '100%');
				
				//$("#SWFUpload_0").css('width', 0);
				//$("#SWFUpload_0").css('height', 0);
				
				$("#count_" + inputID).val(1);
				
				// Display the image type inputs ! 
				if($("#type_image_upload_single").length > 0){
					$("#type_image_upload_single").show();
				}
			}
		});
		
		if ($("#count_" + inputID).val() == 1) {
			// already one image uploaded
			$("#" + queueID).find('tr.tr-file-none').hide();
			// button input swfupload
			$("#" + inputID + "_button").css('display','none');
			
			// div container button input swfupload
			$("#" + inputID).css('width', 0);
			$("#" + inputID).css('height', 0);
			
			$("#" + inputID).parent('div.div-btn-file').css('width', 0);
			$("#" + inputID).parent('div.div-btn-file').next('div.div-file').css('width', '100%');
			
			// object, embed flash swfupload
			//$("#SWFUpload_0").css('width', 0);
			//$("#SWFUpload_0").css('height', 0);
		}

	});
}
	
//Load All Functions
function load(){	
	goToForm();
	goToList();
	
	datePicker();
	tinymceSettings();
	validateForm();
	
	makeTabs();
	
	uploadifyImageSingle();
	removeImageWidget();
}	