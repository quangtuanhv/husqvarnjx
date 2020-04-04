<?php
/**
 * Main WOO_VPF_YMM_Ajax Class
 *
 * @class WOO_VPF_YMM_Ajax
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WOO_VPF_YMM_Ajax {

	/**
	 * Hook in ajax handlers
	 */
	public static function init() {
		self::add_ajax_events();
	}
	
	/**
	 * Hook in methods - uses WordPress ajax handlers (admin-ajax)
	 */
	public static function add_ajax_events() {
		// WOO_VPF_YMM_EVENT => nopriv
		$ajax_events = array(
			'get_terms'		=> true,
			'reset_search'	=> true
		);

		foreach ( $ajax_events as $ajax_event => $nopriv ) {
			add_action( 'wp_ajax_woo_vpf_ymm_' . $ajax_event, array( __CLASS__, $ajax_event ) );

			if ( $nopriv ) {
				add_action( 'wp_ajax_nopriv_woo_vpf_ymm_' . $ajax_event, array( __CLASS__, $ajax_event ) );
			}
		}
	}
	
	/**
	 * AJAX - Get Terms
	 */
	public static function get_terms() {
		if( isset($_REQUEST['parent']) && $_REQUEST['parent'] > 0 ) {
			ob_start();
			WOO_VPF_YMM_Functions::get_terms_list( $_REQUEST['parent'] );
			echo ob_get_clean();
		}

		die();
	}
	
	/**
	 * AJAX - Clear/Reset User Search if Rememberd
	 */
	public static function reset_search() {
		if( !session_id() ) {
			session_start();
		}
		
		if( isset( $_SESSION['vpf_ymm']['search'] ) ) {
			unset( $_SESSION['vpf_ymm']['search'] );
		}

		die();
	}
}

WOO_VPF_YMM_Ajax::init();
