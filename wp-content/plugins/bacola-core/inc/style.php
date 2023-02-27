<?php 
/*************************************************
## Bacola Typography
*************************************************/

function bacola_custom_styling() { ?>

<style type="text/css">
<?php if (get_theme_mod( 'bacola_shop_breadcrumb_bg' )) { ?>
.klb-shop-breadcrumb.with-background .container{
	background-image: url(<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'bacola_shop_breadcrumb_bg' )) ); ?>);
}
<?php } ?>

<?php if (get_theme_mod( 'bacola_shop_breadcrumb_bg_color' )) { ?>
.klb-shop-breadcrumb .container{
	background-color: <?php echo esc_attr(get_theme_mod( 'bacola_shop_breadcrumb_bg_color' ) ); ?>;
}
<?php } ?>


<?php if (get_theme_mod( 'bacola_mobile_sticky_header',0 ) == 1) { ?>
@media(max-width:64rem){
	header.sticky-header {
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
	}	
}
<?php } ?>

<?php if (get_theme_mod( 'bacola_middle_sticky_header',0 ) == 1) { ?>
.sticky-header .header-main {
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    z-index: 9;
    border-bottom: 1px solid #e3e4e6;
    padding-top: 15px;
    padding-bottom: 15px;
}
<?php } ?>

<?php if (get_theme_mod( 'bacola_mobile_single_sticky_cart',0 ) == 1) { ?>
@media(max-width:64rem){
	.single .single-content .product-type-simple form.cart {
	    position: fixed;
	    bottom: 0;
	    right: 0;
	    z-index: 9999;
	    background: #fff;
	    margin-bottom: 0;
	    padding: 15px;
	    -webkit-box-shadow: 0 -2px 5px rgb(0 0 0 / 7%);
	    box-shadow: 0 -2px 5px rgb(0 0 0 / 7%);
	    justify-content: space-between;
	}

	.single .woocommerce-variation-add-to-cart {
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	    position: fixed;
	    bottom: 0;
	    right: 0;
	    z-index: 9999;
	    background: #fff;
	    margin-bottom: 0;
	    padding: 15px;
	    -webkit-box-shadow: 0 -2px 5px rgb(0 0 0 / 7%);
	    box-shadow: 0 -2px 5px rgb(0 0 0 / 7%);
	    justify-content: space-between;
    	width: 100%;
		flex-wrap: wrap;
	}
}
<?php } ?>


<?php if (get_theme_mod( 'bacola_main_color' )) { ?>
:root {
    --color-primary: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?>;
}
<?php } ?>

<?php if (get_theme_mod( 'bacola_second_color' )) { ?>
:root {
    --color-secondary: <?php echo esc_attr(get_theme_mod( 'bacola_second_color' ) ); ?>;
}
<?php } ?>

<?php if (get_theme_mod( 'bacola_price_font_color' )) { ?>
:root {
	--color-price: <?php echo esc_attr(get_theme_mod( 'bacola_price_font_color' ) ); ?>;
}
<?php } ?>

<?php if (get_theme_mod( 'bacola_color_danger' )) { ?>
:root {
	--color-danger: <?php echo esc_attr(get_theme_mod( 'bacola_color_danger' ) ); ?>;
}
<?php } ?>

<?php if (get_theme_mod( 'bacola_color_danger_dark' )) { ?>
:root {
	--color-danger-dark: <?php echo esc_attr(get_theme_mod( 'bacola_color_danger_dark' ) ); ?>;
}
<?php } ?>

<?php if (get_theme_mod( 'bacola_color_success' )) { ?>
:root {
	--color-success: <?php echo esc_attr(get_theme_mod( 'bacola_color_success' ) ); ?>;
}
<?php } ?>

<?php if (get_theme_mod( 'bacola_color_rating' )) { ?>
:root {
	--color-rating: <?php echo esc_attr(get_theme_mod( 'bacola_color_rating' ) ); ?>;
}
<?php } ?>


.site-header .header-top  {
	background-color: <?php echo esc_attr(get_theme_mod( 'bacola_top_bg_color' ) ); ?>;
	color:<?php echo esc_attr(get_theme_mod( 'bacola_top_color' ) ); ?>;
}

