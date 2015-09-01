<div class="row" id="comment-form">
	<div class="col-md-12">
		<h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>

		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>

		<?php else: ?>

			<form class="form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" >
				<fieldset>
					<?php if(is_user_logged_in()): $current_user = wp_get_current_user(); ?>
						<p class='sub-text'>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $current_user->display_name; ?></a></p>

					<?php else: ?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="author">Name (required)</label> 
									<input id="author" name="author" type="text" placeholder="Name" class="form-control" required="" value="<?php if(isset($comment_author)){ echo esc_attr($comment_author); } ?>" >
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="email">Email Address (required)</label>
									<input id="email" name="email" type="text" placeholder="Email Address" class="form-control input-md" required="" value="<?php if(isset($comment_author_email)){ echo esc_attr($comment_author_email); } ?>" >
								</div>
							</div>
						</div>

					<?php endif; ?>

					<!-- Textarea -->
					<div class="form-group">
						<label for="comment">Comment (Required)</label>
						<textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
					</div>

					<!-- Button -->
					<div class="form-group">
							<input name="submit" type="submit" id="submit" value="Submit Comment" class="btn btn-success"/>
					</div>

					<?php comment_id_fields(); ?>
					<?php do_action('comment_form', $post->ID); ?>

				</fieldset>
			</form>

		<?php endif; ?>
	</div>
</div><!-- ./row -->