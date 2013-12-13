<?php
include_once("./classes/functions.php");	


$cur=curPageURL();

$html.=<<<cd
	<div class="share-this">
		<span class="share_button">
			<a href="#" title="اشتراک">
				<img src="themes/images/add-this.png" alt="Share This">
			</a>
		</span>
		<span class="share_buttons" style="right: -90px;">
			<a href="https://plus.google.com/share?url={$cur}" target="_blank" title="Google Plus">
				<img src="themes/images/google-share.png" alt="Google Plus">
			</a>
			<a href="https://twitter.com/home?status={$cur}" target="_blank" title="Twitter">
				<img src="themes/images/twitter-share.png" alt="Twitter">
			</a>
			<a href="https://www.facebook.com/sharer/sharer.php?u={$cur}" target="_blank" title="Facebook">
				<img src="themes/images/facebook-share.png" alt="Facebook">
			</a>
		</span>
	</div>
cd;

?>