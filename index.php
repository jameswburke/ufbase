<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div id="content" class="col-md-8">
			<?php
				if (have_posts()):
					while (have_posts()): the_post();
						get_template_part('post', 'generic' );
					endwhile;
					get_template_part('paginate' );
				else:
					echo 'No Posts Found';
				endif;
			?>
		</div>
		
		<div class="col-md-4">
			<?php dynamic_sidebar('main-sidebar'); ?>
		</div>
	</div>	
</div>
<?php get_footer(); ?>