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
	<div class="row">
		<div id="content" class="col-md-8">
			<div>
				<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
				<div class="media">
					<a class="pull-left" href="#">
						<img src="<?php echo get_cupp_meta( $curauth->id, 'tiny-thumb'); ?>" alt="" class="media-object img-rounded">
					</a>
					<div class="media-body">
						<h2 class="media-heading"><?php echo $curauth->nickname; ?></h2>
						<p><?php echo get_the_author_meta('description'); ?></p>
					</div>
				</div>
				<hr>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>					
					<?php get_template_part('post', 'generic'); ?>
				<?php endwhile; ?>
			
				<?php get_template_part('paginate', 'post'); ?>
				
				<?php else: ?>
					<p>No posts found</p>
				<?php endif; ?>
				
			</div>
		</div>
		
		<div class="col-md-4">
			<?php dynamic_sidebar('main-sidebar'); ?>
		</div>
	</div>
<?php get_footer(); ?>