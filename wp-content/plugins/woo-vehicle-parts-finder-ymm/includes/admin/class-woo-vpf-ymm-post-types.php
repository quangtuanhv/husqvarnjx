<?php
/**
 * VPF (YMM) Quick Edit / Bulk Edit / Meta Boxes
 *
 * @class WOO_VPF_YMM_Post_Types
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WOO_VPF_YMM_Post_Types Class
 */
class WOO_VPF_YMM_Post_Types {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		// Post Columns
		add_filter( 'manage_product_posts_columns', array( __CLASS__, 'product_columns' ), 11 );
		
		// Quick Edit
		add_action( 'manage_product_posts_custom_column', array( __CLASS__, 'render_product_columns' ), 2 );
		add_action( 'woocommerce_product_quick_edit_end', array( __CLASS__, 'quick_edit' ) );
		
		// Bulk Edit
		add_action( 'woocommerce_product_bulk_edit_end', array( __CLASS__, 'bulk_edit' ) );
		
		// Save Post
		add_action( 'save_post', array( __CLASS__, 'save_post' ), 10, 2 );
		
		// Duplicate Product
		add_action( 'woocommerce_duplicate_product', array( __CLASS__, 'duplicate_product' ), 10, 2 );
	}
	
	/**
	 * Define custom columns for products
	 */
	public static function product_columns( $existing_columns ) {
		$new_columns = array();
		
		if( ! empty( $existing_columns ) ) {
			foreach( $existing_columns as $key => $value ) {
				if( $key == 'featured' ) {
					$new_columns['vpf_ymm_universal'] = __( 'Universal?', WOO_VPF_YMM_TEXT_DOMAIN );
				}
				
				$new_columns[ $key ] = $value;
			}
		}
		
		return $new_columns;
	}
	
	/**
	 * Quick Edit: Add Custom Columns for Product
	 */
	public static function render_product_columns( $column ) {
		global $post;

		switch ( $column ) {
			case 'vpf_ymm_universal' :
				$_universal = __( 'No', WOO_VPF_YMM_TEXT_DOMAIN );
				
				$woo_vpf_ymm_taxonomy_metabox_excluded_products = WC_Admin_Settings::get_option( 'woo_vpf_ymm_taxonomy_metabox_excluded_products' );
				if( ! empty( $woo_vpf_ymm_taxonomy_metabox_excluded_products ) ) {
					if( ! is_array( $woo_vpf_ymm_taxonomy_metabox_excluded_products ) ) {
						$woo_vpf_ymm_taxonomy_metabox_excluded_products = explode( ',', $woo_vpf_ymm_taxonomy_metabox_excluded_products );
					}
					
					if( in_array( $post->ID, $woo_vpf_ymm_taxonomy_metabox_excluded_products ) ) {
						$_universal = __( 'Yes', WOO_VPF_YMM_TEXT_DOMAIN );
					}
				}
				
				echo $_universal;
				
				/* Custom inline data for VPF ( YMM ) */
				echo '
					<div class="hidden" id="woo_vpf_ymm_inline_' . $post->ID . '">
						<div class="universal">' . strtolower( $_universal ) . '</div>
					</div>
				';
			break;
			
			default :
				break;
		}
	}
	
	/**
	 * Quick Edit: Add VPF Custom Options on Product Quick Edit
	 */
	public static function quick_edit() {
		?><div class="wp-clearfix"></div>
		
		<h4><?php _e( 'VPF (YMM)', 'woocommerce' ); ?></h4>
		
		<label>
			<span class="title"><?php _e( 'Universal Product?', WOO_VPF_YMM_TEXT_DOMAIN ); ?></span>
			<span class="input-text-wrap">
				<input type="checkbox" name="vpf_ymm_universal" value="1" />
			</span>
		</label><?php
	}
	
	/**
	 * Bulk Edit: Add VPF Custom Options on Product Bulk Edit
	 */
	public static function bulk_edit() {
		?><div class="wp-clearfix"></div>
		
		<h4><?php _e( 'VPF (YMM)', 'woocommerce' ); ?></h4>
		
		<label>
			<span class="title"><?php _e( 'Universal Product?', WOO_VPF_YMM_TEXT_DOMAIN ); ?></span>
			<span class="input-text-wrap">
				<select class="vpf_ymm_universal" name="vpf_ymm_universal">
					<?php
						$options = array(
							''		=> __( '— No Change —', WOO_VPF_YMM_TEXT_DOMAIN ),
							'yes'	=> __( 'Yes', WOO_VPF_YMM_TEXT_DOMAIN ),
							'no'	=> __( 'No', WOO_VPF_YMM_TEXT_DOMAIN )
						);
						
						foreach ( $options as $key => $value ) {
							echo '<option value="' . esc_attr( $key ) . '">'. $value .'</option>';
						}
					?>
				</select>
			</span>
		</label><?php
	}
	
	/**
	 * Bulk Edit: Save VPF Custom Options on Product Bulk Edit
	 */
	public static function save_post( $post_id, $post ) {
	
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Don't save revisions and autosaves
		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return $post_id;
		}

		// Check post type is product
		if ( 'product' != $post->post_type ) {
			return $post_id;
		}

		// Check user permission
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		// Check nonces
		if ( ! isset( $_REQUEST['woocommerce_quick_edit_nonce'] ) && ! isset( $_REQUEST['woocommerce_bulk_edit_nonce'] ) ) {
			return $post_id;
		}
		if ( isset( $_REQUEST['woocommerce_quick_edit_nonce'] ) && ! wp_verify_nonce( $_REQUEST['woocommerce_quick_edit_nonce'], 'woocommerce_quick_edit_nonce' ) ) {
			return $post_id;
		}
		if ( isset( $_REQUEST['woocommerce_bulk_edit_nonce'] ) && ! wp_verify_nonce( $_REQUEST['woocommerce_bulk_edit_nonce'], 'woocommerce_bulk_edit_nonce' ) ) {
			return $post_id;
		}
		
		// Save Field: Universal Product
		$_universal = '';
		
		if ( ! empty( $_REQUEST['woocommerce_quick_edit'] ) ) {
			if ( isset( $_REQUEST['vpf_ymm_universal'] ) ) {
				$_universal = 'yes';
			} else {
				$_universal = 'no';
			}
		} else {
			$_universal = $_REQUEST['vpf_ymm_universal'];
		}
		
		if ( ! empty( $_universal ) ) {
			
			$woo_vpf_ymm_taxonomy_metabox_excluded_products = WC_Admin_Settings::get_option( 'woo_vpf_ymm_taxonomy_metabox_excluded_products' );
			
			if( ! empty( $woo_vpf_ymm_taxonomy_metabox_excluded_products ) && ! is_array( $woo_vpf_ymm_taxonomy_metabox_excluded_products ) ) {
				$woo_vpf_ymm_taxonomy_metabox_excluded_products = explode( ',', $woo_vpf_ymm_taxonomy_metabox_excluded_products );
			}
		
			if ( $_universal == 'yes' ) {
				$woo_vpf_ymm_taxonomy_metabox_excluded_products[] = $post_id;
			} else {
				if( ! empty( $woo_vpf_ymm_taxonomy_metabox_excluded_products ) ) {
					if( ( $key = array_search( $post_id, $woo_vpf_ymm_taxonomy_metabox_excluded_products ) ) !== false ) {
						unset( $woo_vpf_ymm_taxonomy_metabox_excluded_products[ $key ] );
					}
				}
			}
			
			if( ! empty( $woo_vpf_ymm_taxonomy_metabox_excluded_products ) ) {
				$woo_vpf_ymm_taxonomy_metabox_excluded_products = array_unique( $woo_vpf_ymm_taxonomy_metabox_excluded_products );
			}
			
			update_option( 'woo_vpf_ymm_taxonomy_metabox_excluded_products', $woo_vpf_ymm_taxonomy_metabox_excluded_products );
		}

		return $post_id;
	}
	
	/**
	 * Duplicate Product: Duplicate Universal Product Option
	 */
	public static function duplicate_product( $new_post_id, $post ) {
		$post_id = $post->ID;
		
		$woo_vpf_ymm_taxonomy_metabox_excluded_products = WC_Admin_Settings::get_option( 'woo_vpf_ymm_taxonomy_metabox_excluded_products' );
			
		if( ! empty( $woo_vpf_ymm_taxonomy_metabox_excluded_products ) ) {
			
			if( ! is_array( $woo_vpf_ymm_taxonomy_metabox_excluded_products ) ) {
				$woo_vpf_ymm_taxonomy_metabox_excluded_products = explode( ',', $woo_vpf_ymm_taxonomy_metabox_excluded_products );
			}
			
			if( array_search( $post_id, $woo_vpf_ymm_taxonomy_metabox_excluded_products ) !== false ) {
				$woo_vpf_ymm_taxonomy_metabox_excluded_products[] = $new_post_id;
				
				if( ! empty( $woo_vpf_ymm_taxonomy_metabox_excluded_products ) ) {
					$woo_vpf_ymm_taxonomy_metabox_excluded_products = array_unique( $woo_vpf_ymm_taxonomy_metabox_excluded_products );
					update_option( 'woo_vpf_ymm_taxonomy_metabox_excluded_products', $woo_vpf_ymm_taxonomy_metabox_excluded_products );
				}
			}
		}
	}
	
}

new WOO_VPF_YMM_Post_Types();
