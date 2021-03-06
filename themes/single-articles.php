<?php
include_once("./config.php");
include_once("./lib/persiandate.php");
include_once("./classes/database.php");	
include_once("./classes/seo.php");	
$db = Database::GetDatabase();
$seo = Seo::GetSeo();
$articles = $db->Select('articles',NULL,"id={$_GET[wid]}"," ndate DESC");
$ndate = ToJalali($articles["ndate"]," l d F  Y ");
$day = ToJalali($articles["ndate"],"d");
$month = ToJalali($articles["ndate"],"F");
$year = ToJalali($articles["ndate"],"Y");
$articles["userid"] = GetUserName($articles["userid"]);
$articles["catid"] = GetCategoryName($articles["catid"]);
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
			<div id="intro" class="text-intro">
				<h1>اخبار/ <strong> {$articles["subject"]}</strong></h1>
			</div>
			<div id="page-content" class="two_third">
				<div class="">
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
cd;
					include_once('themes/inc/share.php');
$html.=<<<cd
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