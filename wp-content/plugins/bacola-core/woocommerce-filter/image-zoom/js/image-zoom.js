(function ($) {
  "use strict";

	$(document).ready(function() {
		
		if ($(".flex-viewport")[0]){
			$("a.woocommerce-product-gallery__trigger").appendTo(".flex-viewport");
		} else {
			$("a.woocommerce-product-gallery__trigger").appendTo(".woocommerce-product-gallery");
		}
		
		$('.woocommerce-product-gallery__image').zoom();
		
	});
	
}(jQuery));