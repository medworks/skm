<?php
$db = database::GetDatabase();
$gallery= $db->SelectAll('gallery',NULL,NULL," id DESC");

$html=<<<cd
	<div id="wrapper">
		<div id="main_wrapper">
			<div id="breadcrumb">
				<a href="./">صفحه اصلی</a> <span>›</span>
				<a>گالری تصاویر</a>
			</div>
			<div id="intro" class="text-intro">
				<h1>گالری تصاویر</h1>
			</div>
			<div class="gallery-default">
				<div class="full_page">
					<div id="post-221">
						<div id="galleria-1">
cd;
						for($i=0 ; $i<count($gallery) ; $i++){
$html.=<<<cd
				            <img src="{$gallery[$i][image]}" alt="{$gallery[$i][subject]}" title="{$gallery[$i][subject]}" />
cd;
						}
$html.=<<<cd
				        </div>
						<script type="text/javascript">
							jQuery(document).ready(function()
								{
									jQuery("#galleria-1").galleria({ width: 930, height: 420, thumbnails: true, autoplay: 0});
									jQuery(".galleria-container").css("background", "#cfcfcf");
								}
							);
						</script>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
	</div>

cd;

return $html;
?>