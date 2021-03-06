<?php 
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");	
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();
	$sess = Session::GetSesstion();	
	$userid = $sess->Get("userid");
	$overall_error = false;
	if ($_GET['item']!="areamgr")	exit();	   
	if (isset($_POST["mark"]) and $_POST["mark"]!="srharea")
	{
	   date_default_timezone_set('Asia/Tehran');
	   list($hour,$minute,$second) = explode(':', Date('H:i:s'));
	   list($year,$month,$day) = explode("-", trim($_POST["ndate"]));		
	   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
	   $ndatetime = Date("Y-m-d H:i:s",mktime($hour, $minute, $second, $gmonth, $gday, $gyear));		
				  
	   if(empty($_POST["selectpic"])&& $_POST["mark"]!="addmorepic")
	   { 
			//$msgs = $msg->ShowError("لط??ا ??ایل عکس را انتخاب کنید");
			header('location:?item=areamgr&act=new&msg=4');
			//$_GET["item"] = "areamgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 4;
			$overall_error = true;
			//exit();
		}
		else						
           if (empty($_POST['detail'])&& $_POST["mark"]!="addmorepic")
		{
		   header('location:?item=areamgr&act=new&msg=5');
			//$_GET["item"] = "areamgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 5;
		    $overall_error = true;
		}			
		
	}	
	if (!$overall_error && $_POST["mark"]=="savearea")
	{	    
		$fields = array("`subject`","`image`","`body`","`ndate`","`userid`","`type`");
		$_POST["detail"] = addslashes($_POST["detail"]);		
		$values = array("'{$_POST[subject]}'","'{$_POST[selectpic]}'","'{$_POST[detail]}'","'{$ndatetime}'","'{$userid}'","'{$_POST[cbtype]}'");
		if (!$db->InsertQuery('area',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=areamgr&act=new&msg=2');			
			//$_GET["item"] = "areamgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");			
			header('location:?item=areamgr&act=new&msg=1');		    
			//$_GET["item"] = "areamgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editarea")
	{		
	    $_POST["detail"] = addslashes($_POST["detail"]);	    
		$values = array("`subject`"=>"'{$_POST[subject]}'",
			        "`image`"=>"'{$_POST[selectpic]}'",
				"`body`"=>"'{$_POST[detail]}'",
				"`ndate`"=>"'{$ndatetime}'",
				"`userid`"=>"'{$userid}'",
                                "`type`"=>"'{$_POST[cbtype]}'");
			
        $db->UpdateQuery("area",$values,array("id='{$_GET[aid]}'"));
		header('location:?item=areamgr&act=mgr');
		//$_GET["item"] = "areamgr";
		//$_GET["act"] = "act";			
	}
        if (!$overall_error && $_POST["mark"]=="addmorepic")
	{			
                $pics = $db->SelectAll("areapics","*","aid = '{$_GET[aid]}'");	
		$img = array();
		$reqimg = array();
		$dif = array();
		if (empty($pics))
		{
			$fields = array("`aid`","`image`");
			if(!empty($_POST['picslist'])) 
			{
			  foreach($_POST['picslist'] as $key=>$val)
			  {		    
				$values = array("'{$_GET[aid]}'","'./areapics/{$val}'");
				$db->InsertQuery('areapics',$fields,$values);		
			  }	
			 }
		}
		else
		{
			foreach($pics as $key=>$val) $img[] = $val["image"];
			foreach($_POST['picslist'] as $key=>$val) $reqimg[] = "./areapics/{$val}";
			$dif = array_diff($img, $reqimg);
			foreach($dif as $key=>$val)
			{
				$db->Delete("areapics"," image","{$val}");				
			}
			$dif = array_diff($reqimg, $img);
			$fields = array("`aid`","`image`");
			foreach($dif as $key=>$val)
			{			
			    $values = array("'{$_GET[aid]}'","'{$val}'");
			    $db->InsertQuery('areapics',$fields,$values);
			}
		}
		header('location:?item=areamgr&act=mgr');		 
	 }

	if ($overall_error)
	{
		$row = array("subject"=>$_POST['subject'],
		             "image"=>$_POST['image'],
					 "body"=>$_POST['detail'],
					 "ndate"=>$_POST['ndate'],
					 "userid"=>$userid,					
					 "cat"=>$_POST['cbcat']);
	}
	
	
if ($_GET['act']=="new")
{
	$editorinsert = "
		<p>
			<input type='submit' id='submit' value='ذخیره' class='submit' />	 
			<input type='hidden' name='mark' value='savearea' />";
}
if ($_GET['act']=="edit")
{
	$row=$db->Select("area","*","id='{$_GET["aid"]}'",NULL);
	$row['ndate'] = ToJalali($row["ndate"]);
	$editorinsert = "
	<p>
      	 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
      	 <input type='hidden' name='mark' value='editarea' />";
}
if ($_GET['act']=="del")
{
	$db->Delete("area"," id",$_GET["aid"]);
	if ($db->CountAll("area")%10==0) $_GET["pageNo"]-=1;		
	header("location:?item=areamgr&act=mgr&pageNo={$_GET[pageNo]}");
}
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت فضاها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=areamgr&act=new">درج فضای جدید
					<span class="add-area"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=areamgr&act=mgr" id="area" name="area">حذف / ویرایش فضا
					<span class="edit-area"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else
if ($_GET['act']=="new" or $_GET['act']=="edit")
{
$msgs = GetMessage($_GET['msg']);
$sections = $db->SelectAll("section","*",null,"id ASC");
$cbarr = array(1=>"فضای داخلی",2=>"فضای خارجی");
$cbtype = SelectOptionTag("cbtype",$cbarr,1,null,"select validate[required]");
$html=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){	   
			$("#frmareamgr").validationEngine();
			$("#cbsec").change(function(){
				$.get('ajaxcommand.php?sec='+$(this).val(), function(data) {
						$('#catgory').html(data);
				});
			});
    });
	</script>
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>مدیریت فضاها</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmareamgr" id="frmareamgr" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
	 <div class="badboy"></div>
       <p>
         <label for="cbtype">نوع فضا </label>
         <span>*</span>
       </p>    
        {$cbtype}
      	<div class="badboy"></div>       
       <p>
         <label for="subject">عنوان </label>
         <span>*</span>
       </p>    
       <input type="text" name="subject" class="validate[required] subject" id="subject" value='{$row[subject]}'/> 
  	   <p>
         <label for="pic">عکس </label>
         <span>*</span>
       </p>       
	   <p>
	   		<input type="text" name="selectpic" class="selectpic" id="selectpic" value='{$row[image]}' />
	   		<input type="text" class="validate[required] showadd" id="showadd" value='{$row[image]}' />
	   		<a class="filesbrowserbtn" id="filesbrowserbtn" name="areamgr" title="گالری تصاویر">گالری تصاویر</a>
	   		<a class="selectbuttton" id="selectbuttton" title="انتخاب">انتخاب</a>
	   </p>
	   <div class="badboy"></div>
	   <div id="filesbrowser"></div>
	   <div class="badboy"></div>
  	   <p>
         <label for="detail">توضیحات </label>
         <span>*</span>
       </p>
       <textarea cols="50" rows="10" name="detail" class="detail" id="detail" > {$row[body]}</textarea>
  	   <p>
        <label for="sdate">تاریخ </label>
        <span>*</span><br /><br />
        <input type="text" name="ndate" class="validate[required] ndate" id="date_input_1" value='{$row[ndate]}' />
        <img src="./images/cal.png" id="date_btn_1" alt="cal-pic">
         <script type="text/javascript">
          Calendar.setup({
            inputField  : "date_input_1",   // id of the input field
            button      : "date_btn_1",   // trigger for the calendar (button ID)
                ifFormat    : "%Y-%m-%d",       // format of the input field
                showsTime   : false,
                dateType  : 'jalali',
                showOthers  : true,
                langNumbers : true,
                weekNumbers : true
          });
        </script>
       </p>
       <p>  	   
	   {$editorinsert}       
      	 <input type="reset" value="پاک کردن" class='reset' /> 	 	     
       </p>  
	</form>
	<div class='badboy'></div>	
  </div>  
   
cd;
} 
else
if ($_GET['act']=="pic")
{
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
<script type='text/javascript'>
	$(document).ready(function(){		  	 		
		$("#tab1").click(function(){
		$.get('ajaxcommand.php?cmd=areapics&id={$_GET[aid]}', function(data) {
						$('#catab1 ul').html(data);
				});			
			return false;
		});		
		$("#tab1").click();
	});
</script>	
<div class="mes" id="message">{$msgs}</div>   
	<div class="picmanager">		
		<div class="files right add-pics">
			<div class="pics cat-box-content cat-box tab" id="cats-tabs-box">
				<div class="cat-tabs-header" id="cat-tabs-header">
					<ul>						
						<li id="tab1" class="active"><a href="#catab1">پوشه فضاها</a></li>						
					</ul>
				</div>				
				<div class="cat-tabs-wrap-pic" id="catab1">
					<ul>
					
					</ul>
					<div class="badboy"></div>
				</div>				
			</div>
		<div class="badboy"></div>
	</div>
</div>
cd;
}
else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srharea")
	{	 		
	    if ($_POST["cbsearch"]=="ndate")
		{
		   date_default_timezone_set('Asia/Tehran');		   
		   list($year,$month,$day) = explode("/", trim($_POST["txtsrh"]));		
		   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
		   $_POST["txtsrh"] = Date("Y-m-d",mktime(0, 0, 0, $gmonth, $gday, $gyear));
		}
		$rows = $db->SelectAll(
				"area",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"ndate DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "areamgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=areamgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"area",
				"*",
				null,
				"ndate DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srharea")?$db->CountAll("area"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>20)?mb_substr($rows[$i]["subject"],0,20,"UTF-8")."...":$rows[$i]["subject"];
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");               
                $rows[$i]["ndate"] =ToJalali($rows[$i]["ndate"]," l d F  Y ");
				$rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";                                            
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}
				$rows[$i]["username"]=GetUserName($rows[$i]["userid"]);
                                $rows[$i]["type"]=  GetTypeName($rows[$i]["type"]);
                                $rows[$i]["addpic"] = "<a href='?item=areamgr&act=pic&aid={$rows[$i]["id"]}' class='add-pic'" .
						"style='text-decoration:none;'></a>";
				$rows[$i]["edit"] = "<a href='?item=areamgr&act=edit&aid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این خبر اطمینان دارید؟',
				'?item=areamgr&act=del&pageNo={$_GET[pageNo]}&aid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 					       
                                                "subject"=>"عنوان",
                                                "image"=>"تصویر",
                                                "type"=>"نوع فضا",
                                                "body"=>"توضیحات",
                                                "ndate"=>"تاریخ",                                               						
                                                "username"=>"کاربر",
                                                "addpic"=>"عکس",
                                                "edit"=>"ویرایش",
                                                "delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=areamgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات",
			  "ndate"=>"تاریخ",
			  "resource"=>"منبع");
