<?php
	$about = GetSettingValue('About_System',0);	
$html=<<<cd
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a>درباره ما</a>
			</div>
			<div id="intro" class="text-intro">
				<h1>درباره ما</h1>
			</div>
			<div class="full_page">
				{$about}
			</div>
		</div>
	</div>
cd;

return $html;
?>