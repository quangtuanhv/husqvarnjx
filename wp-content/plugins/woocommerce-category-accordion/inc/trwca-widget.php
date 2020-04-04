<?php
/**
 * Woocommerce Category Accordion Widget
 *
 * @author 		TechieResource
 * @category 	Widgets
 * @package 	woocommerce-category-accordion/inc
 * @version 	2.0
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {


class wc_category_accordion extends WP_Widget {	
	
	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */

    public function __construct() {
		
		/* Widget settings. */
		$widget_ops = array( 'description' => __('list WooCommerce product categories and subcategories into a Accordion.','trwca'));
		
    	parent::__construct( false, __( 'WC Category Accordion', 'trwca'), $widget_ops );
			
     }
	public function wc_category_accordion()
    {
        self::__construct();
    } 	
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
    function widget($args, $instance) {

		extract( $args, EXTR_SKIP );
		
		extract( $instance, EXTR_SKIP );
		
		echo $before_widget;
		
		if ( $title ) {
			echo $before_title . apply_filters('widget_title', $title ) . $after_title;
		}			
		$instance['id']= $this->id;
		
		do_action( 'woocommerce_category_accordion', $instance, true );
		
        echo $after_widget;
    }
	function update( $new_instance, $old_instance ) {

         
		$instance['title']            = empty( $new_instance['title'] ) ? '' : trwca_clean( $new_instance['title'] );
		$instance['show_count']       = empty( $new_instance['show_count'] ) ? '' : trwca_clean( $new_instance['show_count'] );
		$instance['enb_rtl']          = empty( $new_instance['enb_rtl'] ) ? '' : trwca_clean( $new_instance['enb_rtl'] );
		$instance['hide_empty']       = empty( $new_instance['hide_empty'] ) ? '' : trwca_clean( $new_instance['hide_empty'] );
		$instance['sortby']           = empty( $new_instance['sortby'] ) ? '' : trwca_clean( $new_instance['sortby'] );
		$instance['open_cat']         = empty( $new_instance['open_cat'] ) ? false : trwca_clean( $new_instance['open_cat'] );
		$instance['ac_speed']         = empty( $new_instance['ac_speed'] ) ? 'fast' : trwca_clean( $new_instance['ac_speed'] );
		$instance['ac_theme']         = empty( $new_instance['ac_theme'] ) ? '' : trwca_clean( $new_instance['ac_theme'] );
		$instance['order']            = empty( $new_instance['order'] ) ? '' : trwca_clean( $new_instance['order'] );
		$instance['level']            = empty( $new_instance['level'] ) ? '' : trwca_clean( $new_instance['level'] );
		$instance['ac_type']          = empty( $new_instance['ac_type'] ) ? '' : trwca_clean( $new_instance['ac_type'] );
		$instance['ac_icon']          = empty( $new_instance['ac_icon'] ) ? 'plus' : trwca_clean( $new_instance['ac_icon'] );
		$instance['event_type']       = empty( $new_instance['event_type'] ) ? '' : trwca_clean( $new_instance['event_type'] );
		$instance['ac_opencat']       = empty( $new_instance['ac_opencat'] ) ? '' : trwca_clean( $new_instance['ac_opencat'] );
		$instance['exclude_tree']     = empty( $new_instance['exclude_tree'] ) ? "" : trwca_clean( $new_instance['exclude_tree'] );
		$instance['disable_parent']   = isset( $new_instance['disable_parent'] ) ? true : trwca_clean( $new_instance['disable_parent'] );
		$instance['disable_aclink']   = empty( $new_instance['disable_aclink'] ) ? false : trwca_clean( $new_instance['disable_aclink'] );
		$instance['show_subcats']     = empty( $new_instance['show_subcats'] ) ? false : trwca_clean( $new_instance['show_subcats'] );
		$instance['subcat_optn']      = empty( $new_instance['subcat_optn'] ) ? 'showac' : trwca_clean( $new_instance['subcat_optn'] );		
    
		return $instance;
	
    }

	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	
		$title 		     = $instance['title'];
		$show_count	     = !empty($instance['show_count']) ? $instance['show_count'] : false;
		$enb_rtl	     = !empty($instance['enb_rtl']) ? $instance['enb_rtl'] : false;	
		$hide_empty	     = !empty($instance['hide_empty']) ? $instance['hide_empty'] : '';
		$sortby 	     = !empty($instance['sortby']) ? $instance['sortby'] : '';
		$ac_opencat	     = !empty($instance['ac_opencat']) ? $instance['ac_opencat'] : '';
		$exclude_tree    = !empty($instance['exclude_tree']) ? $instance['exclude_tree'] : '';			
		$open_cat	     = !empty($instance['open_cat']) ? $instance['open_cat'] : false;
		$ac_speed	     = !empty($instance['ac_speed']) ? $instance['ac_speed'] : 'fast';
		$ac_theme	     = !empty($instance['ac_theme']) ? $instance['ac_theme'] : '';
		$order	         = !empty($instance['order']) ? $instance['order'] : '';
		$level	         = !empty($instance['level']) ? $instance['level'] : '';
		$event_type	     = !empty($instance['event_type']) ? $instance['event_type'] : '';
		$ac_type	     = !empty($instance['ac_type']) ? $instance['ac_type'] : '';			
		$ac_icon	     = !empty($instance['ac_icon']) ? $instance['ac_icon'] : 'plus';
		$disable_parent  = isset($instance['disable_parent']) ? $instance['disable_parent'] : true;
		$disable_aclink  = !empty($instance['disable_aclink']) ? $instance['disable_aclink'] : false;
		$show_subcats    = !empty($instance['show_subcats']) ? $instance['show_subcats'] : false;
		$subcat_optn	     = !empty($instance['subcat_optn']) ? $instance['subcat_optn'] : 'showac';		 
