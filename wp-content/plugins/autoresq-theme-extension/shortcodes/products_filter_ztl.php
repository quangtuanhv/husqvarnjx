<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !class_exists( 'woocommerce' ) ) {
	return;
}

add_shortcode( 'products_filter_ztl', 'ztl_shortcode_products_filter' );

function ztl_shortcode_products_filter( $atts, $content ) {
	$atts = shortcode_atts(
		array(
			'woocommerce_category'      => '',
			'woocommerce_in_stock_only' => '',
			'class'                     => '',
		), $atts
	);

	$id = 'products_filter_' . uniqid();

	$script = '
        <script type="text/javascript">
        (function($) { 
            "use strict";

        	var filter_id = "' . esc_js( $id ) . '";
        	var category_id = "' . esc_js( $atts['woocommerce_category'] ) . '";
        	var in_stock = "' . esc_js( $atts['woocommerce_in_stock_only'] ) . '";

          	//call
          	$(document).ready(function(){
				var filter_select_elm = $(\'#\'+filter_id+\' select\');	
				var filter_id_elm = $(\'#\'+filter_id);
				
					//initialize when press the back button
					$("select").each(function () {
        					$(this).val($(this).find(\'option[selected]\').val());
    				});
				
					filter_select_elm.on(\'change\',function() {
						filter_id_elm.parent(\'.ztl-products-filter\').addClass(\'ztl-working\');    
				
						//reset all following selects
						var all_following_selects = $(this).parents(\'.ztl-filter-container\').nextAll(\'.ztl-filter-container\');
							all_following_selects.find(\'select option:first\').attr(\'selected\',true);
							all_following_selects.find(\'select\').prop(\'disabled\',\'disabled\'); 
						
						//call						
						var data = filter_data(filter_id, $(this).attr(\'name\'), 0, category_id, in_stock);  
						
															
					    $.post( ajaxurl, data, function(response) {
					        if (JSON.parse(response).html_options){
					            var target_select = JSON.parse(response).target_name;
					            target_select = target_select.replace("pa_", "ztl_pa_");
						        filter_id_elm.find("select[name="+ target_select+ "]")
								    .find(\'option:not(:first)\')
								    .remove()
								    .end()
								    .append(JSON.parse(response).html_options);
								    
								    //unlock next filter
								    filter_id_elm.find("select[name="+ target_select+ "]").prop(\'disabled\', \'\');
							}
							
							//update filter url
							if (JSON.parse(response).filter_url){
					            //set data
								filter_id_elm.data(\'filter_url\', JSON.parse(response).filter_url);  		   
					        }
					        
					        filter_id_elm.parent(\'.ztl-products-filter\').removeClass(\'ztl-working\');   
						});
				});  
							    
							    
				//redirect to products page
				filter_id_elm.find(\'.ztl-submit-filter\').on(\'click\', function(){
					var url = filter_id_elm.data(\'filter_url\');
					window.location.href = url;
				});		    
					
					
				//init the first select
				var data = filter_data(filter_id, filter_id_elm.find(\'select:first\').attr(\'name\'),1, category_id, in_stock);  			
				$.post( ajaxurl, data, function(response) {
						filter_id_elm.find(\'select:first\')
						    .find(\'option:not(:first)\')
						    .remove()
						    .end()
						    .append(JSON.parse(response).html_options);
						    //set data
							filter_id_elm.data(\'filter_url\', JSON.parse(response).filter_url);      
				});
				
				//lock all filters except the first
				filter_id_elm.find(\'select:not(:first)\').prop(\'disabled\', \'disabled\');
				
				
				filter_id_elm.find(\'.ztl-reset-filter\').on(\'click\', function(){
					//reset each filter
					filter_id_elm.find(\'select\').each(function(){
						$(this).find(\'option:first\').attr(\'selected\',true);
					});
					
					//lock filters
					filter_id_elm.find(\'select:not(:first)\').prop(\'disabled\', \'disabled\');
				});
					
          	});
				
			function filter_data(filter_id, select_id = null, init = 0, category_id = 0, in_stock = false){
			    
			    var data = {
				    \'action\':\'ztl_filter_products\',
				    \'category\':category_id,
				    \'stock\': in_stock,
				    \'select\':select_id, 
				    \'init\': init,
				    \'filters\':{},
				};
			    
			    var selects = {};
			    var current_select_name;
			    var current_select_value;
			    var filter_id_select_elm = $(\'#\'+filter_id+\' select\');
			    
			    filter_id_select_elm.each(function(){
				    current_select_name = ($(this).attr(\'name\'));
				    current_select_value = ($(this).attr(\'value\'));
				    selects[current_select_name] = current_select_value;
			    });
				    
				data.filters = selects;    
			    return data;
			}
				
        })(jQuery);
        </script>
  ';

	$class = $atts['class'];


	$str = '<div class="ztl-products-filter ' . esc_attr( $class ) . '">
				<div class="ztl-filter-overlay">
	            		<div class="ztl-filter-loader"></div>
				</div>
	            <div id="' . esc_attr( $id ) . '">
				   <div class="ztl-products-filter-data">
	               ' . $content . '
	               </div>
	               <div class="ztl-products-filter-buttons">
	               		<span class="ztl-button-one"><button class="ztl-reset-filter" type="submit">' . esc_html__( 'Reset', 'zoutula' ) . '</button></span>
	               		<span class="ztl-button-one"><button class="ztl-submit-filter" type="submit">' . esc_html__( 'Filter', 'zoutula' ) . '</button></span>
	               </div>
	            </div>
	        </div>' . $script;

	$str = apply_filters( 'ztl_shortcode_filter', $str );
	$str = apply_filters( 'uds_shortcode_out_filter', $str );

	return $str;
}


add_action( 'vc_before_init', 'ztl_products_filter' );
function ztl_products_filter() {
	vc_map(
		array(
			'name'                    => esc_html__( 'Products Filter', 'zoutula' ),
			'base'                    => 'products_filter_ztl', //container
			'content_element'         => true,
			'is_container'            => true,
			'as_parent'               => array( 'only' => 'product_filter_ztl' ),
			'description'             => esc_html__( 'Add filter box', 'zoutula' ),
			'show_settings_on_create' => true,
			'icon'                    => plugin_dir_url( __FILE__ ) . 'assets/images/product-filter.png',
			'class'                   => '',
			'category'                => esc_html__( 'Zoutula Shortcodes', 'zoutula' ),
			'params'                  => array(

				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Parent category (id). Empty if search is done through all available products', 'zoutula' ),
					'param_name'  => 'woocommerce_category',
					'description' => esc_html__( 'Search will be done only within this category', 'zoutula' ),
				),

				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Search only in stock products', 'zoutula' ),
					'param_name'  => 'woocommerce_in_stock_only',
					'value'       => array( esc_html__( 'Yes', 'zoutula' ) => 'yes' ),
					'description' => esc_html__( 'If "YES" filter will look only for IN STOCK products', 'zoutula' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Class', 'zoutula' ),
					'param_name'  => 'class',
					'description' => esc_html__( 'Custom Class', 'zoutula' ),
				),
			),
			'js_view'                 => 'VcColumnView',
		)
	);

	// Needed for "Container/Content" functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_products_filter_ztl extends WPBakeryShortCodesContainer {
		}
	}

}


/* Step Child Item  */

add_shortcode( 'product_filter_ztl', 'ztl_shortcode_product_filter' );

function ztl_shortcode_product_filter( $atts ) {


	$atts = shortcode_atts(
		array(
			'attribute_slug' => '',
			'filter_label'   => '',
			'filter_prefix'  => '',
		), $atts
	);

	$str = '';
	if ( empty( $atts['attribute_slug'] ) ) {
		return $str;
	}

	$id  = 'attribute_filter_' . uniqid();
	$str .= '
		<div class="ztl-filter-container">
			<div id="' . esc_attr( $id ) . '">
				<div class="ztl-filter-prefix">' . esc_attr( $atts['filter_prefix'] ) . '</div>
				<select class="wide" name="ztl_pa_' . esc_attr( $atts['attribute_slug'] ) . '">
					<option value="">' . esc_html( $atts['filter_label'] ) . '</option>
				</select>
			</div>
		</div>
		<div class="clear20"></div>';


	$str = apply_filters( 'uds_shortcode_out_filter', $str );

	return $str;
}


add_action( 'vc_before_init', 'ztl_product_filter' );
function ztl_product_filter() {

	//get available attributes
	$attribute_taxonomies = wc_get_attribute_taxonomies();
	$at                   = array( 'Select' => '' );

	foreach ( $attribute_taxonomies as $taxonomy ) {
		$at[ $taxonomy->attribute_label ] = $taxonomy->attribute_name;
	}

	vc_map(
		array(
			'name'                    => esc_html__( 'Filter', 'zoutula' ),
			'base'                    => 'product_filter_ztl', //content
			'icon'                    => plugin_dir_url( __FILE__ ) . 'assets/images/product-filter.png',
			'show_settings_on_create' => true,
			'content_element'         => true,
			'as_child'                => array( 'only' => 'products_filter_ztl' ),
			'params' => array(
				array(
					'type'        => 'dropdown',
					'admin_label' => true,
					'heading'     => esc_html__( 'Select attribute', 'zoutula' ),
					'param_name'  => 'attribute_slug',
					'value'       => $at,
					'description' => esc_html__( 'Choose the attribute you want to filter', 'zoutula' )
				),

				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Filter label', 'zoutula' ),
					'param_name'  => 'filter_label',
					'description' => esc_html__( 'Filter default label', 'zoutula' )
				),

				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Filter prefix', 'zoutula' ),
					'param_name'  => 'filter_prefix',
					'description' => esc_html__( 'Filter prefix. E.g. 1.', 'zoutula' )
				),
			)

		)
	);

	// Needed for "Container/Content" functionality
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_product_filter_ztl extends WPBakeryShortCode {
		}
	}

}


function ztl_filter_products() {

	$args = array(
		'post_type'      => array( 'product' ),
		'post_status'    => 'publish',
		'posts_per_page' => - 1,

		'tax_query' => array(
			'relation' => 'AND',
		)
	);


	//ignore this when populate selects
	$filters_available = array();
	$filter_vars       = array();
	if ( isset( $_POST['action'] ) && ( $_POST['action'] == 'ztl_filter_products' ) ) {
		foreach ( $_POST['filters'] as $attribute => $value ) {
			if ( 0 === strpos( $attribute, 'ztl_pa_' ) ) {
				// we note what filters we have
				$filter_name                       = str_replace( 'ztl_pa_', 'pa_', $attribute );
				$filters_available[ $filter_name ] = 0;

				if ( true === isset( $_POST['select'] ) && ( $_POST['select'] == $attribute ) ) {
					$filters_available[ $filter_name ] = 1;
				}

				//check if we need to filter for an attribute
				if ( false === empty( $value ) ) {
					$args['tax_query'][] = array(
						'taxonomy' => $filter_name,
						'field'    => 'term_id',
						'terms'    => array( $value ),
						'operator' => 'IN',
					);
				}

				//build the filter url
				if ( false === empty( $_POST['filters'][ $attribute ] ) ) {
					if ( $current_term = get_term_by( 'id', $_POST['filters'][ $attribute ], $filter_name ) ) {
						$filter_name                 = str_replace( 'pa_', 'filter_', $filter_name );
						$filter_vars[ $filter_name ] = $current_term->name;
					}
				}
			}
		}

		//if there is a category set we search in this category
		if (isset($_POST['category']) && false === empty($_POST['category'])){
			$args['tax_query'][]= array(
				'taxonomy'      => 'product_cat',
				'terms'         => (int) $_POST['category'],
				'operator'      => 'IN'
			);
		}

		// search only in stock products
		if (isset($_POST['stock']) && ($_POST['stock'] == 'yes')) {
			$args['meta_query'][] = array(
				'key'     => '_stock_status',
				'value'   => 'instock',
				'compare' => '=',
			);
		}
	}

	$queried_attribute        = array_search( '1', $filters_available );
	$queried_attribute_offset = array_search( $queried_attribute, array_keys( $filters_available ) );

	if ( isset( $_POST['action'] ) && ( $_POST['action'] == 'ztl_filter_products' && ( $_POST['init'] == '0' ) ) ) {
		//we get next attribute to query
		$queried_attribute_offset ++;
		$queried_attribute = key( array_slice( $filters_available, $queried_attribute_offset, 1, true ) );
	}

	$wp_query     = new WP_Query( $args );
	$all_products = $wp_query->get_posts();

	$all_data = array();
	$all_data['options'] = array();
	foreach ( $all_products as $product ) {
		$wc_product = wc_get_product( $product->ID );

		//count only for current attribute
		foreach ( $wc_product->get_attributes() as $attribute ) {
			if ( $current_attribute = $attribute->get_data() ) {
				if ( true === isset( $current_attribute ) && $current_attribute['name'] == $queried_attribute ) {
					$all_data_options['name'] = $current_attribute['name'];

					//make the count
					if ( is_array( $current_attribute['options'] ) && false === empty( $current_attribute['options'] ) ) {
						foreach ( $current_attribute['options'] as $current_option_id ) {
							if (false === isset($all_data['options'][ $current_option_id ])){
								$all_data['options'][ $current_option_id ] = 0;
							}
							$all_data['options'][ $current_option_id ] += 1;
						}
					}
				}
			}
		}
	}



	$options_data = array();
	$options_count = array();
	foreach ( $all_data['options'] as $option => $count ) {
		$term_name    = get_term( $option )->name;
		$options_data[$option] = $term_name;
		$options_count[$option] = $count;
	}

	//sort options
	asort($options_data);

	//generate HTML
	$html_options = '';
	foreach ( $options_data as $option => $option_name ) {
		$html_options .= '<option value="' . esc_attr( $option ) . '">' . esc_html( $option_name ) . ' (' . esc_html( $options_count[$option] ) . ')</option>';
	}

	$filter_query = http_build_query( $filter_vars );

	//get category slug to build the redirect url later
	$category_slug = get_category_link((int) $_POST['category']);
	$filter_url = $category_slug . ( $filter_query ? '?' . $filter_query : $filter_query );

	if (empty($category_slug) === true){
		$filter_url = get_permalink( wc_get_page_id( 'shop' ) ) . ( $filter_query ? '?' . $filter_query : $filter_query );

	}

	die( json_encode( array(
		'html_options' => $html_options,
		'target_name'  => $queried_attribute,
		'filter_url'   => $filter_url
	) ) );

}

add_action( 'wp_ajax_ztl_filter_products', 'ztl_filter_products' );
add_action( 'wp_ajax_nopriv_ztl_filter_products', 'ztl_filter_products' );


?>