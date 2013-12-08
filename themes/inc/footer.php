<?php
	include_once("./classes/database.php");
	include_once("./lib/persiandate.php");
	$db = Database::GetDatabase(); 
	$About_System = GetSettingValue('About_System',0);
	$news = $db->SelectAll('news',NULL,NULL," ndate DESC");
	$works = $db->SelectAll('works',NULL,NULL," fdate DESC");
	$articles = $db->SelectAll('articles',NULL,NULL," ndate DESC");
	$About_System = mb_substr(html_entity_decode(strip_tags($About_System), ENT_QUOTES, "UTF-8"), 0, 500,"UTF-8")."  ...";
	$address = GetSettingValue('Address',0);
	$tel = GetSettingValue('Tell_Number',0);
	$fax = GetSettingValue('Fax_Number',0);
?>
<div id="footer_wrapper">
	<div id="footer">
		<div id="e404_flickr-3" class="one_fourth widgets widget_flickr">
			<h3>گالری تصاویر</h3>
			<ul class="flickr">
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0159"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0159"></a>
				</li>
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0103"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0103"></a>
				</li>
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0126"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0126"></a>
				</li>
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0090"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0090"></a>
				</li>
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0135"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0135"></a>
				</li>
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0119"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0119"></a>
				</li>
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0109"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0109"></a>
				</li>
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0154"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0154"></a>
				</li>
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0142"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0142"></a>
				</li>
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0120"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0120"></a>
				</li>
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0138"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0138"></a>
				</li>
				<li>
					<a href="#" rel="prettyphoto" title="DSC_0131"><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0131"></a>
				</li>
			</ul>
		</div>
		<div id="linkcat-2" class="one_fourth widgets widget_links">
			<h3>لینک های مفید</h3>
			<ul class="xoxo blogroll">
				<li><a href="#">لینک یک</a></li>
				<li><a href="#">لینک دو</a></li>
				<li><a href="#">لینک سه</a></li>
				<li><a href="#">لینک چهار</a></li>
			</ul>
		</div>
		<div id="e404_twitter-3" class="one_fourth widgets widget_twitter"><h3>اخبار</h3>
			<ul class="tweets">
				<li>
					<a href="#" title=""><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0159"></a>
					<a href="#">لینک یک لینک یک لینک یک لینک</a>
				</li>
				<br class="clear">
				<li>
					<a href="#" title=""><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0159"></a>
					<a href="#">لینک یک</a>
				</li>
				<br class="clear">
				<li>
					<a href="#" title=""><img src="themes/images/demo/smallpic.jpg" width="50" height="50" alt="DSC_0159"></a>
					<a href="#">لینک یک</a>
				</li>
				<br class="clear">
			</ul>
		</div>
		<div id="custom_cf7-3" class="one_fourth widgets widget_custom_cf7">
			<h3>تماس با ما</h3>
	    	<div id="cf7_form_box">
	    	    <div class="wpcf7" id="wpcf7-f853-w1-o1">
					<form action="" method="post" class="wpcf7-form">
						<div style="display: none;">
						<input type="hidden" name="_wpcf7" value="853"><br>
						<input type="hidden" name="_wpcf7_version" value="3.5.2"><br>
						<input type="hidden" name="_wpcf7_locale" value=""><br>
						<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f853-w1-o1"><br>
						<input type="hidden" name="_wpnonce" value="700208ddec">
						</div>
						<p>نام و نام خانوادگی (*)<br>
						    <span class="wpcf7-form-control-wrap your-name">
							    <input type="text" name="your-name" value="" size="40" class="rtl wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true">
							</span>
						</p>
						<p>ایمیل شما (*)<br>
						    <span class="wpcf7-form-control-wrap your-email">
						    	<input type="text" name="your-email" value="" size="40" class="ltr wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true">
						    </span>
						</p>
						<p>پیام شما<br>
						    <span class="wpcf7-form-control-wrap your-message">
						    	<textarea name="your-message" cols="40" rows="10" class="rtl wpcf7-form-control wpcf7-textarea"></textarea>
						    </span>
						</p>
						<p>
							<input type="submit" value="ارسال پیام" class="wpcf7-form-control wpcf7-submit">
						</p>
						<div class="wpcf7-response-output wpcf7-display-none"></div>
					</form>
				</div>
	    	    <div class="clear"></div>
	    	</div>
	    </div>
		<br class="clear">
	</div>
	<div id="copyright" class="latin-font">
		<div class="last right fright">Designed by: 
			<a href="http://www.mediateq.ir">Mediateq</a>.
		</div>
		<div class="left fleft">Copyright © 2013 
			<a href="./">Saman Kesht Mihan</a>. All rights reserved.
		</div>
		<br class="clear">
	</div>
</div>

<!-- <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-137579-8']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script> -->


<!-- <script type="text/javascript">
/* <![CDATA[ */
var _wpcf7 = {"loaderUrl":"http:\/\/e404themes.com\/cold\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","sending":"Sending ..."};
/* ]]> */
</script>
<script type="text/javascript" src="http://e404themes.com/cold/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=3.5.2"></script> -->

</body>
</html>