?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'trwca' ) ?></label>
    <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
    value="<?php if ( isset( $title ) ) echo esc_attr( $title ); 
    else echo __( 'Categories', 'trwca' ); ?>" />
</p>
<p>
    <input type="checkbox" class="" id="<?php echo esc_attr( $this->get_field_id( 'enb_rtl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('enb_rtl') ); ?>" 
    value="1" <?php if ( isset( $enb_rtl ) ) checked( $enb_rtl, 1 ); ?> />
    <label for="<?php echo $this->get_field_id( 'enb_rtl' ); ?>"><?php _e( 'Enable RTL', 'trwca' ) ?></label>
</p>

<p>
    <input type="checkbox" class="" id="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_count') ); ?>" 
    value="1" <?php if ( isset( $show_count ) ) checked( $show_count, 1 ); ?> />
    <label for="<?php echo $this->get_field_id( 'show_count' ); ?>"><?php _e( 'Enable Products Count:', 'trwca' ) ?></label>
</p>
<p>
    <input type="checkbox" class="" id="<?php echo esc_attr( $this->get_field_id( 'hide_empty' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('hide_empty') ); ?>" 
    value="1" <?php if ( isset( $hide_empty ) ) checked(  $hide_empty, 1 ); ?> />
    <label for="<?php echo $this->get_field_id( 'hide_empty' ); ?>"><?php _e( 'Hide If Empty:', 'trwca' ) ?></label>
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'sortby' ); ?>"><?php _e( 'Sort by:', 'trwca' ); ?></label>
    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'sortby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sortby' ) ); ?>">
        <option value='ID'<?php echo ($sortby=='Id')?'selected':''; ?>><?php _e( 'Id', 'trwca' ); ?></option>
        <option value='name'<?php echo ($sortby=='name')?'selected':''; ?>><?php _e( 'Name', 'trwca' ); ?></option>
        <option value='slug'<?php echo ($sortby=='slug')?'selected':''; ?>><?php _e( 'Slug', 'trwca' ); ?></option>   
    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'order:', 'trwca' ); ?></label>
    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
        <option value='ASC' <?php echo ($order=='ASC')?'selected':''; ?>><?php _e( 'Ascending', 'trwca' ); ?></option>
        <option value='DESC' <?php echo ($order=='DESC')?'selected':''; ?>><?php _e( 'Descending', 'trwca' ); ?></option>
    </select>
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'level' ); ?>"><?php _e( 'Level:', 'trwca' ); ?></label>
    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'level' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'level' ) ); ?>">
