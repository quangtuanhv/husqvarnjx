<?php
$atts = shortcode_atts(array(
    'enable_button'=>'false',
    'photo' => '',
    'title' => '',
    't_size' => '30',
    't_color' => '',
    't_fontweight' => 'normal',
    't_alignment' => 'left',
    'css_class' => '',
    'image_size' => 'full',
    'text_button' =>'Shop now',
    'link_button' => 'http://example.com',
    'alignment_button' => 'left'
), $atts, 'otf_slider_item');
extract($atts);
$values = array();
$thumb_size = otf_get_image_size($image_size);
$thumbnail = wpb_resize($photo, null, $thumb_size[0], $thumb_size[1], true);
$css = 'style="';
if (!empty($t_size)) {
    $size = preg_replace('/[^0-9]/', '', $t_size);
    $css .= 'font-size:' . esc_attr($size) . 'px;';
}
if (!empty($t_color)) {
    $css .= 'color:' . $t_color . ';';
}
if (!empty($t_fontweight)) {
    $css .= 'font-weight:' . $t_fontweight . ';';
}
$css .= 'text-align:' . esc_attr($t_alignment) . ';"';

if ( ! preg_match( '/^(https?\:\/\/|\/\/)/', $link_button ) ) {
    $link_button = 'http://' . $link_button;
}

?>

<div class="otf-item-slider column-item">
    <div class="slider-wrapper d-md-flex">
        <div class="slider-img">
            <img class="img-responsive" src="<?php echo esc_url($thumbnail['url']) ?>"
                 width="<?php echo esc_attr($thumbnail['width']); ?>"
                 height="<?php echo esc_attr($thumbnail['height']); ?>" alt="<?php echo esc_attr($title) ?>">
        </div>
        <div class="slider-content d-flex align-items-center">
            <?php
            if (!empty($content)): ?>
                <div class="information p-lg-5 py-4">
                    <?php
                    if (!empty($title)):
                        echo '<h2 class="item-slider-title typo-heading '. esc_attr($css_class).'" ' . $css . ' >' . esc_attr($title) . '</h2>';
                    endif;
                    echo wp_kses_post(otf_sanitize_editor($content)); ?>
                    <?php if($enable_button == 'true') {
                        echo '<div class="text-'.esc_attr($alignment_button).'"><a type="button" class="button button-primary"  href="'.esc_attr($link_button).'"> '.esc_attr($text_button).'</a></div>';
                    } ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>