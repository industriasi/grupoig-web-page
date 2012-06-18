<?php 


class Ads46860 extends WP_Widget {
	
	function Ads46860() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Ads46860', 'description' => __('Create a Full banner slot with dimension 468 by 60px.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 300 );
		 $this->WP_Widget(false,__("Create Ad 468x60",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			
			$instance['image_url']= strip_tags($new_instance['image_url']); 
			$instance['url']= strip_tags($new_instance['url']); 
			
			return $instance;
	}
	function form($instance) {
		 
		$imgurl = esc_attr($instance['image_url']);
		$url = $instance['url'];
		?>
		 
        
       
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
		
		?> 
		
        <a href='<?php echo $url; ?>' class="ads46860"  ><img src='<?php echo $img; ?>' alt='image' /> </a> 
		<?php
		
		echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("Ads46860");'));
?>