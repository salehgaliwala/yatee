<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>
<section id="espace-connexion">
		<!--	<img src="http://yatoo.fr/wp-content/uploads/2022/09/fond_connexion@2x-scaled.jpg" alt="Créez votre compte sur Yatoo" title="Créez votre compte sur Yatoo" class="rellax" data-rellax-speed="1" style="transform: translate3d(0px, 7px, 0px);">-->
			
			<h1 style="display: none">Connexion / Inscription à Yatoo</h1>

			<div class="zone">
				<div class="__connexion">
					<div class="logo" data-aos="fade-up"><svg id="Groupe_8168" data-name="Groupe 8168" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="116.424" height="38.821" viewBox="0 0 116.424 38.821" preserveAspectRatio="xMinYMin">
  <defs>
    <clipPath id="clip-path">
      <path id="Tracé_72400" data-name="Tracé 72400" d="M0-112.409H116.424V-151.23H0Z" transform="translate(0 151.23)" fill="#fff" />
    </clipPath>
  </defs>
  <g id="Groupe_3362" data-name="Groupe 3362" transform="translate(0 0)" clip-path="url(#clip-path)">
    <g id="Groupe_3357" data-name="Groupe 3357" transform="translate(92.182 5.035)">
      <path id="Tracé_72395" data-name="Tracé 72395" d="M-70.2-34.558A12.088,12.088,0,0,0-82.319-46.493,12.088,12.088,0,0,0-94.44-34.558,12.079,12.079,0,0,0-82.319-22.67,12.079,12.079,0,0,0-70.2-34.558m-5.342-.547c-.807,1.96-6.762,6.346-6.762,6.346s-5.974-4.36-6.79-6.316a3.837,3.837,0,0,1,2.066-5.018,3.835,3.835,0,0,1,4.7,1.47,3.836,3.836,0,0,1,4.7-1.491,3.838,3.838,0,0,1,2.088,5.009" transform="translate(94.44 46.493)" fill="#fff" />
    </g>
    <g id="Groupe_3358" data-name="Groupe 3358" transform="translate(66.71 5.035)">
      <path id="Tracé_72396" data-name="Tracé 72396" d="M-70.2-34.558A12.088,12.088,0,0,0-82.319-46.493,12.088,12.088,0,0,0-94.44-34.558,12.079,12.079,0,0,0-82.319-22.67,12.079,12.079,0,0,0-70.2-34.558m-14.577,4.506a.584.584,0,0,1-.584.584h-2.676a.584.584,0,0,1-.584-.584V-35.98a.584.584,0,0,1,.584-.584h2.676a.584.584,0,0,1,.584.584Zm8.207-4.563a1.279,1.279,0,0,1,.177,1.921,1.182,1.182,0,0,1-.338,1.848s.977,1.7-2.235,1.786h-.121c-.2,0-.407,0-.634-.011a13.979,13.979,0,0,1-4.008-.6.869.869,0,0,1-.572-.817v-4.925a.871.871,0,0,1,.453-.763,2.217,2.217,0,0,0,.239-.153,13.664,13.664,0,0,0,1.126-1.2,4.291,4.291,0,0,0,.951-2.005c.05-.348.1-.689.133-.917.054-.355.173-.7.53-.791a1.381,1.381,0,0,1,.331-.042h.017c.415.007.811.254.956,1.1a8.343,8.343,0,0,1-.41,3.488,10.168,10.168,0,0,1,2.7.16,1.25,1.25,0,0,1,.714.428,1.4,1.4,0,0,1-.008,1.492" transform="translate(94.44 46.493)" fill="#fff" />
    </g>
    <g id="Groupe_3359" data-name="Groupe 3359" transform="translate(0 5.781)">
      <path id="Tracé_72397" data-name="Tracé 72397" d="M-74.651,0s-4.1,11.1-5.874,15.9c-1.632,4.476-5.035,16.457-13.334,17.11a9.8,9.8,0,0,1-6.573-1.911l2.471-5.874c3.217,1.771,5.641-.559,7.133-4.429L-100.013,0h8.718l4.242,13.1L-83.229,0Z" transform="translate(100.432)" fill="#fff" />
    </g>
    <g id="Groupe_3360" data-name="Groupe 3360" transform="translate(25.28 5.035)">
      <path id="Tracé_72398" data-name="Tracé 72398" d="M-61.3-25.378v14.359h-7.832V-13.21a7.854,7.854,0,0,1-6.574,2.89c-1.305,0-6.574-.839-6.76-6.573-.14-4.849,3.124-7.04,6.387-7.6a57.641,57.641,0,0,1,6.947-.606A2.911,2.911,0,0,0-72.4-28.036a15.73,15.73,0,0,0-6.853,1.818L-81.394-31.3a19.111,19.111,0,0,1,9.977-2.844c4.988,0,10.117,1.865,10.117,8.765m-7.832,6.807V-21s-3.124-.14-4.476.839c-1.678,1.166-1.119,3.963,1.585,3.963,2.238,0,2.89-1.445,2.89-2.378" transform="translate(82.471 34.143)" fill="#fff" />
    </g>
    <g id="Groupe_3361" data-name="Groupe 3361" transform="translate(47.925 0)">
      <path id="Tracé_72399" data-name="Tracé 72399" d="M-34.025-37.123h5.781v-7.04h-5.781v-5.781H-41.9c0,5.781-3.872,5.781-3.872,5.781v7.04H-41.9v4.382c0,6.154.932,11.655,8.158,11.655a14.547,14.547,0,0,0,6.807-1.539l-1.725-6.434c-3.357,1.632-5.361.373-5.361-3.869Z" transform="translate(45.776 49.944)" fill="#fff" />
    </g>
  </g>
