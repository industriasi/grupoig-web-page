<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');

function mytheme_add_admin() {
	global $themename, $shortname, $options;
 	if ( $_GET['page'] == basename(__FILE__) ) {
 		if ( 'save' == $_REQUEST['action'] ) {
 			
			foreach ($options as $value) {
			
			update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			
			 }
 			
			foreach ($options as $value) {
				
				
				if( isset( $_REQUEST[ $value['id'] ] ) ) { 
				
				update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
				} 
				else {				
				
				 delete_option( $value['id'] );
				 			}
				
						
				 }
 		header("Location: admin.php?page=elements.php&saved=true");
		die;
 	} 
	else if( 'reset' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
			delete_option( $value['id'] ); }
 		header("Location: admin.php?page=elements.php&reset=true");
		die;
 		}
	}
 	add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin', HURL."/css/i/icon.png");
}



function mytheme_add_init() {

	
	
	if(isset($_GET['page'])&&$_GET['page']=='elements.php')
	{
	   wp_deregister_script('jquery-ui-tabs');
	   wp_enqueue_script("jquery-ui-tabs", HURL."/js/jquery.ui.tabs.js",array('jquery','jquery-ui-core','jquery-ui-widget'), "1.0");
       wp_enqueue_script("jquery-ui-mouse", HURL."/js/jquery.ui.mouse.js",array('jquery','jquery-ui-core','jquery-ui-widget'), "1.0");
	   wp_enqueue_script("jquery-ui-button", HURL."/js/jquery.ui.button.js",array('jquery','jquery-ui-core','jquery-ui-widget'), "1.0");
	   wp_enqueue_script("jquery-ui-slider", HURL."/js/jquery.ui.slider.js",array('jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-mouse'), "1.0");
	   
	   wp_enqueue_script("jquery-ui-widget", HURL."/js/jquery.ui.widget.js", array('jquery','jquery-ui-core'), "1.0");
	   wp_enqueue_script("hadesscript", HURL."/js/hades_script.js", array('jquery','jquery-ui-tabs','jquery-ui-slider'), "1.0");
	   wp_enqueue_script("admin-colorpicker",HURL."/js/colorpicker.js",array('jquery'),"1.0");
	   wp_enqueue_style("colorpicker-style", HURL."/css/colorpicker.css", false, "1.0", "all");
	   wp_enqueue_style("themeoptions-css", HURL."/css/hades.css", false, "1.0", "all");
	   
	    wp_enqueue_script("thickbox");
		wp_enqueue_style("thickbox");
	 }
	
	
	
	
}


function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
?> <div class="success_message hades_information"><p><strong> Theme Settings Saved ! </strong></p></div> <?php
if ( $_REQUEST['reset'] ) echo '<div class="hades_information"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>

