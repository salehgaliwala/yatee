(function ($) {
  "use strict";

	$(document).ready(function () {
 
      var locationButton = $( '.site-location > a' );
      var locationSelected = $('.site-location a .current-location');
      var locationClose = $( '.close-popup' );
      var locationHolder = $( '.select-location' );
      var locationOverlay = $( '.location-overlay' );

      locationButton.each(function() {
        $(this).on( 'click', function(e) {
          e.preventDefault();
          locationHolder.addClass( 'active' );
      	  locations.select2("open");
        });
      });

      locationClose.on( 'click', function(e) {
        e.preventDefault();
        locationHolder.removeClass( 'active' );
      });
	  
      locationOverlay.on( 'click', function(e) {
        e.preventDefault();
        locationHolder.removeClass( 'active' );
      });

      function minPrice(min) {
        if (!min.id) {
          return min.text;
        }

        var $min;

        if ( min.element.dataset.min ) {
          $min = $( '<span>' + min.text + '</span><span class="min-price">' + min.element.dataset.min + '</span>' );
        } else {
          $min = min.text;
        }

        return $min;
      }
      var locations = $('.site-area').select2({
        allowClear: true,
        placeholder: 'Select an option',
        templateResult: minPrice,
        dropdownCssClass: 'site-location-select',
        dropdownParent: $('.select-location .search-location'),
        closeOnSelect: false,
      }).on("select2:closing", function(e) {
        e.preventDefault();
      }).on("select2:closed", function(e) {
        list.select2("open");
      });
      var placeholder = locations.data( 'placeholder' );
      locations.on( 'select2:open', function(e) {
        $('.select2-search__field').attr('placeholder', placeholder);
        $('.select2-search').append('<svg data-testid="MagnifyGlass" viewBox="0 0 16 16" class="css-ekjjru"><path d="M14.23437,15.10449l-3.2539-3.25488a6.13908,6.13908,0,1,1,1.63574-1.85352c-.05859.10156-.11816.19922-.17969.29492l-.63086-.40625c.05567-.08593.10938-.17383.16016-.26269a5.406,5.406,0,1,0-1.19922,1.43945.37776.37776,0,0,1,.50781.02051l3.49121,3.49121Z" fill="currentColor"></path></svg>');
      });
      
      locations.on( 'select2:select', function(e) {
		$.cookie("location", $(this).val());
		location.reload(true); 
        locationHolder.removeClass( 'active' );
        /* console.log("select", e.params.data.text); */
      });
	  

      /* locations.on( 'change', function(e) {
        console.log("change", e);
      }); */
 

	  /* popup location */
	  if ( !( Cookies.get( 'location' ) ) && locationfilter.popup == 1) {
		$( ".site-location > a" ).trigger( "click" );
	  }
	
	});

})(jQuery);
