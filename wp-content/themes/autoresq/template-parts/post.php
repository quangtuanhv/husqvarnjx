<?php
/**
 * Autoresq default post item template part
 *
 * @package Autoresq
 */

if ( is_page_template( 'template-blog-full.php' ) ) {
	$thumbnail_size = 'autoresq-blog-full';
	$excerpt_length = 35;
} elseif ( is_page_template( 'template-blog-sidebar.php' ) ) {
	$thumbnail_size = 'autoresq-blog';
	$excerpt_length = 25;
} else {
	$thumbnail_size = 'autoresq-blog-full';
	$excerpt_length = 35;
}
?>

<div class="ztl-post-item item item-content-wrap
    <?php
    if ( is_sticky() ) {
	    echo esc_attr( ' ztl-sticky' );
    }
    if ( has_post_thumbnail()){
	    echo esc_attr( ' ztl-has-thumbnail' );
    }
    ?>">
    <?php   if ( has_post_thumbnail()){ ?>
        <div class="item-media ztl-overflow">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail( $thumbnail_size ); ?>
            </a>
        </div>
    <?php } ?>
    <div class="item-content">
        <div class="date">
            <span class="date-tag ztl-date-line">
                <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?> </a>
            </span>
        </div>
        <div class="title">
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </div>
        <div class="info">
            <span class="ztl-author">
                <span>
                    <?php esc_html_e( 'by', 'autoresq' ); ?>
                </span>
	            <?php the_author_posts_link(); ?>
                <span class="ztl-delimiter-post">//</span>
            </span>

            <span class="ztl-categories">
                <?php
                $categories = get_the_category();
                foreach ( $categories as $key => $category ) {
	                echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr__( 'View all posts filed under ', 'autoresq' ) . esc_attr( $category->name ) . '">';
	                echo esc_html( $category->name );
	                echo '</a>';
	                if ( $key >= 0 && $key + 1 < count( $categories ) ) {
		                echo ', ';
	                }
                }
                if ( ! empty( $categories ) ) {
	                echo ' <span class="ztl-delimiter-post">//</span>';
                }
                ?>
            </span>

            <span class="ztl-comments">
                <a href="<?php the_permalink(); ?>#comments">
                    <?php echo esc_html( get_comments_number() ); ?>
                </a>
            </span>

        </div>
        <div class="item-excerpt">
			<?php autoresq_excerpt( $excerpt_length ); ?>
        </div>
        <div class="ztl-button-one read-more">
            <a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read more', 'autoresq' ); ?></a>
        </div>
    </div>
</div>