<?php 


class Video extends WP_Widget {
	
	function Video() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Video', 'description' => __('Create a video widget.','h-framework') );

		/* Widget control settings. */
		$control_ops = array(  );
		 parent::WP_Widget(false,__("Video",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			$instance['video_code']= $new_instance['video_code']; 
			$instance['description']= strip_tags($new_instance['description']);
			$instance['title']= strip_tags($new_instance['title']);
			return $instance;
	}
	function form($instance) {
		 
		$code = esc_attr($instance['video_code']);
		$description = esc_attr($instance['description']);
		$title = esc_attr($instance['title']); 
		
		
		?>
    
       
       	 <p class="hades-custom">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Embed Code: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'video_code' ); ?>"><?php _e('Video Code (280px max) ', 'h-framework') ?></label>
			<textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id( 'video_code' ); ?>" name="<?php echo $this->get_field_name( 'video_code' ); ?>"><?php echo  $instance['video_code']; ?></textarea>
		</p>
		
		<!-- Description: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e('Short Description:', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" value="<?php echo stripslashes( $instance['description'] ); ?>" />
		</p>
		
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$code = $instance['video_code'];
	$description = esc_attr($instance['description']);
	$title = esc_attr($instance['title']);
	
		echo $before_widget;
	if($title!="")
		echo $before_title." ".$title .$after_title;
		
		echo "<div class='video-widget'> $code  <p> $description </p> </div>";
		
		echo  $after_widget;
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("Video");'));
?>