.header-main.header-wrapper , .site-header .header-nav {
	background-color: <?php echo esc_attr(get_theme_mod( 'bacola_bg_color' ) ); ?>;
}

.site-header .header-top .site-menu .menu .menu-item:hover > a {
	color:<?php echo esc_attr(get_theme_mod( 'bacola_top_hvrcolor' ) ); ?>;
}

.site-location a  {
	background-color: <?php echo esc_attr(get_theme_mod( 'bacola_lct_bg_color' ) ); ?>;
	color:<?php echo esc_attr(get_theme_mod( 'bacola_lct_color' ) ); ?>;
	border-color:<?php echo esc_attr(get_theme_mod( 'bacola_lct_brdr_color' ) ); ?>;
}

.site-location a:hover  {
	background-color: <?php echo esc_attr(get_theme_mod( 'bacola_lct_bg_hvrcolor' ) ); ?>;
	color:<?php echo esc_attr(get_theme_mod( 'bacola_lct_hvrcolor' ) ); ?>;
	border-color:<?php echo esc_attr(get_theme_mod( 'bacola_lct_brdr_hvrcolor' ) ); ?>;
}

.site-location a .current-location{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_lct_scnd_color' ) ); ?>;
}

.site-location a .current-location:hover{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_lct_scnd_hvrcolor' ) ); ?>;
}

.site-location a:after{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_lct_arrow_color' ) ); ?>;
}

.site-header .header-main .header-search .dgwt-wcas-search-form input[type="search"]  {
	background-color: <?php echo esc_attr(get_theme_mod( 'bacola_search_bg_color' ) ); ?>;
	color:<?php echo esc_attr(get_theme_mod( 'bacola_search_color' ) ); ?>;
	border-color:<?php echo esc_attr(get_theme_mod( 'bacola_search_brdrcolor' ) ); ?>;
}

.dgwt-wcas-sf-wrapp:after{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_search_icon_color' ) ); ?>;
}

.site-header .header-buttons .header-login.bordered .button-icon{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_login_btn_bg_color' ) ); ?>;
	border-color:<?php echo esc_attr(get_theme_mod( 'bacola_login_btn_brdrcolor' ) ); ?>;
	
}

.site-header .header-buttons .header-login.bordered .button-icon i{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_login_btn_color' ) ); ?>;
}

.header-cart .cart-price bdi{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_price_color' ) ); ?>;
}

@media screen and (min-width: 48rem){
	.site-header .header-buttons .bordered.header-cart .button-icon{
		background-color:<?php echo esc_attr(get_theme_mod( 'bacola_crt_bg_color' ) ); ?>;
		border-color:<?php echo esc_attr(get_theme_mod( 'bacola_crt_brdrcolor' ) ); ?>;	
	}
}

@media screen and (min-width: 48rem){
	.site-header .header-buttons .bordered.header-cart .button-icon i{
		color:<?php echo esc_attr(get_theme_mod( 'bacola_crt_color' ) ); ?>;
	}
}

.site-header .header-buttons .cart-count-icon{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_crt_count_bg_color' ) ); ?>;
	color:<?php echo esc_attr(get_theme_mod( 'bacola_crt_count_color' ) ); ?>;	
}

.menu-list li.link-parent > a{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_sidebar_color' ) ); ?>;	
}

.menu-list li.link-parent > a:hover{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_sidebar_hvrcolor' ) ); ?>;	
}

.site-header .all-categories .dropdown-categories{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_sidebar_bg' ) ); ?>;
	border-color:<?php echo esc_attr(get_theme_mod( 'bacola_sidebar_brdrcolor' ) ); ?>;	
}

.site-header .all-categories > a{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_sidebar_title_bg' ) ); ?>;
	color:<?php echo esc_attr(get_theme_mod( 'bacola_sidebar_title_color' ) ); ?>;
}

.site-header .all-categories > a i , .site-header .all-categories > a:after{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_title_arrow_color' ) ); ?>;	
}

.site-header .all-categories > a .description{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_title_second_bg' ) ); ?>;
	border-color:<?php echo esc_attr(get_theme_mod( 'bacola_title_second_brdrcolor' ) ); ?>;	
	color:<?php echo esc_attr(get_theme_mod( 'bacola_title_second_color' ) ); ?>;
}

