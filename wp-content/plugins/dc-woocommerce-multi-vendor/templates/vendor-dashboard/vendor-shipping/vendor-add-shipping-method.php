<?php
    global $WCMp;
    $vendor_shipping_methods = wcmp_get_shipping_methods();
?>
<div id="wcmp_shipping_method_add_container" class="collapse wcmp-modal-dialog">
    <div class="wcmp-modal">
        <div class="wcmp-modal-content" tabindex="0">
            <section class="wcmp-modal-main" role="main">
                <header class="wcmp-modal-header">
                    <h1><?php _e( 'Ajouter une méthode d\'expédition', 'dc-woocommerce-multi-vendor' ); ?></h1>
                    <button class="modal-close modal-close-link dashicons dashicons-no-alt">
                        <span class="screen-reader-text"><?php _e( 'Close modal panel', 'dc-woocommerce-multi-vendor' ); ?></span>
                    </button>
                </header>
                <article>
                    <form action="" method="post">
                        <div class="wc-shipping-zone-method-selector">
                            <p><?php _e( 'Choisissez la méthode d\'expédition que vous souhaitez ajouter. Seules les méthodes d\'expédition prenant en charge les zones sont répertoriées.', 'dc-woocommerce-multi-vendor' ); ?></p>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-9">
                                    <select id="shipping_method" class="form-control mt-15" name="wcmp_shipping_method">
                                        <?php foreach( $vendor_shipping_methods as $key => $method ) { 
                                            echo '<option data-description="' . esc_attr( wp_kses_post( wpautop( $method->get_method_description() ) ) ) . '" value="' . esc_attr( $method->id ) . '">' . esc_attr( $method->get_method_title() ) . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="wc-shipping-zone-method-description"><p><?php _e( 'Vous permet de facturer un tarif fixe pour l\'expédition.', 'dc-woocommerce-multi-vendor' ); ?></p></div>
                        </div>
                    </form>
                </article>
                <footer>
                    <div class="inner">
                        <button id="btn-ok" class="btn btn-default add-shipping-method"><?php _e( 'Ajouter une méthode d\'expédition', 'dc-woocommerce-multi-vendor' ); ?></button>
                    </div>
                </footer>
            </section>
        </div>
    </div>
    <div class="wcmp-modal-backdrop modal-close"></div>
</div>