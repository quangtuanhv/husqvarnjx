<?php
/* 
Class Name: Widget Parts Dropdown

Author: Bigboss555
Author URI: http://sakosys.com
Copyright sakosys.com. All rights reserved
*/

function wef_filter_info(){
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
add_action( 'wp_ajax_nopriv_wef_filter_info', 'wef_filter_info' );
add_action( 'wp_ajax_wef_filter_info', 'wef_filter_info' );

function bbWEFFilterData($term_id,$selected){
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

class bbWEF_list_widget extends WP_Widget {

	function __construct() {
		parent::__construct(false, $name = __('Vehicle Engine Fuel Filter'));
	}
	
	function form( $instance ) {
		if(isset($instance['title'])) {
			$title  = $instance['title'];
		}
		else {
			$title  = 'Find Your Perfect Parts';
		}
		if(isset($instance['bb_make_title'])) {
			$make_title  = $instance['bb_make_title'];
		}
		else {
			$make_title  = 'Select Make';
		}
		if(isset($instance['bb_model_title'])) {
			$model_title  = $instance['bb_model_title'];
		}
		else {
			$model_title  = 'Select Model';
		}
		if(isset($instance['bb_year_title'])) {
			$year_title  = $instance['bb_year_title'];
		}
		else {
			$year_title  = 'Select Year';
		}
		if(isset($instance['bb_engine_title'])) {
			$engine_title  = $instance['bb_engine_title'];
		}
		else {
			$engine_title  = 'Select Engine';
		}
		if(isset($instance['bb_fuel_title'])) {
			$fuel_title  = $instance['bb_fuel_title'];
		}
		else {
			$fuel_title  = 'Select Fuel';
		}
		if(isset($instance['bb_category_title'])) {
			$category_title  = $instance['bb_category_title'];
		}
		else {
			$category_title  = 'Select Category';
		}
		if(isset($instance['bb_weffilterbutton_title'])) {
			$bb_weffilterbutton_title  = $instance['bb_weffilterbutton_title'];
		}
		else {
			$bb_weffilterbutton_title  = 'Filter Parts';
		}
		if(isset($instance['wef_widget_box'])) {
			$wef_widget_box  = $instance['wef_widget_box'];
		}
		else {
			$wef_widget_box  = '';
		}
		if(isset($instance['bb_wefbutton_align'])) {
			$bb_wefbutton_align  = $instance['bb_wefbutton_align'];
		}
		else {
			$bb_wefbutton_align  = 'left';
		}
		if(isset($instance['bb_product_category_enable'])) {
			$bb_product_category_enable  = $instance['bb_product_category_enable'];
		}
		else {
			$bb_product_category_enable  = '0';
		}
		if(isset($instance['bb_product_fuel_enable'])) {
			$bb_product_fuel_enable  = $instance['bb_product_fuel_enable'];
		}
		else {
			$bb_product_fuel_enable  = '1';
		}
		if(isset($instance['bb_product_engine_enable'])) {
			$bb_product_engine_enable  = $instance['bb_product_engine_enable'];
		}
		else {
			$bb_product_engine_enable  = '1';
		}
		if(isset($instance['bb_product_year_enable'])) {
			$bb_product_year_enable  = $instance['bb_product_year_enable'];
		}
		else {
			$bb_product_year_enable  = '1';
		}
		if(isset($instance['bb_product_model_enable'])) {
			$bb_product_model_enable  = $instance['bb_product_model_enable'];
		}
		else {
			$bb_product_model_enable  = '1';
		}
		
		?>

<p>
  <label><?php echo __( 'Title:', 'bbWEFFilter' ); ?></label>
  <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
  <label><?php echo __( 'Make Title:', 'bbWEFFilter' ); ?></label>
  <input class="widefat" name="<?php echo $this->get_field_name( 'type_title' ); ?>" type="text" value="<?php echo esc_attr( $make_title ); ?>" />
</p>
<p>
  <label><?php echo __( 'Model Title:', 'bbWEFFilter' ); ?></label>
  <input class="widefat" name="<?php echo $this->get_field_name( 'model_title' ); ?>" type="text" value="<?php echo esc_attr( $model_title ); ?>" />
</p>
<p>
  <label><?php echo __( 'Year Title:', 'bbWEFFilter' ); ?></label>
  <input class="widefat" name="<?php echo $this->get_field_name( 'year_title' ); ?>" type="text" value="<?php echo esc_attr( $year_title ); ?>" />
</p>
<p>
  <label><?php echo __( 'Engine Title:', 'bbWEFFilter' ); ?></label>
  <input class="widefat" name="<?php echo $this->get_field_name( 'engine_title' ); ?>" type="text" value="<?php echo esc_attr( $engine_title ); ?>" />
</p>
<p>
  <label><?php echo __( 'Fuel Title:', 'bbWEFFilter' ); ?></label>
  <input class="widefat" name="<?php echo $this->get_field_name( 'fuel_title' ); ?>" type="text" value="<?php echo esc_attr( $fuel_title ); ?>" />
</p>
<p>
  <label><?php echo __( 'Category Title:', 'bbWEFFilter' ); ?></label>
  <input class="widefat" name="<?php echo $this->get_field_name( 'category_title' ); ?>" type="text" value="<?php echo esc_attr( $category_title ); ?>" />
</p>
<p>
  <label><?php echo __( '<b style="color:red;">Enable Model in Filter ?</b>', 'bbWEFFilter' ); ?></label>
  <select class="widefat" name="<?php echo $this->get_field_name( 'bb_product_model_enable' ); ?>">
  	<option value="0" <?php if(esc_attr( $bb_product_model_enable ) == '0'){echo 'selected';}?>>Disable</option>
	<option value="1" <?php if(esc_attr( $bb_product_model_enable ) == '1'){echo 'selected';}?>>Enable</option>
  </select>
</p>
<p>
  <label><?php echo __( '<b style="color:red;">Enable Year in Filter ?</b>', 'bbWEFFilter' ); ?></label>
  <select class="widefat" name="<?php echo $this->get_field_name( 'bb_product_year_enable' ); ?>">
  	<option value="0" <?php if(esc_attr( $bb_product_year_enable ) == '0'){echo 'selected';}?>>Disable</option>
	<option value="1" <?php if(esc_attr( $bb_product_year_enable ) == '1'){echo 'selected';}?>>Enable</option>
  </select>
</p>
<p>
  <label><?php echo __( '<b style="color:red;">Enable Engine in Filter ?</b>', 'bbWEFFilter' ); ?></label>
  <select class="widefat" name="<?php echo $this->get_field_name( 'bb_product_engine_enable' ); ?>">
  	<option value="0" <?php if(esc_attr( $bb_product_engine_enable ) == '0'){echo 'selected';}?>>Disable</option>
	<option value="1" <?php if(esc_attr( $bb_product_engine_enable ) == '1'){echo 'selected';}?>>Enable</option>
  </select>
</p>
<p>
  <label><?php echo __( '<b style="color:red;">Enable Fuel in Filter ?</b>', 'bbWEFFilter' ); ?></label>
  <select class="widefat" name="<?php echo $this->get_field_name( 'bb_product_fuel_enable' ); ?>">
  	<option value="0" <?php if(esc_attr( $bb_product_fuel_enable ) == '0'){echo 'selected';}?>>Disable</option>
	<option value="1" <?php if(esc_attr( $bb_product_fuel_enable ) == '1'){echo 'selected';}?>>Enable</option>
  </select>
</p>
<p>
  <label><?php echo __( '<b style="color:red;">Enable Category in Filter ?</b>', 'bbWEFFilter' ); ?></label>
  <select class="widefat" name="<?php echo $this->get_field_name( 'bb_product_category_enable' ); ?>">
  	<option value="0" <?php if(esc_attr( $bb_product_category_enable ) == '0'){echo 'selected';}?>>Disable</option>
	<option value="1" <?php if(esc_attr( $bb_product_category_enable ) == '1'){echo 'selected';}?>>Enable</option>
  </select>
</p>
<p>
  <label><?php echo __( 'Filter Button Align:', 'bbWEFFilter' ); ?></label>
  <select class="widefat" name="<?php echo $this->get_field_name( 'bb_wefbutton_align' ); ?>">
  	<option value="left" <?php if(esc_attr( $bb_wefbutton_align ) == ''){echo 'left';}?>>Left</option>
	<option value="center" <?php if(esc_attr( $bb_wefbutton_align ) == ''){echo 'center';}?>>Center</option>
	<option value="right" <?php if(esc_attr( $bb_wefbutton_align ) == ''){echo 'right';}?>>Right</option>
  </select>
</p>
<p>
  <label><?php echo __( 'Filter Button Text:', 'bbWEFFilter' ); ?></label>
  <input class="widefat" name="<?php echo $this->get_field_name( 'bb_weffilterbutton_title' ); ?>" type="text" value="<?php echo esc_attr( $bb_weffilterbutton_title ); ?>" />
</p>
<p>
  <label><?php echo __( 'Widget Box Style:', 'bbWEFFilter' ); ?></label>
  <select class="widefat" name="<?php echo $this->get_field_name( 'wef_widget_box' ); ?>">
  	<option value="" <?php if(esc_attr( $wef_widget_box ) == ''){echo 'selected';}?>>Default Theme Style</option>
	<option value="white" <?php if(esc_attr( $wef_widget_box ) == 'white'){echo 'selected';}?>>Theme A</option>
	<option value="red" <?php if(esc_attr( $wef_widget_box ) == 'red'){echo 'selected';}?>>Theme B</option>
	<option value="blue" <?php if(esc_attr( $wef_widget_box ) == 'blue'){echo 'selected';}?>>Theme C</option>
	<option value="yellow" <?php if(esc_attr( $wef_widget_box ) == 'yellow'){echo 'selected';}?>>Theme D</option>
	<option value="green" <?php if(esc_attr( $wef_widget_box ) == 'green'){echo 'selected';}?>>Theme E</option>
	<option value="aqua" <?php if(esc_attr( $wef_widget_box ) == 'aqua'){echo 'selected';}?>>Theme F</option>
	<option value="olive" <?php if(esc_attr( $wef_widget_box ) == 'olive'){echo 'selected';}?>>Theme G</option>
  </select>
</p>
<?php
	}
	function update( $new_instance, $old_instance ) {
		$instance               					= $old_instance;
		$instance['title']      					= sanitize_text_field( $new_instance['title'] );
		$instance['bb_make_title'] 					= sanitize_text_field( $new_instance['type_title'] );
		$instance['bb_model_title'] 				= sanitize_text_field( $new_instance['model_title'] );
		$instance['bb_year_title'] 					= sanitize_text_field( $new_instance['year_title'] );
		$instance['bb_engine_title'] 				= sanitize_text_field( $new_instance['engine_title'] );
		$instance['bb_fuel_title'] 					= sanitize_text_field( $new_instance['fuel_title'] );
		$instance['bb_category_title'] 				= sanitize_text_field( $new_instance['category_title'] );
		$instance['bb_product_category_enable'] 	= sanitize_text_field( $new_instance['bb_product_category_enable'] );
		$instance['bb_weffilterbutton_title']  		= sanitize_text_field( $new_instance['bb_weffilterbutton_title'] );
		$instance['wef_widget_box'] 				= sanitize_text_field( $new_instance['wef_widget_box'] );
		$instance['bb_wefbutton_align'] 			= sanitize_text_field( $new_instance['bb_wefbutton_align'] );
		$instance['bb_product_model_enable'] 		= sanitize_text_field( $new_instance['bb_product_model_enable'] );
		$instance['bb_product_year_enable'] 		= sanitize_text_field( $new_instance['bb_product_year_enable'] );
		$instance['bb_product_engine_enable'] 		= sanitize_text_field( $new_instance['bb_product_engine_enable'] );
		$instance['bb_product_fuel_enable'] 		= sanitize_text_field( $new_instance['bb_product_fuel_enable'] );
		
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		/*here we check get info and selected based on that*/
		$_bb_get_make = '';
		$_bb_get_model = '';
		$_bb_get_year = '';
		$_bb_get_engine = '';
		$_bb_get_fuel = '';
		$_bb_get_category = 0;
		if(isset($_GET['bb_make']) && $_GET['bb_make'] != '-1'){
			$_bb_get_make = $_GET['bb_make'];
		}
		if(isset($_GET['bb_model']) && $_GET['bb_model'] != '-1'){
			$_bb_get_model = bbWEFFilterData($_GET['bb_make'],$_GET['bb_model']);
		}
		if(isset($_GET['bb_year']) && $_GET['bb_year'] != '-1'){
			$_bb_get_year = bbWEFFilterData($_GET['bb_model'],$_GET['bb_year']);
		}
		if(isset($_GET['bb_engine']) && $_GET['bb_engine'] != '-1'){
			$_bb_get_engine = bbWEFFilterData($_GET['bb_year'],$_GET['bb_engine']);
		}
		if(isset($_GET['bb_fuel']) && $_GET['bb_fuel'] != '-1'){
			$_bb_get_fuel = bbWEFFilterData($_GET['bb_engine'],$_GET['bb_fuel']);
		}
		if(isset($_GET['bb_cat']) && $_GET['bb_cat'] != ''){
			$_bb_get_category = $_GET['bb_cat'];
		}
		$wef_theme_style = $instance['wef_widget_box'];
		$bb_button_align = $instance['bb_wefbutton_align'];
		$bb_enable_product_cat = $instance['bb_product_category_enable'];
		$bb_product_fuel_enable = $instance['bb_product_fuel_enable'];
		$bb_product_engine_enable = $instance['bb_product_engine_enable'];
		$bb_product_year_enable = $instance['bb_product_year_enable'];
		$bb_product_model_enable = $instance['bb_product_model_enable'];
		if ( $instance['title'] ) {
			if($wef_theme_style != ''){
				echo "<div class='bbWEFbox'><div class='box-heading-".$wef_theme_style."'>{$instance['title']}</div>";
			}
			else{
				echo "<h3 class='widget-title'>{$instance['title']}</h3>";
			}
		}?>
<?php 
			if($wef_theme_style != ''){
				echo '<div class="box-content-'.$wef_theme_style.'" align="center" style="position:relative;">';
			}
			else{
				echo '<div class="widget woocommerce" align="center" style="position:relative;">';
			}
			echo '<form class="bb_filter_wef_form" action="'.get_site_url().'" method="get"><span id="bbwefLoader"><img style="width:32px;height:32px;" src=' . plugins_url() . '/woo_vehicle_engine_fuel_filter/img/loader.gif /></span>';
	
			$make_list = get_terms( 'bb_WEF_Filter', array(
				'orderby'    	=> 'name',
				'parent'        => '0',
				'order'         => 'ASC',
				'hide_empty'	=> $hide_empty
			));
			
			$args = array(
				'show_option_all'    => '',
				'show_option_none'   => $instance['bb_category_title'],
				'option_none_value'  => '-1',
				'orderby'            => 'ID', 
				'order'              => 'ASC',
				'show_count'         => 0,
				'hide_empty'         => 0, 
				'child_of'           => 0,
				'exclude'            => '',
				'echo'               => 1,
				'selected'           => (int)$_bb_get_category,
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

			if ( !empty( $make_list ) && !is_wp_error( $make_list ) ){
				echo "<div class='bbwef_make'><select class='wef_make_box' onchange=bbWEF_create_request_widget(this,2,'".admin_url( 'admin-ajax.php' )."'); name='bb_make'><option value='-1'>{$instance['bb_make_title']}</option>";
				foreach ( $make_list as $make_item ) {
					if($_bb_get_make != '' && $_bb_get_make == $make_item->term_id){
						echo '<option selected value="'.$make_item->term_id.'">'.$make_item->name.'</option>';
					}
					else{
						echo '<option value="'.$make_item->term_id.'">'.$make_item->name.'</option>';
					}
				}
				echo '</select></div>';
				if($bb_product_model_enable == '1'){
					echo "<div class='bbwef_model'><select class='wef_model_box' name='bb_model' onchange=bbWEF_create_request_widget(this,3,'".admin_url( 'admin-ajax.php' )."'); class='wef_model_box'><option value='-1'>{$instance['bb_model_title']}</option>".$_bb_get_model."</select></div>";
				}
				if($bb_product_year_enable == '1'){
					echo "<div class='bbwef_year'><select onchange=bbWEF_create_request_widget(this,4,'".admin_url( 'admin-ajax.php' )."'); class='wef_year_box' name='bb_year'><option value='-1'>{$instance['bb_year_title']}</option>".$_bb_get_year."</select></div>";
				}
				if($bb_product_engine_enable == '1'){
					echo "<div class='bbwef_engine'><select onchange=bbWEF_create_request_widget(this,5,'".admin_url( 'admin-ajax.php' )."'); class='wef_engine_box' name='bb_engine'><option value='-1'>{$instance['bb_engine_title']}</option>".$_bb_get_engine."</select></div>";
				}
				if($bb_product_fuel_enable == '1'){
					echo "<div class='bbwef_fuel'><select class='wef_fuel_box' name='bb_fuel'><option value='-1'>{$instance['bb_fuel_title']}</option>".$_bb_get_fuel."</select></div>";
				}
				if($bb_enable_product_cat == '1'){
					echo "<div class='bbwef_category'>";
					wp_dropdown_categories( $args );
					echo "</div>";
				}
				echo "<div align='".$bb_button_align."'><input type='submit' class='button' value='{$instance['bb_weffilterbutton_title']}'></div><input type='hidden' name='post_type' value='product'></form>";
			}
			if($wef_theme_style != ''){
				echo '</div>';
			}
		?>
</div>
<?php
	}
}
?>
