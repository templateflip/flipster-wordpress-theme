<?php
/**
 * Template Name: Full Width Page
 */
?>

<?php get_header(); ?>

	<div id="primary" class="content-area col-lg-12 smr-page smr-full-width col-md-12 col-sm-12 col-xs-12">
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