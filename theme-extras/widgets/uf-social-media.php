<?php	
	class Social_Media extends WP_Widget {

		public $options = array(
			'Title' => 'title',
			'Class' => 'class',
			'Facebook' => 'facebook',
			'Twitter' => 'twitter',
			'Flickr' => 'flickr',
			'YouTube' => 'youtube',
			'Instagram' => 'instagram',
			'Pinterest' => 'pinterest',
			'LinkedIn' => 'linkedin',
			'Tumblr' => 'tumblr',
			'Vine' => 'vine',
			'Google+' => 'googleplus',
			'Github' => 'github',
			'Rss' => 'rss'
		);

		public function __construct() {
			// parent::WP_Widget(false, 'Social Media');
			parent::__construct(
				'uf_social_media', // Base ID
				__( 'Social Media', 'text_domain' ), // Name
				array(
				) // Args
			);
		}

		function form($instance) {
			foreach ($this->options as $key => $value):
			?>
				<p>
					<label for="<?php echo $this->get_field_id($value); ?>"><?php _e( $key.':' ); ?>
						<input class="widefat" id="<?php echo $this->get_field_id($value); ?>" name="<?php echo $this->get_field_name($value); ?>" type="text" value="<?php echo esc_attr($instance[$value]); ?>" />
					</label>
				</p>
			<?php 
			endforeach;
		}

		function update($new_instance, $old_instance) {
			// processes widget options to be saved
			return $new_instance;
		}

		function widget($args, $instance) {
			extract( $args );
			$title = apply_filters( 'widget_title', $instance['title'] );
			$class = $instance['class'];
			
			echo $before_widget;			
			if ($title) { echo $before_title.$title.$after_title; }
			echo '<ul class="'.$class.'">';

			foreach ($this->options as $key => $value):
				if(($key !== 'Title') && ($key !== 'Class')):
					if($instance[$value]){ echo '<li><a href="'.$instance[$value].'" title="'.$key.'"><i class="fa fa-'.$value.' fa-2x"></i></a></li>'; }
				endif;
			endforeach;

			echo '</ul>';
			echo $after_widget;
			
		}

	}
	register_widget('Social_Media');