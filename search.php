
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
			<h1>Search Results</h1>

			<?php while ( have_posts() ) : the_post() ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php endwhile; ?>

			<?php
				if($pagenate){
					echo '<div class="row" id="pagination">';
						echo '<div class="span12 pagination" >';
						echo paginate_links(array(
							'base' => @add_query_arg('paged','%#%'),
							'format' => '?paged=%#%',
							'current' => $current_page,
							'total' => $total_pages,
							'type' => 'list'
						)); 
						echo '</div>';
					echo '</div>';
				}
			?>
			
		</div>
	</div>
</div><!-- Content -->
<?php get_footer(); ?>