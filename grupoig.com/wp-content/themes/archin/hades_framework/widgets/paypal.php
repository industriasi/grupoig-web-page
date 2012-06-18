<?php 


class PaypalButton extends WP_Widget {
	
	function PaypalButton() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'PaypalButton', 'description' => __('Create a paypal payment button.','h-framework') );

		/* Widget control settings. */
		$control_ops = array(  );
		 parent::WP_Widget(false,__("Paypal Button",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['paypal_id']= strip_tags($new_instance['paypal_id']); 
			$instance['amount']= strip_tags($new_instance['amount']); 
			$instance['button_title']= strip_tags($new_instance['button_title']);
			$instance['title']= strip_tags($new_instance['title']);
			return $instance;
	}
	function form($instance) {
		 
		$paypalemail = esc_attr($instance['paypal_id']);
		$amount = esc_attr($instance['amount']);
		$button_title = esc_attr($instance['button_title']);
		$title = esc_attr($instance['title']); 
		
		if($title=="") $title = "Buy me a coffee";
		if($button_title=="") $button_title = "Donate";
		
		?>
       
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('paypal_id'); ?>"> <?php _e('Enter Paypal ID','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('paypal_id'); ?>" name="<?php echo $this->get_field_name('paypal_id'); ?>" type="text" value="<?php echo $paypalemail; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('amount'); ?>"> <?php _e('Enter Amount($)','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('amount'); ?>" type="text" value="<?php echo $amount; ?>" />
		</p>
        
        <p> 
        <label for="<?php echo $this->get_field_id('button_title'); ?>"> <?php _e('Button Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('button_title'); ?>" name="<?php echo $this->get_field_name('button_title'); ?>" type="text" value="<?php echo $button_title; ?>" />
		</p>
        
        <p> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php  echo $title; ?>" />
		</p>
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$paypalemail = esc_attr($instance['paypal_id']);
	$amount = esc_attr($instance['amount']);
	$button_title = esc_attr($instance['button_title']);
	$title = esc_attr($instance['title']); 
	
		echo $before_widget; 
			if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		
		?>
		
        <div class="paypal-button">
        <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                  <input type="hidden" name="cmd" value="_xclick" />
                  <input type="hidden" name="business" value="<?php echo $paypalemail; ?>" />
                  <input type="hidden" name="currency_code" value="USD" />
                  <input type="hidden" name="item_name" value="Donation" />
                  <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
                  
                  <input type="submit" name="submit" alt="<?php echo $button_title; ?>" value="<?php echo $button_title; ?>" class="paypal-button" />
        </form>
		</div>
		<?php
		 	echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("PaypalButton");'));
?>