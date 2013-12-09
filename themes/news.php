<?php
include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();
  $pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
  $maxItemsInPage = GetSettingValue('Max_Post_Number',0);
  $from = ($pageNo - 1) * $maxItemsInPage;
  $count = $maxItemsInPage;
  
  $news = $db->SelectAll("news","*",null,"ndate DESC",$from,$count);  
  $itemsCount = $db->CountAll("news");

$html=<<<cd
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a>اخبار</a>
			</div>
			<div id="page-content" class="two_third">
cd;
foreach($news as $key => $post)
{
    $ndate = ToJalali($post["ndate"]," l d F  Y ساعت H:m");
    $day = ToJalali($post["ndate"],"d");
    $month = ToJalali($post["ndate"],"F");
    $year = ToJalali($post["ndate"],"Y");
    $post["userid"] = GetUserName($post["userid"]);
    $post["catid"] = GetCategoryName($post["catid"]);
    $post["body"]= strip_tags($post["body"]);
    $post["body"] = (mb_strlen($post["body"])>500) ? mb_substr($post["body"],0,500,"UTF-8")."..." : $post["body"];
$html.=<<<cd
				<div id="post-174" class="post-174 post type-post status-publish format-standard sticky hentry category-news tag-design tag-works">
					<div class="meta-date">
						<span class="meta-month">{$month}</span>
						<span class="meta-day">{$day}</span>
						<span class="meta-year">{$year}</span>
						<!-- <div class="meta-comments">
							<a href="#"><span>0</span></a>
						</div> -->
					</div>
					<h2 class="blog-header">
						<a href="news-fullpage{$post[id]}.html" title="{$post["subject"]}">{$post["subject"]}</a>
					</h2>
					<div class="meta posted-meta">
				 		به وسیله <a title="" rel="author external">{$post["userid"]}</a>
				 		در گروه <a href="" title="" rel="category tag">{$post["catid"]}</a>
				 	</div>
					<br class="clear">
					<div class="shadow shadow_huge aligncenter shadow_center">
						<a href="news-fullpage{$post[id]}.html" class="zoom" title="">
							<img src="$post[image]" alt="$post[subject]" class="">
						</a>
					</div>
					<p>{$post["body"]}</p>
					<p class="more">
						<a href="news-fullpage{$post[id]}.html">ادامه خبر</a>
					</p>
				</div>
cd;
}
$linkFormat = 'news-page'.$pid='%PN%'.'.html';
$maxPageNumberAtTime = GetSettingValue('Max_Page_Number',0);
$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);
$html .= $pageNos;

$html.=<<<cd
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
cd;
$posts = $db->SelectAll("news","*",null,"ndate DESC","0","4");
foreach($posts as $key=>$val)
{    
 $ndate = ToJalali($val["ndate"]," l d F  Y");
$html.=<<<cd
        
        <li>
                <a href="news-fullpage{$val[id]}.html" class="twitter-user">{$val["subject"]}</a>
                <span>{$ndate}</a></span>
        </li>        
cd;
}
$html.=<<<cd
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