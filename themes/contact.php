<?php

	include_once("./config.php");
	include_once("./classes/database.php");
	include_once("./classes/functions.php");
	$db = database::GetDatabase();

$address = GetSettingValue('Address',0);
$tel = GetSettingValue('Tell_Number',0);
$fax = GetSettingValue('Fax_Number',0);

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
			<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyDun8B3aM33iKhRIZniXwprr2ztGlzgnrQ&sensor=false'></script>
			<script>
				function initialize()
				{
					var mapProp = {
					  center:new google.maps.LatLng(36.293224, 59.534149),
					  zoom:18,
					  mapTypeId:google.maps.MapTypeId.ROADMAP
					  };

					var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

				}

				google.maps.event.addDomListener(window, "load", initialize);

				$(document).ready(function(){
					$("#contactfrm").submit(function(){

					    $.ajax({
						    type: "POST",
						    url: "./manager/ajaxcommand.php?contact=reg",
						    data: $("#contactfrm").serialize(),
							    success: function(msg)
								{
									$("#note-contact").ajaxComplete(function(event, request, settings){				
										$(this).hide();
										$(this).html(msg).slideDown("slow");
										$(this).html(msg);


									});
								}
					    });
						return false;
					});
					$("#contactfrm").validationEngine();			
				});
			</script>
			<div class="full_page">
				<div id="contact">
					<h3>مکان ما بر روی نقشه</h3>
					<div class="full_page border-box">
						<div id="googleMap" style="height:380px;"></div>
					</div>
					<div class="one_third">
						<h3>آدرس</h3>
						<p>{$address}</p>
						<p class="rtl">تلفن:</p>
						<p style="text-align:left">{$tel}</p>
						<p class="rtl">فاکس:</p>
						<p style="text-align:left">{$fax}</p>
						<p class="rtl">ایمیل:</p>
						<p style="text-align:left">
							<script type="text/javascript">
                                emailE='wskm.ir'
                                emailE=('info' + '@' + emailE)
                                document.write('<a href="mailto:' + emailE + '" target="_blank">' + emailE + '</a>')
                            </script>
                        </p>
					</div>
					<div class="two_third last">
						<h3>فرم تماس</h3>
						<div class="wpcf7" id="wpcf7-f853-p322-o1">
							<form id="contactfrm" action="" method="post" class="wpcf7-form">
								<p>نام و نام خانوادگی (*)<br>
		   							<span class="wpcf7-form-control-wrap your-name">
		   								<input type="text" name="name" value="" size="40" class="rtl validate[required] wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true">
		   							</span>
		   						</p>
								<p>ایمیل (*)<br>
		    						<span class="wpcf7-form-control-wrap your-email">
		    							<input type="text" name="email" value="" size="40" class="validate[required,custom[email]] wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true">
		    						</span>
		    					</p>
		    					<p>موضوع<br>
		    						<span class="wpcf7-form-control-wrap your-subject">
		    							<input type="text" name="subject" value="" size="40" class="rtl rtlwpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true">
		    						</span>
		    					</p>
								<p>پیام (*)<br>
		    						<span class="wpcf7-form-control-wrap your-message">
		    							<textarea name="message" cols="40" rows="10" class="rtl validate[required] wpcf7-form-control wpcf7-textarea"></textarea>
		    						</span>
		    					</p>
								<p>
									<input type="submit" value="ارسال پیام" class="wpcf7-form-control wpcf7-submit">
								</p>
								<div class="wpcf7-response-output wpcf7-display-none"></div>
								<fieldset class="info_fieldset info_contact">
									<div id="note-contact"></div>
								</fieldset>
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