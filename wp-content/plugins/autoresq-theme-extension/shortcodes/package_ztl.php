<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('package_ztl', 'ztl_shortcode_package');


function ztl_shortcode_package( $atts ) {

	$autoresq_images = new Ztl_Images();
	$images_location = $autoresq_images->getLocation();

    $atts = shortcode_atts(
        array(
	        'tabicon' => '',
	        'icon_fontawesome' => '',
	        'icon_openiconic' => '',
	        'icon_typicons' => '',
	        'icon_entypo' => '',
	        'icon_linecons' => '',
	        'icon_zoutula' => '',

            'title' => '',
            'description' => '',
            'text_color' => '',

	        'show_price' => '',
	        'price_value' => '',
            'price_color' => '',
            'price_background_color' => '',

            'icon_color' => '',
            'icon_accent_color' => '',
            'icon_background_color' => '',
            'package_link' => '',
            'class' => ''

        ), $atts);

	$icon_name = '';

	if (!empty($atts['icon_fontawesome'])) {
		$icon_name = $atts['icon_fontawesome'];
	} elseif (!empty($atts['icon_openiconic'])) {
		$icon_name = $atts['icon_openiconic'];
	} elseif (!empty($atts['icon_typicons'])) {
		$icon_name = $atts['icon_typicons'];
	} elseif (!empty($atts['icon_entypo'])) {
		$icon_name = $atts['icon_entypo'];
	} elseif (!empty($atts['icon_linecons'])) {
		$icon_name = $atts['icon_linecons'];
	} elseif (!empty($atts['icon_zoutula'])) {
		$icon_name = $atts['icon_zoutula'];
	}

	//enqueue font used
	vc_icon_element_fonts_enqueue($atts['tabicon']);

	//different approach when it's a Zoutula SVG icon
	if (strpos($icon_name,'ztl-icon-') === 0){
		//svg folder
		$image_svg = file_get_contents($images_location.str_replace('ztl-icon-','',$icon_name).'.svg');

		//replace colors
		if (isset($atts['icon_color']) && !empty($atts['icon_color'])){
			$image_svg = str_replace('#333333', $atts['icon_color'] , $image_svg );
		}
		if (isset($atts['icon_accent_color']) && !empty($atts['icon_accent_color'])) {
			$image_svg = str_replace( '#F4C70E', $atts['icon_accent_color'], $image_svg );
		}
		$icon_content = '<div class="ztl-icon-svg">'.$image_svg.'</div>';

	} else {
		$icon_content = '<span class="' . esc_attr($icon_name) . '" style="' . ( $atts['icon_color'] ? 'color:' . esc_attr( strtolower( $atts['icon_color'] ) .';' ) : "" ) . '"></span>';
	}

	//price
	if (isset($atts['show_price']) && $atts['show_price'] == 'no'){
		$price ='';
	}else{
		$price ='
			<div class="ztl-package-price-shape" style="' . ( $atts['price_background_color'] ? 'background-color:' . esc_attr( strtolower( $atts['price_background_color'] ) .';' ) : "" ) . '"></div>
        	<div class="ztl-package-price-info" style="' . ( $atts['price_color'] ? 'color:' . esc_attr( strtolower( $atts['price_color'] ) .';' ) : "" ) . '">' . esc_html($atts['price_value']) . '</div>
		';
	}

	//extract link
	$atts['package_link'] = vc_build_link( $atts['package_link'] );
	$a_href = $atts['package_link']['url'];
	$a_title = $atts['package_link']['title'];
	$a_target = $atts['package_link']['target'] ? $atts['package_link']['target']: '_self';

	$link='';
	if (!empty($a_href)){
		$link = '<a class="ztl-package-link" href="' . esc_url($a_href) . '" target="'. esc_attr($a_target) .'" title="'. esc_attr($a_title) .'"></a>';
	}


    $str = '';
    $str .= '<div class="ztl-package '. esc_attr(strtolower($atts['class'])) .'">
                <div class="ztl-icon-wrapper">
                	<div class="ztl-icon left" style="' . ( $atts['icon_background_color'] ? 'background-color:' . esc_attr( strtolower( $atts['icon_background_color'] ) .';' ) : "" ) . '"></div>
                	<div class="ztl-icon-content">' . $icon_content . '</div>
                </div>
                <div class="ztl-package-price">'. $price .'</div>
                ' . $link . '  
                <div class="ztl-package-description">
                    <div class="ztl-font-semi-bold" style="' . ( $atts['text_color'] ? 'color:' . esc_attr( strtolower( $atts['text_color'] ) .';' ) : "" ) . '"><h4 class="ztl-accent-font">'.$atts['title'].'</h4></div>
                    <div class="clear10"></div>
                    <div style="' . ( $atts['text_color'] ? 'color:' . esc_attr( strtolower( $atts['text_color'] ) .';' ) : "" ) . '">'.$atts['description'].'</div>
                </div>
	        </div>';

    return apply_filters('uds_shortcode_out_filter', $str);
}


