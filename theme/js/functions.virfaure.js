 $(document).ready(function() {
 	
	/* Styles for Qtip */
	$.fn.qtip.styles.qtipDark = { // Last part is the name of the style
		background: '#505050',
		color: 'white',
		textAlign: 'left',
		border: {
			width: 1,
			color: '#303030'
		},
		title:{
			background: '#404040',
			color: 'white'
		},
		tip: { 
			corner: 'topMiddle', 
			color: '#404040',
			size: {
				x: 8,
				y : 5 
			}
		},
		width: {
			max:500
		}
	}
	
	$.fn.qtip.styles.qtipDarkSkill = { // Last part is the name of the style
		background: '#505050',
		color: 'white',
		textAlign: 'left',
		border: {
			width: 1,
			color: '#303030'
		},
		title:{
			background: '#404040',
			color: 'white'
		},
		tip: { 
			corner: 'leftMiddle', 
			color: '#404040',
			size: {
				x: 8,
				y : 5 
			}
		}
	}
	

	/*******************************************************************/
	//CUFON
	Cufon.replace('#menu a', {hover: true});
	Cufon.replace(["#temp h3","#about h3", "#skill h3", "#experience h3", "#webfolio h3", "#contact h3", "#contact label", "#contact span.textarea_error", "#contact span.text"]);		
	
	/*******************************************************************/
	// Tool tip
	$('.tiptip').qtip({
		style: 'qtipDark',
		position: {
			corner: {
				target: "bottomMiddle",
				tooltip: "topMiddle"
			}
		},
		show:{
			delay:0,
			effect: { type: 'slide'}
		}
	});
	 
	 
	/*******************************************************************/
	// SCROLL
	$('#menu a').each(function(){	
		$(this).click(function(){	
			var href = $(this).attr("href");
			$.scrollTo(href, 400);
		});
	});
	
	
	$('img.scrollTo').each(function(){	
		$(this).click(function(){	
			var alt = $(this).attr("alt");
			$.scrollTo(alt, 400);
		});
	});
	
	/*******************************************************************/
	// SKILL
	$('div.skill').each(function(){	
		// Hover
		$(this).hover(function(){
			$(this).addClass("hover");
		},function(){
			$(this).removeClass("hover");
		});
			
		$(this).qtip({
			style: 'qtipDarkSkill',
			position: {
				corner: {
					target: "rightMiddle",
					tooltip: "leftMiddle"
				}
			},
			show:{
				effect: { type: 'fade', length:0 }
			}
		});
	});
	
	//Height of Shadow bars
	$("div.graphShadow").css("height", $("div.graphBars").height());
	
	/*******************************************************************/
	// TIMELINE
	$('div.pin-school, div.pin-work').each(function(){	
		// Hover
		$(this).hover(function(){
			$(this).addClass("hover");
		},function(){
			$(this).removeClass("hover");
		});
		
		var title = $(this).find("div.title").html();
		var content = $(this).find("div.text").html();
		
		$(this).qtip({
			content:{
				title:title,
				text:content
			},
			style: 'qtipDark',
			position: {
				corner: {
					target: "bottomMiddle",
					tooltip: "topMiddle"
				}
			},
			show:{
				
				effect: { type: 'fade', length:0 }
			}
		});
	});
	
	
	/*******************************************************************/
	// FADE WEBFOLIO
	$(".block img").fadeTo("normal", 0.4); // This sets the opacity of the thumbs to fade down to 60% when the page loads
	
	$(".block img").hover(function(){
		$(this).fadeTo("normal", 1.0); // This should set the opacity to 100% on hover
	},function(){
   		$(this).fadeTo("normal", 0.4); // This should set the opacity back to 60% on mouseout
	});


	/*******************************************************************/
	// FACEBOX
	// $('a[rel*=facebox]').facebox();
	 $('a[rel*=fancybox]').fancybox({
		overlayOpacity:'0.4',
		overlayColor:'#000000',
		padding:0,
		cyclic:true,
		showCloseButton:false,
		onStart:function(){ 
			$('#fancybox-close').remove(); 	
		},
		onComplete:function(){ 
			$('#fancyboxProjectBtnClose').click(function(){
				$.fancybox.close();
			});	
			
			//get width of image in left part
			//var widthTotal = $(".fancyboxProjectLeft").width() + $(".fancyboxProjectRight").width() + 25;
			//$(".fancyboxProject").width(widthTotal);
		}
	});


	/*******************************************************************/
	// FOCUS + BLUR CONTACT
	$("#formContact").find("input, textarea").each(function(){
		// Focus
		$(this).focus(function(){
			$(this).parent("p").css("background-position", "bottom left");
		});
		
		//Blur
		$(this).blur(function(){
			$(this).parent("p").css("background-position", "top left");
			var value = $(this).val();
			if(value != ""){$(this).next("span").hide();}
			else $(this).next("span").show();
		});	
	});
	
	// INPUT SUBMIT HOVER
	$('#contact_submit').hover(function(){
		$(this).addClass("hover");
	},function(){
		$(this).removeClass("hover");
	});

	
	//action bouton
	clickSubmit();
	
	var options = {
		'zoom': 6,
		'center': {
			'lat': 41.400505,
			'long': 2.177353
		},
		'html_prepend': '<div class="gmap_marker">',
		'html_append': '</div>',	
		'markers': [
						{
							address: "Barcelona, España",
							html: "<div class='title'>Barcelona, España</div><div class='text'>"+window.arrTextJS["gmap_barcelona"]+"</div>",
							icon:{
								image: "theme/img/contact/pin.png",
								iconsize: [37, 34],
								iconanchor: [10, 30],
								infowindowanchor: [17, 6] 
							}
						},
						{ 
							 address: "Albi, France",
							 html: "<div class='title'>Albi, France</div><div class='text'>"+window.arrTextJS["gmap_albi"]+"</div>",
							icon: {
									image: "theme/img/contact/pin.png",
									iconsize: [37, 34],
									iconanchor: [10, 30],
									infowindowanchor: [17, 6] 
							}
						},
						{ 
							 address: "Lyon, France",
							 html: "<div class='title'>Lyon, France</div><div class='text'>"+window.arrTextJS["gmap_lyon"]+"</div>",
							 icon: {
									image: "theme/img/contact/pin.png",
									iconsize: [37, 34],
									iconanchor: [10, 30],
									infowindowanchor: [17, 6] 
							}
						},
						{ 
							 address: "Rodez, France",
							 html: "<div class='title'>Rodez, France</div><div class='text'>"+window.arrTextJS["gmap_rodez"]+"</div>",
							icon: {
									image: "theme/img/contact/pin.png",
									iconsize: [37, 34],
									iconanchor: [10, 30],
									infowindowanchor: [17, 6] 
							}
						},
						{ 
							 address: "Bayonne, France",
							 html: "<div class='title'>Bayonne, France</div><div class='text'>"+window.arrTextJS["gmap_bayonne"]+"</div>",
							icon: {
									image: "theme/img/contact/pin.png",
									iconsize: [37, 34],
									iconanchor: [10, 30],
									infowindowanchor: [17, 6] 
							}
						}
					]		
	}

	// GoogleMap
	$("#gmap").gMap({
		latitude : options.center.lat,
		longitude : options.center.long,
		zoom : options.zoom,
		html_prepend : options.html_prepend,
		html_append : options.html_append,
		markers : options.markers,
		controls : [ 'GSmallZoomControl3D' ]
    });
	
});

function clickSubmit(){
	

	$("#submitContact").click(function(){
				
		$("contactError").hide();
		$('span.error, span.textarea_error').hide();
		
		var name=$("#name").val();
		if(name==""){$("#name_error").show();$("#name").focus();return false;}
		
		var email=$("#email").val();
		if(email==""){$("#email_error").show();$("#email").focus();return false;}
		
		var msg=$("#message").val();
		if(msg==""){$("#message_error").show();$("#message").focus();return false;}
		
		var dataString='name='+name+'&email='+email+'&msg='+msg;
		
		$.ajax({
			type:"POST",
			url:"include/ajax/contact.php",
			data:dataString,
			success:function(req){
				var arr = req.split("|");
				if(arr[0]=="err"){
					$("#contactError").html(arr[1]);
					$("#contactError").show();
					Cufon.replace("#contactError");
					
					$("#email_error").show();
					$("#email").focus();
				}else{
					$('#contactOk').html(arr[1]);
					$('#contactOk').show();
					$("#contactError").hide();
					Cufon.replace("#contactOk");		
				}
			}
		});
		return false;
	});
	
}