<?php
/*
Uploadify v3.0.0
Copyright (c) 2010 Ronnie Garcia

Return true if the file exists
*/

include('../../../core/init.php');

if (file_exists(SITEFILEPATH . '/' . $_POST['filename'])) {
	echo 1;
} else {
	echo 0;
}
?>