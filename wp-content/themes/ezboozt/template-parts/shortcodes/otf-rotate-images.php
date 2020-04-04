<?php
$atts = shortcode_atts(array(
    'select_image_source'       => 'library',
    'images_link'               => '',
    'images'                    => '',
    'title'                     => '',
    'width'                     => '',
    'height'                    => '',
    'el_class'                  => '',
    'css'                       => '',
), $atts, 'otf_rotate_images');
extract($atts);
$width != '' ? $width = preg_replace('/[^0-9]/', '', $width): $width = 300;
$height != '' ? $height = preg_replace('/[^0-9]/', '', $height): $height = 300 ;
$_id = wp_generate_uuid4();
$images_url = array();

if ($select_image_source == 'library') {
    $images = !empty($images) ? explode(',', $images) : array();
    foreach ($images as $value) {
        $img_url = wp_get_attachment_url($value);
        if (!empty($img_url)) {
            $images_url[] = esc_url($img_url);
        }
    }
} elseif ($select_image_source == 'external') {
    if (function_exists('vc_param_group_parse_atts')) {
        $values = (array)vc_param_group_parse_atts($images_link);
        foreach ($values as $img) {
            if ( ! preg_match( '/^(https?\:\/\/|\/\/)/', $img['link'] ) ) {
                $img['link'] = 'http://' . $img['link'];
            }
            $images_url[] = $img['link'];
        }
    }
}
$class_to_filter = vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, 'otf_rotate_images', $atts);
?>
    <div class="otf-rotateimages <?php echo(esc_attr($el_class). ' ' . esc_attr($css_class)); ?> ">
        <?php if ($title != '') { ?>
            <h3 class="-title">
                <span><?php echo esc_attr($title); ?></span>
             </h3>
        <?php } ?>
        <div class="rotateimages-content">
            <div class="rotate">
                <div id="rotateimages-<?php echo esc_attr($_id); ?>" class="m-auto">

                </div>
            </div>
        </div>
    </div>
<?php if (count($images_url) > 0): ?>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $("#rotateimages-<?php echo esc_attr($_id); ?>").spritespin({
                source: [<?php echo '"' . implode('","', $images_url) . '"'; ?>],
                width:<?php echo $width; ?>,
                height:<?php echo $height; ?>,
                sense: -1,
                responsive: true
            });
        })

    </script>
<?php endif; ?>