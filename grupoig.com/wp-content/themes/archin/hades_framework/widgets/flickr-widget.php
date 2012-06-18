<?php 


class Flickr extends WP_Widget {
	
	function Flickr() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Flickr', 'description' => __('Display pictures from flickr feed.','h-framework') );

		/* Widget control settings. */
		$control_ops = array(  );
		 parent::WP_Widget(false,__("Flickr Widget",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['profile_id']= strip_tags($new_instance['profile_id']); 
			$instance['photo_nos']= strip_tags($new_instance['photo_nos']); 
			$instance['title']= strip_tags($new_instance['title']); 
			return $instance;
	}
	function form($instance) {
		 
		$id = esc_attr($instance['profile_id']);
		$nos = esc_attr($instance['photo_nos']);
		$title = esc_attr($instance['title']);
		 ?>
       
       <p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('profile_id'); ?>"> <?php _e('Flickr Profile ID','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('profile_id'); ?>" name="<?php echo $this->get_field_name('profile_id'); ?>" type="text" value="<?php echo $id; ?>" />
		</p>
        <p> 
        <label for="<?php echo $this->get_field_id('photo_nos'); ?>"> <?php _e('No of Photos to display','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('photo_nos'); ?>" name="<?php echo $this->get_field_name('photo_nos'); ?>" type="text" value="<?php echo $nos; ?>" />
		</p>
		
       <?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$id = esc_attr($instance['profile_id']); 
	$nos = esc_attr($instance['photo_nos']); 
	
	
		
		
		 $title = $instance['title'];
		
		echo $before_widget; 
		
			if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
	
	 ?>
        <input type="hidden" value="<?php echo $id; ?>" id="flickr-id" />
        <input type="hidden" value="<?php echo $nos; ?>" id="flickr-nos" />
		<div id="flickr-images"></div>
		<?php
	
		 	echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("Flickr");'));
?>