.site-header .primary-menu .menu > .menu-item > a , .site-header .primary-menu .menu .sub-menu .menu-item > a{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_color' ) ); ?>;
}

.site-header .primary-menu .menu > .menu-item > a:hover , .site-header .primary-menu .menu .sub-menu .menu-item:hover > a , .site-header .primary-menu .menu > .menu-item:hover > a{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_hvr_color' ) ); ?>;
}

.site-footer .footer-iconboxes{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_featured_bg_color' ) ); ?>;
}

.site-footer .footer-iconboxes .iconbox{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_featured_color' ) ); ?>;	
}

.site-footer .footer-iconboxes .iconbox:hover{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_featured_hvrcolor' ) ); ?>;	
}

.site-footer .footer-widgets{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_bg_color' ) ); ?>;
}

.klbfooterwidget ul a{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_color' ) ); ?>
}

.klbfooterwidget ul a:hover{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_hvrcolor' ) ); ?>
}

.klbfooterwidget h4.widget-title{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_header_color' ) ); ?>
}

.klbfooterwidget h4.widget-title:hover{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_header_hvrcolor' ) ); ?>
}

.site-footer .footer-contacts .site-phone .phone-icon{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_phone_icon_bg' ) ); ?>;
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_phone_icon_color' ) ); ?>
}

.site-footer .footer-contacts .site-phone .entry-title , .site-footer .footer-contacts .site-mobile-app .app-content .entry-title{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_contact_phone_color' ) ); ?>
}

.site-footer .footer-contacts .site-phone .entry-title:hover , .site-footer .footer-contacts .site-mobile-app .app-content .entry-title:hover{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_contact_phone_hvrcolor' ) ); ?>
}

.site-footer .footer-contacts .site-phone span , .site-footer .footer-contacts .site-mobile-app .app-content span{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_contact_color' ) ); ?>
}

.site-footer .footer-contacts .site-phone span:hover , .site-footer .footer-contacts .site-mobile-app .app-content span:hover{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_contact_hvrcolor' ) ); ?>
}

.site-social ul a{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_social_icon_bg' ) ); ?>;
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_social_icon_color' ) ); ?>
}

.site-footer .footer-contacts{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_contact_background' ) ); ?>;
}

.site-footer .footer-bottom{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_general_background' ) ); ?>;
}

.site-copyright , .site-footer .footer-bottom .footer-menu li a{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_general_color' ) ); ?>
}

.site-copyright:hover , .site-footer .footer-bottom .footer-menu li a:hover{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_footer_general_hvrcolor' ) ); ?>
}

.site-footer .footer-subscribe{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_subscribe_bg' ) ); ?>;
	color:<?php echo esc_attr(get_theme_mod( 'bacola_subscribe_color' ) ); ?>
}

.site-footer .footer-subscribe .entry-subtitle:hover , .site-footer .footer-subscribe .entry-title:hover , .site-footer .footer-subscribe .entry-teaser p:hover, .site-footer .footer-subscribe .form-wrapper:hover{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_subscribe_hvrcolor' ) ); ?>
}


.site-header .header-mobile-nav .menu-item a span{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_mobile_menu_color' ) ); ?>
}

.site-header .header-mobile-nav .menu-item a span:hover{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_mobile_menu_hvr_color' ) ); ?>
}

.site-header .header-mobile-nav .menu-item a i{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_mobile_menu_icon_color' ) ); ?>
}

.site-header .header-mobile-nav .menu-item a i:hover{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_mobile_menu_icon_hvrcolor' ) ); ?>
}

.site-header .header-mobile-nav{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_mobile_menu_bg_color' ) ); ?>;
}

.site-header .primary-menu .menu > .menu-item.current-menu-item > a{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_hvr_color' ) ); ?>;
}		

.site-header .primary-menu .menu > .menu-item.current-menu-item > a,
.site-header .primary-menu .menu > .menu-item:hover > a{
	background-color:<?php echo esc_attr(get_theme_mod( 'bacola_header_font_background_hover_color' ) ); ?>;
}

.site-canvas .canvas-menu .menu .menu-item a{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_mobile_sidebar_menu_color' ) ); ?>;
}

.site-canvas .canvas-menu .menu .menu-item.active > a{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_mobile_sidebar_menu_hvrcolor' ) ); ?>;
}

