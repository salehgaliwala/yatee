<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="container">
    <div class="cart">
        <div class="recap">
            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>
                <div class="table">
                    <div class="thead">
                        <span></span>
                        <span><?php esc_html_e( 'Product', 'bacola' ); ?></span>
                        <span><?php esc_html_e( 'Price', 'bacola' ); ?></span>
                        <span><?php esc_html_e( 'Quantity', 'bacola' ); ?></span>
                        <span><?php esc_html_e( 'Subtotal', 'bacola' ); ?></span>
                    </div>
                    <div class="tbody">
                        <?php do_action( 'woocommerce_before_cart_contents' ); ?>
                        <?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
                        <div
                            class="line woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                            <span class="preview">
                                <div class="delete"><?php
											echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												'woocommerce_cart_item_remove_link',
												sprintf(
													'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="klbth-icon-cancel"></i></a>',
													esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
													esc_html__( 'Remove this item', 'bacola' ),
													esc_attr( $product_id ),
													esc_attr( $_product->get_sku() )
												),
												$cart_item_key
											);
										?></div>
                                <?php
													$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

													if ( ! $product_permalink ) {
														echo bacola_sanitize_data($thumbnail); // PHPCS: XSS ok.
													} else {
														printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
													}
													?>
                            </span>
                            <span class="product-name" data-title="<?php esc_attr_e( 'Product', 'bacola' ); ?>">
                                <?php
													if ( ! $product_permalink ) {
														echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
													} else {
														echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
													}

													do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

													// Meta data.
													echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

													// Backorder notification.
													if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
														echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'bacola' ) . '</p>', $product_id ) );
													}
													?>
                                <!-- <a href="producteur.php" class="lienproducteur">Maison Colibri</a>-->
                            </span>
                            <span class="product-price" data-title="<?php esc_attr_e( 'Price', 'bacola' ); ?>">
                                <div class="prix"><?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
										?></div>
                            </span>
                            <span class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'bacola' ); ?>">
                                <?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $_product->get_max_purchase_quantity(),
												'min_value'    => '0',
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
									?>
                            </span>
                            <span>
                                <div class="prix product-subtotal"
                                    data-title="<?php esc_attr_e( 'Subtotal', 'bacola' ); ?>"> <?php
											echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
										?></div>
                            </span>
                        </div>
                        <?php
							}
						}
						?>

                        <?php do_action( 'woocommerce_cart_contents' ); ?>
                    </div>
					 <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                </div>
                <?php do_action( 'woocommerce_after_cart_table' ); ?>
        </div>
        <div class="cart_confirm">
            <div class="box">
                <div class="top">
                    <div class="icone">
                        <i class="fas fa-star"></i>
                    </div>
                    <strong>Encore 20€ pour bénéficier d'une réduction de <em>10%</em></strong>
                </div>
                <div class="bottom">
                  <!--  <div class="line">
                        <label><?php esc_attr_e( 'Subtotal', 'bacola' ); ?></label>
                        <div><?php echo WC()->cart->get_subtotal(); ?><?php echo get_woocommerce_currency_symbol(); ?></div>
                    </div>
                    <div class="line">
                        <label><?php esc_attr_e( 'Shipping fees', 'bacola' ); ?></label>
                        <div>+ <?php echo  wc_price(WC()->cart->get_cart_shipping_total()) ?></div>
                    </div>
                    <div class="line promo">
                        <div class="montant">
							<?php
								  $discount_excl_tax_total = WC()->cart->get_cart_discount_total();
            					  $discount_tax_total = WC()->cart->get_cart_discount_tax_total();
            					$discount_total = $discount_excl_tax_total + $discount_tax_total;
								?>
                            <label><?php esc_html_e( 'Coupon:', 'bacola' ); ?></label>
                            <div>- <?php echo wc_price(-$discount_total) ?></div>
                        </div>
						<?php if ( wc_coupons_enabled() ) { ?>
                        
                            <input type="text"  name="coupon_code" required="" placeholder="<?php esc_attr_e( 'Coupon code', 'bacola' ); ?>" class="coupon_text"/>
                            <button type="submit" name="apply_coupon"
                                            value="<?php esc_attr_e( 'Apply coupon', 'bacola' ); ?>">Appliquer</button>
							 <?php do_action( 'woocommerce_cart_coupon' ); ?>
						<?php } ?>	
						  <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                    </div>-->
                    <div class="cart-collaterals">
                        <?php
                            /**
                             * Cart collaterals hook.
                             *
                             * @hooked woocommerce_cross_sell_display
                             * @hooked woocommerce_cart_totals - 10
                             */
                            do_action( 'woocommerce_cart_collaterals' );
                        ?>
                    </div>
                    <!--<div class="line total">
                        <label><?php esc_html_e( 'Total', 'bacola' ); ?></label>
                        <div><?php echo wc_price(WC()->cart->cart_contents_total) ?></div>
                    </div>-->
                    <div id="proceed">
						<?php 
						$checkout_page_id = wc_get_page_id( 'checkout' );
						$checkout_page_url = $checkout_page_id ? get_permalink( $checkout_page_id ) : '';
						?>
                        <a href="<?php echo $checkout_page_url ?>">Procéder au paiement</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?php do_action( 'woocommerce_after_cart' ); ?>