<div class="hades_wrap">
    <div id="hades_theme">
         <div class="hades-head clearfix">
              <a href="#" id="logo"></a>
              <span class="ajax_loading_icon"></span>
              <input type="hidden" value="<?php echo HURL."/option_panel/ajax.php" ?>" id="option_path" />
         </div>
         <div class="notice-bar">
              <p>Option Panel Version : 1.0 </p>
         </div>
    <div id="hades_opts" class="clearfix">
  
      <ul id="themenav" class="clearfix">
	  <?php
	
		foreach ($options as $value)
		{
			if($value['type']=="section") { ?>
			<li>
                <a href="#<?php echo $value['name']; ?>" id="menu_<?php echo $value['name']; ?>"> 
                    <span></span><?php _e( $value['name'], 'h-framework'); ?>
                </a>
            </li>
            <?php  }  
		}
	   ?>
      </ul>
     <div id="panel-wrapper" class="clearfix">
        <form method="post"  enctype="multipart/form-data" action="" class="clearfix" id="hades_option_form" >
    
     	<?php 
		$newoptions  = $options; // php 4.4 fix
		$sidemenu_Flag = true; $description = '';
		foreach ($newoptions as $value) {
			switch ( $value['type'] ) {
 				case "open":?> <?php $sidemenu_Flag = true; 
					  break; 
 				case "close": $description = ''; ?> </div></div></div>
					  <?php break;
 			
  				case 'text': ?>
  						
							<div class="hades_input clearfix">
								<label for="<?php echo $value['id']; ?>"><?php _e( $value['name'] , 'h-framework'); ?></label>
 								<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
 							
                            <?php if($value['desc']!="") { ?>
                            <small><span>  <?php _e( $value['desc'] , 'h-framework'); ?></span></small>
 						    <?php } ?>
                            </div>
                         <?php break;
				case 'upload' : ?>
                 <div class="hades_input clearfix"> 
                 <label for="<?php echo $value['id']; ?>"><?php _e( $value['name'], 'h-framework'); ?></label>
                 <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
                 <a href="#" class="custom_upload_image_button button">Upload Image</a>
                 
                
                  </div>  
          
          <?php break;		 
				case 'colorpickerfield' : ?>
				<div class="hades_input clearfix">
								<label for="<?php echo $value['id']; ?>"><?php _e( $value['name'], 'h-framework'); ?></label>
                <h6>#</h6><input type="text"  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="colorpickerField1 width-small" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
               <small class="cicon"></small> 
               
                 <?php if($value['desc']!="") { ?>
                            <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 						    <?php } ?>
 						    </div>
                <?php
				break;		 
				case 'slider': ?>
							<div class="hades_input clearfix">
								<label for="<?php echo $value['id']; ?>"><?php _e( $value['name'] , 'h-framework'); ?></label>
                                <div class="hades_slider" ></div>
                                <input type="hidden" class="slider-val"  value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
                                <input type="hidden" class="max-slider-val"  value="<?php if($value["max"]=="") echo 500; else echo $value["max"]; ?>" />
                                 
 								<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"class='slider-text' /><h6 class="slider-suffix"><?php if(isset( $value['suffix'])) echo $value['suffix']; ?></h6>
 							  <?php if($value['desc']!="") { ?>
                             <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 						    <?php } ?>
 						    </div>
                         <?php break;
						 		 
 				case 'textarea': ?>
								<div class="hades_input clearfix">
									<label for="<?php echo $value['id']; ?>"><?php _e( $value['name'], 'h-framework'); ?></label>
 									<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 									  <?php if($value['desc']!="") { ?>
                             <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 						    <?php } ?>
                                 </div>
								 <?php break;
								 
 				case 'select': ?>
								<div class="hades_input clearfix">
									<label for="<?php echo $value['id']; ?>"><?php _e( $value['name'], 'h-framework'); ?></label>
									<div class="select-wrapper clearfix">
                                    <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>

											<option <?php 
											if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
									</select>
                                    </div>
									  <?php if($value['desc']!="") { ?>
                            <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 						    <?php } ?>
								</div>
							<?php break;
 				case "checkbox": ?>
								<div class="hades_input clearfix">
									<label for="<?php echo $value['id']; ?>"><?php _e( $value['name'], 'h-framework'); ?></label>
									<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
									<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
									  <?php if($value['desc']!="") { ?>
                            <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 						    <?php } ?>
 								</div>
								<?php break; 
				case "help": ?>
								<div class="hades_input clearfix help">
									<iframe id="<?php echo $value['id']; ?>" src="<?php echo $value['src']; ?>">
                                    
                                    </iframe>
 								</div>
								<?php break; 
								
												
				case "toggle": ?>
								<div class="hades_input clearfix">
                                  
                               
    
									<label><?php _e( $value['name'] , 'h-framework'); 
									if(get_option($value['id'])!="")
										{ $checker = get_option($value['id']); }
									else
										{ $checker = $value['std'];  }
									?></label>
                                
                                  
                                    
                                    <div class="radio">
										<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>1"  
										<?php  if($checker=="true") echo "checked=\"checked\""; ?> value="true" /><label for="<?php echo $value['id']; ?>1">ON</label>
										<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>2" 
										<?php  if($checker=="false") echo "checked=\"checked\""; ?>  value="false"/><label for="<?php echo $value['id']; ?>2">OFF</label>
								  </div>
                                  
                                  
									
									
									  <?php if($value['desc']!="") { ?>
                             <small><span>  <?php _e( $value['desc'] , 'h-framework'); ?></span></small>
 						    <?php } ?>
 								</div>
								<?php break; 				
				case "section": $i++; ?>
								<div class="hades_section" id="<?php echo $value['name']; $section_name = $value['name']; ?>" ><!-- Start of the section  -->
									
                                   
                                    
									<div class="hades_options"> <!-- Start of hades option  --> <?php break;
				case "information" : echo "<div class='subpanel clearfix'>"; 
				$description = " <div class=\"hades_information\"><a href='#' class='info-icon'></a><p> ".__($value["description"], 'h-framework')."</p></div>"; ?>
			
				<?php
				break; 
				case "subtitle" : 		 
				
				 echo '<div class="subtitle-heading"><a href="#'.$value['id'].'">'.__($value['name'], 'h-framework').'</a></div>';
				 echo "<div class='hades_subpanel' id='$value[id]' > "; 
				?>
				
				<?php
				break;
				case "close_subtitle" :$sidemenu_Flag = false; ?> 
				
                <span class="top-panel clearfix">
                    <input name="save<?php echo $i; ?>" type="submit" value="Save changes" class="admin-button" />  
                    <input name="reset" type="button" value="RESET" class="panel-reset"/>
                </span> 
				
				<?php echo "</div>"; break;					
     }
  }
?>
 
	<input type="hidden" name="action" value="save" />

</div>

</form>
  <form method="post" class="reset-form">
                   
                    <input type="hidden" name="action" value="reset" />
                 </form>
                 
</div>

</div> 

 

<?php
} 
?>