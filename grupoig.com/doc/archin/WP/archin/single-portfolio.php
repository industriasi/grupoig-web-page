<?php 

	
	$link = get_post_meta($post->ID,'_portfolio_link',true)  ;
	$label = get_option("arc_blurb_label");
	
get_header(); ?>   


<div class="blurb-wrapper">

           <div class="blurb clearfix">
          <p class="custom-font"><?php echo get_option("arc_blurb_text"); ?></p>
          <?php if($label) : ?> <a href="<?php echo get_option("arc_blurb_link"); ?>"> <?php echo $label; ?></a> <?php endif; ?>
          </div>

</div>
 <div class="page-body-wrapper"></div>    
 
<div class="container clearfix page single-portfolio">

       
   	<div class="clearfix">
        <div class="clearfix">
         	<?php 	if(have_posts()): while(have_posts()) : the_post(); ?>
            
            <div class="title">
            <h4 class="custom-font heading"><?php the_title(); ?></h4>
            </div>
            
            
            <div class="page-content clearfix">
			  
              <div class="breadcrumb clearfix"><?php $helper->the_breadcrumb();?></div>
			  <div class="content clearfix">
			  
              
              <?php 
		
		if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
		?>
                       		
       
                                      
        <div class="single-image two-third">
               <?php 
		
		$id = get_post_thumbnail_id();
		$ar = wp_get_attachment_image_src( $id, array(9999,9999) );
	     $theImageSrc = $ar[0];
							global $blog_id;
							if (isset($blog_id) && $blog_id > 0) {
							$imageParts = explode('/files/', $theImageSrc);
							if (isset($imageParts[1])) {
								$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							}
						} ?>
	<a href="<?php echo $ar[0]; ?>" class="lightbox">
			         <?php 
	                   
	echo "<img src='".get_bloginfo('template_directory')."/timthumb.php?src=".urlencode($theImageSrc)."&h=575&w=588'  />";
	              
			          ?></a>
       
        
         </div>
         
                    
              <?php } ?>                    		 
                                      
        <div class="single-content one-fourth">
               
            <h4 class="custom-font"> <?php  the_title(); ?> </h4>
             
             <div class='single-content-text'>  
			<?php  the_content(); ?>
            </div>
            <a href="<?php echo $link; ?>" class="more">VISIT</a>
        </div>
        
			  
              </div>
            
            
            
			<?php endwhile; endif; ?>
                  
                
                  
          </div>
    </div><!-- End of two third column -->
        </div>
   </div>
	
</div>
<?php get_footer(); ?>
      