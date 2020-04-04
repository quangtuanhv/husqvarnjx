<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('clients_ztl', 'ztl_shortcode_clients');

function ztl_shortcode_clients($atts, $content)
{
    $atts = shortcode_atts(
        array(
            'autoplay' => 0,
            'loop' => false,
            'navigation' => false,
            'class' => '',
        ), $atts
    );

    $id = 'clients_' . uniqid();

    $script = '
        <script type="text/javascript">
        (function($) { "use strict";


         var clients_no = 0;
         var clients_id = "' . esc_js($id) . '";
         var loop_items = "' . esc_js((bool)$atts['loop']) . '";
         var navigation_items = "' . esc_js((bool)$atts['navigation']) . '";
         var autoplay_items = "' . esc_js((bool)$atts['autoplay']) . '";
         var autoplay_items_timeout = "' . esc_js((int)$atts['autoplay']) . '";
         var breakpoints;


          //call
          $(document).ready(function(){
            // determine clients no
            clients_no = $("#" + clients_id +" .item-client").length;
            // set responsive behavior

            switch(clients_no){
                case 3:
                    breakpoints = { 0:{ items:1 }, 480:{ items:2 }, 768:{ items:3 } };
                    break;
                case 2:
                    breakpoints = { 0:{ items:1 }, 480:{ items:2 } };
                    break;
                case 1:
                    breakpoints = { 0:{ items:1 } };
                    break;

                default:
                    breakpoints = { 0:{ items:1 }, 480:{ items:2 }, 768:{ items:3 }, 1000:{ items:4 } }
             }



            $("#" + clients_id).owlCarousel({
                loop:loop_items,
                nav:navigation_items,
                autoplay:autoplay_items,
                autoplayTimeout:autoplay_items_timeout,
                responsive:breakpoints
            });
          });

        })(jQuery);
        </script>
  ';

    $class = $atts['class'];


    $str = '<div class="ztl-clients-carousel ' . esc_attr($class) . '">
                <div class="owl-clients-list" id="' . esc_attr($id) . '">
                   ' . $content . '
                </div>
            </div>'. $script;

    $str = apply_filters('ztl_shortcode_filter', $str);
    $str = apply_filters('uds_shortcode_out_filter', $str);

    return $str;
}


add_action('vc_before_init', 'ztl_clients');
function ztl_clients()
{
    vc_map(
        array(
            'name' => esc_html__('Clients', 'zoutula'),
            'base' => 'clients_ztl', //container
            'content_element' => true,
            'is_container' => true,
            'as_parent' => array('only' => 'client_ztl'),
            'description' => esc_html__('Add clients box', 'zoutula'),
            'show_settings_on_create' => true,
            'icon' => plugin_dir_url(__FILE__) . 'assets/images/clients.png',
            'class' => '',
            'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Slider autoplay', 'zoutula'),
                    'param_name' => 'autoplay',
                    'value' => 0,
                    'description' => esc_html__('Duration of animation between slides (in ms). Enter the value is 0 or empty if you want the slider not auto-play', 'zoutula'),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Enable navigation', 'zoutula'),
                    'param_name' => 'navigation',
                    'value' => array(esc_html__('Yes', 'zoutula') => true),
                    'description' => esc_html__('If "YES" prev / next control will be enabled. ', 'zoutula'),
                ),

                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Enable the Items Loop', 'zoutula'),
                    'param_name' => 'loop',
                    'value' => array(esc_html__('Yes', 'zoutula') => true),
                    'description' => esc_html__('If "YES" carousel will loop the items. ', 'zoutula'),
                ),

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Class', 'zoutula'),
                    'param_name' => 'class',
                    'description' => esc_html__('Custom Class', 'zoutula'),
                ),
            ),
            'js_view' => 'VcColumnView',
        )
    );

    // Needed for "Container/Content" functionality
    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_clients_ztl extends WPBakeryShortCodesContainer
        {
        }
    }

}


/* Client Child Item  */

add_shortcode('client_ztl', 'ztl_shortcode_client');

function ztl_shortcode_client($atts, $content)
{
    $atts = shortcode_atts(
        array(
            'client_link' => '',
            'client_image' => '',
        ), $atts
    );

	$atts['client_link'] = vc_build_link( $atts['client_link'] );
	$a_href = $atts['client_link']['url'];
	$a_title = $atts['client_link']['title'] ? $atts['client_link']['title'] : '';
	$a_target = $atts['client_link']['target'] ? $atts['client_link']['target']: '_self';

    $str = '';
    $image ='';


    if (isset($atts['client_image']) && !empty($atts['client_image'])) {
	    $client_image = wp_get_attachment_image_src($atts['client_image'], 'autoresq-square-thumb');
        $image .= '<img src="'.esc_url(reset($client_image)).'" alt="'.esc_attr($a_title).'" />';
    }

	if ( ! empty( $a_href ) ) {
		$str .= '<a href="' . esc_url( $a_href ) . '" title="'.esc_attr($a_title).'" target="' . esc_attr( $a_target ) . '">' . $image . '</a>';
	} else {
		$str = $image;
	}

    $str = apply_filters('uds_shortcode_out_filter', $str);

    return '<div class="item-client"> ' . $str . ' </div>';
}


add_action('vc_before_init', 'ztl_client');
function ztl_client()
{

    vc_map(
        array(
            'name' => esc_html__('Client', 'zoutula'),
            'base' => 'client_ztl', //content
            'icon' => plugin_dir_url(__FILE__) . 'assets/images/clients.png',
            'show_settings_on_create' => true,
            'content_element' => true,
            'as_child' => array('only' => 'clients_ztl'),
            'params' => array(

                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__('Client link', 'zoutula'),
                    'param_name' => 'client_link',
                    'value' => '',
                    'description' => esc_html__('Enter the client name', 'zoutula'),

                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Client image', 'zoutula'),
                    'param_name' => 'client_image',
                    'value' => '',
                    'admin_label' => true,
                    'description' => esc_html__('Enter the client image (it should be at least 600px x 600px)', 'zoutula'),
                ),
            )
        )
    );

    // Needed for "Container/Content" functionality
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_client_ztl extends WPBakeryShortCode
        {
        }
    }

}

?>