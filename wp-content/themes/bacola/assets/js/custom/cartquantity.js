(function ($) {
  "use strict";

	$(document).on('bacolaShopPageInit', function () {
		bacolaThemeModule.addtocartquantity();
	});

	bacolaThemeModule.addtocartquantity = function() {
      var container = $( '.cart-with-quantity' );
      container.each( function() {
        var self = $(this);
        var button = self.find( '.ajax_add_to_cart' );
        var quantity = self.find( '.ajax-quantity' );

        button.on( 'click', function(e) {
		  button.closest('.cart-with-quantity').find('.quantity-button.plus').append('<svg class="loader-image preloader added" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>');
          e.preventDefault();
          $(this).hide();
          addQty();
        });

		$( document.body ).on( 'added_to_cart', function() {
			$('svg.preloader.added').remove();
		});

        function addQty() {
          quantity.css( 'display', 'flex' );

        }

        function showButton() {
          button.css( 'display', 'flex' );
          quantity.hide();
          quantity.find( '.input-text.qty' ).val(0);
		  
        }
		
          var sbuttons = quantity.find( '.quantity-button' );
          sbuttons.each( function() {
            $(this).on( 'click', function(event) {
              var qty_input = quantity.find( '.input-text.qty' );
              if ( $(qty_input).prop('disabled') ) return;
              var qty_step = parseFloat($(qty_input).attr('step'));
              var qty_min = parseFloat($(qty_input).attr('min'));
              var qty_max = parseFloat($(qty_input).attr('max'));


              if ( $(this).hasClass('minus') ){
                var vl = parseFloat($(qty_input).val());
                vl = ( (vl - qty_step) < qty_min ) ? qty_min : (vl - qty_step);
                $(qty_input).val(vl);
				
				$(this).closest('.product-button-group').find('a.button').attr('data-quantity', vl);
				
              } else if ( $(this).hasClass('plus') ) {
                var vl = parseFloat($(qty_input).val());
                vl = ( (vl + qty_step) > qty_max ) ? qty_max : (vl + qty_step);
                $(qty_input).val(vl);
				$(this).closest('.product-button-group').find('a.button').attr('data-quantity', vl);
				
              }

              if ( qty_input.val() === '0' ) {
                showButton();
				$(this).closest('.product-button-group').find('a.button').attr('data-quantity', '1');
              }

              qty_input.trigger( 'change' );
            });
          });
		  
		  
      });
	}
	
	$(document).ready(function() {
		bacolaThemeModule.addtocartquantity();
	});

})(jQuery);
