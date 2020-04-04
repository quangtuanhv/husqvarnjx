<?php
return array(
    "name"                    => __("OTF Rotate Images", 'opal-theme-framework'),
    "base"                    => "otf_rotate_images",
    "class"                   => "",
    "description"             => esc_html__('Rotate images 360deg', 'opal-theme-framework'),
    "category"                => 'Opal Theme',
    "params"                  => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", 'opal-theme-framework'),
            "param_name" => "title",
            "admin_label"	=> true
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Width", 'opal-theme-framework'),
            "param_name" => "width",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Height", 'opal-theme-framework'),
            "param_name" => "height",
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => esc_html__('Image source', 'opal-theme-framework'),
            'param_name'  => 'select_image_source',
            'description' => esc_html__('Select Image source', 'opal-theme-framework'),
            'value'       => array(
                esc_html__('Media Library', 'opal-theme-framework') => 'library',
                esc_html__('External link', 'opal-theme-framework') => 'external',
            ),
            'std'         => 'library',
        ),
        array(
            "type" => "attach_images",
            "description" => esc_html__("Image", 'opal-theme-framework'),
            "param_name" => "images",
            "value" => '',
            'heading'	=> esc_html__('Image', 'opal-theme-framework' ),
            'dependency' => array(
                'element' => 'select_image_source',
                'value'   => 'library'
            ),
        ),
        array(
            'type'        => 'param_group',
            'heading'     => __('External link', 'opal-theme-framework'),
            'param_name'  => 'images_link',
            'description' => __('Enter images link', 'opal-theme-framework'),
            'value'       => urlencode(json_encode(array(
                array(
                    'link' => __('http://example.com/image.jpg', 'opal-theme-framework'),
                )
            ))),
            'params'      => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => __('Link', 'opal-theme-framework'),
                    'param_name'  => 'link',
                    'admin_label' => true,
                ),
            ),
            'dependency' => array(
                'element' => 'select_image_source',
                'value'   => 'external'
            ),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", 'opal-theme-framework'),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'opal-theme-framework')
        ),
        array(
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'opal-theme-framework' ),
            'param_name' => 'css',
            'group' => __( 'Design Options', 'opal-theme-framework' ),
        ),
    ),
);