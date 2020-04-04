<?php
/**
 * Autoresq Theme Customizer
 *
 * @package Autoresq
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function autoresq_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'autoresq_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'autoresq_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'autoresq_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function autoresq_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function autoresq_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function autoresq_customize_preview_js() {
	wp_enqueue_script( 'autoresq-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'autoresq_customize_preview_js' );


/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function autoresq_customizer( $wp_customize ) {

	// Add Theme General Settings *************************
	$wp_customize->add_section(
		'options_general',
		array(
			'title' => esc_html__( 'General Settings', 'autoresq' ),
			'description' => esc_html__( 'Structure Settings', 'autoresq' ),
			'priority' => 15,
		)
	);

	/* boxed layout / full width */
	$wp_customize->add_setting(
		'layout_mode' ,
		array(
			'default' => 'full',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'layout_mode',
		array(
			'label' => esc_html__( 'Site Layout', 'autoresq' ),
			'section' => 'options_general',
			'type' => 'radio',
			'choices' => array(
				'full' => esc_html__( 'Full width layout','autoresq' ),
				'boxed' => esc_html__( 'Boxed layout','autoresq' ),
			),
			'priority'   => 10,
		)
	);

	/* boxed layout / full width */
	$wp_customize->add_setting(
		'scroll_to_top' ,
		array(
			'default' => 'yes',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'scroll_to_top',
		array(
			'label' => esc_html__( 'Scroll to Top Button', 'autoresq' ),
			'section' => 'options_general',
			'type' => 'radio',
			'choices' => array(
				'yes' => esc_html__( 'Yes','autoresq' ),
				'no' => esc_html__( 'No','autoresq' ),
			),
			'priority'   => 15,
		)
	);

    /* search button from header */
    $wp_customize->add_setting(
        'show_search_icon' ,
        array(
            'default' => 'yes',
            'sanitize_callback' => 'autoresq_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'show_search_icon',
        array(
            'label' => esc_html__( 'Show Search', 'autoresq' ),
            'section' => 'options_general',
            'type' => 'radio',
            'choices' => array(
                'yes' => esc_html__( 'Yes','autoresq' ),
                'no' => esc_html__( 'No','autoresq' ),
            ),
            'priority'   => 20,
        )
    );


    /* search button from header */
    $wp_customize->add_setting(
        'show_cart_icon' ,
        array(
            'default' => 'yes',
            'sanitize_callback' => 'autoresq_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'show_cart_icon',
        array(
            'label' => esc_html__( 'Show Cart', 'autoresq' ),
            'section' => 'options_general',
            'type' => 'radio',
            'choices' => array(
                'yes' => esc_html__( 'Yes','autoresq' ),
                'no' => esc_html__( 'No','autoresq' ),
            ),
            'priority'   => 30,
        )
    );



	// Main website font
	$wp_customize->add_setting(
		'main_font_google' ,
		array(
			'default' => 'Lato',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'main_font_google',
		array(
			'label' => esc_html__( 'Main Font', 'autoresq' ),
			'section' => 'options_general',
			'type' => 'text',
			'priority'   => 30,
		)
	);

	// Accent website font
	$wp_customize->add_setting(
		'accent_font_google' ,
		array(
			'default' => 'Montserrat',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'accent_font_google',
		array(
			'label' => esc_html__( 'Accent Font', 'autoresq' ),
			'section' => 'options_general',
			'type' => 'text',
			'priority'   => 50,
		)
	);


	// Main website font
	$wp_customize->add_setting(
		'fonts_subset' ,
		array(
			'default' => 'Latin',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'fonts_subset',
		array(
			'label' => esc_html__( 'Fonts subset', 'autoresq' ),
			'section' => 'options_general',
			'type' => 'text',
			'priority'   => 60,
			'description' => esc_html__( 'Please add the subset you want. Eg. Latin, Cyrillic', 'autoresq' ),
		)
	);


    // Google maps api key
    $wp_customize->add_setting(
        'google_maps_api_key' ,
        array(
            'default' => 'AIzaSyDuklOQ79qeWRyU1cDr29QsevDd9uJSXBw',
            'sanitize_callback' => 'autoresq_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'google_maps_api_key',
        array(
            'label' => esc_html__( 'Google maps API key', 'autoresq' ),
            'section' => 'options_general',
            'type' => 'text',
            'priority'   => 70,
            'description' => esc_html__( 'Please add your own Google Maps API key. You are using a default one that may reach its calls limit anytime', 'autoresq' ),
        )
    );


	// Add Theme Header Section *************************
	$wp_customize->add_section(
		'options_header',
		array(
			'title' => esc_html__( 'Header', 'autoresq' ),
			'description' => esc_html__( 'Site Header Settings', 'autoresq' ),
			'priority' => 20,
		)
	);



	// Add First Logo Settings
	$wp_customize->add_setting(
		'logo_first' ,
		array(
			'default' => get_template_directory_uri() . '/images/autoresq_logo_light.png',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'logo_first',
			array(
				'label' => esc_html__( 'Logo First Image', 'autoresq' ),
				'section' => 'options_header',
				'settings' => 'logo_first',
				'priority'   => 3,
			)
		)
	);

	// Add First Logo HiRes Settings
	$wp_customize->add_setting(
		'hires_logo_first' ,
		array(
			'default' => get_template_directory_uri() . '/images/autoresq_logo_light@2x.png',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'hires_logo_first',
			array(
				'label' => esc_html__( 'High Resolution Logo First Image', 'autoresq' ),
				'description' => esc_html__( 'Image should be twice as large as logo above with "@2x" added to filename.', 'autoresq' ),
				'section' => 'options_header',
				'settings' => 'hires_logo_first',
				'priority'   => 4,
			)
		)
	);



	// Add Second Logo Settings
	$wp_customize->add_setting(
		'logo_second' ,
		array(
			'default' => get_template_directory_uri() . '/images/autoresq_logo_dark.png',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'logo_second',
			array(
				'label' => esc_html__( 'Logo Second Image', 'autoresq' ),
				'section' => 'options_header',
				'settings' => 'logo_second',
				'priority'   => 5,
			)
		)
	);

	// Add Logo Second HiRes Settings
	$wp_customize->add_setting(
		'hires_logo_second' ,
		array(
			'default' => get_template_directory_uri() . '/images/autoresq_logo_dark@2x.png',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'hires_logo_second',
			array(
				'label' => esc_html__( 'High Resolution Logo Second Image', 'autoresq' ),
				'description' => esc_html__( 'Image should be twice as large as logo above with "@2x" added to filename.', 'autoresq' ),
				'section' => 'options_header',
				'settings' => 'hires_logo_second',
				'priority'   => 6,
			)
		)
	);

	// Logo width setting/control
	$wp_customize->add_setting(
		'logo_width' ,
		array(
			'default' => '140',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'logo_width',
		array(
			'label' => esc_html__( 'Logo Width (max)', 'autoresq' ),
			'section' => 'options_header',
			'type' => 'number',
			'priority'   => 10,
		)
	);

	$wp_customize->add_setting(
		'sticky_header',
		array(
			'default' => 'no',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'sticky_header',
		array(
			'type' => 'radio',
			'label' => esc_html__( 'Sticky Header','autoresq' ),
			'section' => 'options_header',
			'choices' => array(
				'no' => 'No',
				'yes' => 'Yes',
			),
			'priority' => 13,
		)
	);




	// Header background color
	$wp_customize->add_setting(
		'header_background_color',
		array(
			'default' => '#072f4f', // dark blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color',
			array(
				'label' => esc_html__( 'Header Background Color', 'autoresq' ),
				'section' => 'options_header',
				'settings' => 'header_background_color',
				'priority' => 14,
			)
		)
	);



	// Menu background color
	$wp_customize->add_setting(
		'menu_background_color',
		array(
			'default' => '#ffffff', // white
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_background_color',
			array(
				'label' => esc_html__( 'Menu Background Color', 'autoresq' ),
				'section' => 'options_header',
				'settings' => 'menu_background_color',
				'priority' => 15,
			)
		)
	);


	// Menu Fonts Size
	$wp_customize->add_setting(
		'menu_font_size',
		array(
			'default' => 15,
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'menu_font_size',
		array(
			'label' => esc_html__( 'Menu Font Size (px)', 'autoresq' ),
			'section' => 'options_header',
			'settings' => 'menu_font_size',
			'priority' => 25,
			'type' => 'number',
		)
	);


	// Menu Fonts Weight
	$wp_customize->add_setting(
		'menu_font_weight',
		array(
			'default' => 700,
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'menu_font_weight',
		array(
			'label' => esc_html__( 'Menu Font Weight', 'autoresq' ),
			'section' => 'options_header',
			'settings' => 'menu_font_weight',
			'priority' => 30,
			'type' => 'number',
		)
	);



	// Menu First Color
	$wp_customize->add_setting(
		'menu_first_color',
		array(
			'default' => '#072f4f',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_first_color',
			array(
				'label' => esc_html__( 'Menu First Color', 'autoresq' ),
				'section' => 'options_header',
				'settings' => 'menu_first_color',
				'description' => esc_html__( 'Used as: menu text color for first level', 'autoresq' ),
				'priority' => 32,
			)
		)
	);


	// Menu Second Color
	$wp_customize->add_setting(
		'menu_second_color',
		array(
			'default' => '#f4c70b',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_second_color',
			array(
				'label' => esc_html__( 'Menu Second Color', 'autoresq' ),
				'section' => 'options_header',
				'settings' => 'menu_second_color',
				'description' => esc_html__( 'Used as: sub-menu background color, mobile menu burger color', 'autoresq' ),
				'priority' => 35,
			)
		)
	);


	// Menu Third Color
	$wp_customize->add_setting(
		'menu_third_color',
		array(
			'default' => '#707070',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_third_color',
			array(
				'label' => esc_html__( 'Menu Third Color', 'autoresq' ),
				'section' => 'options_header',
				'settings' => 'menu_third_color',
				'description' => esc_html__( 'Used as: sub-menu text color on second level items for resolution < 768px', 'autoresq' ),
				'priority' => 37,
			)
		)
	);

	// Menu Fourth Color
	$wp_customize->add_setting(
		'menu_fourth_color',
		array(
			'default' => '#313131',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_fourth_color',
			array(
				'label' => esc_html__( 'Menu Fourth Color', 'autoresq' ),
				'section' => 'options_header',
				'settings' => 'menu_fourth_color',
				'description' => esc_html__( 'Used as: sub-menu text color for resolution > 768px', 'autoresq' ),
				'priority' => 39,
			)
		)
	);


	// Menu Border color
	$wp_customize->add_setting(
		'menu_border_color',
		array(
			'default' => '#f2f2f2',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_border_color',
			array(
				'label' => esc_html__( 'Menu Border Line', 'autoresq' ),
				'section' => 'options_header',
				'settings' => 'menu_border_color',
				'description' => esc_html__( 'Fixed menu border. Used to better delimit menu area.', 'autoresq' ),
				'priority' => 42,
			)
		)
	);


	// Show breadcrumb
    // Option to show social in footer
    $wp_customize->add_setting(
        'show_breadcrumb',
        array(
            'default' => 'show',
            'sanitize_callback' => 'autoresq_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'show_breadcrumb',
        array(
            'type' => 'radio',
            'label' => esc_html__( 'Show/Hide Breadcrumb','autoresq' ),
            'section' => 'options_header',
            'choices' => array(
                'show' => esc_html__('Show','autoresq'),
                'hide' => esc_html__('Hide','autoresq'),
            ),
            'priority' => 50,
        )
    );


    // Custom title background
    $wp_customize->add_setting(
        'title_background',
        array(
            'default' => '#f2f2f2',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'title_background',
            array(
                'label' => esc_html__( 'Title Background', 'autoresq' ),
                'section' => 'options_header',
                'settings' => 'title_background',
                'description' => esc_html__( 'Custom title background. If you set a header image will cover this color', 'autoresq' ),
                'priority' => 52,
            )
        )
    );


	$wp_customize->add_setting(
		'uppercase_header_title',
		array(
			'default' => 'none',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'uppercase_header_title',
		array(
			'type' => 'radio',
			'label' => esc_html__( 'Transform Header Text','autoresq' ),
			'section' => 'options_header',
			'choices' => array(
				'none' => esc_html__('None','autoresq'),
				'uppercase' => esc_html__('Uppercase','autoresq'),
			),
			'priority' => 54,
		)
	);


    // Custom title background
    $wp_customize->add_setting(
        'title_color',
        array(
            'default' => '#072f4f',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'title_color',
            array(
                'label' => esc_html__( 'Title Background', 'autoresq' ),
                'section' => 'options_header',
                'settings' => 'title_color',
                'description' => esc_html__( 'Custom title color.', 'autoresq' ),
                'priority' => 54,
            )
        )
    );
	
	
	
		// Footer delimiter color
	$wp_customize->add_setting(
		'header_delimiter_color',
		array(
			'default' => '#20425e', // light blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_delimiter_color',
			array(
				'label'      => esc_html__( 'Header Delimiter Color', 'autoresq' ),
				'section'    => 'options_header',
				'settings'   => 'header_delimiter_color',
				'priority'   => 60,
			)
		)
	);



	// Colors section ******************************
	// Theme second color
	$wp_customize->add_setting(
		'theme_first_color',
		array(
			'default' => '#f4c70b',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'theme_first_color',
			array(
				'label' => esc_html__( 'Theme First Color', 'autoresq' ),
				'section' => 'colors',
				'settings' => 'theme_first_color',
				'priority' => 5,
			)
		)
	);

	// Theme second color
	$wp_customize->add_setting(
		'theme_second_color',
		array(
			'default' => '#072f4f', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'theme_second_color',
			array(
				'label' => esc_html__( 'Theme Second Color', 'autoresq' ),
				'section' => 'colors',
				'settings' => 'theme_second_color',
				'priority' => 5,
			)
		)
	);

	// Post details color
	$wp_customize->add_setting(
		'detail_color',
		array(
			'default' => '#707070', // light grey
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'detail_color',
			array(
				'label' => esc_html__( 'Detail Color', 'autoresq' ),
				'section' => 'colors',
				'settings' => 'detail_color',
				'priority' => 7,
			)
		)
	);

    // Border color
    $wp_customize->add_setting(
        'line_color',
        array(
            'default' => '#f2f2f2', // light grey
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'line_color',
            array(
                'label' => esc_html__( 'Line Color', 'autoresq' ),
                'section' => 'colors',
                'settings' => 'line_color',
                'priority' => 9,
            )
        )
    );

	// Links colors
	$wp_customize->add_setting(
		'link_color',
		array(
			'default' => '#072f4f', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'label' => esc_html__( 'Links Color', 'autoresq' ),
				'section' => 'colors',
				'settings' => 'link_color',
				'priority' => 34,
			)
		)
	);

	// Pagination first color
	$wp_customize->add_setting(
		'pagination_first_color',
		array(
			'default' => '#f4c70b',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pagination_first_color',
			array(
				'label'      => esc_html__( 'Pagination First Color', 'autoresq' ),
				'section'    => 'colors',
				'settings'   => 'pagination_first_color',
				'priority'   => 90,
			)
		)
	);

	// Buttons text-color
	$wp_customize->add_setting(
		'pagination_second_color',
		array(
			'default' => '#072f4f', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pagination_second_color',
			array(
				'label'      => esc_html__( 'Pagination Second Color', 'autoresq' ),
				'section'    => 'colors',
				'settings'   => 'pagination_second_color',
				'priority'   => 100,
			)
		)
	);


	// Add Footer Section
	$wp_customize->add_section(
		'options_footer',
		array(
			'title' => esc_html__( 'Footer', 'autoresq' ),
			'description' => esc_html__( 'Settings for colors, text and social links visibility in footer', 'autoresq' ),
			'priority' => 25,
		)
	);

	// Above Footer background color
	$wp_customize->add_setting(
		'footer_sidebar_above_background_color',
		array(
			'default' => '#072f4f', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_sidebar_above_background_color',
			array(
				'label'      => esc_html__( 'Above Footer Widget Area Background Color', 'autoresq' ),
				'section'    => 'options_footer',
				'settings'   => 'footer_sidebar_above_background_color',
				'priority'   => 4,
			)
		)
	);

	// Footer background color
	$wp_customize->add_setting(
		'footer_sidebar_background_color',
		array(
			'default' => '#072f4f', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_sidebar_background_color',
			array(
				'label'      => esc_html__( 'Footer Widget Area Background Color', 'autoresq' ),
				'section'    => 'options_footer',
				'settings'   => 'footer_sidebar_background_color',
				'priority'   => 5,
			)
		)
	);

	// Footer background color
	$wp_customize->add_setting(
		'footer_background_color',
		array(
			'default' => '#fffff', // white
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_background_color',
			array(
				'label'      => esc_html__( 'Footer Belt Background Color', 'autoresq' ),
				'section'    => 'options_footer',
				'settings'   => 'footer_background_color',
				'priority'   => 10,
			)
		)
	);

	// Copyright text color
	$wp_customize->add_setting(
		'copyright_color',
		array(
			'default' => '#072f4f', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'copyright_color',
			array(
				'label'      => esc_html__( 'Copyright Font Color', 'autoresq' ),
				'section'    => 'options_footer',
				'settings'   => 'copyright_color',
				'priority'   => 15,
			)
		)
	);

	// Footer delimiter color
	$wp_customize->add_setting(
		'footer_delimiter_color',
		array(
			'default' => '#20425e', // light blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_delimiter_color',
			array(
				'label'      => esc_html__( 'Footer Delimiter Color', 'autoresq' ),
				'section'    => 'options_footer',
				'settings'   => 'footer_delimiter_color',
				'priority'   => 17,
			)
		)
	);

	// Copyright text
	$wp_customize->add_setting(
		'copyright_textbox',
		array(
			'default' => '2018 Autoresq Theme crafted with Love by Zoutula',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'copyright_textbox',
		array(
			'label' => esc_html__( 'Copyright Text','autoresq' ),
			'section' => 'options_footer',
			'type' => 'text',
			'priority'   => 20,
		)
	);

	// Option to show social in footer
	$wp_customize->add_setting(
		'show_footer_social',
		array(
			'default' => 'hide',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'show_footer_social',
		array(
			'type' => 'radio',
			'label' => esc_html__( 'Show/Hide Social Icons','autoresq' ),
			'section' => 'options_footer',
			'choices' => array(
				'show' => 'Show',
				'hide' => 'Hide',
			),
			'priority' => 30,
		)
	);

	// Footer social icons background color
	$wp_customize->add_setting(
		'footer_social_icons_background_color',
		array(
			'default' => '#20425e', // light blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_social_icons_background_color',
			array(
				'label'      => esc_html__( 'Social Icons Background Color', 'autoresq' ),
				'section'    => 'options_footer',
				'settings'   => 'footer_social_icons_background_color',
				'priority'   => 32,
			)
		)
	);

	// Footer social icons color
	$wp_customize->add_setting(
		'footer_social_icons_color',
		array(
			'default' => '#072f4f', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_social_icons_color',
			array(
				'label'      => esc_html__( 'Social Icons Color', 'autoresq' ),
				'section'    => 'options_footer',
				'settings'   => 'footer_social_icons_color',
				'priority'   => 35,
			)
		)
	);

	// Footer social icons color
	$wp_customize->add_setting(
		'footer_social_icons_hover_color',
		array(
			'default' => '#f4c70b',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_social_icons_hover_color',
			array(
				'label'      => esc_html__( 'Social Icons Hover Color', 'autoresq' ),
				'section'    => 'options_footer',
				'settings'   => 'footer_social_icons_hover_color',
				'priority'   => 40,
			)
		)
	);

	// Add Section Social Links
	$wp_customize->add_section(
		'options_social',
		array(
			'title' => esc_html__( 'Social Links', 'autoresq' ),
			'description' => esc_html__( 'Social links for your site', 'autoresq' ),
			'priority' => 30,
		)
	);

	// Social Link 1
	$wp_customize->add_setting(
		'social_link_1',
		array(
			'default' => '',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'social_link_1',
		array(
			'label' => esc_html__( 'Social Link 1','autoresq' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 10,
		)
	);

	// Social Link Icon 1
	$wp_customize->add_setting(
		'social_link_icon_1',
		array(
			'default' => '',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'social_link_icon_1',
		array(
			'label' => esc_html__( 'Social Link Icon 1','autoresq' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 15,
		)
	);

	// Social Link 2
	$wp_customize->add_setting(
		'social_link_2',
		array(
			'default' => '',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'social_link_2',
		array(
			'label' => esc_html__( 'Social Link 2','autoresq' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 20,
		)
	);

	// Social Link Icon 2
	$wp_customize->add_setting(
		'social_link_icon_2',
		array(
			'default' => '',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'social_link_icon_2',
		array(
			'label' => esc_html__( 'Social Link Icon 2','autoresq' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 25,
		)
	);

	// Social Link 3
	$wp_customize->add_setting(
		'social_link_3',
		array(
			'default' => '',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'social_link_3',
		array(
			'label' => esc_html__( 'Social Link 3','autoresq' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 30,
		)
	);

	// Social Link Icon 3
	$wp_customize->add_setting(
		'social_link_icon_3',
		array(
			'default' => '',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'social_link_icon_3',
		array(
			'label' => esc_html__( 'Social Link Icon 3','autoresq' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 35,
		)
	);

	// Social Link 4
	$wp_customize->add_setting(
		'social_link_4',
		array(
			'default' => '',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'social_link_4',
		array(
			'label' => esc_html__( 'Social Link 4','autoresq' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 40,
		)
	);

	// Social Link Icon 4
	$wp_customize->add_setting(
		'social_link_icon_4',
		array(
			'default' => '',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'social_link_icon_4',
		array(
			'label' => esc_html__( 'Social Link Icon 4','autoresq' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 45,
		)
	);


	// Social Link 5
	$wp_customize->add_setting(
		'social_link_5',
		array(
			'default' => '',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'social_link_5',
		array(
			'label' => esc_html__( 'Social Link 5','autoresq' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 50,
		)
	);

	// Social Link Icon 5
	$wp_customize->add_setting(
		'social_link_icon_5',
		array(
			'default' => '',
			'sanitize_callback' => 'autoresq_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'social_link_icon_5',
		array(
			'label' => esc_html__( 'Social Link Icon 5','autoresq' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 55,
		)
	);

	// Add Shop Section only in case WooCommerce is active
	if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_section(
			'options_shop',
			array(
				'title' => esc_html__('Shop', 'autoresq'),
				'description' => esc_html__('Settings for WooCommerce pages', 'autoresq'),
				'priority' => 32,
			)
		);

		//Shop sidebar layout
		$wp_customize->add_setting(
			'shop_sidebar_option',
			array(
				'default' => 'right',
				'sanitize_callback' => 'autoresq_sanitize_text',
			)
		);

		$wp_customize->add_control(
			'shop_sidebar_option',
			array(
				'label' => esc_html__('Shop Sidebar Layout', 'autoresq'),
				'section' => 'options_shop',
				'type' => 'radio',
				'choices' => array(
					'right' => 'Right',
					'none' => 'None (full width)',
				),
				'priority' => 10,
			)
		);


		// Shop products per page
		$wp_customize->add_setting(
			'shop_products_per_page',
			array(
				'default' => '9',
				'sanitize_callback' => 'autoresq_sanitize_text',
			)
		);

		$wp_customize->add_control(
			'shop_products_per_page',
			array(
				'label' => esc_html__('Products per Page', 'autoresq'),
				'section' => 'options_shop',
				'type' => 'number',
				'priority' => 20,
			)
		);
	}

    // Blog settings
    $wp_customize->add_section(
        'options_blog',
        array(
            'title' => esc_html__( 'Blog', 'autoresq' ),
            'description' => esc_html__( 'Options for blog listing and more', 'autoresq' ),
            'priority' => 35,
        )
    );


    // Blog sidebar layout
    $wp_customize->add_setting(
        'category_sidebar_option' ,
        array(
            'default' => 'right',
            'sanitize_callback' => 'autoresq_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'category_sidebar_option',
        array(
            'label' => esc_html__( 'Blog Sidebar', 'autoresq' ),
            'section' => 'options_blog',
            'type' => 'radio',
            'choices'  => array(
                'right' => 'Right',
                'none' => 'None (full width)',
            ),
            'priority'   => 10,
        )
    );


    // Blog layout 1 column / grid
    $wp_customize->add_setting(
        'category_layout_option' ,
        array(
            'default' => 'one_column',
            'sanitize_callback' => 'autoresq_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'category_layout_option',
        array(
            'label' => esc_html__('Blog Layout', 'autoresq'),
            'section' => 'options_blog',
            'type' => 'radio',
            'choices' => array(
                'one_column' => esc_html__('One Column', 'autoresq'),
                'ess_grid' => esc_html__('Essential Grid', 'autoresq'),
            ),
            'priority' => 27,
        )
    );

    // Grid alias layout
    $wp_customize->add_setting(
        'ess_grid_alias' ,
        array(
            'default' => 'autoresq-blog',
            'sanitize_callback' => 'autoresq_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'ess_grid_alias',
        array(
            'label' => esc_html__( 'Essential Grid Alias E.g.: autoresq-blog', 'autoresq' ),
            'section' => 'options_blog',
            'type' => 'text',
            'priority'   => 28,
        )
    );



	// Add Section Staff
	$wp_customize->add_section(
		'options_staff',
		array(
			'title' => esc_html__( 'Staff', 'autoresq' ),
			'description' => esc_html__( 'Options for staff listing and more', 'autoresq' ),
			'priority' => 35,
		)
	);

    // Staff sidebar
    $wp_customize->add_setting(
        'staff_sidebar_option' ,
        array(
            'default' => 'right',
            'sanitize_callback' => 'autoresq_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'staff_sidebar_option',
        array(
            'label' => esc_html__( 'Staff Sidebar', 'autoresq' ),
            'section' => 'options_staff',
            'type' => 'radio',
            'choices'  => array(
                'none' => 'None (full width)',
                'right' => 'Right',
            ),
            'priority'   => 10,
        )
    );

    // Staff items per page
    $wp_customize->add_setting(
        'staff_posts_per_page',
        array(
            'default' => '9',
            'sanitize_callback' => 'autoresq_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'staff_posts_per_page',
        array(
            'label' => esc_html__('Staff Members per Page ', 'autoresq'),
            'section' => 'options_staff',
            'type' => 'number',
            'priority' => 20,
        )
    );

    // Add Section Services
    $wp_customize->add_section(
        'options_services',
        array(
            'title' => esc_html__( 'Services', 'autoresq' ),
            'description' => esc_html__( 'Options for services listing and more', 'autoresq' ),
            'priority' => 38,
        )
    );

    // Services sidebar
    $wp_customize->add_setting(
        'services_sidebar_option' ,
        array(
            'default' => 'right',
            'sanitize_callback' => 'autoresq_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'services_sidebar_option',
        array(
            'label' => esc_html__( 'Services Sidebar', 'autoresq' ),
            'section' => 'options_services',
            'type' => 'radio',
            'choices'  => array(
                'none' => esc_html__('None (full width)','autoresq'),
                'right' => esc_html__('Right','autoresq'),
            ),
            'priority'   => 10,
        )
    );

    // Services items per page
    $wp_customize->add_setting(
        'services_posts_per_page',
        array(
            'default' => '6',
            'sanitize_callback' => 'autoresq_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'services_posts_per_page',
        array(
            'label' => esc_html__('Services per Page ', 'autoresq'),
            'section' => 'options_services',
            'type' => 'number',
            'priority' => 20,
        )
    );


	// customizer styles
	wp_register_style( 'customizer_custom', get_template_directory_uri() . '/css/customizer.css' );
	wp_enqueue_style( 'customizer_custom' );

}
add_action( 'customize_register', 'autoresq_customizer' );



function autoresq_add_needed_google_fonts() {

	// get default menu font
	$protocol = is_ssl() ? 'https' : 'http';

	// get theme fonts
	$google_keyword_font_main = esc_attr( get_theme_mod( 'main_font_google','Lato' ) );
	$google_keyword_font_accent = esc_attr( get_theme_mod( 'accent_font_google','Montserrat' ) );


	if ( ! empty( $google_keyword_font_main ) ) {
		$google_weight_font_main = '300,400,500,600,700';
		$google_keyword_font_main_edited = str_replace( ' ', '+', $google_keyword_font_main );
	}


	if ( ! empty( $google_keyword_font_accent ) ) {
		$google_weight_font_accent = '300,400,500,600,700';
		$google_keyword_font_accent_edited = str_replace( ' ', '+', $google_keyword_font_accent );
	}

	//get the subset
	$google_font_subset = esc_attr( get_theme_mod( 'fonts_subset','' ) );
	if (!empty($google_font_subset)){
		$google_font_subset = '&subset='.str_replace(' ','',$google_font_subset);
	}

	wp_enqueue_style( 'autoresq-fonts', $protocol . '://fonts.googleapis.com/css?family=' . $google_keyword_font_main_edited . ':' . $google_weight_font_main .'|'. $google_keyword_font_accent_edited. ':' .$google_weight_font_accent  . $google_font_subset);


}

add_action( 'wp_enqueue_scripts', 'autoresq_add_needed_google_fonts' );



function autoresq_add_css_to_stylesheet() {

	$styles['main_font'] = esc_attr( get_theme_mod( 'main_font_google', 'Lato' ) );
	$styles['accent_font'] = esc_attr( get_theme_mod( 'accent_font_google', 'Montserrat' ) );
	$styles['theme_first_color'] = esc_attr( get_theme_mod( 'theme_first_color','#f4c70b' ) ); // first theme color yellow
	$styles['theme_second_color'] = esc_attr( get_theme_mod( 'theme_second_color','#072f4f' ) ); // second theme color blue
    $styles['title_background'] = esc_attr( get_theme_mod( 'title_background','#f2f2f2' ) ); // grey used for breadcrumb border too
    $styles['uppercase_header_title'] = esc_attr( get_theme_mod( 'uppercase_header_title','uppercase' ) ); // transform header title

    $styles['detail_color'] = esc_attr( get_theme_mod( 'detail_color', '#707070' ) ); //grey for details text
    $styles['line_color'] = esc_attr( get_theme_mod( 'line_color', '#f2f2f2' ) ); //light grey for detail post borders

	// menu font size
	$styles['menu_font_size'] = intval( get_theme_mod( 'menu_font_size',14 ) );
	// menu font weight
	$styles['menu_font_weight'] = intval( get_theme_mod( 'menu_font_weight', 600 ) );

	/**
	 * Menu Colors
	 */
	// menu first color
	$styles['menu_first_color'] = esc_attr( get_theme_mod( 'menu_first_color','#313131' ) );
	// menu second color
	$styles['menu_second_color'] = esc_attr( get_theme_mod( 'menu_second_color','#f4c70b' ) );
	//menu third color
	$styles['menu_third_color'] = esc_attr( get_theme_mod( 'menu_third_color','#707070' ) );
	//menu fourth color
	$styles['menu_fourth_color'] = esc_attr( get_theme_mod( 'menu_fourth_color','#313131' ) );

	// footer bg color
	$styles['footer_background_color'] = esc_attr( get_theme_mod( 'footer_background_color','#ffffff' ) ); // white
	// copyright text color
	$styles['copyright_color'] = esc_attr( get_theme_mod( 'copyright_color','#072f4f' ) ); // blue

	// header background-color
	$styles['menu_background_color'] = esc_attr( get_theme_mod( 'menu_background_color','#ffffff' ) ); // white
	$styles['menu_border_color'] = esc_attr( get_theme_mod( 'menu_border_color','#f2f2f2' ) ); // grey
	
	$styles['header_delimiter_color'] = esc_attr( get_theme_mod( 'header_delimiter_color', '#20425e' ) ); // blue

	// buttons text color
	$styles['pagination_second_color'] = esc_attr( get_theme_mod( 'pagination_second_color','#072f4f' ) ); // blue
	// buttons background color
	$styles['pagination_first_color'] = esc_attr( get_theme_mod( 'pagination_first_color','#f4c70b' ) ); // yellow

	// link colors
	$styles['link_color'] = esc_attr( get_theme_mod( 'link_color', '#072f4f' ) ); // dark blue

	$styles['footer_sidebar_background_color'] = esc_attr( get_theme_mod( 'footer_sidebar_background_color', '#072f4f' ) ); // blue
	$styles['footer_sidebar_above_background_color'] = esc_attr( get_theme_mod( 'footer_sidebar_above_background_color', '#072f4f' ) ); // blue
	$styles['footer_delimiter_color'] = esc_attr( get_theme_mod( 'footer_delimiter_color', '#20425e' ) ); // blue



	//social icons colors
	$styles['footer_social_icons_background_color'] = esc_attr( get_theme_mod( 'footer_social_icons_background_color', '#20425e' ) );
	$styles['footer_social_icons_color'] = esc_attr( get_theme_mod( 'footer_social_icons_color', '#072f4f' ) );
	$styles['footer_social_icons_hover_color'] = esc_attr( get_theme_mod( 'footer_social_icons_hover_color', '#f4c70b' ) );


	$css = "
    body, aside a,
    .ztl-package-circle .period,
    .ztl-main-font{
        font-family: '{$styles['main_font']}',sans-serif;
    }

    .ztl-announcement .line-1,
    #search-modal .search-title,
    .sidebar-footer h2,
    .sidebar-above-footer h2,
    .ztl-counter .counter,
    .ztl-package-circle .item,
    .ztl-package-description span:first-child,
    .ztl-countdown .grid h1,
    .ztl-steps-carousel .number-step,
    .comment-reply-title,
    .comments-title,
    .ztl-contact-heading,
    .ztl-error-code,
    .ztl-404-page-description,
    .ztl-heading,
    .page-top .entry-title,
    .ztl-accordion h4 a,
    .ztl-accent-font,
    .autoresq-navigation,
    .ztl-staff-item .staff-title,
    .ztl-post-item .item-content .title a {
    	 font-family: '{$styles['accent_font']}',sans-serif;
    }
    
    .ztl-tabs .vc_tta-panel-title > a,
    .ztl-tabs .vc_tta-tabs-list .vc_tta-tab > a{
        color: #ffffff !important;
        background-color: {$styles['theme_second_color']} !important;
        border:2px solid {$styles['theme_second_color']} !important;
    }
	
	.ztl-service-item .ztl-post-details:before,
	.ztl-post-item .item-content:before{
		border-left: 10px solid {$styles['theme_first_color']};
		border-top: 10px solid {$styles['theme_first_color']};
	}

    
    .ztl-tabs .vc_active .vc_tta-panel-title > a span:after,
    .ztl-tabs .vc_tta-tabs-list .vc_active > a span:after {
         border-top: 10px solid {$styles['theme_first_color']};
    }
    
    .ztl-tabs .vc_active .vc_tta-panel-title > a,
    .ztl-tabs .vc_tta-tabs-list .vc_tta-tab > a:hover,
    .ztl-tabs .vc_tta-tabs-list .vc_active > a,
    .ztl-tabs .vc_tta-panel-title> a:hover {
        background-color:{$styles['theme_first_color']} !important;
        color: #313131 !important;
        border:2px solid {$styles['theme_first_color']} !important;
    }
    
    .ztl-error-code,
    .ztl-404-page-description{
        color: {$styles['theme_second_color']};
    }

    .ztl-steps-carousel .owl-prev,
    .ztl-steps-carousel .owl-next,
    .ztl-clients-carousel .owl-prev,
    .ztl-clients-carousel .owl-next,
    .ztl-testimonials-carousel .owl-prev,
    .ztl-testimonials-carousel .owl-next{
    	 font-family: '{$styles['accent_font']}',sans-serif;
    	 color: #313131;
    	 background-color: {$styles['theme_first_color']};
    }

    .ztl-steps-carousel .owl-prev:hover,
    .ztl-steps-carousel .owl-next:hover,
    .ztl-clients-carousel .owl-prev:hover,
    .ztl-clients-carousel .owl-next:hover,
    .ztl-testimonials-carousel .owl-prev:hover,
    .ztl-testimonials-carousel .owl-next:hover{
    	 background-color: {$styles['theme_second_color']} !important;
    	 color:#fff;
    }
    
    .ztl-testimonials-carousel .owl-dots .owl-dot{
         border-color: {$styles['theme_first_color']};
    }
    .ztl-testimonials-carousel .owl-dots .owl-dot:hover, 
    .ztl-testimonials-carousel .owl-dots .owl-dot.active{
        background-color: {$styles['theme_first_color']} !important;
    }
    
    .ztl-first-color,
    .category-listing .item  .ztl-comments a:after,
    .widget_categories li a:before,
    .widget_nav_menu li a:before,
    .widget_archive li a:before,
    .widget_pages li a:before,
    .widget_recent_entries li a:before,
    .widget_rss li a:before,
    .widget_meta li a:before,
    .widget_recent_comments li a:before,
    .woocommerce.widget.widget_layered_nav li a:before,
    .ztl-header-image .ztl-date-header a span,
    .widget_calendar #prev a:before,
	.widget_calendar #next a:after,
	.category-listing .item .ztl-delimiter-post{
       color: {$styles['theme_first_color']};
    }
    
    .sidebar-footer .widget-title::before {
        border-top: 2px solid {$styles['footer_delimiter_color']};
	}
	
	footer .widget_pages li,
	footer .widget_nav_menu li,
	footer .widget_rss li,
	footer .widget_recent_entries li,
	footer .widget_recent_comments li,
	footer .widget_meta li,
	footer .widget_categories li,
	footer .widget_archive li,
	footer .woocommerce.widget.widget_layered_nav li {
	    border-bottom: 2px solid {$styles['footer_delimiter_color']};
	}
	
	footer .widget_categories li,
	footer .widget_archive li, 
	footer .woocommerce.widget.widget_layered_nav li,
	footer .widget_rss li span.rss-date,
	footer .widget_rss cite, 
	footer .widget_calendar tbody{
		color:#f2f2f2;
	}
	
	footer select,
	footer .sidebar-footer input[type='search'] {
        border-color: {$styles['footer_delimiter_color']} !important;
		color: {$styles['theme_second_color']} !important;
		font-weight:600;
	}
	
	footer td {
	    border-top: 2px solid {$styles['footer_delimiter_color']} !important;
    }
	
	footer ::-webkit-input-placeholder {
        color: {$styles['footer_delimiter_color']};
	}
	
	footer :-moz-placeholder {
	    color: {$styles['footer_delimiter_color']};
	}
	
	footer ::-moz-placeholder {
	    color: {$styles['footer_delimiter_color']};
	}
	
	footer :-ms-input-placeholder {
	    color: {$styles['footer_delimiter_color']};
	}
	
	footer .widget_calendar table tfoot {
        background-color: #ffffff;
	}
	
	footer .widget_calendar tfoot a{
		color: {$styles['theme_second_color']} !important;
	}
	
	footer .widget_calendar caption {
        border-top:2px solid {$styles['footer_delimiter_color']};
        border-left:2px solid {$styles['footer_delimiter_color']};
        border-right:2px solid {$styles['footer_delimiter_color']};
        background-color: #ffffff;
        color: {$styles['theme_second_color']};
	}
	
	footer .widget_calendar table thead th:last-child,
	footer .widget_calendar table tbody td:last-child,
	footer .widget_calendar #next {
		border-right: 2px solid {$styles['footer_delimiter_color']} !important;
	}
	
	footer .widget_calendar table thead th:first-child,
	footer .widget_calendar table tbody td:first-child,
	footer .widget_calendar #prev {
		border-left: 2px solid {$styles['footer_delimiter_color']} !important;
	}

	footer .widget_calendar tfoot td{
		border-bottom: 2px solid {$styles['footer_delimiter_color']};
	}
	
	footer .widget .tagcloud a {
	    background-color: {$styles['footer_delimiter_color']} !important;
	}
	
	footer .widget .tagcloud a:hover {
	    color: {$styles['theme_second_color']} !important;
		background-color: #ffffff !important;
	}
	
	
	header .widget-title::before {
        border-top: 2px solid {$styles['header_delimiter_color']};
	}
	
	header .widget_pages li,
	header .widget_nav_menu li,
	header .widget_rss li,
	header .widget_recent_entries li,
	header .widget_recent_comments li,
	header .widget_meta li,
	header .widget_categories li,
	header .widget_archive li,
	header .woocommerce.widget.widget_layered_nav li {
	    border-bottom: 2px solid {$styles['header_delimiter_color']};
	}
	
	header .widget_categories li,
	header .widget_archive li, 
	header .woocommerce.widget.widget_layered_nav li,
	header .widget_rss li span.rss-date,
	header .widget_rss cite, 
	header .widget_calendar tbody{
		color:#f2f2f2;
	}
	
	header .widget_calendar caption {
        border-top:2px solid {$styles['header_delimiter_color']};
        border-left:2px solid {$styles['header_delimiter_color']};
        border-right:2px solid {$styles['header_delimiter_color']};
        background-color: #ffffff;
        color: {$styles['theme_second_color']};
	}
	
	header .widget_calendar table thead th:last-child,
	header .widget_calendar table tbody td:last-child,
	header .widget_calendar #next {
		border-right: 2px solid {$styles['header_delimiter_color']} !important;
	}
	
	header .widget_calendar table thead th:first-child,
	header .widget_calendar table tbody td:first-child,
	header .widget_calendar #prev {
		border-left: 2px solid {$styles['header_delimiter_color']} !important;
	}

	header .widget_calendar tfoot td{
		border-bottom: 2px solid {$styles['header_delimiter_color']};
	}
	
	header .widget .tagcloud a {
	    background-color: {$styles['header_delimiter_color']} !important;
	}
	
	header .widget .tagcloud a:hover {
	    color: {$styles['theme_second_color']} !important;
		background-color: #ffffff !important;
	}
	
	
	header select,
	header .sidebar-header input[type='search'] {
        border-color: {$styles['header_delimiter_color']} !important;
		color: {$styles['theme_second_color']} !important;
		font-weight:600;
	}
	
	header td {
	    border-top: 2px solid {$styles['header_delimiter_color']} !important;
    }
	
	header ::-webkit-input-placeholder {
        color: {$styles['header_delimiter_color']};
	}
	
	header :-moz-placeholder {
	    color: {$styles['header_delimiter_color']};
	}
	
	header ::-moz-placeholder {
	    color: {$styles['header_delimiter_color']};
	}
	
	header :-ms-input-placeholder {
	    color: {$styles['header_delimiter_color']};
	}
	
	header .widget_calendar table tfoot {
        background-color: #ffffff;
	}
	
	header .widget_calendar tfoot a{
		color: {$styles['theme_second_color']} !important;
	}
	
	header .widget_calendar table thead th:last-child,
	header .widget_calendar table tbody td:last-child,
	header .widget_calendar #next {
		border-right: 2px solid {$styles['header_delimiter_color']} !important;
	}
	
	header .widget_calendar table thead th:first-child,
	header .widget_calendar table tbody td:first-child,
	header .widget_calendar #prev {
		border-left: 2px solid {$styles['header_delimiter_color']} !important;
	}

	header .widget_calendar tfoot td{
		border-bottom: 2px solid {$styles['header_delimiter_color']};
	}
	
	header .widget .tagcloud a {
	    background-color: {$styles['header_delimiter_color']} !important;
	}
	
	header .widget .tagcloud a:hover {
	    color: {$styles['theme_second_color']} !important;
		background-color: #ffffff !important;
	}
	
	
	aside select,
	aside input[type='search'] {
		color: {$styles['theme_second_color']} !important;
	}
	
	aside ::-webkit-input-placeholder {
        color: {$styles['theme_second_color']};
	}
	
	aside :-moz-placeholder {
	    color: {$styles['theme_second_color']};
	}
	
	aside ::-moz-placeholder {
	    color: {$styles['footer_delimiter_color']};
	}
	
	aside :-ms-input-placeholder {
	    color: {$styles['theme_second_color']};
	}
	
	aside input[type='search'] {
		font-weight:600;
	}
	
	.sidebar-above-footer .widget-title::before {
        border-top: 2px solid {$styles['footer_delimiter_color']};
	}
	
	blockquote{
	 	border-left: 2px solid {$styles['theme_first_color']};
	}
    
    .ztl-accordion h4 a,
    .ztl-accordion h4 a:hover{
       color: #313131 !important;
    }
    
    .ztl-accordion h4 a i:before,
    .ztl-accordion h4 a i:after{
        border-color: {$styles['theme_first_color']} !important;
    }

    .ztl-button-one a,
    .ztl-button-two a,
    .ztl-button-two span.ztl-action,
    .ztl-button-three a,
    .ztl-button-four a{
    	white-space: nowrap;
    }

    /*Button Style One*/
   
    .ztl-button-one a,
    .ztl-button-one button, 
    .ztl-button-one input[type=\"submit\"]{
    	padding:14px 20px !important;
    	border-radius:5px;
    	font-size:14px;
    	line-height:20px;
		transition: all .2s ease-in-out;
		-webkit-transition: all .2s ease-in-out;
		font-weight:600;
		font-family: '{$styles['accent_font']}',sans-serif;
		text-transform:uppercase;
		text-decoration:none;
		display:inline-block;
		border:none;
    }
    
    .ztl-button-one a,
    .ztl-button-one a:focus,
    .ztl-button-one button,
    .ztl-button-one button:focus,
    .ztl-button-one input[type=\"submit\"],
    .ztl-button-one input[type=\"submit\"]:focus{
    	color: #313131 !important;
    	background-color: {$styles['theme_first_color']} !important;
    	text-decoration:none;

    }
    .ztl-button-one button:hover,
    .ztl-button-one button:active,
    .ztl-button-one a:hover,
    .ztl-button-one a:active,
    .ztl-button-one input[type=\"submit\"]:hover,
    .ztl-button-one input[type=\"submit\"]:active {
    	color: #ffffff !important;
    	background-color: {$styles['theme_second_color']} !important;
    	text-decoration:none;
    }
    

    /*Button Style Two*/

    .ztl-button-two a,
    .ztl-button-two span.ztl-action,
    .ztl-button-two button,
    .ztl-button-two input[type=\"submit\"]{
    	padding:14px 20px !important;
    	border-radius:5px;
    	font-size:14px;
    	line-height:20px;
    	transition: all .2s ease-in-out;
    	-webkit-transition: all .2s ease-in-out;
		cursor:pointer;
		font-weight:600;
		font-family: '{$styles['accent_font']}',sans-serif;
		text-transform:uppercase;
		text-decoration:none;
		display:inline-block;
		border:none;
    }
    .ztl-button-two a,
    .ztl-button-two a:focus,    
    .ztl-button-two span.ztl-action,
    .ztl-button-two span.ztl-action:focus,
    .ztl-button-two button,
    .ztl-button-two button:focus,
    .ztl-button-two input[type=\"submit\"],
    .ztl-button-two input[type=\"submit\"]:focus{
    	color: #ffffff !important;
    	background-color: {$styles['theme_second_color']} !important;
    	text-decoration:none;
    }
    .ztl-button-two button:hover,
    .ztl-button-two button:active,    
    .ztl-button-two span.ztl-action:hover,
    .ztl-button-two span.ztl-action:active,
    .ztl-button-two a:hover,
    .ztl-button-two a:active,
    .ztl-button-two input[type=\"submit\"]:hover,
    .ztl-button-two input[type=\"submit\"]:active {
    	color: #313131 !important;
    	background-color: {$styles['theme_first_color']} !important;
    	text-decoration:none;
    	cursor:pointer;
    }
    
    
    /*Button Style Three*/

    .ztl-button-three a,
    .ztl-button-three button,
    .ztl-button-three input[type=\"submit\"]{
    	padding:14px 20px !important;
    	border-radius:5px;
    	font-size:14px;
    	line-height:20px;
    	transition: all .2s ease-in-out;
    	-webkit-transition: all .2s ease-in-out;
		cursor:pointer;
		font-weight:600;
		font-family: '{$styles['accent_font']}',sans-serif;
		text-transform:uppercase;
		text-decoration:none;
		display:inline-block;
		border:none;
    }
    .ztl-button-three a,
    .ztl-button-three a:focus,
    .ztl-button-three button,
    .ztl-button-three button:focus,
    .ztl-button-three input[type=\"submit\"],
    .ztl-button-three input[type=\"submit\"]:focus{
    	background-color: {$styles['theme_first_color']} !important;
    	color: #313131 !important;
    	text-decoration:none;
    }
    .ztl-button-three button:hover,
    .ztl-button-three button:active,
    .ztl-button-three a:hover,
    .ztl-button-three a:active,
    .ztl-button-three input[type=\"submit\"]:hover,
    .ztl-button-three input[type=\"submit\"]:active {
    	color: #313131 !important;
    	background-color: #ffffff !important;
    	text-decoration:none;
    	cursor:pointer;
    }


    /*Button Style Four*/

    .ztl-button-four a,
    .ztl-button-four button{
    	padding:14px 20px !important;
    	border-radius:5px;
    	font-size:14px;
    	line-height:20px;
    	transition: all .2s ease-in-out;
    	-webkit-transition: all .2s ease-in-out;
		cursor:pointer;
		font-weight:600;
		font-family: '{$styles['accent_font']}',sans-serif;
		text-transform:uppercase;
		text-decoration:none;
		display:inline-block;
		border:none;
    }
    .ztl-button-four a,
    .ztl-button-four a:focus,
    .ztl-button-four button,
    .ztl-button-four button:focus{
    	background-color: {$styles['theme_second_color']} !important;
    	color: #ffffff !important;
    	text-decoration:none;
    }
    .ztl-button-four button:hover,
    .ztl-button-four button:active,
    .ztl-button-four a:hover,
    .ztl-button-four a:active{
    	color: #313131 !important;
    	background-color: #fff !important;
    	text-decoration:none;
    	cursor:pointer;
    }
    
    /* Autoresq Navigation */
    .autoresq-navigation .esg-navigationbutton:hover,
    .autoresq-navigation .esg-filterbutton:hover,
    .autoresq-navigation .esg-sortbutton:hover,
    .autoresq-navigation .esg-sortbutton-order:hover,
    .autoresq-navigation .esg-cartbutton-order:hover,
    .autoresq-navigation .esg-filterbutton.selected{
        color: #313131 !important;
    	background-color: {$styles['theme_first_color']} !important;
    	text-decoration:none;
    	cursor:pointer;
    	font-family: '{$styles['main_font']}',sans-serif;
		font-weight:600;
    }
    
    .autoresq-navigation .esg-filterbutton,
    .autoresq-navigation .esg-navigationbutton,
    .autoresq-navigation .esg-sortbutton,
    .autoresq-navigation .esg-cartbutton{
    	color: #ffffff !important;
    	background-color: {$styles['theme_second_color']} !important;
    	text-decoration:none;
    	font-family: '{$styles['main_font']}',sans-serif;
		font-weight:600 !important;
    }

    /* Shortcodes default colors */

    .ztl-divider.primary > span.circle{ border:2px solid {$styles['theme_first_color']}; }
	.ztl-divider.primary > span > span:first-child{ background-color: {$styles['theme_first_color']}; }
	.ztl-divider.primary > span > span:last-child{ background-color: {$styles['theme_first_color']}; }
	.ztl-divider.secondary > span{ background-color: {$styles['theme_first_color']}; }


	.ztl-widget-recent-posts ul > li > .ztl-recent-post-date span{
		color: {$styles['theme_first_color']} !important;
		font-size:20px;
		font-weight: bold;
	}

	.ztl-grid-post-date span,
	.eg-item-skin-autoresq-blog-element-31 span,
	.ztl-service-date span{
		color: {$styles['theme_first_color']} !important;
		font-size:20px;
	}
	
	.ztl-service-info {
		color: {$styles['theme_second_color']};
	}

	#ztl-loader, .ztl-filter-loader{
		border-top: 2px solid {$styles['theme_first_color']};
	}

	.ztl-list li:before{
		color:{$styles['theme_first_color']};
	}

    a,
    .ztl-link,
    .ztl-title-medium,
    .ztl-staff-item .staff-title,
    .no-results .page-title,
    .category-listing .title a {
        color: {$styles['link_color']};
    }
    .ztl-widget-recent-posts h6 a:hover{
        color: {$styles['link_color']};
    }
    
    .comment-navigation .nav-previous a:hover,
	.paging-navigation .nav-previous a:hover,
	.comment-navigation .nav-next a:hover,
	.paging-navigation .nav-next a:hover,
    .post-navigation .nav-previous a:hover,
    .post-navigation .nav-next a:hover{
        color: {$styles['link_color']};
    }
    
    a:visited,
    a:active,
    a:focus,
    .sidebar-right .menu a{
        color: {$styles['link_color']};
    }
    a:hover,
    .sidebar-right li>a:hover {
        color: {$styles['link_color']};
    }
    
    .ztl-social li .ztl-icon{
        background-color:{$styles['footer_social_icons_background_color']};
    }

    .ztl-social a{
        color: {$styles['footer_social_icons_color']};
    }
    .ztl-social a:hover{
        color: {$styles['footer_social_icons_hover_color']};
    }

    #ztl-shopping-bag .qty{
    	background-color:{$styles['menu_second_color']};
    	color:#fff;
    	font-family: '{$styles['accent_font']}',sans-serif;
    }
    
    #ztl-shopping-bag  a .ztl-cart-quantity,
    #ztl-shopping-bag  a:hover .ztl-cart-quantity{
        color: {$styles['theme_second_color']};
    }

    #menu-toggle span {
        background-color:{$styles['menu_second_color']};
    }

    .main-navigation .menu-item-has-children > a:after{
    	color:{$styles['menu_second_color']};
    }

    #ztl-copyright{
        color: {$styles['copyright_color']};
    }

    #ztl-copyright a{
		text-decoration:underline;
		cursor:pointer;
		color: {$styles['copyright_color']};
    }

    .main-navigation a{
        font-size: {$styles['menu_font_size']}px;
        font-weight: {$styles['menu_font_weight']};
     }

    .main-navigation ul ul li{
    	background-color: {$styles['menu_second_color']} !important;
    }
    .main-navigation ul ul li:first-child:before {
		content: '';
		width: 0;
		height: 0;
		border-left: 10px solid transparent;
		border-right: 10px solid transparent;
		border-bottom: 10px solid {$styles['menu_second_color']};
		position: absolute;
		top: -10px;
		left: 20px;
	}

	.main-navigation ul ul ul li:first-child:before {
		content: '';
		width: 0;
		height: 0;
		border-top: 10px solid transparent;
		border-bottom: 10px solid transparent;
		border-right: 10px solid {$styles['menu_second_color']};
		position: absolute;
		left: -20px;;
		top: 23px;
	}

    .main-navigation ul ul li a,
    .main-navigation ul ul li:hover a{
        color: {$styles['menu_fourth_color']} !important;
    }
    
    .main-navigation .menu-item-has-children .menu-item-has-children > a:after{
        color: {$styles['menu_fourth_color']};
        -ms-transform: rotate(270deg);
        -webkit-transform: rotate(270deg);
        transform: rotate(270deg);
        
    }

    .main-navigation a{
        color: {$styles['menu_first_color']} !important;
    }

    /*.main-navigation .current_page_item > a,
    .main-navigation .current_page_ancestor > a,
    .main-navigation .current-menu-item > a,
    .main-navigation .current-menu-ancestor > a,
    .main-navigation .sub-menu li.current-menu-item > a,
    .main-navigation .sub-menu li.current_page_item > a{
        color: {$styles['menu_second_color']} !important;
    }

	.main-navigation ul ul > li:hover > a {
    	 color: {$styles['menu_second_color']} !important;
	} */


	.ztl-tools-wrapper .item span{
		color:{$styles['menu_first_color']};
	}
	.ztl-tools-wrapper .item span:hover{
		color:{$styles['menu_second_color']};
	}

	#ztl-shopping-bag div:hover span{
		color:{$styles['menu_second_color']};
	} 
    
    .comment-navigation i,
    .paging-navigation .ztl-icon-navigation,
    .post-navigation .ztl-icon-navigation  {
        color: {$styles['theme_first_color']};
    }
    
    .ztl-recent-post-date,
    .ztl-recent-post-date a,
    .ztl-post .date a,
    .category-listing .date a,
	.category-listing .info,
	.category-listing .info a,
    .category-listing .item .date,
    .category-listing .item .date a,
    .widget .tagcloud a{
        color:{$styles['detail_color']};
        font-weight:600;
    }
    
    .ztl-recent-post-date a span,
    .ztl-single .date a span,
    .category-listing .item .date a span{
        color: {$styles['theme_first_color']};
        font-size: 20px; 
        font-weight:bold;
    }
    
    .ztl-date-default{
        padding-right: 5px;
    }
    
    .ztl-service-info-line span span{
        color:{$styles['theme_first_color']};
    }

    .tp-leftarrow,
    .tp-rightarrow{
        background-color:transparent !important;
    }
    
    .site-footer .site-info{
        background-color:{$styles['footer_background_color']};
    }
    .site-header{
        background-color:{$styles['menu_background_color']};
        border-color: {$styles['menu_border_color']};
    }
    
    .ztl-tools-wrapper .item,
    .category-listing .item .info,
    .ztl-post .info {
    	border-color: {$styles['line_color']};
    }
	
	.comment-navigation .nav-previous,
    .paging-navigation .nav-previous,
    .post-navigation .nav-previous,
    .comment-navigation .nav-next,
    .paging-navigation .nav-next,
    .post-navigation .nav-next{
		background-color: {$styles['line_color']};
	}
	
	.nav-previous:after{
		content:'';
		display:block;
		position:absolute;
		right:0;
		top:0;
		width:35px;
		height:10px;
		border-top: 2px solid {$styles['theme_first_color']};
		border-right: 2px solid {$styles['theme_first_color']};
	}
	
	.nav-previous:before{
		position: absolute;
		top:0px;
		right:42px;
		content:'';
		width:100%;
		border-top:2px solid #eaeaea;
	}
	
	.nav-next:before{
		position: absolute;
		top:0px;
		left:42px;
		content:'';
		width:100%;
		border-top:2px solid #eaeaea;
	}
	
	.nav-next:after{
		content:'';
		display:block;
		position:absolute;
		left:0;
		top:0;
		width:35px;
		height:10px;
		border-top: 2px solid {$styles['theme_first_color']};;
		border-left: 2px solid {$styles['theme_first_color']};
	}
	
    .comment article {
        border-bottom: 2px solid {$styles['line_color']};
    }
    
    .ztl-breadcrumb-container{
        border-color: {$styles['title_background']};
    }
    
    .ztl-header-image .custom-header-title{
        text-transform: {$styles['uppercase_header_title']};
    }
    
    .category-listing .item:after{
        background-color: {$styles['line_color']};
    }

    .category-listing .item i,
    .ztl-post i,
    .ztl-widget-recent-posts ul>li>a+h6+span i{
        color: {$styles['theme_first_color']};
    }

    .ztl-scroll-top:hover,
    .widget .tagcloud a:hover,
    .ztl-sticky .item-media a:before,
    .ztl-sticky .item-content .title a:before{
        background-color: {$styles['theme_first_color']};
    }

    .pagination .page-numbers-wrap {
        color:#313131;
        font-weight:600;
        font-size:14px;
        font-family: {$styles['accent_font']};
    }
    
    .vc_tta-color-white.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-heading:hover {
        color: #313131 !important;
        background-color:{$styles['pagination_first_color']} !important;
     }
	 
	.pagination .current .page-numbers-wrap,
	.pagination .current:hover .page-numbers-wrap{
		color: #313131 !important;
	}
	
	.pagination .current .page-numbers-hexagon,
	.pagination .current:hover .page-numbers-hexagon{
		background-color:{$styles['pagination_first_color']} !important;
	}
	
    .pagination .page-numbers:hover .page-numbers-hexagon{
        background-color: {$styles['pagination_second_color']};
    }
	
	.pagination .page-numbers:hover .page-numbers-wrap{
		color: #ffffff;
	}
	
    .pagination .prev:hover,
    .pagination .next:hover {
        color:{$styles['pagination_first_color']};
        background-color:transparent !important;
	}

    .category-sidebar-right .widget_text li:before,
    .post-sidebar-right .widget_text li:before,
    .ztl-post-info:before{
        color:{$styles['theme_first_color']};
    }

    aside select {
        border-color: #eaeaea;
		font-weight: 600;
    }

    aside caption {
    	color: {$styles['theme_second_color']};
    }
    
    .ztl-sticky .title a:before{
        color: {$styles['theme_first_color']};
    }
        
    .comment-author,
    .comments-title,
    .comment-reply-title {
        color: {$styles['theme_second_color']} !important;
    }
    .custom-header-title::after {
        background-color: {$styles['theme_first_color']};
    }
    
    .sidebar-right .widget-title::after,
    .widget-title::after,
    .woocommerce .related.products > h2::after,
	.woocommerce .woocommerce-tabs .wc-tab > h2::after {
        border-color:{$styles['theme_first_color']} !important;
    }
    
    .sidebar-right h2.widget-title{
        color: {$styles['theme_second_color']};
    }
    
    .sidebar-footer {
        background-color: {$styles['footer_sidebar_background_color']};
    }
    
    .sidebar-above-footer {
        background-color: {$styles['footer_sidebar_above_background_color']};
    }
    
    .ztl-widget-category-container .author a,
    .ztl-widget-category-container .category,
    .ztl-widget-category-container .category a,
    .ztl-widget-category-container .entry-date,
    .ztl-widget-category-container .entry-date a,
    .category-listing .info a,
    .category-listing .info,
    .posted-on a, .byline,
    .byline .author a,
    .entry-footer, .comment-form,
    .entry-footer a,
    .ztl-post .info,
    .comment-metadata a,
    .ztl-post .info a,
    .ztl-breadcrumb-container,
    .wp-caption .wp-caption-text,
    .gallery-caption,
    .ztl-service-info-line span,
    .ztl-staff-item .staff-position,
    blockquote,
    .widget_categories li,
	.widget_archive li,
	.woocommerce.widget.widget_layered_nav li,
	.widget_rss li span.rss-date,
	.widget_rss cite,
	.widget_calendar tbody{
        color:{$styles['detail_color']};
    }
    
    .custom .tp-bullet{
        background-color:{$styles['theme_first_color']} !important;
        color:#313131 !important;
    }
    
    .ztl-gallery-sign-wrapper .ztl-gallery-sign,
    .ztl-table>.v-2 tr td:first-of-type,
    .ztl-table>.v-2 tr th:first-of-type,
    .ztl-table>thead>tr>th {
        background-color:{$styles['theme_first_color']} !important;
    }
    
    .ztl-gallery-sign-wrapper .ztl-gallery-plus{
        color:#313131 !important;
    }
    
    .ztl-gallery-sign-wrapper:hover .ztl-gallery-plus{
        color:#313131 !important;
    }
    
    .ztl-gallery-sign-wrapper:hover .ztl-gallery-sign{
        background-color:#ffffff !important;
    }
 
	#respond ::-webkit-input-placeholder,
	.ztl-subscribe-form ::-webkit-input-placeholder,
	#search-modal ::-webkit-input-placeholder {
	    color: {$styles['detail_color']};
	}
	
	#respond :-moz-placeholder,
	.ztl-subscribe-form :-moz-placeholder,
	#search-modal :-moz-placeholder {
	    color: {$styles['detail_color']};
	}
	
	#respond ::-moz-placeholder,
	.ztl-subscribe-form ::-moz-placeholder,
	#search-modal ::-moz-placeholder {
	    color: {$styles['detail_color']};
	}
	
	#respond :-ms-input-placeholder,
	.ztl-subscribe-form :-ms-input-placeholder,
	#search-modal :-ms-input-placeholder {
	    color: {$styles['detail_color']};
	}
    
 
    @media only screen and (max-width: 767px) {
    	.main-navigation ul ul li a,
    	.main-navigation ul ul li:hover a{
    		color:{$styles['menu_third_color']} !important;
    	}
        .main-navigation ul li{
            border-bottom:1px solid {$styles['menu_border_color']};
        }
        .main-navigation ul ul li:first-child{
            border-top:1px solid {$styles['menu_border_color']};
        }
        .main-navigation .menu-item-has-children .menu-item-has-children > a:after{
        color: {$styles['menu_second_color']};
        -ms-transform: rotate(0deg);
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
        
    }
    }
";

//boxed mode
if ( get_theme_mod( 'layout_mode' ) == 'boxed' ){
    $css .= "
        .wrapper {overflow: hidden;}
    ";
}

        //In case WooCommerce is activated we append custom styles
if ( class_exists( 'WooCommerce' ) ) {
	$css .= "
		.widget.woocommerce ul li .quantity,
		.widget.woocommerce ul li .amount,
		.woocommerce .widget_shopping_cart .total,
		.woocommerce.widget_shopping_cart .total,
		.woocommerce .product .amount,
		.price_slider_amount .price_label,
		.widget.woocommerce  .reviewer{
			color:#313131;
			font-weight:600;
			font-size: 20px;
		}
		
		.woocommerce ul.products li.product .price del{
			padding-right:3px;
		}
		
		.woocommerce ul.products li.product .price del span{
			font-size:16px;
		}
		
		.woocommerce a.button.added:after,
		.woocommerce div.product form.cart .variations label{
        	color: {$styles['theme_second_color']} !important;
    	}
    	
    	/*WooCommerce Notices*/
        .woocommerce a.remove,
        .woocommerce .widget_rating_filter ul li.chosen a:before,
        .woocommerce .widget_layered_nav ul li.chosen a:before,
        .woocommerce .widget_layered_nav_filters ul li a:before {
            color:{$styles['detail_color']} !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: {$styles['detail_color']}  transparent transparent !important;
        }
		
		.woocommerce .select2-container--default .select2-selection--single{
			border-color:#eaeaea !important;
		}
        
        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent {$styles['detail_color']}  !important;
        }
        
        .woocommerce .woocommerce-message,
        .woocommerce .woocommerce-info,
        .woocommerce .woocommerce-error,
        .woocommerce form .form-row.woocommerce-invalid .select2-container,
        .woocommerce form .form-row.woocommerce-invalid select{
            border-color: {$styles['line_color']} !important;
        }
        
        .select2-container--default .select2-results__option[aria-selected=true],
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: {$styles['line_color']};
            color:#545454;
        }
        
        .woocommerce .select2-container .select2-choice,
        .woocommerce .quantity input,
        .woocommerce #reviews #comments ol.commentlist li .comment-text,
        .woocommerce table.shop_table,
        #add_payment_method table.cart td.actions .coupon .input-text,
        .coupon .input-text,
        .woocommerce-checkout table.cart td.actions .coupon .input-text,
        .woocommerce .quantity .qty,
        .select2-dropdown {
            border: 2px solid {$styles['line_color']};
        }
        
        #add_payment_method #payment div.payment_box,
        .woocommerce-cart #payment div.payment_box,
        .woocommerce-checkout #payment div.payment_box,
        .woocommerce-cart table.cart td.actions .coupon .input-text{
            background-color: {$styles['line_color']};
        }
        
        #add_payment_method #payment div.payment_box:before,
        .woocommerce-cart #payment div.payment_box:before,
        .woocommerce-checkout #payment div.payment_box:before {
            border: 2px solid {$styles['line_color']};
            border-top-color: transparent;
            border-left-color: transparent;
            border-right-color: transparent;
        }
        
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 2px solid {$styles['line_color']} !important;
        }
        
        
        .woocommerce form .form-row.woocommerce-validated .select2-container,
        .woocommerce form .form-row.woocommerce-validated input.input-text,
        .woocommerce form .form-row.woocommerce-validated select{
              border-color: {$styles['line_color']};
        }
        
        #add_payment_method .cart-collaterals .cart_totals tr td,
        #add_payment_method .cart-collaterals .cart_totals tr th,
        .woocommerce-cart .cart-collaterals .cart_totals tr td,
        .woocommerce-cart .cart-collaterals .cart_totals tr th,
        .woocommerce-checkout .cart-collaterals .cart_totals tr td,
        .woocommerce-checkout .cart-collaterals .cart_totals tr th,
        .woocommerce table.shop_table tfoot th{
            border-top: 2px solid  {$styles['line_color']};
        }
        
        .woocommerce table.shop_table td {
            border-top: 2px solid  {$styles['line_color']} !important;
        }
        
        #add_payment_method #payment, 
        .woocommerce-checkout #payment,
        .woocommerce-MyAccount-navigation{
            background-color: {$styles['line_color']};
        }
        
        .woocommerce div.product .woocommerce-tabs ul.tabs li {
            border-radius: 0;
            border: solid 2px {$styles['line_color']};
            background-color: {$styles['line_color']};
        }
                
    	.woocommerce #respond input#submit,
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt{
			color: #313131;
			background-color: {$styles['theme_first_color']} !important;
			text-transform:uppercase;
			font-family: {$styles['accent_font']};
		}
    	
    	.woocommerce #respond input#submit:hover,
    	.woocommerce a.button:hover,
    	.woocommerce button.button:hover,
    	.woocommerce input.button:hover,
    	.woocommerce a.button.alt:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button.alt:hover,
		.woocommerce .single_add_to_cart_button:hover{
        	background-color:{$styles['theme_second_color']} !important;
        	color:#ffffff !important;
    	}
    	
		.woocommerce #respond input#submit.alt.disabled,
		.woocommerce #respond input#submit.alt.disabled:hover,
		.woocommerce #respond input#submit.alt:disabled,
		.woocommerce #respond input#submit.alt:disabled:hover,
		.woocommerce #respond input#submit.alt:disabled[disabled],
		.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
		.woocommerce a.button.alt.disabled,
		.woocommerce a.button.alt.disabled:hover,
		.woocommerce a.button.alt:disabled,
		.woocommerce a.button.alt:disabled:hover,
		.woocommerce a.button.alt:disabled[disabled],
		.woocommerce a.button.alt:disabled[disabled]:hover,
		.woocommerce button.button.alt.disabled,
		.woocommerce button.button.alt.disabled:hover,
		.woocommerce button.button.alt:disabled,
		.woocommerce button.button.alt:disabled:hover,
		.woocommerce button.button.alt:disabled[disabled],
		.woocommerce button.button.alt:disabled[disabled]:hover,
		.woocommerce input.button.alt.disabled,
		.woocommerce input.button.alt.disabled:hover,
		.woocommerce input.button.alt:disabled,
		.woocommerce input.button.alt:disabled:hover,
		.woocommerce input.button.alt:disabled[disabled],
		.woocommerce input.button.alt:disabled[disabled]:hover,
		.woocommerce input.button:disabled, 
		.woocommerce input.button:disabled[disabled],
		.woocommerce input.button:disabled:hover, 
		.woocommerce input.button:disabled[disabled]:hover{
            background-color: #ffffff;
            color:{$styles['theme_first_color']};
		}

		.woocommerce p.stars a,
		.woocommerce .star-rating:before,
		.woocommerce .star-rating {
			color:{$styles['theme_first_color']};
		}
		
		.woocommerce .star-rating::before {
		    color:{$styles['detail_color']} !important;
		}
		
		.woocommerce span.onsale{
			background-color: {$styles['theme_first_color']};
		}
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range{
			background-color: {$styles['theme_second_color']};
		}

		.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content{
			background-color:" . autoresq_hex2rgba( $styles['theme_second_color'],0.5 ) . ";
		}
		.woocommerce-page #content h1,
		.woocommerce-page #content h2,
		.woocommerce-page #content h3,
		.woocommerce-thankyou-order-received{
			color: {$styles['theme_second_color']};
		}
		
		.woocommerce form .form-row label{
			color: {$styles['theme_second_color']} !important;
		}
		
		.woocommerce-page #content h1,
		.woocommerce-page #content h2,
		.woocommerce-page #content h3{
			font-weight: 600;
		}
		
        .woocommerce .widget_shopping_cart .total,
        .woocommerce.widget_shopping_cart .total {
            border-top: 2px solid {$styles['line_color']};
        }
        
        .woocommerce .cart_totals h2,
        .woocommerce-checkout h3,
        .woocommerce-account h3,
        .woocommerce-account h2,
        .woocommerce .related.products section>h2{
            font-family: {$styles['accent_font']};
            text-transform:uppercase;
        } 
        
        .woocommerce form.checkout_coupon,
        .woocommerce form.login,
        .woocommerce form.register{
            border: 2px solid {$styles['line_color']};
            border-radius:5px;
        } 
        
        .woocommerce .order_details li {
            border-right: 2px solid {$styles['line_color']};
        }
        
        .woocommerce ul.products:after{
            background-color: {$styles['line_color']};
        }
        
        .woocommerce form  input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 50px {$styles['line_color']} inset;
        }

        .woocommerce form  input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 50px {$styles['line_color']} inset;
        }
        
        .ztl-checkbox-helper{
            background-color: {$styles['line_color']};
        }
            
        .woocommerce form .form-row input[type='text'],
        .woocommerce form .form-row input[type='tel'],
        .woocommerce form .form-row input[type='email'],
        .woocommerce form .form-row input[type='password']{
            background-color: {$styles['line_color']} !important;
            border:2px solid  #eaeaea;
            border-radius: 5px;
            line-height: 20px;
            padding: 12px 20px;
        }
        
        .woocommerce form .form-row textarea{
            background-color: {$styles['line_color']} !important;
            border:2px solid  #eaeaea;
            min-height: 26rem;
        } 
	";
}



	wp_add_inline_style( 'autoresq-style', wp_strip_all_tags( $css ) );
}

add_action( 'wp_enqueue_scripts', 'autoresq_add_css_to_stylesheet' );


// Sanitize text function
function autoresq_sanitize_text( $input ) {
	return wp_kses_post( ( $input ) );
}
