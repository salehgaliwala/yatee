<?php

class widget_social_list extends WP_Widget { 
	
	// Widget Settings
	function __construct() {
		$widget_ops = array('description' => esc_html__('Only Detail Page: Social List.','bacola-core') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'social_list' );
		 parent::__construct( 'social_list', esc_html__('Bacola Social list','bacola-core'), $widget_ops, $control_ops );
	}


	
	// Widget Output
	function widget($args, $instance) {

		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		
		echo $before_widget;

		if($title) {
			echo $before_title . $title . $after_title;
		}
		?>

		
		<?php $sociallist = get_theme_mod( 'bacola_social_list_widget' ); ?>
		<?php if(!empty($sociallist)){ ?>
			<div class="widget-body">
				<div class="site-social style-1 wide">
					<ul>
						<?php foreach($sociallist as $s){ ?>
							<li><a href="<?php echo esc_url($s['social_url']); ?>" class="<?php echo esc_attr($s['social_icon']); ?>"><i class="klbth-icon-<?php echo esc_attr($s['social_icon']); ?>"></i><span><?php echo esc_html($s['social_icon']); ?></span></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		<?php } ?>
	


		<?php echo $after_widget;

	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:','bacola-core'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
		  <?php esc_html_e('You can customize the social list from Dashboard > Appearance > Customize > Bacola Widgets > Social List','bacola-core'); ?>

		</p>
	<?php
	}
}

// Add Widget
function widget_social_list_init() {
	register_widget('widget_social_list');
}
add_action('widgets_init', 'widget_social_list_init');

?>