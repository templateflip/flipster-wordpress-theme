</div>
</div>
	
<footer id="footer" class="site-footer" role="contentinfo">
	<div class="container">
		<div class="col-lg-12">
			<div class="site-info">
				<?php printf( esc_html__( 'Copyright &copy; %s. Created by %s. Powered by %s.', 'shamrock' ), date('Y', time()),  '<a href="http://mekshq.com" target="_blank">Meks</a>' , '<a href="http://wordpress.org" target="_blank">WordPress</a>' ); ?>
			</div>

			<?php if ( has_nav_menu( 'shamrock_footer_menu' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'shamrock_footer_menu', 'menu_id' => 'smr-nav-footer', 'menu_class' => 'smr-nav-footer', 'container' => false ) ); ?>
			<?php endif; ?>
		</div>
	</div>
</footer>

<div class="mobile-nav">
    <?php wp_nav_menu(array('theme_location' => 'shamrock_main_nav', 'menu_class' => 'smr-res-nav', 'container' => false )); ?>
	
	<?php if ( shamrock_get_option( 'nav_social' ) ) : ?>
		<div id="smr-res-social-wrap" class="smr-res-social-wrap">
			<?php if ( has_nav_menu( 'shamrock_social_menu' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'shamrock_social_menu', 'menu_id' => 'smr-res-social', 'menu_class' => 'smr-nav-social', 'container' => false, 'link_before' => '<span class="smr-social-name">', 'link_after' => '</span>' ) ); ?>
			<?php else: ?>
				<ul id="smr-res-social" class="smr-nav-social">
					<li><a href="#" target="_blank" class="smr-facebook"><span class="smr-social-name">Facebook</span></a></li>
					<li><a href="#" target="_blank" class="smr-twitter"><span class="smr-social-name">Twitter</span></a></li>
					<li><a href="#" target="_blank" class="smr-gplus"><span class="smr-social-name">Google Plus</span></a></li>
				</ul>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( shamrock_get_option( 'nav_search' ) ) : ?>
		<div id="smr-res-search" class="smr-res-search">
			<?php get_search_form(); ?>
		</div>
	<?php endif; ?>
    <a href="#" class="close-btn"><i class="fa fa-close"></i></a>
</div>

<?php wp_footer(); ?>

</body>
</html>