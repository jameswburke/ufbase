<article class="row post">
	<div class="col-md-12">
		<div class="row">
			<div class="col-sm-4">
				<a href="<?php the_permalink(); ?>"><?php custom_featured_image('4x3', array('class' => 'img-responsive margin-bottom')); ?></a>
			</div>
			<div class="col-sm-8">
				<h2 class="margin-top-none"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="post-meta"><small>Written by <?php the_author_posts_link(); ?> on <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></small></p>
				<?php the_excerpt(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><hr></div>
		</div>
	</div>
</article>