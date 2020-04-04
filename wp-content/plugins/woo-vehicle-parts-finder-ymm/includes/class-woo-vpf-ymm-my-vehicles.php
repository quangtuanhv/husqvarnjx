<?php
/**
 * Main WOO_VPF_YMM Class
 *
 * @class WOO_VPF_YMM_My_Vehicles
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WOO_VPF_YMM_My_Vehicles {

	/**
	 * @var woo_vpf_ymm_user_search_key
	 */
	public static $woo_vpf_ymm_user_search_key = 'woo_vpf_ymm_searches';
	
	/**
	 * @void has_filter_popup
	 */
	public static $has_filter_popup = false;
	
	/**
	 * @array terms
	 */
	public static $terms = array();

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', array( __CLASS__, 'init' ) );
	}
	
	/**
	 * Load MY VEHICLES Hooks
	 */
	public static function init() {
		// Check if MY VEHICLES setting is activated or not
		$is_activate_my_vehicles = WOO_VPF_YMM_Functions::is_activate_my_vehicles();
		if( $is_activate_my_vehicles != 'yes' ) {
			return;
		}
		
		// User Search Meta Key According to Current Language
		if( WOO_VPF_YMM_Functions::is_wpml_activated() ) {
			self::$woo_vpf_ymm_user_search_key .= '_' . ICL_LANGUAGE_CODE;
		}
		
		// Show MY VEHICLES template in filter widget
		add_action( 'woo_vpf_ymm_after_filter_widget', array( __CLASS__, 'widget_my_vehicles_template' ), 10 );
		
		// Save User New Search to Session/History
		add_action( 'woo_vpf_ymm_before_search_query', array( __CLASS__, 'save_user_new_search' ) );
		
		// Move User Searches from Session to History on Login
		add_action( 'wp_login', array( __CLASS__, 'save_user_searches_on_login' ), 10, 2 );
		
		// Ajax Requests
		self::ajax();
	}
	
	/**
	 * MY VEHICLES Ajax Requests
	 */
	public static function ajax() {
		// Move User Searches from History to Permanent Save
		add_action( 'wp_ajax_woo_vpf_ymm_save_search', array( __CLASS__, 'ajax_save_user_search' ) );
		
		// Delete User Search
		add_action( 'wp_ajax_woo_vpf_ymm_delete_search', array( __CLASS__, 'ajax_delete_user_search' ) );
		add_action( 'wp_ajax_nopriv_woo_vpf_ymm_delete_search', array( __CLASS__, 'ajax_delete_user_search' ) );
		
		// Clear History
		add_action( 'wp_ajax_woo_vpf_ymm_clear_history', array( __CLASS__, 'ajax_clear_history' ) );
		add_action( 'wp_ajax_nopriv_woo_vpf_ymm_clear_history', array( __CLASS__, 'ajax_clear_history' ) );
	}
	
	/**
	 * MY VEHICLES Template in VPF Widget Footer
	 *
	 * @param  array $args
	 * @return string/html
	 */
	public static function widget_my_vehicles_template( $args=array() ) {
		$args['type'] = apply_filters( 'woo_vpf_ymm_widget_my_vehicles_type', 'expandable' );
		self::get_template( $args );
	}
	
	/**
	 * MY VEHICLES Main Template
	 *
	 * @param  array $args
	 * @return string/html
	 */
	public static function get_template( $args=array() ) {
		$args = shortcode_atts( array(
        	'show_my_vehicles'	=> true,
        	'type'				=> 'expandable', // expandable, flyout
    	), $args );
		
		if( ! ( $args['show_my_vehicles'] == 1 || $args['show_my_vehicles'] === "true" ) ) {
			return;
		}
		
		// Get Labels
		$title						= WOO_VPF_YMM_Functions::get_my_vehicles_title();
		$save_title					= WOO_VPF_YMM_Functions::get_my_vehicles_save_title();
		$save_description			= WOO_VPF_YMM_Functions::get_my_vehicles_save_description();
		$save_clear_history_text	= WOO_VPF_YMM_Functions::get_my_vehicles_save_clear_history_text();
		$history_title				= WOO_VPF_YMM_Functions::get_my_vehicles_history_title();
		$history_description		= WOO_VPF_YMM_Functions::get_my_vehicles_history_description();
		$history_clear_history_text	= WOO_VPF_YMM_Functions::get_my_vehicles_history_clear_history_text();
		$add_vehicle_shortcode		= WOO_VPF_YMM_Functions::get_my_vehicles_add_vehicle_shortcode();
		
		// Get User Previous Searches
		$user_searches = self::get_user_searches();
		
		// Get Term Names
		if( ! empty( $user_searches ) ) {
			$term_ids = array();
			
			foreach( $user_searches as $user_searches_type ) {
				if( ! empty( $user_searches_type ) ) {
					foreach( $user_searches_type as $user_search ) {
						if( isset( $user_search['year_id'] ) && $user_search['year_id'] > 0 ) {
							$term_ids[] = $user_search['year_id'];
						}
			
						if( isset( $user_search['make'] ) && $user_search['make'] > 0 ) {
							$term_ids[] = $user_search['make'];
						}
			
						if( isset( $user_search['model'] ) && $user_search['model'] > 0 ) {
							$term_ids[] = $user_search['model'];
						}
			
						if( isset( $user_search['engine'] ) && $user_search['engine'] > 0 ) {
							$term_ids[] = $user_search['engine'];
						}
					}
				}
			}
			
			if( ! empty( $term_ids ) ) {
				self::$terms = get_terms( 'product_ymm', array(
					'include'		=> $term_ids,
					'hide_empty'	=> false,
					'fields'		=> 'id=>name'
				) );
			}
		}		
		
		// MY VEHICLES Template
		$classes = 'woo-vpf-ymm-mv-container';
		
		if( $args['type'] != '' ) {
			$classes .= ' mv-has-' . $args['type'] . '-wrapper';
		}
		?><div class="<?php echo $classes; ?>">
			
			<?php
				if( $args['type'] == 'expandable' || $args['type'] == 'flyout' ) {
					?><div class="mv-header">
						<?php $user_searches_count = self::get_user_searches_count(); ?>				
						<span class="mv-icon"><span class="mv-counter"><?php echo $user_searches_count; ?></span></span>
						
						<?php
							if( ! empty( $title ) ) {
								?><span class="mv-title"><?php echo $title; ?></span><?php
							}
						?>
					</div><?php
				}
			?>
			
			<div class="mv-inner">
			
				<?php
					if( is_user_logged_in() ) {
						?><div class="mv-section mv-section-vehicles-saved">
							<div class="mv-header">
								<div class="mv-title"><?php echo $save_title; ?></div>
								
								<?php
									if( ! empty( $save_description ) ) {
										?><div class="mv-description"><?php echo $save_description; ?></div><?php
									}
								?>
							</div>
					
							<?php
								$type = 'save';
								
								if( isset( $user_searches[ $type ] ) ) {
									$save_user_searches = $user_searches[ $type ];
								} else {
									$save_user_searches = array();
								}
								
								self::get_searches_list_template( $save_user_searches, $type );
							?>
							
							<?php
								if( ! empty( $save_user_searches ) ) {
									?><div class="mv-actions">
										<div class="mv-clear-history" data-search-type="save"><?php echo $save_clear_history_text; ?></div>
										<div class="woo-vpf-ymm-clearfix"></div>
									</div><?php
								}
							?>
						</div><?php
					}
				?>
				
				<div class="mv-section mv-section-vehicles-history">
					<div class="mv-header">
						<div class="mv-title"><?php echo $history_title; ?></div>
						
						<?php
							if( ! empty( $history_description ) ) {
								?><div class="mv-description"><?php echo $history_description; ?></div><?php
							}
						?>
					</div>
					
					<?php
						$type = 'history';
					
						if( isset( $user_searches[ $type ] ) ) {
							$history_user_searches = $user_searches[ $type ];
						} else {
							$history_user_searches = array();
						}
					
						self::get_searches_list_template( $history_user_searches, $type );
					?>
					
					<div class="mv-actions">
						<?php
							if( ! empty( $history_user_searches ) ) {
								?><div class="mv-clear-history" data-search-type="history"><?php echo $history_clear_history_text; ?></div><?php
							}
							
							if( ! empty( $add_vehicle_shortcode ) ) {
								$add_vehicle_text		= WOO_VPF_YMM_Functions::get_my_vehicles_add_vehicle_text();
								$add_vehicle_heading	= WOO_VPF_YMM_Functions::get_my_vehicles_add_vehicle_heading();
								
								?><div class="mv-add-vehicle" data-title="<?php echo $add_vehicle_heading; ?>"><?php echo $add_vehicle_text; ?></div><?php
							}
						?>
						
						<div class="woo-vpf-ymm-clearfix"></div>
					</div>
				</div>
				
				<div class="woo-vpf-ymm-loader"></div>
			</div>
			
			<?php
				if( ! empty( $add_vehicle_shortcode ) && ! self::$has_filter_popup ) {
					self::$has_filter_popup		= true;
					$add_vehicle_description	= WOO_VPF_YMM_Functions::get_my_vehicles_add_vehicle_description();					
					
					?><div class="woo-vpf-ymm-hidden">
						<div class="woo-vpf-ymm-modal" id="woo-vpf-ymm-modal-filter">
						
							<?php
								if( ! empty( $add_vehicle_description ) ) {
									?><div class="woo-vpf-ymm-modal-desc"><?php echo wpautop( $add_vehicle_description ); ?></div><?php
								}
							?>
							
							<?php echo do_shortcode( $add_vehicle_shortcode ); ?>
						</div>
					</div><?php
				}
			?>
		</div><?php
	}
	
	/**
	 * MY VEHICLES List Template
	 *
	 * @param  array $user_searches
	 * @param  string $type
	 * @return string/html
	 */
	public static function get_searches_list_template( $user_searches='', $type='' ) {
		if( $type === '' ) {
			return;
		}
		
		// MY VEHICLES List Template
		?><div class="mv-items">
			<?php
				$total_searches = 0;
				
				if( ! empty( $user_searches ) ) {
					$user_searches = array_reverse( $user_searches, true );
					
					?><ul><?php
						foreach( $user_searches as $key => $user_search ) {
							if( ! $user_search['year_id'] ) {
								continue;
							}
							
							// Item Classes
							$classes = 'mv-item';
							$is_current_search = false;
							$current_search = array();
							$term_levels = array_reverse( array( 'year_id', 'make', 'model', 'engine' ) );
							
							if( WOO_VPF_YMM_Functions::is_search() ) {
								$current_search = $_REQUEST;
							} else {
								$woo_vpf_ymm_activate_remember_search = WC_Admin_Settings::get_option( 'woo_vpf_ymm_activate_remember_search' );
								if( $woo_vpf_ymm_activate_remember_search == 'yes' && isset( $_SESSION['vpf_ymm']['search'] ) && ! empty( $_SESSION['vpf_ymm']['search'] ) ) {
									$current_search = $_SESSION['vpf_ymm']['search'];
								}
							}
							
							if( ! empty( $current_search ) ) {
								foreach( $term_levels as $term_level ) {
									if( ( isset( $current_search[ $term_level ] ) && $current_search[ $term_level ] > 0 ) || ( isset( $user_search[ $term_level ] ) && $user_search[ $term_level ] > 0 ) ) {
										if( isset( $current_search[ $term_level ] ) && isset( $user_search[ $term_level ] ) && $current_search[ $term_level ] == $user_search[ $term_level ] ) {
											$is_current_search = true;
										}
										
										break;
									}
								}
							}
							
							if( $is_current_search ) {
								$classes .= ' mv-active';
							}
							
							$total_searches++;
							
							// MY VEHICLES List Item Template
							?><li class="<?php echo $classes; ?>">
						
								<?php
									// Search URL and Title
									$search_title = '';									
									$search_url = esc_url( home_url( '/' ) ) . '?action=vpf-ymm-search&post_type=product';
								
									if( isset( $user_search['year_id'] ) && $user_search['year_id'] > 0 && isset( self::$terms[ $user_search['year_id'] ] ) ) {
										$search_title	.= self::$terms[ $user_search['year_id'] ] . ' ';
										$search_url		.= '&year_id=' . $user_search['year_id'];
									} else {
										$search_url		.= '&year_id=';
									}
		
									if( isset( $user_search['make'] ) && $user_search['make'] > 0 && isset( self::$terms[ $user_search['make'] ] ) ) {
										$search_title	.= self::$terms[ $user_search['make'] ] . ' ';
										$search_url		.= '&make=' . $user_search['make'];
									} else {
										$search_url		.= '&make=';
									}
		
									if( isset( $user_search['model'] ) && $user_search['model'] > 0 && isset( self::$terms[ $user_search['model'] ] ) ) {
										$search_title	.= self::$terms[ $user_search['model'] ] . ' ';
										$search_url		.= '&model=' . $user_search['model'];
									} else {
										$search_url		.= '&model=';
									}
		
									if( isset( $user_search['engine'] ) && $user_search['engine'] > 0 && isset( self::$terms[ $user_search['engine'] ] ) ) {
										$search_title	.= self::$terms[ $user_search['engine'] ] . ' ';
										$search_url		.= '&engine=' . $user_search['engine'];
									} else {
										$search_url		.= '&engine=';
									}
								
									$search_url = apply_filters( 'woo_vpf_ymm_my_vehicles_search_url', $search_url );
									$search_title = trim( $search_title );
								?>
							
								<div class="mv-item-col mv-item-title">
									<label>
								        <i class="mv-item-radio"></i>
								        <b><?php echo $search_title; ?></b>
								    </label>
								</div>
						
								<div class="mv-item-col mv-item-actions">
									
									<?php
										if( is_user_logged_in() && $type != 'save' ) {
											$text_save = apply_filters( 'woo_vpf_ymm_my_vehicles_save_button_text', __( 'Save', WOO_VPF_YMM_TEXT_DOMAIN ) );
											
											?><a class="mv-lnk mv-lnk-save" href="javascript:" data-search-type="<?php echo $type; ?>" data-search-id="<?php echo $key; ?>" alt="<?php echo $text_save; ?>" title="<?php echo $text_save; ?>"><?php echo $text_save; ?></a><?php
										}
									?>
									
									<?php $text_browse = apply_filters( 'woo_vpf_ymm_my_vehicles_browse_button_text', __( 'Browse', WOO_VPF_YMM_TEXT_DOMAIN ) ); ?>
									<a class="mv-lnk mv-lnk-browse" href="<?php echo $search_url; ?>" data-search-type="<?php echo $type; ?>" data-search-id="<?php echo $key; ?>" alt="<?php echo $text_browse; ?>" title="<?php echo $text_browse; ?>"><?php echo $text_browse; ?></a>
									
									<?php $text_delete = apply_filters( 'woo_vpf_ymm_my_vehicles_delete_button_text', __( 'Delete', WOO_VPF_YMM_TEXT_DOMAIN ) ); ?>
									<a class="mv-lnk mv-lnk-delete <?php if( $is_current_search ) { echo 'lnk-disable'; } ?>" href="javascript:" data-search-type="<?php echo $type; ?>" data-search-id="<?php echo $key; ?>" alt="<?php echo $text_delete; ?>" title="<?php echo $text_delete; ?>"><?php echo $text_delete; ?></a>
									
								</div>
							</li><?php
						}
					?></ul><?php
				}
		
				if( ! $total_searches ) {
					
					if( $type == 'save' ) {
						$no_item_text	= WOO_VPF_YMM_Functions::get_my_vehicles_save_no_item_text();
					} else {
						$no_item_text	= WOO_VPF_YMM_Functions::get_my_vehicles_history_no_item_text();
					}
		
					if( ! empty( $no_item_text ) ) {
						?><p class="mv-no-item"><?php echo $no_item_text; ?></p><?php
					}
				}
			?>
		</div><?php
	}
	
	/**
	 * Save User New Search to Session/History
	 *
	 * @param  array $search
	 * @return void
	 */
	public static function save_user_new_search( $search='' ) {
		if( $search === '' ) {
			return;
		}
		
		self::save_user_search( '', $search, 'history' );
	}
	
	/**
	 * Move User Searches from Session to History on Login
	 *
	 * @param  string $user_login
	 * @param  array $user
	 * @return void
	 */
	public static function save_user_searches_on_login( $user_login, $user ) {
		if( $user->ID ) {
			if( isset( $_SESSION['vpf_ymm']['search_histories'] ) ) {
				if( ! empty( $_SESSION['vpf_ymm']['search_histories'] ) ) {
					foreach( $_SESSION['vpf_ymm']['search_histories'] as $user_search ) {
						if( empty( $user_search['year_id'] ) || ! $user_search['year_id'] ) {
							continue;
						}
					
						self::save_user_search( $user->ID, $user_search, 'history' );
					}
				}
				
				unset( $_SESSION['vpf_ymm']['search_histories'] );
			}
		}
	}
	
	/**
	 * Get User Searches
	 *
	 * @param  string $user_id
	 * @return array $user_searches
	 */
	public static function get_user_searches( $user_id='' ) {
		if( ! $user_id && is_user_logged_in() ) {
			$user_id = get_current_user_id();
		}
		
		$user_searches = array();
		
		if( $user_id ) {
			$user_searches = get_user_meta( $user_id, self::$woo_vpf_ymm_user_search_key, true );
			
			if( ! empty( $user_searches ) ) {
				$user_searches = maybe_unserialize( $user_searches );
			}
		} else {
			if( isset( $_SESSION['vpf_ymm']['search_histories'] ) ) {
				$user_searches['history'] = $_SESSION['vpf_ymm']['search_histories'];
			}
		}
		
		return $user_searches;
	}
	
	/**
	 * Get User Searches Count
	 *
	 * @param  string $user_id
	 * @return array $user_searches
	 */
	public static function get_user_searches_count( $user_id='' ) {
		$user_searches_count = 0;
		$user_searches = self::get_user_searches();
		
		if( ! empty( $user_searches ) ) {
			$_user_searches = array();
			
			foreach( $user_searches as $user_searches_type ) {
				if( ! empty( $user_searches_type ) ) {
					foreach( $user_searches_type as $user_search ) {
						foreach( $user_search as $key => $val ) {
							if( ! $val || $val == '' ) {
								unset( $user_search[ $key ] );
							}
						}
						
						$user_search_key = implode( "_", $user_search );
						$_user_searches[ $user_search_key ] = $user_search;
					}
				}
			}
			
			$user_searches_count = count( $_user_searches );
		}
		
		return $user_searches_count;
	}
	
	/**
	 * Save User Search
	 *
	 * @param  array $user_id
	 * @param  array $search
	 * @param  string $type
	 * @return void
	 */
	public static function save_user_search( $user_id='', $search='', $type='history' ) {
		if( $search === '' ) {
			return;
		}
		
		if( $type === '' ) {
			return;
		}
		
		if( ! $user_id && is_user_logged_in() ) {
			$user_id = get_current_user_id();
		}
		
		// Fill Empty Keys with ZERO in Search Array
		foreach( $search as $key => $val ) {
			if( ! $val || $val == '' ) {
				$search[ $key ] = 0;
			}
		}
		
		// Get User Previous Searches
		$user_searches = self::get_user_searches( $user_id );
		
		if( empty( $user_searches ) ) {
			$user_searches = array();
		}
		
		$limit = WOO_VPF_YMM_Functions::get_my_vehicles_save_limit();
		
		if( $user_id ) {
			// Add Search to Buffer
			$user_searches[ $type ][] = $search;
			
			// Remove Duplicate Searches
			$user_searches[ $type ] = array_reverse( array_map( 'unserialize', array_unique( array_map( 'serialize', array_reverse( $user_searches[ $type ] ) ) ) ) );
			
			// Limit Number of Search Results
			if( count( $user_searches[ $type ] ) >= $limit ) {
				$user_searches[ $type ] = array_slice( $user_searches[ $type ], -( $limit ), $limit );
			}
			
			// Save Search
			update_user_meta( $user_id, self::$woo_vpf_ymm_user_search_key, $user_searches );
		} else {
			// Add/Save Search to Buffer
			$_SESSION['vpf_ymm']['search_histories'][] = $search;
			
			// Remove Duplicate Searches
			$_SESSION['vpf_ymm']['search_histories'] = array_reverse( array_map( 'unserialize', array_unique( array_map( 'serialize', array_reverse( $_SESSION['vpf_ymm']['search_histories'] ) ) ) ) );
			
			// Limit Number of Search Results
			if( count( $_SESSION['vpf_ymm']['search_histories'] ) >= $limit ) {
				$_SESSION['vpf_ymm']['search_histories'] = array_slice( $_SESSION['vpf_ymm']['search_histories'], -( $limit ), $limit );
			}
		}
	}
	
	/**
	 * Delete User Search
	 *
	 * @param  array $user_id
	 * @param  array $search
	 * @param  string $type
	 * @return void
	 */
	public static function delete_user_search( $user_id='', $search_id='', $type='history' ) {
		if( $search_id === '' ) {
			return;
		}
		
		if( $type === '' ) {
			return;
		}
		
		if( ! $user_id && is_user_logged_in() ) {
			$user_id = get_current_user_id();
		}
		
		$user_searches = self::get_user_searches( $user_id );
		if( ! empty( $user_searches ) ) {
			if( isset( $user_searches[ $type ][ $search_id ] ) ) {
				unset( $user_searches[ $type ][ $search_id ] );
				
				if( $user_id ) {
					update_user_meta( $user_id, self::$woo_vpf_ymm_user_search_key, $user_searches );
				} else {
					$user_searches = $user_searches[ $type ];
					$_SESSION['vpf_ymm']['search_histories'] = $user_searches;
				}
			}
		}
	}
	
	/**
	 * AJAX - Save User Searches from History to Permanent Save
	 */
	public static function ajax_save_user_search() {
		if( isset( $_REQUEST['search_id'] ) && $_REQUEST['search_id'] !== '' ) {
			$search_id = $_REQUEST['search_id'];
			
			$user_searches = self::get_user_searches();
			if( ! empty( $user_searches ) ) {
				if( isset( $user_searches['history'][ $search_id ] ) ) {
					$search = $user_searches['history'][ $search_id ];					
					self::save_user_search( '', $search, 'save' );
					
					ob_start();
					WOO_VPF_YMM_My_Vehicles::get_template();
					echo ob_get_clean();
				}
			}
		}

		die();
	}
	
	/**
	 * AJAX - Delete User Search
	 */
	public static function ajax_delete_user_search() {
		if( isset( $_REQUEST['search_id'] ) && $_REQUEST['search_id'] !== '' ) {
			$search_id = $_REQUEST['search_id'];
			$type = $_REQUEST['search_type'];
			
			self::delete_user_search( '', $search_id, $type );
			
			ob_start();
			WOO_VPF_YMM_My_Vehicles::get_template();
			echo ob_get_clean();
		}

		die();
	}
	
	/**
	 * AJAX - Clear History
	 */
	public static function ajax_clear_history() {
		if( isset( $_REQUEST['search_type'] ) && $_REQUEST['search_type'] !== '' ) {
			$type = $_REQUEST['search_type'];
			
			$user_id = '';
			if( is_user_logged_in() ) {
				$user_id = get_current_user_id();
			}
		
			$user_searches = self::get_user_searches( $user_id );
			if( ! empty( $user_searches ) ) {
				if( isset( $user_searches[ $type ] ) ) {
					unset( $user_searches[ $type ] );
				
					if( $user_id ) {
						update_user_meta( $user_id, self::$woo_vpf_ymm_user_search_key, $user_searches );
					} else {
						$user_searches = $user_searches[ $type ];
						$_SESSION['vpf_ymm']['search_histories'] = $user_searches;
					}
				}
			}
			
			ob_start();
			WOO_VPF_YMM_My_Vehicles::get_template();
			echo ob_get_clean();
		}

		die();
	}
}

new WOO_VPF_YMM_My_Vehicles();
