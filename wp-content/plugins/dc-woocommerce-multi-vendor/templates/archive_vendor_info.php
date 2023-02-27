<?php
/**
 * The template for displaying archive vendor info
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/archive_vendor_info.php
 *
 * @author      WC Marketplace
 * @package     WCMp/Templates
 * @version     3.7
 */
global $WCMp;
$vendor = get_wcmp_vendor($vendor_id);
$vendor_hide_address = apply_filters('wcmp_vendor_store_header_hide_store_address', get_user_meta($vendor_id, '_vendor_hide_address', true), $vendor->id);
$vendor_hide_phone = apply_filters('wcmp_vendor_store_header_hide_store_phone', get_user_meta($vendor_id, '_vendor_hide_phone', true), $vendor->id);
$vendor_hide_email = apply_filters('wcmp_vendor_store_header_hide_store_email', get_user_meta($vendor_id, '_vendor_hide_email', true), $vendor->id);
$template_class = get_wcmp_vendor_settings('wcmp_vendor_shop_template', 'vendor', 'dashboard', 'template1');
$template_class = apply_filters('can_vendor_edit_shop_template', false) && get_user_meta($vendor_id, '_shop_template', true) ? get_user_meta($vendor_id, '_shop_template', true) : $template_class;
$vendor_hide_description = apply_filters('wcmp_vendor_store_header_hide_description', get_user_meta($vendor_id, '_vendor_hide_description', true), $vendor->id);

$vendor_fb_profile = get_user_meta($vendor_id, '_vendor_fb_profile', true);
$vendor_twitter_profile = get_user_meta($vendor_id, '_vendor_twitter_profile', true);
$vendor_linkdin_profile = get_user_meta($vendor_id, '_vendor_linkdin_profile', true);
$vendor_google_plus_profile = get_user_meta($vendor_id, '_vendor_google_plus_profile', true);
$vendor_youtube = get_user_meta($vendor_id, '_vendor_youtube', true);
$vendor_instagram = get_user_meta($vendor_id, '_vendor_instagram', true);
$address = get_user_meta($vendor_id,'_vendor_address_1',true) ;
$city = get_user_meta($vendor_id,'_vendor_city',true) ;
$zipcode = get_user_meta($vendor_id,'	_vendor_postcode',true) ;
$phone = get_user_meta($vendor_id,'_vendor_phone',true);
$ex_url = get_user_meta($vendor_id,'_vendor_external_store_ur',true);
$map_address = urlencode($address.','.$city.','.$zipcode);
// Follow code
$wcmp_customer_follow_vendor = get_user_meta( get_current_user_id(), 'wcmp_customer_follow_vendor', true ) ? get_user_meta( get_current_user_id(), 'wcmp_customer_follow_vendor', true ) : array();
$vendor_lists = !empty($wcmp_customer_follow_vendor) ? wp_list_pluck( $wcmp_customer_follow_vendor, 'user_id' ) : array();
$follow_status = in_array($vendor_id, $vendor_lists) ? __( 'Unfollow', 'dc-woocommerce-multi-vendor' ) : __( 'Follow', 'dc-woocommerce-multi-vendor' );
$follow_status_key = in_array($vendor_id, $vendor_lists) ? 'Unfollow' : 'Follow';