<?php for ($i=0; $i<=10; $i++) {
		if($i==0){ ?>    
   		<option value="0" selected="selected" ?><?php _e( 'All', 'trwca' ); ?></option>  <?php 
		}
		else{ ?>
		<option value="<?php echo $i; ?>" <?php echo ($level==$i)?'selected':''; ?>><?php echo $i; ?></option> <?php 
		}
} ?></select>	
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'event_type' ); ?>"><?php _e( 'Accordion Event Type:', 'trwca' ); ?></label>
    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'event_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'event_type' ) ); ?>">
        <option value='click' <?php echo ($event_type=='click')?'selected':''; ?>><?php _e( 'Click', 'trwca' ); ?></option>
        <option value='hover' <?php echo ($event_type=='hover')?'selected':''; ?>><?php _e( 'Hover', 'trwca' ); ?></option>
    </select>
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'ac_type' ); ?>"><?php _e( 'Accordion Type:', 'trwca' ); ?></label>
    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'ac_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ac_type' ) ); ?>">
        <option value='toggle' <?php echo ($ac_type=='toggle')?'selected':''; ?>><?php _e( 'Toggle', 'trwca' ); ?></option>
        <option value='collapsed' <?php echo ($ac_type=='collapsed')?'selected':''; ?>><?php _e( 'Collapsed', 'trwca' ); ?></option>
    </select>
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'ac_icon' ); ?>"><?php _e( 'Accordion Icon:', 'trwca' ); ?></label>
    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'ac_icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ac_icon' ) ); ?>">
        <option value="angle" <?php echo ($ac_icon=='angle')?'selected':''; ?>><?php _e( 'Angle', 'trwca' ); ?></option>
        <option value="doubleangle" <?php echo ($ac_icon=='doubleangle')?'selected':''; ?>><?php _e( 'Double angle', 'trwca' ); ?></option>
        <option value="plus" <?php echo ($ac_icon=='plus')?'selected':''; ?>><?php _e( 'Plus', 'trwca' ); ?></option>
        <option value="plus-circle" <?php echo ($ac_icon=='plus-circle')?'selected':''; ?>><?php _e( 'Plus Circle', 'trwca' ); ?></option>
        <option value="plus-square1" <?php echo ($ac_icon=='plus-square1')?'selected':''; ?>><?php _e( 'Plus Square1', 'trwca' ); ?></option>
        <option value="plus-square2" <?php echo ($ac_icon=='plus-square2')?'selected':''; ?>><?php _e( 'Plus Square2', 'trwca' ); ?></option>
        <option value="arrow-circle1" <?php echo ($ac_icon=='arrow-circle1')?'selected':''; ?>><?php _e( 'Circle arrow style1', 'trwca' ); ?></option>
        <option value="arrow-circle2" <?php echo ($ac_icon=='arrow-circle2')?'selected':''; ?>><?php _e( 'Circle arrow style2', 'trwca' ); ?></option>
        <option value="arrow-right" <?php echo ($ac_icon=='arrow-right')?'selected':''; ?>><?php _e( 'Arrow right', 'trwca' ); ?></option>
        <option value="caret" <?php echo ($ac_icon=='caret')?'selected':''; ?>><?php _e( 'Caret', 'trwca' ); ?></option>
        <option value="caret-square" <?php echo ($ac_icon=='caret-square')?'selected':''; ?>><?php _e( 'Caret Square', 'trwca' ); ?></option>
        <option value="chevron" <?php echo ($ac_icon=='chevron')?'selected':''; ?>><?php _e( 'Chevron', 'trwca' ); ?></option>
        <option value="chevron-circle" <?php echo ($ac_icon=='chevron-circle')?'selected':''; ?>><?php _e( 'Chevron Circle', 'trwca' ); ?></option>
        <option value="hand" <?php echo ($ac_icon=='hand')?'selected':''; ?>><?php _e( 'Hand', 'trwca' ); ?></option>
        <option value="circle" <?php echo ($ac_icon=='circle')?'selected':''; ?>><?php _e( 'Circle', 'trwca' ); ?></option>
        <option value="heart" <?php echo ($ac_icon=='heart')?'selected':''; ?>><?php _e( 'Heart', 'trwca' ); ?></option>
        <option value="levelup" <?php echo ($ac_icon=='levelup')?'selected':''; ?>><?php _e( 'Level up', 'trwca' ); ?></option>
        <option value="square" <?php echo ($ac_icon=='square')?'selected':''; ?>><?php _e( 'Square', 'trwca' ); ?></option>
        <option value="rotate" <?php echo ($ac_icon=='rotate')?'selected':''; ?>><?php _e( 'Rotate', 'trwca' ); ?></option>       
        
    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id('ac_theme'); ?>"><?php _e('Accordion Theme:','trwca'); ?> 
    <select class='widefat' id="<?php echo $this->get_field_id('ac_theme'); ?>" name="<?php echo $this->get_field_name('ac_theme'); ?>">        
        <option value='acclassic'<?php echo ($ac_theme=='acclassic')?'selected':''; ?>><?php _e( 'Classic', 'trwca' ); ?></option>
        <option value='aclight'<?php echo ($ac_theme=='aclight')?'selected':''; ?>><?php _e( 'Light', 'trwca' ); ?></option>
        <option value='acred'<?php echo ($ac_theme=='acred')?'selected':''; ?>><?php _e( 'Red', 'trwca' ); ?></option>
        <option value='acgreen'<?php echo ($ac_theme=='acgreen')?'selected':''; ?>><?php _e( 'Green', 'trwca' ); ?></option>
        <option value='acturquoise'<?php echo ($ac_theme=='acturquoise')?'selected':''; ?>><?php _e( 'Turquoise', 'trwca' ); ?></option>
        <option value='acblue'<?php echo ($ac_theme=='acblue')?'selected':''; ?>><?php _e( 'Blue', 'trwca' ); ?></option>
        <option value='acpurple'<?php echo ($ac_theme=='acpurple')?'selected':''; ?>><?php _e( 'Purple', 'trwca' ); ?></option>
        <option value='acpink'<?php echo ($ac_theme=='acpink')?'selected':''; ?>><?php _e( 'Pink', 'trwca' ); ?></option>
        <option value='acgamboge'<?php echo ($ac_theme=='acgamboge')?'selected':''; ?>><?php _e( 'Yellow', 'trwca' ); ?></option>
        <option value='acbrown'<?php echo ($ac_theme=='acbrown')?'selected':''; ?>><?php _e( 'Brown', 'trwca' ); ?></option>       
        <option value='acorange'<?php echo ($ac_theme=='acorange')?'selected':''; ?>><?php _e( 'Orange', 'trwca' ); ?></option>
        <option value='acdblue'<?php echo ($ac_theme=='acdblue')?'selected':''; ?>><?php _e( 'Dark Blue', 'trwca' ); ?></option>
        <option value='acblack'<?php echo ($ac_theme=='acblack')?'selected':''; ?>><?php _e( 'Dark', 'trwca' ); ?></option>                  
    </select>                
    </label>
