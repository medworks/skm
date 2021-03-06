<?php
header('Content-Type: text/html; charset=UTF-8');

include_once("config.php");
include_once("lib/persiandate.php");
include_once("classes/database.php");	
include_once("classes/seo.php");	
$db = Database::GetDatabase();
$seo = Seo::GetSeo();

$email = GetSettingValue('Contact_Email',0);
$gplus = GetSettingValue('Gplus_Add',0);
$facebook = GetSettingValue('FaceBook_Add',0);
$twitter = GetSettingValue('Twitter_Add',0);
$rss = GetSettingValue('Rss_Add',0);


$html=<<<cd

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fa-IR">
<head>
	<meta name="google-site-verification" content="NS6IDeh34wuAfeaAYpjmqpDLzx8F5ws1Cn8Irvkqaz8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="<?php echo $seo->Site_Describtion;?>"/>
	<meta name="keywords" content="<?php echo $seo->Site_KeyWords;?>"/>

	<title>صفحه یافت نشد</title>

	<link rel="stylesheet" type="text/css" media="all" href="themes/css/style.css">
	<link rel="stylesheet" id="galleria-css" href="themes/css/galleria.classic.css?ver=3.6.1" type="text/css" media="all">
	<link rel="stylesheet" id="superfish-css" href="themes/css/menu.css?ver=3.6.1" type="text/css" media="all">
	<link rel="stylesheet" id="scrollable-css" href="themes/css/scrollable.css?ver=3.6.1" type="text/css" media="all">
	<link rel="stylesheet" id="nivo-css" href="themes/css/nivo-slider.css?ver=3.6.1" type="text/css" media="all">
	<link rel="stylesheet" id="prettyphoto-css" href="themes/css/prettyphoto.css?ver=3.6.1" type="text/css" media="all">
	<link rel="stylesheet" id="Lato-css" href="themes/css/fonts.css" type="text/css" media="all">
	<link rel="stylesheet" id="contact-form-7-css" href="themes/css/styles.css?ver=3.5.2" type="text/css" media="all">
	<link href="themes/css/validationEngine.jquery.css" rel="stylesheet">
	<link href="themes/css/validationEngine.css" rel="stylesheet">
	<link href="themes/css/style_13.css" rel="stylesheet" type="text/css">

	<meta name="generator" content="Mediateq">

	<link rel="shortcut icon" href="favicon.ico">

	<script type="text/javascript" src="lib/js/jquery.js"></script>
	<script type="text/javascript" src="themes/js/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="themes/js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="themes/js/jquery-migrate.min.js?ver=1.2.1"></script>
	<script type="text/javascript" src="themes/js/preloader.js?ver=3.6.1"></script>
	<script type="text/javascript" src="themes/js/hoverIntent.js?ver=3.6.1"></script>
	<script type="text/javascript" src="themes/js/superfish.js?ver=3.6.1"></script>
	<script type="text/javascript" src="themes/js/scrollable.min.js?ver=3.6.1"></script>
	<script type="text/javascript" src="themes/js/jquery.prettyphoto.js?ver=3.6.1"></script>
	<script type="text/javascript" src="themes/js/prettyphoto_init.js?ver=3.6.1"></script>
	<script type="text/javascript" src="themes/js/comment-reply.min.js?ver=3.6.1"></script>

	<script type="text/javascript" src="themes/js/galleria.min.js?ver=3.6.1"></script>
	<script type="text/javascript" src="themes/js/galleria.classic.min.js?ver=3.6.1"></script>
	<script type="text/javascript" src="themes/js/flowplayer.min.js?ver=3.6.1"></script>
	<script type="text/javascript" src="themes/js/jquery.nivo.slider.pack.js?ver=3.6.1"></script>
	<script type="text/javascript" src="themes/js/cold_custom.js?ver=3.6.1"></script>
	<script type="text/javascript" src="themes/js/jquery.form.min.js?ver=3.40.0-2013.08.13"></script>
	<script type="text/javascript" src="themes/js/scripts.js?ver=3.5.2"></script> 


	<meta name="generator" content="Mediateq">


	<link rel="shortcut icon" href="favicon.ico">

	<style type="text/css">
		h1 { font-family: 'bmitra', tahoma, 'Lato', arial, serif; }
		h2 { font-family: 'bmitra', tahoma, 'Lato', arial, serif; }
		h3 { font-family: 'bmitra', tahoma, 'Lato', arial, serif; }
		h4 { font-family: 'bmitra', tahoma, 'Lato', arial, serif; }
		h5 { font-family: 'bmitra', tahoma, 'Lato', arial, serif; }
		h6 { font-family: 'bmitra', tahoma, 'Lato', arial, serif; }
		.sf-menu li { font-family: 'bmitra',tahoma,'Lato', arial, serif; }
		.sf-menu li li { font-family: 'bmitra',tahoma,'Lato', arial, serif; }
	</style>
	<style type="text/css">
		.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
	</style>
	<style type="text/css">
		#stylespanel {
			width: 124px;
			position: absolute;
			top: 0px;
			left: 0px;
			z-index: 999;
		}
		.stylespanel-content {
			background: #eee;
			padding: 10px 10px 0;
			overflow: hidden;
			display: none;
		}
		.stylespanel-content a {
			float: left;
			margin: 5px;
		}
		.stylespanel-content a:hover {
			filter: alpha(opacity=80);
			opacity: 0.8;
		}
		.stylespanel-content strong {
			color: #333;
		}
		#stylespanel br {
			clear: both;
		}
		.stylespanel-toggle {
			background: #eee;
			padding: 10px 15px;
			border-radius: 0 0 12px 0;
			-moz-border-radius: 0 0 12px 0;
			-webkit-border-radius: 0 0 12px 0;
		}
		.stylespanel-toggle a {
			text-decoration: none;
			display: block;
			padding: 5px 0 5px 26px;
			font-weight: bold;
			color: #999;
			text-transform: uppercase;
			background: url('themes/images/cog.png') 0 50% no-repeat;
		}
		.stylespanel-toggle a:hover {
			color: #666;
		}
	</style>
