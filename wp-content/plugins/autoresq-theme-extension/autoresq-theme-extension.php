<?php
/**
 * Plugin Name: Autoresq Theme Extension
 * Plugin URI: http://zoutula.com
 * Description: This plugin handles Autoresq Theme custom content. It's activated/deactivated with the theme.
 * Version: 2.1.3
 * Author: Zoutula
 * Author URI: http://zoutula.com
 * Text Domain: zoutula
 * Domain Path: /languages
 */
define('ZTL_VER','maxjamLCG9h2k');
defined('AUTORESQ_VER') || define('AUTORESQ_VER', '2.1.3');

function autoresq_custom_data()
{

    //Member custom post

    $labels = array(
        'name' => esc_html(_x('Staff', 'Category name', 'zoutula')),
        'singular_name' => esc_html(_x('Staff', 'Category item', 'zoutula')),
        'all_items' => esc_html__('All Staff', 'zoutula'),
        'parent_item_colon' => null,
        'add_new_item' => esc_html__('Add Staff Member', 'zoutula'),
        'add_new' => esc_html(_x('Add Staff Member', 'zoutula')),
        'menu_name' => esc_html__('Staff', 'zoutula'),
    );


    register_post_type('member',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => true,
            'rewrite' => true,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields'),
            'show_admin_column' => true,
            'has_archive' => 'staff'
        )
    );

    //Staff custom taxonomy
    register_taxonomy('staff_taxonomy',
        array('member'),
        array(
            'label' => esc_html__('Staff Categories', 'zoutula'),
            'singular_label' => esc_html__('Staff Category', 'zoutula'),
            'hierarchical' => true,
            'query_var' => true,
            'public' => true,
            'rewrite' => array(
                'slug' => 'staff',
            ),
        )
    );


    //Services
    $labels = array(
        'name' => esc_html(_x('Services', 'Category name', 'zoutula')),
        'singular_name' => esc_html(_x('Service', 'Category item', 'zoutula')),
        'all_items' => esc_html__('All Services', 'zoutula'),
        'parent_item_colon' => null,
        'add_new_item' => esc_html__('Add Service', 'zoutula'),
        'add_new' => esc_html(_x('Add Service', 'zoutula')),
        'menu_name' => esc_html__('Services', 'zoutula'),
    );

    //Service custom post

    register_post_type('service',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => true,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields'),
            'show_admin_column' => true,
            'has_archive' => 'services'
        )
    );

    register_taxonomy('services_taxonomy',
        array('service'),
        array(
            'label' => esc_html__('Services Categories', 'zoutula'),
            'singular_label' => esc_html__('Service Category', 'zoutula'),
            'hierarchical' => true,
            'query_var' => true,
            'public' => true,
            'rewrite' => array(
                'slug' => 'services',
            ),
        )
    );


}


add_action( 'plugins_loaded', 'autoresq_load_textdomain' );
function autoresq_load_textdomain() {
  // Load plugin textdomain. E.g.: wp-content/plugins/autoresq-theme-extension/languages/zoutula-de_DE.mo
    load_plugin_textdomain( 'zoutula', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

}

add_action('init', 'autoresq_custom_data');

//set number of posts for staff taxonomy and archive post type = member
function autoresq_staff_posts_per_page($query)
{
    if (! is_admin() && ! is_search()) {
        if (($query->is_post_type_archive('member') || $query->is_tax('staff_taxonomy')) && $query->is_main_query()) {
            $query->set('posts_per_page', (int)get_theme_mod('staff_posts_per_page', '9'));
        }
    }
}
add_action('pre_get_posts', 'autoresq_staff_posts_per_page');



//set number of posts for services taxonomy and archive post type = service
function autoresq_services_posts_per_page($query)
{
    if (! is_admin() && ! is_search()) {
        if (($query->is_post_type_archive('service') || $query->is_tax('services_taxonomy')) && $query->is_main_query()) {
            $query->set('posts_per_page', (int)get_theme_mod('services_posts_per_page', '6'));
        }
    }
}
add_action('pre_get_posts', 'autoresq_services_posts_per_page');


//Staff columns
add_filter('manage_edit-member_columns', 'autoresq_edit_member_columns');

function autoresq_edit_member_columns($columns)
{

    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => esc_html__('Title', 'zoutula'),
        'category' => esc_html__('Category', 'zoutula'),
        'date' => esc_html__('Date', 'zoutula')
    );

    return $columns;
}


add_action('manage_member_posts_custom_column', 'autoresq_manage_member_columns', 10, 2);

function autoresq_manage_member_columns($column, $post_id)
{
    global $post;
    switch ($column) {
        case 'category':
            echo get_the_term_list($post->ID, 'staff_taxonomy', '', ', ', '');
            break;
    }

}


//Services columns
add_filter('manage_edit-service_columns', 'autoresq_edit_service_columns');

function autoresq_edit_service_columns($columns)
{

    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => esc_html__('Title', 'zoutula'),
        'category' => esc_html__('Category', 'zoutula'),
        'date' => esc_html__('Date', 'zoutula')
    );

    return $columns;
}


add_action('manage_service_posts_custom_column', 'autoresq_manage_service_columns', 10, 2);

function autoresq_manage_service_columns($column, $post_id)
{
    global $post;
    switch ($column) {
        case 'category':
            echo get_the_term_list($post->ID, 'services_taxonomy', '', ', ', '');
            break;
    }

}

//common
include ('common/svg_ztl.php');

