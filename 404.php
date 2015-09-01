<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div id="content" class="col-md-8">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h1 class="margin-top-none">Page Not Found</h1>
				<p>Couldn't locate the page you were looking for.</p>
			<?php endwhile; endif; ?>
		</div>
		
		<div class="col-md-4">
			<?php dynamic_sidebar('main-sidebar'); ?>
		</div>
	</div>	
</div>
<?php get_footer(); ?>