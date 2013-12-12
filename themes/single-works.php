<?php
include_once("./config.php");
include_once("./lib/persiandate.php");
include_once("./classes/database.php");	
include_once("./classes/seo.php");	
$db = Database::GetDatabase();
$seo = Seo::GetSeo();
$work = $db->Select('works',NULL,"id={$_GET[wid]}");
$works = $db->SelectAll("workpics","*","wid={$_GET[wid]}");
// $sdate = ToJalali($work["sdate"]," l d F  Y ");
// $fdate = ToJalali($work["fdate"]," l d F  Y ");		
$catname = GetCategoryName($work["catid"]);
$seo->Site_Title = $work["subject"];
$seo->Site_Describtion = strip_tags(mb_substr($work["body"],0,150,"UTF-8"));
$html=<<<cd
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a href="works.html">رزومه</a> <span>›</span>
				<a>رزومه یک</a>
			</div>
			<div id="intro" class="text-intro">
				<h1>اخبار/ <strong> {$works["subject"]}</strong></h1>
			</div>
			<div class="two_third">
				<div class="shadow shadow_huge">
					<a href="#" rel="prettyPhoto" title="">
						<img src="themes/images/demo/slide1.jpg" alt="" class="border-img" style="width:600px;height:336px">
					</a>
				</div>
				<div class="share-this">
					<span class="share_button">
						<a href="#" title="Share This">
							<img src="themes/images/add-this.png" alt="Share This">
						</a>
					</span>
					<span class="share_buttons" style="right: -90px;">
						<a href="#" target="_blank" title="Twitter">
							<img src="themes/images/twitter-share.png" alt="Twitter">
						</a>
						<a href="#" target="_blank" title="Facebook">
							<img src="themes/images/facebook-share.png" alt="Facebook">
						</a>
					</span>
				</div>
				<div class="more-pic">
					<ul>
						<li>
							<a href="themes/images/demo/slide1.jpg" rel="prettyPhoto[g1]" title="">
								<img src="themes/images/demo/slide1.jpg" alt="">
							</a>
						</li>
						<li>
							<a href="themes/images/demo/slide2.jpg" rel="prettyPhoto[g1]" title="">
								<img src="themes/images/demo/slide2.jpg" alt="">
							</a>
						</li>
						<li>
							<a href="themes/images/demo/slide3.jpg" rel="prettyPhoto[g1]" title="">
								<img src="themes/images/demo/slide3.jpg" alt="">
							</a>
						</li>
						<li>
							<a href="themes/images/demo/slide2.jpg" rel="prettyPhoto[g1]" title="">
								<img src="themes/images/demo/slide3.jpg" alt="">
							</a>
						</li>
						<br class="clear" />
						<li>
							<a href="themes/images/demo/slide3.jpg" rel="prettyPhoto[g1]" title="">
								<img src="themes/images/demo/slide3.jpg" alt="">
							</a>
						</li>
						<li>
							<a href="themes/images/demo/slide2.jpg" rel="prettyPhoto[g1]" title="">
								<img src="themes/images/demo/slide3.jpg" alt="">
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="one_third last">
				<p>توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... </p>
			</div>
			<br class="clear" />
		</div>
	</div>
cd;

return $html;
?>