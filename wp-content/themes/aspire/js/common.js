/**************************************************************************
* Common js

**************************************************************************/
jQuery(document).ready(function() {
	"use strict";
	 /* Navigation */
/* Mega Menu */
	jQuery('.mega-menu-title').on('click',function(){
		if(jQuery('.mega-menu-category').is(':visible')){
			jQuery('.mega-menu-category').slideUp();
		} else {
			jQuery('.mega-menu-category').slideDown();
		}
	});
    
    
    jQuery('.mega-menu-category .nav > li').hover(function(){
    	jQuery(this).addClass("active");
		jQuery(this).find('.popup').stop(true,true).fadeIn('slow');
    },function(){
        jQuery(this).removeClass("active");
		jQuery(this).find('.popup').stop(true,true).fadeOut('slow');
    });
    
    
	jQuery('.mega-menu-category .nav > li.view-more-cat').on('click',function(e){
		if(jQuery('.mega-menu-category .nav > li.more-menu').is(':visible')){
			jQuery('.mega-menu-category .nav > li.more-menu').stop().slideUp();
			jQuery(this).find('a').text('More');
		} else { 
			jQuery('.mega-menu-category .nav > li.more-menu').stop().slideDown();
			jQuery(this).find('a').text('Close menu');
			 jQuery(this).find('a').addClass('menu-hide');
			
		}
		e.preventDefault();
	});
	
	
	/* Bestsell slider */
	jQuery("#bestsell-slider .slider-items").owlCarousel({
		items: 4, //10 items above 1000px browser width
		itemsDesktop: [1024, 3], //5 items between 1024px and 901px
		itemsDesktopSmall: [980, 2], // 3 items betweem 900px and 601px
		itemsTablet: [768, 2], //2 items between 600 and 0;
		itemsMobile: [479, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});
	/* Featured slider */
	jQuery("#featured-slider .slider-items").owlCarousel({
		items: 4, //10 items above 1000px browser width
		itemsDesktop: [1024, 3], //5 items between 1024px and 901px
		itemsDesktopSmall: [980, 3], // 3 items betweem 900px and 601px
		itemsTablet: [768, 2], //2 items between 600 and 0;
		itemsMobile: [360, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});
	/* New arrivals slider */
	jQuery("#new-arrivals-slider .slider-items").owlCarousel({
		items: 4, //10 items above 1000px browser width
		itemsDesktop: [1024, 3], //5 items between 1024px and 901px
		itemsDesktopSmall: [980, 2], // 3 items betweem 900px and 601px
		itemsTablet: [768, 2], //2 items between 600 and 0;
		itemsMobile: [479, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});

	/* New arrivals slider */
	jQuery("#new-arrivals-sliderv2 .slider-items").owlCarousel({
		items: 5, //10 items above 1000px browser width
		itemsDesktop: [1024, 3], //5 items between 1024px and 901px
		itemsDesktopSmall: [980, 3], // 3 items betweem 900px and 601px
		itemsTablet: [768, 2], //2 items between 600 and 0;
		itemsMobile: [479, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});



	/* Brand logo slider */
	jQuery("#brand-logo-slider .slider-items").owlCarousel({
		autoPlay: true,
		items: 6, //10 items above 1000px browser width
		itemsDesktop: [1024, 4], //5 items between 1024px and 901px
		itemsDesktopSmall: [900, 3], // 3 items betweem 900px and 601px
		itemsTablet: [600, 2], //2 items between 600 and 0;
		itemsMobile: [320, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});

	/* Related products slider */
	jQuery("#related-products-slider .slider-items").owlCarousel({
		items: 4, //10 items above 1000px browser width
		itemsDesktop: [1024, 3], //5 items between 1024px and 901px
		itemsDesktopSmall: [980, 3], // 3 items betweem 900px and 601px
		itemsTablet: [768, 2], //2 items between 600 and 0;
		itemsMobile: [479, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});
	/* Upsell products slider */
	jQuery("#upsell-products-slider .slider-items").owlCarousel({
		items: 4, //10 items above 1000px browser width
		itemsDesktop: [1024, 3], //5 items between 1024px and 901px
		itemsDesktopSmall: [980, 3], // 3 items betweem 900px and 601px
		itemsTablet: [768, 2], //2 items between 600 and 0;
		itemsMobile: [479, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});
	/* testimonials slider */
	jQuery("#testimonials-slider .slider-items").owlCarousel({
		    autoPlay: true,
			items: 1,
			itemsDesktop: [1024, 1],
			itemsDesktopSmall: [900, 1],
			itemsTablet: [640, 1],
			itemsMobile: [390, 1],
			navigation: false,
			navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
			slideSpeed: 500,
			pagination: false
		
		});

	/* new featured added 3.0 */

	// category wise slider	
	jQuery(".categorywise-slider .slider-items").owlCarousel({
		items: 5, //10 items above 1000px browser width
		itemsDesktop: [1024, 3], //5 items between 1024px and 901px
		itemsDesktopSmall: [980, 3], // 3 items betweem 900px and 601px
		itemsTablet: [768, 2], //2 items between 600 and 0;
		itemsMobile: [479, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});

	jQuery(".recommended-slider .slider-items").owlCarousel({
		items: 5, //10 items above 1000px browser width
		itemsDesktop: [1024, 3], //5 items between 1024px and 901px
		itemsDesktopSmall: [980, 3], // 3 items betweem 900px and 601px
		itemsTablet: [768, 2], //2 items between 600 and 0;
		itemsMobile: [479, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});

	jQuery(".recentlypurchase-slider .slider-items").owlCarousel({
		items: 5, //10 items above 1000px browser width
		itemsDesktop: [1024, 3], //5 items between 1024px and 901px
		itemsDesktopSmall: [980, 3], // 3 items betweem 900px and 601px
		itemsTablet: [768, 2], //2 items between 600 and 0;
		itemsMobile: [479, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});

	jQuery(".recentlyviewed-slider .slider-items").owlCarousel({
		items: 4, //10 items above 1000px browser width
		itemsDesktop: [1024, 3], //5 items between 1024px and 901px
		itemsDesktopSmall: [980, 3], // 3 items betweem 900px and 601px
		itemsTablet: [768, 2], //2 items between 600 and 0;
		itemsMobile: [479, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});

	jQuery(".onsale-slider .slider-items").owlCarousel({
		items: 2, //10 items above 1000px browser width
		itemsDesktop: [1024, 2], //5 items between 1024px and 901px
		itemsDesktopSmall: [980, 2], // 3 items betweem 900px and 601px
		itemsTablet: [768, 1], //2 items between 600 and 0;
		itemsMobile: [360, 1],
		navigation: true,
		navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
		slideSpeed: 500,
		pagination: false
	});

	

	

	
	

	/* Mobile menu */
	jQuery("#mobile-menu").mobileMenu({
		MenuWidth: 250,
		SlideSpeed: 300,
		WindowsMaxWidth: 767,
		PagePush: true,
		FromLeft: true,
		Overlay: true,
		CollapseMenu: true,
		ClassName: "mobile-menu"
	});
	/* side nav categories */
	if (jQuery('.subDropdown')[0]) {
		jQuery('.subDropdown').on("click", function() {
			jQuery(this).toggleClass('plus');
			jQuery(this).toggleClass('minus');
			jQuery(this).parent().find('ul').slideToggle();
		});
	}
	jQuery.extend(jQuery.easing, {
		easeInCubic: function(x, t, b, c, d) {
			return c * (t /= d) * t * t + b;
		},
		easeOutCubic: function(x, t, b, c, d) {
			return c * ((t = t / d - 1) * t * t + 1) + b;
		},
	});
	(function(jQuery) {
		jQuery.fn.extend({
			accordion: function() {
				return this.each(function() {
					function activate(el, effect) {
						jQuery(el).siblings(panelSelector)[(effect || activationEffect)](((effect == "show") ? activationEffectSpeed : false), function() {
							jQuery(el).parents().show();
						});
					}
				});
			}
		});
	})(jQuery);
	jQuery(function(jQuery) {
		jQuery('.accordion').accordion();
		jQuery('.accordion').each(function(index) {
			var activeItems = jQuery(this).find('li.active');
			activeItems.each(function(i) {
				jQuery(this).children('ul').css('display', 'block');
				if (i == activeItems.length - 1) {
					jQuery(this).addClass("current");
				}
			});
		});
	});
	/* Top Cart js */
	function slideEffectAjax() {
		jQuery('.top-cart-contain').mouseenter(function() {
			jQuery(this).find(".top-cart-content").stop(true, true).slideDown();
		});
		jQuery('.top-cart-contain').mouseleave(function() {
			jQuery(this).find(".top-cart-content").stop(true, true).slideUp();
		});
	}
	jQuery(document).ready(function() {
		slideEffectAjax();
	});
	/*  sticky header  */
	jQuery(window).scroll(function() {
		jQuery(this).scrollTop() > 1 ? jQuery("nav").addClass("sticky-header") : jQuery("nav").removeClass("sticky-header")
			});
});
/*  UItoTop */
jQuery.fn.UItoTop = function(options) {
	var defaults = {
		text: '',
		min: 200,
		inDelay: 600,
		outDelay: 400,
		containerID: 'toTop',
		containerHoverID: 'toTopHover',
		scrollSpeed: 1200,
		easingType: 'linear'
	};
	var settings = jQuery.extend(defaults, options);
	var containerIDhash = '#' + settings.containerID;
	var containerHoverIDHash = '#' + settings.containerHoverID;
	jQuery('body').append('<a href="#" id="' + settings.containerID + '">' + settings.text + '</a>');
	jQuery(containerIDhash).hide().on("click", function() {
		jQuery('html, body').animate({
			scrollTop: 0
		}, settings.scrollSpeed, settings.easingType);
		jQuery('#' + settings.containerHoverID, this).stop().animate({
			'opacity': 0
		}, settings.inDelay, settings.easingType);
		return false;
	}).prepend('<span id="' + settings.containerHoverID + '"></span>').hover(function() {
		jQuery(containerHoverIDHash, this).stop().animate({
			'opacity': 1
		}, 600, 'linear');
	}, function() {
		jQuery(containerHoverIDHash, this).stop().animate({
			'opacity': 0
		}, 700, 'linear');
	});
	jQuery(window).scroll(function() {
		var sd = jQuery(window).scrollTop();
		if (typeof document.body.style.maxHeight === "undefined") {
			jQuery(containerIDhash).css({
				'position': 'absolute',
				'top': jQuery(window).scrollTop() + jQuery(window).height() - 50
			});
		}
		if (sd > settings.min) jQuery(containerIDhash).fadeIn(settings.inDelay);
		else jQuery(containerIDhash).fadeOut(settings.Outdelay);
	});
};
/* mobileMenu */
var isTouchDevice = ('ontouchstart' in window) || (navigator.msMaxTouchPoints > 0);
jQuery(window).on("load", function() {
	if (isTouchDevice) {
		jQuery('#nav a.level-top').on("click", function(e) {
			jQueryt = jQuery(this);
			jQueryparent = jQueryt.parent();
			if (jQueryparent.hasClass('parent')) {
				if (!jQueryt.hasClass('menu-ready')) {
					jQuery('#nav a.level-top').removeClass('menu-ready');
					jQueryt.addClass('menu-ready');
					return false;
				} else {
					jQueryt.removeClass('menu-ready');
				}
			}
		});
	}
	jQuery().UItoTop();
});





/* category style js */
jQuery(function() {
  jQuery(".widget_product_categories ul > li.cat-item.cat-parent > ul").hide();
  jQuery(".widget_product_categories ul > li.cat-item.cat-parent.current-cat-parent > ul").show();
  jQuery(".widget_product_categories ul > li.cat-item.cat-parent.current-cat.cat-parent > ul").show();
  jQuery(".widget_product_categories ul > li.cat-item.cat-parent").click(function() {
    if (jQuery(this).hasClass('current-cat-parent')) {
      var li = jQuery(this).closest('li');
      li.find(' > ul').slideToggle('fast');
      jQuery(this).toggleClass("close-cat");
    } else {
      var li = jQuery(this).closest('li');
      li.find(' > ul').slideToggle('fast');
      jQuery(this).toggleClass("cat-item.cat-parent open-cat");
    }
  });
  jQuery(".widget_product_categories ul.children li.cat-item,ul.children li.cat-item > a").click(function(e) {
    e.stopPropagation();
  });
});
   

 /*wishlist js*/
jQuery(document).off("click", ".link-wishlist");

jQuery(document).on("click", ".link-wishlist", function() {

    var b = yith_wcwl_l10n.ajax_url;
    var opts = {
        add_to_wishlist: jQuery(this).data("product-id"),
        product_type: jQuery(this).data("product-type"),
        action: "add_to_wishlist"
    };
    mgk_yith_ajax_wish_list(jQuery(this), b, opts);
    return false;
});

mgk_yith_ajax_wish_list = function(obj, ajaxurl, opts) {
    jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        data: "product_id=" + opts.add_to_wishlist + "&" + jQuery.param(opts),
        dataType: 'json',
        success: function(resp) {
            response_result = resp.result,
                response_message = resp.message;
            //alert(response_result+"----"+response_message);
            jQuery('body .page div#notification').remove();
            var ntop = jQuery('#wpadminbar') !== undefined ? jQuery('#wpadminbar').height() : 10;
            if (response_result == 'true') {
            	
                if (MGK_ADD_TO_WISHLIST_SUCCESS_TEXT !== undefined)
                    jQuery('<div id="notification" class="row"><div class="success">' + MGK_ADD_TO_WISHLIST_SUCCESS_TEXT + '<img class="close" alt="" src="' + IMAGEURL + '/close.png"></div></div>').prependTo('body .page');
                jQuery('body .page div#notification').css('top', ntop + 'px');
                jQuery('body .page div#notification > div').fadeIn('show');
                jQuery('html,body').animate({
                    scrollTop: 0
                }, 300);
            } else if (response_result == 'exists') {
                if (MGK_ADD_TO_WISHLIST_EXISTS_TEXT !== undefined)
                    jQuery('<div id="notification" class="row"><div class="success">' + MGK_ADD_TO_WISHLIST_EXISTS_TEXT + '<img class="close" alt="" src="' + IMAGEURL + '/close.png"></div></div>').prependTo('body .page');
                jQuery('body .page div#notification').css('top', ntop + 'px');
                jQuery('body .page div#notification > div').fadeIn('show');
                jQuery('html,body').animate({
                    scrollTop: 0
                }, 300);

            }
            setTimeout(function() {
                removeNft();
            }, 10000);

        }
    });
};

var removeNft = function() {
    if (jQuery("#notification") !== undefined)
        jQuery("#notification").remove();
};




   /*add to compare js */    


jQuery(document).off('click', 'a.compare');
jQuery(document).on('click', 'a.compare', function(e) {

        e.preventDefault();
        var button = jQuery(this),
            data = {
                action: yith_woocompare.actionadd,
                id: button.data('product_id'),
                context: 'frontend'
            },
            widget_list = jQuery('.yith-woocompare-widget ul.products-list');

        // add ajax loader
        if( typeof jQuery.fn.block != 'undefined' ) {
            button.block({message: null, overlayCSS: { background: '#fff url(' + yith_woocompare.loader + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});
            widget_list.block({message: null, overlayCSS: { background: '#fff url(' + yith_woocompare.loader + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});
        }

        jQuery.ajax({
            type: 'post',
            url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', yith_woocompare.actionadd ),
            data: data,
            dataType: 'json',
            success: function(response){

                if( typeof jQuery.fn.block != 'undefined' ) {
                    button.unblock();
                    widget_list.unblock()
                }

                button.addClass('added')
                        .attr( 'href', response.table_url )
                        .text( yith_woocompare.added_label );

                // add the product in the widget
                widget_list.html( response.widget_table );

                if ( yith_woocompare.auto_open == 'yes')
                    jQuery('body').trigger( 'yith_woocompare_open_popup', { response: response.table_url, button: button } );
            }
        });
    });



    jQuery(document).on('click', 'a.compare.added', function (ev) {
        ev.preventDefault();

        var table_url = this.href;

        if (typeof table_url == 'undefined')
            return;

        jQuery('body').trigger('yith_woocompare_open_popup', {response: table_url, button: jQuery(this)});
    });



 jQuery(document).ready(function() {
	
   jQuery(".product-shop .variations_form .variations select").click(function () {        
    var varimg= jQuery(".product-full a").attr('href');      	
    
     jQuery(".zoomWindowContainer div").css("background-image","url("+varimg+")");  
   
   });
    }); 

 /* variation image change js */

     jQuery(document).ready(function() {
    
   
   jQuery(".product-shop .variations_form .variations select").click(function () {        
    var varimg= jQuery(".product-full a").attr('href');         
 
     jQuery(".zoomWindowContainer div").css("background-image","url("+varimg+")");  
   
   });
    });

     