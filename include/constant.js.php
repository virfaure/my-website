<?
	require_once('config.php');
?>
window.constantPHP = {};
window.constantPHP["SITE_URL"] = "<?=SITE_URL?>";
window.constantPHP["SITE_DIR"] = "<?=SITE_DIR?>";
window.constantPHP["PROJECT_IMAGE_DIR"] = "<?=PROJECT_IMAGE_DIR?>";
window.constantPHP["IMAGE_TMP_DIR"] = "<?=IMAGE_TMP_DIR?>";

window.arrTextJS = {};

<?php foreach($arrTextJS as $key => $data){ ?>
		window.arrTextJS["<?=$key?>"] = "<?=$data?>";
<?	} ?>