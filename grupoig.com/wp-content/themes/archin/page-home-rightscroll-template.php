<?php
/*
Template Name: Home Page Slider Right Template
*/
?>

<?php 
$label = get_option("arc_blurb_label");
get_header(); 
    ?>
	<script type="text/javascript">
    jQuery(function($){
		
		 var desc = $(".description-scroller").scrollable({api: true , vertical:true });
    var iscroller = $(".image-scroller>div").scrollable({ api:true, vertical:true });
	
	
  $("#scroll-nav li:first").addClass("active");
  $("#scroll-nav li a").click(function(e){
	   $("#scroll-nav li").removeClass("active");
	  
	  temp = $(this).parent().addClass("active").index("#scroll-nav li");
	 
	  desc.seekTo(temp); 
	  iscroller.seekTo(temp); 
	  
	  e.preventDefault();
	  });	
		
		
		});
    
    </script>
	
	<?php
     if( ( get_option("arc_enable_feature_slider")=="" || get_option("arc_enable_feature_slider")=="true" )) 
	 include(HPATH."/slidermanager/featureSlider-left.php");  ?>
	
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
      