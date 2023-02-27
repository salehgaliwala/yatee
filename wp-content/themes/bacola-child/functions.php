<?php

/**s
 * functions.php
 * @package WordPress
 * @subpackage Bacola
 * @since Bacola 1.0
 * 
 */

add_action( 'wp_enqueue_scripts', 'bacola_enqueue_styles', 99 );
function bacola_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_style_add_data( 'parent-style', 'rtl', 'replace' );
      wp_enqueue_script(
        'index-js',
        get_stylesheet_directory_uri() . '/index.min.js'       
    );
}

add_shortcode('location-dropdown','locationDropdown');
function locationDropdown()
{
    ?>
<div class="recherche">
      <form class="dgwt-wcas-search-form" id="general_search" role="search" action="https://yatoo.fr/" method="get">
    
        <div class="form-group">
            <label for="motcle"></label>
                <i class="fa fa-search" aria-hidden="true"></i><input type="search" placeholder="T-shirt, masque, vin..." id="dgwt-wcas-search-input-1" class="dgwt-wcas-search-input" name="s">
            
			
			<div class="dgwt-wcas-preloader"></div>

			<div class="dgwt-wcas-voice-search"></div>

			
			<input type="hidden" name="post_type" value="product">
			<input type="hidden" name="dgwt_wcas" value="1">
        </div>
        <div class="sep"></div>
        <div class="form-group">
            <label for="region"></label>
            <i class="fa fa-globe" aria-hidden="true"></i>
            <select id="region" name="region" placeholder="Sélectionner une région">
                <option value="" select="selected">Sélectionner une région</option>
                <?php $terms = get_terms(array(
                                                       'taxonomy' => 'location',
                                                       'hide_empty' => false,
                                          ));
                                        
                                                $i = 1;
                                                foreach ($terms as $term){
                                                         
                                                echo ' <option value="'.$term->term_id.'">'.$term->name.'</option>' ;           
                                                $i++;
                                          
                                                }
                                          ?>


            </select>
        </div>
    </form>
</div>
<?php
}

add_shortcode('account-menu','accountMenu');
function accountMenu()
{
    ?>
<div class="compte">
    <div class="buttons">
        <div class="icone">
            <img src="http://yatoo.fr/wp-content/uploads/2022/09/icone-compte@3x.png" loading="lazy" alt=""
                title="">
        </div>
        <div class="labelss">
            <strong>Mon compte</strong>
            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="Connexion">
            <?php if(is_user_logged_in() ) :?>
                <?php 
                    $current_user = wp_get_current_user();
                    echo $current_user->display_name;
                    ?>
             <?php else : ?>   
                Me connecter
            <?php endif; ?>
        
        </a>
            <!-- <a href="/compte/dashboard.php" title="Connexion">Gérer mon compte</a> -->
        </div>
    </div>
    <div class="buttons">
        <div class="icone">
            <img src="http://yatoo.fr/wp-content/uploads/2022/09/icone-panier@3x.png" loading="lazy" alt=""
                title="">
        </div>
        <div class="labelss">
            <strong>Panier <span><?php echo get_cart_contents_count() ?></span></strong>
            <a href="/cart" title="Voir mon panier"><?php echo get_cart_total() ?></a>
            <!-- <a href="/compte/dashboard.php" title="Connexion">Gérer mon compte</a> -->
        </div>
    </div>
</div>
<?php
}
  
function get_cart_contents_count() {
      if ( function_exists( 'WC' ) ) {
            return WC()->cart->get_cart_contents_count();
      } else {
            return $GLOBALS['woocommerce']->cart->get_cart_contents_count();
      }
}

