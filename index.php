<?php get_header(); ?>
<div id="content-container" class="container">
	<div class="row">
		<div id="content" class="col-md-9">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article>
					<div class="row">
						<div class="col-md-12">
							<h2><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
							<p class="post-meta">
								<small><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></small>
								<small><i class="fa fa-comment"></i> <?php comments_number('No Comments', '1 Comment', '% Comments' ); ?></small>
								<small><i class="fa fa-user"></i> <?php the_author(); ?></small>
							</p>
						</div>
					</div><!-- Title -->

					<div class="row">
						<div class="col-md-12">
							<?php echo the_excerpt(); ?>
						</div>
					</div>

				</article><!-- Article -->
				<?php get_template_part('paginate', 'post' ); ?>
			<?php endwhile; else: ?>
				<div class="row">
					<div class="col-md-12">
						<p>No Posts Found</p>
					</div>
				</div>
			<?php endif; ?>
		</div>
		
		<div class="col-md-3" id="page-sidebar">
			<?php dynamic_sidebar('blog-sidebar'); ?>
		</div>
	</div>	
</div>
<?php get_footer(); ?>