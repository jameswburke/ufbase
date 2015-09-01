<?php

	//Advanced Custom Fields
	require_once('theme-extras/advanced-custom-fields-pro/acf.php');	
	add_filter('acf/settings/path', 'my_acf_settings_path');
	function my_acf_settings_path( $path ) {
		$path = get_template_directory() . '/theme-extras/advanced-custom-fields-pro/';
		return $path;		
	}
	add_filter('acf/settings/dir', 'my_acf_settings_dir');
	function my_acf_settings_dir( $dir ) {
		$dir = get_template_directory_uri() . '/theme-extras/advanced-custom-fields-pro/';
		return $dir;		
	}
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> 'Options',
			'menu_title'	=> 'Theme Options',
			'menu_slug' 	=> 'uf-base-theme-options',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));	
	}
	//Include Image Sizes
	require_once('theme-extras/acf-image-sizes/acf-image_sizes.php');

	//Bootstrap Walker
	require_once('theme-extras/bootstrap-walker.php');

	//Include Custom Widgets
	if($ufSettings['social-media']){ require_once('theme-extras/widgets/uf-social-media.php');	}
	if($ufSettings['slider']){ require_once('theme-extras/widgets/uf-slider.php'); }
	if($ufSettings['gallery']){ require_once('theme-extras/widgets/uf-gallery/uf-gallery.php'); }


	//Theme Support
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );


	//Custom Image Size Support
	//True means it will crop to size, false will scale
	add_image_size('big-thumb', 340, 160, true);
	add_image_size('medium-thumb', 245, 100, true);
	add_image_size('square-thumb', 100, 100, true);


	//Menu Support
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
				'primary' => 'Primary Menu',
				'secondary' => 'Second Menu'
			)
		);
	}

	//Enqueue Scripts
	function my_scripts() {
		//CSS
		wp_enqueue_style('bootstrap', get_template_directory_uri().'/bower_components/bootstrap/dist/css/bootstrap.min.css');
		wp_enqueue_style('font-awesome', get_template_directory_uri().'/bower_components/fontawesome/css/font-awesome.min.css');
		wp_enqueue_style('base-theme', get_template_directory_uri().'/style.css');

		//Bootstrap
		wp_enqueue_script(
			'bootstrap',
			get_template_directory_uri() . '/bower_components/bootstrap/dist/js/bootstrap.min.js',
			array('jquery'),
			false,
			true
		);

		//Custom Script
		wp_enqueue_script(
			'script',
			get_template_directory_uri() . '/assets/js/script.js',
			array('jquery'),
			false,
			true
		);
	}
	add_action('wp_enqueue_scripts', 'my_scripts');


	function admin_bar_css(){
		if ( is_admin_bar_showing() ) {
			echo "
			<style>
				header{
					margin-top: 28px;
				}
			</style>";
		}
	}
	add_action('wp_head', 'admin_bar_css');


	//Excerpt Stuff
	function custom_excerpt_length( $length ) {	return 40; }
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	function new_excerpt_more( $more ) { return '...'; }
	add_filter('excerpt_more', 'new_excerpt_more');


	//Will print out the post thumbnail, or a default featured size
	function custom_featured_image($size, $attr = array()){
		if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
			the_post_thumbnail($size, $attr);
		} else {
			echo '<img src="'.get_stylesheet_directory_uri().'/assets/img/default_featured/'.$size.'.jpg" class="img-responsive" />';
		}
	}

	function custom_acf_image($image_object, $size){
		return $image_object['sizes'][$size];
	}

	//Remove WP version
	remove_action('wp_head', 'wp_generator');	

	function custom_login_logo(){
		echo	'<style type="text/css">'.
					'body.login div#login h1 a{'.
						'background-image: url('.get_stylesheet_directory_uri().'/assets/img/admin_logo.jpg);'.
						'padding-bottom: 30px;'.
					'}'.
				'</style>';
	}
	add_action('login_enqueue_scripts', 'custom_login_logo');

	
	function alx_embed_html( $html ) {
		//return $html;
		$html = preg_replace( '/(width|height)="\d*"\s/', "", $html ); // Strip width and height #1
		return '<div class="embed-responsive  embed-responsive-16by9">' . $html . '</div>';
	}

	add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 1);
	add_filter( 'video_embed_html', 'alx_embed_html' );


?>