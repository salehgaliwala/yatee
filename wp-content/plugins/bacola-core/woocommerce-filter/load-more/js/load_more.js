jQuery(document).ready(function($) {
	"use strict";
	
	$(document).on('click', '.klb-load-more', function(event){
		event.preventDefault(); 
        var data = {
			cache: false,
            action: 'load_more',
			beforeSend: function() {
				$('.products').append('<svg class="loader-image preloader" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg></div>');
			},
			'current_page': loadmore.current_page,
			'per_page': loadmore.per_page,
			'cat_id': loadmore.cat_id,
			'filter_cat': loadmore.filter_cat,
			'layered_nav': loadmore.layered_nav,
			'on_sale': loadmore.on_sale,
			'orderby': loadmore.orderby,
			'shop_view': loadmore.shop_view,
			'min_price': loadmore.min_price,
			'max_price': loadmore.max_price,
			'is_search': loadmore.is_search,
			's': loadmore.s,
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(loadmore.ajaxurl, data, function(response) {
            $('.site-primary .products').append(response);

			if ( loadmore.current_page == loadmore.max_page ){
				$('.site-content .content-primary .products').after('<div class="no-more-products"><div class="button">' + loadmore.no_more_products + '</div></div>');
				$('.klb-load-more').remove();
				$(".loader-image").remove();
				return false;
			}
			
			loadmore.current_page++;
			
			if ( loadmore.current_page == loadmore.max_page ){
				$('.klb-load-more').remove();
				$('.site-content .content-primary .products').after('<div class="no-more-products"><div class="button">' + loadmore.no_more_products + '</div></div>');
			}


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

		      var container = $( '.cart-with-quantity' );
		      container.each( function() {
		        var self = $(this);
		        var button = self.find( '.ajax_add_to_cart' );
		        var quantity = self.find( '.ajax-quantity' );
		
		        button.on( 'click', function(e) {
		          e.preventDefault();
		          $(this).hide();
		          addQty();
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
		              var qty_step = 1;
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

			
			$(".loader-image").remove();
        });
    });	

});