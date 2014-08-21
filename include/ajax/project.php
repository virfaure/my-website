<?

/*header("Content-Type: text/html; charset=utf-8");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");*/


require_once('../config.php');

$objTrad = new Traduction;
$objProj = new Project;

$arrProject = $objProj->getOne(array('project_id' => $_GET['project_id'], 'project_image_type_id' => IMAGE_TYPE_POPUP));

?>

<!--
<div class="fancyboxProject">
	<div class="fancyboxProjectLeft"><a href="<?=$arrProject['project_url']?>" target="_blank"><img src="<?=SITE_URL.PROJECT_IMAGE_DIR.$arrProject['project_image_url']?>" alt="<?=$arrProject['project_name']?>" style="width:<?=$arrProject['project_image_width']?>px;height:<?=$arrProject['project_image_height']?>px;" /></a></div>
	<div class="fancyboxProjectRight">
		<div class="fancyboxProjectTitle"><?=$arrProject['project_name']?></div>
		<div class="fancyboxProjectDescription"><?=$arrProject['project_description']?></div>
		
		<div class="clear"></div>
		
		<div class="fancyboxProjectTitle"><?=$objTrad->getOne('work_done')?></div>
		<div class="fancyboxProjectDescription"><?=$arrProject['project_work']?>
			<div class="clear"></div>
		</div>
		
		<div class="fancyboxProjectTitle"><?=$objTrad->getOne('project_url')?></div>
		<div class="fancyboxProjectDescription"><a href="<?=$arrProject['project_url']?>" target="_blank"><?=$arrProject['project_url']?></a></div>
	</div>
	<div class="clear"></div>
</div>-->
<table cellpadding = "0" cellspacing = "0" border="0" class="fancyboxProject">
	<tbody>
		<tr>
			<td class="fancyboxProjectLeft"><a href="<?=$arrProject['project_url']?>" target="_blank"><img src="<?=SITE_URL.PROJECT_IMAGE_DIR.$arrProject['project_image_url']?>" alt="<?=$arrProject['project_name']?>" style="width:<?=$arrProject['project_image_width']?>px;height:<?=$arrProject['project_image_height']?>px;" /></a></td>
			<td class="fancyboxProjectRight">
				<div class="fancyboxProjectTitle"><?=$arrProject['project_name']?></div>
				<div class="fancyboxProjectDescription"><?=$arrProject['project_description']?></div>
				
				<div class="clear"></div>
				
				<div class="fancyboxProjectTitle"><?=$objTrad->getOne('work_done')?></div>
				<div class="fancyboxProjectDescription"><?=$arrProject['project_work']?>
					<div class="clear"></div>
				</div>
				
				<div class="fancyboxProjectTitle"><?=$objTrad->getOne('project_url')?></div>
				<div class="fancyboxProjectDescription"><a href="<?=$arrProject['project_url']?>" target="_blank"><?=$arrProject['project_url']?></a></div>
	
			</td>
		</tr>
	</tbody>
</table>
<div id="fancyboxProjectClose"><div id="fancyboxProjectBtnClose"><img src="theme/img/fancybox/close.gif" alt="Close" /></div></div>

