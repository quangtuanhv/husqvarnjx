<?php
return array(
    "name" => __("OTF Slider", 'opal-theme-framework'),
    "base" => "otf_slider",
    "category" => 'Opal Theme',
    "description"    => esc_html__( 'Show as Slider', 'opal-theme-framework' ),
    "as_parent"               => array('only' => 'otf_slider_item'),
    "as_child"                => array('except' => 'vc_column_inner'),
    "content_element"         => true,
    "show_settings_on_create" => false,
    "is_container"            => true,
    "php_class_name"          => 'WPBakeryShortCode_OTF_Container_Base',
    "js_view"                 => 'VcColumnView',
    "params" => array(
        array(
            'type' => 'dropdown',
            'heading' => __( 'Columns', 'opal-theme-framework' ),
            'value' => array(
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
                '6' => 6,
            ),
            'save_always' => true,
            'param_name' => 'columns',
            'std' => 3,
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Show Navigation', 'opal-theme-framework' ),
            'save_always' => true,
            'param_name'  => 'show_nav',
            'std'         => true,
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Style", 'opal-theme-framework'),
            "param_name" => "style_nav",
            'value'      => array(
                esc_html__('Style 1', 'opal-theme-framework') => 'nav-style-1',
                esc_html__('Style 2', 'opal-theme-framework') => 'nav-style-2',
                esc_html__('Style 3', 'opal-theme-framework') => 'nav-style-3',
                esc_html__('Style 4', 'opal-theme-framework') => 'nav-style-4',
                esc_html__('Style 5', 'opal-theme-framework') => 'nav-style-5',
            ),
            'std'        => 'nav-style-1',
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Show Dot', 'opal-theme-framework' ),
            'save_always' => true,
            'param_name'  => 'show_dot',
            'std'         => true,
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __('Extra class name', 'opal-theme-framework'),
            'param_name'  => 'el_class',
            'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'opal-theme-framework'),
        ),
        array(
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'opal-theme-framework' ),
            'param_name' => 'css',
            'group' => __( 'Design Options', 'opal-theme-framework' ),
        ),
    )
);