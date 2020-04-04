<?php
/* 
Class Name: Shortcode Tyre Dropdown

Author: Bigboss555
Author URI: http://sakosys.com
Copyright sakosys.com. All rights reserved
*/

function wef_filter_info_shortcode(){
	if(isset($_REQUEST['wef_data'])){
		$term_id = $_REQUEST['wef_data'];
		$termchildren = get_term_children( $term_id, 'bb_WEF_Filter' );
		foreach ( $termchildren as $child ) {
			$term = get_term_by( 'id', $child, 'bb_WEF_Filter' );
			if(isset($term->parent) && $term->parent != '' && $term->parent == $term_id){
				$output .= '<option value="'.$term->term_id.'">'.$term->name.'</option>';
			}
		}
		echo $output;
	}
	exit;
}
add_action( 'wp_ajax_nopriv_wef_filter_info_shortcode', 'wef_filter_info_shortcode' );
add_action( 'wp_ajax_wef_filter_info_shortcode', 'wef_filter_info_shortcode' );
add_action( 'init', 'register_woocommerce_bbWEF_shortcodes');

function bbWEFFilterDataSc($term_id,$selected){
	$termchildren = get_term_children( $term_id, 'bb_WEF_Filter' );
	foreach ( $termchildren as $child ) {
		$term = get_term_by( 'id', $child, 'bb_WEF_Filter' );
		if(isset($term->parent) && $term->parent != '' && $term->parent == $term_id){
			if($term->term_id == $selected){
				$output .= '<option selected="selected" value="'.$term->term_id.'">'.$term->name.'</option>';
			}
			else{
				$output .= '<option value="'.$term->term_id.'">'.$term->name.'</option>';
			}
		}
	}
	return $output;
}

