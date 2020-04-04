<?php
/**
 * Taxonomies
 *
 * Registers Taxonomies
 *
 * @class WOO_VPF_YMM_Taxonomies
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WOO_VPF_YMM_Taxonomies Class
 */
class WOO_VPF_YMM_Taxonomies {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		// Init based hooks
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 7 );
	}

	/**
	 * Register Taxonomies
	 */
	public static function register_taxonomies() {
		if ( taxonomy_exists( 'product_ymm' ) ) {
			return;
		}
		
		$woo_vpf_ymm_activate_quick_edit_terms = WC_Admin_Settings::get_option( 'woo_vpf_ymm_activate_quick_edit_terms' );
		$woo_vpf_ymm_taxonomy_metabox_template = WC_Admin_Settings::get_option( 'woo_vpf_ymm_taxonomy_metabox_template' );
		
		$args = array(
			'hierarchical'			=> true,
			'label'					=> __( 'VPF (YMM) Term', WOO_VPF_YMM_TEXT_DOMAIN ),
			'labels'				=> array(
				'name'				=> __( 'VPF (YMM) Terms', WOO_VPF_YMM_TEXT_DOMAIN ),
				'singular_name'		=> __( 'VPF (YMM) Term', WOO_VPF_YMM_TEXT_DOMAIN ),
				'menu_name'			=> _x( 'VPF (YMM) Terms', 'Admin menu name', WOO_VPF_YMM_TEXT_DOMAIN ),
				'search_items'		=> __( 'Search Terms', WOO_VPF_YMM_TEXT_DOMAIN ),
				'all_items'			=> __( 'All Terms', WOO_VPF_YMM_TEXT_DOMAIN ),
				'parent_item'		=> __( 'Parent Term', WOO_VPF_YMM_TEXT_DOMAIN ),
				'parent_item_colon'	=> __( 'Parent Term:', WOO_VPF_YMM_TEXT_DOMAIN ),
				'edit_item'			=> __( 'Edit Term', WOO_VPF_YMM_TEXT_DOMAIN ),
				'update_item'		=> __( 'Update Term', WOO_VPF_YMM_TEXT_DOMAIN ),
				'add_new_item'		=> __( 'Add New Term', WOO_VPF_YMM_TEXT_DOMAIN ),
				'new_item_name'		=> __( 'New Term', WOO_VPF_YMM_TEXT_DOMAIN ),
				'not_found'			=> __( 'No terms found.', WOO_VPF_YMM_TEXT_DOMAIN ),
			),
			'public'				=> false,
			'show_ui'				=> true,
			'show_in_menu'			=> true,
			'show_in_nav_menus'		=> false,
			'show_in_quick_edit'	=> ( $woo_vpf_ymm_activate_quick_edit_terms == 'yes' ? true : false ),
			'query_var'				=> true,
			'capabilities'			=> array(
				'manage_terms'		=> 'manage_product_terms',
				'edit_terms'		=> 'edit_product_terms',
				'delete_terms'		=> 'delete_product_terms',
				'assign_terms'		=> 'assign_product_terms',
			),
			'rewrite'				=> false,
		);
		
		if( $woo_vpf_ymm_taxonomy_metabox_template != 'default' && $woo_vpf_ymm_taxonomy_metabox_template != 'tree_view' ) {
			$args['meta_box_cb']	= false;
		}

		register_taxonomy( 'product_ymm', 'product', apply_filters( 'woo_vpf_ymm_register_taxonomy_args', $args ) );
	}
}

new WOO_VPF_YMM_Taxonomies();
