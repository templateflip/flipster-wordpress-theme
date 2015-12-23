<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php esc_url(get_bloginfo( 'pingback_url' )); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<header id="masthead" class="container site-header" role="banner">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			
			<div class="site-branding">
				
				<?php $branding = shamrock_get_option( 'logo' ) ? '<img src="'.esc_url( shamrock_get_option( 'logo' ) ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ) . '"/>' : get_bloginfo( 'name' ); ?>
				
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $branding; ?></a></h1>
				<?php else: ?>
					<span class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $branding; ?></a></span>
				<?php endif; ?>

				<?php if ( shamrock_get_option( 'site_description' ) ) : ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				<?php endif; ?>
			</div>

		<div class="site-navigation-wrapper">

			<?php if ( shamrock_get_option( 'nav_social' ) ) : ?>
				<div id="smr-nav-social-wrap" class="smr-nav-social-wrap">
					<?php if ( has_nav_menu( 'shamrock_social_menu' ) ) : ?>
						<?php wp_nav_menu( array( 'theme_location' => 'shamrock_social_menu', 'menu_id' => 'smr-nav-social', 'menu_class' => 'smr-nav-social', 'container' => false, 'link_before' => '<span class="smr-social-name">', 'link_after' => '</span>' ) ); ?>
					<?php else: ?>
						<ul id="smr-nav-social" class="smr-nav-social">
							<li><a href="#" target="_blank" class="smr-facebook"><span class="smr-social-name">Facebook</span></a></li>
							<li><a href="#" target="_blank" class="smr-twitter"><span class="smr-social-name">Twitter</span></a></li>
							<li><a href="#" target="_blank" class="smr-gplus"><span class="smr-social-name">Google Plus</span></a></li>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( shamrock_get_option( 'nav_search' ) ) : ?>
				<div id="smr-nav-search" class="smr-nav-search">
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>

			<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'shamrock_main_nav', 'menu_id' => 'smr-main-nav', 'menu_class' => 'smr-main-nav', 'container' => false ) ); ?>
			</nav>

		</div>
		<span class="smr-hamburger"><i class="fa fa-bars"></i></span>
		<div class="smr-resp-separator"></div>
		</div>
	</header>

	<div id="content" class="container site-content">