</p>
<p>
    <input type="checkbox" name="<?php echo $this->get_field_name('open_cat'); ?>" value="1" <?php if ( isset( $open_cat ) ) checked( $open_cat, 1 ); ?> class=""  size="4"  id="<?php echo $this->get_field_id('open_cat'); ?>" />
    <label for ="<?php echo $this->get_field_id('open_cat'); ?>"><?php _e('Enable Highlight / Open a Category','trwca'); ?></label>
</p>
<p>
    <input type="checkbox" name="<?php echo $this->get_field_name('disable_parent'); ?>" value="1" <?php if ( isset( $disable_parent ) ) checked( $disable_parent, 1 ); ?> class=""  size="4"  id="<?php echo $this->get_field_id('disable_parent'); ?>" />
    <label for ="<?php echo $this->get_field_id('disable_parent'); ?>"><?php _e('Disable Parent links','trwca'); ?></label>
</p>

<p>
    <input type="checkbox" class="" id="<?php echo esc_attr( $this->get_field_id( 'disable_aclink' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('disable_aclink') ); ?>" 
    value="1" <?php if ( isset( $disable_aclink ) ) checked( $disable_aclink, 1 ); ?> />
    <label for="<?php echo $this->get_field_id( 'disable_aclink' ); ?>"><?php _e( 'Disable All Parent links', 'trwca' ) ?></label>
</p>

<p>
    <input type="checkbox" class="" id="<?php echo esc_attr( $this->get_field_id( 'show_subcats' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_subcats') ); ?>" 
    value="1" <?php if ( isset( $show_subcats ) ) checked( $show_subcats, 1 ); ?> />
    <label for="<?php echo $this->get_field_id( 'show_subcats' ); ?>"><?php _e( 'Show subcategories only', 'trwca' ) ?></label>
</p>
<p>
    <label for ="<?php echo $this->get_field_id('ac_opencat'); ?>"><?php echo __('Default Category Id to open: ','trwca'); ?></label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('ac_opencat'); ?>" size="5" name="<?php echo $this->get_field_name('ac_opencat'); ?>" 
    value="<?php if(isset($ac_opencat)) echo $ac_opencat;   ?>"/>
    <small>The selected category will open by default</small>
</p>
<p>
    <label for ="<?php echo $this->get_field_id('exclude_tree'); ?>"><?php echo __('Exclude Category (ID): ','trwca');
    ?></label>
    <input type="text" class="widefat"id="<?php echo $this->get_field_id('exclude_tree'); ?>" name="<?php echo $this->get_field_name('exclude_tree'); ?>" value="<?php if(isset($exclude_tree)) echo esc_attr($exclude_tree) ?>"/>
    <small>category IDs, separated by commas.</small>
</p>
<p>
    <label for="<?php echo $this->get_field_id('ac_speed'); ?>"><?php _e('Accodion Speed:','trwca'); ?> 
    <select class='widefat' id="<?php echo $this->get_field_id('ac_speed'); ?>" name="<?php echo $this->get_field_name('ac_speed'); ?>">  
    
        <option value='slow' <?php echo ($ac_speed=='slow')?'selected':''; ?>>Slow</option> 
        <option value='normal' <?php echo ($ac_speed=='normal')?'selected':''; ?>>Normal</option>  	
        <option value='fast' <?php echo ($ac_speed=='fast')?'selected':''; ?>>Fast</option> 
    </select>                
    </label>
</p>
<?php
	}
}

add_action('widgets_init', 'wc_category_accordion_fn');

    function wc_category_accordion_fn(){
        register_widget('wc_category_accordion');

    }

}
?>