</svg>
</div>
					<h3 data-aos="fade-up" data-aos-delay="100">Heureux de vous retrouver</h3>
					<div id="show_connexion" data-aos="fade-up" data-aos-delay="800">Me connecter <i class="fa fa-angle-right"></i></div>
					<div id="social_connect" data-aos="fade-up" data-aos-delay="200">
						<div id="social_connect__facebook">
							<i class="fab fa-facebook-f"></i>
						</div>
						<div id="social_connect__google">
							<i class="fab fa-google"></i>
						</div>
					</div>
					<p data-aos="fade-up" data-aos-delay="300"> ou entrez vos informations</p>
					<?php wp_enqueue_script('bacola-loginform'); ?>
					<form data-aos="fade-up" data-aos-delay="400" method="post">
						<?php do_action( 'woocommerce_login_form_start' ); ?>
						<div class="form-group">
							
							<label for="email">Email</label>
							<input type="email" name="username" required id="email" placeholder="john.doe@gmail.com" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
						</div>
						<div class="form-group">
							
							<label for="password">Mot de passe</label>
							<input type="password" name="password" required id="password" placeholder="Mot de passe" />
						</div>
						<div class="forget">
							<a href="https://yatoo.fr/mon-compte/lost-password/" title="Mot de passe oublié">Mot de passe oublié</a>
						</div>
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
						<div class="submit">
							
							<button type="submit"  value="Log in" name="login" >Se connecter</button>
						</div>
						<?php do_action( 'woocommerce_login_form_end' ); ?>
					</form>
				</div>
				<div class="__inscription">
					<div class="icone" data-aos="fade-up" data-aos-delay="500">
						<i class="fas fa-star"></i>
					</div>
					<h3 data-aos="fade-up" data-aos-delay="600">Vous n'êtes pas encore inscrit.e ?</h3>
					<p data-aos="fade-up" data-aos-delay="700">Inscrivez-vous en quelques minutes pour commander sur Yahoo</p>
					<div id="show_inscription" data-aos="fade-up" data-aos-delay="800">M'inscrire</div>

					<form data-aos="fade-up" data-aos-delay="400" method="post"  class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
						<?php do_action( 'woocommerce_register_form_start' ); ?>
						<div class="form-group">
						
							<label for="email">Email</label>
							<input type="email" name="email" required id="email" placeholder="john.doe@gmail.com" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"/>
						</div>
						
						<?php do_action( 'woocommerce_register_form' ); ?>
						<p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'bacola' ); ?></p>
						<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
						<div class="submit">
							<button type="submit" name="register" value="<?php esc_attr_e( 'Register', 'bacola' ); ?>">Créer mon compte</button>
						</div>
								<?php do_action( 'woocommerce_register_form_end' ); ?>
					</form>

				</div>
			</div>
		</section>




<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