//metaboxes
include ('metaboxes.php');

//widgets
include ('widgets/autoresq-info-widget.php');
include ('widgets/autoresq-recent-posts-widget.php');

//shortcodes
include('shortcodes/divider_ztl.php');
include('shortcodes/announcement_ztl.php');
include('shortcodes/counter_ztl.php');
include('shortcodes/coupon_ztl.php');
include('shortcodes/clients_ztl.php');
include('shortcodes/package_ztl.php');
include('shortcodes/countdown_ztl.php');
include('shortcodes/title_ztl.php');
include('shortcodes/posts_grid_ztl.php');
include('shortcodes/subscriber_ztl.php');
include('shortcodes/steps_ztl.php');
include('shortcodes/map_ztl.php');
include('shortcodes/pricing_plan_ztl.php');
include('shortcodes/testimonials_ztl.php');
include('shortcodes/icon_ztl.php');


function ztl_plugin_init() {
    if( class_exists( 'WooCommerce' ) ) {
        include( 'shortcodes/products_filter_ztl.php' );
    }
}
add_action( 'plugins_loaded', 'ztl_plugin_init' );



//extend some VC functionality
add_action('vc_enqueue_font_icon_element', 'ztl_custom_icons_enqueue');

//icons for frontend/backend editor
add_action('vc_backend_editor_enqueue_js_css', 'ztl_iconpicker_editor_jscss');
add_action('vc_frontend_editor_enqueue_js_css', 'ztl_iconpicker_editor_jscss');

//map custom icons
add_filter('vc_iconpicker-type-ztlicon', 'ztl_icons_list');



function ztl_custom_icons_enqueue($font)
{
	switch ($font) {
		case "ztlicon":
			wp_enqueue_style('zoutula-icons', plugin_dir_url(__FILE__) . 'shortcodes/assets/css/zoutula-icons.css');
			break;
	}
}

function ztl_iconpicker_editor_jscss()
{
    wp_enqueue_style('zoutula-icons', plugin_dir_url(__FILE__) . 'shortcodes/assets/css/zoutula-icons.css');
}


// zoutula custom icons
function ztl_icons_list($icons)
{
	$autoresq_images = new Ztl_Images();
	return array_merge($icons, $autoresq_images->getAll());
}


/**
 * Enqueue scripts and styles.
 */
function zoutula_scripts()
{
    wp_enqueue_style('zoutula-style', plugin_dir_url(__FILE__) . 'shortcodes/assets/css/zoutula-shortcodes.css', false, AUTORESQ_VER);
    wp_enqueue_style('zoutula-responsive', plugin_dir_url(__FILE__) . 'shortcodes/assets/css/zoutula-responsive.css', false, AUTORESQ_VER);
    wp_enqueue_style('zoutula-font', plugin_dir_url(__FILE__) . 'shortcodes/assets/font-icons/font.css', false, AUTORESQ_VER);
    wp_enqueue_style('owl-carousel', plugin_dir_url(__FILE__) . 'shortcodes/assets/css/owl.carousel.min.css', false, AUTORESQ_VER);

    wp_enqueue_script('zoutula-countup', plugin_dir_url(__FILE__) . 'shortcodes/assets/js/countup.min.js', array('jquery'), AUTORESQ_VER, true);
    wp_enqueue_script('zoutula-countdown', plugin_dir_url(__FILE__) . 'shortcodes/assets/js/jquery.countdown.js', array('jquery'), AUTORESQ_VER, true);
    wp_enqueue_script('zoutula-shortcodes', plugin_dir_url(__FILE__) . 'shortcodes/assets/js/zoutula-shortcodes.js', array('jquery'), AUTORESQ_VER, true);
    wp_enqueue_script('owl-carousel', plugin_dir_url(__FILE__) . 'shortcodes/assets/js/owl.carousel.min.js', array('jquery'), AUTORESQ_VER, true);
    wp_enqueue_script('jquery-print', plugin_dir_url(__FILE__) . 'shortcodes/assets/js/jquery.print.min.js', array('jquery'), AUTORESQ_VER, true);


}
add_action('wp_enqueue_scripts', 'zoutula_scripts');



/* Predefined import settings */
function autoresq_ocdi_import_files() {
    return array(
        array(
            'import_file_name'           => 'Autoresq - Car Repair & Auto Service',
            'import_file_url'            => 'http://www.zoutula.com/repository/autoresq/'.ZTL_VER.'/imports/car-repair/wordpress.xml',
            'import_widget_file_url'     => 'http://www.zoutula.com/repository/autoresq/'.ZTL_VER.'/imports/car-repair/widgets.wie',
            'import_customizer_file_url' => 'http://www.zoutula.com/repository/autoresq/'.ZTL_VER.'/imports/car-repair/customizer.dat',
            'import_preview_image_url'   => 'http://www.zoutula.com/repository/autoresq/'.ZTL_VER.'/imports/car-repair/preview.jpg',
            'import_notice'              => esc_html__( 'After you import this demo, you will have to import the Revolution Slider and Essential Grid data separately.', 'zoutula' ),
            'preview_url'                => 'http://demo.zoutula.com/autoresq/',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'autoresq_ocdi_import_files' );

/* Remove Branding*/
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/* Setup the homepage and primary menu */
function autoresq_ocdi_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );

    // Update date format as in demo
    update_option( 'date_format', 'j // F' );

}
add_action( 'pt-ocdi/after_import', 'autoresq_ocdi_after_import_setup' );

