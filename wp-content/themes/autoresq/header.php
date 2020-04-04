<?php
/**
 * The header for Autoresq theme.
 * Displays all of the <head> section and everything up till <div id="content"> *
 *
 * @package Autoresq
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="ztl-overlay">
	<div id="ztl-loader"></div>
</div>

<div id="page" class="hfeed site <?php if ( get_theme_mod( 'layout_mode' ) == 'boxed' ) { echo 'wrapper'; } ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'autoresq' ); ?></a>
	<div id="head-frame">
	<header id="masthead" class="site-header">
		<div class="header-one" style="background-color: <?php echo esc_attr( get_theme_mod( 'header_background_color', '#072f4f' ) ).';'; ?>">
			<div class="container">
				<div class="header-one-left">
					<div id="logo-first" style="width:<?php echo esc_attr( get_theme_mod( 'logo_width', '160' ) ); ?>px;">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img class="logo-img" src="<?php echo esc_url( get_theme_mod( 'logo_first', get_template_directory_uri() . '/images/autoresq_logo_light.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" />
						</a>
					</div>
				</div>
				<div class="header-one-right sidebar-ztl">
					<?php if (is_active_sidebar('sidebar-header')) : ?>
						<div class="wrapper sidebar-header">
							<?php dynamic_sidebar('sidebar-header'); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="container">
			<div id="logo-second" style="width:<?php echo esc_attr( get_theme_mod( 'logo_width', '160' ) ); ?>px;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="logo-img" src="<?php echo esc_url( get_theme_mod( 'logo_second', get_template_directory_uri() . '/images/autoresq_logo_dark.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" />
				</a>
			</div>
			<div id="menu-toggle">
				<!-- navigation hamburger -->
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div id="nav-wrapper">
				<nav id="site-navigation" class="main-navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav><!-- #site-navigation -->
				<div class="clear"></div>
			</div>
			<div class="ztl-tools-wrapper">
                <?php if (get_theme_mod('show_search_icon', 'yes') != 'no') { ?>
                    <div id="ztl-search-box" class="item">
                        <span class="base-flaticon-search" data-toggle="modal" data-target="#search-modal"></span>
                    </div>
                <?php } ?>
                <?php if (get_theme_mod('show_cart_icon', 'yes') != 'no' && class_exists('WooCommerce'))  { ?>
                    <div id="ztl-shopping-bag" class="item">
                        <div>
                            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php echo esc_attr('View your shopping cart', 'autoresq'); ?>">
                                <span class="base-flaticon-bag"></span>
                                <span class="qty">
                                    <span class="ztl-cart-quantity"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
                                </span>
                            </a>
                        </div>
                    </div>
                <?php } ?>
			</div>
			
		</div>
	</header><!-- #masthead -->
	</div>
	<div id="content" class="site-content <?php if ( get_post_meta( get_the_ID(), 'autoresq_header_option', true ) == 'hidden' ) { echo 'ztl-no-margins'; } ?>">
