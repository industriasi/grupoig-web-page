<?php 


class GoogleMap extends WP_Widget {
	
	function GoogleMap() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'GoogleMap', 'description' => __( 'Add google map.' ,'h-framework'));

		/* Widget control settings. */
		$control_ops = array( "width"=>200);
		 parent::WP_Widget(false,__( "Google map" ,'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['title']= strip_tags($new_instance['title']); 
			$instance['map_width']= strip_tags($new_instance['map_width']); 
			$instance['map_height']= strip_tags($new_instance['map_height']); 
			$instance['address']= strip_tags($new_instance['address']); 
			
			return $instance;
	}
	function form($instance) {
		 
		$title = esc_attr($instance['title']);
		$width = esc_attr($instance['map_width']);
		$height = esc_attr($instance['map_height']);
		$address = esc_attr($instance['address']);
		
		if($width=="") $width = 300;
		if($height=="") $height = 250;
		
		
		 ?>
        
       
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('map_width'); ?>"> <?php _e('Map Width','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('map_width'); ?>" name="<?php echo $this->get_field_name('map_width'); ?>" type="text" value="<?php echo $width; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('map_height'); ?>"> <?php _e('Map Height','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('map_height'); ?>" name="<?php echo $this->get_field_name('map_height'); ?>" type="text" value="<?php echo $height; ?>" />
		</p>
        
          <p> 
        <label for="<?php echo $this->get_field_id('address'); ?>"> <?php _e('Enter Address','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" />
		</p>
        
     
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$title = esc_attr($instance['title']);
		$width = esc_attr($instance['map_width']);
		$height = esc_attr($instance['map_height']);
		$address = str_replace(" ","+",esc_attr($instance['address']));
	
		echo $before_widget;
		
		if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		
		
		?>
        
        <div class="map_canvas">
        <img src="http://maps.google.com/maps/api/staticmap?center=<?php echo $address ?>&zoom=14&size=<?php echo $width.'x'.$height?>&maptype=roadmap
&markers=color:blue|label:S|40.702147,-74.015794&markers=color:green|label:G|40.711614,-74.012318
&markers=color:red|color:red|label:C|40.718217,-73.998284&sensor=false" />
        </div>
        
        
        
               
        
        
        <?php
		
		
		echo $after_widget; 
		
		}
	
	

	}

add_action('widgets_init', create_function('', 'return
register_widget("GoogleMap");'));
?>