<?php
/**
 * Plugin Name: WooCommerce Category Accordion |  VestaThemes.com
 * Plugin URI: http://www.techieresource.com/product/woocommerce-category-accordion
 * Description: WooCommerce Category Accordion plugin list WooCommerce Categories into a Accordion menu with Toggle / Collapse options.
 * Version: 2.0
 * Author: TechieResource
 * Author URI: http://www.techieresource.com
 * Text Domain: trwca
 * Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*-----------------------------------------------------------------------------------*/
/* Check if WooCommerce is active */
/*-----------------------------------------------------------------------------------*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {	
    function trwca_install_woocommerce_admin_notice() {
?>
	<div class="message error">
           <p><?php printf( __( 'WooCommerce Category Accordion Plugin is enabled but not effective. It requires <a href="%s" target="_blank">WooCommerce</a> in order to work.', 'trwca' ),'https://wordpress.org/plugins/woocommerce/'); ?></p>            
        </div>
<?php
    }

    add_action( 'admin_notices', 'trwca_install_woocommerce_admin_notice' );

}

/*-----------------------------------------------------------------------------------*/
/*   INCLUDE FILES: WooCommerce Category Accordion Widget, shortcode, walker class   */
/*-----------------------------------------------------------------------------------*/

	require_once dirname( __FILE__ ) . '/inc/trwca-widget.php';
	require_once dirname( __FILE__ ) . '/inc/trwca-functions.php';
	require_once dirname( __FILE__ ) . '/inc/trwca-category-walker.php';


add_action('plugins_loaded', 'trwca_init');
add_action('wp_enqueue_scripts', 'reg_trwca_scripts');
add_filter('plugin_row_meta', 'trwca_row_meta', 10, 2);

/* Loads Plugin Text Domain */
function trwca_init(){
	
	load_plugin_textdomain( 'trwca', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );	
}	
	
/*-----------------------------------------------------------------------------------*/
/* Intialize Plugin scrits & styles */
/*-----------------------------------------------------------------------------------*/

function reg_trwca_scripts(){
	
	$trwca = plugins_url().'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	wp_enqueue_style('trwca-style', $trwca.'assets/css/trwca-style.min.css', array(), '1.0');
	wp_enqueue_style('icon-font', $trwca.'assets/css/font-awesome.min.css', array(), '1.0');
	wp_enqueue_script('trwca_script', $trwca.'assets/js/trwca-script.min.js', array('jquery'), '1.0');
	wp_enqueue_script('hoverIntent');

}
function trwca_row_meta($links, $file){
	if ($file == 'woocommerce-category-accordion/woocommerce-category-accordion.php'){ 
		   $links[] = '<a href="http://support.techieresource.com/docs/woocommerce-category-accordion/" target="_blank">' . __ ( 'Docs', 'trwca' ) . '</a>';
		   $links[] = '<a href="http://support.techieresource.com" target="_blank">' . __ ( 'Support', 'trwca' ) . '</a>';
	
  }  
  return $links;
}

?>