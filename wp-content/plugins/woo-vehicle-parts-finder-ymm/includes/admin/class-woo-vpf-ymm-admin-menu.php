<?php
/**
 * Main WOO_VPF_YMM_Admin_Menu Class
 *
 * @class WOO_VPF_YMM_Admin_Menu
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WOO_VPF_YMM_Admin_Menu {

	/**
	 * @var: vpf_ymm_menu
	 */
	public $vpf_ymm_menu;
	
	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		// Admin Main Menu: VPF ( YMM )
		add_action( 'admin_menu', array( $this, 'terms_main_menu' ), 5 );
	}

	/**
	 * Admin Main Menu: VPF ( YMM )
	 */
	public function terms_main_menu() {
		add_menu_page( __( 'VPF (YMM)', WOO_VPF_YMM_TEXT_DOMAIN ), __( 'VPF (YMM)', WOO_VPF_YMM_TEXT_DOMAIN ), 'manage_woocommerce', 'vpf_ymm_menu', array( $this, 'vpf_ymm_menu' ), '', 58 );
		
		$this->vpf_ymm_menu = add_submenu_page( 'vpf_ymm_menu', __( 'Terms', WOO_VPF_YMM_TEXT_DOMAIN ), __( 'Terms', WOO_VPF_YMM_TEXT_DOMAIN ), 'manage_woocommerce', 'vpf_ymm_menu', array( $this, 'vpf_ymm_menu' ) );
		
		add_action( 'admin_menu', array( $this, 'vpf_ymm_direct_menus' )  );
	}
	
	/**
	 * Admin Sub Menu: Years
	 */
	public function vpf_ymm_menu() {
		return;
	}
	
	/**
	 * Admin Sub Menu: Direct Menus ( Export AND Settings )
	 */
	public function vpf_ymm_direct_menus() {
		global $submenu;
		
		if( ! isset( $submenu['vpf_ymm_menu'] ) ) {
			return;
		}
		
		unset( $submenu['vpf_ymm_menu'][0] );
		
		$submenu['vpf_ymm_menu'][] = array( __( 'Terms', WOO_VPF_YMM_TEXT_DOMAIN ), 'manage_woocommerce', 'edit-tags.php?taxonomy=product_ymm&post_type=product' );
		
		$submenu['vpf_ymm_menu'][] = array( __( 'Import CSV', WOO_VPF_YMM_TEXT_DOMAIN ), 'manage_woocommerce', 'admin.php?import=woo_product_ymm_importer' );
		
		$submenu['vpf_ymm_menu'][] = array( __( 'Settings', WOO_VPF_YMM_TEXT_DOMAIN ), 'manage_woocommerce', 'admin.php?page=wc-settings&tab=woo_vpf_ymm' );
	}
}

new WOO_VPF_YMM_Admin_Menu();
