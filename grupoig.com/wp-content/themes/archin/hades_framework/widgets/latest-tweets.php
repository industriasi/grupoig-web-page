<?php 


class LatestTweets extends WP_Widget {
	
	function LatestTweets() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'LatestTweets', 'description' => __('Show latest tweets from your account.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200);
		 parent::WP_Widget(false,__("Latest Tweets",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['twitter_id']= strip_tags($new_instance['twitter_id']); 
			$instance['title']= strip_tags($new_instance['title']);
			$instance['count']= $new_instance['count'];

			 
			return $instance;
	}
	function form($instance) {
		 
		$twitter = esc_attr($instance['twitter_id']);
		$title = esc_attr($instance['title']);
		$count = $instance['count'];
		
		 ?>
        
        
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('twitter_id'); ?>"> <?php _e('Enter username','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('count'); ?>"> <?php _e('No of tweets to display','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
		</p>
        
       
        
        
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
		$twitter = esc_attr($instance['twitter_id']);
		$title = esc_attr($instance['title']);
		$count = $instance['count'];
	
		echo $before_widget.'<div id="twitter-wrapper">'; 
			if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		?>
		
        <script type="text/javascript">
       			jQuery(function($) {
					$("#twitter-widget<?php echo $args['widget_id']; ?>").getTwitter({
							userName: "<?php echo $twitter; ?>",
							numTweets: <?php echo $count; ?>,
							loaderText: "Loading tweets...",
							slideIn: true,
							slideDuration: 750,
							showHeading: false,
							headingText: "",
							showProfileLink: true,
							showTimestamp: true
						});
	
					});
        </script>
       <div id="twitter-widget<?php echo $args['widget_id']; ?>" class="clearfix"></div>
       
       </div>
		<?php
			echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("LatestTweets");'));
?>