<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
global $current_user; wp_get_current_user();
$user = wp_get_current_user();

?>
<div class="row content-wrapper sidebar-right">
    <div class="navigation">
        <div class="top">
            <div class="profile">
                <div class="photo">
					 <?php 
                     
                    
                     
                     $vendor_profile_image = get_user_meta($user->ID, '_vendor_profile_image', true);
          			
        			    if(isset($vendor_profile_image) and !empty($vendor_profile_image))
                        { 
                            $image_info = wp_get_attachment_image_src( $vendor_profile_image , array(32, 32) );
                        }   
                        else
                        {
                              $attachment_id = get_user_meta( $user->ID, 'image', true );
                             
                              if ( $attachment_id )
                                    $image_info[0]  = wp_get_attachment_url( $attachment_id );
                        }
                            
									?>
                    <img class="preview" src="<?php echo $image_info[0] ?>" alt=""
                        title="">
                    <div class="edit-photo-picture"><img src="assets/img/change-profile-picture.png" alt=""></div>
                </div>
                <div class="name"><?php echo $current_user->display_name ?></div>
               <!-- <div class="edit-photo"><i class="fal fa-edit"></i> Modifier ma photo</div>-->
            </div>
            <nav id="account-nav">
                <ul>
                    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                    <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                        <a
                            href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
      
    </div>


</div>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>