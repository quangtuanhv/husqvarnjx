<?php
/**
 * Main WOO_VPF_YMM_Admin_Actions Class
 *
 * @class WOO_VPF_YMM_Admin_Actions
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WOO_VPF_YMM_Admin_Actions {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		// Save Terms
		add_action( 'admin_init', array( $this, 'save_terms' ) );
		
		// Delete All Terms
		add_action( 'admin_init', array( $this, 'delete_terms' ) );
		
		// Global Notices
		add_action( 'admin_notices', array( $this, 'term_notices' ) );
	}

	/**
	 * Save Terms
	 */
	public function save_terms() {
		if( isset( $_POST['action'] ) && $_POST['action'] == 'woo_vpf_ymm_manage_term' ) {
		
			if( ! isset( $_POST['term_name'] ) || empty( $_POST['term_name'] ) ) {
				return;
			}
				
			if( ! isset( $_POST['woo_vpf_ymm_noncename'] ) || ! wp_verify_nonce( $_POST['woo_vpf_ymm_noncename'], 'woo_vpf_ymm' ) ) {
				return;
			}
		
			$term_id = 0;
			if( isset( $_POST['term_id'] ) ) {
				$term_id = $_POST['term_id'];
			}
			
			$parent_id = 0;
			if( isset( $_REQUEST['parent_term_id'] ) ) {
				$_REQUEST['parent_term_id'] = array_filter( $_REQUEST['parent_term_id'] );
				$parent_id = end( $_REQUEST['parent_term_id'] );
			}
		
			$term_names = $_POST['term_name'];
			if( $term_id >  0 ) {
				$term_names = array( $term_names );
			} else {
				$term_names = explode( ',', $term_names );
			}			
			$term_names = array_map( 'sanitize_text_field', $term_names );
		
			foreach( $term_names as $term_name ) {
				$term_name = WOO_VPF_YMM_Functions::format_string( $term_name );
				
				if( ! empty( $term_name ) ) {
					
					// Check if term already exists
					$existing_term_id = WOO_VPF_YMM_Functions::term_exists( $term_name, $parent_id );
					
					if( $term_id >  0 ) {
						// Update existing term
						if( ! $existing_term_id || $existing_term_id == $term_id ) {
							$term = WOO_VPF_YMM_Functions::update_term( $term_id, $term_name, $parent_id );
							
							if ( is_wp_error( $term ) ) {
								$_SESSION['vpf_ymm']['messages'][] = array(
									'type'	=> 'error',
									'text'	=> sprintf( __( '<strong>%s</strong> - %s', WOO_VPF_YMM_TEXT_DOMAIN ), $term_name, $term->get_error_message() )
								);
							} else {
								$_SESSION['vpf_ymm']['messages'][] = array(
									'type'	=> 'success',
									'text'	=> sprintf( __( '<strong>%s</strong> - Term has been updated successfully.', WOO_VPF_YMM_TEXT_DOMAIN ), $term_name )
								);
								
								if( $term > 0 ) {
									clean_term_cache( $term, 'product_ymm' );
								}
							}
						} else {
							$_SESSION['vpf_ymm']['messages'][] = array(
								'type'	=> 'error',
								'text'	=> sprintf( __( '<strong>%s</strong> - A term with the name provided already exists with this parent.', WOO_VPF_YMM_TEXT_DOMAIN ), $term_name )
							);
						}
					} else {
						// Insert new term
						if( ! $existing_term_id ) {
							$term = WOO_VPF_YMM_Functions::insert_term( $term_name, $parent_id );
							
							if ( is_wp_error( $term ) ) {
								$_SESSION['vpf_ymm']['messages'][] = array(
									'type'	=> 'error',
									'text'	=> sprintf( __( '<strong>%s</strong> - %s', WOO_VPF_YMM_TEXT_DOMAIN ), $term_name, $term->get_error_message() )
								);
							} else {
								$_SESSION['vpf_ymm']['messages'][] = array(
									'type'	=> 'success',
									'text'	=> sprintf( __( '<strong>%s</strong> - Term has been added successfully.', WOO_VPF_YMM_TEXT_DOMAIN ), $term_name )
								);
								
								if( $term > 0 ) {
									clean_term_cache( $term, 'product_ymm' );
								}
							}
						} else {
							$_SESSION['vpf_ymm']['messages'][] = array(
								'type'	=> 'error',
								'text'	=> sprintf( __( '<strong>%s</strong> - A term with the name provided already exists with this parent.', WOO_VPF_YMM_TEXT_DOMAIN ), $term_name )
							);
						}
					}
				}
			}		
		}
	}
	
	/**
	 * Delete All Terms
	 */
	public function delete_terms() {
		if( isset( $_POST['vpf_action'] ) && $_POST['vpf_action'] == 'woo_vpf_ymm_delete_terms' ) {
			global $wpdb;
			
			$wpdb->query( "DELETE wtt, wt, wtr FROM `".$wpdb->prefix."term_taxonomy` wtt LEFT JOIN `".$wpdb->prefix."terms` wt ON wtt.`term_id`=wt.`term_id` LEFT JOIN `".$wpdb->prefix."term_relationships` wtr ON wtt.`term_taxonomy_id`=wtr.`term_taxonomy_id` WHERE wtt.`taxonomy`='product_ymm'");
			
			$_SESSION['vpf_ymm']['messages'][] = array(
				'type'	=> 'success',
				'text'	=> __( '<strong>Success</strong> - All VPF ( YMM ) Terms have been deleted successfully.', WOO_VPF_YMM_TEXT_DOMAIN )
			);
			
			wp_redirect( '?taxonomy=' . $_REQUEST['taxonomy'] . '&post_type=' . $_REQUEST['post_type'] );
			exit;
		}
	}
	
	/**
	 * Global Notices
	 */
	public function term_notices() {
		if( isset( $_SESSION['vpf_ymm']['messages'] ) && ! empty( $_SESSION['vpf_ymm']['messages'] ) ) {
			foreach( $_SESSION['vpf_ymm']['messages'] as $notice ) {
				if( isset( $notice['text'] ) && ! empty( $notice['text'] ) ) {
					?><div class="notice notice-<?php echo $notice['type']; ?>">
						<p><?php echo $notice['text']; ?></p>
					</div><?php
				}
			}
			
			unset( $_SESSION['vpf_ymm']['messages'] );
		}
	}
}

new WOO_VPF_YMM_Admin_Actions();