$combobox = SelectOptionTag("cbsearch",$list,"subject");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});
		$('#cbsearch').change(function(){
			$("select option:selected").each(function(){
	            if($(this).val()=="ndate"){
	            	$('.cal-btn').css('display' , 'inline-block');
	            	return false;
	            }else{
	            	$('.cal-btn').css('display' , 'none');
	            }
  			});
		});
	});
</script>	   
					<div class="title">
				      <ul>
				        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span>مدیریت فضاها</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=areamgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>

								<p class="search-form">
									<input type="text" id="date_input_1" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 
									<img src="./images/cal.png" class="cal-btn" id="date_btn_2" alt="cal-pic">
							         <script type="text/javascript">
							          Calendar.setup({
							            inputField  : "date_input_1",   // id of the input field
							            button      : "date_btn_2",   // trigger for the calendar (button ID)
							                ifFormat    : "%Y/%m/%d",       // format of the input field
							                showsTime   : false,
							                dateType  : 'jalali',
							                showOthers  : true,
							                langNumbers : true,
							                weekNumbers : true
							          });
							        </script>
									<a href="?item=areamgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=areamgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srharea" /> 
								{$msgs}
								{$gridcode} 
							</form>
					   </center>
					</div>
edit;
$html = $code;
}	
return $html;
?>