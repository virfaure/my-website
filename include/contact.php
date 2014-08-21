<div id="contact-background">
	
	<div id="contact">
		<br />
		
		<!--titre -->
		<h3><?=$arrText['contact']?></h3>
		
		<br />

		<div class="left">
			<div class="text"><?=$arrText['texte_contact']?></div>
			
			<br />
			
			<form id="formContact" action="">
				<p class="bg_input">
					<label><?=$arrText['name']?> :</label>
					<input id="name" name="name" type="text" />
					<span id="name_error" class="error">&nbsp;</span>
				</p>
				<p class="bg_input">
					<label><?=$arrText['email']?> :</label>
					<input id="email" name="email" type="text" />
					<span id="email_error" class="error">&nbsp;</span>
				</p>
				
				<p class="bg_textarea">
					<label><?=$arrText['message']?> :</label>
					<textarea id="message" name="message" class="contact" cols="" rows=""></textarea>
					<span id="message_error" class="textarea_error"><?=$arrText['error_message_empty']?></span>
				</p>
				
				<p id="contactError" style="display:none;"></p>
				<p id="contactOk" style="display:none;"></p>
				
				<p>
					<input type="submit" value="&nbsp;" id="submitContact" class="submit submit_<?=$_SESSION['language_locale']?>" />
				</p>
			</form>
		</div>
		
		<div class="right">
			<div id="social">
				<div class="icon"><img src="theme/img/contact/linkedin.png" alt="<?=$arrText['linkedin']?>" /><span class="text"><?=$arrText['linkedin']?> : </span><a href="http://es.linkedin.com/in/virfaure" target="_blank">http://es.linkedin.com/in/virfaure</a></div>
				<div class="icon"><img src="theme/img/contact/email.png" alt="<?=$arrText['email']?>" /><span class="text"><?=$arrText['email']?> : </span><a href="mailto:virfaure@gmail.com">virfaure[at]gmail.com</a></div>
			</div>
			
			<br />
			
			<div id="mapShadow">
				<div id="map">
					<!-- GMAP -->
					<div id="gmap"></div>
				</div>
			</div>
		</div>

		<div class="clear"></div>
			
	</div>
		
	<br /><br />
	
	<!-- Footer -->
	<div id="footer">
		<div class="text"><?=$arrText['footer_text']?></div>
		<br />
		<div id="plusone-div" class="g-plusone"></div>
		<script type="text/javascript">
			gapi.plusone.render('plusone-div',{"size": "small", "count": "true"});
		</script>	
	</div>
</div>