<?php
/**
 * Plugin Name: WooCommerce Vehicle Parts Finder - Year/Make/Model/Engine/Category/Keyword
 * Description: A plugin to find Vehicles or Vehicle Parts on the website based on Year/Make/Model/Engine/Category/Keyword.
 * Version: 2.8
 * Author: The WP Instinct Team
 * Author URI: http://wpinstinct.com/
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WOO_Vehicle_Parts_Finder_YMM' ) ) :

/**
 * Main WOO_Vehicle_Parts_Finder_YMM Class
 *
 * @class WOO_Vehicle_Parts_Finder_YMM
 */
final class WOO_Vehicle_Parts_Finder_YMM {

	/**
	 * @var string
	 */
	public $version = '2.8';

	/**
	 * @var WOO_Vehicle_Parts_Finder_YMM The single instance of the class
	 */
	protected static $_instance = null;

	/**
	 * Main WOO_Vehicle_Parts_Finder_YMM Instance
	 *
	 * Ensures only one instance of WOO_Vehicle_Parts_Finder_YMM is loaded or can be loaded
	 *
	 * @see WOO_VPF_YMM()
	 * @return Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * WOO_Vehicle_Parts_Finder_YMM Constructor
	 * @access public
	 */
	public function __construct() {
	
		// Return if WooCommerce plugin is not activate
		if( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		
		if( ! ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) ) {
			return;
		}

		// Define constants
		$this->define_constants();
		
		// Include required files
		$this->includes();

		// Hooks
		add_action( 'init', array( $this, 'init' ), 0 );
		add_filter( 'plugin_action_links_' . WOO_VPF_YMM_PLUGIN_BASENAME, array( $this, 'plugin_action_links' ) );
	}


	/**
	 * Define WOO_VPF_YMM Constants
	 */
	private function define_constants() {
		define( 'WOO_VPF_YMM_PLUGIN_FILE', __FILE__ );
		define( 'WOO_VPF_YMM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		define( 'WOO_VPF_YMM_VERSION', $this->version );
		define( 'WOO_VPF_YMM_PLUGIN_URL', $this->plugin_url() );
		define( 'WOO_VPF_YMM_PLUGIN_PATH', $this->plugin_path() );
		define( 'WOO_VPF_YMM_TEXT_DOMAIN', 'woo_vpf_ymm' );
	}
	
	/**
	 * Include required core files
	 */
	private function includes() {
		include_once( 'includes/class-woo-vpf-ymm-functions.php' );
		include_once( 'includes/class-woo-vpf-ymm-hooks.php' );
		include_once( 'includes/admin/class-woo-vpf-ymm-taxonomies.php' );
		include_once( 'includes/admin/class-woo-vpf-ymm-widget-filter.php' );
		include_once( 'includes/admin/class-woo-vpf-ymm-shortcode-filter.php' );
		include_once( 'includes/class-woo-vpf-ymm-my-vehicles.php' );
		include_once( 'includes/class-woo-vpf-ymm-ajax.php' );
		
		if( !is_admin() ) {
			include_once( 'includes/class-woo-vpf-ymm-frontend.php' );
		}
		
		if( is_admin() ) {
			include_once( 'includes/admin/class-woo-vpf-ymm-admin.php' );
			include_once( 'includes/admin/class-woo-vpf-ymm-admin-actions.php' );
			include_once( 'includes/admin/class-woo-vpf-ymm-admin-menu.php' );
			include_once( 'includes/admin/class-woo-vpf-ymm-settings.php' );
			include_once( 'includes/admin/class-woo-vpf-ymm-post-types.php' );
			include_once( 'includes/admin/class-woo-vpf-ymm-taxonomy-terms-list.php' );
			include_once( 'includes/admin/class-woo-vpf-ymm-taxonomy-metabox-template.php' );
			include_once( 'includes/admin/class-woo-vpf-ymm-importers.php' );
		}
	}
	
	/**
	 * Load Localisation files
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'woo_vpf_ymm', false, plugin_basename( dirname( __FILE__ ) ) . "/i18n/languages" );
	}

	/**
	 * Get the plugin url
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}
	
	/**
	 * Get the plugin path
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Init Cards when WordPress Initialises
	 */
	public function init() {
		$this->load_plugin_textdomain();		
		do_action( 'woo_vpf_ymm_init' );
	}
	
	/**
	 * Show action links on the plugin screen.
	 *
	 * @param	mixed $links Plugin Action links
	 * @return	array
	 */
	public function plugin_action_links( $links ) {
		$action_links = array(
			'settings' => '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=woo_vpf_ymm' ) . '" title="' . esc_attr( __( 'View Settings', WOO_VPF_YMM_TEXT_DOMAIN ) ) . '">' . __( 'Settings', WOO_VPF_YMM_TEXT_DOMAIN ) . '</a>',
		);

		return array_merge( $action_links, $links );
	}

}

endif;

/**
 * Returns the main instance of WOO_Vehicle_Parts_Finder_YMM to prevent the need to use globals
 *
 * @return WOO_Vehicle_Parts_Finder_YMM
 */

function WOO_VPF_YMM() {
	return WOO_Vehicle_Parts_Finder_YMM::instance();
}

// Global for backwards compatibility.
$GLOBALS['woo_vpf_ymm'] = WOO_VPF_YMM();
