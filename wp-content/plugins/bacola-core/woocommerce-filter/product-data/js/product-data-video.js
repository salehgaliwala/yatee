(function ($) {
  "use strict";

	$(document).ready(function() {
		
		if ($(".flex-viewport")[0]){
			$(".klb-single-video").appendTo(".flex-viewport");
		} else {
			$(".klb-single-video").appendTo(".woocommerce-product-gallery");
		}
		
		$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,

			fixedContentPos: false
		});
		
	});
	
}(jQuery));