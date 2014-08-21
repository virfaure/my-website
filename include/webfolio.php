<!-- WEBFOLIO-->
<div id="webfolio">
	
	<br />
	
	<div id="to-top">
		<hr />
		<div class="buttons">
			<div class="to-about"><img src="theme/img/to-top/about.png" title="<?=$arrText['go_to_aboutme']?>" alt="#about" class="tiptip scrollTo" /></div>
			<div class="to-webfolio"><img src="theme/img/to-top/webfolio.png" title="<?=$arrText['go_to_webfolio']?>" alt="#webfolio" class="tiptip scrollTo" /></div>
			<div class="to-contact"><img src="theme/img/to-top/contact.png" title="<?=$arrText['go_to_contact']?>" alt="#contact" class="tiptip scrollTo" /></div>
			<div class="clear"></div>
		</div>
	</div>

	<!--titre -->
	<h3><?=$arrText['titre_webfolio']?></h3>
	
	<!--center-->
	<div class="div_center">
		<ul>
			
			<?php
				foreach($arrProject as $key => $project){ ?>
			
						<li class="block">
							<a rel="fancybox" href="include/ajax/project.php?project_id=<?=$project['project_id']?>">
								<img src="<?=SITE_URL.PROJECT_IMAGE_DIR.$project['project_image_url']?>" alt="<?=$project['project_name']?>" />
							</a>
							<div class="caption_title"><?=$project['project_name']?></div>
							<div class="caption_subtitle"><?=$project['project_caption']?></div>
						</li>
			<?	} ?>

		</ul>
		
		<div class="clear"></div>
	</div>
	
</div>

<div id="to-top-webfolio">
	<div class="buttons">
		<div class="to-about"><img src="theme/img/to-top/about.png" title="<?=$arrText['go_to_aboutme']?>" alt="#about" class="tiptip scrollTo" /></div>
		<div class="to-webfolio"><img src="theme/img/to-top/webfolio.png" title="<?=$arrText['go_to_webfolio']?>" alt="#webfolio" class="tiptip scrollTo" /></div>
		<div class="to-contact"><img src="theme/img/to-top/contact.png" title="<?=$arrText['go_to_contact']?>" alt="#contact" class="tiptip scrollTo" /></div>
		<div class="clear"></div>
	</div>
</div>