<?php
	//Pulls our template and prints each comment
	wp_list_comments('callback=custom_theme_comment_callback');
	
	previous_comments_link();
	next_comments_link();
?>