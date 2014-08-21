<?php
	
require_once('include/config.php');

///////////////////////////////////////////////////////////
// VARIABLES
		
//$_SESSION['language_locale'] = 'ES_ES';
//$_SESSION['language_id'] = $objLang->get(array("language_locale" => $_SESSION['language_locale']), "language_id");
	
///////////////////////////////////////////////////////////
// Texts
//$objTrad = new Traduction();
$arrText = $objTrad->get(array("language_id" => $_SESSION['language_id']));

// Experiences
$objExperience = new Experience();
$arrExperience = $objExperience->get(array("language_id" => $_SESSION['language_id']));

// Projects
$objProject = new Project();
$arrProject = $objProject->get(array("language_id" => $_SESSION['language_id'], "project_image_type_id" => IMAGE_TYPE_MINI));

// Util
$objUtil = new Util()

?> 

<!-- Header CSS + JS -->
<?php include 'include/header.php' ?>

	<body>	
		
		<!-- Line top -->
		<?php include 'include/switcher.php' ?>
			
		<div id="center">
			
			<!-- Logo + Navigation -->
			<?php include 'include/top.php' ?>
			
			<!-- About Me -->
			<?php include 'include/about.php' ?>
			
			<!-- Skills -->
			<?php include 'include/skill.php' ?>
			
			<!-- Experiences -->
			<?php include 'include/experience.php' ?>
			
			<!-- Webfolio -->
			<?php include 'include/webfolio.php' ?>
			
		</div>
		
		<!-- Contact -->
		<?php include 'include/contact.php' ?>
				
	</body>
	
</html>