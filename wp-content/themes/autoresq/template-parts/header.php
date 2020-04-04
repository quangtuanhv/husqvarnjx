<?php
/**
 * Autoresq header image / header title template part
 *
 * @package Autoresq
 */

// In case is page and has option to show header image.
$header_option    = get_post_meta( get_the_ID(), 'autoresq_header_option', true );
$breadcrumb_class = 'ztl-breadcrumb-' . get_theme_mod( 'show_breadcrumb', 'show' );

//Get header image
$header_image = get_header_image();

//Get custom header image
if ( isset( $post->ID ) ) {
	$autoresq_header_image_id = get_post_meta( $post->ID, 'autoresq_header_image_id', true );
}
if ( isset( $autoresq_header_image_id ) && false === empty( $autoresq_header_image_id ) ) {
	//Override header image with the custom one
	$header_image_result = wp_get_attachment_image_src( $autoresq_header_image_id, 'full' );
	$header_image        = reset( $header_image_result );
}
?>
<?php if ( $header_option == 'hidden' ) { ?>

<?php } else { ?>
    <div class="page-top custom-header <?php if ($header_image) { echo esc_attr('ztl-custom-header-has-image'); }?>">
        <div class="header-image <?php echo esc_attr( $breadcrumb_class );
		if ( is_singular( 'post' ) && get_post_type( get_the_ID() ) == 'post' ) {
			echo esc_attr( ' ztl-post-header' );
		} ?>">
            <div class="ztl-header-image"
                 style="background-color:<?php echo esc_attr( get_theme_mod( 'title_background', '#f2f2f2' ) ) . ";";
			     if ( ! empty( $header_image ) ) {
				     echo "background-image: url(" . esc_url( $header_image ) . ")";
			     } ?>">
                <div class="container">

					<?php if ( is_singular( 'post' ) && get_post_type( get_the_ID() ) == 'post' ) { ?>
                        <div class="ztl-date-line ztl-date-header">
                            <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
                        </div>
					<?php } ?>


                    <h1 class="ztl-accent-font custom-header-title"
                        style="color:<?php echo esc_attr( get_theme_mod( 'title_color', '#072f4f' ) ); ?>;">
						<?php echo autoresq_get_title(); ?>
                    </h1>

					<?php if ( is_singular( 'post' ) && get_post_type( get_the_ID() ) == 'post' ) { ?>
                        <div class="ztl-info-header">
							<?php
                            // Author
							$author_name = get_the_author_meta( 'display_name', $post->post_author );
							$author_url  = get_author_posts_url( $post->post_author );
							?>
                            <i class="base-flaticon-edit-1"></i>
                            <a class="ztl-delimiter-header" href="<?php echo esc_url( $author_url ); ?>"
                               name="<?php echo esc_attr( $author_name ); ?>"><?php echo esc_html( $author_name ); ?>
                            </a>

							<?php
                            // Categories
							$categories = get_the_category();
							if (empty($categories) === false){
							    echo ' <i class="base-flaticon-hierarchy"></i>';
                            }
							foreach ( $categories as $key => $category ) {

								if ( $category == end( $categories ) ) {
									$last_category = 'ztl-delimiter-header';
								} else {
									$last_category = '';
								}
								echo '<a class="' . $last_category . '" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr__( 'View all posts filed under ', 'autoresq' ) . esc_attr( $category->name ) . '">';
								echo esc_attr( $category->name );
								echo '</a>';
								if ( $key >= 0 && $key + 1 < count( $categories ) ) {
									echo ', ';
								}
							}
							// Tags
	                        $tags = get_the_tags();
	                        if ( $tags ) {
		                        echo '<span class="ztl-delimiter-header"><i class="base-flaticon-tag"></i>';
		                        the_tags( '' );
		                        echo '</span>';
	                        }
	                        ?>
                            <i class="base-flaticon-message"></i>
                            <a class="ztl-delimiter-header" href="<?php the_permalink(); ?>#comments">
								<?php echo esc_html( get_comments_number() ); ?>
                            </a>
                        </div>


					<?php } ?>
                </div>
            </div>
			<?php if ( function_exists( 'breadcrumb_trail' ) && 'ztl-breadcrumb-show' == $breadcrumb_class ): ?>
                <div class="ztl-breadcrumb-container">
                    <div class="container">
						<?php breadcrumb_trail( array( 'show_browse' => false ) ); ?>
                    </div>
                </div>
			<?php endif; ?>
        </div>
    </div>
<?php } ?>
