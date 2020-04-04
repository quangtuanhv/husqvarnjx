<?php
/**
 * Content template part for displaying single post
 *
 * @package Autoresq
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content ztl-single">
		<div class="entry-meta centered">
			<span class="entry-title"><?php the_title(); ?></span>
			<div class="ztl-post">
				<div class="image">
					<?php the_post_thumbnail( 'autoresq-full' ); ?>
				</div>
			</div>

		</div><!-- .entry-meta -->
		<?php
		the_content( sprintf(
		/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'autoresq' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'autoresq' ),
			'after'  => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php autoresq_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
