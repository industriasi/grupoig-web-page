<?php 


class TwitterRSSCount extends WP_Widget {
	
	function TwitterRSSCount() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'TwitterRSSCount', 'description' => __('Show total rss subscribers and twitter followers.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200);
		 parent::WP_Widget(false,__("RSS and twitter count",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['twitter_id']= strip_tags($new_instance['twitter_id']); 
			$instance['feedburner_address']= $new_instance['feedburner_address'];
			$instance['title']= strip_tags($new_instance['title']);
			$instance['default_rss_count']= strip_tags($new_instance['default_rss_count']);

			 
			return $instance;
	}
	function form($instance) {
		 
		$twitter = esc_attr($instance['twitter_id']);
		$title = esc_attr($instance['title']);
		$feedburner = $instance['feedburner_address'];
		$default_rss_count = $instance['default_rss_count'];
		
		if ($default_rss_count=="")
		$default_rss_count = "100";
		
		 ?>
        
        
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('twitter_id'); ?>"> <?php _e('Enter Twitter username','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('feedburner_address'); ?>"> <?php _e('Feedburner ID','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('feedburner_address'); ?>" name="<?php echo $this->get_field_name('feedburner_address'); ?>" type="text" value="<?php echo $feedburner; ?>" />
		</p>
        
        <p> 
        <label for="<?php echo $this->get_field_id('default_rss_count'); ?>"> <?php _e('Default RSS Count','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('default_rss_count'); ?>" name="<?php echo $this->get_field_name('default_rss_count'); ?>" type="text" value="<?php echo $default_rss_count; ?>" />
		</p>
        
        
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
		$twitter = esc_attr($instance['twitter_id']);
		$title = esc_attr($instance['title']);
		$feedburner = $instance['feedburner_address'];
		$default_rss_count = $instance['default_rss_count'];
	
		echo $before_widget; 
			if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		?>
		
     
		 <div class="clearfix rss-widget">
        <ul>
            <li class="rss-count"><h5 class="custom-font"><?php
			$rsscount =  $this->getRSSCount($feedburner);
			if($rsscount==0||$rsscount=="")
			$rsscount = $default_rss_count;
			 _e( $rsscount ,'h-framework') ;  ?></h5><span class="custom-font">subscribers</span></li>
            <li class="divider"><h2 class="custom-font"> &amp; </h2></li>
            <li class="twitter-count"><h5 class="custom-font"><?php
			$twitcount = $this->getTwitterCount($twitter);
			if(!is_numeric($twitcount)||$twitcount==0)
			$twitcount = 100;
			 _e( $twitcount ,'h-framework') ;  ?></h5><span class="custom-font">followers</span></li>
        </ul>
      
      </div>
	  
	  
		<?php	echo $after_widget; 
		
		}
		
	function getTwitterCount($uname)
	{
		$twit = @file_get_contents('http://twitter.com/users/show/'.$uname.'.xml');
		$begin = '<followers_count>'; $end = '</followers_count>';
		$page = $twit;
		$parts = explode($begin,$page);
		$page = $parts[1];
		$parts = explode($end,$page);
		$tcount = $parts[0];
		if($tcount == '') { $tcount = '0'; }
		return $tcount;
	}
	
	
	function getRSSCount($uname)
	{
		// RSS Code
		$theurl = @file_get_contents('https://feedburner.google.com/api/awareness/1.0/GetFeedData?uri='. $uname);
		
		$begin = 'circulation="'; $end = '"';
		$page = $theurl;
		$parts = explode($begin,$page);
		$page = $parts[1];
		$parts = explode($end,$page);
		$fbcount = $parts[0];
		if($fbcount == '0' || $fbcount == '' ) { $fbcount = 0; }
		return $fbcount;
	}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("TwitterRSSCount");'));
?>