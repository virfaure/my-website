<div id="top">
	<div id="logo"><img src="theme/img/top/logo.png" alt="Virginie FAURE" /></div>
	
	<div id="menu">
	
		<!-- About Me -->
		<div class="link about">
			<a href="#about" title="<?=$arrText['about']?>"><span class="iconLink"></span><span class="title"><?=$arrText['about']?></span><span class="subtitle"><?=$arrText['about_subtitle']?></span>
			</a>
		</div>
		<div class="sep"><img src="theme/img/top/sep_menu.gif" alt="" /></div>
		
		<!-- Webfolio -->
		<div class="link webfolio">
			<a href="#webfolio" title="<?=$arrText['webfolio']?>"><span class="iconLink"></span><span class="title"><?=$arrText['webfolio']?></span><span class="subtitle"><?=$arrText['webfolio_subtitle']?></span></a>
		</div>
		<div class="sep"><img src="theme/img/top/sep_menu.gif" alt="" /></div>
		
		<!-- Contact -->
		<div class="link contact last">
			<a href="#contact" title="<?=$arrText['contact']?>"><span class="iconLink"></span><span class="title"><?=$arrText['contact']?></span><span class="subtitle"><?=$arrText['contact_subtitle']?></span></a>
		</div>
	</div>
	
	<!--<div id="form_lng">
		<form id="change_lng" action="" method="post">
			<p>
				<input type="hidden" id="langue_ini" name="langue_ini" />
				{foreach from=$list_langue item="langue" name="langue"}
					<img src="{$langue.langue_img}" alt="{$langue.langue_nom}" {if $smarty.session.langue_ini==$langue.langue_ini}class="lng_opacity"{/if} onclick="changeLang('{$langue.langue_ini}');"/>&nbsp;
				{/foreach}
			</p>
		</form>
	</div>-->
	<div class="clear"></div>
</div>