<?php

require_once('../include/config.php');

$error = "";

if(!empty($_SESSION['admin_id'])){
	
	if(!empty($_GET['logout'])){
		unset($_SESSION['admin_id']);
		header('Location:index.php'); 
		exit();
	}else{
		header('Location:list.php?module=text');
		exit();
	}
}

if(!empty($_POST)){

	if(!empty($_POST['login']) && !empty($_POST['password'])){
		$admin = new bAdmin();
		$login = $admin->getOne(array("login" => $_POST['login'], "password" => $_POST['password']));
	}else{
		$error = "Login Error";
	}
	
	if(!empty($login)){
		$_SESSION['admin_id']=$login['admin_id'];
		$_SESSION['admin_name']=$login['admin_name'];
		header('Location:list.php?module=text');
		exit;
	}else{
		$error = "Login Error";
	}
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<link rel="icon" href="<?=SITE_URL?>/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="<?=SITE_URL?>/favicon.ico">
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="theme/css/styles.css" />
		<link rel="stylesheet" href="theme/css/custom.css" />
		<link rel="shortcut icon" href="favicon.ico" />
		<meta name="description" content="Webmaster / Webdéveloppeuse à la recherche d'un emploi. Conception et création de sites web (CSS, PHP/MySQL, Javascript, Flash" /> 
		<meta name="keywords" content="Virginie Faure,CV,webmaster,webdeveloppeur,developpement web,creation site, recherche emploi" /> 

		<title>Virginie Faure - CV - Back</title>
		
	</head>
	
	<body>
		<div id="container">
			
			<br /><br />
			<h1>Login</h1>
						
			
			<!-- BACK LOGIN -->
			<div id="back_login">
			
				
				<?php
					if(!empty($error)){
						echo '<div class="box-error">'.$error.'</div><br />';
					}
				?>
				
				<div id="divForm">
					<form id="form_login" name="form_login" action="" method="post">
						<p>
							<label>Login :  </label><br />
							<input type="text" id="login" name="login" class="full" value=""/>
						</p>
						<div class="clear"></div>
						<p>
							<label>Mot de passe : </label> <br />
							<input type="password" id="password" name="password" class="full" value="" />
						</p>
						<div class="clear"></div>
						<br /><br />
						<p class="right">
							<input type="submit" id="submit" name="submit" value="Login" class="btn btn-pink big"/>
						</p>
						<div class="clear"></div>
					</form>
				</div>
				
			</div>
			
		</div>
	</body>
</html>

