<?php
   include_once("./config.php");
   include_once("./classes/database.php");
   include_once("./classes/functions.php");
   include_once("./classes/messages.php");
   
   
   $table = "";
   $field = "";   
   $db = Database::GetDatabase();
   if ($_POST["mark"]=="search")
   {
      $table = "news";
      $field = "subject";
	  $rownum = 0;
	  $rows = $db->SelectAll(
				$table,
				"*",
				"{$field} LIKE '%{$_POST[searchtxt]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			/* if (!$rows) 
			{							
				//header("Location:?item=search&act=do&msg=6");
				header("Location:search.html");
				
			}
			else
			{
			    $cat = "اخبار";
				$success = count($rows);
				foreach($rows as $key=>$val)
				{
				 ++$rownum;
				 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullnews&act=do&wid={$val['id']}' class='srlink'>
					 {$val['subject']}</a></p>";
				}
				$result=<<<rt
			     <p class="sresult"><span>نتایج یافت شده در بخش: </span>{$cat}</p>
			     <p class="sresult"><span>عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
				 <p class="sresult"><span>تعداد نتایج یافت شده: </span>{$success}</p>
				 {$row}				 
rt;
			} */
				$cat = "اخبار";
				$success = count($rows);
				foreach($rows as $key=>$val)
				{
				 ++$rownum;
				 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='work-fullpage{$val['id']}.html' class='srlink'>
					 {$val['subject']}</a></p>";
				}
				$result=<<<rt
			     <p class="sresult"><span class="font-siz">نتایج یافت شده در بخش: </span>{$cat}</p>
			     <p class="sresult"><span class="font-siz">عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
				 <p class="sresult"><span class="font-siz">تعداد نتایج یافت شده: </span>{$success}</p>
				 {$row}				 
rt;
   }
   if ($_POST["mark"]=="find")
  {
    $table = $_POST["category"];
    $field = $_POST["subcat"];
	$rows = $db->SelectAll(
				$table,
				"*",
				"{$field} LIKE '%{$_POST[searchtxt]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			/* if (!$rows) 
			{							
				header("Location:?item=search&act=do&msg=6");
			}
			else
			{
               //header("Location:?item=search&act=do");			
			   $success = count($rows);
			   $cat = "";
			   $rownum = 0;
			   switch($_POST["category"])
			   {
					case 'news':
					$cat = "اخبار";
					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullnews&act=do&wid={$val['id']}' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'works':
					$cat = "کارهای ما";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullworks&act=do&wid={$val['id']}' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'articles':
					$cat = "مطالب خواندنی";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullarticles&act=do&wid={$val['id']}' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
			   } */
			   
			   $success = count($rows);
			   $cat = "";
			   $rownum = 0;
			   switch($_POST["category"])
			   {
					case 'news':
					$cat = "اخبار";
					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='news-fullpage{$val['id']}.html' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'works':
					$cat = "رزومه";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='work-fullpage{$val['id']}.html' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'articles':
					$cat = "مطالب خواندنی";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='article-fullpage{$val['id']}.html' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
			   } 
			   
			   $result=<<<rt
			     <p class="sresult"><span class="font-siz">نتایج یافت شده در بخش: </span>{$cat}</p>
			     <p class="sresult"><span class="font-siz">عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
				 <p class="sresult"><span class="font-siz">تعداد نتایج یافت شده: </span>{$success}<p>
				 {$row}				 
rt;
	}
		
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a>جستجو</a>
			</div>
			<div id="intro" class="text-intro">
				<h1>جستجو</h1>
			</div>
	        <div class="rtl two_third">
				{$result}
	        </div>
	        <div id="sidebar" class="one_third last">
	        	<div id="search-2" class="widgets widget_search">
		        	<form action="" id="searchfrm" method="post">
			            <div id="portfolio-item-info" class="rtl large-3 columns no-padding">
			                <ul id="portfolio-item-meta">
			                	<li>
			                		<p style="font-size:19px;">
							        	<label class="mar-bot">عبارت مورد نظر </label>
							        </p>
							        <input type="text" name="searchtxt" class="subject" id="searchtxt" value="{$_POST[searchtxt]}" />
			                	</li>
			                    <li>
			                    	<p style="margin-top:20px;font-size:19px;">
							        	<label class="mar-bot">جستجو در: </label>
							        </p>
							        <p>
								        <input type="radio" name="category" class="subject right mar-lef" id="category" value="news" checked/>
								        <label>اخبار</label>
							        </p>
							        <p>
								        <input type="radio" name="category" class="right subject mar-lef" id="category" value="works" />
								        <label>رزومه</label>
							        </p>
							        <p>
								        <input type="radio" name="category" class="subject right mar-lef" id="category" value="articles" />
								        <label>مطالب مفید</label>
							        </p>
							        <p>
								        <input type="radio" name="category" class="subject right mar-lef" id="category" value="articles" />
								        <label>فضای سبز</label>
							        </p>
			                    </li>
			                    <li>
			                    	<p style="font-size:19px;">
							        	<label class="mar-bot">قسمت: </label>
							        </p>
							        <p>  
							        	<input type="radio" name="subcat" class="subject right mar-lef" id="category" value="subject" checked/>
								        <label>عنوان</label>
						        	</p>
							        <p>
								        <input type="radio" name="subcat" class="subject right mar-lef" id="category" value="body" />
								        <label>توضیحات</label>
							        </p>
			                    </li>              
			                </ul>
			            </div>
						<input type="hidden" name="mark" value="find" />
			        </form>
			    </div>
	        </div>
	        <br class="clear" />
	    </div>
	</div>
cd;
return $html;
?>