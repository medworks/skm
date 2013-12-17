<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();   
  $works = $db->SelectAll("works","*",null,"fdate DESC");
  foreach($works as $key=>$val) $cats[] = $val["catid"];    
  $uniqcats = array_unique($cats);

$html=<<<cd
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a>رزومه</a>
			</div>
      <div id="intro" class="text-intro">
        <h1>رزومه</h1>
      </div>
			<div class="portfolio portfolio-columns">
cd;
$i = 0;
foreach($works as $key=>$val)
{
    ++$i;
    if ($i % 3 == 0)
      {$div = "<div class='one_third portfolio-item last' >";}
    else {$div = "<div class='one_third portfolio-item' >";}
          
$html.=<<<cd
                {$div}
                        <div class="shadow shadow_medium">
                                <a href="work-fullpage{$val[id]}.html" class="zoom" title="{$val[subject]}">
                                        <img src="{$val[image]}" alt="{$val[subject]}" class="border-img" style="width:280px;height:157px;">
                                </a>
                        </div>
                        <h3>
                                <a href="work-fullpage{$val[id]}.html" title="{$val[subject]}">{$val[subject]}</a>
                        </h3>
                        <p>{$val["body"]}</p>
                        <p class="more"><a href="work-fullpage{$val[id]}.html">ادامه رزومه</a></p>
                </div>		
cd;
}
                        
$html.=<<<cd
        <br class="clear">
        </div>
		</div>
	</div>
cd;

return $html;
?>