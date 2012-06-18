<?php 


class Ads125 extends WP_Widget {
	
	function Ads125() {
		/* Widget settings. */
			$widget_ops = array( 'classname' => 'Ads125', 'description' => __('Create a ad slot with dimension 125 by 125px.','h-framework') );
		/* Widget control settings. */
			$control_ops = array( 'width' => 200, 'height' => 300);
		
			$this->WP_Widget(false,__("Create Ad 125x125",'h-framework'),$widget_ops,$control_ops); }
	
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			$instance['title']= strip_tags($new_instance['title']); 
		
			for($i=1;$i<9;$i++) {
			$instance['image_url'.$i]= strip_tags($new_instance['image_url'.$i]); 
			$instance['url'.$i]= strip_tags($new_instance['url'.$i]); 
			}
			
		
			return $instance;
	}
	function form($instance) {
		 
		$imgurl = array($instance['image_url1'],$instance['image_url2'],$instance['image_url3'],$instance['image_url4'],$instance['image_url5'],$instance['image_url6'],$instance['image_url7'],$instance['image_url8']);
		$url = array($instance['url1'],$instance['url2'],$instance['url3'],$instance['url4'],$instance['url5'],$instance['url6'],$instance['url7'],$instance['url8']);
     
		?>
		<p> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
        
		<?php
		for($i=0;$i<8;$i++) {
		?>
        
        
                <p<?php if($i==0) echo ' class="hades-custom"';  ?>> 
                <label for="<?php echo $this->get_field_id('image_url'.($i+1)); ?>"> <?php _e('Ad Image URL '.($i+1),'h-framework'); ?> </label>
                <input class="widefat" id="<?php echo $this->get_field_id('image_url'.($i+1)); ?>" name="<?php echo $this->get_field_name('image_url'.($i+1)); ?>" type="text" value="<?php echo $imgurl[$i]; ?>" />
                </p>
                
                <p> 
                <label for="<?php echo $this->get_field_id('url'.($i+1)); ?>"> <?php _e('Ad Link URL '.($i+1),'h-framework'); ?> </label>
                <input class="widefat" id="<?php echo $this->get_field_id('url'.($i+1)); ?>" name="<?php echo $this->get_field_name('url'.($i+1)); ?>" type="text" value="<?php echo $url[$i]; ?>" />
                </p>
		
       
<?php
		}
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$imgurl = array($instance['image_url1'],$instance['image_url2'],$instance['image_url3'],$instance['image_url4'],$instance['image_url5'],$instance['image_url6'],$instance['image_url7'],$instance['image_url8']);
		$url = array($instance['url1'],$instance['url2'],$instance['url3'],$instance['url4'],$instance['url5'],$instance['url6'],$instance['url7'],$instance['url8']);
	    $title = $instance['title'];
		
		echo $before_widget; 
		
		if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		
		?>
		
        <ul class="ads125">
       		<?php for($i=0;$i<8;$i++) { 
			
			 if( $imgurl[$i]!="" && $url[$i]!="" ) {
				 
			
			?>
            
           
            <li> <a href="<?php echo $url[$i] ?>"><img src="<?php echo $imgurl[$i] ?>" alt="<?php echo $url[$i] ?>" /></a> </li>
           <?php 
		   }
			}
		    ?>
        </ul>
		
		<?php
		 	echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("Ads125");'));
?>