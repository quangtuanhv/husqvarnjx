<?php
/**
 * Woocommerce Category Accordion Functions
 *
 * @author 		TechieResource
 * @category 	Functions
 * @package 	woocommerce-category-accordion/inc
 * @version 	2.0
 */
 /**
 
 /* Clean variables
 *
 * @param string $var
 * @return string
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	 
class trwca_wc_category_accordion{
	
		/**
		 * Constructor
		 */
	    private $shortcode_tag = "WC-Category-Accordion";
		
		
		private static $wcaid = 0;
		 
		public function __construct() {
		
		add_action( 'woocommerce_category_accordion', array( $this, 'woocommerce_category_accordion_func' ), 10, 2 );
		add_shortcode( $this->shortcode_tag, array( $this, 'wc_category_accordion_sc' ) );
		
			if ( is_admin() ){
				add_action('admin_head', array( $this, 'admin_head') );
				add_action( 'admin_enqueue_scripts', array($this , 'admin_enqueue_scripts' ) );
			}
		}


		/**
		 * Display the Woocommerce Category Accordion.
		 * @since  1.2.1
		 * @param  array $instance Arguments.
		 * @param  bool  $echo Whether to display or return the output.
		 * @return string
		 */
		public function woocommerce_category_accordion_func( $instance, $echo = true ) {
	
			extract( $instance, EXTR_SKIP );

			global $wp_query, $post, $product;	
	
			$exclude_tree   = esc_attr($exclude_tree );			
			$enb_rtl  		= esc_attr($enb_rtl);		
			$hide_empty     = esc_attr($hide_empty );		
			$show_count     = esc_attr($show_count );			
			$open_cat       = esc_attr($open_cat );			
			$ac_speed       = esc_attr($ac_speed );		
			$ac_type        = esc_attr($ac_type );			
			$event_type     = esc_attr($event_type );			
			$ac_icon        = esc_attr($ac_icon );			
			$sortby         = esc_attr($sortby );			
			$ac_theme       = esc_attr($ac_theme ); 			 
			$order          = esc_attr($order );			
			$level          = esc_attr($level );			
			$cats_id        = esc_attr($ac_opencat);			
			$disable_parent = esc_attr($disable_parent);			
			$disable_aclink = esc_attr($disable_aclink);			
			$show_subcats   = esc_attr($show_subcats);	
			
			/* Icon Selection */
			$acc_icon = array(
				'angle' => array(
					'open_icon' => 'angle-down',
					'close_icon' => 'angle-right'
				),
				'doubleangle' => array(
					'open_icon' => 'angle-double-down',
					'close_icon' => 'angle-double-right'
				),
				'arrow-circle1' => array(					
					'open_icon' =>'arrow-circle-down',				
					'close_icon' =>'arrow-circle-right'
				),
				'arrow-circle2' => array(					
					'open_icon' =>'arrow-circle-o-down',				
					'close_icon' =>'arrow-circle-o-right'
				),
				'arrow-right' => array(
					'open_icon' =>'arrow-down',
					'close_icon' =>'arrow-right'
				),
				'caret' => array(
					'open_icon' =>'caret-down',
					'close_icon' =>'caret-right'
				),
				'caret-square' => array(					
					'open_icon' =>'caret-square-o-down',				
					'close_icon' =>'caret-square-o-right'
				),
				'chevron' => array(
					'open_icon' =>'chevron-down',
					'close_icon' =>'chevron-right'
				),
				'chevron-circle' => array(
					'open_icon' =>'chevron-circle-down',
					'close_icon' =>'chevron-circle-right'
				),
				'hand' => array(
					'open_icon' =>'hand-o-down',
					'close_icon' =>'hand-o-right'
				),
				'plus' => array(
					'open_icon' =>'minus',
					'close_icon' =>'plus'
				),
				'plus-circle' => array(
					'open_icon' =>'minus-circle',
					'close_icon' =>'plus-circle'
				),
				'plus-square1' => array(
					'open_icon' =>'minus-square',
					'close_icon' =>'plus-square'
				),
				'plus-square2' => array(
					'open_icon' =>'minus-square-o',
					'close_icon' =>'plus-square-o'
				),
				'circle' => array(
					'open_icon' =>'circle',
					'close_icon' =>'circle-o'
				),
				'heart' => array(
					'open_icon' =>'heart',
					'close_icon' =>'heart-o'
				),
				'levelup' => array(
					'open_icon' =>'levelup',
					'close_icon' =>'leveldown'
				),
				'square' => array(
					'open_icon' =>'square',
					'close_icon' =>'square-o'
				),
				'rotate' => array(
					'open_icon' =>'rotate-right',
					'close_icon' =>'rotate-left'
				)
			);	
			$widgetid= 'wc_category_accordion-'.self::$wcaid++;					
			
			$terms=!empty($post->ID) ? get_the_terms( $post->ID, 'product_cat' ): "";
			
			if (is_array($terms )) {
	
				foreach ( $terms as $term) {
	
					$_cat=$term->term_id;
	
					break;
	
				}
			}
		
       		 /* For current category highlight */ 
			if(is_product()){
			
			$current_cat= array();
			
			$cat = $wp_query->get_queried_object();		
				 
			if (!empty($cat->term_id))
	
			{
				$current_cat = $cat->term_id;
	
			}
			 else{                
				 $_cat_id="1";
	
				 if (isset($term->term_id)){
					 
					   $_cat=$term->term_id;	
					   $_cat_id = !empty($_cat) ? $_cat_id=$_cat : $_cat_id=1 ;
					  
					}
					if (!is_shop()){
						
						if (is_array($terms )) {					
					
							foreach($terms as $term){
								$myterms[]= $term->term_id; 
							}
							$cats_id=end($myterms); 
?>
<script type="text/javascript">	 
	 var cats_id= <?php  echo end($myterms); ?>;
</script>
<style type="text/css">
<?php foreach((get_the_terms($post->ID, 'product_cat')) as $term) {
			 $myterms= $term->term_id;
			 echo 'ul.'.$widgetid.' li.cat-item-'.$myterms.' > a{font-weight:bold;}';
		   }
		}
	}
?>
	</style>
<?php             
	}
 }
	$cat = $wp_query->get_queried_object();
					 
		if (!empty($cat->term_id) && !is_product() ){
			
			$cats_id = $cat->term_id;
			echo '<script type="text/javascript">
			
			var cats_id= '.$cats_id.';
			
			</script>';
		}
		else if(!is_product_category() && !is_product()){
	
	   		 $cats_id=$ac_opencat;
		}
		$ac_type = $ac_type=="toggle" ? $ac_type= "true" : $ac_type= "false";
			 
		$open_cat = $open_cat== true || $open_cat =='on' ? $open_cat=true : $open_cat=false;
		
		$open_icon=$acc_icon[$ac_icon]['open_icon'];
		
		$close_icon= $acc_icon[$ac_icon]['close_icon'];
		
		$disable_aclink= empty($disable_aclink) ? 'false': 'true';
		
		$disable_parent= empty($disable_parent) ? 'false': 'true';
		
		$cats_id= empty($cats_id) ? 1 : $cats_id;
		
		$enb_rtl = $enb_rtl ? "rtl" : "";
	
?>
<script type="text/javascript">
jQuery(function($){
$('.<?php echo $widgetid; ?>').trwcAccordion({
			classParent	 : 'trwca-parent',
			classActive	 : 'active',
			classArrow	 : 'trwca-icon',
			classCount	 : 'trwca-count',
			classExpand	 : 'trwca-current-parent',
			eventType	 : '<?php echo $event_type; ?>',
			hoverDelay	 : 100,
			menuClose     : true,
			cats_id:  <?php echo $cats_id; ?>,
			ac_type    : <?php echo $ac_type; ?>,
			autoExpand	 : true,
			speed        : '<?php echo $ac_speed ?>',
			saveState	 : '<?php echo $open_cat; ?>',
			disableLink	 : <?php echo $disable_aclink; ?>,
			disableparentLink : <?php echo $disable_parent;  ?>,
			auto_open: 1,
			showCount : true,
			widget_id : "<?php  echo $widgetid; ?>",
			openIcon	: '<?php echo $open_icon; ?>',
			closeIcon	: '<?php echo $close_icon; ?>',
});
});
</script>
<div class="block-content trwca-actheme <?php echo $ac_theme ." ". $enb_rtl; ?>">
<div class="trwca-loader"></div>
<ul class="<?php echo $widgetid; ?> trwca-accordion" id="outer_ul">
<?php

$crntcat= $show_subcats ? $this->getcurrect_category() : "";
$subcat_args = array(

				   'taxonomy' => 'product_cat',
				   'title_li' => '',
				   'orderby' => $sortby,
				   'order'    => $order,
				   'depth' => $level,
				   'show_count' => $show_count,
				   'hide_empty' => $hide_empty,
				   'use_desc_for_title' => 1,
				   'echo' => false,
				   'exclude'  => $exclude_tree,
				   'child_of' => $crntcat,
				   'hierarchical' => true,
				   'show_option_none'   => __('No Categories Found','trwca'),
				   'link_after' => '',
				   'walker'=> new trwca_walker
			   );
						  
?>
<?php $subcategories = wp_list_categories( $subcat_args );

if ( $subcategories ) {
	if (version_compare(PHP_VERSION, '5.5', '>=')){
		$subcategories=preg_replace_callback(
				'/<\/a> \(([0-9]+)\)/',
				function ($matches) { return '&nbsp;<span class="count">('.($matches[1]).')</span></a>'; },$subcategories);
		echo $subcategories;
	}
	else {
		$subcategories = preg_replace('/<\/a> \(([0-9]+)\)/', ' <span class="count">(\\1)</span></a>', $subcategories);
		echo $subcategories;
	}
}
?>
</ul>
</div>
<?php
	}
		/**
		 * admin_head
		 * calls your functions into the correct filters
		 * @return void
		 */
		function admin_head() {
			// check user permissions
			if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
				return;
			}
			
			// check if WYSIWYG is enabled
			if ( 'true' == get_user_option( 'rich_editing' ) ) {
				add_filter( 'mce_external_plugins', array( $this ,'mce_external_plugins' ) );
				add_filter( 'mce_buttons', array($this, 'mce_buttons' ) );
			}
		}
	
		/**
		 * mce_external_plugins 
		 * Adds our tinymce plugin
		 * @param  array $plugin_array 
		 * @return array
		 */
		function mce_external_plugins( $plugin_array ) {
			
			$plugin_array['WC_Category_Accordion'] = plugins_url( 'admin/js/mce-button.js' , __FILE__ );
			return $plugin_array;
		}
	
		/**
		 * mce_buttons 
		 * Adds our tinymce button
		 * @param  array $buttons 
		 * @return array
		 */
		function mce_buttons( $buttons ) {
			array_push( $buttons, 'WC_Category_Accordion' );
			return $buttons;
		}

		function getcurrect_category() {
			global $post;
			global $wp_query;	
			
			$cat_id = get_query_var('product_cat');
			
			if($cat_id){				
			
				$cat = $wp_query->get_queried_object();
				
				$current_catid = $cat->term_id;
			
				$children = get_categories( array( 'child_of' => $current_catid, 'type' => "product", 'taxonomy' => "product_cat" ) );				
				
				if(empty($children)){

					$ancestors = get_ancestors($current_catid,'product_cat' );
					
					$ancestorcatid = isset($ancestors[0])? $ancestors[0]:"";
					
					return $ancestorcatid; 
				}
				else{
					return $current_catid;
				}
		 	 }			
			}
	
		/**
		 * admin_enqueue_scripts 
		 * Used to enqueue custom styles
		 * @return void
		 */
		function admin_enqueue_scripts(){
			 wp_enqueue_style('WC-Category-Accordion-sh', plugins_url( 'admin/css/mce-button.css' , __FILE__ ) );
		}
		public function wc_category_accordion_sc( $atts, $content = null ) {
				//global $content;
				ob_start();
				
				$defaults = array( 
							'show_count' => 0,
							'enb_rtl' => '',
							'ac_speed' => 'fast',
							'exclude_tree' =>'',
							'hide_empty' => 0,
							'sortby' =>'name',
							'order' =>'ASC',
							'level' => 0,
							'event_type' => 'click',
							'subcat_optn' => 'showac',
							'ac_type' => 'toggle',
							'open_cat' => 0,
							'ac_opencat' => 1,
							'ac_icon' =>'plus',
							'disable_parent' => 0,
							'disable_aclink' => 0,
							'ac_theme' => '',
							'show_subcats' => 0);
				$settings = shortcode_atts( $defaults, $atts );
				$this->woocommerce_category_accordion_func( $settings, false );
				$trwcap = ob_get_clean();
    			return $trwcap;
		}
}
new trwca_wc_category_accordion();
 
	function trwca_clean( $var ) {
		return sanitize_text_field( $var );
	}
	
}
?>