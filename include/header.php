<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="<?=$arrText['meta_desc']?>" /> 
		<meta name="keywords" content="<?=$arrText['meta_keywords']?>" /> 
		<meta name="google-site-verification" content="HLMivmuFTAvmUL-Oh5p4wOnI48Dz4sj7QsHiN4LyVMs" />
		
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="favicon.ico" />
	
		<!-- Css-->
		<link rel="stylesheet" href="theme/css/styles.css" type="text/css" />
		<link rel="stylesheet" href="theme/css/webfolio.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="theme/css/timeline.css" type="text/css" media="screen" />
		<!--[if IE]>
			<link rel="stylesheet" href="theme/css/styles-ie.css" type="text/css" media="screen" />
		<![endif]-->
		
		<link rel="stylesheet" href="theme/css/jquery/fancybox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="theme/css/project-fancybox.css" type="text/css" media="screen" />
		
		<!-- gmap -->
		<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?=$googleMapKey?>"></script>
		
		<!-- Jquery-->
		<script type="text/javascript" src="include/constant.js.php"></script>
		<script src="theme/js/jquery-1.6.2.min.js" type="text/javascript"></script>
		<script src="theme/js/jquery/jquery.scrollTo.js" type="text/javascript"></script>
		<script src="theme/js/jquery/jquery.fancybox.js" type="text/javascript"></script>
		<script src="theme/js/jquery/jquery.gmap.js" type="text/javascript"></script>
		<script src="theme/js/jquery/jquery.qtip.js" type="text/javascript"></script>
		
		<script src="theme/js/jquery/cufon/cufon-yui.js" type="text/javascript"></script>
		<script src="theme/js/jquery/cufon/myfont.js" type="text/javascript"></script>
		
		<!-- Custom Functions -->
		<script src="theme/js/functions.js"  type="text/javascript"></script>

		<!-- Place this render call where appropriate -->
		<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
			  {parsetags:'explicit'}
		</script>

		<title><?=$arrText['meta_title']?></title>
		
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-26314131-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>

	</head>