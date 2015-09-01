<?php get_header(); ?>
<?php
	global $wp_query;
	$total_pages = $wp_query->max_num_pages;
	if ( $total_pages > 1 ) { 
		$current_page = max(1, get_query_var('paged'));
		$pagenate = true;
	}else{
		$pagenate = false;
	}
?>
<div id="content-container" class="container">
	<div class="row">
		<div id="content" class="col-md-12">
			<h1><?php echo single_cat_title( '', false ); ?></h1>

			<?php while ( have_posts() ) : the_post() ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php endwhile; ?>

			<?php get_template_part('paginate', 'post' ); ?>
			
		</div>
	</div>
</div><!-- Content -->
<?php get_footer(); ?>