if ( $template_class == 'template3') { ?>
<div class='wcmp_bannersec_start wcmp-theme01'>
    <!--<div class="wcmp-banner-wrap">
        <?php if($banner != '') { ?>
            <div class='banner-img-cls'>
            <img src="<?php echo esc_url($banner); ?>" class="wcmp-imgcls"/>
            </div>
        <?php } else { ?>
            <img src="<?php echo $WCMp->plugin_url . 'assets/images/banner_placeholder.jpg'; ?>" class="wcmp-imgcls"/>
        <?php } ?>

        <div class='wcmp-banner-area'>
            <div class='wcmp-bannerright'>
                <div class="socialicn-area">
                    <div class="wcmp_social_profile">
                    <?php if ($vendor_fb_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_fb_profile); ?>"><i class="wcmp-font ico-facebook-icon"></i></a><?php } ?>
                    <?php if ($vendor_twitter_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_twitter_profile); ?>"><i class="wcmp-font ico-twitter-icon"></i></a><?php } ?>
                    <?php if ($vendor_linkdin_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_linkdin_profile); ?>"><i class="wcmp-font ico-linkedin-icon"></i></a><?php } ?>
                    <?php if ($vendor_google_plus_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_google_plus_profile); ?>"><i class="wcmp-font ico-google-plus-icon"></i></a><?php } ?>
                    <?php if ($vendor_youtube) { ?> <a target="_blank" href="<?php echo esc_url($vendor_youtube); ?>"><i class="wcmp-font ico-youtube-icon"></i></a><?php } ?>
                    <?php if ($vendor_instagram) { ?> <a target="_blank" href="<?php echo esc_url($vendor_instagram); ?>"><i class="wcmp-font ico-instagram-icon"></i></a><?php } ?>
                    <?php do_action( 'wcmp_vendor_store_header_social_link', $vendor_id ); ?>
                    </div>
                </div>
                <div class='wcmp-butn-area'>
                    <?php do_action( 'wcmp_additional_button_at_banner' ); ?>
                </div>
            </div>
        </div>

        <div class='wcmp-banner-below'>
            <div class='wcmp-profile-area'>
                <img src='<?php echo esc_attr($profile); ?>' class='wcmp-profile-imgcls' />
            </div>
            <div>
                <div class="wcmp-banner-middle">
                    <div class="wcmp-heading"><?php echo esc_html($vendor->page_title) ?></div>
                 
                    <?php if (get_wcmp_vendor_settings('store_follow_enabled', 'general') == 'Enable') { ?>
                    <button type="button" class="wcmp-butn <?php echo is_user_logged_in() ? 'wcmp-stroke-butn' : ''; ?>" data-vendor_id=<?php echo esc_attr($vendor_id); ?> data-status=<?php echo esc_attr($follow_status_key); ?> ><span></span><?php echo is_user_logged_in() ? esc_attr($follow_status) : esc_html_e('You must logged in to follow', 'dc-woocommerce-multi-vendor'); ?></button>
                    <?php } ?>
                </div>
                <div class="wcmp-contact-deatil">
                    
                    <?php if (!empty($location) && $vendor_hide_address != 'Enable') { ?><p class="wcmp-address"><span><i class="wcmp-font ico-location-icon"></i></span><?php echo esc_html($location); ?></p><?php } ?>

                    <?php if (!empty($mobile) && $vendor_hide_phone != 'Enable') { ?><p class="wcmp-address"><span><i class="wcmp-font ico-call-icon"></i></span><?php echo apply_filters('vendor_shop_page_contact', $mobile, $vendor_id); ?></p><?php } ?>

                    <?php if (!empty($email) && $vendor_hide_email != 'Enable') { ?>
                    <p class="wcmp-address"><a href="mailto:<?php echo apply_filters('vendor_shop_page_email', $email, $vendor_id); ?>" class="wcmp_vendor_detail"><i class="wcmp-font ico-mail-icon"></i><?php echo apply_filters('vendor_shop_page_email', $email, $vendor_id); ?></a></p><?php } ?>

                    <?php
                    if (apply_filters('is_vendor_add_external_url_field', true, $vendor->id)) {
                        $external_store_url = get_user_meta($vendor_id, '_vendor_external_store_url', true);
                        $external_store_label = get_user_meta($vendor_id, '_vendor_external_store_label', true);
                        if (empty($external_store_label))
                            $external_store_label = __('External Store URL', 'dc-woocommerce-multi-vendor');
                        if (isset($external_store_url) && !empty($external_store_url)) {
                            ?><p class="external_store_url"><label><a target="_blank" href="<?php echo apply_filters('vendor_shop_page_external_store', esc_url_raw($external_store_url), $vendor_id); ?>"><?php echo esc_html($external_store_label); ?></a></label></p><?php
                            }
                        }
                        ?>
                    <?php do_action('after_wcmp_vendor_information',$vendor_id);?>   
                </div>

                <?php if (!$vendor_hide_description && !empty($description)) { ?>                
                    <div class="description_data"> 
                        <?php echo wp_kses_post(htmlspecialchars_decode( wpautop( $description ), ENT_QUOTES )); ?>
                    </div>
                <?php } ?>
            </div>

            <div class="wcmp_vendor_rating">
                <?php
                if (get_wcmp_vendor_settings('is_sellerreview', 'general') == 'Enable') {
                    if (wcmp_is_store_page()) {
                        $vendor_term_id = get_user_meta( wcmp_find_shop_page_vendor(), '_vendor_term_id', true );
                        $rating_val_array = wcmp_get_vendor_review_info($vendor_term_id);
                        $WCMp->template->get_template('review/rating.php', array('rating_val_array' => $rating_val_array));
                    }
                }
                ?>      
            </div>  

        </div>

    </div>-->
</div>
<?php } elseif ( $template_class == 'template1' ) {
    ?>
   <!-- <div class='wcmp_bannersec_start wcmp-theme02'>
        
        <div class="wcmp-banner-wrap">
        <?php if($banner != '') { ?>
            <div class='banner-img-cls'>
            <img src="<?php echo esc_url($banner); ?>" class="wcmp-imgcls"/>
            </div>
        <?php } else { ?>
            <img src="<?php echo $WCMp->plugin_url . 'assets/images/banner_placeholder.jpg'; ?>" class="wcmp-imgcls"/>
        <?php } ?>
        <div class='wcmp-banner-area'>
            <div class='wcmp-bannerleft'>
                <div class='wcmp-profile-area'>
                    <img src='<?php echo esc_attr($profile); ?>' class='wcmp-profile-imgcls' />
                </div>
                <div class="wcmp-heading"><?php echo esc_html($vendor->page_title); ?></div>
                
                <div class="wcmp_vendor_rating">
                    <?php
                    if (get_wcmp_vendor_settings('is_sellerreview', 'general') == 'Enable') {
                        if (wcmp_is_store_page()) {
                            $vendor_term_id = get_user_meta( wcmp_find_shop_page_vendor(), '_vendor_term_id', true );
                            $rating_val_array = wcmp_get_vendor_review_info($vendor_term_id);
                            $WCMp->template->get_template('review/rating.php', array('rating_val_array' => $rating_val_array));
                        }
                    }
                    ?>      
                </div>
                    <?php if (!empty($location) && $vendor_hide_address != 'Enable') { ?><p class="wcmp-address"><span><i class="wcmp-font ico-location-icon"></i></span><?php echo esc_html($location); ?></p><?php } ?>

                <div class="wcmp-contact-deatil">
                    
                    <?php if (!empty($mobile) && $vendor_hide_phone != 'Enable') { ?><p class="wcmp-address"><span><i class="wcmp-font ico-call-icon"></i></span><?php echo esc_html(apply_filters('vendor_shop_page_contact', $mobile, $vendor_id)); ?></p><?php } ?>

                    <?php if (!empty($email) && $vendor_hide_email != 'Enable') { ?>
                    <p class="wcmp-address"><a href="mailto:<?php echo apply_filters('vendor_shop_page_email', $email, $vendor_id); ?>" class="wcmp_vendor_detail"><i class="wcmp-font ico-mail-icon"></i><?php echo esc_html(apply_filters('vendor_shop_page_email', $email, $vendor_id)); ?></a></p><?php } ?>
                    <?php
                    if (apply_filters('is_vendor_add_external_url_field', true, $vendor->id)) {
                        $external_store_url = get_user_meta($vendor_id, '_vendor_external_store_url', true);
                        $external_store_label = get_user_meta($vendor_id, '_vendor_external_store_label', true);
                        if (empty($external_store_label))
                            $external_store_label = __('External Store URL', 'dc-woocommerce-multi-vendor');
                        if (isset($external_store_url) && !empty($external_store_url)) {
                            ?><p class="external_store_url"><label><a target="_blank" href="<?php echo esc_attr(apply_filters('vendor_shop_page_external_store', esc_url_raw($external_store_url), $vendor_id)); ?>"><?php echo esc_html($external_store_label); ?></a></label></p><?php
                            }
                        }
                        ?>
                    <?php do_action('after_wcmp_vendor_information',$vendor_id);?>   
                </div>
            </div>
            <div class='wcmp-bannerright'>
                <div class="socialicn-area">
                    <div class="wcmp_social_profile">
                    <?php if ($vendor_fb_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_fb_profile); ?>"><i class="wcmp-font ico-facebook-icon"></i></a><?php } ?>
                    <?php if ($vendor_twitter_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_twitter_profile); ?>"><i class="wcmp-font ico-twitter-icon"></i></a><?php } ?>
                    <?php if ($vendor_linkdin_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_linkdin_profile); ?>"><i class="wcmp-font ico-linkedin-icon"></i></a><?php } ?>
                    <?php if ($vendor_google_plus_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_google_plus_profile); ?>"><i class="wcmp-font ico-google-plus-icon"></i></a><?php } ?>
                    <?php if ($vendor_youtube) { ?> <a target="_blank" href="<?php echo esc_url($vendor_youtube); ?>"><i class="wcmp-font ico-youtube-icon"></i></a><?php } ?>
                    <?php if ($vendor_instagram) { ?> <a target="_blank" href="<?php echo esc_url($vendor_instagram); ?>"><i class="wcmp-font ico-instagram-icon"></i></a><?php } ?>
                    <?php do_action( 'wcmp_vendor_store_header_social_link', $vendor_id ); ?>
                    </div>
                </div>
                <div class='wcmp-butn-area'>
                   
                    <?php if (get_wcmp_vendor_settings('store_follow_enabled', 'general') == 'Enable') { ?>
                    <button type="button" class="wcmp-butn <?php echo is_user_logged_in() ? 'wcmp-stroke-butn' : ''; ?>" data-vendor_id=<?php echo esc_attr($vendor_id); ?> data-status=<?php echo esc_attr($follow_status_key); ?> ><span></span><?php echo is_user_logged_in() ? esc_attr($follow_status) : esc_html_e('You must logged in to follow', 'dc-woocommerce-multi-vendor'); ?></button>
                    <?php } ?>
                    <?php do_action( 'wcmp_additional_button_at_banner' ); ?>
                </div>
            </div>

        </div>
        </div>
        <?php if (!$vendor_hide_description && !empty($description)) { ?>                
            <div class="description_data">
                <?php echo wp_kses_post(htmlspecialchars_decode( wpautop( $description ), ENT_QUOTES )); ?>
            </div>
        <?php } ?>
    </div>-->
    <?php
        global $WCMp;
        $vendor_term_id = get_user_meta( wcmp_find_shop_page_vendor(), '_vendor_term_id', true );
        $rating_val_array = wcmp_get_vendor_review_info($vendor_term_id);
        $rating = round($rating_val_array['avg_rating'], 1);
        update_user_meta($vendor_id,'avg_rating',$rating);
        $count = intval($rating_val_array['total_rating']);
        update_user_meta($vendor_id,'rating_count',$count);
        $rating_type = $rating_val_array['rating_type'];
        $reviews_lists = $vendor->get_reviews_and_rating(0);
        $vendor_profile_image = get_user_meta($vendor_id, '_vendor_profile_image', true);
		if(isset($vendor_profile_image)) 
		    $image = wp_get_attachment_image_src( $vendor_profile_image , array(100, 100) );
		else 
		 	$image[0] = get_avatar_url($vendor_id);

            
          
         ?>
    <article>
			<div class="header-image">
                <?php if($banner != '') { ?>
				    <img class="back rellax" src="<?php echo esc_url($banner); ?>" title="" alt="" loading="lazy" >
				<?php } else { ?>
                     <img src="<?php echo $WCMp->plugin_url . 'assets/images/banner_placeholder.jpg'; ?>" class="back rellax" loading="lazy" />
                <?php } ?>     
			</div>
			<div class="container">
				<div class="fiche-producteur">
					<div class="avis aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
						<div class="top">
							<h3>Les avis</h3>
							<div class="icone"><i class="fas fa-star"></i></div>
						</div>
						<div class="bottom">
							<div class="note">
								<div><?php echo $rating  ?></div>
								<span>sur <?php echo $count ?> avis</span>
							</div>
							<div class="liste">
                                <?php if(isset($reviews_lists) && count($reviews_lists) > 0) { 
                                    foreach($reviews_lists as $reviews_list) { 
                                       // var_dump( $reviews_list);
                                       $user = get_user_by( 'email', $reviews_list->comment_author_email );  
                                       $rating   = intval( get_comment_meta( $reviews_list->comment_ID, 'vendor_rating', true ) ) ? intval( get_comment_meta( $reviews_list->comment_ID, 'vendor_rating', true ) ) : intval( get_comment_meta( $reviews_list->comment_ID, 'rating', true ) );
                                       $attachment_id = get_user_meta( $user->ID, 'image', true );
                                       if ( $attachment_id )
                                             $image_info  = wp_get_attachment_url( $attachment_id );
                                       else
                                             $image_info  = 'https://i.pravatar.cc/300';     
                                       $city = get_user_meta( $vendor_id, '_vendor_city',true);
                                       $vendor_image =  get_user_meta( $vendor_id,'_vendor_image', true );
                                           
                                    
                                    ?>
								<div class="rate">
									<div class="haut">
										<div class="avatar">
											<img src="<?php echo $image_info ?>">
										</div>
										<div class="mentions">
											<div class="name"><strong><?php echo $reviews_list->comment_author ?></strong> le <?php echo date("d M Y",strtotime($reviews_list->comment_date));  ?></div>
											<div class="stars">
                                                <?php echo str_repeat('<i class="fas fa-star"></i>',$rating )   ?>  
												
											</div>
										</div>
									</div>
									<div class="temoignage"><?php echo $reviews_list->comment_content ?></div>
								</div>
                                <?php } } ?>
								
							</div>
							<div class="next_prev_rate">
								<a href="#" class="prev_rates"><i class="fas fa-angle-left"></i></a>
								<a href="#" class="next_rates"><i class="fas fa-angle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="decouverte" id="decouverte">
						<div class="titles">
							<div class="carte">
								<img src="http://yatoo.fr/wp-content/uploads/2022/10/carte@2x-1.png" title="" alt="" loading="lazy">
							</div>
							<div class="titre">
								<h1 data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate"><?php echo esc_html($vendor->page_title) ?></h1>
								<div class="location aos-init aos-animate" data-aos="fade-up" data-aos-delay="300"><i class="fas fa-map-marker-alt"></i> <?php echo get_user_meta( $vendor_id, '_vendor_city',true) ?></div>
								<div class="big_avatar aos-init aos-animate" data-aos="fade-left" data-aos-delay="400">
									<img src="<?php echo $image[0] ?>" loading="lazy" alt="" title="">
								</div>
							</div>
						</div>
						<div class="onglets aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
							<div class="description-container">
                                <div class="description-container-inner">
                                    <div class="navbar">
                                        <div data-target="description" class="active">Description</div>
                                        <div data-target="address">Coordonées</div>
                                          <div data-target="message"><?php echo esc_html_e('Message', 'dc-woocommerce-multi-vendor'); ?> </div>
                                    </div>
                                    <div class="onglets-content">
                                        <div class="onglet visible" id="description">
                                            <?php echo wp_kses_post(htmlspecialchars_decode( wpautop( $description ), ENT_QUOTES )); ?>
                                        </div>
                                        <div class="onglet visible" id="address">
                                             <?php if(!empty($address)) : ?>
                                        <p><i class="fa fa-map-pin"></i><strong> Adresse:</strong> <?php echo $address?>
                                            <?php if(!empty($city)) : ?>
                                                ,<?php echo $city?>
                                             <?php endif;?>
                                             <?php if(!empty($zipcode)) : ?>
                                                ,<?php echo $zipcode ?>
                                             <?php endif;?>      
                                        </p>
                                                <?php endif; ?>
                                                <?php if(!empty($phone)) : ?>
                                                    <p> <i class="fa fa-phone" aria-hidden="true"></i><strong> Téléphone:</strong> <?php echo $phone ?></p>
                                                <?php endif; ?>
                                                <?php if(!empty($ex_url)) : ?>
                                                    <p>Site web: <?php echo $ex_url ?></p>
                                                <?php endif; ?>
                                                <div style="width: 100%"><iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=fr&amp;q=<?php echo $map_address ?>+(<?php echo urlencode(esc_html($vendor->page_title)) ?>&amp;t=p&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">measure distance on map</a></iframe></div>

                                        </div>
                                        <div class="onglet visible" id="message">
                                            <?php if(is_user_logged_in()  ) : ?>
                                            <form action="" method="post">
                                                <input type="hidden" id="receiver_id" name="receiver_id" value="<?php echo $vendor_id ?>" />
                                                <input type="hidden" id="sender_id" name="sender_id" value="<?php echo get_current_user_id() ?>" /> 
                                                <input type="hidden" name="send_message" value="1" />
                                                <div class="message-form-inner" style="max-width:400px">
                                                    <p><input type="text" id="subject" placeholder="<?php echo esc_html_e('Subject', 'dc-woocommerce-multi-vendor'); ?> " name="subject" required /></p>
                                                    <p><textarea name="message" id="message_content" placeholder="<?php echo esc_html_e('Message', 'dc-woocommerce-multi-vendor'); ?> " required></textarea></p>
                                                    <p><input type="submit" name="submit" id="submit" value="<?php echo esc_html_e('Envoyer', 'dc-woocommerce-multi-vendor'); ?> " /></p>
                                                    <p class="feedback" style="color:green"></p>
                                                </div>    

                                            </form>
                                            <?php else: ?>
                                                <p><?php echo __('<a href="/mon-compte/">Connectez-vous </a> à votre compte Yatoo pour envoyer un message à ce vendeur.', 'dc-woocommerce-multi-vendor'); ?> </p>
                                            <?php endif; ?>    
                                        </div>
                                        
                                    </div>
                                </div>    
                               <!-- <div class="description-container-address">
                                    <?php if(!empty($address)) : ?>
                                        <p>Adresse: <?php echo $address?>
                                            <?php if(!empty($city)) : ?>
                                                ,<?php echo $city?>
                                             <?php endif;?>
                                             <?php if(!empty($zipcode)) : ?>
                                                ,<?php echo $zipcode ?>
                                             <?php endif;?>      
                                        </p>
                                    <?php endif; ?>
                                    <?php if(!empty($phone)) : ?>
                                        <p>Téléphone: <?php echo $phone ?></p>
                                    <?php endif; ?>
                                    <?php if(!empty($ex_url)) : ?>
                                        <p>Site web: <?php echo $ex_url ?></p>
                                    <?php endif; ?>
                                    <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=fr&amp;q=<?php echo $map_address ?>+(<?php echo urlencode(esc_html($vendor->page_title)) ?>&amp;t=p&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">measure distance on map</a></iframe></div>

                                  
                                  
                                  
                                </div>  -->
                            </div>    
                            <div class="socialicn-area">
                        <div class="wcmp_social_profile">
                        <?php if ($vendor_fb_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_fb_profile); ?>"><i class="wcmp-font ico-facebook-icon"></i></a><?php } ?>
                        <?php if ($vendor_twitter_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_twitter_profile); ?>"><i class="wcmp-font ico-twitter-icon"></i></a><?php } ?>
                        <?php if ($vendor_linkdin_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_linkdin_profile); ?>"><i class="wcmp-font ico-linkedin-icon"></i></a><?php } ?>
                        <?php if ($vendor_google_plus_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_google_plus_profile); ?>"><i class="wcmp-font ico-google-plus-icon"></i></a><?php } ?>
                        <?php if ($vendor_youtube) { ?> <a target="_blank" href="<?php echo esc_url($vendor_youtube); ?>"><i class="wcmp-font ico-youtube-icon"></i></a><?php } ?>
                        <?php if ($vendor_instagram) { ?> <a target="_blank" href="<?php echo esc_url($vendor_instagram); ?>"><i class="wcmp-font ico-instagram-icon"></i></a><?php } ?>
                        <?php do_action( 'wcmp_vendor_store_header_social_link', $vendor_id ); ?>
                        </div>
                    </div>
						</div>
					</div>
					
				</div>
			</div>
		</article>

<?php } elseif ( $template_class == 'template2' ) {
    ?>
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
            <h2 data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate"><?php echo esc_html($vendor->page_title) ?></h2>
            <div class="produit aos-init aos-animate" data-aos="fade-up" data-aos-delay="300"><strong></strong>
                produits</div>
        </div>
    </div>
</div>
   <!-- <div class='wcmp_bannersec_start wcmp-theme03'>
        <div class="wcmp-banner-wrap">
            <?php if($banner != '') { ?>
                <div class='banner-img-cls'>
                <img src="<?php echo esc_url($banner); ?>" class="wcmp-imgcls"/>
                </div>
            <?php } else { ?>
                <img src="<?php echo $WCMp->plugin_url . 'assets/images/banner_placeholder.jpg'; ?>" class="wcmp-imgcls"/>
            <?php } ?>
            <div class='wcmp-banner-area'>
                <div class='wcmp-bannerright'>
                    <div class="socialicn-area">
                        <div class="wcmp_social_profile">
                        <?php if ($vendor_fb_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_fb_profile); ?>"><i class="wcmp-font ico-facebook-icon"></i></a><?php } ?>
                        <?php if ($vendor_twitter_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_twitter_profile); ?>"><i class="wcmp-font ico-twitter-icon"></i></a><?php } ?>
                        <?php if ($vendor_linkdin_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_linkdin_profile); ?>"><i class="wcmp-font ico-linkedin-icon"></i></a><?php } ?>
                        <?php if ($vendor_google_plus_profile) { ?> <a target="_blank" href="<?php echo esc_url($vendor_google_plus_profile); ?>"><i class="wcmp-font ico-google-plus-icon"></i></a><?php } ?>
                        <?php if ($vendor_youtube) { ?> <a target="_blank" href="<?php echo esc_url($vendor_youtube); ?>"><i class="wcmp-font ico-youtube-icon"></i></a><?php } ?>
                        <?php if ($vendor_instagram) { ?> <a target="_blank" href="<?php echo esc_url($vendor_instagram); ?>"><i class="wcmp-font ico-instagram-icon"></i></a><?php } ?>
                        <?php do_action( 'wcmp_vendor_store_header_social_link', $vendor_id ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class='wcmp-banner-below'>
                <div class='wcmp-profile-area'>
                    <img src='<?php echo esc_attr($profile); ?>' class='wcmp-profile-imgcls' />
                </div>
                <div class="wcmp-heading"><?php echo esc_html($vendor->page_title) ?></div>
                
                <div class="wcmp_vendor_rating">
                    <?php
                    if (get_wcmp_vendor_settings('is_sellerreview', 'general') == 'Enable') {
                        if (wcmp_is_store_page()) {
                            $vendor_term_id = get_user_meta( wcmp_find_shop_page_vendor(), '_vendor_term_id', true );
                            $rating_val_array = wcmp_get_vendor_review_info($vendor_term_id);
                            $WCMp->template->get_template('review/rating.php', array('rating_val_array' => $rating_val_array));
                        }
                    }
                    ?>      
                </div>  

                <div class="wcmp-contact-deatil">
                    
                    <?php if (!empty($location) && $vendor_hide_address != 'Enable') { ?><p class="wcmp-address"><span><i class="wcmp-font ico-location-icon"></i></span><?php echo esc_html($location); ?></p><?php } ?>

                    <?php if (!empty($mobile) && $vendor_hide_phone != 'Enable') { ?><p class="wcmp-address"><span><i class="wcmp-font ico-call-icon"></i></span><?php echo apply_filters('vendor_shop_page_contact', $mobile, $vendor_id); ?></p><?php } ?>
                    
                    <?php if (!empty($email) && $vendor_hide_email != 'Enable') { ?>
                    <p class="wcmp-address"><a href="mailto:<?php echo apply_filters('vendor_shop_page_email', $email, $vendor_id); ?>" class="wcmp_vendor_detail"><i class="wcmp-font ico-mail-icon"></i><?php echo apply_filters('vendor_shop_page_email', $email, $vendor_id); ?></a></p><?php } ?>

                    <?php
                    if (apply_filters('is_vendor_add_external_url_field', true, $vendor->id)) {
                        $external_store_url = get_user_meta($vendor_id, '_vendor_external_store_url', true);
                        $external_store_label = get_user_meta($vendor_id, '_vendor_external_store_label', true);
                        if (empty($external_store_label))
                            $external_store_label = __('External Store URL', 'dc-woocommerce-multi-vendor');
                        if (isset($external_store_url) && !empty($external_store_url)) {
                            ?><p class="external_store_url"><label><a target="_blank" href="<?php echo apply_filters('vendor_shop_page_external_store', esc_url_raw($external_store_url), $vendor_id); ?>"><?php echo esc_html($external_store_label); ?></a></label></p><?php
                            }
                        }
                        ?>
                    <?php do_action('after_wcmp_vendor_information',$vendor_id);?>   
                </div>
                
                <?php if (!$vendor_hide_description && !empty($description)) { ?>                
                    <div class="description_data"> 
                        <?php echo wp_kses_post(htmlspecialchars_decode( wpautop( $description ), ENT_QUOTES )); ?>
                    </div>
                <?php } ?>

                <div class='wcmp-butn-area'>
                   
                    <?php if (get_wcmp_vendor_settings('store_follow_enabled', 'general') == 'Enable') { ?>
                    <button type="button" class="wcmp-butn <?php echo is_user_logged_in() ? 'wcmp-stroke-butn' : ''; ?>" data-vendor_id=<?php echo esc_attr($vendor_id); ?> data-status=<?php echo esc_attr($follow_status_key); ?> ><span></span><?php echo is_user_logged_in() ? esc_attr($follow_status) : esc_html_e('You must logged in to follow', 'dc-woocommerce-multi-vendor'); ?></button>
                    <?php } ?>
                    <?php do_action( 'wcmp_additional_button_at_banner' ); ?>
                </div>
            </div>
        </div>
    </div>-->
    <?php
}
// Additional hook after archive description ended
do_action('after_wcmp_vendor_description', $vendor_id);
?>
<script>
  jQuery("body").on("click", "#submit", function(e) {
            e.preventDefault();
            var receiver_id = jQuery('#receiver_id').val();
            var sender_id = jQuery('#sender_id').val();
            var message = jQuery('#message_content').val();
            var subject = jQuery('#subject').val();
            jQuery.get(MyAjax.ajaxurl, {
                    'action':'sendUserMessage',
                    'receiver_id':receiver_id ,
                    'message':message,
                    'subject':subject,
                    'sender_id':sender_id
                },
                function(msg) {
                  jQuery('.feedback').text("<?php echo esc_html_e("Votre message à été envoyé, veuillez suivre l'état de votre demande sur votre compte client Yatoo.", 'dc-woocommerce-multi-vendor'); ?>  ");
                });

  });
</script>

