<div id="top-line">
	<div id="lang-switcher">
		<form id="post-lang" action="" method="post">
			<input type="hidden" id="language_locale" name="language_locale" />
		</form>
		<div id="lang-switcher-float">
			<ul>
			<?php
				foreach($arrLang as $key => $lang){
					if($_SESSION['language_locale'] == $lang['language_locale']) $class = "active";
					else $class = "opacity";
					
					echo '<li class="'.$class.'"><img src="'.$lang["language_image"].'" alt="'.$lang["language_locale"].'" class="lang  '.$class.'" /></li>';
				} 
			?>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
</div>