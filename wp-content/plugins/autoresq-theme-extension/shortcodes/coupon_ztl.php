<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

add_shortcode( 'coupon_ztl', 'ztl_shortcode_coupon' );
function ztl_shortcode_coupon( $atts, $content = null ) {

	$atts = shortcode_atts(
		array(
			'style'            => '',
			'background_image' => '',
			'logo_image'       => '',
			'main_color'       => '',
			'accent_color'     => '',
			'text_color'       => '',
			'expires'          => '',
			'address'          => '',
			'first_line'       => '',
			'second_line'      => '',
			'third_line'       => '',
			'class'            => ''

		), $atts );

	//Set default style
	if ( empty( $atts['style'] ) ) {
		$atts['style'] = 'primary';
	}

	$random_id        = 'coupon_' . uniqid();
	$random_id_button = 'button_' . $random_id;

	$allowed_tags = array(
		'sub'    => array(
			'style' => array(),
		),
		'sup'    => array(
			'style' => array(),
		),
		'strong' => array(),
	);

	$background_image = autoresq_get_first( wp_get_attachment_image_src( $atts['background_image'], 'full' ) );
	$logo_image       = autoresq_get_first( wp_get_attachment_image_src( $atts['logo_image'], 'full' ) );

	$first_line  = wp_kses( $atts['first_line'], $allowed_tags );
	$second_line = wp_kses( $atts['second_line'], $allowed_tags );
	$third_line  = wp_kses( $atts['third_line'], $allowed_tags );

	$style_class = '';
	if ( strtolower( $atts['style'] ) == 'primary' ) {
		$style_class = 'ztl-coupon-primary';
	}

	$str = '';
	$str .= '<div id="' . esc_attr( $random_id ) . '" class="ztl-coupon-wrapper">
				<div class="ztl-coupon ' . esc_attr( strtolower( $atts['class'] ) ) . '  ' . esc_attr( $style_class ) . ' " style="' . ( $atts['main_color'] ? ('border-color:' . esc_attr(strtolower( $atts['main_color'] )) .'; ' ) : "" ) .  ( $background_image ?  'background-image:url(' . esc_url($background_image) .'); ' : "" ) . ( $atts['text_color'] ? 'color:' . esc_attr( strtolower( $atts['text_color'] ) .';' ) : "" ) . '">
	                <div class="first-line">
	                	<div class="ztl-coupon-detail">
	                		<div class="ztl-coupon-expiration">' . esc_html( $atts['expires'] ) . '</div>
	                		<div class="ztl-coupon-branch">' . esc_html( $atts['address'] ) . '</div>
	                	</div>
	                	<div class="ztl-coupon-logo">
	                		<img src="' . esc_url( $logo_image ) . '" alt="' . esc_attr__( 'Coupon', 'zoutula' ) . '">
						</div>
					</div>
	                <div class="second-line ztl-accent-font">
	                	<div class="first-line-text" style="' . ( $atts['main_color'] ? esc_attr( 'color:' . strtolower( $atts['main_color'] ) .';' ) : "" ) . '">' . $first_line . '</div>
	                	<div class="second-line-text" style="' . ( $atts['accent_color'] ? esc_attr( 'color:' . strtolower( $atts['accent_color'] ) .';' ) : "" ) . '">' . $second_line . '</div>
					</div>
	                <div class="third-line">
	                	' . $third_line . '
					</div>
	            </div>
	            <div class="no-print">
	            	<div class="ztl-button-one">
    					<a href="#" id="' . esc_attr( $random_id_button ) . '">' . esc_html__( 'Print Coupon', 'zoutula' ) . '</a>
					</div>
				</div>
            </div>';

	return apply_filters( 'uds_shortcode_out_filter', $str );
}


add_action( 'vc_before_init', 'ztl_coupon' );
function ztl_coupon() {
	vc_map( array(
		'name'                    => esc_html__( 'Coupon', 'zoutula' ),
		'base'                    => 'coupon_ztl',
		'description'             => esc_html__( 'Add coupon', 'zoutula' ),
		'show_settings_on_create' => true,
		'icon'                    => plugin_dir_url( __FILE__ ) . 'assets/images/coupon.png',
		'class'                   => '',
		'category'                => esc_html__( 'Zoutula Shortcodes', 'zoutula' ),
		'params'                  => array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Style', 'zoutula' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Select', 'zoutula' )    => 'Select',
					esc_html__( 'Primary', 'zoutula' )   => 'Primary',
				),
				'description' => esc_html__( 'Select element style', 'zoutula' )
			),
			array(
				'type'        => 'attach_image',
				'class'       => '',
				'heading'     => esc_html__( 'Coupon background image', 'zoutula' ),
				'param_name'  => 'background_image',
				'description' => esc_html__( 'Coupon background image', 'zoutula' )
			),
			array(
				'type'        => 'attach_image',
				'class'       => '',
				'heading'     => esc_html__( 'Coupon logo', 'zoutula' ),
				'param_name'  => 'logo_image',
				'description' => esc_html__( 'Coupon image', 'zoutula' )
			),
			array(
				'type'        => 'colorpicker',
				'class'       => '',
				'admin_label' => true,
				'heading'     => esc_html__( 'Coupon main color', 'zoutula' ),
				'param_name'  => 'main_color',
				'value'       => '', //Default Theme Color
				'description' => esc_html__( 'Choose main color for this particular element.', 'zoutula' )
			),
			array(
				'type'        => 'colorpicker',
				'class'       => '',
				'admin_label' => true,
				'heading'     => esc_html__( 'Coupon accent color', 'zoutula' ),
				'param_name'  => 'accent_color',
				'value'       => '', //Default Theme Color
				'description' => esc_html__( 'Choose accent color for this particular element.', 'zoutula' )
			),
			array(
				'type'        => 'colorpicker',
				'class'       => '',
				'admin_label' => true,
				'heading'     => esc_html__( 'Text color', 'zoutula' ),
				'param_name'  => 'text_color',
				'value'       => '',
				'description' => esc_html__( 'Choose text color for this element.', 'zoutula' )
			),
			array(
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'Coupon expiration', 'zoutula' ),
				'param_name'  => 'expires',
				'description' => esc_html__( 'Add here the text regarding expiration date.', 'zoutula' )
			),
			array(
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'Branch address', 'zoutula' ),
				'param_name'  => 'address',
				'description' => esc_html__( 'Add here the text branch address where the coupon can be used', 'zoutula' )
			),
			array(
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'First line text', 'zoutula' ),
				'param_name'  => 'first_line',
				'description' => esc_html__( 'Add here the first line text', 'zoutula' )
			),
			array(
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'Second line text', 'zoutula' ),
				'param_name'  => 'second_line',
				'description' => esc_html__( 'Add here the second line text', 'zoutula' )
			),
			array(
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'Third line text', 'zoutula' ),
				'param_name'  => 'third_line',
				'description' => esc_html__( 'Add here the third line text', 'zoutula' )
			),
			array(
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'Extra class name', 'zoutula' ),
				'param_name'  => 'class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'zoutula' )
			)
		)
	) );
}