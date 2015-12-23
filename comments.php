<?php

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php comments_number( __('Add Comment', 'shamrock'), __('1 Comment', 'shamrock'), __('% Comments', 'shamrock')); ?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<div class="nav-links">
				<?php paginate_comments_links(); ?> 
			</div>
		</nav>
		<?php endif; ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 60,
					'short_ping'  => true
				) );
			?>
		</ul>

		

	<?php endif; ?>

	<?php if(comments_open()) : ?>
	  <?php comment_form(); ?>
	<?php endif; ?>

</div>