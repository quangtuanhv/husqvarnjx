<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

add_shortcode( 'posts_grid_ztl', 'ztl_shortcode_posts_grid' );
function ztl_shortcode_posts_grid( $atts ) {

	$atts = shortcode_atts(
		array(
			'post_grid_type'       => '',
			'post_grid_number'     => '',
			'post_grid_columns'    => '',
			'post_grid_order'      => '',
			'post_grid_order_by'   => '',
			'post_grid_categories' => '',
			'post_grid_ids'        => '',
		), $atts );


	if ( $atts['post_grid_type'] == 'Services' ) {
		//order by user option
		$post_type             = 'service';
		$custom_order_by       = strtolower( $atts['post_grid_order_by'] );
		$custom_taxonomy       = 'services_taxonomy';
		$post_grid_ids_checked = array();
		$post_grid_ids         = explode( ',', $atts['post_grid_ids'] );
		if ( is_array( $post_grid_ids ) && ! empty( $post_grid_ids ) ) {
			foreach ( $post_grid_ids as $id ) {
				if ( is_numeric( $id ) ) {
					$post_grid_ids_checked[] = $id;
				}
			}
		}
	}

	$args = array(
		'post_type'      => '' . $post_type . '',
		'posts_per_page' => $atts['post_grid_number'],
		'post__in'       => $post_grid_ids_checked,
		'post__not_in'   => array(get_the_ID()),
		'orderby'        => '' . $custom_order_by . '',
		'order'          => '' . $atts['post_grid_order'] . '',
	);

	if ( ! empty( $atts['post_grid_categories'] ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => $custom_taxonomy,
			'field'    => 'slug',
			'terms'    => $atts['post_grid_categories']
		);
	}

	$query = new WP_Query( $args );

	if ( $atts['post_grid_type'] == 'Services' ) {
		include 'inc/loop/services.php';
	}

	wp_reset_postdata();


	return apply_filters( 'uds_shortcode_out_filter', $str );
}

//vc
add_action( 'vc_before_init', 'ztl_posts_grid' );
function ztl_posts_grid() {
	vc_map( array(
		'name'                    => esc_html__( 'Posts Grid', 'zoutula' ),
		'base'                    => 'posts_grid_ztl',
		'description'             => esc_html__( 'Insert Posts Grid', 'zoutula' ),
		'show_settings_on_create' => true,
		'icon'                    => plugin_dir_url( __FILE__ ) . 'assets/images/posts-grid.png',
		'class'                   => '',
		'category'                => esc_html__( 'Zoutula Shortcodes', 'zoutula' ),
		'params'                  => array(

			array(
				'type'        => 'dropdown',
				'class'       => '',
				'heading'     => esc_html__( 'Post Type', 'zoutula' ),
				'param_name'  => 'post_grid_type',
				'admin_label' => true,
				'value'       => array(
					esc_html__( 'Select', 'zoutula' )   => 'Select',
					esc_html__( 'Services', 'zoutula' ) => 'Services',
				),
				'description' => esc_html__( 'Choose the post type', 'zoutula' )
			),
			array(
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'Taxonomies (subcategories) ', 'zoutula' ),
				'param_name'  => 'post_grid_categories',
				'dependency'  => array( 'element' => 'post_grid_type', 'value' => array( 'Services' ) ),
				'description' => esc_html__( 'Insert the category SLUG. E.g. category1', 'zoutula' )
			),
			array(
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'Posts IDs', 'zoutula' ),
				'param_name'  => 'post_grid_ids',
				'dependency'  => array( 'element' => 'post_grid_type', 'value' => array( 'Services' ) ),
				'description' => esc_html__( 'Insert the ids separated by comma without space. E.g. 123,234', 'zoutula' )
			),
			array(
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => esc_html__( 'Posts per page ', 'zoutula' ),
				'param_name'  => 'post_grid_number',
				'description' => esc_html__( 'Insert the number of posts that you want to show. E.g. 3. Leave empty for show the default settings of WP (Settings -> Reading)', 'zoutula' )
			),
			array(
				'type'        => 'dropdown',
				'class'       => '',
				'heading'     => esc_html__( 'Order By', 'zoutula' ),
				'param_name'  => 'post_grid_order_by',
				'value'       => array(
					esc_html__( 'Select', 'zoutula' )   => 'Select',
					esc_html__( 'Date', 'zoutula' )     => 'Date',
					esc_html__( 'Title', 'zoutula' )    => 'Title',
					esc_html__( 'Rand', 'zoutula' )     => 'Rand',
					esc_html__( 'Modified', 'zoutula' ) => 'Modified',
				),
				'description' => esc_html__( 'Choose the order of the visualization', 'zoutula' )
			),
			array(
				'type'        => 'dropdown',
				'class'       => '',
				'heading'     => esc_html( 'Order', 'zoutula' ),
				'param_name'  => 'post_grid_order',
				'value'       => array(
					esc_html__( 'Select', 'zoutula' ) => 'Select',
					esc_html__( 'Desc', 'zoutula' )   => 'Desc',
					esc_html__( 'Asc', 'zoutula' )    => 'Asc',
				),
				'description' => esc_html__( 'Choose items order', 'zoutula' )
			),
			array(
				'type'        => 'dropdown',
				'class'       => '',
				'heading'     => esc_html__( 'Columns', 'zoutula' ),
				'param_name'  => 'post_grid_columns',
				'admin_label' => true,
				'value'       => array(
					esc_html__( 'Select', 'zoutula' )   => 'select',
					esc_html__( '1 Column', 'zoutula' ) => 'ztl-grid-12'
				),
				'description' => esc_html__( 'Choose columns style', 'zoutula' )
			)
		)
	) );
}
