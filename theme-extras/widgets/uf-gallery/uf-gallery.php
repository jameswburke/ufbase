<?php
/*
	Custom gallery built around WordPress and Bootstrap for the UF based themes
*/

// Add shortcode
function uf_gallery_shortcode( $atts ){
	$a = shortcode_atts( array(
		'gallery' => ''
	), $atts );
	return uf_gallery_output($a['gallery']);
}
add_shortcode( 'ufgallery', 'uf_gallery_shortcode' );


//Add options page to edit it
if( function_exists('acf_add_options_sub_page') ) {
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Albums',
		'menu_title'	=> 'Albums',
		'menu_slug' 	=> 'uf-gallery-albums',
		'parent'        => 'edit.php?post_type=uf_gallery',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Gallery Image Sizes',
		'menu_title'	=> 'Image Sizes',
		'menu_slug' 	=> 'uf-gallery-image-sizes',
		'parent'        => 'edit.php?post_type=uf_gallery',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Gallery Settings',
		'menu_title'	=> 'Settings',
		'menu_slug' 	=> 'uf-gallery-settings',
		'parent'        => 'edit.php?post_type=uf_gallery',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


//Enqueue Scripts
function uf_gallery_scripts() {
	//CSS
	wp_enqueue_style('ufgallery-ekko-lightbox-css', get_template_directory_uri().'/theme-extras/widgets/uf-gallery/assets/ekko-lightbox.min.css');

	//Bootstrap
	wp_enqueue_script(
		'ufgallery-ekko-lightbox-js',
		get_template_directory_uri() . '/theme-extras/widgets/uf-gallery/assets/ekko-lightbox.min.js',
		array('jquery'),
		false,
		true
	);
}
add_action('wp_enqueue_scripts', 'uf_gallery_scripts');


//Access options page metadata for sliders (NOT USING ACF FRONT END)
$sizes = get_option( 'uf_gallery_image_sizes' );
if($sizes){
	for( $i = 0; $i < $sizes; $i++){
		//Slider size
		$slug = get_option('uf_gallery_image_sizes_'.$i.'_slug');
		$width = get_option('uf_gallery_image_sizes_'.$i.'_width');
		$height = get_option('uf_gallery_image_sizes_'.$i.'_height');
		$crop_or_scale = get_option('uf_gallery_image_sizes_'.$i.'_crop_or_scale');
		add_image_size($slug, $width, $height, (bool)$crop_or_scale);
	}
}


//Add TinyMCE buttons
add_action( 'init', 'wptuts_buttons' );
function wptuts_buttons() {
    add_filter( "mce_external_plugins", "wptuts_add_buttons" );
    add_filter( 'mce_buttons', 'wptuts_register_buttons' );
}
function wptuts_add_buttons( $plugin_array ) {
    $plugin_array['ufgallery'] = get_template_directory_uri() . '/theme-extras/widgets/uf-gallery/tinymce.js';
    return $plugin_array;
}
function wptuts_register_buttons( $buttons ) {
    array_push( $buttons, 'ufgallery' ); // dropcap', 'recentposts
    return $buttons;
}


function uf_gallery_output($gallerySlug = ''){
	$output = '';

	$galleryPost = get_page_by_path($gallerySlug,OBJECT,'uf_gallery');
	if($galleryPost){
		// echo ;
		$galleryImages = get_post_meta( $galleryPost->ID, 'uf_gallery_images', true );
		$galleryNumberOfColumns = get_post_meta( $galleryPost->ID, 'uf_gallery_number_of_columns', true );
		$galleryFullSize = get_post_meta( $galleryPost->ID, 'uf_gallery_full_size_image_slug', true );
		$galleryThumbnailSize = get_post_meta( $galleryPost->ID, 'uf_gallery_thumbnail_image_slug', true );

		echo print_r($galleryFullSize);
		// echo 'a';
		// echo print_r($galleryImages);
		foreach($galleryImages as $image){
			// echo wp_get_attachment_image( $image );

		}
	}else{
		$output .= 'No gallery found';
	}


	// $output .= 'function uf_gallery_output - uf-gallery.php line 94';
	return $output;
}

// function uf_slider_output($sliderSlug = 'default'){
// 	$output = '';

// 	if( have_rows('sliders', 'options') ):
// 		while( have_rows('sliders', 'options') ): the_row();

// 			$currentSlider = get_sub_field('slider_slug', 'options');

// 			if(get_sub_field('slider_slug', 'options') == $sliderSlug):

// 				while( have_rows('slides', 'options') ): the_row();
// 					// echo get_sub_field('caption', 'options');

// 				endwhile;

// 				$activeClass = 'active';
// 				$sliderCount = 0;
// 				$output .= '<div id="uf-slider-'.$sliderSlug.'" class="carousel slide round" data-ride="carousel">';
// 					$output .= '<ol class="carousel-indicators">';
// 					while( have_rows('slides', 'options') ): the_row();
// 						// echo get_sub_field('caption', 'options');
// 						$output .= '<li data-target="#uf-slider-'.$sliderSlug.'" data-slide-to="'.$sliderCount.'" class="'.$activeClass.'"></li>';
// 						$activeClass = '';
// 						$sliderCount++;
// 					endwhile;
// 					$output .= '</ol>';


// 					$activeClass = 'active';
// 					$output .= '<div class="carousel-inner round" role="listbox">';
// 					while( have_rows('slides', 'options') ): the_row();
// 						$output .= '<div class="item round '.$activeClass.'">';
// 							$output .= '<img src="'.acf_image_slider(get_sub_field('image', 'options'), $sliderSlug).'" class="round">';
// 							// $output .= print_r(get_sub_field('image', 'options'));
// 							$output .= '<div class="carousel-caption">';
// 								$output .= get_sub_field('caption', 'options');
// 							$output .= '</div>';
// 						$output .= '</div>';
// 						$activeClass = '';
// 					endwhile;
// 					$output .= '</div>';


// 					$output .= '<!-- Controls -->';
// 					$output .= '<a class="left carousel-control" href="#uf-slider-'.$sliderSlug.'" role="button" data-slide="prev">';
// 					$output .= '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
// 					$output .= '<span class="sr-only">Previous</span>';
// 					$output .= '</a>';

// 					$output .= '<a class="right carousel-control" href="#uf-slider-'.$sliderSlug.'" role="button" data-slide="next">';
// 					$output .= '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
// 					$output .= '<span class="sr-only">Next</span>';
// 					$output .= '</a>';

// 				$output .= '</div>';

// 			endif;
// 		endwhile;
// 	endif;

// 	return $output;
// }




if ( ! function_exists('uf_gallery') ) {
	// Register Custom Post Type
	function uf_gallery() {
		$labels = array(
			'name'                => _x( 'Galleries', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Gallery', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Galleries', 'text_domain' ),
			'name_admin_bar'      => __( 'Galleries', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Gallery:', 'text_domain' ),
			'all_items'           => __( 'All Galleries', 'text_domain' ),
			'add_new_item'        => __( 'Add New Gallery', 'text_domain' ),
			'add_new'             => __( 'Add New', 'text_domain' ),
			'new_item'            => __( 'New Gallery', 'text_domain' ),
			'edit_item'           => __( 'Edit Gallery', 'text_domain' ),
			'update_item'         => __( 'Update Gallery', 'text_domain' ),
			'view_item'           => __( 'View Gallery', 'text_domain' ),
			'search_items'        => __( 'Search Gallery', 'text_domain' ),
			'not_found'           => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
		);
		$rewrite = array(
			'slug'                => 'gallery',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'Gallery', 'text_domain' ),
			'description'         => __( 'Simple Gallery Ad', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'author', 'thumbnail', 'revisions', ),
			'taxonomies'          => array( 'uf_galley_category' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 25,
			'menu_icon'           => 'dashicons-images-alt2',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,		
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);
		register_post_type( 'uf_gallery', $args );

	}
	add_action( 'init', 'uf_gallery', 0 );
}

if ( ! function_exists( 'uf_galley_category' ) ) {
	// Register Custom Taxonomy
	function uf_galley_category() {
		$labels = array(
			'name'                       => _x( 'Gallery Gategories', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Gallery Category', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Categories', 'text_domain' ),
			'all_items'                  => __( 'All Categories', 'text_domain' ),
			'parent_item'                => __( 'Parent Category', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
			'new_item_name'              => __( 'New Category Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Category', 'text_domain' ),
			'edit_item'                  => __( 'Edit Category', 'text_domain' ),
			'update_item'                => __( 'Update Category', 'text_domain' ),
			'view_item'                  => __( 'View Category', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Categories', 'text_domain' ),
			'search_items'               => __( 'Search Categories', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
		);
		$rewrite = array(
			'slug'                       => 'category',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'uf_galley_category', array( 'uf_gallery' ), $args );
	}
	add_action( 'init', 'uf_galley_category', 0 );
}



if( function_exists('acf_add_local_field_group') ):
	acf_add_local_field_group(array (
		'key' => 'group_55d3ab4298e94',
		'title' => 'UF Gallery Image Sizes',
		'fields' => array (
			array (
				'key' => 'field_55d3ab6ba64e9',
				'label' => 'Image Sizes',
				'name' => 'uf_gallery_image_sizes',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'min' => '',
				'max' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'sub_fields' => array (
					array (
						'key' => 'field_55d3ab83a64ea',
						'label' => 'Slug',
						'name' => 'slug',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'field_55d3ab8fa64eb',
						'label' => 'Width',
						'name' => 'width',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 0,
						'max' => '',
						'step' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'field_55d3ab95a64ec',
						'label' => 'Height',
						'name' => 'height',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 0,
						'max' => '',
						'step' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'field_55d3abb4a64ed',
						'label' => 'Crop?',
						'name' => 'crop',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => 'False will scale',
						'default_value' => 1,
					),
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'uf-gallery-image',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
endif;