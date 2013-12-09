function activateOptions() {
	jQuery("li.portfolio-item").hover(
		function() {
			jQuery(this).find('ul.fancy_nav').fadeIn();
		},
		function() {
			jQuery(this).find('ul.fancy_nav').fadeOut();
		}
	);
}

jQuery(document).ready(function(){
	var $filterList = jQuery('ul.portfolio');
	var $data = $filterList.clone();
	activateOptions();
	jQuery('#pcats a').click(function(e) {
		if(jQuery(this).attr('rel') == 'all') {
			var $filteredData = $data.find('li.portfolio-item');
		} else {
			var $filteredData = $data.find('li.' + jQuery(this).attr('rel'));
		}
		jQuery('#items').quicksand($filteredData, {
			duration: 500,
			attribute: function(v) {
				return jQuery(v).attr('id');
			}
		}, function() {
				activateOptions();
                jQuery('.tiptip').tipsy();
                jQuery("a[rel^='prettyPhoto']").prettyPhoto({ overlay_gallery: false, social_tools: '', deeplinking: false });
            }
        );
    	e.preventDefault();
	});
});

jQuery(function() {
    var $el, leftPos, newWidth, $mainNav = jQuery("#pcats");

    $mainNav.append("<li id='magic-line'></li>");
    var $magicLine = jQuery("#magic-line");

    function showLine() {
        $magicLine
            .width(jQuery(".current_page_item_li").width())
            .css("left", jQuery(".current_page_item_li a").position().left)
            .data("origLeft", $magicLine.position().left)
            .data("origWidth", $magicLine.width());
    }
    showLine();
        
    jQuery("#pcats li a").click(function() {
        jQuery(this).parent().siblings().removeClass("current_page_item_li");
                jQuery(this).parent().addClass("current_page_item_li");
        showLine();
	});

    jQuery("#pcats li a").hover(function() {
        $el = jQuery(this);
        leftPos = $el.position().left;
        newWidth = $el.parent().width();
        $magicLine.stop().animate({
            left: leftPos,
            width: newWidth
        });
    }, function() {
        $magicLine.stop().animate({
            left: $magicLine.data("origLeft"),
            width: $magicLine.data("origWidth")
        });
    });
});
