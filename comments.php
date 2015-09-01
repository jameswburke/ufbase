<?php

//Security Features
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){ die ('Please do not load this page directly. Thanks!'); }
	if ( post_password_required() ) { echo '<p class="nocomments">This post is password protected. Enter the password to view comments.</p>'; return; };


//Loads existing comments
	if ( have_comments() ){
		echo '<div class="comments margin-top well">';
		echo '<h3 class="margin-top-none">Comments</h3>';
		wp_list_comments('callback=ufbase_comment_callback');
		echo '</div>';
		previous_comments_link();
		next_comments_link();
	}

	//Comment formatting callback
	function ufbase_comment_callback($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		get_template_part('comments', 'single' );
	}


//Comment Form
	if (comments_open()){
		get_template_part('comments', 'form');
	}