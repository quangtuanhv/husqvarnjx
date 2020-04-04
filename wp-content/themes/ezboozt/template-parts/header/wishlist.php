<?php
$classes = '';
if (!empty($atts['css'])) {
    $classes = ' ' . $atts['css'];
}
$icon = !empty($atts['icon']) ? $atts['icon'] : 'icon icon-483';
$icon_style = !empty($atts['i_style']) ? $atts['i_style'] : '';
?>
<div class="site-header-wishlist d-inline-block <?php echo esc_attr($classes); ?>">
    <a class="opal-header-wishlist header-button"
       href="<?php echo esc_url(get_permalink(get_option('yith_wcwl_wishlist_page_id'))); ?>">
        <i class="<?php echo esc_attr($icon);?>" aria-hidden="true" style="<?php echo esc_attr($icon_style);?>"></i>
        <span class="count"><?php echo esc_html(yith_wcwl_count_all_products()); ?></span>
    </a>
</div>
