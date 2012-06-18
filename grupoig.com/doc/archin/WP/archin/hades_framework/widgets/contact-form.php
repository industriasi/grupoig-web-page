<?php 


class ContactForm extends WP_Widget {
	
	function ContactForm() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ContactForm', 'description' => __( 'Create a quick contact form.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( "width"=>200);
		 parent::WP_Widget(false,__( "Create Quick Contact Form" ,'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['title']= strip_tags($new_instance['title']); 
			$instance['email']= strip_tags($new_instance['email']); 
			$instance['messsage']= strip_tags($new_instance['messsage']); 
			
			return $instance;
	}
	function form($instance) {
		 
		$title = esc_attr($instance['title']);
		$email = esc_attr($instance['email']);
	
		 ?>
        
       
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('email'); ?>"> <?php _e('Email','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
		</p>
  
        
     
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$title = esc_attr($instance['title']); 
	$email = $instance['email'];
	
	
	
	
		echo $before_widget; 
		
			if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		
		if(isset($_POST['qsubmit']))
	   {	
	    	
			$to = $_POST["email"];
			$msg = "Message from ".$_POST["qname"]." email ".$_POST["qemail"]." . Message : ".$_POST["qmsg"];
			
			wp_mail($to, 'Message', ''.$msg ); 
	   }
		?>
        <div class="qcontact clearfix">
           
          <?php if(isset($_POST['qsubmit']))  echo ' <p class="highlight">message sent !</p>'; ?>
           
          <form action="<?php echo $this->curPageURL(); ?>" method="post" class="clearfix">
          <div class="loader success-box clearfix">
          <p> Message Sent ! </p>
          </div>
          <span class="ajax-loading-icon"></span>
          
            <ul class="clearfix">
              <li>
              <input type="text" name="qname" id="qname" value="Enter name" />
              <input type="text" name="qemail" id="qemail" value="Enter email" />
              </li>
              <li>
              <textarea name="qmsg" id="qmsg" rows="" cols="">Message</textarea>
              </li>
             </ul> 
              <input type="submit" name="qsubmit" value="Send" id="qsubmit" />
              <input type="hidden" name="email" id="notify_email" value="<?php echo $email; ?>" />
              <input type="hidden" id="ajax_contact_path" value="<?php echo HURL."/helper/contact_request.php"; ?>" />
          </form>
        </div>
        
        <?php
		
		
		echo $after_widget; 
		
		}
	
	function curPageURL() {
		   $pageURL = 'http';
		   if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 	  $pageURL .= "://";
		   if ($_SERVER["SERVER_PORT"] != "80") {
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		   } else {
				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		   }
		   return $pageURL;
	  }


	}

add_action('widgets_init', create_function('', 'return
register_widget("ContactForm");'));
?>