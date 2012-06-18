<?php 

include(HPATH."/lib/phpFlickr/phpFlickr.php");
$key = (!get_option("arc_flickr_key")) ? false : get_option("arc_flickr_key");
$flickr_name = (!get_option("arc_flickr_name")) ? NULL : get_option("arc_flickr_name");    
$label = get_option("arc_blurb_label");

get_header(); 
	
	?>   


<div class="blurb-wrapper">

          <div class="blurb clearfix">
          <p class="custom-font"><?php echo get_option("arc_blurb_text"); ?></p>
          <?php if($label) : ?> <a href="<?php echo get_option("arc_blurb_link"); ?>"> <?php echo $label; ?></a> <?php endif; ?>
          </div>

</div>
 <div class="page-body-wrapper"></div>    
 
<div class="container clearfix page ">

       
         
            
            <div class="title">
            <h4 class="custom-font heading"> <?php the_title(); ?></h4>
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
               
              </div>                
               
               
                <?php if(!$key) { echo '<p class="info"> No API KEY ADDED </p>'; } else { 
  
  $f = new phpFlickr($key);
  $person = $f->people_findByUsername($flickr_name);
  $photos_url = $f->urls_getUserPhotos($person['id']);
  $photos = $f->people_getPublicPhotos($person['id'], NULL, NULL, 16);
 
  
  ?>
    
   	<div class="clearfix column-2 gallery flickr-gallery">
     <?php 
	 
	   foreach ((array)$photos['photos']['photo'] as $photo) { ?>
     
		  <div class="gallery-item">
		
		
      
        <?php   
		
		       $theImageSrc = $f->buildPhotoURL($photo, "medium_640");
				echo " <a href=\"".$photos_url.$photo["id"]."\" ><img src='".get_bloginfo('template_directory')."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h=137&amp;w=185' alt='flickrimage'  />";
				
				
				 ?> 
		</a>
        </div>
  <?php	}	 ?>       
     
      
     
   
    
    <?php } ?>
	
</div>

                 
               
   	            <div class="">
    
			        <?php the_content(); ?>
                 </div>
           
            
            
          
               </div> 
                  
          </div>
    
    
	
            
            
</div>
<?php get_footer(); ?>
      