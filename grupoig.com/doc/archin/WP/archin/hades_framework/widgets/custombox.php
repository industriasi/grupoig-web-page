<?php 


class CustomBox extends WP_Widget {
	
	function CustomBox() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'CustomBox', 'description' => __('Usage: Megamenu, sidebars and dynamic widgetized areas . Create a custom text box with read more link.','h-framework') );

		/* Widget control settings. */
		$control_ops = array(  );
		 parent::WP_Widget(false,__("CustomBox",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			$instance['link']= $new_instance['link']; 
			$instance['description']= $new_instance['description'];
			$instance['title']= strip_tags($new_instance['title']);
			$instance['intro_image_link']= strip_tags($new_instance['intro_image_link']);
			return $instance;
	}
	function form($instance) {
		 
		$link = esc_attr($instance['link']);
		$description = $instance['description'];
		$title = esc_attr($instance['title']); 
		$intro_image_link = esc_attr($instance['intro_image_link']); 
		
		
		?>
    
       
       	 <p class="hades-custom">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text" />
		</p>
         <p class="hades-custom">
			<label for="<?php echo $this->get_field_id( 'intro_image_link' ); ?>"><?php _e('Intro Image Link:', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'intro_image_link' ); ?>" name="<?php echo $this->get_field_name( 'intro_image_link' ); ?>" value="<?php echo $instance['intro_image_link']; ?>" type="text" />
		</p>

		<!-- Embed Code: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e('Text', 'h-framework') ?></label>
			<textarea  class="widefat" style="height:200px;" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo  $instance['description']; ?></textarea>
		</p>
		
		 <p class="hades-custom">
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Link:', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" type="text" />
		</p>
		
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$link = esc_attr($instance['link']);
		$description = $instance['description'];
		$title = esc_attr($instance['title']); 
		$intro_image_link = esc_attr($instance['intro_image_link']); 
	
		echo $before_widget;
	if($title!="")
		echo " <h3 class='custom-box-title custom-font'> ".$title."</h3>";
		
		if(trim($intro_image_link)=="#")
		$img = '';
		else
		$img = "<img src='{$intro_image_link}' alt='intro-image' />";
		
		echo " <div class='clearfix custom-box-content'> $img  $description </div> <a href='{$link}' class='more'> read more </a> ";
		
		echo  $after_widget;
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("CustomBox");'));
?>