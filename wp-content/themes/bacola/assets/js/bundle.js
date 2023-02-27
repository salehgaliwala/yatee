(function ($) {
  "use strict";

  var doc = $( document );
  var win = $( window );

  var BACOLA_APP = {
    init: function() {
      this.dom();
      this.dropdownParent();
      this.allCategories();
      this.minicartmobile();
      this.mainMenu();
      this.mobileMenu();
      this.mobileSearch();
      this.productQty();
      this.checkboxList();
      this.myAccountMenu();

      $('[data-toggle="tooltip"]').tooltip();
    },
    dom: function() {
      var body = $( 'body' );
      var html = $( 'html' );
    },
    dropdownParent: function() {
      var content = $( '.dropdown-parent' );
      var categories = $( '.dropdown-categories' );

      var h = categories.outerHeight();
      if ( content.length ) {
        content.css( 'height', h );
      }
    },
    allCategories: function() {
      var content = $( '.header-nav .all-categories' );
      var button = content.find( '> a' );
      var subMenu = content.find( '.dropdown-categories' );

      button.on( 'click', function(e) {
        e.preventDefault();
        if ( $(this).parent().hasClass( 'click' ) ) {
          subMenu.toggleClass( 'active' );
        }
      });
    },
    minicartmobile: function() {
	  if($(window).width() < 601){
		  var button = $( '.site-header .header-buttons .header-cart > a' );

		  button.on( 'click', function(e) {
			e.preventDefault();
			if($( '.site-header .header-cart .cart-dropdown' ).hasClass('hide')){
				$( '.site-header .header-cart .cart-dropdown' ).removeClass( 'hide' );
			} else {
				$( '.site-header .header-cart .cart-dropdown' ).addClass( 'hide' );
			}
		  });
	  }
    },

    mainMenu: function() {
      var subMenuItem = $( '.primary-menu .sub-menu .menu-item' ).find( '> a' );
      var textWrapper = $( '<span class="text"></span>' );
      subMenuItem.wrapInner( textWrapper );

      const spacing = () => {
        var containerWidth = $( '.header-wrapper > .container' ).width();
        var windowWidth = $(window).width();

        var spacing = windowWidth - containerWidth;
        var megaSubmenu = $( '.primary-menu .mega-menu > .sub-menu' );
        megaSubmenu.css( 'padding-left', spacing / 2 );
        megaSubmenu.css( 'padding-right', spacing / 2 );
      }
	  
	  spacing();
	  
      $( window ).on( 'load', () => {
        spacing();
      });

      $( window ).on( 'resize', () => {
        spacing();
      });

      var megaMenu = $( '.primary-menu .mega-menu' );
      var siteMask = $( '.site-overlay' );

      megaMenu.on( 'hover', () => {
        siteMask.toggleClass( 'active-for-mega' );
      });
    },
    mobileMenu: function() {
      var canvasMenu = $( '.site-canvas' );
      var siteOverlay = $( '.site-overlay' );
      var canvasButton = $( '.header-canvas > a' );
      var canvasClose = $( '.site-canvas .close-canvas' );
	  var categoryButton = $( '.header-mobile-nav a.categories' );

      var tl = gsap.timeline( { paused: true, reversed: true } );
      tl.set( canvasMenu, {
        autoAlpha: 1
      }).to( canvasMenu, .5, {
        x:0,
				ease: 'power4.inOut'
      }).to( siteOverlay, .5, {
        autoAlpha: 1,
        ease: 'power4.inOut'
      }, "-=.5");


      categoryButton.on( 'click', function(e) {
		e.preventDefault();
        siteOverlay.addClass( 'active' );
		tl.play();
		$('.site-canvas .dropdown-categories').addClass('show');
	  });

      canvasButton.on( 'click', function(e) {
		e.preventDefault();
        siteOverlay.addClass( 'active' );
		tl.play();
		$('.site-canvas .dropdown-categories').removeClass('show');
	  });

      canvasClose.on( 'click', function(e) {
	    e.preventDefault();
		tl.reverse();
        setTimeout( function() { 
          siteOverlay.removeClass( 'active' );
        }, 1000);
	  });

	  siteOverlay.on( 'click', function(e) {
		e.preventDefault();
		tl.reverse();
		setTimeout( function() { 
		  siteOverlay.removeClass( 'active' );
		}, 1000);
	  });

	  var menuChildren = $( '.canvas-menu .menu-item-has-children, .site-canvas .dropdown-categories .menu-item-has-children' );
      menuChildren.append( '<span class="menu-dropdown"><i class="klbth-icon-down-open-big"></i></span>' );

	  $( '.canvas-menu .menu-item-has-children .menu-dropdown, .site-canvas .dropdown-categories .menu-item-has-children .menu-dropdown' ).on( 'click', function(e) {
        e.preventDefault();

        var link = $(this);
        var closestUL = link.closest( 'ul' );
        var activeItem = closestUL.find( '.active' );
        var closestLI = link.closest( 'li' );
        var linkClass = closestLI.hasClass( 'active' );
        var count = 0;

        const resetAnimation = () => {
          activeItem.removeClass( 'active' );
        }

        gsap.to( closestUL.find( 'ul' ), .5, { height: 0, ease: 'power4.inOut', onComplete: resetAnimation() });

        if ( !linkClass ) {
          gsap.to( closestLI.children( 'ul' ), .5, { height: 'auto', ease: 'power4.inOut' } );
          closestLI.addClass( 'active' );
        }
      });

    },
    mobileSearch: function() {
      var searchButton = $( '.header-mobile-nav .menu-item .search' );
      var searchHolder = $( '.header-search' );

      if ( searchButton.length ) {
        searchButton.on( 'click', function(e) {
          e.preventDefault();
          $(this).toggleClass( 'active' );
          searchHolder.toggleClass( 'active' );
        });
      }
    },

    productQty: function() {
      function qty() {
        var container = $( '.quantity:not(.ajax-quantity)' );
        container.each( function() {
          var self = $( this );
          var buttons = $( this ).find( '.quantity-button' );
		  
		  $("form.cart.grouped_form .input-text.qty").attr("value", "0");

          buttons.each( function() {
            $(this).on( 'click', function(event) {
              var qty_input = self.find( '.input-text.qty' );
              if ( $(qty_input).prop('disabled') ) return;
              var qty_step = parseFloat($(qty_input).attr('step'));
              var qty_min = parseFloat($(qty_input).attr('min'));
              var qty_max = parseFloat($(qty_input).attr('max'));


              if ( $(this).hasClass('minus') ){
                var vl = parseFloat($(qty_input).val());
                vl = ( (vl - qty_step) < qty_min ) ? qty_min : (vl - qty_step);
                $(qty_input).val(vl);
              } else if ( $(this).hasClass('plus') ) {
                var vl = parseFloat($(qty_input).val());
                vl = ( (vl + qty_step) > qty_max ) ? qty_max : (vl + qty_step);
                $(qty_input).val(vl);
              }

              qty_input.trigger( 'change' );
            });
          });
        });
      }

      qty();
      $('body').on( 'updated_cart_totals', qty );
    },
    checkboxList: function() {
      var container = $( '.site-checkbox-lists.hidden-sub' );
      var menu = $( '.site-checkbox-lists > .site-scroll > ul' );
      var menuChildren = container.find( '.cat-parent' );
      menuChildren.append( '<span class="menu-dropdown"><i class="klbth-icon-plus"></i></span>' );

      var menuHeight = menu.height();

      if ( menuHeight > 300 ) {
        menu.addClass( 'scroll-active' )
      }

      container.each( function() {
        $(this).find( '.menu-dropdown' ).on( 'click', function(e) {
          e.preventDefault();
  
          var link = $(this);
          var closestUL = link.closest( 'ul' );
          var activeItem = closestUL.find( '.active' );
          var closestLI = link.closest( 'li' );
          var linkClass = closestLI.hasClass( 'active' );
          var count = 0;
  
          const resetAnimation = () => {
            activeItem.removeClass( 'active' );
          }
  
          gsap.to( closestUL.find( 'ul' ), .5, { height: 0, ease: 'power4.inOut', onComplete: resetAnimation() });
  
          if ( !linkClass ) {
            gsap.to( closestLI.children( 'ul' ), .5, { height: 'auto', ease: 'power4.inOut' } );
            closestLI.addClass( 'active' );
          }
        });
      });
    },

    myAccountMenu: function() {
      var container = $( '.my-account-navigation' );

      if ( container.length ) {
        var button = $( '.account-toggle-menu' );

        button.on( 'click', function() {
          container.toggleClass(  'dropdown');
        });
      }
    },


  }

  doc.ready( () => {
    BACOLA_APP.init();
  });
  
	$(document).ready(function() {
		$(".flex-control-thumbs").addClass("product-thumbnails");
		
		if ($(".woocommerce-product-gallery").hasClass("vertical") && $(window).width() > 992) {
			var verti = true;
		} else {
			var verti = false;
		}

		$('.product-thumbnails').slick({
		  dots: false,
		  arrows: true,
		  prevArrow: '<div class="prev"><i class="far fa-angle-left"></i></div>',
		  nextArrow: '<div class="next"><i class="far fa-angle-right"></i></div>',
		  autoplay: false,
		  Speed: 2000,
		  slidesToShow: 6,
		  slidesToScroll: 1,
		  focusOnSelect: true,
		  vertical: verti,
		});

		$(".flex-viewport, .flex-control-nav" ).wrapAll( "<div class='slider-wrapper'></div>" );
		
		if ( $('.product-brand > *').length < 1 ) {
			$('.product-brand').remove();
		}

		$(".products > li.product-category" ).wrapAll( "<div class='"+ $('.content-primary > .products').attr('class')  +" klb-category-wrapper'></div>" );
		$(".klb-category-wrapper").insertBefore(".content-primary > .products");
		
	});

	$(window).load(function(){
		$('.site-loading').fadeOut('slow',function(){$(this).remove();});
	});

    $(window).scroll(function() {
        $(this).scrollTop() > 135 ? $("header.site-header").addClass("sticky-header") : $("header.site-header").removeClass("sticky-header")
    });

}(jQuery));