.site-canvas .canvas-menu .menu .menu-item + .menu-item,
.site-canvas .canvas-menu{
	border-color:<?php echo esc_attr(get_theme_mod( 'bacola_mobile_sidebar_menu_brdrcolor' ) ); ?>;
}

.site-canvas .canvas-footer .site-copyright{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_mobile_sidebar_menu_copyright_color' ) ); ?>;
}

.site-canvas .canvas-title .entry-title{
	color:<?php echo esc_attr(get_theme_mod( 'bacola_mobile_sidebar_menu_header_color' ) ); ?>;
}
<?php if(function_exists('dokan')){ ?>

	input[type='submit'].dokan-btn-theme,
	a.dokan-btn-theme,
	.dokan-btn-theme {
		background-color: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?>;
		border-color: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?>;
	}
	input[type='submit'].dokan-btn-theme .badge,
	a.dokan-btn-theme .badge,
	.dokan-btn-theme .badge {
		color: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?>;
	}
	.dokan-announcement-uread {
		border: 1px solid <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?> !important;
	}
	.dokan-announcement-uread .dokan-annnouncement-date {
		background-color: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?> !important;
	}
	.dokan-announcement-bg-uread {
		background-color: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?>;
	}
	.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover {
		background: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?>;
	}
	.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover {
		background: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?>;
	}
	.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active {
		background: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?>;
	}
	.dokan-product-listing .dokan-product-listing-area table.product-listing-table td.post-status label.pending {
		background: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?>;
	}
	.product-edit-container .dokan-product-title-alert,
	.product-edit-container .dokan-product-cat-alert {
		color: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?>;
	}
	.product-edit-container .dokan-product-less-price-alert {
		color: <?php echo esc_attr(get_theme_mod( 'bacola_main_color' ) ); ?>;
	}
	.dokan-store-wrap {
	    margin-top: 3.5rem;
	}
	.dokan-widget-area ul {
	    list-style: none;
	    padding-left: 0;
	    font-size: .875rem;
	    font-weight: 400;
	}
	.dokan-widget-area ul li a {
	    text-decoration: none;
	    color: var(--color-text-lighter);
	    margin-bottom: .625rem;
	    display: inline-block;
	}
	form.dokan-store-products-ordeby:before, 
	form.dokan-store-products-ordeby:after {
		content: '';
		display: table;
		clear: both;
	}
	.dokan-store-products-filter-area .orderby-search {
	    width: auto;
	}
	input.search-store-products.dokan-btn-theme {
	    border-top-left-radius: 0;
	    border-bottom-left-radius: 0;
	}
	.dokan-pagination-container .dokan-pagination li a {
	    display: -webkit-inline-box;
	    display: -ms-inline-flexbox;
	    display: inline-flex;
	    -webkit-box-align: center;
	    -ms-flex-align: center;
	    align-items: center;
	    -webkit-box-pack: center;
	    -ms-flex-pack: center;
	    justify-content: center;
	    font-size: .875rem;
	    font-weight: 600;
	    width: 2.25rem;
	    height: 2.25rem;
	    border-radius: 50%;
	    color: currentColor;
	    text-decoration: none;
	    border: none;
	}
	.dokan-pagination-container .dokan-pagination li.active a {
	    color: #fff;
	    background-color: var(--color-secondary) !important;
	}
	.dokan-pagination-container .dokan-pagination li:last-child a, 
	.dokan-pagination-container .dokan-pagination li:first-child a {
	    width: auto;
	}

	.vendor-customer-registration label {
	    margin-right: 10px;
	}

	.woocommerce-mini-cart dl.variation {
	    display: none;
	}

	.product-name dl.variation {
	    display: none;
	}

	.seller-rating .star-rating span.width + span {
	    display: none;
	}
	
	.seller-rating .star-rating {width: 70px;display: block;}

<?php } ?>

<?php if (function_exists('get_wcmp_vendor_settings') && is_user_logged_in()) {
	if(is_vendor_dashboard()){	
} ?>

.woosc-popup, div#woosc-area {
    display: none;
}
	
.select-location {
    display: none;
}
	
<?php } ?>


</style>
<?php }
add_action('wp_head','bacola_custom_styling');

?>