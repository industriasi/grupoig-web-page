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

       
         	<?php 	if(have_posts()): while(have_posts()) : the_post(); ?>
            
            <div class="title">
            <h4 class="custom-font heading"> <?php the_title(); ?></h4>
            </div>
            <?php endwhile; endif; wp_reset_query(); ?>
            
            <div class="page-content">
			  
              <div class="breadcrumb clearfix"><?php $helper->the_breadcrumb();?></div>
			  <div class="content clearfix">
                
                <?php if($align=="left" && $sidebar=="true") : 
				        get_sidebar(); 
				 endif; ?>
                 
                 <?php 	wp_reset_query(); if(have_posts()): while(have_posts()) : the_post(); ?>
   	            <div class="<?php if($sidebar=="true") echo 'two-third-width'; else echo 'full-width';  ?>">
    
			        <?php the_content(); ?>
                 </div>
            <?php endwhile; endif; ?>
            
            
            <?php  
	 wp_reset_query();
	if($align=="right" &&  $sidebar=="true") 
	        get_sidebar();  ?>      
               
               </div> 
                  
          </div>
    
    
	
            
            
</div>
<?php get_footer(); ?>
      