</head>
<body>
	<div id="header_wrapper">
		<div id="header">
			<div class="rightside" id="logo"><a href="./"><img src="themes/images/logo.png" alt="Saman Kesht Mihan"></a></div>
			<div id="header_nav" class="leftside">
				<div id="social_icons" class="leftside">
					<a href="mailto:{$email}" target="_blank" title="Contact"><img src="themes/images/contact.png" alt="Contact"></a>
					<a href="http://{$rss}" target="_blank" title="RSS"><img src="themes/images/rss.png" alt="RSS"></a>
					<a href="https://{$twitter}" target="_blank" title="Twitter"><img src="themes/images/twitter.png" alt="Twitter"></a>
					<a href="https://{$facebook}" target="_blank" title="Facebook"><img src="themes/images/facebook.png" alt="Facebook"></a>
					<a href="https://{$gplus}" target="_blank" title="Google Plus"><img src="themes/images/google-plus.png" alt="Dribbble"></a>
				</div>
				<div id="search" class="leftside">
	                <form action="search.html" method="post" name="frmsearch">
						<input type="submit" value="جستجو" style="margin:2px;">
						<input type="text" name="searchtxt" class="rtl" id="header-search-input" autocomplete="off" placeholder="جستجو..." style="margin-top:5px;"/>              
						<input type="hidden" name="mark" value="search" />
					</form>
					
				</div>
			</div>
		</div>
	</div>
	<div id="navigation">
		<ul id="menu-top-menu" class="sf-menu">
			<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="./">صفحه اصلی</a></li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="about-us.html">درباره ما</a></li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="news.html">اخبار</a></li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="works.html">رزومه</a></li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="#">فضای سبز</a>
				<ul class="sub-menu">
					<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="space-type1.html">فضای سبز داخلی</a></li>
					<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="space-type2.html">فضای سبز خارجی</a></li>
				</ul>
			</li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="articles.html">مطالب مفید</a></li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="gallery.html">گالری تصاویر</a></li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="contact.html">تماس با ما</a></li>
		</ul>
		<br class="clear">
	</div>
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
					<span>صفحه مورد نظر یافت شد</span>
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
</body>
</html>
	
cd;

echo $html;
include_once("themes/inc/footer.php")
?>