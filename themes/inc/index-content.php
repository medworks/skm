<?php
    include_once("config.php");
    include_once("classes/functions.php");
    include_once("classes/seo.php");
    $seo = Seo::GetSeo();  
    if (GetPageName($_GET['item'],$_GET['act'])){
        echo include_once GetPageName($_GET['item'],$_GET['act']);
    }else{
        include_once("./classes/database.php");
        include_once("./lib/persiandate.php");
        $db = Database::GetDatabase();
//------------------------------- header slides part -------------------------
	$slides = $db->SelectAll("slides","*");	
//------------------------------- news part -------------------------	
        $news = $db->SelectAll("news","*",null,"ndate DESC","0","4");		
	$news[0]["ndate"] = ToJalali($news[0]["ndate"]," l d F  Y");
	$news[1]["ndate"] = ToJalali($news[1]["ndate"]," l d F  Y");
	$news[2]["ndate"] = ToJalali($news[2]["ndate"]," l d F  Y");
        $news[3]["ndate"] = ToJalali($news[2]["ndate"]," l d F  Y");
//------------------------------- works part -------------------------
	$works = $db->SelectAll("works","*",null,"fdate DESC","0","4");
//------------------------------- works part -------------------------

$html.=<<<cd
<script type="text/javascript" src="themes/js/nivo_slider_init.js?ver=3.6.1"></script>
       
<div id="wrapper">
	<div id="main_wrapper">
		<div id="featured">
			<!-- <div class="ribbon"></div>			 -->
			<div class="slider" id="slider" style="height: 350px;">
				<img src="themes/images/demo/slide1.jpg" title="اسلاید شماره یک" alt="اسلاید شماره یک">
				<img src="themes/images/demo/slide2.jpg" title="اسلاید شماره دو" alt="اسلاید شماره دو">
				<img src="themes/images/demo/slide3.jpg" title="اسلاید شماره سه" alt="اسلاید شماره سه">
			</div>
			<script type="text/javascript">
				var slideParams = []; 
				slideParams['effect'] = 'random'; 
				slideParams['slices'] = '10'; 
				slideParams['animSpeed'] = '600'; 
				slideParams['pauseTime'] = '4000'; 
				slideParams['directionNav'] = 1; 
				slideParams['directionNavHide'] = 1;
				slideParams['controlNav'] = 1; 
				slideParams['keyboardNav'] = 1; 
				slideParams['pauseOnHover'] = 1; 
				slideParams['manualAdvance'] = false;
				slideParams['captionOpacity'] = 0.6;
				slideParams['stopAtEnd'] = 0;
				slideParams['height'] = 350;
			</script>
			<!-- <ul id="featured-boxes">
				<li class="featured_fourth icon-ruler featured-dark">
					<div>
						<h4><a href="http://e404themes.com/cold/shortcodes/">40+ Shortcodes</a></h4><p>Some of them have many different variations.</p></div></li><li class="featured_fourth icon-paint-brush"><div><h4><a href="http://e404themes.com/cold/features/color-variations/">16 Color Variations</a></h4><p><strong>Cold Theme</strong> includes 16 different color variations.</p></div></li><li class="featured_fourth icon-tools featured-dark"><div><h4><a href="http://e404themes.com/cold/features/powerful-admin-panel/">Powerful Panel</a></h4><p>Which allows you to customize your website.</p></div></li><li class="featured_fourth_last icon-help"><div><h4>Customer Support</h4><p>We provide an extensive customer support.</p>
					</div>
				</li>
			</ul> -->
			<br class="clear">
		</div>
		<!-- <div id="intro" class="text-intro">
			<div class="three_fifth">
				<p><strong>Welcome to Cold Theme: The ultimate all-in-one template.</strong><br>
				Create outstanding website or blog in minutes!</p>
			</div>
			<div class="two_fifth last center">
				<a class="big-btn gradient-btn stroke-btn" href="http://themeforest.net/item/cold-theme-powerful-wordpress-theme/236148?ref=e404"><span><img src="http://e404themes.com/cold/wp-content/themes/cold/images/bullets/arrow.png" alt=""> Available on ThemeForest</span></a>
			</div>
			<br class="clear">
		</div> -->
		<!-- <div class="one_third">
			<div class="shadow shadow_medium"><a href="http://e404themes.com/cold/features/custom-widgets/"><img src="http://e404themes.com/cold/wp-content/themes/cold/lib/timthumb.php?src=http://e404themes.com/cold/wp-content/uploads/2011/04/widgets.jpg&amp;w=280&amp;h=0&amp;zc=1" alt="" class="border-img"></a></div>
			<h2>8 Custom Widgets</h2>
			<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum.
			</p>
		</div>
		<div class="one_third">
			<div class="shadow shadow_medium"><a href="http://e404themes.com/cold/contact/"><img src="http://e404themes.com/cold/wp-content/themes/cold/lib/timthumb.php?src=http://e404themes.com/cold/wp-content/uploads/2011/04/mail.jpg&amp;w=280&amp;h=0&amp;zc=1" alt="" class="border-img"></a></div>
			<h2>Support for Contact Form 7</h2>
			<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
			</p>
		</div>
		<div class="one_third last">
			<div class="shadow shadow_medium"><a href="http://e404themes.com/cold/shortcodes/dropcaps-boxes-icon-boxes/"><img src="http://e404themes.com/cold/wp-content/themes/cold/lib/timthumb.php?src=http://e404themes.com/cold/wp-content/uploads/2011/04/icons.jpg&amp;w=280&amp;h=0&amp;zc=1" alt="" class="border-img"></a></div>
			<h2>72 Icon Boxes</h2>
			<p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.
			</p>
		</div> -->
		<br class="clear">
		<!-- <hr class="dotted"> -->
		<div class="one_third">
			<h2 class="head-icon"><img src="themes/images/sign.png" class="icon" alt="Slide Show"><a href="http://e404themes.com/cold/features/">هدر یک</a><span>هدر یک</span></h2>
			<p>توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... </p>
			<p class="more"><a href="#">اطلاعات تکمیلی</a></p>
		</div>
		<div class="one_third">
			<h2 class="head-icon"><img src="themes/images/sign.png" class="icon" alt="Google Web Fonts"><a href="http://www.google.com/webfonts">هدر یک</a><span>هدر یک</span></h2>
			<p>توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... </p>
			<p class="more"><a href="#">اطلاعات تکمیلی</a></p>
		</div>
		<div class="one_third last">
			<h2 class="head-icon"><img src="themes/images/sign.png" class="icon" alt="PrettyPhoto"><a href="http://e404themes.com/cold/shortcodes/">هدر یک</a><span>هدر یک</span></h2>
			<p>توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... </p>
			<p class="more"><a href="#">اطلاعات تکمیلی</a></p>
		</div>
		<br class="clear">
		<div class="fancy_list">
			<div class="one_fifth fancy_title">
				<h3>رزومه</h3>
				<p><a href="#">مشاهده تمام موارد</a></p>
			</div>
cd;
for($i=0;$i<=3;$i++)
{
    if (!empty($works[$i]["subject"])){
    	if($i==3){
$html.=<<<cd
			<div class="one_fifth fancy_list_item last">
cd;
    	}else{
$html.=<<<cd
			<div class="one_fifth fancy_list_item">
cd;
    	}
$html.=<<<cd
				<div class="shadow shadow_vsmall aligncenter shadow_center">
				<a href="work-fullpage{$works[$i][id]}.html">
					<img src="{$works[$i][image]}" alt="{$works[$i][subject]}" title="{$works[$i][subject]}" class="border-img" style="width:152px;height:90px">
				</a>
				</div>
				<h4>
					<a href="work-fullpage{$works[$i][id]}.html">{$works[$i][subject]}</a>
				</h4>
			</div>
cd;
    }
}
$html.=<<<cd
			<br class="clear">
        </div>
		<div class="fancy_list">
			<div class="one_fifth fancy_title">
				<h3>اخبار</h3>
				<p><a href="#">مشاهده تمام موارد</a></p>
			</div>
cd;

for($i=0;$i<=3;$i++)
{
    if (!empty($news[$i]["subject"])){
    	if($i==3){
$html.=<<<cd
			<div class="one_fifth fancy_list_item last">
cd;
    	}else{
$html.=<<<cd
			<div class="one_fifth fancy_list_item">
cd;
   		}
$html.=<<<cd
				<div class="shadow shadow_vsmall">
					<a href="news-fullpage{$news[$i][id]}.html">
						<img src="{$news[$i][image]}" alt="{$news[$i][subject]}" title="{$news[$i][subject]}" class="border-img aligncenter" style="width:152px;height:90px">
					</a>
				</div>
				<h4>
					<a href="news[$i]-fullpage{$news[$i][id]}.html">{$news[$i]["subject"]}</a>
				</h4>
			</div>
cd;
    }
}
$html.=<<<cd
			<br class="clear">
		</div>
	</div>
</div>
cd;
    
echo $html;
    }
?>