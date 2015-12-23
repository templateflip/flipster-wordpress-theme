<?php get_header(); ?>

	<?php $wrap_col = shamrock_has_sidebar() ? 9 : '12 smr-no-sid'; ?>
	<div id="primary" class="content-area col-lg-<?php echo $wrap_col; ?> col-md-8 col-sm-12 col-xs-12">
		<?php if ( !is_front_page() ) : ?>
		<?php get_template_part( 'sections/archive-title' ); ?>
		<?php endif; ?>

		<main id="main" class="site-main" role="main">

		<?php get_template_part( 'sections/loop' ); ?>

		</main>

		<?php get_template_part( 'sections/pagination', shamrock_get_option( 'pagination' ) ); ?>


	</div>

<?php if ( shamrock_has_sidebar() ): ?>
	<?php get_sidebar(); ?>
<?php endif; ?>

<?php get_footer(); ?>
