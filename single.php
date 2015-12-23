<?php get_header(); ?>
	<?php $wrap_col = shamrock_has_sidebar() ? 9 : '12 smr-no-sid'; ?>
	<div id="primary" class="content-area col-lg-<?php echo $wrap_col; ?> col-md-8 col-sm-12 col-xs-12">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'sections/content-single' ); ?>

			<?php if ( shamrock_get_option( 'single_show_tags' ) && has_tag() ) : ?>
				<footer class="entry-footer">
					<div class="meta-tags">
						<?php the_tags( false, ' ', false ); ?>
					</div>
				</footer>
			<?php endif; ?>

			<?php if ( shamrock_get_option( 'single_show_prev_next' ) ) : ?>
				<?php get_template_part( 'sections/prev-next' ); ?>
			<?php endif; ?>

			<?php if ( shamrock_get_option( 'single_show_author' ) ) : ?>
				<?php get_template_part( 'sections/author-box' ); ?>
			<?php endif; ?>

			<?php if ( comments_open() || get_comments_number() ) : ?>
					<?php comments_template(); ?>
			<?php endif; ?>

		<?php endwhile; ?>

		</main>
	</div>

<?php if ( shamrock_has_sidebar() ): ?>
	<?php get_sidebar( 'single' ); ?>
<?php endif; ?>

<?php get_footer(); ?>