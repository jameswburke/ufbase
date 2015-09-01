<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div id="content" class="col-md-8">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h1 class="margin-top-none"><?php echo the_title(); ?></h1>
				<?php echo the_content(); ?>
			<?php endwhile; endif; ?>
		</div>
		
		<div class="col-md-4">
			<?php dynamic_sidebar('main-sidebar'); ?>
		</div>
	</div>	
</div>
<?php get_footer(); ?>