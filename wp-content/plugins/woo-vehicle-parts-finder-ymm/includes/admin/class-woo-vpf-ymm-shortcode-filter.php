<?php
/**
 * Shortcode - Vehicle Parts Filter
 *
 * @class WOO_VPF_YMM_Shortcode_Filter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WOO_VPF_YMM_Filter {
	
	/**
	 * WOO_VPF_YMM_Filter Constructor
	 */
	public function __construct() {
		add_shortcode( 'woo_vpf_ymm_filter', array( $this, 'woo_vpf_ymm_filter' ) );
	}
	/**
	 * Output the filter shortcode
	 *
	 * @param  array $args
	 * @return string
	 */
	public function woo_vpf_ymm_filter( $args ) {
		ob_start();
		
		$this->shortcode_start( $args );
		WOO_VPF_YMM_Functions::get_filter_widget_template( $args );
		$this->shortcode_end( $args );
		
		return ob_get_clean();
	}
	
	/**
	 * Output the html at the start of shortcode
	 *
	 * @param  array $args
	 * @return string
	 */
	public function shortcode_start( $args ) {
		echo apply_filters( 'woo_vpf_ymm_shortcode_filter_wrapper_start', '<div class="woo_vpf_ymm_filter_wrapper">' );
		
		if ( isset( $args['title'] ) && $args['title'] != '' ) {
			echo apply_filters( 'woo_vpf_ymm_shortcode_filter_before_title', '<h2 class="woo_vpf_ymm_filter_title">' ) . $args['title'] . apply_filters( 'woo_vpf_ymm_shortcode_filter_after_title', '</h2>' );
		}
	}

	/**
	 * Output the html at the end of shortcode
	 *
	 * @param  array $args
	 * @return string
	 */
	public function shortcode_end( $args ) {
		echo apply_filters( 'woo_vpf_ymm_shortcode_filter_wrapper_end', '</div>' );
	}
}

new WOO_VPF_YMM_Filter();
