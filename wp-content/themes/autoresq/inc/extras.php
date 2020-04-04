<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Autoresq
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function autoresq_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'autoresq_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function autoresq_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if (get_theme_mod('sticky_header','no') == 'yes') {
		//this will enable sticky navigation
		$classes[] = 'ztl-sticky-nav';
	}

	return $classes;
}
add_filter( 'body_class', 'autoresq_body_classes' );


/**
 * Sets the title separator
 *
 * @return string
 */
function autoresq_title_separator() {

	return '|';
}
add_filter( 'document_title_separator', 'autoresq_title_separator' );
