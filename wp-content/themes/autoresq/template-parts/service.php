<?php
/**
 * Autoresq service template part
 *
 * @package Autoresq
 */

$service_start_date = new DateTime(get_post_meta(get_the_ID(), 'autoresq_service_start_date', true));
?>
<div class="ztl-service-item">
    <div class="row table-row">
        <div class="first ztl-col <?php autoresq_bc('12', '12', '12', '12')?>">
            <div class="ztl-flex">
                <div class="ztl-post-thumbnail" style="background-image:url('<?php if (has_post_thumbnail()) { echo get_the_post_thumbnail_url(get_the_ID(),'autoresq-wide');} ?>');">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
                </div>
                <div class="ztl-post-details">
                    <div class="ztl-service-info ztl-font-bold">
	                    <?php if ($autoresq_service_cost = get_post_meta(get_the_ID(), 'autoresq_service_cost', true)) { ?>
                            <span class="ztl-service-info-line">
                                <span>
                                    <span><?php echo esc_html($autoresq_service_cost); ?> //</span>
                                    <?php esc_html_e('starting price','autoresq') ?>
                                </span>
                            </span>
	                    <?php } ?>

	                    <?php if ($autoresq_service_duration = get_post_meta(get_the_ID(), 'autoresq_service_duration', true)) { ?>
                            <span class="ztl-service-info-line" style="padding-right:0px;">
                                <span>
                                    <span><?php echo esc_html($autoresq_service_duration); ?> //</span>
	                                <?php esc_html_e('estimated repair time','autoresq') ?>
                                </span>
                            </span>
	                    <?php } ?>
                    </div>
                    <div class="ztl-service-title ztl-accent-font">
                        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h3>
                    </div>
                    <div class="ztl-service-description">
                        <?php autoresq_excerpt( 40, false ); ?>
                    </div>
                    <div class="clear40"></div>
                    <div class="ztl-button-one">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php echo esc_html__('More Details', 'autoresq'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
