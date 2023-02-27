<?php $categorybanner = get_theme_mod('bacola_shop_banner_each_category'); ?>
<?php 
$term = get_term( get_queried_object()->term_id , 'product_cat' ); // <--- tested in my system with this ID
//var_dump($term );
?>
<?php if(!empty($term->term_id)){ ?>


<!--<div class="shop-banner">
				<div class="module-banner image align-center align-middle">
					<div class="module-body">
						<div class="banner-wrapper">
							<div class="banner-content">
								<div class="content-main">
									<h4 class="entry-subtitle color-text xlight"><?php echo esc_html($c['category_title']); ?></h4>
									<h3 class="entry-title color-text large"><?php echo bacola_sanitize_data($c['category_subtitle']); ?></h3>
									<div class="entry-text color-info-dark"><?php echo esc_html($c['category_desc']); ?></div>
								</div>
							</div>
							<div class="banner-thumbnail">
								<img src="<?php echo esc_url(bacola_get_image($c['category_image'])); ?>" alt="<?php echo esc_attr($c['category_title']); ?>">
							</div>
							<a href="<?php echo esc_url($c['category_button_url']); ?>" class="overlay-link"></a>
						</div>
					</div>
				</div>
			</div>-->
<div class="hero-cat" style="background:url('http://yatoo.fr/wp-content/uploads/2022/09/heor-accueil@2x-scaled.jpg') no-repeat top center">

    <div class="container">

        <div class="logo"><svg id="Groupe_8168" data-name="Groupe 8168" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" width="116.424" height="38.821" viewBox="0 0 116.424 38.821"
                preserveAspectRatio="xMinYMin">
                <defs>
                    <clipPath id="clip-path">
                        <path id="Tracé_72400" data-name="Tracé 72400" d="M0-112.409H116.424V-151.23H0Z"
                            transform="translate(0 151.23)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </clipPath>
                </defs>
                <g id="Groupe_3362" data-name="Groupe 3362" transform="translate(0 0)" clip-path="url(#clip-path)">
                    <g id="Groupe_3357" data-name="Groupe 3357" transform="translate(92.182 5.035)">
                        <path id="Tracé_72395" data-name="Tracé 72395"
                            d="M-70.2-34.558A12.088,12.088,0,0,0-82.319-46.493,12.088,12.088,0,0,0-94.44-34.558,12.079,12.079,0,0,0-82.319-22.67,12.079,12.079,0,0,0-70.2-34.558m-5.342-.547c-.807,1.96-6.762,6.346-6.762,6.346s-5.974-4.36-6.79-6.316a3.837,3.837,0,0,1,2.066-5.018,3.835,3.835,0,0,1,4.7,1.47,3.836,3.836,0,0,1,4.7-1.491,3.838,3.838,0,0,1,2.088,5.009"
                            transform="translate(94.44 46.493)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </g>
                    <g id="Groupe_3358" data-name="Groupe 3358" transform="translate(66.71 5.035)">
                        <path id="Tracé_72396" data-name="Tracé 72396"
                            d="M-70.2-34.558A12.088,12.088,0,0,0-82.319-46.493,12.088,12.088,0,0,0-94.44-34.558,12.079,12.079,0,0,0-82.319-22.67,12.079,12.079,0,0,0-70.2-34.558m-14.577,4.506a.584.584,0,0,1-.584.584h-2.676a.584.584,0,0,1-.584-.584V-35.98a.584.584,0,0,1,.584-.584h2.676a.584.584,0,0,1,.584.584Zm8.207-4.563a1.279,1.279,0,0,1,.177,1.921,1.182,1.182,0,0,1-.338,1.848s.977,1.7-2.235,1.786h-.121c-.2,0-.407,0-.634-.011a13.979,13.979,0,0,1-4.008-.6.869.869,0,0,1-.572-.817v-4.925a.871.871,0,0,1,.453-.763,2.217,2.217,0,0,0,.239-.153,13.664,13.664,0,0,0,1.126-1.2,4.291,4.291,0,0,0,.951-2.005c.05-.348.1-.689.133-.917.054-.355.173-.7.53-.791a1.381,1.381,0,0,1,.331-.042h.017c.415.007.811.254.956,1.1a8.343,8.343,0,0,1-.41,3.488,10.168,10.168,0,0,1,2.7.16,1.25,1.25,0,0,1,.714.428,1.4,1.4,0,0,1-.008,1.492"
                            transform="translate(94.44 46.493)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </g>
                    <g id="Groupe_3359" data-name="Groupe 3359" transform="translate(0 5.781)">
                        <path id="Tracé_72397" data-name="Tracé 72397"
                            d="M-74.651,0s-4.1,11.1-5.874,15.9c-1.632,4.476-5.035,16.457-13.334,17.11a9.8,9.8,0,0,1-6.573-1.911l2.471-5.874c3.217,1.771,5.641-.559,7.133-4.429L-100.013,0h8.718l4.242,13.1L-83.229,0Z"
                            transform="translate(100.432)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </g>
                    <g id="Groupe_3360" data-name="Groupe 3360" transform="translate(25.28 5.035)">
                        <path id="Tracé_72398" data-name="Tracé 72398"
                            d="M-61.3-25.378v14.359h-7.832V-13.21a7.854,7.854,0,0,1-6.574,2.89c-1.305,0-6.574-.839-6.76-6.573-.14-4.849,3.124-7.04,6.387-7.6a57.641,57.641,0,0,1,6.947-.606A2.911,2.911,0,0,0-72.4-28.036a15.73,15.73,0,0,0-6.853,1.818L-81.394-31.3a19.111,19.111,0,0,1,9.977-2.844c4.988,0,10.117,1.865,10.117,8.765m-7.832,6.807V-21s-3.124-.14-4.476.839c-1.678,1.166-1.119,3.963,1.585,3.963,2.238,0,2.89-1.445,2.89-2.378"
                            transform="translate(82.471 34.143)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </g>
                    <g id="Groupe_3361" data-name="Groupe 3361" transform="translate(47.925 0)">
                        <path id="Tracé_72399" data-name="Tracé 72399"
                            d="M-34.025-37.123h5.781v-7.04h-5.781v-5.781H-41.9c0,5.781-3.872,5.781-3.872,5.781v7.04H-41.9v4.382c0,6.154.932,11.655,8.158,11.655a14.547,14.547,0,0,0,6.807-1.539l-1.725-6.434c-3.357,1.632-5.361.373-5.361-3.869Z"
                            transform="translate(45.776 49.944)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </g>
                </g>
            </svg>
        </div>
        <div class="archive_title">
            <h2 data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate"><?php echo $term->name ?></h2>
            <div class="produit aos-init aos-animate" data-aos="fade-up" data-aos-delay="300"><strong><?php echo $term->count ?></strong>
                produits</div>
        </div>
    </div>
</div>


<?php } else { ?>
<?php $banner = get_theme_mod('bacola_shop_banner_image'); ?>
<?php $bannertitle = get_theme_mod('bacola_shop_banner_title'); ?>
<?php $bannersubtitle = get_theme_mod('bacola_shop_banner_subtitle'); ?>
<?php $bannerdesc = get_theme_mod('bacola_shop_banner_desc'); ?>
<?php $bannerbuttonurl = get_theme_mod('bacola_shop_banner_button_url'); ?>
<?php
$args = array( 'post_type' => 'product', 'post_status' => 'publish', 
'posts_per_page' => -1 );
$products = new WP_Query( $args );
?>
<?php if($banner){ ?>

<div class="hero-cat" style="background:url('https://yatoo.fr/wp-content/uploads/2021/05/bacola-banner-18.jpg') no-repeat top center">

    <div class="container">

        <div class="logo"><svg id="Groupe_8168" data-name="Groupe 8168" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" width="116.424" height="38.821" viewBox="0 0 116.424 38.821"
                preserveAspectRatio="xMinYMin">
                <defs>
                    <clipPath id="clip-path">
                        <path id="Tracé_72400" data-name="Tracé 72400" d="M0-112.409H116.424V-151.23H0Z"
                            transform="translate(0 151.23)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </clipPath>
                </defs>
                <g id="Groupe_3362" data-name="Groupe 3362" transform="translate(0 0)" clip-path="url(#clip-path)">
                    <g id="Groupe_3357" data-name="Groupe 3357" transform="translate(92.182 5.035)">
                        <path id="Tracé_72395" data-name="Tracé 72395"
                            d="M-70.2-34.558A12.088,12.088,0,0,0-82.319-46.493,12.088,12.088,0,0,0-94.44-34.558,12.079,12.079,0,0,0-82.319-22.67,12.079,12.079,0,0,0-70.2-34.558m-5.342-.547c-.807,1.96-6.762,6.346-6.762,6.346s-5.974-4.36-6.79-6.316a3.837,3.837,0,0,1,2.066-5.018,3.835,3.835,0,0,1,4.7,1.47,3.836,3.836,0,0,1,4.7-1.491,3.838,3.838,0,0,1,2.088,5.009"
                            transform="translate(94.44 46.493)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </g>
                    <g id="Groupe_3358" data-name="Groupe 3358" transform="translate(66.71 5.035)">
                        <path id="Tracé_72396" data-name="Tracé 72396"
                            d="M-70.2-34.558A12.088,12.088,0,0,0-82.319-46.493,12.088,12.088,0,0,0-94.44-34.558,12.079,12.079,0,0,0-82.319-22.67,12.079,12.079,0,0,0-70.2-34.558m-14.577,4.506a.584.584,0,0,1-.584.584h-2.676a.584.584,0,0,1-.584-.584V-35.98a.584.584,0,0,1,.584-.584h2.676a.584.584,0,0,1,.584.584Zm8.207-4.563a1.279,1.279,0,0,1,.177,1.921,1.182,1.182,0,0,1-.338,1.848s.977,1.7-2.235,1.786h-.121c-.2,0-.407,0-.634-.011a13.979,13.979,0,0,1-4.008-.6.869.869,0,0,1-.572-.817v-4.925a.871.871,0,0,1,.453-.763,2.217,2.217,0,0,0,.239-.153,13.664,13.664,0,0,0,1.126-1.2,4.291,4.291,0,0,0,.951-2.005c.05-.348.1-.689.133-.917.054-.355.173-.7.53-.791a1.381,1.381,0,0,1,.331-.042h.017c.415.007.811.254.956,1.1a8.343,8.343,0,0,1-.41,3.488,10.168,10.168,0,0,1,2.7.16,1.25,1.25,0,0,1,.714.428,1.4,1.4,0,0,1-.008,1.492"
                            transform="translate(94.44 46.493)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </g>
                    <g id="Groupe_3359" data-name="Groupe 3359" transform="translate(0 5.781)">
                        <path id="Tracé_72397" data-name="Tracé 72397"
                            d="M-74.651,0s-4.1,11.1-5.874,15.9c-1.632,4.476-5.035,16.457-13.334,17.11a9.8,9.8,0,0,1-6.573-1.911l2.471-5.874c3.217,1.771,5.641-.559,7.133-4.429L-100.013,0h8.718l4.242,13.1L-83.229,0Z"
                            transform="translate(100.432)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </g>
                    <g id="Groupe_3360" data-name="Groupe 3360" transform="translate(25.28 5.035)">
                        <path id="Tracé_72398" data-name="Tracé 72398"
                            d="M-61.3-25.378v14.359h-7.832V-13.21a7.854,7.854,0,0,1-6.574,2.89c-1.305,0-6.574-.839-6.76-6.573-.14-4.849,3.124-7.04,6.387-7.6a57.641,57.641,0,0,1,6.947-.606A2.911,2.911,0,0,0-72.4-28.036a15.73,15.73,0,0,0-6.853,1.818L-81.394-31.3a19.111,19.111,0,0,1,9.977-2.844c4.988,0,10.117,1.865,10.117,8.765m-7.832,6.807V-21s-3.124-.14-4.476.839c-1.678,1.166-1.119,3.963,1.585,3.963,2.238,0,2.89-1.445,2.89-2.378"
                            transform="translate(82.471 34.143)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </g>
                    <g id="Groupe_3361" data-name="Groupe 3361" transform="translate(47.925 0)">
                        <path id="Tracé_72399" data-name="Tracé 72399"
                            d="M-34.025-37.123h5.781v-7.04h-5.781v-5.781H-41.9c0,5.781-3.872,5.781-3.872,5.781v7.04H-41.9v4.382c0,6.154.932,11.655,8.158,11.655a14.547,14.547,0,0,0,6.807-1.539l-1.725-6.434c-3.357,1.632-5.361.373-5.361-3.869Z"
                            transform="translate(45.776 49.944)" fill="#fff" style="fill: rgb(200, 128, 0);"></path>
                    </g>
                </g>
            </svg>
        </div>
        <div class="archive_title">
            <h2 data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate"><?php echo $bannertitle ?></h2>
            <div class="produit aos-init aos-animate" data-aos="fade-up" data-aos-delay="300"><strong><?php echo $products->found_posts ?></strong>
                produits</div>
        </div>
    </div>
</div>

<?php } ?>
<?php } ?>