<?php 

$label = get_option("arc_blurb_label");
$hasSidebar = "";
	
	$align =    get_post_meta($post->ID,'_sidebar_align',true);
	$sidebar =    get_post_meta($post->ID,'_enable_sidebar',true);
	$sidebar =  "true" ;	
	
	
	if($align=="")
  	$align = "right";
	
	if($sidebar=="true") {
		
	if($align == "right")	
	$hasSidebar = "hasRightSidebar";
	else
	$hasSidebar = "hasLeftSidebar";
	}
	
get_header(); 

?>   

<!--  Global intro blurb  -->
<div class="blurb-wrapper">

          <div class="blurb clearfix">
          <p class="custom-font"><?php echo get_option("arc_blurb_text"); ?></p>
          <?php if($label) : ?> <a href="<?php echo get_option("arc_blurb_link"); ?>"> <?php echo $label; ?></a> <?php endif; ?>
          </div>

</div><!-- end of Global intro blurb  -->

 <div class="page-body-wrapper"></div>    
 
<div class="container clearfix page blog <?php echo $hasSidebar; ?>"> <!--  Start of main container -->
  
  
   <div class="content-wrapper">
   
      <!--  Start of Title -->
      <div class="title"> 
            <h4 class="custom-font heading"><?php the_title(); ?></h4>
      </div>
      <!--  End of Title   -->
  
            
      <div class="page-content">
		<div class="breadcrumb clearfix"><?php $helper->the_breadcrumb();?></div><!--  Breadcrumb -->
		  <div class="content clearfix ">
             
			 <?php if($align=="left" && $sidebar=="true") : 
				        get_sidebar(); 
				 endif; ?>
                 
		     <div class="<?php if($sidebar=="true") echo 'two-third-width clearfix'; else echo 'full-width clearfix';  ?>">  
                  <div class="posts-list clearfix">
					<?php   
                    global $paged;
                    global $post;
                    global $more ; 
                    query_posts("orderby=date".'&paged='.$paged);
                    ?>
            
		           <ul class="clearfix">
                   <?php 
	    	        if ( have_posts() ) : while ( have_posts() ) : the_post();
		            $more = 0;
	                ?>
                <li class="clearfix">
                <?php 
				
	          	$width = "half";
			   if(get_post_meta(get_the_ID(),"_custom_thumbnails_select",true)=="video") :  
			      echo ' <div class="imageholder videoholder"><a href="#">'.get_post_meta(get_the_ID(),"_custom_thumbnail_video",true)."</a></div>";             
			   elseif(get_post_meta(get_the_ID(),"_custom_thumbnails_select",true)=="slideshow") :
		          $slides = get_post_meta(get_the_ID(),"_custom_thumbnail_gallery",true);
			   	  $slideshow =  '<div class="thumbnail-slideshow"><div class="slideshow-holder"><ul>';
		          
				  foreach($slides as $slide)
				  {  
					 $theImageSrc = $slide['src'];
					  global $blog_id;
					  if (isset($blog_id) && $blog_id > 0) {
					      $imageParts = explode('/files/', $theImageSrc);
					      if (isset($imageParts[1])) {
						  $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
						    }
			          }
			    	$slideshow = $slideshow. "<li><img src='".get_bloginfo('template_directory')."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h=170&amp;w=255' alt='slideshow'  /></li>";
				
				    }
		        $slideshow = $slideshow.'</ul></div></div>';
		        echo $slideshow;
				elseif (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : 
				    $id = get_post_thumbnail_id();
	          	    $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
    				$theImageSrc = $ar[0];
					  global $blog_id;
					  if (isset($blog_id) && $blog_id > 0) {
					  $imageParts = explode('/files/', $theImageSrc);
					  if (isset($imageParts[1])) {
						  $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
					  }
				  }
				 ?>
                     <div class="imageholder">
                       <a href="<?php echo $ar[0]; ?>" class="lightbox">
			         <?php 
	                  	echo "<img src='".get_bloginfo('template_directory')."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h=262&amp;w=609' alt='postimage' />"; ?>
                        </a>
                       <div class="image-info clearfix">
                         <h2 class="custom-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                         <div class="clearfix custom-font"> 
                             <span><?php echo get_the_date("d"); ?> </span> 
                             <ul>
                               <li><?php echo get_the_date("M"); ?> </li>
                               <li><?php echo get_the_date("Y"); ?> </li>
                             </ul> 
                          </div>
                       </div>
                      <div class='extra-info clearfix'> 
                        <small class="posts-list-author"> by <?php the_author_posts_link() ?> </small>
                        <small class="posts-list-category"> 
                            
                            <?php 
						
							$cats = wp_get_post_categories( $post->ID );
					        $str = ' '; $temp = false;
							foreach($cats as $c)
							{
								$cat = get_category( $c );
								$link = get_category_link( $c );
								if(!$temp)
								 {
									 
									 $str = $str."  <a href=' $link' >".$cat->name."</a>";
									 $temp = true;
								 }
								 else
								  $str = $str." , <a href=' $link' >".$cat->name."</a>";
							
							}
							echo " $str  ";
							 ?>
                            </small>
                            <small class="posts-list-comments"><?php comments_number('0 Comments','1 Comments','% Comments'); ?></small>
                            
                 </div> 
                     </div>
               <?php else: $width = "";  endif; ?>
                      <div class="description <?php echo $width;?> ">
                            
                              
                              
                              <?php echo $helper->getShortenContent(200,get_the_content()); ?>
                              
                              <a href="<?php the_permalink() ?>" class="more-link">more</a>
                       </div>
                </li><li class="separator separator-full"><span></span></li>
          <?php  $i++; endwhile; else:
              _e( '<h4>No posts yet !</h4>', 'h-framework' );
            endif;
        	?>
     </ul>
                    
                  </div>
  
                 <div class="pagination-panel clearfix">
  
                  <!-- Pagination -->
                  <p class='pagination-prev'>
                     <?php previous_posts_link("Previous Page"); ?>
                  </p>
                  
                  <p class='pagination-next'>
                     <?php next_posts_link("Next Page"); ?>
                  </p> 
                  
                  </div>
                  
             </div>       <!--  End of Two Third / Full width column -->     
           
             <?php 
			 wp_reset_query();
			 
			if($align=="right" &&  $sidebar=="true") 
	        get_sidebar();
			 ?>
            
          </div><!--  End of Content -->     
      </div><!--  End of Page Content -->   
           
     </div> <!--  End of Content Warpper -->        
		
    </div><!-- End of Container -->
    
	<?php  
	?>
</div>
<?php get_footer(); ?>
      