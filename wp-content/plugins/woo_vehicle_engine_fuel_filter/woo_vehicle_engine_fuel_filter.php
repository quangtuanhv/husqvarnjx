<?php
/*
Plugin Name: WooCommerce Vehicle Engine and Fuel Filter Plugin
Plugin URI:
Description: Find Vehicle Tyre By Make/Model/Year/Engine/Fuel/Category
Version: 2.0
Author: Bigboss555
Author URI:http://sakosys.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'bbWEFFilter' ) ) {
	require_once WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . "woo_vehicle_engine_fuel_filter" . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "wef_widget.php";
	require_once WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . "woo_vehicle_engine_fuel_filter" . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "wef_shortcode.php";
	require_once WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . "woo_vehicle_engine_fuel_filter" . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "wef_product_tab.php";
}

class bigbossWEFCore {
	public function __construct() {
		register_activation_hook( __FILE__, array( $this, 'ob_install' ) );
		register_deactivation_hook( __FILE__, array( $this, 'ob_uninstall' ) );

		/**
		 * add action of plugin
		 */
		add_action( 'init', array( $this, 'register_bb_wef_filter_taxonomy'));
		
		add_action( 'init', array( $this, 'init_bb_wef_filter_taxonomy_meta'));

		add_action( 'admin_init', array( $this, 'obScriptInit' ) );
		
		add_action( 'init', array( $this, 'obScriptInitFrontend' ) );
		
		add_filter( 'woocommerce_page_title', array( $this, 'woo_shop_page_title_wef' ) );
		
		add_action( 'widgets_init', array( $this, 'bbTWPSSFilter_register_widgets' ) );
		
		add_action( 'pre_get_posts',  array( $this, 'rc_modify_query_get_design_projects' ) );
				
	}
	
	function woo_shop_page_title_wef( $page_title ) {
		if( 'Shop' == $page_title && is_shop() && isset($_GET['bb_make']) && isset($_GET['bb_model']) && isset($_GET['bb_year']) && isset($_GET['bb_engine']) && isset($_GET['bb_fuel'])) {
			return $this->returnPerfectTitleForFTWPssilter($_GET['bb_make'],$_GET['bb_model'],$_GET['bb_year'],$_GET['bb_engine'],$_GET['bb_fuel']);
		}
		else{
			return $page_title;
		}
	}
	function returnPerfectTitleForFTWPssilter($type,$width,$profile,$size,$speed){
		$sHtml = '';
		if($type != '' && $type != '-1'){
			$objTerm = get_term_by('id', $_GET['bb_make'], 'bb_WEF_Filter');
			if(isset($objTerm->name) && $objTerm->name != ''){
				$sHtml .= $objTerm->name;
			}
		}
		if($width != '' && $width != '-1'){
			$objTerm = get_term_by('id', $_GET['bb_model'], 'bb_WEF_Filter');
			if(isset($objTerm->name) && $objTerm->name != ''){
				$sHtml .= '/'.$objTerm->name;
			}
		}
		if($profile != '' && $profile != '-1'){
			$objTerm = get_term_by('id', $_GET['bb_year'], 'bb_WEF_Filter');
			if(isset($objTerm->name) && $objTerm->name != ''){
				$sHtml .= '/'.$objTerm->name;
			}
		}
		if($size != '' && $size != '-1'){
			$objTerm = get_term_by('id', $_GET['bb_engine'], 'bb_WEF_Filter');
			if(isset($objTerm->name) && $objTerm->name != ''){
				$sHtml .= '/'.$objTerm->name;
			}
		}
		if($speed != '' && $speed != '-1'){
			$objTerm = get_term_by('id', $_GET['bb_fuel'], 'bb_WEF_Filter');
			if(isset($objTerm->name) && $objTerm->name != ''){
				$sHtml .= '/'.$objTerm->name;
			}
		}
		return $sHtml;
	}
	function rc_modify_query_get_design_projects( $query ) {
		if (!$query->is_main_query() || !is_shop()) return;
		if (!is_admin()) {
			if(isset($_GET['bb_make']) && (int)$_GET['bb_make'] > 0 && isset($_GET['bb_model']) && (int)$_GET['bb_model'] > 0 && isset($_GET['bb_year']) && (int)$_GET['bb_year'] > 0 && isset($_GET['bb_engine']) && (int)$_GET['bb_engine'] > 0 && isset($_GET['bb_fuel']) && (int)$_GET['bb_fuel'] > 0){
				if(isset($_GET['bb_cat']) && (int)$_GET['bb_cat'] > 0){
					$query->set('tax_query', array(
						'relation' => 'AND',
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_make']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_model']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_year']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_engine']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_fuel']),
							  ),
					    array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_engine']),
							  ),
					    array(
							  'taxonomy' => 'product_cat',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_cat']),
							  )
						)
					);
				}
				else{
					$query->set('tax_query', array(
						'relation' => 'AND',
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_make']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_model']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_year']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_engine']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_fuel']),
							  )
						)
					);
				}
			}
			//label 2
			else if(isset($_GET['bb_make']) && (int)$_GET['bb_make'] > 0 && isset($_GET['bb_model']) && (int)$_GET['bb_model'] > 0 && isset($_GET['bb_year']) && (int)$_GET['bb_year'] > 0 && isset($_GET['bb_engine']) && (int)$_GET['bb_engine'] > 0){
				if(isset($_GET['bb_cat']) && (int)$_GET['bb_cat'] > 0){
					$query->set('tax_query', array(
						'relation' => 'AND',
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_make']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_model']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_year']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_engine']),
							  ),
						array(
							  'taxonomy' => 'product_cat',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_cat']),
							  )
						)
					);
				}
				else{
					$query->set('tax_query', array(
						'relation' => 'AND',
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_make']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_model']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_year']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_engine']),
							  )
						)
					);
				}
			}
			//label 3
			else if(isset($_GET['bb_make']) && (int)$_GET['bb_make'] > 0 && isset($_GET['bb_model']) && (int)$_GET['bb_model'] > 0 && isset($_GET['bb_year']) && (int)$_GET['bb_year'] > 0){
				if(isset($_GET['bb_cat']) && (int)$_GET['bb_cat'] > 0){
					$query->set('tax_query', array(
						'relation' => 'AND',
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_make']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_model']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_year']),
							  ),
						array(
							  'taxonomy' => 'product_cat',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_cat']),
							  )
						)
					);
				}
				else{
					$query->set('tax_query', array(
						'relation' => 'AND',
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_make']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_model']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_year']),
							  )
						)
					);
				}
			}
			// label 2
			else if(isset($_GET['bb_make']) && (int)$_GET['bb_make'] > 0 && isset($_GET['bb_model']) && (int)$_GET['bb_model'] > 0){
				if(isset($_GET['bb_cat']) && (int)$_GET['bb_cat'] > 0){
					$query->set('tax_query', array(
						'relation' => 'AND',
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_make']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_model']),
							  ),
						array(
							  'taxonomy' => 'product_cat',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_cat']),
							  )
						)
					);
				}
				else{
					$query->set('tax_query', array(
						'relation' => 'AND',
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_make']),
							  ),
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_model']),
							  )
						)
					);
				}
			}
			else if(isset($_GET['bb_make']) && (int)$_GET['bb_make'] > 0){
				if(isset($_GET['bb_cat']) && (int)$_GET['bb_cat'] > 0){
					$query->set('tax_query', array(
						'relation' => 'AND',
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_make']),
							  ),
						array(
							  'taxonomy' => 'product_cat',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_cat']),
							  )
						)
					);
				}
				else{
					$query->set('tax_query', array(
						'relation' => 'AND',
						array(
							  'taxonomy' => 'bb_WEF_Filter',
							  'field' => 'id',
							  'terms' => trim($_GET['bb_make']),
							  )
						)
					);
				}
			}
		}
	}
	
	
	function ob_install() {
		global $wp_version;
		If ( version_compare( $wp_version, "2.9", "<" ) ) {
			deactivate_plugins( basename( __FILE__ ) ); // Deactivate our plugin
			wp_die( "This plugin requires WordPress version 2.9 or higher." );
		}
		/**
		 * Check if WooCommerce is active or not
		 **/
		if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		    deactivate_plugins( basename( __FILE__ ) ); // Deactivate our plugin
			wp_die( "This plugin required WooCommerce plugin installed and activated. Please <a href='http://www.woothemes.com/woocommerce/' target='_blank'>download and install WooCommerce plugin</a>." );
		}

	}
	
	/**
	 * Register widget
	 */
	function bbTWPSSFilter_register_widgets() {
		register_widget( 'bbWEF_list_widget' );
	}
	
	function ob_uninstall() {
		//do something when uninstall
	}
	/**
	 * Function set up include javascript, css.
	 */
	function obScriptInit() {
		//wp_enqueue_script( 'bbTWPSS-script-admin', plugin_dir_url( '' ) . basename( dirname( __FILE__ ) ) . '/js/jscolor.js', array(), false, true );
		wp_enqueue_style( 'bbWEF-style-admin', plugin_dir_url( '' ) . basename( dirname( __FILE__ ) ) . '/css/widget.css' );
	}

	function obScriptInitFrontend() {
		wp_enqueue_script( 'bbWEF-script-frontend', plugin_dir_url( '' ) . basename( dirname( __FILE__ ) ) . '/js/bb_wef.js', array(), false, true );
		wp_enqueue_style( 'bbWEF-style-frontend', plugin_dir_url( '' ) . basename( dirname( __FILE__ ) ) . '/css/style.css' );
	}
	
	/**
	 * This function register custom tyrefilter taxonomy
	 */
	function register_bb_wef_filter_taxonomy() {

		$labels = array(
			'name' => _x( 'Make/Model/Year/Engine/Fuel', 'General Name' ),
			'singular_name' => _x( 'WEFfilter', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Vehicle Parts' ),
			'all_items' => __( 'All Parts' ),
			'parent_item' => __( 'Parent Tyre' ),
			'parent_item_colon' => __( 'Parent Tyre:' ),
			'edit_item' => __( 'Edit Engine Fuel' ),
			'update_item' => __( 'Update Engine Fuel' ),
			'add_new_item' => __( 'Add New Engine Fuel Info' ),
			'new_item_name' => __( 'New Engine Fuel Name' ),
			'menu_name' => __( 'Make/Model/Year/Engine/Fuel' ),
		);    

	    register_taxonomy("bb_WEF_Filter",
	     array("product"),
	     array(
			 'hierarchical' 		=> true,
		     'labels' 				=> $labels,
		   	 'show_ui'		    	=> true,
    		 'query_var' 			=> true,
		     'rewrite' 				=> array( 'slug' => 'type', 'with_front' => true ),
		     'show_admin_column' 	=> false
	     ));
	}
	function init_bb_wef_filter_taxonomy_meta() {
		$prefix = 'bbwef_';

		$config = array(
			'id' => 'bbwef_box',          // meta box id, unique per meta box
			'title' => 'Make/Model/Year/Engine/Fuel settings',          // meta box title
			'pages' => array('bbwef_filter'),        // taxonomy name, accept categories, post_tag and custom taxonomies
			'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
			'fields' => array(),            // list of meta fields (can be added by field arrays)
			'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
			'use_with_theme' => false        //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
		);
	
	}
}
$bbWEFFilter = new bigbossWEFCore();
?>
