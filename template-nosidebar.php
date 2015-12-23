<?php
/**
 * Template Name: Page With No Sidebar
 */
?>

<?php get_header(); ?>

	<div id="primary" class="content-area col-lg-9 smr-page smr-no-sidebar col-md-8 col-sm-12 col-xs-12">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'sections/content', 'page' ); ?>

			<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; ?>

		</main>
	</div>

<?php get_footer(); ?>