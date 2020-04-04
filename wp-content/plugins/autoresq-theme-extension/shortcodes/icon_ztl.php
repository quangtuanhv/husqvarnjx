<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('icon_ztl', 'ztl_shortcode_icon');


function ztl_shortcode_icon( $atts ) {

	$autoresq_images = new Ztl_Images();
	$images_location = $autoresq_images->getLocation();

    $atts = shortcode_atts(
        array(
            'tabicon' => '',
            'icon_zoutula' => '',
            'align' =>'ztl-flex-left',
            'icon_color' => '',
            'icon_accent_color' => '',
            'icon_background_color' => '',
            'link' => '',
            'class' => ''

        ), $atts);

    //extract link
    $atts['link'] = vc_build_link( $atts['link'] );
    $a_href = $atts['link']['url'];
    $a_title = $atts['link']['title'];
    $a_target = $atts['link']['target'] ? $atts['link']['target']: '_self';

    if(!empty($a_href)) {
	    $icon_link = '<a href="' . esc_url( $a_href ) . '" target="' . esc_attr( $a_target ) . '">' . esc_html( $a_title ) . '</a>';
    } else {
	    $icon_link = '';
    }

    if (!empty($atts['icon_zoutula'])) {
        $icon_name = $atts['icon_zoutula'];
    }else {
	    $icon_name = '';
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
		$icon_content = '<span class="' . esc_attr($icon_name) . '" style="' . ( $atts['icon_color'] ? ('color:' . esc_attr(strtolower( $atts['icon_color'] )) .';') : "" ) . '"></span>';
	}


	$str = '';
	$str .= '<div class="ztl-icon-container ' . esc_attr(strtolower($atts['class'])) . ' ">
	            <div class="ztl-flex ztl-mobile-container ' . esc_attr(strtolower($atts['align'])) . '">
	            	<div class="ztl-icon-wrapper">
	                	<div class="ztl-icon" style="' . ( $atts['icon_background_color'] ? 'background-color:' . esc_attr(strtolower( $atts['icon_background_color'] ) .';' ) : "" ) . '"></div>
	               		<div class="ztl-icon-content">' . $icon_content . '</div>
	               		'. $icon_link .'
	                </div>
	            </div>
			</div>';

    return apply_filters('uds_shortcode_out_filter', $str);
}


add_action('vc_before_init', 'ztl_icon');
function ztl_icon()
{
    vc_map(array(
        'name' => esc_html__('Icon', 'zoutula'),
        'base' => 'icon_ztl',
        'description' => esc_html__('Add icon', 'zoutula'),
        'show_settings_on_create' => true,
        'icon' => plugin_dir_url(__FILE__) . 'assets/images/icon.png',
        'class' => '',
        'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
        'params' => array(

            //Icon
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon library', 'zoutula'),
                'value' => array(
                    esc_html__('Zoutula Icons', 'zoutula') => 'ztlicon',
                ),
                'admin_label' => true,
                'param_name' => 'tabicon',
                'description' => esc_html__('Select icon library.', 'zoutula'),
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
                'description' => esc_html__('Select icon from library.', 'zoutula'),
            ),

	        array(
		        'type' => 'dropdown',
		        'heading' => 'Align',
		        'param_name' => 'align',
		        'value' => array(esc_html__('Select', 'zoutula') => 'select',
		                         esc_html__('Left', 'zoutula') => 'ztl-flex-left',
		                         esc_html__('Center', 'zoutula') => 'ztl-flex-center',
		                         esc_html__('Right', 'zoutula') => 'ztl-flex-right',),
		        'description' => esc_html__('Choose the alignment', 'zoutula')
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

            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Icon Background Color', 'zoutula'),
                'param_name' => 'icon_background_color',
                'value' => '#fffff', //Default White
                'description' => esc_html__('Choose icon background color', 'zoutula')
            ),

            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Button Link', 'zoutula'),
                'param_name' => 'link',
                'description' => esc_html__('Set icon link', 'zoutula')
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
