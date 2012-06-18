<?php 


class Ads728x90 extends WP_Widget {
	
	function Ads728x90() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Ads728x90', 'description' => __('Create a Leader board with dimensions 728 by 90px.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 300 );
		 parent::WP_Widget(false,"Create Leader Board",$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['image_url']= strip_tags($new_instance['image_url']); 
			$instance['url']= strip_tags($new_instance['url']); 
			return $instance;
	}
	function form($instance) {
		 
		$imgurl = esc_attr($instance['image_url']);
		$url = $instance['url']; ?>
       
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('image_url'); ?>"> <?php _e('Ad Image URL','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo $imgurl; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('url'); ?>"> <?php _e('Ad Link','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
		</p>
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$img = esc_attr($instance['image_url']); 
	$url = $instance['url'];
	
		echo $before_widget; 
		
		if($title!="")
		echo $before_title.$after_title;
		
		echo "<a href='$url' class='ads72890' ><img src='$img' alt='image' /> </a>"; 
			echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("Ads728x90");'));
?>