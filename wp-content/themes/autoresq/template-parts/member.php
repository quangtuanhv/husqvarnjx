<?php
/**
 * Autoresq staff template part
 *
 * @package Autoresq
 */
?>
        <div class="ztl-staff-item">
            <div class="variation-2">
                <div class="<?php autoresq_bc( '6', '6', '12' ); ?>">
                    <div class="item-left">
                        <div class="image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php
                                    if ( has_post_thumbnail() ) {
									    the_post_thumbnail( 'autoresq-column' );
                                    }
                                ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="<?php autoresq_bc( '6', '6', '12' ); ?>">
                    <div class="item-right">
                        <div class="staff-title ztl-font-semi-bold"><?php the_title(); ?></div>
                        <div class="staff-position">
                            <?php echo esc_html( get_post_meta( get_the_ID(), 'autoresq_staff_position', true ) ); ?>
                        </div>
                        <ul class="ztl-social ztl-social-mini">
                            <?php if ( get_post_meta( get_the_ID(), 'autoresq_staff_member_facebook', true ) ) { ?>
                                <li>
                                    <div class="ztl-icon"></div>
                                    <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'autoresq_staff_member_facebook', true ) ); ?>"
                                       target="_blank"><i class="base-flaticon-facebook"></i></a>
                                </li><?php } ?>
                            <?php if ( get_post_meta( get_the_ID(), 'autoresq_staff_member_twitter', true ) ) { ?>
                                <li>
                                    <div class="ztl-icon"></div>
                                    <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'autoresq_staff_member_twitter', true ) ); ?>"
                                       target="_blank"><i class="base-flaticon-twitter"></i></a>
                                </li> <?php } ?>
                            <?php if ( get_post_meta( get_the_ID(), 'autoresq_staff_member_linkedin', true ) ) { ?>
                                <li>
                                    <div class="ztl-icon"></div>
                                    <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'autoresq_staff_member_linkedin', true ) ); ?>"
                                       target="_blank"><i class="base-flaticon-linkedin"></i></a>
                                </li> <?php } ?>
                        </ul>
                        <div class="staff-excerpt"><?php autoresq_excerpt( 40, false ); ?></div>
                        <div class="clear20"></div>
                        <div class="ztl-button-one ztl-center">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php esc_html_e( 'More About Me', 'autoresq' ); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
