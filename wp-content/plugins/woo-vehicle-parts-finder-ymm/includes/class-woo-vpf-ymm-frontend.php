<?php
/**
 * Main WOO_VPF_YMM_Frontend Class
 *
 * @class WOO_VPF_YMM_Frontend
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WOO_VPF_YMM_Frontend {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		// Enqueue plugin styles and scripts
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_assets') );
	}

	/**
	 * Include the css & js script to frontend
	 *
	 * @return string
	 */
	public function enqueue_assets() {
		$woo_vpf_ymm_activate_chosen = WC_Admin_Settings::get_option( 'woo_vpf_ymm_activate_chosen' );
		if( $woo_vpf_ymm_activate_chosen == 'yes' ) {
			wp_enqueue_style('woo_vpf_ymm_chosen_style', WOO_VPF_YMM_PLUGIN_URL.'/assets/css/chosen.min.css');
			wp_enqueue_script( 'woo_vpf_ymm_chosen_script', WOO_VPF_YMM_PLUGIN_URL.'/assets/js/chosen.jquery.min.js', array('jquery') );
		}
		
		wp_enqueue_style('woo_vpf_ymm_colorbox_style', WOO_VPF_YMM_PLUGIN_URL.'/assets/css/colorbox.css');		
		wp_enqueue_script( 'woo_vpf_ymm_colorbox_script', WOO_VPF_YMM_PLUGIN_URL.'/assets/js/jquery.colorbox-min.js', array('jquery') );
		
		wp_enqueue_style('woo_vpf_ymm_front_style', WOO_VPF_YMM_PLUGIN_URL.'/assets/css/style.css');		
		wp_enqueue_script( 'woo_vpf_ymm_front_script', WOO_VPF_YMM_PLUGIN_URL.'/assets/js/scripts.js', array('jquery') );
		
		// Localize JS Params
		$woo_vpf_js_args = array(
			'ajax_url'	=> admin_url('admin-ajax.php'),
			'is_chosen'	=> $woo_vpf_ymm_activate_chosen
		);
		
		$js_args = array( 'disable_dependent_fields', 'activate_validation', 'validation_alert', 'validation_style', 'validate_year', 'validate_year_text', 'validate_make', 'validate_make_text', 'validate_model', 'validate_model_text', 'validate_engine', 'validate_engine_text', 'validate_category', 'validate_category_text', 'validate_keyword', 'validate_keyword_text' );
		
		if( ! empty( $js_args ) ) {
			foreach( $js_args as $js_arg ) {
				$woo_vpf_js_args[ $js_arg ] = WC_Admin_Settings::get_option( 'woo_vpf_ymm_' . $js_arg );
			}
		}
		
		$woo_vpf_ymm_args = apply_filters( 'woo_vpf_ymm_js_args', $woo_vpf_js_args );		
		wp_localize_script( 'woo_vpf_ymm_front_script', 'woo_vpf_ymm_params', $woo_vpf_ymm_args );
	}	
}

new WOO_VPF_YMM_Frontend();
