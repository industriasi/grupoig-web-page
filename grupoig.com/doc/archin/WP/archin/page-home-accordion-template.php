<?php
/*
Template Name: Home Page Accordion Template
*/
?>

<?php 

 wp_enqueue_script("jquery-kwick", URL. "/js/jquery.kwicks-1.5.1.js", array('jquery'), "1.0");  

function home_slider_acc_init(){
	 
	 ?>
	 <script type="text/javascript">
     jQuery(function($){
	  $('.kwicks').kwicks({  
        max : 880,  
        spacing : 0  
    });
	var elt;
	$('.kwicks li').hover(function(){
	elt = $(this);
		elt.children(".description").css("visibility","visible").delay(700).animate({opacity:1},1000);
		},function(){
			
			$(this).children(".description").stop(true,true).css({"visibility":"hidden","opacity":0 });
			
			});
			
	 });
     
     </script>
	 
	 <?php
}
add_action("wp_head","home_slider_acc_init");

$label = get_option("arc_blurb_label");
get_header(); 

     if( ( get_option("arc_enable_feature_slider")=="" || get_option("arc_enable_feature_slider")=="true" )) 
	 include(HPATH."/slidermanager/featureSlider-accordian.php");  ?>
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
      