add_action('vc_before_init', 'ztl_package');
function ztl_package()
{
    vc_map(array(
        'name' => esc_html__('Package', 'zoutula'),
        'base' => 'package_ztl',
        'description' => esc_html__('Add package', 'zoutula'),
        'show_settings_on_create' => true,
        'icon' => plugin_dir_url(__FILE__) . 'assets/images/package.png',
        'class' => '',
        'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
        'params' => array(

	        //Icon
	        array(
		        'type' => 'dropdown',
		        'heading' => esc_html__('Icon library', 'zoutula'),
		        'value' => array(
			        esc_html__('Font Awesome', 'zoutula') => 'fontawesome',
			        esc_html__('Entypo', 'zoutula') => 'entypo',
			        esc_html__('Open Iconic', 'zoutula') => 'openiconic',
			        esc_html__('Typicons', 'zoutula') => 'typicons',
			        esc_html__('Linecons', 'zoutula') => 'linecons',
			        esc_html__('Zoutula Icons', 'zoutula') => 'ztlicon',
		        ),
		        'admin_label' => true,
		        'param_name' => 'tabicon',
		        'description' => esc_html__('Select icon library.', 'zoutula'),
	        ),

	        array(
		        'type' => 'iconpicker',
		        'heading' => esc_html__('Icon', 'zoutula'),
		        'param_name' => 'icon_fontawesome',
		        'value' => '', // default value to backend editor admin_label
		        'settings' => array(
			        'emptyIcon' => true, // default true, display an "EMPTY" icon?
			        'type' => 'fontawesome',
			        'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
		        ),
		        'dependency' => array(
			        'element' => 'tabicon',
			        'value' => 'fontawesome',
		        ),
		        'description' => esc_html__('Select icon from library.', 'zoutula'),
	        ),

	        array(
		        'type' => 'iconpicker',
		        'heading' => esc_html__('Icon', 'zoutula'),
		        'param_name' => 'icon_openiconic',
		        'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
		        'settings' => array(
			        'emptyIcon' => false, // default true, display an "EMPTY" icon?
			        'type' => 'openiconic',
			        'iconsPerPage' => 4000, // default 100, how many icons per/page to display
		        ),
		        'dependency' => array(
			        'element' => 'tabicon',
			        'value' => 'openiconic',
		        ),
		        'description' => esc_html__('Select icon from library.', 'zoutula'),
	        ),

	        array(
		        'type' => 'iconpicker',
		        'heading' => esc_html__('Icon', 'zoutula'),
		        'param_name' => 'icon_typicons',
		        'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
		        'settings' => array(
			        'emptyIcon' => false, // default true, display an "EMPTY" icon?
			        'type' => 'typicons',
			        'iconsPerPage' => 4000, // default 100, how many icons per/page to display
		        ),
		        'dependency' => array(
			        'element' => 'tabicon',
			        'value' => 'typicons',
		        ),
		        'description' => esc_html__('Select icon from library.', 'zoutula'),
	        ),

	        array(
		        'type' => 'iconpicker',
		        'heading' => esc_html__('Icon', 'zoutula'),
		        'param_name' => 'icon_entypo',
		        'value' => 'entypo-icon entypo-icon-user', // default value to backend editor admin_label
		        'settings' => array(
			        'emptyIcon' => false, // default true, display an "EMPTY" icon?
			        'type' => 'entypo',
			        'iconsPerPage' => 4000, // default 100, how many icons per/page to display
		        ),
		        'dependency' => array(
			        'element' => 'tabicon',
			        'value' => 'entypo',
		        ),
	        ),

	        array(
		        'type' => 'iconpicker',
		        'heading' => esc_html__('Icon', 'zoutula'),
		        'param_name' => 'icon_linecons',
		        'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
		        'settings' => array(
			        'emptyIcon' => false, // default true, display an "EMPTY" icon?
			        'type' => 'linecons',
			        'iconsPerPage' => 4000, // default 100, how many icons per/page to display
		        ),
		        'dependency' => array(
			        'element' => 'tabicon',
			        'value' => 'linecons',
		        ),
		        'description' => esc_html__('Select icon from library', 'zoutula'),
	        ),

	        array(
		        'type' => 'colorpicker',
		        'class' => '',
		        'heading' => esc_html__('Icon background color', 'zoutula'),
		        'param_name' => 'icon_background_color',
		        'value' => '#fff', //Default White
		        'description' => esc_html__('Icon background color', 'zoutula')
	        ),

	        array(
		        'type' => 'iconpicker',
		        'heading' => esc_html__('Icon', 'zoutula'),
		        'param_name' => 'icon_zoutula',
		        'value' => '',
		        'settings' => array(
			        'emptyIcon' => false,
			        'type' => 'ztlicon',
			        'iconsPerPage' => 4000,
		        ),
		        'dependency' => array(
			        'element' => 'tabicon',
			        'value' => 'ztlicon',
		        ),
		        'description' => esc_html__('Select icon from library', 'zoutula'),
	        ),

	        array(
		        'type' => 'colorpicker',
		        'class' => '',
		        'heading' => esc_html__('Icon Main Color', 'zoutula'),
		        'param_name' => 'icon_color',
		        'value' => '#ff000', //Default Red
		        'description' => esc_html__('Choose icon color', 'zoutula')
	        ),

	        array(
		        'type' => 'colorpicker',
		        'class' => '',
		        'heading' => esc_html__('Icon Accent Color', 'zoutula'),
		        'param_name' => 'icon_accent_color',
		        'value' => '#ff000', //Default Red
		        'description' => esc_html__('Choose icon accent color', 'zoutula'),
		        'dependency' => array(
			        'element' => 'tabicon',
			        'value' => 'ztlicon',
		        ),
	        ),

            // Text
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'zoutula'),
                'admin_label' => true,
                'param_name' => 'title',
                'description' => esc_html__('Select package title', 'zoutula')
            ),

            array(
                'type' => 'textarea',
                'heading' => esc_html__('Description', 'zoutula'),
                'param_name' => 'description',
                'description' => esc_html__('Select package description', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Text color', 'zoutula'),
                'param_name' => 'text_color',
                'value' => '#313131', //Default Dark Grey
                'description' => esc_html__('Choose text color', 'zoutula')
            ),

            // Plan settings
	        array(
		        'type' => 'dropdown',
		        'heading' => esc_html__('Show price', 'zoutula'),
		        'value' => array(
			        esc_html__('Yes', 'zoutula') => 'yes',
			        esc_html__('No', 'zoutula') => 'no'
		        ),
		        'param_name' => 'show_price',
		        'description' => esc_html__('Show price tag', 'zoutula'),
	        ),

            array(
                'type' => 'textfield',
                'heading' => esc_html__('Price value', 'zoutula'),
                'param_name' => 'price_value',
                'description' => esc_html__('Set price value like E.g. £29', 'zoutula')
            ),

	        array(
		        'type' => 'colorpicker',
		        'class' => '',
		        'heading' => esc_html__('Price text color', 'zoutula'),
		        'param_name' => 'price_color',
		        'value' => '#313131', //Default Black
		        'description' => esc_html__('Price text color', 'zoutula')
	        ),

	        array(
		        'type' => 'colorpicker',
		        'class' => '',
		        'heading' => esc_html__('Price background color', 'zoutula'),
		        'param_name' => 'price_background_color',
		        'value' => '#f2f2f2', //Default White
		        'description' => esc_html__('Price background color', 'zoutula')
	        ),

	        array(
		        'type' => 'vc_link',
		        'heading' => esc_html__('Package Link', 'zoutula'),
		        'param_name' => 'package_link',
		        'description' => esc_html__('Set package link', 'zoutula')
	        ),

            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Class', 'zoutula'),
                'param_name' => 'class',
                'description' => esc_html__('Custom Class', 'zoutula')
            )
        )
    ));
}
