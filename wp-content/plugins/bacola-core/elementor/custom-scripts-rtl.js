/* KLB Addons for Elementor v1.0 */

jQuery.noConflict();
!(function ($) {
	"use strict";

	
	/* CAROUSEL*/
	function klb_carousel($scope, $) {
      var container = $( '.site-slider' );

      container.each( function() {
        var self = $(this);

        var sliderItems = $( '.slider-item' );
        sliderItems.imagesLoaded( function() {
          self.closest( '.slider-wrapper' ).addClass( 'slider-loaded' );
        });

        var autoplay = $( this ).data( 'autoplay' );
        var autospeed = $( this ).data( 'autospeed' );
        var arrows = $( this ).data( 'arrows' );
        var dots = $( this ).data( 'dots' );
        var slideshow = $( this ).data( 'slideshow' );
        var slidescroll = $( this ).data( 'slidescroll' );
        var slidespeed = $( this ).data( 'slidespeed' );
        var asnav = $( this ).data( 'asnav' );
        var focusselect = $( this ).data( 'focusselect' );
        var vertical = $( this ).data( 'vertical' );
		var mobileslide = 1;

		if($(this).hasClass('products')){
        var mobileslide = $( this ).data( 'mobile' );
		}

		if($(this).hasClass('categories')){
        var mobileslide = $( this ).data( 'mobile' );
		}

        self.not('.slick-initialized').slick({
		  rtl: true,
          autoplay: autoplay,
          autoplaySpeed: autospeed,
          arrows: arrows,
          dots: dots,
          slidesToShow: slideshow,
          slidesToScroll: slidescroll,
          speed: slidespeed,
          asNavFor: asnav,
          focusOnSelect: focusselect,
          centerPadding: false,
          cssEase: 'cubic-bezier(.48,0,.12,1)',
          vertical: vertical,
          /* prevArrow: prevButton,
          nextArrow: nextButton, */
          responsive: [
            {
              breakpoint: 1400,
              settings: {
                slidesToShow: slideshow < 6 ? slideshow: 5
              }
            },
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: slideshow < 5 ? slideshow: 4
              }
            },
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: slideshow < 4 ? slideshow: 3
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: slideshow < 3 ? slideshow: 2
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: slideshow < 2 ? slideshow: mobileslide
              }
            },
          ],
        });
      });
	}
	
	/* COUNTDOWN*/
	function klb_countdown($scope, $) {
      var container = $( '.countdown' );

      container.each( function() {
        var countDate = $(this).data('date');
        var countDownDate = new Date( countDate ).getTime();
        var expired = $(this).data('expiredText');

        var d = $(this).find( '.days' );
        var h = $(this).find( '.hours' );
        var m = $(this).find( '.minutes' );
        var s = $(this).find( '.second' );

        var x = setInterval(function() {

          var now = new Date().getTime();

          var distance = countDownDate - now;

          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          d.html( ( '0' + days ).slice(-2) );
          h.html( ( '0' + hours ).slice(-2) );
          m.html( ( '0' + minutes ).slice(-2) );
          s.html( ( '0' + seconds ).slice(-2) );

          /* if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
          } */
        }, 1000);
      });
	}

    jQuery(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/bacola-home-slider.default', klb_carousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bacola-product-carousel.default', klb_carousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bacola-deal-carousel.default', klb_countdown);
        elementorFrontend.hooks.addAction('frontend/element_ready/bacola-special-products.default', klb_countdown);
        elementorFrontend.hooks.addAction('frontend/element_ready/bacola-product-categories.default', klb_carousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bacola-counter-product.default', klb_countdown);

    });

})(jQuery);
