<div id="author-box" class="smr-author-box">

	<h3><?php  _e('About the author', 'shamrock'); ?></h3>

	<?php echo get_avatar( get_the_author_meta('ID'), 60 ); ?>
	
	<h4><?php the_author_meta('display_name'); ?></h4>

	<?php echo wpautop(get_the_author_meta('description')); ?>
<div class="clear"></div>
<a href="<?php echo esc_url( get_author_posts_url(get_the_author_meta('ID'))); ?>" class="smr-author-link smr-author-posts"><?php _e('View all posts', 'shamrock'); ?></a>
<?php if ( $website = get_the_author_meta('url')) : ?> 
	<a href="<?php esc_url( $website ); ?>" target="_blank" class="smr-author-link smr-website"><i class="fa fa fa-link"></i></a>
<?php endif; ?>	
<div class="smr-post-separator"></div>
</div>	