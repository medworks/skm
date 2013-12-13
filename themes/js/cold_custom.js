jQuery(window).load(function(){
	jQuery('.share_buttons').css('right', -jQuery('.share_buttons').width());
	jQuery('.share_button').toggle(
		function() {
			var $righty = jQuery(this).next('.share_buttons');
			$righty.animate({
				right: jQuery(this).width()
			});
			jQuery("#add-this img").attr('src','themes/images/minus-this.png');
		},
		function() {
			var $righty = jQuery(this).next('.share_buttons');
			$righty.animate({
				right: -$righty.outerWidth()
			});
			jQuery("#add-this img").attr('src','themes/images/add-this.png');
		}
	);
});
jQuery(document).ready(function(){
	jQuery(".toggle_title").toggle(
		function() {
			jQuery(this).addClass('toggle_active');
			jQuery(this).next('.toggle_content').slideDown("fast");
		},
		function() {
			jQuery(this).removeClass('toggle_active');
			jQuery(this).next('.toggle_content').slideUp("fast");
		}
	);
	jQuery(".accordion_title").click(
		function() {
			jQuery(this).siblings('.accordion_content').slideUp("fast");
			jQuery(this).siblings('.accordion_title').removeClass('accordion_active');
			if(jQuery(this).hasClass('accordion_active')) {
				jQuery(this).removeClass('accordion_active');
			} else {
				jQuery(this).addClass('accordion_active');
				jQuery(this).next('.accordion_content').slideDown("fast");
			}
		}
	);
	jQuery('a.tab').each(function(index) {
		jQuery(this).attr('id', 'tab' + index);
		jQuery('div.tab_content').eq(index).attr('id', 'tab' + index);
		if(jQuery(this).parent('li').hasClass('current')) {
			jQuery('div.tab_content').eq(index).css('left', '0');
			jQuery('div.tab_content').eq(index).css('position', 'relative');
			jQuery('div.tab_content').eq(index).show();
		}
	});
	jQuery("a.tab").click(
		function(event) {
			event.preventDefault();
			jQuery(this).parents('ul').children('li.current').removeClass('current');
			jQuery(this).parent('li').addClass('current');
			jQuery(this).parents('ul').children('li').each(function() { jQuery('div#' + jQuery(this).children('a').attr('id')).hide(); });
			jQuery('div#' + jQuery(this).attr('id')).css('left', '0');
			jQuery('div#' + jQuery(this).attr('id')).css('position', 'relative');
			jQuery('div#' + jQuery(this).attr('id')).show();
		}
	);
});

jQuery(function() {
	jQuery('ul.sf-menu').superfish({ delay: 300, animation: { height:'show' }, speed: 'normal' });
});

jQuery(function() {
	$('ul#menu-top-menu li a').each(function(){
		if(this.href.trim()==url){
			$(this).parent().addClass("current-menu-item");
			return false;
		}else if(url.match(/page/i)){
			var href=window.location.href.substr(url.indexOf("/"));
			href=href.split('-');
			href=href[0].split('/');
			$('ul#menu-top-menu li a[href*="'+href[3]+'"]').parent().addClass('current-menu-item');
		}
	});
});
