<?php

	global $wp_query;
	$total_pages = $wp_query->max_num_pages;
	if ( $total_pages > 1 ) { 
		$current_page = max(1, get_query_var('paged'));
		$paginate = true;
	}else{
		$paginate = false;
	}

	if($paginate){
		$pages = paginate_links(array(
			'base' => @add_query_arg('paged','%#%'),
			'format' => '?paged=%#%',
			'current' => $current_page,
			'total' => $total_pages,
			'type' => 'array',
			'prev_text'    => __('«'),
			'next_text'    => __('»')
		)); 
		if( is_array( $pages ) ) {

			$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
			if($current_page > 1){
				$count = 0;
			}else{
				$count = 1;
			}

			echo '<ul class="pagination pagination-lg">';
			foreach ( $pages as $page ) {
				if($count == $current_page){
					echo '<li class="active">'.$page.'</li>';
				}else{
					echo '<li>'.$page.'</li>';
				}
				$count++;
			}
			echo '</ul>';
		}
	}
?>