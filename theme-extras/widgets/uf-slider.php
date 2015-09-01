<?php
/*
	Custom slider built around WordPress and Bootstrap for the UF based themes
*/

// Add shortcode
function uf_slider_shortcode( $atts ){
	$a = shortcode_atts( array(
		'slider' => 'uf-slider'
	), $atts );
	return uf_slider_output($a['slider']);
}
add_shortcode( 'ufslider', 'uf_slider_shortcode' );


//Access options page metadata for sliders (NOT USING ACF FRONT END)
$sizes = get_option( 'options_image_sizes' );
if($sizes){
	for( $i = 0; $i < $sizes; $i++){
		//Slider size
		$slug = get_option('options_image_sizes_'.$i.'_slug');
		$width = get_option('options_image_sizes_'.$i.'_width');
		$height = get_option('options_image_sizes_'.$i.'_height');
		$crop_or_scale = get_option('options_image_sizes_'.$i.'_crop_or_scale');
		add_image_size($slug, $width, $height, (bool)$crop_or_scale);
	}
}

//Add options page to edit it
if( function_exists('acf_add_options_sub_page') ) {	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Sliders',
		'menu_title'	=> 'Theme Sliders',
		'menu_slug' 	=> 'uf-theme-sliders',
		'parent'        => 'uf-base-theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}






function uf_slider_output($sliderSlug = 'default'){
	$output = '';

	if( have_rows('sliders', 'options') ):
		while( have_rows('sliders', 'options') ): the_row();

			$currentSlider = get_sub_field('slider_slug', 'options');

			if(get_sub_field('slider_slug', 'options') == $sliderSlug):

				while( have_rows('slides', 'options') ): the_row();
					// echo get_sub_field('caption', 'options');

				endwhile;

				$activeClass = 'active';
				$sliderCount = 0;
				$output .= '<div id="uf-slider-'.$sliderSlug.'" class="carousel slide round" data-ride="carousel">';
					$output .= '<ol class="carousel-indicators">';
					while( have_rows('slides', 'options') ): the_row();
						// echo get_sub_field('caption', 'options');
						$output .= '<li data-target="#uf-slider-'.$sliderSlug.'" data-slide-to="'.$sliderCount.'" class="'.$activeClass.'"></li>';
						$activeClass = '';
						$sliderCount++;
					endwhile;
					$output .= '</ol>';


					$activeClass = 'active';
					$output .= '<div class="carousel-inner round" role="listbox">';
					while( have_rows('slides', 'options') ): the_row();
						$output .= '<div class="item round '.$activeClass.'">';
							$output .= '<img src="'.acf_image_slider(get_sub_field('image', 'options'), $sliderSlug).'" class="round">';
							// $output .= print_r(get_sub_field('image', 'options'));
							$output .= '<div class="carousel-caption">';
								$output .= get_sub_field('caption', 'options');
							$output .= '</div>';
						$output .= '</div>';
						$activeClass = '';
					endwhile;
					$output .= '</div>';


					$output .= '<!-- Controls -->';
					$output .= '<a class="left carousel-control" href="#uf-slider-'.$sliderSlug.'" role="button" data-slide="prev">';
					$output .= '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
					$output .= '<span class="sr-only">Previous</span>';
					$output .= '</a>';

					$output .= '<a class="right carousel-control" href="#uf-slider-'.$sliderSlug.'" role="button" data-slide="next">';
					$output .= '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
					$output .= '<span class="sr-only">Next</span>';
					$output .= '</a>';

				$output .= '</div>';

			endif;
		endwhile;
	endif;

	return $output;
}



function acf_image_slider($image_object, $size){
	return $image_object['sizes'][$size];
}


if( function_exists('register_field_group') ):
register_field_group(array (
	'key' => 'group_5571fa8f05dae',
	'title' => 'UF Sliders',
	'fields' => array (
		array (
			'key' => 'field_5571fc0a3252c',
			'label' => 'Image Sizes',
			'name' => 'image_sizes',
			'prefix' => '',
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
					'key' => 'field_5571fc173252d',
					'label' => 'Slug',
					'name' => 'slug',
					'prefix' => '',
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
					'key' => 'field_5571fc1d3252e',
					'label' => 'Width',
					'name' => 'width',
					'prefix' => '',
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
					'min' => '',
					'max' => '',
					'step' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_5571fc243252f',
					'label' => 'Height',
					'name' => 'height',
					'prefix' => '',
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
					'min' => '',
					'max' => '',
					'step' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_557204a2180ef',
					'label' => 'Crop?',
					'name' => 'crop_or_scale',
					'prefix' => '',
					'type' => 'true_false',
					'instructions' => 'False will scale',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 1,
				),
			),
		),
		array (
			'key' => 'field_5571facfc2e48',
			'label' => 'Sliders',
			'name' => 'sliders',
			'prefix' => '',
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
			'layout' => 'block',
			'button_label' => 'Add Row',
			'sub_fields' => array (
				array (
					'key' => 'field_5571fb07c2e49',
					'label' => 'Slider Slug',
					'name' => 'slider_slug',
					'prefix' => '',
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
					'key' => 'field_5571fcba532a9',
					'label' => 'Image Size Slug',
					'name' => 'image_size_slug',
					'prefix' => '',
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
					'key' => 'field_5571fb1dc2e4a',
					'label' => 'Slides',
					'name' => 'slides',
					'prefix' => '',
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
							'key' => 'field_5571fb26c2e4b',
							'label' => 'Caption',
							'name' => 'caption',
							'prefix' => '',
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
							'key' => 'field_5571fb2ec2e4c',
							'label' => 'Image',
							'name' => 'image',
							'prefix' => '',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'library' => 'all',
						),
						array (
							'key' => 'field_5571fb3fc2e4d',
							'label' => 'Link',
							'name' => 'link',
							'prefix' => '',
							'type' => 'url',
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
						),
					),
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'uf-theme-sliders',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
));

endif;

