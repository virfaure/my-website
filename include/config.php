<?php
	
	//Session 
	session_start();
	
	///////////////////////////////////////////////////////////
	// CONSTANT
	define('SITE_DIR', dirname(dirname(__FILE__)));	
	define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST']);
	
	$siteDir = SITE_DIR;

	if($_SERVER["SERVER_ADDR"] =='192.168.1.24' || $_SERVER["SERVER_ADDR"] =='127.0.0.1'){
		$siteDir = str_replace('/www', '', $siteDir);
	}

	if($_SERVER["HTTP_HOST"] =='virginie.faure.fr'){
		$googleMapKey = "ABQIAAAAENOYvhGNFlKZ0ziBYaUKwhQG07x0EAq0taXY23knrgE4SjHXbhSr5WYpugCylBuIeAZrlrORv2fkzA";
	}else if($_SERVER["HTTP_HOST"] == 'virginie.faure1.free.fr'){
		$googleMapKey = "ABQIAAAAPNkor6F-Sj8RDYnGrJFxvBSBddVkh7fnmnk288G82cOvxF2pPBT1_isU_rkunH7Z-ZnraTzY1dCGdw";
		require_once "json/jsonwrapper.php";
	}else if($_SERVER["HTTP_HOST"] == 'virfaure.eshost.es'){
		$googleMapKey = "ABQIAAAAPNkor6F-Sj8RDYnGrJFxvBQ6kfUtAhhxRbwlATe3E2Zj5nR10xQwGKC5ahR1A0GLo4hbeHqbbDHl3Q";
	}
	
	
	$path = SITE_DIR.'/include';
	set_include_path(get_include_path() . PATH_SEPARATOR . $path);

	define('FR', 1);	
	define('ES', 2);
	
	define('JAVASCRIPT', 12);	
	
	define('ENABLE', 1);
	define('PROJECT_IMAGE_DIR', "/theme/img/webfolio/");
	define('IMAGE_TMP_DIR', "/theme/img/tmp/");
	define('IMAGE_TYPE_MINI', 1);
	define('IMAGE_TYPE_POPUP', 2);
	

	///////////////////////////////////////////////////////////
	//BDD
	if($_SERVER["HTTP_HOST"] == 'virfaure.eshost.es'){
		define('DB_TYPE','mysql'); 			
		define('DB_HOST','sql103.eshost.es'); 			
		define('DB_USER','eshos_9188887');		
		define('DB_PASS','220682');		
		define('DB_DATABASE','eshos_9188887_virfaure');				
	}else{
		define('DB_TYPE','mysql'); 			
		define('DB_HOST','localhost'); 			
		define('DB_USER','virginie.faure1');		
		define('DB_PASS','220682');		
		define('DB_DATABASE','virginie.faure1');				
	}
	
	define('DEBUG',2);
	///////////////////////////////////////////////////////////
	
	function __autoload($class_name) {
	    if(file_exists(SITE_DIR.'/class/'.$class_name.'.class.php')) {
	        $class_file = SITE_DIR.'/class/'.$class_name.'.class.php';
	    }
		
		if(file_exists(SITE_DIR.'/back/class/'.$class_name.'.class.php')) {
	        $class_file = SITE_DIR.'/back/class/'.$class_name.'.class.php';
	    }
   
		if(isset($class_file)) {
			require_once $class_file;
		}    
	}
	
	

	// LANGUAGE
	$objLang = new Language();
	$arrLang = $objLang->get();
	
	/*if(empty($_SESSION['langue_ini'])){
		if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
			$lang = explode(",",$_SERVER['HTTP_ACCEPT_LANGUAGE']);
			$lang = strtolower(substr(chop($lang[0]),0,2)); 
			$_SESSION['langue_ini']=$lang;
		}else{
			//espagnol par defaut
			$_SESSION['langue_ini']='es';
		}
	}else{
		if(!empty($_POST['langue_ini'])){
			$_SESSION['langue_ini']=$_POST['langue_ini'];
		}
	}*/
	
	if(empty($_SESSION['language_locale'])){
		$_SESSION['language_locale'] = 'ES_ES';	//by default
	}
	
	if(!empty($_POST['language_locale'])){	//change lang
		$_SESSION['language_locale'] = $_POST['language_locale'];
	}
		
	$_SESSION['language_id'] = $objLang->get(array("language_locale" => $_SESSION['language_locale']), "language_id");
			
	// TRADUCTIONS JS
	$objTrad = new Traduction();
	$arrTextJS = $objTrad->get(array("page_id" => JAVASCRIPT, "language_id" => $_SESSION['language_id']));

	
?>