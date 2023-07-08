// Function to determine if element is in viewport
jQuery.fn.isInViewport = function() {
    var elementTop = jQuery(this).offset().top;
    var elementBottom = elementTop + jQuery(this).outerHeight();

    var viewportTop = jQuery(window).scrollTop();
    var viewportBottom = viewportTop + jQuery(window).height();

    return elementBottom > viewportTop && elementTop < viewportBottom;
};

//jQuery
jQuery( document ).ready(function() {

    // Video
    jQuery('.video a').click(function(event) {
        event.preventDefault();
        var src = jQuery(this).data('video');
        var modal = jQuery(this).data('modal');
        jQuery('#'+modal).modal('show');
        jQuery('#'+modal+' iframe').attr('src', src);
    });
    jQuery('.modal').click(function () {
        jQuery('.modal iframe').removeAttr('src');
    });

    // Slider module
    // var swiper = new Swiper(".custom-slider", {
    //     slidesPerView: 1.4,
    //     centeredSlides: false,
    //     grabCursor: true,
    //     spaceBetween: 24,
    //     loop: false,
    //     navigation: {
    //         nextEl: '.custom-slider-wrapper .swiper-button-next',
    //         prevEl: '.custom-slider-wrapper .swiper-button-prev',
    //       },
    //     breakpoints: {
    //         768: {
    //             slidesPerView: 2.4,
    //             centeredSlides: false,
    //             spaceBetween: 24
    //         },
    //         992: {
    //             slidesPerView: 2,
    //             centeredSlides: false,
    //             spaceBetween: 24
    //         }
    //     }
    // });

    // Swiper - Tijdlijn
    // var swiper = new Swiper(".slider .swiper", {
    //     slidesPerView: 2,
    //     centeredSlides: false,
    //     grabCursor: true,
    //     spaceBetween: 15,
    //     loop: true,
    //     breakpoints: {
    //         768: {
    //             centeredSlides: false,
    //             slidesPerView: 3
    //         },
    //         992: {
    //             centeredSlides: false,
    //             slidesPerView: 4,
    //             spaceBetween: 30
    //         },
    //         1200: {
    //             centeredSlides: false,
    //             slidesPerView: 6,
    //             spaceBetween: 30,
    //             navigation: {
    //                 nextEl: ".navigation .next",
    //                 prevEl: ".navigation .prev",
    //             }
    //         }
    //     }
    // });

    // var swiper = new Swiper(".galerij .swiper", {
    //     slidesPerView: 1.2,
    //     centeredSlides: false,
    //     grabCursor: true,
    //     spaceBetween: 15,
    //     loop: false,
    //     breakpoints: {
    //         768: {
    //             centeredSlides: false,
    //             slidesPerView: 2.2
    //         },
    //         992: {
    //             centeredSlides: false,
    //             slidesPerView: 3.2,
    //             spaceBetween: 30,
    //             loop: true
    //         },
    //         1200: {
    //             centeredSlides: false,
    //             slidesPerView: 4.2,
    //             spaceBetween: 30,
    //             loop: true
    //         }
    //     }
    // });

    // Masonry grid
    // if(typeof imagesLoaded === "function"){
    //     var $grid = jQuery('.grid').imagesLoaded( function() {
    //         $grid.masonry({
    //             itemSelector: '.grid-item',
    //             columnWidth: '.grid-sizer',
    //             percentPosition: true
    //         });
    //     })
    // }

    // Filters
    // jQuery('.filters a').click(function(event) {
    //     event.preventDefault();
    //     jQuery('.reset').show();
    //     jQuery('.grid-item').hide();
    //     jQuery(this).addClass('filter-active');
        
    //     var type = jQuery(this).attr("href");
    //     type = type.substring(1);
    //     jQuery("."+type).show();
    //     jQuery('.grid').masonry();
    // });

    // jQuery('.reset').click(function(event) {
    //     event.preventDefault();
    //     jQuery('.filter-btn').removeClass('filter-active');
    //     jQuery('.reset').hide();
    //     jQuery('.grid-item').show();
    //     jQuery('.grid').masonry();
    // });

    // On scroll, resize or load
    jQuery(window).on("load resize scroll", function () {
        jQuery('.icon, .product_blokken .img, .producten h3, .producten .item').each(function() {
            if( jQuery(this).isInViewport() ) {
                jQuery(this).addClass('transition');
            }
        });
    });

    // Scroll to anchor
    jQuery(".scroll").click(function(e) {
        e.preventDefault();
        var dest = jQuery(this).attr('href');
        jQuery('html,body').animate({
            scrollTop: jQuery(dest).offset().top
        }, 'slow');
    });

    /** Eventtracking
     * Add class 'eventtracking' to trigger this function
     * Set data attributes (data-action, data-category, data-label, data-value, data-preventdefault)
     */
    jQuery('.eventtracking').click(function(event) {
        var action = jQuery(this).data('action');
        var category = jQuery(this).data('category');
        var label = jQuery(this).data('label');
        var value = jQuery(this).data('value');
        var preventdefault = jQuery(this).data('preventdefault');

        if (preventdefault == 'true') {
            event.preventDefault();
        }

        gtag( 'event', action, {
            'event_category': category,
            'event_label': label,
            'event_value': value
        });
    });

    // Add class to top on scroll
    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 0) {
            jQuery('.top').addClass('transition schaduw');
        } else {
            jQuery('.top').removeClass('transition schaduw');
        }
    });

    // Add class to home header on scroll
    // jQuery(window).scroll(function(){
    //     if (jQuery(this).scrollTop() > 0) {
    //         jQuery('.home .top').addClass('menu-scroll');
    //     } else {
    //         jQuery('.home .top').removeClass('menu-scroll');
    //     }
    // });

    // Check if CSS Objectfit is supported
    if (Modernizr.objectfit) {
        console.log('Objectfit is supported');
    } else {
        console.log('Objectfit is NOT supported');
        jQuery('.gallery-link').each(function () {
            var $container = jQuery(this);
            var imgUrl = $container.find('img').prop('src');
            
            if (imgUrl) {
                $container.css('backgroundImage', 'url(' + imgUrl + ')').addClass('compat-object-fit');
            }
        });
    }

    // Cookies
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    jQuery('.cookies .cookie-accept').click(function(event){
        event.preventDefault();
        bar = 'accepted';
        setCookie("avgcookie", bar, 365);
        console.log('Cookies accepted');
        jQuery('.cookies').fadeOut();
    });

    jQuery('.cookies .cookie-decline').click(function(event){
        event.preventDefault();
        //bar = 'accepted';
        //setCookie("avgcookie", bar, 365);
        console.log('Cookies declined');
        jQuery('.cookies').fadeOut();
    });

    // jQuery('.cookies .sluiten').click(function(event){
    //     event.preventDefault();
    //     bar = 'accepted';
    //     setCookie("avgcookie", bar, 365);
    //     jQuery('.cookies').fadeOut();
    // });

    // jQuery('.cookies .leesmeer').click(function(event){
    //     //event.preventDefault();
    //     bar = 'accepted';
    //     setCookie("avgcookie", bar, 365);
    //     jQuery('.cookies').fadeOut();
    // });

    var bar = getCookie("avgcookie");
    if (bar == "") {
        setTimeout(function(){ jQuery('.cookies').fadeIn(); }, 1000);
        setTimeout(function(){ 
            setCookie("avgcookie", 'accepted', 365);
            jQuery('.cookies').fadeOut(); 
        //}, 10000);
        });
    }

    // Make div clickable
    jQuery(".clickable").click(function() {
        window.location = jQuery(this).find("a").attr("href"); 
        return false;
    });

    // Add caret to mobile menu if window smaller than 992, else disable links with #
    if (jQuery(window).width() < 992) {
        // Add caret to mobile parent item
        jQuery('.navbar-collapse.collapse ul li.menu-item-has-children ul').hide();
        jQuery('.navbar-collapse.collapse ul li.menu-item-has-children > a').append('<i class="fas fa-angle-down"></i>');
        jQuery('.navbar-collapse.collapse ul li.menu-item-has-children > a i').click(function(event) {
            event.preventDefault();
            jQuery(this).toggleClass('active');
            jQuery(this).parent().parent().find("ul").first().toggle();
        });
    } else {
        // Disable links met #
        jQuery('a[href="#"]').click(function(){ return false;})
        jQuery('ul.nav.navbar-nav > li.menu-item-has-children > a').append('<i class="fas fa-angle-down padding-left"></i>');
        jQuery('ul.sub-menu > li.menu-item-has-children > a').append('<i class="fas fa-angle-right"></i>');
    }

    // WPML menu
    jQuery('.sec-nav > li.menu-item-has-children > a').click(function(event) {
        event.preventDefault();
    });
    jQuery('.sec-nav > li.menu-item-has-children').prepend('<i class="far fa-globe padding-right"></i>');
    jQuery('ul.sec-nav > li.menu-item-has-children > a').append('<i class="fas fa-angle-down padding-left"></i>');
});