(function ($) {
  "use strict";

	$(document).on('bacolaShopPageInit', function () {
		bacolaThemeModule.productHover();
	});

	bacolaThemeModule.productHover = function() {
      var product = $( '.products .product' );

      product.each( function(e) {
        var fadeBlock = $(this).find( '.product-fade-block' );
        var contentBlock = $(this).find( '.product-content-fade' );
        var outerHeight = 0;

        if ( fadeBlock.length ) {
          fadeBlock.each( function(e) {
            var self = $(this);
            outerHeight += self.outerHeight();
    
            contentBlock.css( 'marginBottom', -outerHeight );
          });
        }
      });
	}
	
	$(document).ready(function() {
		bacolaThemeModule.productHover();
	});

})(jQuery);
