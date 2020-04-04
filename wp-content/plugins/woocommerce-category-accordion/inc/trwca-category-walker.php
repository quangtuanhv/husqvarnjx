<?php
/**
 * Woocommerce Category Accordion Category Walker class
 *
 * @author 		TechieResource
 * @category 	Walker class
 * @package 	woocommerce-category-accordion/inc
 * @version 	2.0
 */

class trwca_walker extends Walker_Category {  

    function start_lvl(&$output, $depth=1, $args=array()) {
        $output .= "\n<ul class=\"product_cats submenu\">\n";
    }

    function end_lvl(&$output, $depth=0, $args=array()) {
        $output .= "</ul>\n";
    }
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        extract($args);
        $cat_name = esc_attr( $category->name );
        $cat_name = apply_filters( 'list_cats', $cat_name, $category );
        $termchildren = get_term_children( $category->term_id, $category->taxonomy );
        if($category->count >0 ){
            $aclass =  ' class="cat_has_posts" ';
        }
        else{
        	$aclass =  ' class="cat_has_no_posts" ';
		}
		 if(count($termchildren)>0){
            $aclass =  'class="no-ajaxy"';
		 }
		 
        if($category->parent != 0)
            $link = '<a '.$aclass.' href="' . esc_url( get_term_link($category) ) . '" ';
        else
            $link = '<a '.$aclass.' href="' . esc_url( get_term_link($category) ) . '" ';
        $link .= '>';
        $link .= $cat_name . '</a>';
        if ( !empty($show_count) )
        $link .= ' (' . intval($category->count) . ')';
        if ( 'list' == $args['style'] ) {
            $output .= "\t<li";
            $class = 'cat-item cat-item-' . $category->term_id;
            if ( !empty($current_category) ) {
                $_current_category = get_term( $current_category, $category->taxonomy );
                if ( $category->term_id == $current_category )
                $class .=  ' current-cat';
                elseif ( $category->term_id == $_current_category->parent )
                $class .=  ' current-cat-parent';
            }
            $output .=  ' class="' . $class . '"';
            $output .= ">$link\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }
    function end_el(&$output, $item, $depth=0, $args=array()) {
        $output .= "</li>\n";
    }
}

?>