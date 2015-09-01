<?php
	/* Template Name: Full Width */
	get_header();
?>
<div id="content-container" class="container">
	<div class="row">
		<div id="content" class="col-md-12">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<?php echo the_content(); ?>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div><!-- Content -->
<?php get_footer(); ?>