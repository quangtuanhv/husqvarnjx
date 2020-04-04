<?php
/**
 * Registers VPF (YMM) Settings
 *
 * @class WOO_VPF_YMM_Settings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WOO_VPF_YMM_Settings Class
 */
class WOO_VPF_YMM_Settings {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		// Add/Save Settings tab to WooCommerce Settings
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_tab' ), 69 );
		add_action( 'woocommerce_settings_tabs_woo_vpf_ymm', array( $this, 'add_settings' ) );
		add_action( 'woocommerce_update_options_woo_vpf_ymm', array( $this, 'update_settings' ) );
		
		// Custom Field Types
		add_action( 'woocommerce_admin_field_woo_vpf_ymm_title', array( $this, 'field_woo_vpf_ymm_title' ) );
		add_action( 'woocommerce_admin_field_woo_vpf_ymm_choosen', array( $this, 'field_woo_vpf_ymm_choosen' ) );
		add_action( 'woocommerce_admin_field_woo_vpf_ymm_products_choosen', array( $this, 'field_woo_vpf_ymm_products_choosen' ) );
		
		// Custom Field Types Before Save
		add_filter( 'woocommerce_admin_settings_sanitize_option', array( $this, 'woo_vpf_ymm_options_before_save' ), 10, 3 );
	}

	/**
	 * Add VPF (YMM) Settings Tab to WooCommerce Settings
	 */
	public static function add_settings_tab( $settings_tabs ) {
		$settings_tabs['woo_vpf_ymm'] = __( 'VPF (YMM)', WOO_VPF_YMM_TEXT_DOMAIN );
        return $settings_tabs;
	}
	
	/**
	 * Add VPF (YMM) Setting Fields to WooCommerce VPF (YMM) Settings Tab
	 */
	public static function add_settings() {
		woocommerce_admin_fields( self::get_settings() );
	}

	/**
	 * Update VPF (YMM) Settings Tab
	 */
	public static function update_settings() {
		woocommerce_update_options( self::get_settings() );
	}
	
	/**
	 * Get VPF (YMM) Settings Fields
	 */
	public static function get_settings() {
		$categories = self::get_categories();
		
		$settings = array(
			'section_title'				=> array(
				'name'					=> __( 'VPF (YMM) Settings', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'title',
				'id'					=> 'woo_vpf_ymm_section_title'
			),
			
			// Settings: General
			
			'section_general_title'		=> array(
				'name'					=> __( 'Settings: General', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'woo_vpf_ymm_title',
				'id'					=> 'woo_vpf_ymm_section_general_title'
			),
			
			'activate_chosen'			=> array(
				'name'					=> __( 'Activate Chosen', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will convert the default select/drop boxes to much more user-friendly select boxes', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_activate_chosen'
			),
			
			'disable_dependent_fields'	=> array(
				'name'					=> __( 'Disable Dependent Fields', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will prevent the opening of the next drop-downs until one chooses current drop-down', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_disable_dependent_fields'
			),
			
			'activate_remember_search'	=> array(
				'name'					=> __( 'Remember Search', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will restrict WooCommerce Catalog to show only user searched criteria matching products whole over the website', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_activate_remember_search'
			),
			
			'disable_redirect_single_search_result'	=> array(
				'name'					=> __( 'Disable Redirect Single Search Result', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option prevents the redirection to product details page when there is only one search result', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_disable_redirect_single_search_result'
			),
			
			'years_sort_order'			=> array(
				'name'					=> __( 'Years Sort Order', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'select',
				'class'					=> 'wc-enhanced-select',
				'options'				=> apply_filters( 'woo_vpf_ymm_setting_years_sort_order', array(
					'asc'				=> __( 'Oldest to Newest', WOO_VPF_YMM_TEXT_DOMAIN ),
					'desc'				=> __( 'Newest to Oldest', WOO_VPF_YMM_TEXT_DOMAIN )
				) ),
				'default'				=> 'asc',
				'desc'					=> __( 'Select sorting order for years while showing in filter select boxes', WOO_VPF_YMM_TEXT_DOMAIN ),
				'desc_tip'				=> true,
				'id'					=> 'woo_vpf_ymm_years_sort_order'
			),
			
			// Settings: Labels
			
			'section_label_title'			=> array(
				'name'					=> __( 'Settings: Labels', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'woo_vpf_ymm_title',
				'id'					=> 'woo_vpf_ymm_section_label_title'
			),
			
			'year_label'				=> array(
				'name'					=> __( 'Year Label', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Year', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_year_label',
				'class'					=> 'regular-text'
			),
			
			'make_label'				=> array(
				'name'					=> __( 'Make Label', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Make', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_make_label',
				'class'					=> 'regular-text'
			),
			
			'model_label'				=> array(
				'name'					=> __( 'Model Label', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Model', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_model_label',
				'class'					=> 'regular-text'
			),
			
			'engine_label'				=> array(
				'name'					=> __( 'Engine Label', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Engine', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_engine_label',
				'class'					=> 'regular-text'
			),
			
			'category_label'				=> array(
				'name'					=> __( 'Category Label', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Category', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_category_label',
				'class'					=> 'regular-text'
			),
			
			'keyword_label'				=> array(
				'name'					=> __( 'Keyword Label', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Keyword', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_keyword_label',
				'class'					=> 'regular-text'
			),
			
			'search_results_label'		=> array(
				'name'					=> __( 'Search Results Label', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Search results for:', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_search_results_label',
				'class'					=> 'regular-text'
			),
			
			// Settings: Admin
			
			'section_admin_title'		=> array(
				'name'					=> __( 'Settings: Admin', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'woo_vpf_ymm_title',
				'id'					=> 'woo_vpf_ymm_section_admin_title'
			),
			
			'activate_quick_edit_terms'	=> array(
				'name'					=> __( 'Activate Quick Edit', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will show VPF (YMM) Terms on product quick edit screen. Disable this option helps to prevent blank screen on product listing page in case of heavy list of terms.', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_activate_quick_edit_terms'
			),
			
			'csv_comma_separated_cols'	=> array(
				'name'					=> __( 'CSV Comma Separated Columns', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'multiselect',
				'options'				=> apply_filters( 'woo_vpf_ymm_setting_csv_comma_separated_cols', array(
					''					=> __( '', WOO_VPF_YMM_TEXT_DOMAIN ),
					'year'				=> __( 'Year', WOO_VPF_YMM_TEXT_DOMAIN ),
					'make'				=> __( 'Make', WOO_VPF_YMM_TEXT_DOMAIN ),
					'model'				=> __( 'Model', WOO_VPF_YMM_TEXT_DOMAIN ),
					'engine'			=> __( 'Engine', WOO_VPF_YMM_TEXT_DOMAIN ),
					'product'			=> __( 'Product', WOO_VPF_YMM_TEXT_DOMAIN )
				) ),
				'default'				=> array( 'product' ),
				'custom_attributes'		=> array( 'size' => 6 ),
				'desc'					=> __( 'Select comma separation supported columns for CSV while importing VPF (YMM) Terms', WOO_VPF_YMM_TEXT_DOMAIN ),
				'desc_tip'				=> true,
				'id'					=> 'woo_vpf_ymm_csv_comma_separated_cols'
			),
			
			'csv_range_supported_cols'	=> array(
				'name'					=> __( 'CSV Range Supported Columns', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'multiselect',
				'options'				=> apply_filters( 'woo_vpf_ymm_setting_csv_range_supported_cols', array(
					''					=> __( '', WOO_VPF_YMM_TEXT_DOMAIN ),
					'year'				=> __( 'Year', WOO_VPF_YMM_TEXT_DOMAIN ),
					'make'				=> __( 'Make', WOO_VPF_YMM_TEXT_DOMAIN ),
					'model'				=> __( 'Model', WOO_VPF_YMM_TEXT_DOMAIN ),
					'engine'			=> __( 'Engine', WOO_VPF_YMM_TEXT_DOMAIN )
				) ),
				'default'				=> array( 'year' ),
				'custom_attributes'		=> array( 'size' => 5 ),
				'desc'					=> __( 'Select range supported numeric columns for CSV while importing VPF (YMM) Terms. Eg: 2004-2008', WOO_VPF_YMM_TEXT_DOMAIN ),
				'desc_tip'				=> true,
				'id'					=> 'woo_vpf_ymm_csv_range_supported_cols'
			),
			
			'csv_product_col'			=> array(
				'name'					=> __( 'CSV Product Column', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'select',
				'class'					=> 'wc-enhanced-select',
				'options'				=> apply_filters( 'woo_vpf_ymm_setting_csv_product_cols', array(
					'slug'				=> __( 'Product Slug', WOO_VPF_YMM_TEXT_DOMAIN ),
					'sku'				=> __( 'Product SKU', WOO_VPF_YMM_TEXT_DOMAIN )
				) ),
				'default'				=> 'sku',
				'desc'					=> __( 'Select CSV item_product column to use as slug or SKU', WOO_VPF_YMM_TEXT_DOMAIN ),
				'desc_tip'				=> true,
				'id'					=> 'woo_vpf_ymm_csv_product_col'
			),
			
			'taxonomy_metabox_template'	=> array(
				'name'					=> __( 'Terms Metabox Template', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'select',
				'class'					=> 'wc-enhanced-select',
				'options'				=> apply_filters( 'woo_vpf_ymm_setting_taxonomy_metabox_templates', array(
					'default'			=> __( 'Default', WOO_VPF_YMM_TEXT_DOMAIN ),
					'tree_view'			=> __( 'Tree View', WOO_VPF_YMM_TEXT_DOMAIN ),
					'ajaxify_meta_box'	=> __( 'Custom Meta Box with Ajaxify Rows', WOO_VPF_YMM_TEXT_DOMAIN ),
				) ),
				'default'				=> 'ajaxify_meta_box',
				'desc'					=> __( 'Select template for VPF (YMM) Terms list while adding/editing a product', WOO_VPF_YMM_TEXT_DOMAIN ),
				'desc_tip'				=> true,
				'id'					=> 'woo_vpf_ymm_taxonomy_metabox_template'
			),
			
			'taxonomy_metabox_excluded_products'	=> array(
				'name'					=> __( 'Universal Products', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'woo_vpf_ymm_products_choosen',
				'desc'					=> __( 'Select products which fits for all VPF (YMM) Terms. These products will always be in search results.', WOO_VPF_YMM_TEXT_DOMAIN ),
				'desc_tip'				=> true,
				'id'					=> 'woo_vpf_ymm_taxonomy_metabox_excluded_products'
			),
			
			'included_categories'		=> array(
				'name'					=> __( 'Categories to Include', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'woo_vpf_ymm_choosen',
				'desc'					=> __( 'Select categories which need to show in categories select/drop box for VPF (YMM) filter. Leaving it empty will show all categories in drop box.', WOO_VPF_YMM_TEXT_DOMAIN ),
				'desc_tip'				=> true,
				'id'					=> 'woo_vpf_ymm_included_categories',
				'options'				=> $categories
			),
			
			// Settings: My Vehicles
			
			'section_my_vehicles_title'	=> array(
				'name'					=> __( 'Settings: My Vehicles', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'woo_vpf_ymm_title',
				'id'					=> 'woo_vpf_ymm_section_my_vehicles_title'
			),
			
			'activate_my_vehicles'		=> array(
				'name'					=> __( 'Activate My Vehicles', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will allow users/visitors to save their searches', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_activate_my_vehicles'
			),
			
			'my_vehicles_title'			=> array(
				'name'					=> __( 'Main Title', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'My Garage:', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_title',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_save_limit'	=> array(
				'name'					=> __( 'Saved Vehicles - Limit', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'number',
				'default'				=> 5,
				'id'					=> 'woo_vpf_ymm_my_vehicles_save_limit',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_save_title'	=> array(
				'name'					=> __( 'Saved Vehicles - Title', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'My Saved Vehicles', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_save_title',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_save_description'	=> array(
				'name'					=> __( 'Saved Vehicles - Description', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'View, manage and find parts', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_save_description',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_save_no_item_text'	=> array(
				'name'					=> __( 'Saved Vehicles - No Items', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'You are yet to start saving search results', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_save_no_item_text',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_save_clear_history_text'	=> array(
				'name'					=> __( 'Saved Vehicles - Clear History', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Clear History', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_save_clear_history_text',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_history_limit'	=> array(
				'name'					=> __( 'Vehicles History - Limit', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'number',
				'default'				=> 5,
				'id'					=> 'woo_vpf_ymm_my_vehicles_history_limit',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_history_title'	=> array(
				'name'					=> __( 'Vehicles History - Title', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Vehicles History', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_history_title',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_history_description'	=> array(
				'name'					=> __( 'Vehicles History - Description', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Easily navigate the latest vehicles selected', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_history_description',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_history_no_item_text'	=> array(
				'name'					=> __( 'Vehicles History - No Items', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'You are yet to start searching vehicles', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_history_no_item_text',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_history_clear_history_text'	=> array(
				'name'					=> __( 'Vehicles History - Clear History', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Clear History', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_history_clear_history_text',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_add_vehicle_text'=> array(
				'name'					=> __( 'Add Vehicle Text', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Add a Vehicle', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_add_vehicle_text',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_add_vehicle_heading'	=> array(
				'name'					=> __( 'Add Vehicle Heading', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Select Vehicle', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_add_vehicle_heading',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_add_vehicle_description'	=> array(
				'name'					=> __( 'Add Vehicle Description', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'id'					=> 'woo_vpf_ymm_my_vehicles_add_vehicle_description',
				'class'					=> 'regular-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			'my_vehicles_add_vehicle_shortcode'	=> array(
				'name'					=> __( 'Add Vehicle Shortcode', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'textarea',
				'default'				=> '[woo_vpf_ymm_filter show_model="true" show_engine="true" show_category="false" show_keyword="false" label_search="Search"]',
				'custom_attributes'		=> array( 'rows' => 5 ),
				'id'					=> 'woo_vpf_ymm_my_vehicles_add_vehicle_shortcode',
				'class'					=> 'large-text woo_vpf_ymm_activate_my_vehicles_child woo_vpf_ymm_activate_my_vehicles_yes',
			),
			
			
			// Settings: Custom Tab
			
			'section_tab_title'			=> array(
				'name'					=> __( 'Settings: Custom Tab', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'woo_vpf_ymm_title',
				'id'					=> 'woo_vpf_ymm_section_tab_title'
			),
			
			'activate_tab'				=> array(
				'name'					=> __( 'Activate Tab', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will add VPF (YMM) tab on product details page', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_activate_tab'
			),
			
			'tab_title'					=> array(
				'name'					=> __( 'Tab Title', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'id'					=> 'woo_vpf_ymm_tab_title',
				'class'					=> 'regular-text woo_vpf_ymm_activate_tab_child woo_vpf_ymm_activate_tab_yes',
			),
			
			'tab_heading'		=> array(
				'name'					=> __( 'Tab Heading', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'id'					=> 'woo_vpf_ymm_tab_heading',
				'class'					=> 'regular-text woo_vpf_ymm_activate_tab_child woo_vpf_ymm_activate_tab_yes',
			),
			
			'tab_description'	=> array(
				'name'					=> __( 'Tab Description', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'id'					=> 'woo_vpf_ymm_tab_description',
				'class'					=> 'regular-text woo_vpf_ymm_activate_tab_child woo_vpf_ymm_activate_tab_yes',
			),
			
			'activate_tab_year_ranges'	=> array(
				'name'					=> __( 'Show Year in Ranges', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will shorten the long list of VPF (YMM) terms on product details page by showing year in ranges rather than individual row per year eg: 2001-2004', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_activate_tab_year_ranges'
			),
			
			
			// Settings: Validation
			
			'section_validation_title'	=> array(
				'name'					=> __( 'Settings: Validation', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'woo_vpf_ymm_title',
				'id'					=> 'woo_vpf_ymm_section_validation_title'
			),
			
			'activate_validation'		=> array(
				'name'					=> __( 'Activate Validation', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will add the validation to filter', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_activate_validation'
			),
			
			'validation_alert'			=> array(
				'name'					=> __( 'Show Error Alert', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will show the error in alert box', WOO_VPF_YMM_TEXT_DOMAIN ),
				'default'				=> 'yes',
				'id'					=> 'woo_vpf_ymm_validation_alert',
				'class'					=> 'woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			
			'validation_style'			=> array(
				'name'					=> __( 'Show Error Border', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'default'				=> 'yes',
				'desc'					=> __( 'Enable this option will add the red border with error fields', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validation_style',
				'class'					=> 'woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			
			'validate_year'				=> array(
				'name'					=> __( 'Validate Year', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will make the <strong>YEAR</strong> field compulsory', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_year',
				'class'					=> 'woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			'validate_year_text'		=> array(
				'name'					=> __( 'Validate Year Text', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Year Required!', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_year_text',
				'class'					=> 'regular-text woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			
			'validate_make'				=> array(
				'name'					=> __( 'Validate Make', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will make the <strong>MAKE</strong> field compulsory', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_make',
				'class'					=> 'woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			'validate_make_text'		=> array(
				'name'					=> __( 'Validate Make Text', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Make Required!', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_make_text',
				'class'					=> 'regular-text woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			
			'validate_model'			=> array(
				'name'					=> __( 'Validate Model', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will make the <strong>MODEL</strong> field compulsory', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_model',
				'class'					=> 'woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			'validate_model_text'		=> array(
				'name'					=> __( 'Validate Model Text', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Model Required!', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_model_text',
				'class'					=> 'regular-text woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			
			'validate_engine'			=> array(
				'name'					=> __( 'Validate Engine', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will make the <strong>ENGINE</strong> field compulsory', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_engine',
				'class'					=> 'woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			'validate_engine_text'		=> array(
				'name'					=> __( 'Validate Engine Text', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Engine Required!', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_engine_text',
				'class'					=> 'regular-text woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			
			'validate_category'			=> array(
				'name'					=> __( 'Validate Category', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will make the <strong>CATEGORY</strong> field compulsory', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_category',
				'class'					=> 'woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			'validate_category_text'		=> array(
				'name'					=> __( 'Validate Category Text', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Category Required!', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_category_text',
				'class'					=> 'regular-text woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			
			'validate_keyword'			=> array(
				'name'					=> __( 'Validate Keyword', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'checkbox',
				'desc'					=> __( 'Enable this option will make the <strong>KEYWORD</strong> field compulsory', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_keyword',
				'class'					=> 'woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			'validate_keyword_text'		=> array(
				'name'					=> __( 'Validate Keyword Text', WOO_VPF_YMM_TEXT_DOMAIN ),
				'type'					=> 'text',
				'default'				=> __( 'Keyword Required!', WOO_VPF_YMM_TEXT_DOMAIN ),
				'id'					=> 'woo_vpf_ymm_validate_keyword_text',
				'class'					=> 'regular-text woo_vpf_ymm_activate_validation_child woo_vpf_ymm_activate_validation_yes',
			),
			
			'section_end'				=> array(
				 'type'					=> 'sectionend',
				 'id'					=> 'woo_vpf_ymm_section_end'
			),
		);
		
		return apply_filters( 'woo_vpf_ymm_setting_fields', $settings );
	}
	
	/**
	 * Get WooCommerce Categories
	 */
	public static function get_categories( $categories=array(), $parent=0, $base_name='' ) {
		
		$args = array(
			'parent'		=> $parent,
			'orderby'		=> 'title',
			'order'			=> 'ASC',
			'hide_empty'	=> false
		);
		$terms = get_terms( 'product_cat', $args );
		
		if( !empty($terms) ) {
			foreach($terms as $term) {
				if( $term->parent > 0 && !empty($base_name) ) {
					$term->name = $base_name . ' > ' . $term->name;
				}
				$categories[$term->term_id] = $term->name;
				$categories = self::get_categories( $categories, $term->term_id, $term->name );
			}
		}
		
		return $categories;
	}
	
	/**
	 * Add custom field type - woo_vpf_ymm_title
	 */
	public static function field_woo_vpf_ymm_title( $value ) {
		?><tr valign="top">
			<th scope="row" class="titledesc" colspan="2">
				<h4 class="woo-vpf-ymm-section-title">
					<?php echo esc_html( $value['title'] ); ?>
					
					<button type="button" class="handlediv" aria-expanded="true">
						<span class="toggle-indicator" aria-hidden="true"></span>
					</button>
				</h4>
			</th>
		</tr><?php
	}
	
	/**
	 * Add Custom Field Type - woo_vpf_ymm_choosen
	 */
	public static function field_woo_vpf_ymm_choosen($value) {
		$field_description = WC_Admin_Settings::get_field_description( $value );
		extract( $field_description );
		
		$selections = (array) WC_Admin_Settings::get_option( $value['id'] );
		?><tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
				<?php echo $tooltip_html; ?>
			</th>
			<td class="forminp woo_vpf_ymm_chosen_settings">
				<select multiple="multiple" name="<?php echo esc_attr( $value['id'] ); ?>[]" style="width:100%;" data-placeholder="<?php _e( 'Choose Categories', WOO_VPF_YMM_TEXT_DOMAIN ); ?>" title="<?php esc_attr_e( 'Category', WOO_VPF_YMM_TEXT_DOMAIN ) ?>" class="wc-enhanced-select">
					<?php
						if ( ! empty( $value['options'] ) ) {
							foreach ( $value['options'] as $key => $val ) {
								echo '<option value="' . esc_attr( $key ) . '" ' . selected( in_array( $key, $selections ), true, false ).'>' . $val . '</option>';
							}
						}
					?>
				</select> <?php echo ( $description ) ? $description : ''; ?> </br><a class="select_all button" href="#"><?php _e( 'Select all', WOO_VPF_YMM_TEXT_DOMAIN ); ?></a> <a class="select_none button" href="#"><?php _e( 'Select none', WOO_VPF_YMM_TEXT_DOMAIN ); ?></a>
			</td>
		</tr><?php
	}
	
	/**
	 * Add custom field type - woo_vpf_ymm_products_choosen
	 */
	public static function field_woo_vpf_ymm_products_choosen( $value ) {
		$field_description = WC_Admin_Settings::get_field_description( $value );
		extract( $field_description );
		
		$product_ids	= WC_Admin_Settings::get_option( $value['id'] );
		if( ! empty( $product_ids ) && ! is_array( $product_ids ) ) {
			$product_ids = explode( ',', $product_ids );
		}
		
		?><tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
				<?php echo $tooltip_html; ?>
			</th>
			
			<td class="forminp woo_vpf_ymm_chosen_settings">
				<select class="wc-product-search" style="width:100%;" multiple="multiple" name="<?php echo esc_attr( $value['id'] ); ?>[]" id="<?php echo esc_attr( $value['id'] ); ?>" data-placeholder="<?php esc_attr_e( 'Choose Products&hellip;', WOO_VPF_YMM_TEXT_DOMAIN ); ?>" data-action="woocommerce_json_search_products">
					<?php
						foreach ( $product_ids as $product_id ) {
							$product = wc_get_product( $product_id );
							if ( is_object( $product ) ) {
								echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . wp_kses_post( $product->get_formatted_name() ) . '</option>';
							}
						}
					?>
				</select> <?php echo ( $description ) ? $description : ''; ?>
			</td>
		</tr><?php
	}
	
	/**
	 * Filter Custom Setting Field Types before Save
	 */
	public static function woo_vpf_ymm_options_before_save($value, $option, $raw_value) {
		if( in_array( $option['type'], array( 'woo_vpf_ymm_choosen', 'woo_vpf_ymm_products_choosen' ) ) ) {
			$value = '';
			
			if( ! empty( $raw_value ) ) {
				$value = array_filter( array_map( 'wc_clean', (array) $raw_value ) );
			}
		}
		
		return $value;
	}
	
}

new WOO_VPF_YMM_Settings();
