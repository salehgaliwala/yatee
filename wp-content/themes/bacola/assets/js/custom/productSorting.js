(function ($) {
  "use strict";

	$(document).on('bacolaShopPageInit', function () {
		bacolaThemeModule.productsorting();
	});

	bacolaThemeModule.productsorting = function() {
      var container = $( '.filterSelect' );
      container.each(function() {
        var filterClass = $(this).data('class');
        var filterSelect = $(this).select2({
          minimumResultsForSearch: Infinity,
          dropdownAutoWidth: true,
          dropdownCssClass: filterClass,
        });
      });
	}
	
	$(document).ready(function() {
		bacolaThemeModule.productsorting();
	});

})(jQuery);