function get_cart_total() {
      $settings = get_option('wpmenucart');
      if ( defined('WC_VERSION') && version_compare( WC_VERSION, '3.3', '>=' ) ) {
            if (isset($settings['total_price_type']) && $settings['total_price_type'] == 'subtotal') {
                  if ( WC()->cart->display_prices_including_tax() ) {
                        $cart_contents_total = wc_price( WC()->cart->get_subtotal() + WC()->cart->get_subtotal_tax() );
                  } else {
                        $cart_contents_total = wc_price( WC()->cart->get_subtotal() );
                  }
            } elseif (isset($settings['total_price_type']) && $settings['total_price_type'] == 'checkout_total') {
                  $cart_contents_total = wc_price( WC()->cart->get_total('edit') );
            } else {
                  if ( WC()->cart->display_prices_including_tax() ) {
                        $cart_contents_total = wc_price( WC()->cart->get_cart_contents_total() + WC()->cart->get_cart_contents_tax() );
                  } else {
                        $cart_contents_total = wc_price( WC()->cart->get_cart_contents_total() );
                  }
            }
      } else {
            // Backwards compatibility
            global $woocommerce;
            
            // $woocommerce->cart->get_cart_total() is not a display function,
            // so we add tax if cart prices are set to display incl. tax
            // see https://github.com/woothemes/woocommerce/issues/6701
            if (isset($settings['total_price_type']) && $settings['total_price_type'] == 'subtotal') {
                  // Display varies depending on settings
                  if ( $woocommerce->cart->display_cart_ex_tax ) {
                        $cart_contents_total = wc_price( $woocommerce->cart->subtotal_ex_tax );
                  } else {
                        $cart_contents_total = wc_price( $woocommerce->cart->subtotal );
                  }
            } else {
                  if ( $woocommerce->cart->display_cart_ex_tax ) {
                        $cart_contents_total = wc_price( $woocommerce->cart->cart_contents_total );
                  } else {
                        $cart_contents_total = wc_price( $woocommerce->cart->cart_contents_total + $woocommerce->cart->tax_total );
                  }
            }
            $cart_contents_total = apply_filters( 'woocommerce_cart_contents_total', $cart_contents_total );
      }

      return $cart_contents_total;
}

add_action('woocommerce_single_product_summary', 'product_title');
function product_title()      
{
      echo '<h1 class="product-title">'.get_the_title().'</h1>';
      echo  '<span class="vendor_name">'.bacola_vendor_name().'</span>';
}

add_action('woocommerce_single_product_summary', 'show_counts');
function show_counts()
{
      $product = wc_get_product( get_the_ID());
      echo '<div class="views">'.$product->get_review_count().' Avis</div>';
      echo '<p>'.get_the_excerpt().'</p>';
      $product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
      echo '<div class="menu-accordean">';
 ?>
 
 <?php foreach ( $product_tabs as $key => $product_tab ) : 
      echo '<li class="item" id="mn-'.$key.'">';
            ?>
      <a class="btn" href="#mn-<?php echo $key ?>"><?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?></a>
      <?php
      echo '<div class="submenu">';
  
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
			
      echo '</div>';
      echo '</li>';
      endforeach; ?>
    </div>
 <?php   
}

