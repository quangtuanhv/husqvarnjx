<?php
/**
 * The template for displaying custom posts.(service post type)
 *
 * @package Autoresq
 */
get_header();
get_template_part( 'template-parts/header' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<div class="container">
			<div class="row">			
				
				<div class="clearfix <?php autoresq_bc_all( '12' ); ?>">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'service' ); ?>

				<?php endwhile; // end of the loop. ?>
				</div>
			</div>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
