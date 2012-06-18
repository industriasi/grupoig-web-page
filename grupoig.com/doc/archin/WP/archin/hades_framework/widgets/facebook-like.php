<?php 


class FBLike extends WP_Widget {
	
	function FBLike() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'FBLike', 'description' => __('Add facebook Like box to your sidebar.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200);
		 parent::WP_Widget(false,__("Facebook Like Box",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['fb_link']= strip_tags($new_instance['fb_link']); 
			$instance['width']= strip_tags($new_instance['width']);
			$instance['title']= strip_tags($new_instance['title']);
			$instance['show_friends']= $new_instance['show_friends'];
			$instance['fb_header']= $new_instance['fb_header'];
			$instance['fb_stream']= $new_instance['fb_stream'];
			
			 
			return $instance;
	}
	function form($instance) {
		 
		$fb = esc_attr($instance['fb_link']);
		$title = esc_attr($instance['title']);
		$width = $instance['width'];
		$friends = $instance['show_friends'];
		$header = $instance['fb_header'];
		$stream = $instance['fb_stream'];
		
		if($fb==""&&get_option("ami_fb_id"))
		$fb = get_option("ami_fb_id");
		
		
		 ?>
        
        
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('fb_link'); ?>"> <?php _e('Add facebook page link','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('fb_link'); ?>" name="<?php echo $this->get_field_name('fb_link'); ?>" type="text" value="<?php echo $fb; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('width'); ?>"> <?php _e('Width','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('show_friends'); ?>"> <?php _e('Show friends','h-framework'); ?> </label>
		<input id="<?php echo $this->get_field_id('show_friends'); ?>" name="<?php echo $this->get_field_name('show_friends'); ?>" type="checkbox" value="true" <?php if($friends) echo "checked='checked'"; ?> />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('fb_header'); ?>"> <?php _e('Show Head','h-framework'); ?> </label>
		<input id="<?php echo $this->get_field_id('fb_header'); ?>" name="<?php echo $this->get_field_name('fb_header'); ?>" type="checkbox" value="true" <?php if($header) echo "checked='checked'"; ?> />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('fb_stream'); ?>"> <?php _e('Show Stream','h-framework'); ?> </label>
		<input id="<?php echo $this->get_field_id('fb_stream'); ?>" name="<?php echo $this->get_field_name('fb_stream'); ?>" type="checkbox" value="true" <?php if($stream) echo "checked='checked'"; ?> />
		</p>
        
        
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
		$fb = esc_attr($instance['fb_link']);
		$title = esc_attr($instance['title']);
		$width = $instance['width'];
		$friends = $instance['show_friends'];
		$header= $instance['fb_header'];
		$stream= $instance['fb_stream'];
	
		echo $before_widget;
			if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		?>
		
        <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
        <fb:like-box href="<?php echo $fb; ?>" width="<?php echo $width; ?>" show_faces="<?php if($friends) echo $friends; else echo 'false'; ?>" stream="<?php if($stream) echo $stream; else echo 'false'; ?>" header="<?php if($header) echo $header; else echo 'false'; ?>"  ></fb:like-box>
        
		<?php
			echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("FBLike");'));
?>