<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

//$image_column = get_theme_mod('bacola_shop_single_image_column',5);
$image_column = 4;
$content_column = (12-$image_column);

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

    <?php do_action('bacola_single_header_top'); ?>

    <div class="product-content">
        <div class="row">
            <div class="col col-12 col-lg-<?php echo esc_attr($image_column); ?> product-images">
                <?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
            </div>

            <div class="col col-12 col-lg-<?php echo esc_attr($content_column); ?> product-detail">

                <?php do_action('bacola_single_header_side'); ?>

                <div class="column">
                    <?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
					?>
                </div>

                <?php if(get_theme_mod('bacola_shop_single_featured_toggle',0) == 1 ){ ?>
                <?php $featured_title = get_theme_mod('bacola_shop_single_featured_title'); ?>
                <!--<div class="column product-icons">
						<?php if($featured_title){ ?>
							<div class="alert-message"><?php echo esc_html($featured_title); ?></div>
						<?php } ?>
						<div class="icon-messages">
							<ul>
								<?php $featured = get_theme_mod('bacola_single_featured_list'); ?>
								<?php foreach($featured as $f){ ?>
								<li>
									<div class="icon"><i class="<?php echo esc_attr($f['featured_icon']); ?>"></i></div>
									<div class="message"><?php echo esc_html($f['featured_text']); ?></div>
								</li>
								<?php } ?>

							</ul>
						</div>
					</div>-->
                <div class="column product-icons">
                    <div class="fiche-producteur aos-init aos-animate" data-aos="fade-left" data-aos-delay="600">
                        <div class="box">
                            <div class="top">
                                <div class="photo">
                                    <?php $vendor_profile_image = get_user_meta(get_the_author_ID($product->get_id()), '_vendor_profile_image', true);
        							if(isset($vendor_profile_image)) $image_info = wp_get_attachment_image_src( $vendor_profile_image , array(32, 32) );
									?>

                                    <img src="<?php echo $image_info[0] ?>" alt="" title="" loading="lazy">

                                </div>
                                <div class="location">
                                    <?php
										
										$store_location = get_user_meta(absint(get_the_author_ID($product->get_id())), '_store_location', true);
										$vendor = get_wcmp_product_vendors($product->get_id());
                                        $term  = get_user_meta(absint(get_the_author_ID($product->get_id())), '_vendor_term_id', true);
                                    
										?>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php echo get_user_meta( get_the_author_id(), '_vendor_city',true) ?>
                                </div>
                                <div class="nom"><a href="<?php echo get_term_link(get_term(  $term )) ?>"><?php echo get_term(  $term )->name; ?></a>
                                </div>
                                <a class="discover" href="<?php echo get_term_link(get_term(  $term )) ?>  ">Découvrir</a>
                            </div>
                            <div class="bottom">
                                <div class="icone"><i class="fas fa-shopping-cart"></i></div>
                                <div class="price">9,90€</div>
                                <div class="price_description"><?php echo wc_price($product->get_price()) ?></div>
                                
                                <?php                                
                                if(get_post_meta($product->get_ID(),'_bookable',true) == 'yes'):?>
                                    <!-- Do nothing -->

                                <?php else: ?>  
                                    <div class="stock"><i class="fas fa-check-circle"></i>
                                    <?php if($product->get_stock_quantity()>0 ) 
											echo 'En stock';
										  else	
											echo 'Stock épuisé';
									?>
                                    </div>
                                <?php endif;?>
                                
                                <?php
								if ($product->is_type( 'variable' )) {
									global $product;
									$available_variations =	$product->get_available_variations();
									$attributes = $product->get_variation_attributes();
									$attribute_keys  = array_keys( $attributes );
									$variations_json = wp_json_encode( $available_variations );
									$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
									
									do_action( 'woocommerce_before_add_to_cart_form' );
								 ?>
                                <form class="add_to_cart variations_form cart"
                                    action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>"
                                    method="post" enctype='multipart/form-data'
                                    data-product_id="<?php echo absint( $product->get_id() ); ?>"
                                    data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
                                    <?php do_action( 'woocommerce_before_variations_form' ); ?>
                                    <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
                                    <p class="stock out-of-stock">
                                        <?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?>
                                    </p>
                                    <?php else : ?>
                                    <table class="variations" cellspacing="0" role="presentation">
                                        <tbody>
                                            <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                                            <tr>
                                                <th class="label"><label
                                                        for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label>
                                                </th>
                                                <td class="value">
                                                    <?php
														wc_dropdown_variation_attribute_options(
															array(
																'options'   => $options,
																'attribute' => $attribute_name,
																'product'   => $product,
															)
														);
														echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
													?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php do_action( 'woocommerce_after_variations_table' ); ?>

                                    <div class="single_variation_wrap">
                                        <?php
											/**
											 * Hook: woocommerce_before_single_variation.
											 */
											do_action( 'woocommerce_before_single_variation' );

											/**
											 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
											 *
											 * @since 2.4.0
											 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
											 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
											 */
											do_action( 'woocommerce_single_variation' );

											/**
											 * Hook: woocommerce_after_single_variation.
											 */
											do_action( 'woocommerce_after_single_variation' );
										?>
                                    </div>
                                    <?php endif; ?>
                                    <div id="booking_dates_holder"></div>
                                      <?php if(get_post_meta($product->get_id(),'product_personal', true) == 'on'): ?>
                                    <div class="custom_field"> 
                                    <label>Champs de personnalisation</label>                                           
                                    <input type="text" name="personal" value="" placeholder="Votre texte ici" />
                                    </div>
                                    <?php endif; ?>
                                    <label for="quantite">Quantité</label>
                                    <input type="number" required="" min="1" max="10" id="quantite" name="quantity"
                                        value="1" step="1">
                                    <button type="submit" name="add-to-cart"
                                        class="single_add_to_cart_button button alt add-to-cart"
                                        value="<?php echo $product->get_id() ?>">Ajouter au panier
                                        <span class="icone-cart"><i class="fas fa-shopping-cart"></i></span>
                                    </button>
                                    <?php do_action( 'woocommerce_after_variations_form' ); ?>
                                </form>
                                <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
								<?php } else { ?>
                                     
									<form id="simple_product_form" class="add_to_cart variations_form cart"
                                    action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>"
                                    method="post" enctype='multipart/form-data'
                                    data-product_id="<?php echo absint( $product->get_id() ); ?>" >
                                   
                                    <div id="booking_dates_holder"></div>
                                    <?php if(get_post_meta($product->get_id(),'product_personal', true) == 'on'): ?>
                                    <div class="custom_field"> 
                                    <label>Champs de personnalisation</label>                                           
                                    <input type="text" name="personal" value="" placeholder="Votre texte ici" />
                                    </div>
                                    <?php endif; ?>
                                    <?php if(get_post_meta($product->ID,'_bookable',true) == 'yes' || get_post_meta($product->get_id(),'_for_variable_booking',true) == 1):?>
                                        <input type="hidden" name="quantity" value="1"/>
                                    <?php else: ?>    

                                        <label for="quantite">Quantité</label>
                                        <input type="number" required="" min="1" max="10" id="quantite" name="quantity"
                                            value="1" step="1">
                                    <?php endif;?>    
                                    
                                    <button type="submit" name="add-to-cart"
                                        class="single_add_to_cart_button button alt add-to-cart"
                                        value="<?php echo $product->get_id() ?>">Ajouter au panier
                                        <span class="icone-cart"><i class="fas fa-shopping-cart"></i></span>
                                    </button>
                                     <input type="hidden" id="multiple_prices" name="multiple_prices" value="" />
									 </form>
                                     <?php if(!empty(get_post_meta($product->get_id(),'multiple_bookable',true)) && get_post_meta($product->get_id(),'_for_variable_booking',true) == 1): ?>
                                       <style>.price_description{display:none}</style>
                                       <script>
                                        jQuery( document ).ready(function($) {
                                               $('<span class="merci" style="font-size:12px">Merci de saisir vos dates de début et fin de séjour</span>').insertAfter( ".price_description" );
                                               
                                         });
                                        </script>
                                    <?php 
                                        $mydata = unserialize(get_post_meta($product->get_id(),'multiple_bookable',true)); 
                                        $mydata = json_encode($mydata);                                     
                                    ?>   
                                    <script type='text/javascript' id='multiple_booking_dates'>
                                        /* <![CDATA[ */
                                            var multipledates = <?php echo $mydata ?>;
                                        /* ]]> */
                                        
                                    </script>
                                    <script> 
                                    var months = [
                                        'Janvier',
                                        'Février',
                                        'Mars',
                                        'Avril',
                                        'Mai',
                                        'Juin',
                                        'Juillet',
                                        'Août',
                                        'Septembre',
                                        'Octobre',
                                        'Novembre',
                                        'Décembre',
                                    ];                               
                                      
                                      jQuery('.show_if_two_dates').show();
                                      jQuery('body').on('change','#end_date',function(e){
                                       // e.preventDefault();
                                        var currency = ' <?php echo get_woocommerce_currency_symbol(); ?>';
                                        console.log(jQuery('#start_date').val());
                                        console.log(jQuery('#end_date').val());
                                        var fromdate = jQuery("#start_date").val();
                                         var todate = jQuery("#end_date").val();
                                        if ((fromdate == "") || (todate == "")) {
                                            jQuery("#result").html("Please enter two dates");
                                            return false
                                        }
                                        var Value=fromdate.split(" ");
                                        var month = (months.indexOf(Value[1]) + 1);    
                                        console.log(month);
                                        var date1= Value[2]+'-'+month+'-'+Value[0]
                                       
                                        var Value=todate.split(" ");
                                        var month = (months.indexOf(Value[1]) + 1);    
                                        console.log(month);
                                        var date2= Value[2]+'-'+month+'-'+Value[0]
                                    
                                       console.log(date1);
                                       console.log(date2);
                                    
                                        var dt1 = new Date(date1);
                                        var dt2 = new Date(date2);
                                    
                                        var time_difference = dt2.getTime() - dt1.getTime();
                                        
                                        var result = Math.round(time_difference / (1000 * 60 * 60 * 24));
                                        console.log(time_difference);
                                        if(result <= 0 || multipledates[result] == 0 || multipledates[result] == undefined)
                                        {
                                            alert('Incorrect Date Selection');
                                            return false;
                                        }                                        
                                        jQuery('.price_description .woocommerce-Price-amount bdi').html( multipledates[result]+currency);
                                        jQuery('#multiple_prices').val(multipledates[result]);
                                         jQuery('.price_description').show();
                                          jQuery('.merci').remove();
                                       // jQuery('#simple_product_form').submit();
                                      });  
                                                                 
                                    </script>
                                    <?php endif; ?>
								<?php } ?>	
                            </div>
                        </div>
                    </div>
                </div>


                <?php } ?>

            </div>

        </div>
    </div>
</div>

<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>


<?php do_action( 'woocommerce_after_single_product' ); ?>
<!-- Script to clone easy booking dates from the original form -->
<script>
jQuery( document ).ready(function() {
   var temp = jQuery('.wceb_picker_wrap').html()
   // copy
   jQuery('#booking_dates_holder').html(temp);
   jQuery('.wceb_picker_wrap').remove();
});
</script>    