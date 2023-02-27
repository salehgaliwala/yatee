(function ($) {
  "use strict";

	$(document).on('bacolaShopPageInit', function () {
		bacolaThemeModule.sitescroll();
	});

	bacolaThemeModule.sitescroll = function() {
      var siteScroll = $( '.site-scroll' );
      siteScroll.each( function() {
        const ps = new PerfectScrollbar( $( this )[0], {
          suppressScrollX: true,
        });
      });
	}
	
	$(document).ready(function() {
		bacolaThemeModule.sitescroll();
	});

})(jQuery);