// Add field
function action_woocommerce_edit_account_form_start() {
    ?>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="image"><?php esc_html_e( 'Image', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="file" class="woocommerce-Input" name="image" accept="image/x-png,image/gif,image/jpeg">
    </p>
    <?php
}
add_action( 'woocommerce_edit_account_form_start', 'action_woocommerce_edit_account_form_start' );

// Validate
function action_woocommerce_save_account_details_errors( $args ){
    if ( isset($_POST['image']) && empty($_POST['image']) ) {
        $args->add( 'image_error', __( 'Please provide a valid image', 'woocommerce' ) );
    }
}
add_action( 'woocommerce_save_account_details_errors','action_woocommerce_save_account_details_errors', 10, 1 );

// Save
function action_woocommerce_save_account_details( $user_id ) {  
    if ( isset( $_FILES['image'] ) ) {
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        $attachment_id = media_handle_upload( 'image', 0 );

        if ( is_wp_error( $attachment_id ) ) {
            update_user_meta( $user_id, 'image', $_FILES['image'] . ": " . $attachment_id->get_error_message() );
        } else {
            update_user_meta( $user_id, 'image', $attachment_id );
        }
   }
}
add_action( 'woocommerce_save_account_details', 'action_woocommerce_save_account_details', 10, 1 );

// Add enctype to form to allow image upload
function action_woocommerce_edit_account_form_tag() {
    echo 'enctype="multipart/form-data"';
} 
add_action( 'woocommerce_edit_account_form_tag', 'action_woocommerce_edit_account_form_tag' );

/** Remove product data tabs */
 
add_filter( 'woocommerce_product_tabs', 'my_remove_product_tabs', 98 );
 
function my_remove_product_tabs( $tabs ) {
  unset( $tabs['vendor'] ); // To remove the additional information tab
  unset( $tabs['wcmp_customer_qna'] ); // To remove the additional information tab   
  unset( $tabs['policies'] );  
 
  return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'woo_livraison_tab' );
function woo_livraison_tab( $tabs ) {
// Adds the new tab
    $tabs['desc_tab'] = array(
        'title'     => __( 'Politique de livraison', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => 'woo_livraison_tab_content'
    );
    return $tabs;
}

function woo_livraison_tab_content() {
  // The new tab content
  $vendor_id = get_the_author_id();
  $_wcmp_shipping_policy = get_post_meta(get_the_ID(), '_wcmp_shipping_policy', true) ? get_post_meta(get_the_ID(), '_wcmp_shipping_policy', true) : '';
  if(!empty($_wcmp_shipping_policy )) 
    echo $_wcmp_shipping_policy;     
  else    
    echo get_user_meta( $vendor_id ,'_vendor_shipping_policy', true);
}

add_filter( 'woocommerce_product_tabs', 'woo_remboursement_tab' );
function woo_remboursement_tab( $tabs ) {
// Adds the new tab
    $tabs['remboursement_tab'] = array(
        'title'     => __( 'Politique de remboursement', 'woocommerce' ),
        'priority'  => 60,
        'callback'  => 'woo_remboursement_tab_content'
    );
    return $tabs;
}

function woo_remboursement_tab_content() {
  // The new tab content
  $vendor_id = get_the_author_id();
  $_wcmp_refund_policy = get_post_meta(get_the_ID(), '_wcmp_refund_policy', true) ? get_post_meta(get_the_ID(), '_wcmp_refund_policy', true) : '';
  
   if(empty($_wcmp_refund_policy ))      
     echo get_user_meta( $vendor_id ,'vendor_refund_policy', true);
   else
    echo $_wcmp_refund_policy ;
}

add_filter( 'woocommerce_product_tabs', 'woo_retour_tab' );
function woo_retour_tab( $tabs ) {
// Adds the new tab
    $tabs['retour_tab'] = array(
        'title'     => __( 'Politique d\'annulation/retour/échange', 'woocommerce' ),
        'priority'  => 60,
        'callback'  => 'woo_retour_tab_content'
    );
    return $tabs;
}

function woo_retour_tab_content() {
  // The new tab content
  $vendor_id = get_the_author_id();
  $_wcmp_cancallation_policy = get_post_meta(get_the_ID(), '_wcmp_cancallation_policy', true) ? get_post_meta(get_the_ID(), '_wcmp_cancallation_policy', true) : '';
  $_wcmp_refund_policy = get_post_meta(get_the_ID(), '_wcmp_refund_policy', true) ? get_post_meta(get_the_ID(), '_wcmp_refund_policy', true) : '';
  
  if(empty($_wcmp_cancallation_policy ))   
    echo get_user_meta( $vendor_id ,'_vendor_cancellation_policy', true);
  else
    echo  $_wcmp_cancallation_policy; 
}

//add_filter( 'woocommerce_product_tabs', 'woo_short_description_tab' );
function woo_short_description_tab( $tabs ) {
// Adds the new tab
    $tabs['description_tab'] = array(
        'title'     => __( 'Description courte', 'woocommerce' ),
        'priority'  => 1,
        'callback'  => 'woo_short_description_tab_content'
    );
    return $tabs;
}

function woo_short_description_tab_content() {
  // The new tab content
  
   the_excerpt();
}


add_shortcode('vendor-reg-form', 'vendor_reg_form_func');
function vendor_reg_form_func()
{
    global $WCMp;
    if($_POST['email'] && isset($_POST['create_vendor']) && $_POST['create_vendor'] == 'yes')
    {
        $errors = '';
        if(!isset($_POST['email']) || empty($_POST['email']))
        {
            $errors = "Email required";
        }    
        else
        {
            $password           = wp_generate_password();
            $username = wc_create_new_customer_username( $_POST['email'] );
            $customer_id = wc_create_new_customer($_POST['email'],$username, $password );          
            update_user_meta($customer_id,'societe',$_POST['societe']);        
            update_user_meta($customer_id,'type_activite',$_POST['type_activite']);
            update_user_meta($customer_id,'aioseo_facebook_page_url',$_POST['page_facebook']);
            update_user_meta($customer_id,'_vendor_state_code',$_POST['departement']);
            update_user_meta($customer_id,'aioseo_profiles_additional_urls',$_POST['site_internet']);
            update_user_meta($customer_id,'billing_first_name',$_POST['nom']);
            update_user_meta($customer_id,'first_name',$_POST['nom']);
            update_user_meta($customer_id,'last_name',$_POST['prenom']);
            update_user_meta($customer_id,'billing_last_name',$_POST['prenom']);
            update_user_meta($customer_id,'nick_name',$_POST['nom'].' '. $_POST['prenom']);
            update_user_meta($customer_id,'_vendor_page_title',$_POST['shop_name']);
            update_user_meta($customer_id,'_vendor_description',$_POST['presentation']);
            update_user_meta($customer_id,'_vendor_page_slug',str_replace(' ', '-',$_POST['shop_name']));
            update_user_meta($customer_id,'avg_rating',0);
            update_user_meta($customer_id,'rating_count',0);
            $wp_user_object = new WP_User($customer_id);
            $wp_user_object->set_role('dc_pending_vendor');
            if(!term_exists($_POST['shop_name'])){        
                 $term = wp_insert_term($_POST['shop_name'], $WCMp->taxonomy->taxonomy_name);
                 $term_id = $term['term_id'];
            }
            else{
                $term= get_term_by('name',$_POST['shop_name'], $WCMp->taxonomy->taxonomy_name);
                $term_id = $term->term_id;
            }
           
            update_term_meta($term_id , '_vendor_user_id', $customer_id);           
             if (!is_wp_error($term)) 
                update_user_meta($customer_id, '_vendor_term_id', $term_id);

            // Upload cover and profile images.
            // WordPress environmet
            require( dirname(__FILE__) . '/../../../wp-load.php' );

            // it allows us to use wp_handle_upload() function
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            if( !empty( $_FILES[ 'photo_profil' ] ) ) {
                $upload = wp_handle_upload( 
                    $_FILES[ 'photo_profil' ], 
                    array( 'test_form' => false ) 
                );
                if( ! empty( $upload[ 'error' ] ) ) {
	                wp_die( $upload[ 'error' ] );
                }
                $attachment_id = wp_insert_attachment(
                    array(
                        'guid'           => $upload[ 'url' ],
                        'post_mime_type' => $upload[ 'type' ],
                        'post_title'     => basename( $upload[ 'file' ] ),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    ),
                    $upload[ 'file' ]
                );
                if( is_wp_error( $attachment_id ) || ! $attachment_id ) {
                        wp_die( 'Upload error.' );
                    }
                wp_update_attachment_metadata(
                    $attachment_id,
                    wp_generate_attachment_metadata( $attachment_id, $upload[ 'file' ] )
                );    
                update_user_meta($customer_id,'_vendor_profile_image',$attachment_id);
            }
           
            // upload banner
            if( !empty( $_FILES[ 'photo_couverture' ] ) ) {
                $upload = wp_handle_upload( 
                    $_FILES[ 'photo_couverture' ], 
                    array( 'test_form' => false ) 
                );
                if( ! empty( $upload[ 'error' ] ) ) {
	                wp_die( $upload[ 'error' ] );
                }
                $attachment_id = wp_insert_attachment(
                    array(
                        'guid'           => $upload[ 'url' ],
                        'post_mime_type' => $upload[ 'type' ],
                        'post_title'     => basename( $upload[ 'file' ] ),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    ),
                    $upload[ 'file' ]
                );
                if( is_wp_error( $attachment_id ) || ! $attachment_id ) {
                        wp_die( 'Upload error.' );
                    }
                wp_update_attachment_metadata(
                    $attachment_id,
                    wp_generate_attachment_metadata( $attachment_id, $upload[ 'file' ] )
                );    
                update_user_meta($customer_id,'_vendor_banner',$attachment_id);
            }

        }
        

    }
     ob_start();
    ?>
<div class="formulaire_inscription">
            <div class="container" id="registration_form">
               <!-- <h2 data-aos="fade-up" class="aos-init aos-animate">Vous souhaitez vendre vos produits sur Yatoo ?<br>C’est parti ! Remplissez les champs ci-dessous</h2> -->
               <div class="messages">
                <?php if(isset($_POST['create_vendor'])) :?>
                    <script>
                            jQuery( document ).ready()
                            jQuery(function() {
                                jQuery('html, body').animate({
                                    scrollTop: jQuery("#registration_form").offset().top
                                }, 2000);
                            });
                        </script>
                    <?php if(!empty($customer_id) && empty($errors)): ?>
                        
                        <p class="success-msg">Votre compte vendeur à bien été créé sur Yatoo. Vous allez recevoir un mail de vérification avec un lien pour définir votre mot de passe. </p>
                    <?php else: ?>

                        <p class="error-msg">Error creating vendor: <?php echo $errors ?></p>
                    <?php endif; ?>    
                <?php endif; ?>
                </div>
                <form data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate" method="post" enctype="multipart/form-data">
                    <h3>Informations personnelles</h3>
                    <div class="form-group">
                        <label>Nom de société</label>
                        <input type="text" name="societe" required="" value="<?php echo $_POST['societe'] ?>" placeholder="La nom juridique de votre société">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $_POST['email'] ?>" required="" placeholder="Votre email de contact principal">
                    </div>
                    <div class="form-group">
                        <label>Type d'activité</label>
                        <select name="type_activite" required="">
                            <option value="" disabled="">Choisissez...</option>
                            <option value="Mode et accessoires">Mode et Accessoires</option>
                            <option value="Vente de produits alimentaires">Alimentation</option>
                            <option value="Vente de produits alimentaires">Bijoux</option>
                            <option value="Vente de produits alimentaires">Service</option>
                            <option value="Vente de produits alimentaires">Épicerie</option>
                            <option value="Vente de produits alimentaires">Autres</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Page Facebook</label>
                        <input type="url" name="page_facebook" value="<?php echo $_POST['page_facebook'] ?>" placeholder="URL de votre page Facebook">
                    </div>
                    <div class="form-group">
                        <label>Département</label>
                        <select id="region" name="departement" placeholder="Sélectionner une région">
                            <option value="" select="selected">Sélectionner une région</option>
                            <?php $terms = get_terms(array(
                                            'taxonomy' => 'location',
                                            'hide_empty' => false,
                                            ));
                                
                                            $i = 1;
                                            foreach ($terms as $term){
                                                    
                                            echo ' <option value="'.$term->term_id.'">'.$term->name.'</option>' ;           
                                            $i++;
                                    
                                            }
                                ?>


                                </select>
                       
                    </div>
                    <div class="form-group">
                        <label>Site Internet</label>
                        <input type="url" name="site_internet" value="<?php echo $_POST['site_internet'] ?>" placeholder="URL de votre site">
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" value="<?php echo $_POST['nom'] ?>" placeholder="Nom">
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" value="<?php echo $_POST['prenom'] ?>" placeholder="Prénom">
                    </div>
                    <div class="form-group two">
                        <label>SIRET</label>
                        <input type="text" name="siret" value="<?php echo $_POST['siret'] ?>"  required="" placeholder="Numéro SIRET">
                    </div>

                    <h3>Informations publiques</h3>
                    <small>Vous pourrez modifier par la suite ces informations</small>

                    <div class="form-group">
                        <label>Nom de la boutique</label>
                        <input type="text" name="shop_name" value="<?php echo $_POST['shop_name'] ?>" required="" placeholder="Nom public de votre boutique Yatoo">
                    </div>

                    <div class="break"></div>

                    <div class="form-group">
                        <label>Photo de profil  *Format recommandé (500px x 500px)</label>
                        <input type="file" name="photo_profil" value="" required="" placeholder="Nom public de votre boutique Yatoo">
                    </div>
                    <div class="form-group">
                        <label>Photo de couverture  *Format recommandé (1200px x 435px)</label>
                        <input type="file" name="photo_couverture" value="" required="" placeholder="Nom public de votre boutique Yatoo">
                    </div>
                    <div class="form-group two">
                        <label>Présentation</label>
                        <textarea name="presentation" value="" placeholder="Décrivez au mieux votre activité"> <?php echo $_POST['presentation'] ?></textarea>
                    </div>
                    <div class="form-group two rgpd">
                        <input type="checkbox" required="" name="rgpd" id="rgpd">
                        <label for="rgpd">Vos données personnelles seront utilisées pour vous accompagner au cours de votre visite du site web, gérer l’accès à votre compte, et pour d’autres raisons décrites dans notre politique de confidentialité.</label>
                    </div>
                    <div class="submit">
                        <input type="hidden" value="yes" name="create_vendor" />
                        <button type="submit">Valider mon inscription</button>
                    </div>
                </form>
            </div>

        </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

//skip store setup
add_filter('woocommerce_show_variation_price', function() { return TRUE;});
add_filter( 'wcmp_vendor_store_setup_wizard_enabled' , '__return_false' );

add_action('wp_footer','variationJSFunction');
function variationJSFunction()
{
    ?>
    <script>
        jQuery( '.variations_form' ).each( function() {
        jQuery(this).on( 'change', '.variations select', function() {
            var totalPrice ;
            if ( jQuery('.single_variation_wrap .test').length ) {
              jQuery('.single_variation_wrap .test').html('');  
              
            }
            setTimeout(function(){
                var currency    = currency = ' <?php echo get_woocommerce_currency_symbol(); ?>';
                price       = jQuery('.woocommerce-variation-price .amount').text().replace(/\,/g,'.');
                parsePrice  = parseFloat(price);              
                totalPrice  = parsePrice.toFixed(2);                
                totalPrice = totalPrice.replace(/\./g,',');
                jQuery('.price_description .woocommerce-Price-amount bdi').html( totalPrice+currency);
            }, 2000);
            console.log(totalPrice);
          
        });
    });
    </script>    
<?php }
function bbloomer_add_premium_support_endpoint() {
    add_rewrite_endpoint( 'premium-support', EP_ROOT | EP_PAGES );
}
  
add_action( 'init', 'bbloomer_add_premium_support_endpoint' );
  
// ------------------
// 2. Add new query var
  
function bbloomer_premium_support_query_vars( $vars ) {
    $vars[] = 'premium-support';
    return $vars;
}
  
add_filter( 'query_vars', 'bbloomer_premium_support_query_vars', 0 );
  
// ------------------
// 3. Insert the new endpoint into the My Account menu
  
function bbloomer_add_premium_support_link_my_account( $items ) {
    $items['premium-support'] = 'Messages';
    return $items;
}
  
add_filter( 'woocommerce_account_menu_items', 'bbloomer_add_premium_support_link_my_account' );
  
// ------------------
// 4. Add content to the new tab
  
function bbloomer_premium_support_content() {
  // echo '<h3>Premium WooCommerce Support</h3><p>Welcome to the WooCommerce support area. As a premium customer, you can submit a ticket should you have any WooCommerce issues with your website, snippets or customization. <i>Please contact your theme/plugin developer for theme/plugin-related support.</i></p>';
   echo do_shortcode( ' [front-end-pm] ' );
}
  
add_action( 'woocommerce_account_premium-support_endpoint', 'bbloomer_premium_support_content' );
// Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format

function remove_submenu() {
    remove_submenu_page( 'admin.php', 'admin.php?page=fep-all-messages-wp-support-forum' );
}

add_action( 'admin_menu', 'remove_submenu', 9999 );

add_action('wp_ajax_nopriv_sendUserMessage', 'sendUserMessage');
add_action('wp_ajax_sendUserMessage', 'sendUserMessage');


function sendUserMessage()
{
  
    // Lets process the message.
    global $wpdb;
    $table_name = $wpdb->prefix . 'fep_messages'; 
    $table_name_p = $wpdb->prefix . 'fep_participants';     
    $receiver_id = $_REQUEST['receiver_id'];
    $sender_id = $_REQUEST['sender_id'];
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message'];
    $wpdb->insert($table_name, array('mgs_parent' => 0 , 'mgs_author' =>  $sender_id  , 'mgs_created' => date('Y-m-d h:i:s') ,'mgs_title' => $subject ,'mgs_content' => $message ,'mgs_type' => 'message' ,'mgs_status' => 'publish'));
    $msg_id = $wpdb->insert_id;
    $wpdb->insert($table_name_p,array('mgs_id'=> $msg_id,'mgs_participant'=>$receiver_id));
 
    $wpdb->insert($table_name_p,array('mgs_id'=> $msg_id,'mgs_participant'=>$sender_id));
  //  print_r( $wpdb->queries );
 
    die();
  
}
// Function to check the bookable product and update the data
add_action('wcmp_after_post_update', 'vendor_update_bookable_meta',10,2);
function vendor_update_bookable_meta($post_id,$POST)
{
  
    $booking_data = array(
            'bookable'                => isset( $POST['_bookable'] ) ? 'yes' : 'no',
            'dates'                   => isset( $POST['_number_of_dates'] ) ? $_POST['_number_of_dates'] : '',
            'booking_min'             => isset( $POST['_booking_min'] ) ? $POST['_booking_min'] : '',
            'booking_max'             => isset( $POST['_booking_max'] ) ? $POST['_booking_max'] : '',
            'first_available_date'    => isset( $POST['_first_available_date'] ) ? $POST['_first_available_date'] : '',
            'booking_duration'        => isset( $POST['_booking_duration'] ) ? $POST['_booking_duration'] : ''
        );
        //var_dump($booking_data );
       // exit;
        if($booking_data['bookable'] == 'no')
            return;


        vendor_save_product_booking_options( $post_id, $booking_data );
        // Add the variations here
        //$parent_id = 746; // Or get the variable product id dynamically
        if(count($_POST['item_days'] > 0))
        {
            // since we have multiple days option for booking we add as variable product.
            // Get the post ID
            $parent_id = $post_id;
            // Create varaible data.
            $i=0;  
            foreach($_POST['item_days'] as $day)
            {
                // The variation data
                
                $data[$day] = $_POST['item_price'][$i];
                $i++;
            }
            $serialized_data = serialize( $data );       
            update_post_meta($post_id,'multiple_bookable',$serialized_data );
            update_post_meta($post_id,'_for_variable_booking',$_POST['_for_variable_booking'] );
        }



}

function vendor_save_product_booking_options( $id, array $booking_data ) {
  

    $is_bookable = $booking_data['bookable'];
    $data = array(
        'booking_min'          => $booking_data['booking_min'],
        'booking_max'          => $booking_data['booking_max'],
        'first_available_date' => $booking_data['first_available_date']
    );

    foreach ( $data as $name => $value ) {
        
        switch ( $value ) {
            case '' :
                ${$name} = '';
            break;

            case 0 :
                ${$name} = '0';
            break;

            default :
                ${$name} = $value;
            break;
        }
        
    }

    if ( $booking_min != 0 && $booking_max != 0 && $booking_min > $booking_max ) {
        \WC_Admin_Meta_Boxes::add_error( __( 'Minimum booking duration must be inferior to maximum booking duration', 'woocommerce-easy-booking-system' ) );
    } else {
        update_post_meta( $id, '_booking_min', $booking_min );
        update_post_meta( $id, '_booking_max', $booking_max );
    }

    if ( ! empty( $booking_data['booking_duration'] ) ) {

        $booking_duration = absint( $booking_data['booking_duration'] );

        if ( $booking_duration <= 0 ) {
            $booking_duration = 1;
        }

    } else {
        $booking_duration = '';
    }

    $dates = 'two';

    if ( ! empty( $booking_data['dates'] )
        && ( $booking_data['dates'] === 'one'
        || $booking_data['dates'] === 'two'
        || $booking_data['dates'] === 'parent'
        || $booking_data['dates'] === 'global' ) ) {

        $dates = sanitize_text_field( $booking_data['dates'] );

    }
    
    update_post_meta( $id, '_number_of_dates', $dates );
    update_post_meta( $id, '_booking_duration', $booking_duration );
    update_post_meta( $id, '_first_available_date', $first_available_date );
    update_post_meta( $id, '_bookable', $is_bookable );

}
add_action('woocommerce_add_to_cart' , 'set_country_befor_cart_page'); 

function set_country_befor_cart_page(){

    WC()->customer->set_billing_country('FR');
    WC()->customer->set_shipping_country('FR');
}

add_action('after_wcmp_add_product_form', 'inject_Personal_product_JS',10,1);
function inject_Personal_product_JS($postid)
{
 
    ?>
<script>
jQuery( document ).ready(function() {

<?php if(get_post_meta($postid,'product_personal',true) == 'on'): ?>
jQuery('#woocommerce-product-data .add-product-info-header .pull-right').append('<label for="_personal" class="show_if_simple show_if_variable tips" style=""><input type="checkbox" name="_personal" id="_personal" checked="checked">Produit personnalisable</label>')
<?php else: ?>
jQuery('#woocommerce-product-data .add-product-info-header .pull-right').append('<label for="_personal" class="show_if_simple show_if_variable tips" style=""><input type="checkbox" name="_personal" id="_personal">Produit personnalisable</label>')    
<?php endif; ?>
});



</script>
    <?php
}

add_action('wcmp_after_post_update', 'vendor_update_product_personal',10,2);
function vendor_update_product_personal($post_id,$POST)
{
 
    if ( $POST['_personal'] == 'on' )
    {
        update_post_meta($post_id , 'product_personal','on' );

    }
    else
    {
        update_post_meta($post_id , 'product_personal','off' );
    }
}

add_filter( 'woocommerce_add_cart_item_data', 'njengah_product_add_on_cart_item_data', 90, 2 );

function njengah_product_add_on_cart_item_data( $cart_item, $product_id ){

    if( isset( $_POST['personal'] ) ) {

        $cart_item['personal'] = sanitize_text_field( $_POST['personal'] );

    }
   
    return $cart_item;

}

add_filter( 'woocommerce_get_item_data', 'njengah_product_add_on_display_cart', 10, 2 );

function njengah_product_add_on_display_cart( $data, $cart_item ) {

    if ( isset( $cart_item['personal'] ) ){

        $data[] = array(

            'name' => 'Produit personnalisé',

            'value' => sanitize_text_field( $cart_item['personal'] )

        );

    }

    return $data;

}

add_action( 'woocommerce_add_order_item_meta', 'njengah_product_add_on_order_item_meta', 10, 2 );

function njengah_product_add_on_order_item_meta( $item_id, $values ) {

    if ( ! empty( $values['personal'] ) ) {

        wc_add_order_item_meta( $item_id, 'Produit personnalisé', $values['personal'], true );

    }

}

// 6. Display custom input field value into order table

add_filter( 'woocommerce_order_item_product', 'njengah_product_add_on_display_order', 10, 2 );

function njengah_product_add_on_display_order( $cart_item, $order_item ){

    if( isset( $order_item['personal'] ) ){

        $cart_item['personal'] = $order_item['personal'];

    }

    return $cart_item;

}

// 7. Display custom input field value into order emails

add_filter( 'woocommerce_email_order_meta_fields', 'njengah_product_add_on_display_emails' );

function njengah_product_add_on_display_emails( $fields ) {

    $fields['personal'] = 'Produit personnalisé';

    return $fields;

}

//add_action( 'woocommerce_before_calculate_totals', 'add_custom_price' );

function add_custom_price( $cart_object ) {
    $custom_price = $_POST['multiple_prices']; // This will be your custome price
   
    if($custom_price != '' && !empty($custom_price) && isset($custom_price))
    {
        
         foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
             $cart_item['data']->set_price((int)$custom_price);   
             
         }
    }
   
}


add_filter( 'easy_booking_cart_item', 'misha_recalc_price', 100, 1 );
function misha_recalc_price(  $cart_item ) {
    $custom_price = $_POST['multiple_prices']; // This will be your custome price
    if($custom_price != '' && !empty($custom_price) && isset($custom_price))
     {        
        $cart_item['_booking_price'] = (float)$custom_price;    
     }   
      return $cart_item;
}

function generateDates($start_date, $end_date) {
    $dates = '';
    $current = strtotime($start_date);
    $last = strtotime($end_date);
    
    while($current <= $last) {
       // $dates[] = date('Y-m-d', $current);   
       $date.='['.date('Y', $current).','.date('m', $current).','.date('d', $current).'],';
        $current = strtotime('+1 day', $current);
    }
    
    return $date;
}

function get_orders_ids_by_product_id( $product_id ) {
    global $wpdb;
    
    // Define HERE the orders status to include in  <==  <==  <==  <==  <==  <==  <==
    $orders_statuses = "'wc-completed', 'wc-processing', 'wc-on-hold'";

    # Get All defined statuses Orders IDs for a defined product ID (or variation ID)
    return $wpdb->get_col( "
        SELECT DISTINCT woi.order_id
        FROM {$wpdb->prefix}woocommerce_order_itemmeta as woim, 
             {$wpdb->prefix}woocommerce_order_items as woi, 
             {$wpdb->prefix}posts as p
        WHERE  woi.order_item_id = woim.order_item_id
        AND woi.order_id = p.ID
        AND p.post_status IN ( $orders_statuses )
        AND woim.meta_key IN ( '_product_id', '_variation_id' )
        AND woim.meta_value LIKE '$product_id'
        ORDER BY woi.order_item_id DESC"
    );
}

