<?php if ( $pagination = shamrock_pagination( __('Previous', 'shamrock'), __('Next', 'shamrock') ) ) : ?>
	<nav id="smr-pagination" class="smr-pagination">
		<?php echo $pagination; ?>
	</nav>
<?php endif; ?>
