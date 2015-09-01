<div class="row comment margin-bottom" id="comment-<?php comment_ID(); ?>">
	<div class="col-md-2">
		<?php echo get_avatar($comment, 100, '', '', array('class' => 'img-responsive')); ?>
	</div>
	<div class="col-md-10">
		<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('Your comment is awaiting moderation.') ?></em><br />
		<?php endif; ?>
		<h5 class="margin-top-none"><strong>Posted by <?php echo get_comment_author(); ?> on <?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?> </strong></h5>
		<?php comment_text() ?>
	</div>
</div>