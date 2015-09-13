<?php
	
	//Default Settings for UF Widgets and Plugins
	if(!isset($ufSettings)){
		$ufSettings = array(
			'social-media' => true,
			'slider' => true,
			'gallery' => true,
			'sidebars' => array(
				'main' => true,
				'footer' => true,
				'social-media' => true
			)
		);
	}
	//If individual settings are missing
	if(!isset($ufSettings['social-media'])){ $ufSettings['social-media'] = true; }
	if(!isset($ufSettings['slider'])){ $ufSettings['slider'] = true; }
	if(!isset($ufSettings['gallery'])){ $ufSettings['gallery'] = true; }
	if(!isset($ufSettings['sidebars'])){ $ufSettings['sidebars'] = array(); }
	if(!isset($ufSettings['sidebars']['main'])){ $ufSettings['sidebars']['main'] = true; }
	if(!isset($ufSettings['sidebars']['footer'])){ $ufSettings['sidebars']['footer'] = true; }
	if(!isset($ufSettings['sidebars']['social-media'])){ $ufSettings['sidebars']['social-media'] = true; }

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

	//Main Widgets
		if($ufSettings['sidebars']['main']){
			$main = array(
				'name'=>'Main Sidebar',
				'id'=>'main-sidebar',
				'class' => 'sidebar',
				'before_widget' => '<div class="main-sidebar">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="margin-top-none">',
				'after_title' => '</h4>',
			);
			register_sidebar($main);
		}
	//Footer Widgets
		if($ufSettings['sidebars']['footer']){
			$footer = array(
				'name' => 'Footer',
				'id' => 'footer-sidebar',
				'before_widget' => '<div class="col-sm-3 footer-sidebar">',
				'after_widget' => '</div>',
				'before_title' => '<h4>',
				'after_title' => '</h4>',
			);
			register_sidebar($footer);
		}
	//Social Media Widgets
		if($ufSettings['sidebars']['social-media']){
			$social_footer = array(
				'name' => 'Social Media',
				'id' => 'social-media-sidebar',
				'before_widget' => '<div class="social-media-sidebar">',
				'after_widget' => '</div>',
				'before_title' => '',
				'after_title' => '',
			);
			register_sidebar($social_footer);
		}


	//Theme Support
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );


	//Custom Image Size Support
	//True means it will crop to size, false will scale
		
		//4x3 Ratio
			add_image_size('4x3', 720, 540, true);		// Full Size
			add_image_size('4x3-md', 480, 360, true);	// 2/3rds of Full Size
			add_image_size('4x3-sm', 240, 180, true);	// 1/3rds of Full Size

		//16x9 Ratio
			add_image_size('16x9', 720, 405, true);		// Full Size
			add_image_size('16x9-md', 480, 270, true);	// 2/3rds of Full Size
			add_image_size('16x9-sm', 240, 135, true);	// 1/3rds of Full Size

		//1x1 Ratio
			add_image_size('1x1', 720, 720, true);		// Full Size
			add_image_size('1x1-md', 480, 480, true);	// 2/3rds of Full Size
			add_image_size('1x1-sm', 240, 240, true);	// 1/3rds of Full Size


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
		// wp_enqueue_style('bootstrap', get_template_directory_uri().'/bower_components/bootstrap/dist/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
		// wp_enqueue_style('font-awesome', get_template_directory_uri().'/bower_components/fontawesome/css/font-awesome.min.css');
		wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css');
		wp_enqueue_style('base-theme', get_template_directory_uri().'/style.css');

		//Bootstrap
		wp_enqueue_script(
			'bootstrap',
			'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
			// get_template_directory_uri() . '/bower_components/bootstrap/dist/js/bootstrap.min.js',
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
			$attribute_string = '';
			foreach($attr as $key => $value){
				$attribute_string .= $key.'='.'"'.$value.'"';
			}
			if(file_exists(get_stylesheet_directory_uri().'/assets/img/default_featured/'.$size.'.jpg')){
				echo '<img src="'.get_stylesheet_directory_uri().'/assets/img/default_featured/'.$size.'.jpg" '.$attribute_string.' />';
			}else{
				echo '<img src="'.get_template_directory_uri().'/assets/img/default_featured/'.$size.'.jpg" '.$attribute_string.' />';	
			}
		}
	}

	function custom_acf_image($image_object, $size = null){
		if($size == null){
			return $image_object['url'];
		}else{
			return $image_object['sizes'][$size];
		}
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