<?php
	include_once("./classes/database.php");
	include_once("./lib/persiandate.php");
	$db = Database::GetDatabase(); 
	$About_System = GetSettingValue('About_System',0);
	$news = $db->SelectAll('news',NULL,NULL," ndate DESC","0","3");
        $area = $db->SelectAll('area',NULL,NULL," ndate DESC","0","3");
        $gallery = $db->SelectAll('gallery',NULL,NULL,NULL,"0","13");	
	$About_System = mb_substr(html_entity_decode(strip_tags($About_System), ENT_QUOTES, "UTF-8"), 0, 500,"UTF-8")."  ...";
	$address = GetSettingValue('Address',0);
	$tel = GetSettingValue('Tell_Number',0);
	$fax = GetSettingValue('Fax_Number',0);
?>
<div id="footer_wrapper">
	<div id="footer">
		<div id="e404_flickr-3" class="one_fourth widgets widget_flickr">
			<h3>گالری تصاویر</h3>
			<ul class="flickr">
                           <?php
                                for ($i = 0;$i<=9;$i++)
                                {
                                    if (!empty($gallery[$i][image]))
                                    {
                                    echo " <li> ".                                
                                         "    <a href='' rel='prettyphoto' title='{$gallery[$i][subject]}'>".
                                         "    <img src='{$gallery[$i][image]}' width='50' height='50' alt='{$gallery[$i][subject]}'></a> ".
                                         " </li>";
                                    }    
                                }
                           ?>			
			</ul>
		</div>
		<div id="e404_twitter-3" class="one_fourth widgets widget_twitter">
            <h3>اخبار</h3>
			<ul class="tweets">
                        <?php    
                        for($i=0 ; $i<3 ; $i++){
                            if (!empty($news[$i]["subject"])) 
                            {   
			echo   " <li> ".
			       "	<a href='news-fullpage{$news[$i][id]}.html' title='{$news[$i][subject]}'> ". 
                               "         <img src='{$news[$i][image]}' width='50' height='50' alt='{$news[$i][subject]}'> ".
                               "       </a> ".
                               "        <a href='news-fullpage{$news[$i][id]}.html'>{$news[$i][subject]}</a> ".
			       " </li> ".
			       " <br class='clear'> " ;
                            }
                        }  
                         ?>                                                      
			</ul>
		</div>
		<div id="linkcat-2" class="one_fourth widgets widget_links">
			<h3>لینک های مفید</h3>
			<ul class="xoxo blogroll">
				<li><a href="http://www.koaj.ir/modules/showframework.aspx">سازمان جهاد کشاورزی خراسان رضوی</a></li>
				<li><a href="http://nargil.ir/plant/plant.aspx">پایگاه اطلاع رسانی گل و گیاه</a></li>
			</ul>
		</div>
		<div id="custom_cf7-3" class="one_fourth widgets widget_custom_cf7">
			<h3>فضای سبز</h3>
	    	<ul class="tweets">
                        <?php    
                        for($i=0 ; $i<3 ; $i++){    
                           if (!empty($area[$i]["subject"])) 
                           {    
                            $area[$i]["type"] =  GetTypeName($area[$i]["type"]) ;
			echo   " <li> ".
			       "	<a href='space-fullpage{$area[$i][id]}.html' title='{$area[$i][subject]}'> ". 
                               "         <img src='{$area[$i][image]}' width='50' height='50' alt='{$area[$i][subject]}'> ".
                               "       </a> ".
                               "        <a href='space-fullpage{$area[$i][id]}.html'>{$area[$i][subject]}</a> ".
                               "        <span>{$area[$i][type]}</span> ".
			       " </li> ".
			       " <br class='clear'> " ;
                           }                               
                        }  
                         ?>                                                      
			</ul>
	    </div>
		<br class="clear">
	</div>
	<div id="copyright" class="latin-font">
		<div class="last right fright">Designed by: 
			<a href="http://www.mediateq.ir">Mediateq</a>.
		</div>
		<div class="left fleft">Copyright © 2013 
			<a href="./">Saman Kesht Mihan</a>. All rights reserved.
		</div>
		<br class="clear">
	</div>
</div>

</body>
</html>