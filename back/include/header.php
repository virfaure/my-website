<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="<?=SITE_URL?>/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="<?=SITE_URL?>/favicon.ico">
		
		<link rel="stylesheet" href="theme/css/styles.css" />
		<link rel="stylesheet" href="theme/css/custom.css" />
		<link rel="stylesheet" href="theme/css/jquery/jquery-ui-1.8.16.custom.css"  type="text/css" />
		<link rel="stylesheet" href="theme/css/jquery/fastconfirm.css"  type="text/css" />
		
		<link rel="shortcut icon" href="favicon.ico" />
		<meta name="description" content="Webmaster / Webdéveloppeuse à la recherche d'un emploi. Conception et création de sites web (CSS, PHP/MySQL, Javascript, Flash" /> 
		<meta name="keywords" content="Virginie Faure,CV,webmaster,webdeveloppeur,developpement web,creation site, recherche emploi" /> 

		<title>Virginie Faure - CV - Back</title>
		
		<!-- Tinymce -->
		<script type="text/javascript" src="theme/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript" src="theme/js/jquery/uploadify/swfobject.js"></script>
		<script type="text/javascript" src="theme/js/jquery/uploadify/swfupload.js"></script>
		
		<!-- Jquery + Plugins -->
		<script type="text/javascript" src="<?=SITE_URL?>/theme/js/jquery-1.6.2.min.js"></script> <!-- From FRONT -->
		<script type="text/javascript" src="<?=SITE_URL?>/include/constant.js.php"></script> <!-- From FRONT -->
		<script type="text/javascript" src="theme/js/jquery/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="theme/js/jquery/jquery.ui.datepicker.js"></script>
		<script type="text/javascript" src="theme/js/jquery/uploadify/jquery.uploadify.js"></script>
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
		<script type="text/javascript" src="theme/js/jquery/jquery.dataTables.js"></script>
		<script type="text/javascript" src="theme/js/jquery/jquery.fastconfirm.js"></script>
		<script type="text/javascript" src="theme/js/jquery/jquery.alerts.js"></script>
		
		<script type="text/javascript" src="theme/js/functions.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){
				load();
			});
		</script>
		
		<?php if(!empty($_GET['module'])){
				// Additional Function JS
				$file = "module/".$module."/js/functions.js";

				if (is_file($file)) { ?>
					<script type="text/javascript" src="module/<?=$module?>/js/functions.js"></script>
		<?		}  
			}	
		?>
		
	</head>
<body>

	<? if(!empty($_SESSION['admin_id'])){?>
	<!-- Header -->
	<div id="top">
		<div class="wrapper">
			<div id="title"><img src="theme/img/logo.png" alt="Virginie FAURE" /></div>
			
			<!-- Top navigation -->
			<div id="topnav">
				Logged in as <b>Admin</b>
				<span>|</span> <a href="index.php?logout=1">Logout</a><br />
			</div>
			<!-- End of Top navigation -->
			
			<!-- Main navigation -->
			<div id="menu">
				<ul class="sf-menu">
					<li <?if(isset($_GET['module']) && $_GET['module']=='text'){?>class="current"<?}?>><a href="list.php?module=text">Texts</a></li>
					<li <?if(isset($_GET['module']) &&  $_GET['module']=='language'){?>class="current"<?}?>><a href="list.php?module=language">Languages</a></li>
					<li <?if(isset($_GET['module']) &&  $_GET['module']=='page'){?>class="current"<?}?>><a href="list.php?module=page">Pages</a></li>
					<li <?if(isset($_GET['module']) &&  $_GET['module']=='project'){?>class="current"<?}?>><a href="list.php?module=project">Projects</a></li>	
					<li <?if(isset($_GET['module']) &&  $_GET['module']=='experience'){?>class="current"<?}?>><a href="list.php?module=experience">Experiences</a></li>	
					<li <?if(isset($_GET['module']) &&  $_GET['module']=='variable'){?>class="current"<?}?>><a href="list.php?module=variable">Variables</a></li>	
				</ul>
			</div>
			
			<div class="clear"></div>
			<!-- End of Main navigation -->

		</div>
		<input type="hidden" id="module" name="module" value="<?=$module?>" />				
	</div >
<? } ?>