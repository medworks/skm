<?php
include_once("./config.php");
include_once("./lib/persiandate.php");
include_once("./classes/database.php");	
include_once("./classes/seo.php");	
$db = Database::GetDatabase();
$seo = Seo::GetSeo();
$news = $db->Select('news',NULL,"id={$_GET[wid]}"," ndate DESC");
$ndate = ToJalali($news["ndate"]," l d F  Y ");
$news["userid"] = GetUserName($news["userid"]);
$body = $news['body'];
$seo->Site_Title = $news["subject"];
$seo->Site_Describtion = strip_tags(mb_substr($news["body"],0,150,"UTF-8"));

$html=<<<cd
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a href="news.html">اخبار</a> <span>›</span>
				<a>خبر یک</a>
			</div>
			<div id="page-content" class="two_third">
				<div id="post-174" class="post-174 post type-post status-publish format-standard sticky hentry category-news tag-design tag-works">
					<div class="meta-date">
						<span class="meta-month">فروردین</span>
						<span class="meta-day">09</span>
						<span class="meta-year">1392</span>
						<!-- <div class="meta-comments">
							<a href="#"><span>0</span></a>
						</div> -->
					</div>
					<h2 class="blog-header">
						<a href="#" title="">خبر اول</a>
					</h2>
					<div class="meta posted-meta">
				 		به وسیله <a title="" rel="author external">مجتبی امجدی</a>
				 		در گروه <a href="#" title="" rel="category tag">گیاهان دریایی</a>
				 	</div>
					<br class="clear">
					<div class="shadow shadow_huge aligncenter shadow_center">
						<a href="themes/images/demo/newspic.jpg" rel="prettyPhoto" title="">
							<img src="themes/images/demo/newspic.jpg" alt="" class="border-img" style="width:600px;height:229px;">
						</a>
					</div>
					<p>توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... </p>
					<br class="clear" />
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
					<br class="clear" />
				</div>
			</div>
			<div id="sidebar" class="one_third last">
				<div id="search-2" class="widgets widget_search">
					<form role="search" method="get" id="searchform" class="searchform" action="">
						<div>
							<label class="screen-reader-text" for="s">جستجو برای</label>
							<input type="text" class="rtl" value="" name="s" id="s">
							<input type="submit" id="searchsubmit" value="جستجو">
						</div>
					</form>
				</div>
        		<br class="clear">
        		<div id="e404_twitter-2" class="widgets widget_twitter">
        			<h3>آخرین اخبار</h3>
					<ul class="tweets">
						<li>
							<a href="#" class="twitter-user">خبر یک</a>
							<span>در 2 فروردین, ۱۳۹۲</a></span>
						</li>
						<li>
							<a href="#" class="twitter-user">خبر یک</a>
							<span>در 2 فروردین, ۱۳۹۲</a></span>
						</li>
						<li>
							<a href="#" class="twitter-user">خبر یک</a>
							<span>در 2 فروردین, ۱۳۹۲</a></span>
						</li>						
					</ul>
				</div>
        		<br class="clear">
			</div>
        	<br class="clear">
		</div>
	</div>
cd;

return $html;
?>