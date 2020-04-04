<?php
/* 
Class Name: Add Product Details Tab Module

Author: Bigboss555
Author URI: http://sakosys.com
Copyright sakosys.com. All rights reserved
*/

add_filter( 'woocommerce_product_tabs', 'bbtwpss_parts_tab' );
function bbtwpss_parts_tab( $tabs ) {
// Adds the new tab
	$tabs['bbtwpss_tab'] = array(
		'title' => __( 'Parts Information', 'woocommerce' ),
		'priority' => 50,
		'callback' => 'bbtwpss_parts_content'
	);
	return $tabs;
}
function bbtwpss_parts_content() {
	$wef_data = taxomoyArrangeViewWEF();
	echo '<table class="table"><thead><tr><th>Make</th><th>Model</th><th>Year</th><th>Engine</th><th>Fuel</th></tr></thead>';
	echo '<tbody>';
	if(count($wef_data) > 0){
		foreach($wef_data as $wef_val){
			echo '<tr><td>'.$wef_val['make'].'</td><td>'.$wef_val['model'].'</td><td>'.$wef_val['year'].'</td><td>'.$wef_val['engine'].'</td><td>'.$wef_val['fuel'].'</td></tr>';
		}
	}
	echo '</tbody>';
	echo '</table>';
}
function twpss_get_term_children($terms,$parent_id){
	$label_2 = array();
	foreach($terms as $term){
		if($term->parent == $parent_id){
			$child = twpss_get_term_children_3($terms,$term->term_id);
			$label_2[] = array(
				'term_id'	=> $term->term_id,
				'child'		=> $child,
				'name'		=> $term->name
			);
		}
	}
	return $label_2;
}
function twpss_get_term_children_3($terms,$parent_id){
	$label_3 = array();
	foreach($terms as $term){
		if($term->parent == $parent_id){
			$label_3[] = array(
				'term_id'	=> $term->term_id,
				'name'		=> $term->name
			);
		}
	}
	return $label_3;
}
function taxomoyArrangeViewWEF(){
	$arrObj = array();
	global $product,$wpdb;
	if(isset($product->post->ID)){
		$terms = get_the_terms( $product->post->ID, 'bb_WEF_Filter' );
		foreach($terms as $term){
			if($term->parent == 0){
				$child1_terms = twpss_get_term_children($terms, $term->term_id);
				if(count($child1_terms) > 0){
					foreach($child1_terms as $child1_term){
						$child2_terms = twpss_get_term_children($terms, $child1_term['term_id']);
						if(count($child2_terms) > 0){
							foreach($child2_terms as $child2_term){
								$child3_terms = twpss_get_term_children($terms, $child2_term['term_id']);
								if(count($child3_terms) > 0){
									foreach($child3_terms as $child3_term){
										$child4_terms = twpss_get_term_children($terms, $child3_term['term_id']);
										if(count($child4_terms) > 0){
											foreach($child4_terms as $child4_term){
												$arrObj[] = array(
													'make'		=> $term->name,
													'model'		=> $child1_term['name'],
													'year'		=> $child2_term['name'],
													'engine'	=> $child3_term['name'],
													'fuel'		=> $child4_term['name']
												);
											}	
										}
										else{
											$arrObj[] = array(
												'make'		=> $term->name,
												'model'		=> $child1_term['name'],
												'year'		=> $child2_term['name'],
												'engine'	=> $child3_term['name'],
												'fuel'		=> ''
											);
										}
									}
								}
								else{
									$arrObj[] = array(
										'make'		=> $term->name,
										'model'		=> $child1_term['name'],
										'year'		=> $child2_term['name'],
										'engine'	=> '',
										'speed'		=> ''
									);
								}
							}
						}
						else{
							$arrObj[] = array(
								'make'			=> $term->name,
								'model'			=> $child1_term['name'],
								'year'			=> '',
								'engine'		=> '',
								'fuel'			=> ''
							);
						}
					}
				}
				else{
					$arrObj[] = array(
						'make'		=> $term->name,
						'model'		=> '',
						'year'		=> '',
						'engine'	=> '',
						'fuel'		=> ''
					);
				}
			}
		}
	}
	return $arrObj;
}