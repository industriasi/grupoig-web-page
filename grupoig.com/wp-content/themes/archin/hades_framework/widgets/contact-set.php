<?php 


class ContactSet extends WP_Widget {
	
	function ContactSet() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ContactSet', 'description' => __('Show rss, twitter, fb and mail icons.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200);
		 parent::WP_Widget(false,__("Social Links",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['title']= strip_tags($new_instance['title']); 
			
			$instance['twitter']= strip_tags($new_instance['twitter']); 
			$instance['facebook']= strip_tags($new_instance['facebook']); 
			$instance['mail']= strip_tags($new_instance['mail']); 
			
			return $instance;
	}
	function form($instance) {
		 
		
		$title = $instance['title'];
		$twitter = esc_attr($instance['twitter']);
		$facebook = esc_attr($instance['facebook']);
		$mail = esc_attr($instance['mail']);
		
		if($mail==""&&get_option("ami_feedburner_email"))
		$mail = get_option("ami_feedburner_email");
		
		if($twitter==""&&get_option("ami_twitter_id"))
		$twitter = "www.twitter.com/".get_option("ami_twitter_id");
		
		if($facebook==""&&get_option("ami_fb_id"))
		$facebook = get_option("ami_fb_id");
		 ?>
        
        <p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        
	       
        <p> 
        <label for="<?php echo $this->get_field_id('twitter'); ?>"> <?php _e('Twitter Profile Link','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
		</p>
        
        <p> 
        <label for="<?php echo $this->get_field_id('facebook'); ?>"> <?php _e('Facebook profile link','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
		</p>
        
        <p> 
        <label for="<?php echo $this->get_field_id('mail'); ?>"> <?php _e('Mail Link','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('mail'); ?>" name="<?php echo $this->get_field_name('mail'); ?>" type="text" value="<?php echo $mail; ?>" />
		</p>
		
           
       
        
        
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
		$title = $instance['title'];
		$twitter = esc_attr($instance['twitter']);
		$facebook = esc_attr($instance['facebook']);
		$mail = esc_attr($instance['mail']);
	
		echo $before_widget;
		
		if($title!="")
		echo $before_title." ".$title .$after_title;
		
		?>
 
<div class="clearfix social-widget">
          <ul>
          
            <li><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/sprites/j/rss.png" alt="" /></a></li>
            <li><a href="<?php echo $twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/sprites/j/twitter.png" alt="" /></a></li>
            <li><a href="<?php echo $facebook; ?>"><img src="<?php echo get_template_directory_uri(); ?>/sprites/j/facebook.png" alt="" /></a></li>
            <li><a href="<?php echo $mail; ?>"><img src="<?php echo get_template_directory_uri(); ?>/sprites/j/mail.png" alt="" /></a></li>
          </ul>
 </div>
					
					
		<?php
			echo $after_widget; 
		
		}
		
	
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("ContactSet");'));
?>