function register_woocommerce_bbWEF_shortcodes(){
   add_shortcode('bbWEF_filter', 'bbWEF_shortcode_html_fun');
}
function bbWEF_shortcode_html_fun( $atts ){ 
	$_bb_view_mode = 'V';
	$_bb_cat_enable = 1;
	$_bb_fuel_enable = 1;
	$_bb_engine_enable = 1;
	$_bb_year_enable = 1;
	$_bb_model_enable = 1;
	$_bb_top_title = 'Find Your Parts';
	$_bb_make_label = 'Select Make';
	$_bb_model_label = 'Select Model';
	$_bb_year_label = 'Select Year';
	$_bb_engine_label = 'Select Engine';
	$_bb_fuel_label = 'Select Fuel';
	$_bb_category_label = 'Select Category';
	$_bb_filter_button_label = 'Filter Parts';

	$output = '<div class="wef_shortcode woocommerce">';
	if(isset($atts['top_title']) && $atts['top_title'] != ''){
		$_bb_top_title = $atts['top_title'];
	}
	if(isset($atts['view_mode']) && $atts['view_mode'] != ''){
		$_bb_view_mode = $atts['view_mode'];
	}
	if(isset($atts['enable_category'])){
		$_bb_cat_enable = $atts['enable_category'];
	}
	if(isset($atts['enable_fuel'])){
		$_bb_fuel_enable = $atts['enable_fuel'];
	}
	if(isset($atts['enable_engine'])){
		$_bb_engine_enable = $atts['enable_engine'];
	}
	if(isset($atts['enable_year'])){
		$_bb_year_enable = $atts['enable_year'];
	}
	if(isset($atts['enable_model'])){
		$_bb_model_enable = $atts['enable_model'];
	}
	if(isset($atts['make_label']) && $atts['make_label'] != ''){
		$_bb_make_label = $atts['make_label'];
	}
	if(isset($atts['model_label']) && $atts['model_label'] != ''){
		$_bb_model_label = $atts['model_label'];
	}
	if(isset($atts['year_label']) && $atts['year_label'] != ''){
		$_bb_year_label = $atts['year_label'];
	}
	if(isset($atts['engine_label']) && $atts['engine_label'] != ''){
		$_bb_engine_label = $atts['engine_label'];
	}
	if(isset($atts['fuel_label']) && $atts['fuel_label'] != ''){
		$_bb_fuel_label = $atts['fuel_label'];
	}
	if(isset($atts['category_label']) && $atts['category_label'] != ''){
		$_bb_category_label = $atts['category_label'];
	}
	if(isset($atts['button_label']) && $atts['button_label'] != ''){
		$_bb_filter_button_label = $atts['button_label'];
	}
	//
	$_bb_get_make = '';
	$_bb_get_model = '';
	$_bb_get_year = '';
	$_bb_get_engine = '';
	$_bb_get_fuel = '';
	$_bb_get_cat = '';
	if(isset($_GET['bb_make']) && $_GET['bb_make'] != '-1'){
		$_bb_get_make = $_GET['bb_make'];
	}
	if(isset($_GET['bb_model']) && $_GET['bb_model'] != '-1'){
		$_bb_get_model = bbWEFFilterDataSc($_GET['bb_make'],$_GET['bb_model']);
	}
	if(isset($_GET['bb_year']) && $_GET['bb_year'] != '-1'){
		$_bb_get_year = bbWEFFilterDataSc($_GET['bb_model'],$_GET['bb_year']);
	}
	if(isset($_GET['bb_engine']) && $_GET['bb_engine'] != '-1'){
		$_bb_get_engine = bbWEFFilterDataSc($_GET['bb_year'],$_GET['bb_engine']);
	}
	if(isset($_GET['bb_fuel']) && $_GET['bb_fuel'] != '-1'){
		$_bb_get_fuel = bbWEFFilterDataSc($_GET['bb_engine'],$_GET['bb_fuel']);
	}
	if(isset($_GET['bb_cat']) && $_GET['bb_cat'] != '-1'){
		$_bb_get_cat = $_GET['bb_cat'];
	}
	$make_list = get_terms( 'bb_WEF_Filter', array(
		'orderby'    	=> 'name',
		'parent'        => '0',
		'order'         => 'ASC',
		'hide_empty'	=> $hide_empty
	));
	$args = array(
		'show_option_all'    => '',
		'show_option_none'   => $_bb_category_label,
		'option_none_value'  => '-1',
		'orderby'            => 'ID', 
		'order'              => 'ASC',
		'show_count'         => 0,
		'hide_empty'         => 0, 
		'child_of'           => 0,
		'exclude'            => '',
		'echo'               => 0,
		'selected'           => (int)$_bb_get_cat,
		'hierarchical'       => 1,
		'name'               => 'bb_cat',
		'id'                 => 'bbwef_category',
		'class'              => 'bbwef_category',
		'depth'              => 0,
		'tab_index'          => 0,
		'taxonomy'           => 'product_cat',
		'hide_if_empty'      => false,
		'value_field'	     => 'term_id'
	 );

if($_bb_view_mode == 'V'){
	$output .= '<form class="bb_filter_form" action="'.get_site_url().'" method="get"><span id="bbwefLoader_sc"><img src=' . plugins_url() . '/woo_vehicle_engine_fuel_filter/img/loader.gif /></span>';
		if ( !empty( $make_list ) && !is_wp_error( $make_list ) ){
			$output .= "<div style='padding:5px'><h2>".$_bb_top_title."</h2></div>";
			$output .= "<div style='padding:5px'><select class='wef_make_box_sc' onchange=bbWEF_create_request_shortcode(this,2,'".admin_url( 'admin-ajax.php' )."'); name='bb_make'><option value='-1'>".$_bb_make_label."</option>";
			foreach ( $make_list as $make_item ) {
				if($_bb_get_make != '' && $_bb_get_make == $make_item->term_id){
					$output .= '<option selected value="'.$make_item->term_id.'">'.$make_item->name.'</option>';
				}
				else{
					$output .= '<option value="'.$make_item->term_id.'">'.$make_item->name.'</option>';
				}
			}
			$output .= '</select></div>';
			if($_bb_model_enable==1){
			$output .= "<div style='padding:5px'><select class='wef_model_box_sc' name='bb_model' onchange=bbWEF_create_request_shortcode(this,3,'".admin_url( 'admin-ajax.php' )."');><option value='-1'>".$_bb_model_label."</option>".$_bb_get_model."</select></div>";
			}
			if($_bb_year_enable==1){
			$output .= "<div style='padding:5px'><select onchange=bbWEF_create_request_shortcode(this,4,'".admin_url( 'admin-ajax.php' )."'); class='wef_year_box_sc' name='bb_year'><option value='-1'>".$_bb_year_label."</option>".$_bb_get_year."</select></div>";
			}
			if($_bb_engine_enable==1){
			$output .= "<div style='padding:5px'><select onchange=bbWEF_create_request_shortcode(this,5,'".admin_url( 'admin-ajax.php' )."'); class='wef_engine_box_sc' name='bb_engine'><option value='-1'>".$_bb_engine_label."</option>".$_bb_get_engine."</select></div>";
			}
			if($_bb_fuel_enable==1){
			$output .= "<div style='padding:5px'><select class='wef_fuel_box_sc' name='bb_fuel'><option value='-1'>".$_bb_fuel_label."</option>".$_bb_fuel_label."</select></div>";
			}
			if($_bb_cat_enable==1){
			$output .= "<div style='padding:5px'>".wp_dropdown_categories( $args )."</div>";
			}
			$output .= "<div align='left' style='padding:6px'><input type='submit' class='button' value='".$_bb_filter_button_label."'></div><input type='hidden' name='post_type' value='product'></form>";
		}
	} else{
		$output .= '<form class="bb_filter_form" action="'.get_site_url().'" method="get"><span id="bbwefLoader_sc"><img src=' . plugins_url() . '/woo_vehicle_engine_fuel_filter/img/loader.gif /></span>';
			$type_list = get_terms( 'bb_WEF_Filter', array(
				'orderby'    	=> 'name',
				'parent'        => '0',
				'order'         => 'ASC',
				'hide_empty'	=> $hide_empty
			));

			if ( !empty( $type_list ) && !is_wp_error( $type_list ) ){
				$output .= "<div style='padding:5px'><h2>".$_bb_top_title."</h2></div>";
				$output .= "<div style='padding:5px;float:left;width:130px;'><select class='wef_make_box_sc shortcodeSelect_wef' onchange=bbWEF_create_request_shortcode(this,2,'".admin_url( 'admin-ajax.php' )."'); name='bb_make'><option value='-1'>".$_bb_make_label."</option>";
				foreach ( $make_list as $make_item ) {
					if($_bb_get_make != '' && $_bb_get_make == $make_item->term_id){
						$output .= '<option selected value="'.$make_item->term_id.'">'.$make_item->name.'</option>';
					}
					else{
						$output .= '<option value="'.$make_item->term_id.'">'.$make_item->name.'</option>';
					}
				}
				$output .= '</select></div>';
				if($_bb_model_enable==1){
				$output .= "<div style='padding:5px;float:left;width:130px;'><select class='wef_model_box_sc shortcodeSelect_wef' name='bb_model' onchange=bbWEF_create_request_shortcode(this,3,'".admin_url( 'admin-ajax.php' )."');><option value='-1'>".$_bb_model_label."</option>".$_bb_get_width."</select></div>";
				}
				if($_bb_year_enable==1){
				$output .= "<div style='padding:5px;float:left;width:130px;'><select onchange=bbWEF_create_request_shortcode(this,4,'".admin_url( 'admin-ajax.php' )."') class='wef_year_box_sc shortcodeSelect_wef' name='bb_year'><option value='-1'>".$_bb_year_label."</option>".$_bb_get_profile."</select></div>";
				}
				if($_bb_engine_enable==1){
				$output .= "<div style='padding:5px;float:left;width:130px;'><select onchange=bbWEF_create_request_shortcode(this,5,'".admin_url( 'admin-ajax.php' )."') class='wef_engine_box_sc shortcodeSelect_wef' name='bb_engine'><option value='-1'>".$_bb_engine_label."</option>".$_bb_get_size."</select></div>";
				}
				if($_bb_fuel_enable==1){
				$output .= "<div style='padding:5px;float:left;width:130px;'><select class='wef_fuel_box_sc shortcodeSelect_wef' name='bb_fuel'><option value='-1'>".$_bb_fuel_label."</option>".$_bb_get_fuel."</select></div>";
				}
				if($_bb_cat_enable==1){
				$output .= "<div style='padding:5px;float:left;width:130px;'>".wp_dropdown_categories( $args )."</div>";
				}
				$output .= "<div align='left' style='padding:6px'><input type='submit' class='button' value='".$_bb_filter_button_label."'></div><input type='hidden' name='post_type' value='product'><div style='clear:both;'></div></form>";
			}
	}
	$output .= '</div>';
	return $output;
	
}
?>
