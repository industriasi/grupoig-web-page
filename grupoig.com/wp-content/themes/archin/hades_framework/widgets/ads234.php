<?php 


class Ads234x60 extends WP_Widget {
	
	function Ads234x60() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Ads234x60', 'description' => __('Create a ad slot with dimension 234 by 60px.') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 300 );
		 parent::WP_Widget(false,"Create 2 234x60 half banners ",$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
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
		$url1 = $instance['url1'];
		 ?>
       
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('image_url'); ?>"> <?php _e('Ad Image URL 1','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo $imgurl; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('url'); ?>"> <?php _e('Ad Link 1','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
		</p>
        
        
        <p class="hades-custom"> 
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
	
		echo $before_widget; 
		if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		
		?> 
		
        <ul class="clearfix ads23460">
      		<li> <a href='<?php echo $url; ?>'  ><img src='<?php echo $img; ?>' alt='image' /> </a> </li>
           <li> <a href='<?php echo $url1; ?>'  ><img src='<?php echo $img1; ?>' alt='image' /> </a> </li>
        </ul>
		
		<?php
		
		echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("Ads234x60");'));
?>