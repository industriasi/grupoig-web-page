<?php
/*
Template Name: Search Page
*/
?>
<?php 
    
	get_header(); 
	
	
    $label = get_option("arc_blurb_label");
	$align =    get_post_meta($post->ID,'_sidebar_align',true);
	if($align=="")
  	$align = "right";
	
	
	
global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

$search = new WP_Query($search_query);

	
	?>   


<div class="blurb-wrapper">

           <div class="blurb clearfix">
          <p class="custom-font"><?php echo get_option("arc_blurb_text"); ?></p>
          <?php if($label) : ?> <a href="<?php echo get_option("arc_blurb_link"); ?>"> <?php echo $label; ?></a> <?php endif; ?>
          </div>

</div>
 <div class="page-body-wrapper"></div> 
<div class="container clearfix page">

       
         
            
            <div class="title">
            <h4 class="custom-font heading"> Search Results </h4>
            </div>
           
            
            <div class="page-content">
			  
              <div class="breadcrumb clearfix"><?php $helper->the_breadcrumb();?></div>
			  <div class="content clearfix">
                
              
                 
                 <?php 	 if ( $search->have_posts() ) : while ( $search->have_posts() ) : $search->the_post(); ?>
   	            <div class="posts-list">
    <ul class="clearfix">
			          <li class="clearfix">
                <?php 
				
	          	$width = "half";
			  if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : 
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
                            
                              
                              
                              <?php echo $helper->getShortenContent(200,strip_tags(get_the_content())); ?>
                              
                              <a href="<?php the_permalink() ?>" class="more-link">more</a>
                       </div>
                </li><li class="separator separator-full"><span></span></li>
                    
                    </ul>
                 </div>
            <?php endwhile; endif; ?>
            
         
               
               </div> 
                  
          </div>
    
    
	
            
            
</div>
<?php get_footer(); ?>
      