<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Autoresq
 */
/**
 * Display navigation to next/previous post when applicable.
 */
function autoresq_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = (is_attachment()) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation">
	<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'autoresq' ); ?></h2>
	<div class="nav-links">
		<?php
			previous_post_link( '<div class="nav-previous"><span class="meta-nav"></span><i class="fa ztl-icon-navigation  base-flaticon-arrow-left"></i>%link</div>',esc_html_x( '%title', 'Previous post link', 'autoresq' ) );
			next_post_link( '<div class="nav-next">%link<span class="meta-nav"></span><i class="fa ztl-icon-navigation  base-flaticon-arrow-right"></i></div>',esc_html_x( '%title', 'Next post link','autoresq' ) );
		?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function autoresq_posted_on() {
	$time_string = '<time class="entry-date published updated ztl-entry-date" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published ztl-entry-date" datetime="%1$s"> %2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'autoresq' ),
		'<span class="flaticon-calendar64 ztl-post-info"></span><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function autoresq_entry_footer() {

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'autoresq' ), esc_html__( '1 Comment', 'autoresq' ), esc_html__( '% Comments', 'autoresq' ) );
		echo '</span>';
	}
}


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function autoresq_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'autoresq_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'autoresq_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so autoresq_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so autoresq_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in autoresq_categorized_blog.
 */
function autoresq_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'autoresq_categories' );
}
add_action( 'edit_category', 'autoresq_category_transient_flusher' );
add_action( 'save_post',     'autoresq_category_transient_flusher' );
