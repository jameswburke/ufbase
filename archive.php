<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div id="content" class="col-md-8">
			<?php
				if (have_posts()):
					if(is_day()){				echo '<h1 class="margin-top-none margin-bottom">Daily Archives: '.get_the_date().'</h1>';
					}elseif(is_month()){		echo '<h1 class="margin-top-none margin-bottom">Monthly Archives: '.get_the_date('F Y').'</h1>';
					}elseif(is_year()){			echo '<h1 class="margin-top-none margin-bottom">Yearly Archives: '.get_the_date('Y').'</h1>';
					}elseif(is_tag()){			echo '<h1 class="margin-top-none margin-bottom">Tag Archives: '.single_tag_title( '', false ).'</h1>';
					} elseif(is_category()){	echo '<h1 class="margin-top-none margin-bottom">Category Archives: '.single_cat_title( '', false ).'</h1>';
					} else {					echo '<h1 class="margin-top-none margin-bottom">Blog Archives</h1>';
					}
					while (have_posts()): the_post();
						get_template_part('post', 'generic' );
					endwhile;
					get_template_part('paginate');
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