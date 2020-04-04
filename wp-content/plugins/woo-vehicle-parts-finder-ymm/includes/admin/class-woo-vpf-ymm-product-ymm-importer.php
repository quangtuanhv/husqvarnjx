<?php
/**
 * Importer
 *
 * Imports WOO_VPF_YMM_Taxonomies: product_ymm
 *
 * @class WOO_VPF_YMM_Product_YMM_Importer
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_Importer' ) ) {
	return;
}

/**
 * WOO_VPF_YMM_Product_YMM_Importer Class
 */
class WOO_VPF_YMM_Product_YMM_Importer extends WP_Importer {

	public $id;
	public $file_url;
	public $import_page;
	public $delimiter;

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		$this->import_page = 'woo_product_ymm_importer';
		$this->delimiter   = empty( $_POST['delimiter'] ) ? ',' : wc_clean( $_POST['delimiter'] );
	}

	/**
	 * Registered callback function for the WordPress Importer
	 *
	 * Manages the three separate stages of the CSV import process
	 */
	public function dispatch() {

		$this->header();

		$step = empty( $_GET['step'] ) ? 0 : (int) $_GET['step'];

		switch ( $step ) {

			case 0:
				$this->greet();
				break;

			case 1:
				check_admin_referer( 'import-upload' );

				if ( $this->handle_upload() ) {

					if ( $this->id ) {
						$file = get_attached_file( $this->id );
					} else {
						$file = ABSPATH . $this->file_url;
					}

					add_filter( 'http_request_timeout', array( $this, 'bump_request_timeout' ) );

					$this->import( $file );
				}
				break;
		}

		$this->footer();
	}

	/**
	 * Import is starting
	 */
	private function import_start() {
		if ( function_exists( 'gc_enable' ) ) {
			gc_enable();
		}
		if ( function_exists( 'set_time_limit' ) && false === strpos( ini_get( 'disable_functions' ), 'set_time_limit' ) && ! ini_get( 'safe_mode' ) ) {
			@set_time_limit( 0 );
		}
		@ob_flush();
		@flush();
		@ini_set( 'auto_detect_line_endings', '1' );
	}

	/**
	 * format_data_from_csv function.
	 *
	 * @param mixed $data
	 * @param string $enc
	 * @return string
	 */
	public function format_data_from_csv( $data, $enc ) {
		return ( $enc == 'UTF-8' ) ? $data : utf8_encode( $data );
	}

	/**
	 * import function.
	 *
	 * @param mixed $file
	 */
	public function import( $file ) {
		if ( ! is_file( $file ) ) {
			$this->import_error( __( 'The file does not exist, please try again.', WOO_VPF_YMM_TEXT_DOMAIN ) );
		}
		
		$this->import_start();
		
		$_loop = 0;
		$_messages = array();

		if ( ( $handle = fopen( $file, "r" ) ) !== false ) {
			$header = fgetcsv( $handle, 0, $this->delimiter );
			
			if ( sizeof( $header ) >= 3 && sizeof( $header ) <= 5 ) {
			
				$terms_imported = array();
				
				$have_engines = false;
				$have_products = false;
					
				if ( sizeof( $header ) >= 5 ) {
					$have_products = true;
				}

				if ( sizeof( $header ) >= 4 ) {
					$have_engines = true;
				}
				
				$woo_vpf_ymm_csv_product_col = WC_Admin_Settings::get_option( 'woo_vpf_ymm_csv_product_col' );
				
				while ( ( $row = fgetcsv( $handle, 0, $this->delimiter ) ) !== false ) {
				
					$_loop++;
				
					if ( 5 === sizeof( $header ) ) {
						list( $year_names, $make_names, $model_names, $engine_names, $product_names ) = $row;
					} else if ( 4 === sizeof( $header ) ) {
						list( $year_names, $make_names, $model_names, $engine_names ) = $row;
					} else {
						list( $year_names, $make_names, $model_names ) = $row;
					}
					
					// Check if column has comma separated support or not
					$woo_vpf_ymm_csv_comma_separated_cols = WC_Admin_Settings::get_option( 'woo_vpf_ymm_csv_comma_separated_cols' );
					if( ! empty( $woo_vpf_ymm_csv_comma_separated_cols ) ) {
						
						if( in_array( 'year', $woo_vpf_ymm_csv_comma_separated_cols ) && $year_names != '' ) {
							$year_names = explode( ",", $year_names );
						}
						
						if( in_array( 'make', $woo_vpf_ymm_csv_comma_separated_cols ) && $make_names != '' ) {
							$make_names = explode( ",", $make_names );
						}
						
						if( in_array( 'model', $woo_vpf_ymm_csv_comma_separated_cols ) && $model_names != '' ) {
							$model_names = explode( ",", $model_names );
						}
						
						if( $have_engines ) {
							if( in_array( 'engine', $woo_vpf_ymm_csv_comma_separated_cols ) && $engine_names != '' ) {
								$engine_names = explode( ",", $engine_names );
							}
						}
						
						if( $have_products ) {
							if( in_array( 'product', $woo_vpf_ymm_csv_comma_separated_cols ) && $product_names != '' ) {
								$product_names = explode( ",", $product_names );
							}
						}
					}
					
					if( ! is_array( $year_names ) ) {
						$year_names = (array) $year_names;
					}
					
					if( ! is_array( $make_names ) ) {
						$make_names = (array) $make_names;
					}
					
					if( ! is_array( $model_names ) ) {
						$model_names = (array) $model_names;
					}
					
					if( $have_engines ) {
						if( ! is_array( $engine_names ) ) {
							$engine_names = (array) $engine_names;
						}
					}
					
					if( $have_products ) {
						if( ! is_array( $product_names ) ) {
							$product_names = (array) $product_names;
						}
					}
					
					// Check if column has range support or not
					$woo_vpf_ymm_csv_range_supported_cols = WC_Admin_Settings::get_option( 'woo_vpf_ymm_csv_range_supported_cols' );
					if( ! empty( $woo_vpf_ymm_csv_range_supported_cols ) ) {
						
						if( in_array( 'year', $woo_vpf_ymm_csv_range_supported_cols ) && ! empty( $year_names ) ) {
							$year_names_new = array(); $year_range_error = '';
							
							foreach( $year_names as $year_name ) {
								$year_name = WOO_VPF_YMM_Functions::format_string( $year_name );
								if( $year_name != '' ) {
									$year_name = explode( "-", $year_name );
									if( sizeof( $year_name ) == 2 && is_numeric( trim( $year_name[0] ) ) && is_numeric( trim( $year_name[1] ) ) ) {
										$year_name[0] = trim( $year_name[0] );
										$year_name[1] = trim( $year_name[1] );
											
										$year_start_range = '';
										$year_end_range = '';
										if( $year_name[1] > $year_name[0] ) {
											$year_start_range = $year_name[0];
											$year_end_range = $year_name[1];
										} else {
											$year_start_range = $year_name[1];
											$year_end_range = $year_name[0];
										}
										
										if( ( $year_end_range - $year_start_range ) > 100 ) {
											$year_range_error = sprintf( __( 'Row %s: Invalid Year Range', WOO_VPF_YMM_TEXT_DOMAIN ), $_loop+1 );
											break;
										}
										
										for( $i=$year_start_range; $i<=$year_end_range; $i++ ) {
											$year_names_new[] = $i;
										}
									} else {
										$year_names_new[] = implode( "-", $year_name );
									}
								}
							}
							
							if( $year_range_error != '' ) {
								$_messages[] = array(
									'type'	=> 'error',
									'text'	=> $year_range_error
								);
					
								continue;
							}
							
							if( ! empty( $year_names_new ) ) {
								$year_names = $year_names_new;
							}
						}
						
						if( in_array( 'make', $woo_vpf_ymm_csv_range_supported_cols ) && ! empty( $make_names ) ) {
							$make_names_new = array(); $make_range_error = '';
							
							foreach( $make_names as $make_name ) {
								$make_name = WOO_VPF_YMM_Functions::format_string( $make_name );
								if( $make_name != '' ) {
									$make_name = explode( "-", $make_name );
									if( sizeof( $make_name ) == 2 && is_numeric( trim( $make_name[0] ) ) && is_numeric( trim( $make_name[1] ) ) ) {
										$make_name[0] = trim( $make_name[0] );
										$make_name[1] = trim( $make_name[1] );
											
										$make_start_range = '';
										$make_end_range = '';
										if( $make_name[1] > $make_name[0] ) {
											$make_start_range = $make_name[0];
											$make_end_range = $make_name[1];
										} else {
											$make_start_range = $make_name[1];
											$make_end_range = $make_name[0];
										}
										
										if( ( $make_end_range - $make_start_range ) > 100 ) {
											$make_range_error = sprintf( __( 'Row %s: Invalid Make Range', WOO_VPF_YMM_TEXT_DOMAIN ), $_loop+1 );
											break;
										}
										
										for( $i=$make_start_range; $i<=$make_end_range; $i++ ) {
											$make_names_new[] = $i;
										}
									} else {
										$make_names_new[] = implode( "-", $make_name );
									}
								}
							}
							
							if( $make_range_error != '' ) {
								$_messages[] = array(
									'type'	=> 'error',
									'text'	=> $make_range_error
								);
					
								continue;
							}
							
							if( ! empty( $make_names_new ) ) {
								$make_names = $make_names_new;
							}
						}
						
						if( in_array( 'model', $woo_vpf_ymm_csv_range_supported_cols ) && ! empty( $model_names ) ) {
							$model_names_new = array(); $model_range_error = '';
							
							foreach( $model_names as $model_name ) {
								$model_name = WOO_VPF_YMM_Functions::format_string( $model_name );
								if( $model_name != '' ) {
									$model_name = explode( "-", $model_name );
									if( sizeof( $model_name ) == 2 && is_numeric( trim( $model_name[0] ) ) && is_numeric( trim( $model_name[1] ) ) ) {
										$model_name[0] = trim( $model_name[0] );
										$model_name[1] = trim( $model_name[1] );
											
										$model_start_range = '';
										$model_end_range = '';
										if( $model_name[1] > $model_name[0] ) {
											$model_start_range = $model_name[0];
											$model_end_range = $model_name[1];
										} else {
											$model_start_range = $model_name[1];
											$model_end_range = $model_name[0];
										}
										
										if( ( $model_end_range - $model_start_range ) > 100 ) {
											$model_range_error = sprintf( __( 'Row %s: Invalid Model Range', WOO_VPF_YMM_TEXT_DOMAIN ), $_loop+1 );
											break;
										}
										
										for( $i=$model_start_range; $i<=$model_end_range; $i++ ) {
											$model_names_new[] = $i;
										}
									} else {
										$model_names_new[] = implode( "-", $model_name );
									}
								}
							}
							
							if( $model_range_error != '' ) {
								$_messages[] = array(
									'type'	=> 'error',
									'text'	=> $model_range_error
								);
					
								continue;
							}
							
							if( ! empty( $model_names_new ) ) {
								$model_names = $model_names_new;
							}
						}
						
						if( $have_engines ) {
							if( in_array( 'engine', $woo_vpf_ymm_csv_range_supported_cols ) && ! empty( $engine_names ) ) {
								$engine_names_new = array(); $engine_range_error = '';
								
								foreach( $engine_names as $engine_name ) {
									$engine_name = WOO_VPF_YMM_Functions::format_string( $engine_name );
									if( $engine_name != '' ) {
										$engine_name = explode( "-", $engine_name );
										if( sizeof( $engine_name ) == 2 && is_numeric( trim( $engine_name[0] ) ) && is_numeric( trim( $engine_name[1] ) ) ) {
											$engine_name[0] = trim( $engine_name[0] );
											$engine_name[1] = trim( $engine_name[1] );
												
											$engine_start_range = '';
											$engine_end_range = '';
											if( $engine_name[1] > $engine_name[0] ) {
												$engine_start_range = $engine_name[0];
												$engine_end_range = $engine_name[1];
											} else {
												$engine_start_range = $engine_name[1];
												$engine_end_range = $engine_name[0];
											}
											
											if( ( $engine_end_range - $engine_start_range ) > 100 ) {
												$engine_range_error = sprintf( __( 'Row %s: Invalid Engine Range', WOO_VPF_YMM_TEXT_DOMAIN ), $_loop+1 );
												break;
											}
											
											for( $i=$engine_start_range; $i<=$engine_end_range; $i++ ) {
												$engine_names_new[] = $i;
											}
										} else {
											$engine_names_new[] = implode( "-", $engine_name );
										}
									}
								}
								
								if( $engine_range_error != '' ) {
									$_messages[] = array(
										'type'	=> 'error',
										'text'	=> $engine_range_error
									);
						
									continue;
								}
								
								if( ! empty( $engine_names_new ) ) {
									$engine_names = $engine_names_new;
								}
							}
						}
					}
					
					$term_ids = array();
					
					// 1. Create Term: Year
					if( ! empty( $year_names ) ) {
						foreach( $year_names as $year_name ) {
							$term_year_id = '';
					
							$year_name = WOO_VPF_YMM_Functions::format_string( $year_name );
							if( $year_name != '' ) {
								$year_name_slug = $this->create_slug( $year_name );
											
								// Check if term already exists
								if( ! empty( $terms_imported ) && isset( $terms_imported[$year_name_slug]['term_id'] ) ) {
									$term_year_id = $terms_imported[$year_name_slug]['term_id'];
								} else {
									$parent_id = 0;
									$term_year = WOO_VPF_YMM_Functions::term_exists( $year_name, $parent_id );
									if( ! $term_year ) {
										// Insert new term
										$term_year = WOO_VPF_YMM_Functions::insert_term( $year_name, $parent_id );
										if ( is_wp_error( $term_year ) ) {
											$_messages[] = array(
												'type'	=> 'error',
												'text'	=> sprintf( __( '<strong>%s</strong> - %s', WOO_VPF_YMM_TEXT_DOMAIN ), $year_name, $term_year->get_error_message() )
											);
								
											continue;
										}
									}
							
									$term_year_id = $term_year;
								}
							}
							
							// 2. Create Term: Make
							if( $term_year_id > 0 ) {
								$term_ids[] = $term_year_id;
								$terms_imported[$year_name_slug]['term_id'] = $term_year_id;
									
								if( ! empty( $make_names ) ) {
									foreach( $make_names as $make_name ) {
										$term_make_id = '';
					
										$make_name = WOO_VPF_YMM_Functions::format_string( $make_name );
										if( $make_name != '' ) {
											$make_name_slug = $this->create_slug( $make_name );
						
											// Check if term already exists
											if( ! empty( $terms_imported ) && isset( $terms_imported[$year_name_slug][$make_name_slug]['term_id'] ) ) {
												$term_make_id = $terms_imported[$year_name_slug][$make_name_slug]['term_id'];
											} else {
												$parent_id = $term_year_id;
												$term_make = WOO_VPF_YMM_Functions::term_exists( $make_name, $parent_id );
												if( ! $term_make ) {
													// Insert new term
													$term_make = WOO_VPF_YMM_Functions::insert_term( $make_name, $parent_id );
													if ( is_wp_error( $term_make ) ) {
														$_messages[] = array(
															'type'	=> 'error',
															'text'	=> sprintf( __( '<strong>%s</strong> - %s', WOO_VPF_YMM_TEXT_DOMAIN ), $make_name, $term_make->get_error_message() )
														);
								
														continue;
													}
												}
							
												$term_make_id = $term_make;
											}
										}
										
										// 3. Create Term: Model
										if( $term_make_id > 0 ) {
											$term_ids[] = $term_make_id;
											$terms_imported[$year_name_slug][$make_name_slug]['term_id'] = $term_make_id;
												
											if( ! empty( $model_names ) ) {
												foreach( $model_names as $model_name ) {
													$term_model_id = '';
		
													$model_name = WOO_VPF_YMM_Functions::format_string( $model_name );					
													if( $model_name != '' ) {
														$model_name_slug = $this->create_slug( $model_name );
			
														// Check if term already exists
														if( ! empty( $terms_imported ) && isset( $terms_imported[$year_name_slug][$make_name_slug][$model_name_slug]['term_id'] ) ) {
															$term_model_id = $terms_imported[$year_name_slug][$make_name_slug][$model_name_slug]['term_id'];
														} else {
															$parent_id = $term_make_id;
															$term_model = WOO_VPF_YMM_Functions::term_exists( $model_name, $parent_id );
															if( ! $term_model ) {
																// Insert new term
																$term_model = WOO_VPF_YMM_Functions::insert_term( $model_name, $parent_id );
																if ( is_wp_error( $term_model ) ) {
																	$_messages[] = array(
																		'type'	=> 'error',
																		'text'	=> sprintf( __( '<strong>%s</strong> - %s', WOO_VPF_YMM_TEXT_DOMAIN ), $model_name, $term_model->get_error_message() )
																	);
					
																	continue;
																}
															}
				
															$term_model_id = $term_model;
														}
													}
													
													// 4. Create Term: Engine
													if( $term_model_id > 0 ) {
														$term_ids[] = $term_model_id;
														$terms_imported[$year_name_slug][$make_name_slug][$model_name_slug]['term_id'] = $term_model_id;
															
														if( $have_engines ) {
															if( ! empty( $engine_names ) ) {
																foreach( $engine_names as $engine_name ) {
																	$term_engine_id = '';

																	$engine_name = WOO_VPF_YMM_Functions::format_string( $engine_name );						
																	if( $engine_name != '' ) {
																		$engine_name_slug = $this->create_slug( $engine_name );
	
																		// Check if term already exists
																		if( ! empty( $terms_imported ) && isset( $terms_imported[$year_name_slug][$make_name_slug][$model_name_slug][$engine_name_slug]['term_id'] ) ) {
																			$term_engine_id = $terms_imported[$year_name_slug][$make_name_slug][$model_name_slug][$engine_name_slug]['term_id'];
																		} else {
																			$parent_id = $term_model_id;
																			$term_engine = WOO_VPF_YMM_Functions::term_exists( $engine_name, $parent_id );
																			if( ! $term_engine ) {
																				// Insert new term
																				$term_engine = WOO_VPF_YMM_Functions::insert_term( $engine_name, $parent_id );
																				if ( is_wp_error( $term_engine ) ) {
																					$_messages[] = array(
																						'type'	=> 'error',
																						'text'	=> sprintf( __( '<strong>%s</strong> - %s', WOO_VPF_YMM_TEXT_DOMAIN ), $engine_name, $term_engine->get_error_message() )
																					);
			
																					continue;
																				}
																			}
		
																			$term_engine_id = $term_engine;
																		}
																	}
																	
																	if( $term_engine_id > 0 ) {
																		$term_ids[] = $term_engine_id;
																		$terms_imported[$year_name_slug][$make_name_slug][$model_name_slug][$engine_name_slug]['term_id'] = $term_engine_id;
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
					
					
					// 5. Create Product-Term Relation
					if( $have_products ) {
						if( ! empty( $term_ids ) ) {						
							$product_id = '';
						
							if( ! empty( $product_names ) ) {
								foreach( $product_names as $product_name ) {
									$product_name = WOO_VPF_YMM_Functions::format_string( $product_name );
									if( $product_name != '' ) {
										if( ! empty( $terms_imported ) && isset( $terms_imported['products'][$product_name]['product_id'] ) ) {
											$product_id = $terms_imported['products'][$product_name]['product_id'];
										} else {
											if( $woo_vpf_ymm_csv_product_col == 'sku' ) {
												$product_id = $this->get_product_id_by_sku( $product_name );
											} else {
												$product_id = $this->get_product_id_by_slug( $product_name );
											}
											
											$terms_imported['products'][$product_name]['product_id'] = $product_id;
										}
									}
								
									if( $product_id > 0 ) {
										$term_ids = array_map( 'intval', $term_ids );
										$term_ids = array_unique( $term_ids );
										$response_term_ids = wp_set_object_terms( $product_id, $term_ids, 'product_ymm', true );
									
										if ( is_wp_error( $response_term_ids ) ) {
											$_messages[] = array(
												'type'	=> 'error',
												'text'	=> sprintf( __( '<strong>%s</strong> - %s', WOO_VPF_YMM_TEXT_DOMAIN ), $product_name, $response_term_ids->get_error_message() )
											);
									
											continue;
										}
									}
								}
							}
						}
					}
				}
				
				if( isset( $term_year_id ) && $term_year_id > 0 ) {
					clean_term_cache( $term_year_id, 'product_ymm' );
				}
				
				if( isset( $term_make_id ) && $term_make_id > 0 ) {
					clean_term_cache( $term_make_id, 'product_ymm' );
				}
				
				if( isset( $term_model_id ) && $term_model_id > 0 ) {
					clean_term_cache( $term_model_id, 'product_ymm' );
				}
				
				if( isset( $term_engine_id ) && $term_engine_id > 0 ) {
					clean_term_cache( $term_engine_id, 'product_ymm' );
				}
			} else {
				$this->import_error( __( 'The CSV is invalid.', WOO_VPF_YMM_TEXT_DOMAIN ) );
			}

			fclose( $handle );
		}

		// Show Result
		echo '<div class="updated settings-error below-h2"><p>
			' . sprintf( __( 'Import completed - imported <strong>%s</strong> rows.', WOO_VPF_YMM_TEXT_DOMAIN ), $_loop ) . '
		</p></div>';
		
		if( !empty( $_messages ) ) {
			echo '<div class="woo_vpf_ymm_messages">';
				foreach( $_messages as $_message ) {
					echo '<p class="' . $_message['type'] . '">' . $_message['text'] . '</p>';
				}
			echo '</div>';
		}
		
		echo '<style type="text/css">
			.woo_vpf_ymm_messages {
				clear:both;
			}
			
			.woo_vpf_ymm_messages p {
				margin:0 0 10px 0;
				padding:2px 5px;
				color:#444;
			}
			
			.woo_vpf_ymm_messages p.error {
				background:red;
				color:#FFF;
			}
			
			.woo_vpf_ymm_messages p.success {
				background:green;
				color:#FFF;
			}
			
			.woo_vpf_ymm_messages p.warning {
				background:yellow;
				color:#444;
			}
		</style>';

		$this->import_end();
	}
	
	/**
	 * Create slug from name
	 */
	public function create_slug( $string ) {
		if( ! empty( $string ) ) {
			return sanitize_title( $string );
		}
	}
	
	/**
	 * Get product ID from slug
	 */
	public function get_product_id_by_slug( $slug ) {
		if( ! empty( $slug ) ) {
			global $wpdb;
			$post_id = $wpdb->get_var( "SELECT `ID` FROM ".$wpdb->posts." WHERE `post_name` like '".$slug."' && `post_type`='product'" );
			
			if( WOO_VPF_YMM_Functions::is_wpml_activated() ) {
				$post_id = icl_object_id( $post_id, 'product', false, ICL_LANGUAGE_CODE );
			}
			
			return $post_id;
		}
		
		return false;
	}
	
	/**
	 * Get product ID from SKU
	 */
	public function get_product_id_by_sku( $sku ) {
		if( ! empty( $sku ) ) {
			global $wpdb;
			$post_id = $wpdb->get_var( "SELECT p.`ID` FROM ".$wpdb->posts." AS p LEFT JOIN ".$wpdb->postmeta." AS pm ON ( p.`ID` = pm.`post_id` ) WHERE p.`post_type`='product' AND pm.`meta_key`='_sku' AND pm.`meta_value` like '".$sku."'" );
			
			if( WOO_VPF_YMM_Functions::is_wpml_activated() ) {
				$post_id = icl_object_id( $post_id, 'product', false, ICL_LANGUAGE_CODE );
			}
			
			return $post_id;
		}
		
		return false;
	}

	/**
	 * Performs post-import cleanup of files and the cache
	 */
	public function import_end() {
		echo '<p>' . __( 'All done!', WOO_VPF_YMM_TEXT_DOMAIN ) . ' <a href="' . admin_url('edit-tags.php?taxonomy=product_ymm&post_type=product') . '">' . __( 'View VPF ( YMM ) Terms', WOO_VPF_YMM_TEXT_DOMAIN ) . '</a>' . '</p>';

		do_action( 'import_end' );
	}

	/**
	 * Handles the CSV upload and initial parsing of the file to prepare for displaying author import options
	 *
	 * @return bool False if error uploading or invalid file, true otherwise
	 */
	public function handle_upload() {
		if ( empty( $_POST['file_url'] ) ) {

			$file = wp_import_handle_upload();

			if ( isset( $file['error'] ) ) {
				$this->import_error( $file['error'] );
			}

			$this->id = absint( $file['id'] );

		} elseif ( file_exists( ABSPATH . $_POST['file_url'] ) ) {
			$this->file_url = esc_attr( $_POST['file_url'] );
		} else {
			$this->import_error();
		}

		return true;
	}

	/**
	 * header function.
	 */
	public function header() {
		echo '<div class="wrap"><div class="icon32 icon32-woo-vpf-ymm-importer" id="icon-woo-vpf-ymm-importer"><br></div>';
		echo '<h2>' . __( 'Import VPF ( YMM ) Terms', WOO_VPF_YMM_TEXT_DOMAIN ) . '</h2>';
	}

	/**
	 * footer function.
	 */
	public function footer() {
		echo '</div>';
	}

	/**
	 * greet function: HTML for import file
	 */
	public function greet() {

		echo '<div class="narrow">';
		
		echo '<p>' . __( 'Upload a CSV file containing VPF ( YMM ) Terms to import the contents into your shop. Choose a .csv file to upload, then click "Upload file and import".', WOO_VPF_YMM_TEXT_DOMAIN ).'</p>';

		echo '<p>' . sprintf( __( 'VPF ( YMM ) Terms need to be defined with columns in a specific order (5 columns). <a href="%s">Click here to download a sample</a>.', WOO_VPF_YMM_TEXT_DOMAIN ), WOO_VPF_YMM_PLUGIN_URL . '/dummy-data/sample_product_ymm.csv' ) . '</p>';
		
		echo '<p>' . __( 'It is strongly recommended to backup your database before import CSV.', WOO_VPF_YMM_TEXT_DOMAIN ) . '</p>';

		$action = 'admin.php?import='.$this->import_page.'&step=1';

		$bytes = apply_filters( 'import_upload_size_limit', wp_max_upload_size() );
		$size = size_format( $bytes );
		$upload_dir = wp_upload_dir();
		if ( ! empty( $upload_dir['error'] ) ) :
			?><div class="error"><p><?php _e( 'Before you can upload your import file, you will need to fix the following error:', WOO_VPF_YMM_TEXT_DOMAIN ); ?></p>
			<p><strong><?php echo $upload_dir['error']; ?></strong></p></div><?php
		else :
			?>
			<form enctype="multipart/form-data" id="import-upload-form" method="post" action="<?php echo esc_attr(wp_nonce_url($action, 'import-upload')); ?>">
				<table class="form-table">
					<tbody>
						<tr>
							<td style="vertical-align:top;">
								<table>
									<tr>
										<th>
											<label for="upload"><?php _e( 'Choose a file from your computer:', WOO_VPF_YMM_TEXT_DOMAIN ); ?></label>
										</th>
										<td>
											<input type="file" id="upload" name="import" size="25" />
											<input type="hidden" name="action" value="save" />
											<input type="hidden" name="max_file_size" value="<?php echo $bytes; ?>" />
											<small><?php printf( __('Maximum size: %s', WOO_VPF_YMM_TEXT_DOMAIN ), $size ); ?></small>
										</td>
									</tr>
									<tr>
										<th>
											<label for="file_url"><?php _e( 'OR enter path to file:', WOO_VPF_YMM_TEXT_DOMAIN ); ?></label>
										</th>
										<td>
											<?php echo ' ' . ABSPATH . ' '; ?><input type="text" id="file_url" name="file_url" size="25" />
										</td>
									</tr>
									<tr>
										<th><label><?php _e( 'Delimiter', WOO_VPF_YMM_TEXT_DOMAIN ); ?></label><br/></th>
										<td><input type="text" name="delimiter" placeholder="," size="2" /></td>
									</tr>
								</tbody>
							</table>
						</td>
						
						<td style="vertical-align:top;">
							<img src="<?php echo WOO_VPF_YMM_PLUGIN_URL.'/assets/images/csv.png'; ?>" alt="" />
						</td>
					</tr>
				</table>
				
				<p class="submit">
					<input type="submit" class="button" value="<?php esc_attr_e( 'Upload file and import', WOO_VPF_YMM_TEXT_DOMAIN ); ?>" />
				</p>
			</form>
			<?php
		endif;

		echo '</div>';
	}

	/**
	 * Show import error and quit
	 *
	 * @param  string $message
	 */
	private function import_error( $message = '' ) {
		echo '<p><strong>' . __( 'Sorry, there has been an error.', WOO_VPF_YMM_TEXT_DOMAIN ) . '</strong><br />';
		if ( $message ) {
			echo esc_html( $message );
		}
		echo '</p>';
		$this->footer();
		die();
	}

	/**
	 * Added to http_request_timeout filter to force timeout at 60 seconds during import
	 *
	 * @param  int $val
	 * @return int 60
	 */
	public function bump_request_timeout( $val ) {
		return 60;
	}
}
