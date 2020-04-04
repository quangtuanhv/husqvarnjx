<?php
/**
 * The template for displaying comments.
 * The area of the page that contains both current comments and the comment form.
 *
 * @package Autoresq
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( esc_html__( 'Comments (%s)', 'autoresq' ), number_format_i18n( get_comments_number() ) );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'autoresq' ); ?></h2>
			<?php if (get_previous_comments_link()){ ?>
                <div class="nav-previous"><i class="fa fa-angle-left"></i><?php previous_comments_link( esc_html__( 'Older Comments', 'autoresq' ) ); ?></div>
			<?php } ?>
			<?php if (get_next_comments_link()){ ?>
                <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'autoresq' ) ); ?><i class="fa fa-angle-right"></i></div>
			<?php } ?>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
					'avatar_size' => 50,
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

		<nav id="comment-nav-below" class="comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'autoresq' ); ?></h2>
            <?php if (get_previous_comments_link()){ ?>
			    <div class="nav-previous"><i class="fa fa-angle-left"></i><?php previous_comments_link( esc_html__( 'Older Comments', 'autoresq' ) ); ?></div>
            <?php } ?>
			<?php if (get_next_comments_link()){ ?>
			    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'autoresq' ) ); ?><i class="fa fa-angle-right"></i></div>
            <?php } ?>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'autoresq' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
