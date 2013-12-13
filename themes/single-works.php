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
				<a>{$work["subject"]}</a>
			</div>
			<div id="intro" class="text-intro">
				<h1>رزومه/ <strong> {$work["subject"]}</strong></h1>
			</div>
			<div class="two_third">
				<div class="shadow shadow_huge">
					<a href="#" rel="prettyPhoto" title="{$work[subject]}">
						<img src="{$work[image]}" alt="{$work[subject]}" class="border-img" style="width:600px;height:336px">
					</a>
				</div>
				<div class="more-pic">
					<ul>
cd;
					include_once('themes/inc/share.php');
$j = 0;					
foreach($works as $key=>$val)
{
	++$j;
	$post = $db->Select('works',NULL,"id={$val[wid]}");
	if ($j%3 == 0)
	{$br = "<br class='clear' />";}
$html.=<<<cd
						<li>
							<a href="{$val[image]}" rel="prettyPhoto[g1]" title="{$val[subject]}">
								<img src="{$val[image]}" alt="{$val[subject]}">
							</a>
						</li>
						{$br}
cd;
}
$html.=<<<cd
					</ul>
				</div>
			</div>
			<div class="one_third last">
				<p>{$work["body"]}</p>
			</div>	
			<br class="clear" />
		</div>
	</div>
cd;

return $html;
?>