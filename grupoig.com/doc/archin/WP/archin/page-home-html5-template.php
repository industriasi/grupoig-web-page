<?php
/*
Template Name: Home Page HTML5 Template
*/
?>

<?php 
 function home_slider_jslider_init(){
	 
	 ?>
	 <script type="text/javascript">
     jQuery(function($){
	$(".quartz-slider>ul").quartzslider({ time:6000 , arrowControls:false,height:381,width:920 , mode:'html5', controls:true});	
	 });
     
     </script>
	 
	 <?php
}
add_action("wp_head","home_slider_jslider_init");
  
$label = get_option("arc_blurb_label");
get_header(); 

     if( ( get_option("arc_enable_feature_slider")=="" || get_option("arc_enable_feature_slider")=="true" )) 
	 include(HPATH."/slidermanager/featureSlider-jquery.php");  ?>
	  <div class="body-wrapper ">	  	  
          
		  <div class="container clearfix">
          
          <div class="blurb clearfix">
          <p class="custom-font"><?php echo get_option("arc_blurb_text"); ?></p>
          <?php if($label) : ?> <a href="<?php echo get_option("arc_blurb_link"); ?>"> <?php echo $label; ?></a> <?php endif; ?>
          </div>
          
		  <?php
		
        
	  	if(have_posts()): while(have_posts()) : the_post(); 
								 ?>
                                  <div class="home-page-content">
		                               
                                       <div class="homepage-sidebar clearfix">
                                           <?php 
                                              if ( function_exists ( dynamic_sidebar("Home Page Content") ) ) : 
                                                  dynamic_sidebar ("Home Page Content"); 
                                              endif; 
                                         ?>
                                         </div>
                                         
                                         <div class="clearfix homepage-sidebar-2 ">
                                          <?php   
                                              if ( function_exists ( dynamic_sidebar("Home Page Content2") ) ) : 
                                                  dynamic_sidebar ("Home Page Content2"); 
                                              endif; 
                                            ?>   
                                          </div>
        								 
										 <div class="content"> <?php the_content(); ?> </div>
                                   </div>
                      				 
                        
                        <?php endwhile; endif; ?>
    </div>
</div>
<?php get_footer(); ?>
      