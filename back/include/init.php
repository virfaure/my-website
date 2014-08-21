<?php

if(empty($_SESSION['admin_id'])){
	header('Location:index.php'); 
	exit();
}

$module = 'text';
if(!empty($_GET['module'])) $module = $_GET['module'];

?>