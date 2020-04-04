<?php
/**
 * Importers
 *
 * Setup importers for WOO_VPF_YMM_Taxonomies: product_ymm
 *
 * @class WOO_VPF_YMM_Importers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WOO_VPF_YMM_Importers' ) ) :

/**
 * WOO_VPF_YMM_Importers Class
 */
class WOO_VPF_YMM_Importers {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'register_importers' ) );
	}

	/**
	 * Add import tab to WordPress default importer list
	 */
	public function register_importers() {
		register_importer( 'woo_product_ymm_importer', __( 'WooCommerce VPF ( YMM ) Terms (CSV)', WOO_VPF_YMM_TEXT_DOMAIN ), __( 'Import <strong>VPF ( YMM ) Terms</strong> to your store via a csv file.', WOO_VPF_YMM_TEXT_DOMAIN), array( $this, 'product_ymm_importer' ) );
	}

	/**
	 * Callback for new import tab
	 */
	public function product_ymm_importer() {
		// Load Importer API
		require_once ABSPATH . 'wp-admin/includes/import.php';

		if ( ! class_exists( 'WP_Importer' ) ) {
			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

			if ( file_exists( $class_wp_importer ) ) {
				require $class_wp_importer;
			}
		}

		// includes
		require 'class-woo-vpf-ymm-product-ymm-importer.php';

		// Dispatch
		$importer = new WOO_VPF_YMM_Product_YMM_Importer();
		$importer->dispatch();
	}
}

endif;

return new WOO_VPF_YMM_Importers();
