<?php
include_once("./config.php");
include_once("./lib/persiandate.php");
include_once("./classes/database.php");	
include_once("./classes/seo.php");	
$db = Database::GetDatabase();
$seo = Seo::GetSeo();
$area = $db->Select('area',NULL,"id={$_GET[wid]}"," ndate DESC");
$areapics = $db->SelectAll("areapics","*","nid={$_GET[wid]}");
$ndate = ToJalali($area["ndate"]," l d F  Y ");
$day = ToJalali($post["ndate"],"d");
$month = ToJalali($post["ndate"],"F");
$year = ToJalali($post["ndate"],"Y");
$area["userid"] = GetUserName($area["userid"]);
$area["type"] = GetTypeName($post["type"]);
$body = $area['body'];
$seo->Site_Title = $area["subject"];
$seo->Site_Describtion = strip_tags(mb_substr($area["body"],0,150,"UTF-8"));

$html=<<<cd
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a href="news.html">فضای داخلی</a> <span>›</span>
				<a>عنوان</a>
			</div>
			<div id="intro" class="text-intro">
                                <h1>{$area["type"]}/ <strong> {$area["subject"]}</strong></h1>
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
						<a href="#" title="{$area["subject"]}">{$area["subject"]}</a>
					</h2>
					<div class="meta posted-meta">
				 		به وسیله <a title="" rel="author external">{$area["userid"]}</a>
				 		در گروه <a href="#" title="" rel="category tag">{$area["type"]}</a>
				 	</div>
					<br class="clear">
					<div class="shadow shadow_huge aligncenter shadow_center">
						<a href="{$area[image]}" rel="prettyPhoto" title="">
							<img src="{$area[image]}" alt="{$area[subject]}" class="border-img" style="width:600px;height:229px;">
						</a>
					</div>
					<p>{$area["body"]}</p>
					<br class="clear" />
                                        <div class="more-pic">
						<ul>
cd;
    include_once('themes/inc/share.php');
$j = 0;					
foreach($areapics as $key=>$val)
{
   ++$j;
   $post = $db->Select('news',NULL,"id={$val[nid]}");
   if ($j%3 == 0)
    	{$br = "<br class='clear' />";}					
$html.=<<<cd
	<li>
	   <a href="{$val[image]}" rel="prettyPhoto[g1]" title="{$post[subject]}">
		<img src="{$val[image]}" alt="{$post[subject]}">
	   </a>
	</li>
	{$br}
cd;
}
$html.=<<<cd
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
                                            url: "manager/ajaxcommand.php?items=search&cat=area",
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
                    	<li><a href="space-type1.html" class="twitter-user">فضای سبز داخلی</a></li>
                    	<li><a href="space-type2.html" class="twitter-user">فضای سبز خارجی</a></li>
                    </ul>
        		</div>
        		<br class="clear">
        		<div id="e404_twitter-2" class="widgets widget_twitter">
        			<h3>پست های اخیر</h3>
					<ul class="tweets">
cd;
$area = $db->SelectAll("area","*",null,"ndate DESC","0","7");
foreach ($area as $key=>$val)
{
  if (!isset($val[id])) break;
	$ndate = ToJalali($val["ndate"]," l d F  Y");                                        
$html.=<<<cd
        <li>
                <a href="space-fullpage{$val[id]}.html" class="twitter-user">{$val["subject"]}</a>
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