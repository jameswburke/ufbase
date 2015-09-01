<article class="row margin-top-sm post">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="col-sm-6">
					<a href="<?php the_permalink(); ?>"><?php custom_featured_image('big-thumb', array('class' => 'img-responsive margin-bottom-sm')); ?></a>
				</div>
				<div class="col-sm-6">
					<h3 class="margin-top-none"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p class="post-meta">
						<small><i class="fa fa-user fa-fw"></i> Written by <?php the_author_posts_link(); ?> on <?php echo get_the_date(); ?></small>
					</p>
				</div>		
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><hr></div>
		</div>
	</div>
</article>