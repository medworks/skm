<?php

$html=<<<cd
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a>تماس با ما</a>
			</div>
			<div id="intro" class="text-intro">
				<h1>تماس با ما</h1>
			</div>
			<div class="full_page">
				<div id="contact">
					<h3>مکان ما بر روی نقشه</h3>
					<div class="full_page border-box">
						<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""></iframe>
					</div>
					<div class="one_third">
						<h3>آدرس</h3>
						<p>
							مشهد - بلوار پیروزی
						</p>
						<p>تلفن: +01 555 55 55</p>
						<p>فاکس: +01 555 12 34</p>
						<p><a href="#">name@domain.com</a> :ایمیل</p>
					</div>
					<div class="two_third last">
						<h3>فرم تماس</h3>
						<div class="wpcf7" id="wpcf7-f853-p322-o1">
							<form action="" method="post" class="wpcf7-form">
								<div style="display: none;">
									<input type="hidden" name="_wpcf7" value="853"><br>
									<input type="hidden" name="_wpcf7_version" value="3.5.4"><br>
									<input type="hidden" name="_wpcf7_locale" value=""><br>
									<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f853-p322-o1"><br>
									<input type="hidden" name="_wpnonce" value="700208ddec">
								</div>
								<p>نام و نام خانوادگی (*)<br>
		   							<span class="wpcf7-form-control-wrap your-name">
		   								<input type="text" name="your-name" value="" size="40" class="rtl wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true">
		   							</span>
		   						</p>
								<p>ایمیل (*)<br>
		    						<span class="wpcf7-form-control-wrap your-email">
		    							<input type="text" name="your-email" value="" size="40" class="rtlwpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true">
		    						</span>
		    					</p>
								<p>پیام<br>
		    						<span class="wpcf7-form-control-wrap your-message">
		    							<textarea name="your-message" cols="40" rows="10" class="rtl wpcf7-form-control wpcf7-textarea"></textarea>
		    						</span>
		    					</p>
								<p>
									<img class="ajax-loader" src="themes/images/ajax-loader.gif" alt="ارسال ..." style="visibility: hidden;">
									<input type="submit" value="ارسال پیام" class="wpcf7-form-control wpcf7-submit">
								</p>
								<div class="wpcf7-response-output wpcf7-display-none"></div>
							</form>
						</div>
					</div>
					<p><br class="clear"></p>

				</div>
			</div>
		</div>
	</div>
cd;

return $html;
?>