<?php 
    
	get_header(); 
	$hasSidebar = "";
	
	$sidebar =    get_post_meta($post->ID,'_enable_sidebar',true);
	$sidebar = ($sidebar=="") ? "false" : $sidebar;	
	
	
	
    $label = get_option("arc_blurb_label");
	$align =    get_post_meta($post->ID,'_sidebar_align',true);
	if($align=="")
  	$align = "right";
	
	if($sidebar=="true") {
		
	if($align == "right")	
	$hasSidebar = "hasRightSidebar";
	else
	$hasSidebar = "hasLeftSidebar";
	}
	
	
	?>   


<div class="blurb-wrapper">

           <div class="blurb clearfix">
          <p class="custom-font"><?php echo get_option("arc_blurb_text"); ?></p>
          <?php if($label) : ?> <a href="<?php echo get_option("arc_blurb_link"); ?>"> <?php echo $label; ?></a> <?php endif; ?>
          </div>

</div>
 <div class="page-body-wrapper"></div> 
<div class="container clearfix page <?php echo $hasSidebar; ?>">

       
         	
            
            <div class="title">
            <h4 class="custom-font heading"> Author </h4>
            </div>
           
            
            <div class="page-content">
			  
              <div class="breadcrumb clearfix"><?php $helper->the_breadcrumb();?></div>
			  <div class="content clearfix">
                
                <?php if($align=="left" && $sidebar=="true") : 
				        get_sidebar(); 
				 endif; ?>
                 
               
   	            <div class="<?php if($sidebar=="true") echo 'two-third-width'; else echo 'full-width';  ?>">
    
			           <div class="clearfix">
              <?php if(isset($_GET['author_name'])) :
						$curauth = get_userdatabylogin($author_name);
					else :
						$curauth = get_userdata(intval($author));
					endif;
			 ?>
             
			<h4 class="custom-font heading"> <?php  _e("About",'h-framework'); _e( $curauth->display_name,'h-framework' ); ?></h4>
            
			<div class="auth_desc clearfix">
			<div class='auth_avatar'>
            <?php if (function_exists('get_avatar')) { 
					               echo get_avatar(get_comment_author_email(),'120');
                    		}
							
			?>				
            </div>
			<?php _e( $curauth->description ); ?>
            
            
            </div>
			
            <div class="separator"></div>
			<?php if ($curauth->user_url): ?>
				<p><a href="<?php _e ( $curauth->user_url ,'h-framework'); ?>" class="button right">Visit <?php _e( $curauth->display_name ,'h-framework');  _e("'s Website",'h-framework'); ?></a></p>
			<?php endif; ?>
                  
          </div>
                 </div>
            
            
            <?php  
	 wp_reset_query();
	if($align=="right" &&  $sidebar=="true") 
	        get_sidebar();  ?>      
               
               </div> 
                  
          </div>
    
    
	
            
            
</div>
<?php get_footer(); ?>
      