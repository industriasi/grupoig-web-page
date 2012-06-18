<?php 


class Ads12090 extends WP_Widget {
	
	function Ads12090() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Ads12090', 'description' => 'Create a 2 buttons slot with dimension 120 by 90px.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 300 );
		 $this->WP_Widget(false,__("Create Ads 120x90",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['title']= strip_tags($new_instance['title']); 
			$instance['image_url']= strip_tags($new_instance['image_url']); 
			$instance['url']= strip_tags($new_instance['url']); 
			
			$instance['image_url1']= strip_tags($new_instance['image_url1']); 
			$instance['url1']= strip_tags($new_instance['url1']); 
			return $instance;
	}
	function form($instance) {
		 
		$imgurl = esc_attr($instance['image_url']);
		$url = $instance['url'];
		$imgurl1 = esc_attr($instance['image_url1']);
		$url1 = $instance['url1']; ?>
		 
        
       
       <p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
        
		<p> 
        <label for="<?php echo $this->get_field_id('image_url'); ?>"> <?php _e('Ad Image URL 1','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo $imgurl; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('url'); ?>"> <?php _e('Ad Link 1','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
		</p>
        
        
        
        <p> 
        <label for="<?php echo $this->get_field_id('image_url1'); ?>"> <?php _e('Ad Image URL 2','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('image_url1'); ?>" name="<?php echo $this->get_field_name('image_url1'); ?>" type="text" value="<?php echo $imgurl1; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('url1'); ?>"> <?php _e('Ad Link 2','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('url1'); ?>" name="<?php echo $this->get_field_name('url1'); ?>" type="text" value="<?php echo $url1; ?>" />
		</p>
        
        
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$img = esc_attr($instance['image_url']); 
	$url = $instance['url'];
	
	$img1 = esc_attr($instance['image_url1']); 
	$url1 = $instance['url1'];
	 $title = $instance['title'];
		
		echo $before_widget; 
		
		if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		
		?> 
		
        <ul class="clearfix ads12090">
      		<li> <a href='<?php echo $url; ?>'  ><img src='<?php echo $img; ?>' alt='image' /> </a> </li>
           <li> <a href='<?php echo $url1; ?>'  ><img src='<?php echo $img1; ?>' alt='image' /> </a> </li>
        </ul>
		
		<?php
		
		echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("Ads12090");'));
?>