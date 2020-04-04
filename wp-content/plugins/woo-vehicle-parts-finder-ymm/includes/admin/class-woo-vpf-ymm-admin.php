<?php
/**
 * Main WOO_VPF_YMM_Admin Class
 *
 * @class WOO_VPF_YMM_Admin
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WOO_VPF_YMM_Admin {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		// Enqueue plugin styles and scripts
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue_assets') );
	}

	/**
	 * Include the css & js script to admin
	 *
	 * @return string
	 */
	public function enqueue_assets() {
		wp_register_style('woo_vpf_ymm_admin_style', WOO_VPF_YMM_PLUGIN_URL.'/assets/css/admin/style.css');
		
		// Register Scripts
		wp_register_script( 'woo_vpf_ymm_admin_settings_script', WOO_VPF_YMM_PLUGIN_URL.'/assets/js/admin/settings.js', array('jquery') );
		
		wp_register_script( 'woo_vpf_ymm_admin_terms_droplist_script', WOO_VPF_YMM_PLUGIN_URL.'/assets/js/admin/terms_droplist.js', array('jquery') );
		wp_localize_script( 'woo_vpf_ymm_admin_terms_droplist_script', 'woo_vpf_ymm_tdl_params', array(
			'ajax_url'					=> admin_url('admin-ajax.php')
		) );
		
		wp_register_script( 'woo_vpf_ymm_admin_terms_meta_box_script', WOO_VPF_YMM_PLUGIN_URL.'/assets/js/admin/terms_meta_box.js', array('jquery') );
		wp_localize_script( 'woo_vpf_ymm_admin_terms_meta_box_script', 'woo_vpf_ymm_tmb_params', array(
			'ajax_url'					=> admin_url('admin-ajax.php'),
			'msg_confirm'				=> __( 'Are you sure?', WOO_VPF_YMM_TEXT_DOMAIN ),
		) );
		
		wp_register_script( 'woo_vpf_ymm_admin_terms_list_script', WOO_VPF_YMM_PLUGIN_URL.'/assets/js/admin/terms_list.js', array('jquery') );
		wp_localize_script( 'woo_vpf_ymm_admin_terms_list_script', 'woo_vpf_ymm_tl_params', array(
			'msg_delete_all_confirm'	=> __( 'Warning! Are you sure you want to delete all VPF ( YMM ) Terms?', WOO_VPF_YMM_TEXT_DOMAIN ),
		) );
		
		global $pagenow;
		
		if( $pagenow == 'admin.php' ) {
			if( ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] == 'wc-settings' ) && ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'woo_vpf_ymm' ) ) {
				wp_enqueue_style( 'woo_vpf_ymm_admin_style' );
				wp_enqueue_script( 'woo_vpf_ymm_admin_settings_script' );
			}
		}
		
		if( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
			$woo_vpf_ymm_taxonomy_metabox_template = WC_Admin_Settings::get_option( 'woo_vpf_ymm_taxonomy_metabox_template' );
			if( $woo_vpf_ymm_taxonomy_metabox_template == 'ajaxify_meta_box' ) {
				wp_enqueue_style( 'woo_vpf_ymm_admin_style' );
				wp_enqueue_script( 'woo_vpf_ymm_admin_terms_droplist_script' );
				wp_enqueue_script( 'woo_vpf_ymm_admin_terms_meta_box_script' );
			}
		}
		
		if( $pagenow == 'edit-tags.php' || $pagenow == 'term.php' ) {
			if( isset( $_REQUEST['taxonomy'] ) && $_REQUEST['taxonomy'] == 'product_ymm' ) {
				wp_enqueue_style( 'woo_vpf_ymm_admin_style' );
				wp_enqueue_script( 'woo_vpf_ymm_admin_terms_droplist_script' );
				wp_enqueue_script( 'woo_vpf_ymm_admin_terms_list_script' );
			}
		}
		
		// Product Quick Edit
		
		$screen			= get_current_screen();
		$screen_id		= $screen ? $screen->id : '';
		
		if ( in_array( $screen_id, array( 'edit-product' ) ) ) {
			wp_register_script( 'woo_vpf_ymm_admin_quick_edit', WOO_VPF_YMM_PLUGIN_URL.'/assets/js/admin/quick_edit.js', array( 'jquery' ) );
			wp_enqueue_script( 'woo_vpf_ymm_admin_quick_edit' );
		}
	}
}

new WOO_VPF_YMM_Admin();
