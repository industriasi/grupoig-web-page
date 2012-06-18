<?php 

if(get_post_type()=="gallery")
	{
		$custom = get_post_custom($post->ID);
        $gallery_column = $custom["gallery_column"][0];
		switch($gallery_column)
		{
			case "galleria" :  include('page-gallery-galleria-template.php'); break;
			case "custom" :  include('page-gallery-custom-template.php'); break;
			case "flickr" :  include('page-gallery-flickr-template.php'); break;
			default : include('page-gallery-template.php'); break;
		}
		
		
		return;
	}
	
?>	
<?php 
    
	get_header(); 
	$hasSidebar = "";
	
	$sidebar =    get_post_meta($post->ID,'_enable_sidebar',true);
	$sidebar = true;	
	
	
	
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
 
<div class="container clearfix page single <?php echo $hasSidebar; ?>">

       
         	<?php 	if(have_posts()): while(have_posts()) : the_post(); ?>
            
                        
            <div class="title">
            <h4 class="custom-font heading-single"> <?php the_title(); ?></h4>
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
                         <?php 
		
		if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
		?>
                       		
                            
        <div class="single-image clearfix">
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
	 if($sidebar=="true")                  
	  echo "<img src='".get_bloginfo('template_directory')."/timthumb.php?src=".urlencode($theImageSrc)."&h=260&w=600'  />";
	 else      
	  echo "<img src='".get_bloginfo('template_directory')."/timthumb.php?src=".urlencode($theImageSrc)."&h=360&w=900'  />";
		          
			          ?></a>
        </div>
        
        <?php } ?> 
           
           <ul class="intro_title clearfix">
             <li class="clearfix">
               <h1><?php the_title(); ?></h1>
             </li>
             <li class="single_top_info clearfix">
                 <span><?php echo get_the_date("j F Y"); ?> by <?php the_author_posts_link() ?></span>
                 <span class="comment"><?php comments_number('0 Comments','1 Comments','% Comments'); ?></span>
              </li>
           </ul>
        
			      <?php the_content(); ?>
                    
                  
                  <ul class="single_bottom_info clearfix">
                       <li class="categories clearfix"> <?php 
					   
					   
					   $cats = wp_get_post_categories( $post->ID );
					$str = ''; $temp = false;
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
					echo "<strong>Categories:</strong> <p> $str </p>";
					
					   
					   ?> </li>
                     <li class="tags clearfix"><strong>Tags:</strong> <p> <?php the_tags(' ',' , '); ?> </p></li>  
                  </ul>
                  
                     <?php if(get_option("arc_social_set")==""||get_option("arc_social_set")=="true") { ?>     
         <div class="social-stuff clearfix">
                 <?php     include(HPATH."/helper/social-stuff.php"); ?>   
         </div>  
        <?php } ?>  
           
            <?php if(get_option("arc_author_bio")=="" || get_option("arc_author_bio")=="true") { ?>                    
                  <div id="authorbox" class="clearfix">  
                            <div class="author-avatar">
                            <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); }?>  
                            </div>
                            <div class="authortext">  
                             <h6><?php _e('About the ','h-framework'); the_author_posts_link(); ?></h6>  
                             <p><?php the_author_meta('description'); ?></p>  
                             
                                  <ul class="right clearfix"><li> View all posts by<?php the_author_posts_link(); ?>  </li> </ul>
                          
                          </div>  
              </div>
       <?php }?>     
       
         <?php if(get_option("arc_popular")==""||get_option("arc_popular")=="true") { ?>    
             
           <div class="single-scroller-posts-wrapper">      
  <a href="#" class="single-showcase-next"></a>
 <a href="#" class="single-showcase-prev"></a>
 <h3>Related Posts</h3>
 <div class="single-scroller-posts">
  

 <ul class="clearfix" >
            			<?php 
						
						
						$tags = wp_get_post_tags($post->ID);
						if ($tags) {
							$tag_ids = array();
							foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
							$args=array(
							'tag__in' => $tag_ids,
							'post__not_in' => array($post->ID),
							'posts_per_page'=>5, // Number of related posts that will be shown.
							'caller_get_posts'=>1
							);
						}

						
						$popPosts = new WP_Query( $args );
					  
						while ($popPosts->have_posts()) : $popPosts->the_post();  $more = 0;?>
                        
                        <li class="clearfix" >
                        	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                            <div class="image">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(86,86)); ?></a>
                            </div><!--image-->
                            <?php endif; ?>
                        </li>
                        
                        <?php endwhile; ?>
                        
                        <?php wp_reset_query(); ?>

                    </ul>
        
		</div>
        </div>
           
     <?php }?>   
   
               
    <div id="comments_template">
              <?php comments_template(); ?>
    </div>
           
                    
                    
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
      