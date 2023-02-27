(function ($) {
  "use strict";
	
	$(document).ready(function() {
      var cartSide = $( '.cart-widget-side' );
      var button = $( '.header-cart' );
      var siteOverlay = $( '.site-overlay' );
      var close = $( '.cart-side-close' );

      var tl = gsap.timeline( { paused: true, reversed: true } );
      tl.set( cartSide, {
        autoAlpha: 1
      }).to( cartSide, .5, {
        x:0,
				ease: 'power4.inOut'
      }).to( siteOverlay, .5, {
        autoAlpha: 1,
        ease: 'power4.inOut'
      }, "-=.5");

		button.on( 'click', function(e) {
			e.preventDefault();
			siteOverlay.addClass( 'active' );
			siteOverlay.css({"z-index": "1003"});
			tl.reversed() ? tl.play() : tl.reverse();
		});

		close.on( 'click', function(e) {
			e.preventDefault();
			tl.reverse();
			setTimeout( function() { 
				siteOverlay.hide();
			}, 1000);
		});
			
		siteOverlay.on( 'click', function(e) {
			e.preventDefault();
			tl.reverse();
			setTimeout( function() {
				siteOverlay.removeClass( 'active' );
			}, 1000);
		});
		
     
	  
	  $('.cart-dropdown').remove();
	  
	});

})(jQuery);
