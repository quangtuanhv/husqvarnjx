<?php
/**
 * Autoresq blog template part
 *
 * @package Autoresq
 */
get_header();
get_template_part('template-parts/header');
?>

<div class="category-listing clearfix content-area">
    <div class="container">
        <div class="row">
            <?php
            if (is_page_template('template-blog-full.php') || !is_active_sidebar('sidebar')) {
                $bootstrap_container_left_classes = 'ztl-full-width-template ' . autoresq_get_bc('12', '12', '12', '12', '');
                $bootstrap_container_right_classes = '';
            } elseif (is_page_template('template-blog-sidebar.php')) {
                $bootstrap_container_left_classes = 'ztl-right-sidebar-template ' . autoresq_get_bc('8', '8', '8', '12', '');
                $bootstrap_container_right_classes = autoresq_get_bc('4', '4', '4', '12', '');
            }
            ?>
            <div class="clearfix <?php echo esc_attr($bootstrap_container_left_classes); ?>">
                <?php

                // Protect against arbitrary paged values
                $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
                $args = array(
                    'post_type' => 'post',
                    'paged' => $paged,
                );

                global $query;
                $query = new WP_Query($args);

                if ($query->have_posts()) {

                    while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('template-parts/post');
                    }
                    get_template_part('template-parts/pagination');

                } else {
                    get_template_part('content', 'none');
                }
                ?>
            </div>
            <?php if (!empty($bootstrap_container_right_classes)) { ?>
                <div class="category-sidebar-right <?php echo esc_attr($bootstrap_container_right_classes); ?>">
                    <?php if (is_active_sidebar('sidebar')) : ?>
                        <?php dynamic_sidebar('sidebar'); ?>
                    <?php endif; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php get_footer() ?>
