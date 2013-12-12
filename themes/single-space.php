<?php
include_once("./config.php");
include_once("./lib/persiandate.php");
include_once("./classes/database.php");	
include_once("./classes/seo.php");	
$db = Database::GetDatabase();
$seo = Seo::GetSeo();
$news = $db->Select('news',NULL,"id={$_GET[wid]}"," ndate DESC");
$ndate = ToJalali($news["ndate"]," l d F  Y ");
$day = ToJalali($post["ndate"],"d");
$month = ToJalali($post["ndate"],"F");
$year = ToJalali($post["ndate"],"Y");
$news["userid"] = GetUserName($news["userid"]);
$news["catid"] = GetCategoryName($post["catid"]);
$body = $news['body'];
$seo->Site_Title = $news["subject"];
$seo->Site_Describtion = strip_tags(mb_substr($news["body"],0,150,"UTF-8"));

$html=<<<cd
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a href="news.html">فضای داخلی</a> <span>›</span>
				<a>عنوان</a>
			</div>
			<div id="intro" class="text-intro">
				<h1>فضای داخلی/ <strong> عنوان</strong></h1>
			</div>
			<div id="page-content" class="two_third">
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
						<a href="#" title="{$news["subject"]}">{$news["subject"]}</a>
					</h2>
					<div class="meta posted-meta">
				 		به وسیله <a title="" rel="author external">{$news["userid"]}</a>
				 		در گروه <a href="#" title="" rel="category tag">{$news["catid"]}</a>
				 	</div>
					<br class="clear">
					<div class="shadow shadow_huge aligncenter shadow_center">
						<a href="{$news[image]}" rel="prettyPhoto" title="">
							<img src="{$news[image]}" alt="{$news[subject]}" class="border-img" style="width:600px;height:229px;">
						</a>
					</div>
					<p>{$news["body"]}</p>
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
					<form id="frmsearch" method="post" action="">
						<div>
							<label class="screen-reader-text" for="findtxt">جستجو برای</label>
							<input type="text" class="rtl" value="" id="findtxt" name="findtxt">
							<input type="submit" id="searchsubmit" value="جستجو">
						</div>
					</form>
				</div>
                         <div id="srhresult"></div>                    
				<script type='text/javascript'>
                               // $(document).ready(function(){
                                    $("#frmsearch").submit(function(){
                                        $.ajax({                                        
                                            type: "POST",
                                            url: "manager/ajaxcommand.php?items=search&cat=news",
                                            data: $("#frmsearch").serialize(), 
                                            success: function(msg)
                                            {
                                                $('.info_fieldset').css('display','block');
                                                $("#srhresult").ajaxComplete(function(event, request, settings){
                                                    $(this).hide();
                                                    $(this).html(msg).slideDown("slow");
                                                    $(this).html(msg);
                                                });
                                            }
                                        });
                                        return false;
                                    });
                               // });
                            </script>               
        		<br class="clear">
        		<div class="widgets widget_twitter">
                    <h3>دسته بندی</h3>
                    <ul class="tweets">
                    	<li><a href="news-fullpage{$val[id]}.html" class="twitter-user">فضای سبز داخلی</a></li>
                    	<li><a href="news-fullpage{$val[id]}.html" class="twitter-user">فضای سبز خارجی</a></li>
                    </ul>
        		</div>
        		<br class="clear">
        		<div id="e404_twitter-2" class="widgets widget_twitter">
        			<h3>پست های اخیر</h3>
					<ul class="tweets">
cd;
$news = $db->SelectAll("news","*",null,"ndate DESC","0","7");
foreach ($news as $key=>$val)
{
  if (!isset($val[id])) break;
	$ndate = ToJalali($val["ndate"]," l d F  Y");                                        
$html.=<<<cd
        <li>
                <a href="news-fullpage{$val[id]}.html" class="twitter-user">{$val["subject"]}</a>
                <span>{$ndate}</span>
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