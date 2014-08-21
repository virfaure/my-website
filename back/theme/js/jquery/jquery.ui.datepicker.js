/* English/UK initialisation for the jQuery UI date picker plugin. */
/* Written by Stuart. */
jQuery(function($){
	$.datepicker.regional['en'] = {
		closeText: 'Done',
		prevText: 'Prev',
		nextText: 'Next',
		currentText: 'Today',
		monthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'],
		monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
		dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
		dayNamesMin: ['Su','Mo','Tu','We','Th','Fr','Sa'],
		weekHeader: 'Wk',
		dateFormat: 'mm/dd/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: '',
		altFormat: 'dd/mm/yy', 
		dateFormat: 'dd/mm/yy', 
		showOn: "both", 
		buttonImage: "theme/img/calendar.gif", 
		buttonImageOnly: true,
		changeMonth: true,
		changeYear: true,
		showButtonPanel: false,
		onSelect: function(dateText, inst){
			// Refocus the field onSelect => to validate date-range 
			// not working with IE7
			//this.focus();
		},
		beforeShow: function(input, inst) {
			//ADD picker-open Class to input to know if datepicker is open
			$('#'+inst.id).addClass('picker-open');
		},
		onClose: function(input, inst) {
			//Remove picker-open Class to input
			$('#'+inst.id).removeClass('picker-open');
		}
	};
	$.datepicker.setDefaults($.datepicker.regional['en']);
	
	/*$.timepicker.regional['en'] = {
		timeOnlyTitle: 'Choose Time',
		timeText: 'Hour',
		hourText: 'Hour',
		minuteText: 'Minute',
		ampm: false,
		hourGrid: 10,
		minuteGrid: 10,
		showButtonPanel: false,
		showOn: "button",
		timeFormat: "hh:mm",
		onSelect: function(dateText, inst){
			// Refocus the field onSelect
			this.focus();
		}
	};
	$.timepicker.setDefaults($.timepicker.regional['en']);*/
});
