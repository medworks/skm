<?php
include_once("config.php");
include_once("lib/persiandate.php");
include_once("classes/database.php");	
include_once("classes/seo.php");	
$db = Database::GetDatabase();
$seo = Seo::GetSeo();

$header= file_get_contents('themes/inc/header.php');

$html=<<<cd
	{$header}
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a>404</a>
			</div>
			<div id="intro" class="text-intro">
				<h1>صفحه یافت نشد</h1>
			</div>
			<div id="error" class="one_half">
				<p>
					<strong>404</strong>
					<span>Page not Found</span>
				</p>
			</div>
			<div id="error-info" class="rtl one_half last">
				<p style="font-size:25px;">متاسفانه صفحه مورد نظر یافت نشد.</p>
	    		<hr class="dotted">
				<ul class="small-list small-arrow">
					<li>برو به <a href="./" style="font-size:20px">صفحه اصلی</a></li>
	    		</ul>
			</div>
			<br class="clear">
		</div>
	</div>
	
cd;

echo $html;
include_once("themes/inc/footer.php")
?>