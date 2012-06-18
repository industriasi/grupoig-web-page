<?php 
$label = get_option("arc_blurb_label");
get_header(); ?>   


<div class="blurb-wrapper">

           <div class="blurb clearfix">
          <p class="custom-font"><?php echo get_option("arc_blurb_text"); ?></p>
          <?php if($label) : ?> <a href="<?php echo get_option("arc_blurb_link"); ?>"> <?php echo $label; ?></a> <?php endif; ?>
          </div>

</div>
 <div class="page-body-wrapper"></div>    
 
<div class="container clearfix page">

       
   	<div>
        <div class="clearfix">
         
            
            <div class="title">
            <h4 class="custom-font heading"> <?php the_title(); ?> </h4>
            </div>
            
           
                  
                  
            <div class="page-content">
			  
              <div class="breadcrumb clearfix"><?php $helper->the_breadcrumb();?></div>
              <div class="gallery-menus1 clearfix">
              
              <div class="gallery_menu_part">
              <?php 
			  $helper->showPosts(array( "post_type" => "gallery" ,"thumbnails" =>false  ,"extras" => false  ));
			  wp_reset_query();
			  ?>
              </div>
              
                <ul class="clearfix custom-list-controls">
                 <li><a href="#" class="custom-prev"> &laquo; Prev </a></li>
                 <li><a href="#" class="custom-next"> Next &raquo;</a></li>
               </ul>
               
              </div>
              <div class="custom-gallery-thumbs">
              
              
                        <div class="clearfix thumbnails">
                   
              <?php 
              $custom = get_post_custom($post->ID);
              $slides = unserialize($custom["gallery_items"][0]);
              $first_slide = $slides[0];
              foreach($slides as $slide) :
                  
               
                          $theImageSrc = $slide["src"];
                          global $blog_id;
                          if (isset($blog_id) && $blog_id > 0) {
                          $imageParts = explode('/files/', $theImageSrc);
                          if (isset($imageParts[1])) {
                              $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
                          }
                      }
          
          
                          
                          echo " <a href=\"".URL."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h=672&amp;w=886\" alt='$slide[src]' >  <img src='".URL."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h=65&amp;w=65' alt='$slide[description]' title='$slide[title]' />  </a> ";
                          
                          
                          endforeach; ?>
            </div>
               
             
               
              </div>
			  <div class="content">
			 
             
   	              <div class="image-stage">
                  
                  
                  
                   <a class="lightbox" href="<?php echo $first_slide["src"]; ?>">
                    <span class="custom-font"><?php echo  "<h2 class='custom-font'>".$first_slide["description"]."</h2>".$first_slide["description"]; ?></span>
                    <img src="<?php 
					
					 $theImageSrc = $first_slide["src"];
                          global $blog_id;
                          if (isset($blog_id) && $blog_id > 0) {
                          $imageParts = explode('/files/', $theImageSrc);
                          if (isset($imageParts[1])) {
                              $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
                          }
                      }
					  
					 echo URL."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h=672&amp;w=886;"; ?> "  />
                  </a>
                  </div>
             
             
              </div>
            
            </div>
            
			
                
                  
          </div>
    </div><!-- End of two third column -->
    
</div>
<?php get_footer(); ?>
      