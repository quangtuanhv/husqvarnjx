<?php
if (ezboozt_is_woocommerce_activated()) {
    $classes = '';
    if (!empty($atts['style'])) {
        $classes = $atts['style'];
    }
    if (!empty($atts['css'])) {
        $classes .= ' ' . $atts['css'];
    }
    $title = !empty($atts['title']) ? $atts['title'] : 'Shopping cart';
    $icon = !empty($atts['icon']) ? $atts['icon'] : 'icon icon-1245';
    $icon_style = !empty($atts['i_style']) ? $atts['i_style'] : '';
    ?>
    <div class="site-header-cart menu <?php echo esc_attr($classes) ?>">
        <?php echo otf_cart_link($icon,$title,$icon_style); ?>
        <ul class="shopping_cart <?php echo $atts['alignment'] ?>">
            <li>
                <?php the_widget('WC_Widget_Cart', 'title='); ?>
            </li>
        </ul>
    </div>
    <?php
}