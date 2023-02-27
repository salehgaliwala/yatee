(function ($) {
  "use strict";
  
	var win = $( window );
	var body = $( 'body' );
	var popup = $( '.site-newsletter' ),
	popupClose = $( '.site-newsletter .newsletter-close, .site-newsletter .button-close' ),
	popupExpires = popup.data( 'expires' ),
	popupOverlay = $( '.newsletter-popup-overlay' );

	if (!( Cookies.get( 'newsletter-popup-visible' ) ) ) {
		win.on( 'load', function() {
			body.addClass( 'popup-visible' );
		});
	}

	$(".site-newsletter .dontshow").click(function() {
		if ($(this).is(":checked")) {
			Cookies.set( 'newsletter-popup-visible', 'disable', { expires: popupExpires, path: '/' });
		} else {
			Cookies.remove('newsletter-popup-visible')
		}
	});

	popupClose.on('click', function(){
		body.removeClass( 'popup-visible' );
		return false;
	});
	
	popupOverlay.on('click', function(){
		body.removeClass( 'popup-visible' );
		return false;
	});

}(jQuery));
