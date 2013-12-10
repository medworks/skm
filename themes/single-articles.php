<?php
include_once("./config.php");
include_once("./lib/persiandate.php");
include_once("./classes/database.php");	
include_once("./classes/seo.php");	
$db = Database::GetDatabase();
$seo = Seo::GetSeo();
$articles = $db->Select('articles',NULL,"id={$_GET[wid]}"," ndate DESC");
$ndate = ToJalali($articles["ndate"]," l d F  Y ");
$day = ToJalali($post["ndate"],"d");
$month = ToJalali($post["ndate"],"F");
$year = ToJalali($post["ndate"],"Y");
$articles["userid"] = GetUserName($articles["userid"]);
$articles["catid"] = GetCategoryName($post["catid"]);
$body = $articles['body'];
$seo->Site_Title = $articles["subject"];
$seo->Site_Describtion = strip_tags(mb_substr($articles["body"],0,150,"UTF-8"));

$html=<<<cd
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a href="articles.html">مطالب مفید</a> <span>›</span>
				<a>{$articles["subject"]}</a>
			</div>
			<div id="page-content" class="two_third">
				<div id="post-174" class="post-174 post type-post status-publish format-standard sticky hentry category-articles tag-design tag-works">
					<div class="meta-date">
						<span class="meta-month">{$month}</span>
						<span class="meta-day">{$day}</span>
						<span class="meta-year">{$year}</span>
						<!-- <div class="meta-comments">
							<a href="#"><span>0</span></a>
						</div> -->
					</div>
					<h2 class="blog-header">
						<a href="#" title="{$articles["subject"]}">{$articles["subject"]}</a>
					</h2>
					<div class="meta posted-meta">
				 		به وسیله <a title="" rel="author external">{$articles["userid"]}</a>
				 		در گروه <a href="#" title="" rel="category tag">{$articles["catid"]}</a>
				 	</div>
					<br class="clear">
					<div class="shadow shadow_huge aligncenter shadow_center">
						<a href="{$articles[image]}" rel="prettyPhoto" title="">
							<img src="{$articles[image]}" alt="{$articles[subject]}" class="border-img" style="width:600px;height:229px;">
						</a>
					</div>
					<p>{$articles["body"]}</p>
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
                                            url: "manager/ajaxcommand.php?items=search&cat=articles",
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
        		<div id="e404_twitter-2" class="widgets widget_twitter">
        			<h3>آخرین مطالب </h3>
					<ul class="tweets">
cd;
$articles = $db->SelectAll("articles","*",null,"ndate DESC","0","7");
foreach ($articles as $key=>$val)
{
  if (!isset($val[id])) break;
	$ndate = ToJalali($val["ndate"]," l d F  Y");                                        
$html.=<<<cd
        <li>
                <a href="article-fullpage{$val[id]}.html" class="twitter-user">{$val["subject"]}</a>
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