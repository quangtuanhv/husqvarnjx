<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form class="woocomerce-form woocommerce-form-login login" method="post">

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

	<p class="form-row form-row-first form-group">
		<label class="info-title" for="username"><?php _e( 'Username or email', 'flipmart' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text" name="username" id="username" />
	</p>
	<p class="form-row form-row-last form-group">
		<label class="info-title" for="password"><?php _e( 'Password', 'flipmart' ); ?> <span class="required">*</span></label>
		<input class="input-text" type="password" name="password" id="password" />
	</p>
	<div class="clearfix"></div>

	<?php do_action( 'woocommerce_login_form' ); ?>
    <div class="form-group">
        <input class="woocommerce-form__input woocommerce-form__input-checkbox radio" name="rememberme" type="checkbox" id="rememberme" value="forever" /> 
        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline"><?php _e( 'Remember me', 'flipmart' ); ?></label>
    </div>
    
	<div class="form-row buttons-set11">
		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<button type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login', 'flipmart' ); ?>"><?php esc_html_e( 'Login', 'flipmart' ); ?></button>
        <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
	    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="forgot-password f-right pull-right"><?php _e( 'Lost your password?', 'flipmart' ); ?></a>
    </div>

	<div class="clearfix"></div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>