<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'sections/content'); ?>

	<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part( 'sections/content', 'none' ); ?>

<?php endif;