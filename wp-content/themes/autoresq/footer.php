<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after
 *
 * @package Autoresq
 */
?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php if ( is_active_sidebar( 'sidebar-above-footer' ) ) : ?>
            <div class="sidebar-above-footer sidebar-ztl clearfix">
                <div class="container">
                    <div class="row">
						<?php dynamic_sidebar( 'sidebar-above-footer' ); ?>
                    </div>
                </div>
            </div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
		<div class="sidebar-footer clearfix">
			<div class="container">
				<div class="row">
						<?php dynamic_sidebar( 'sidebar-footer' ); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<div class="site-info">			
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<?php if ( get_theme_mod( 'show_footer_social','hide' ) == 'show' ) {?>
							<ul class="ztl-social">
								<?php
                                    $allowed_tags = array(
                                        'i' => array(
                                            'class' => array(),
                                            'style' => array(),
                                        )
                                    );
                                    if ( get_theme_mod( 'social_link_1' ) ) {
									echo
                                        '<li>
                                            <div class="ztl-icon"></div>
                                            <a target="_blank" href="'. esc_url( get_theme_mod( 'social_link_1' ) ) .'">
                                                '. wp_kses( get_theme_mod( 'social_link_icon_1' ),$allowed_tags ) .'
                                            </a>
                                         </li>';
                                    }

                                    if ( get_theme_mod( 'social_link_2' ) ) {
                                        echo
                                            '<li>
                                                <div class="ztl-icon"></div>
                                                <a target="_blank" href="'. esc_url( get_theme_mod( 'social_link_2' ) ) .'">
                                                    '. wp_kses( get_theme_mod( 'social_link_icon_2' ),$allowed_tags ) .'
                                                </a>
                                             </li>';
                                    }

                                    if ( get_theme_mod( 'social_link_3' ) ) {
                                        echo
                                            '<li>
                                                <div class="ztl-icon"></div>
                                                <a target="_blank" href="'. esc_url( get_theme_mod( 'social_link_3' ) ) .'">
                                                    '. wp_kses( get_theme_mod( 'social_link_icon_3' ),$allowed_tags ) .'
                                                </a>
                                             </li>';
                                    }

                                    if ( get_theme_mod( 'social_link_4' ) ) {
                                        echo
                                            '<li>
                                                <div class="ztl-icon"></div>
                                                <a target="_blank" href="'. esc_url( get_theme_mod( 'social_link_4' ) ) .'">
                                                    '. wp_kses( get_theme_mod( 'social_link_icon_4' ),$allowed_tags ) .'
                                                </a>
                                             </li>';
                                    }

                                    if ( get_theme_mod( 'social_link_5' ) ) {
                                        echo
                                            '<li>
                                                <div class="ztl-icon"></div>
                                                <a target="_blank" href="'. esc_url( get_theme_mod( 'social_link_5' ) ) .'">
                                                    '. wp_kses( get_theme_mod( 'social_link_icon_5' ),$allowed_tags ) .'
                                                </a>
                                             </li>';
                                    }
                                ?>
							</ul>
						<?php } ?>
					</div>
					<div class="col-sm-12 col-xs-12">
						<?php
							$allowed_tags = array(
								'i' => array(
									'class' => array(),
									'style' => array(),
									),
								'a' => array(
									'style' => array(),
									'href'=> array(),
									),
								'strong' => array(),
							);
						?>
						<div id="ztl-copyright">
						<?php
							// we allow some nice tags for this area
							if ( get_theme_mod( 'copyright_textbox' ) ) {
								echo wp_kses( get_theme_mod( 'copyright_textbox' ),$allowed_tags );							
							} else { 
						?>
							&copy; <?php echo date('Y'); ?>  <a href="<?php echo esc_url( home_url() ); ?>/"><?php esc_html( bloginfo( 'name' ) ); ?></a>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( 'yes' == get_theme_mod( 'scroll_to_top' ) ) :  ?>
	<a href="#" class="ztl-scroll-top"><i class="fa fa-angle-up"></i></a>
<?php endif; ?>
<!-- #search-modal -->
<div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="search-modal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="base-flaticon-close"></span>
                </button>
            </div>
			<div class="modal-body">
				<div class="search-title"><?php esc_html_e('Looking for Something?','autoresq'); ?></div>
				<form role="search" autocomplete="off" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<div class="search-wrapper">
						<input type="text" placeholder="<?php esc_attr_e('Type here ...', 'autoresq'); ?>" class="search-input" autocomplete="off" value="" name="s" id="s">
						<span class="ztl-search-button ztl-button-one">
							<button type="submit" class="search-submit"><?php esc_html_e('Search', 'autoresq'); ?></button>
						</span>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
