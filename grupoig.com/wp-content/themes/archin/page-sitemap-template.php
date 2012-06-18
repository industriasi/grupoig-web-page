<?php
/*
Template Name: Sitemap
*/
?>

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
 
<div class="container clearfix page <?php echo $hasSidebar; ?> sitemap">

       
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
    
              
				<div class="full_width clearfix"> 
				 <h4>Pages</h4>
                     <ul class="page-list clearfix"><?php wp_list_pages( array( "title_li"=>"" , "depth" => 1 ) ); ?></ul>
                 </div>
                 
               <div class="one-third">
               
                 <h4>Categories</h4>
                      <ul class="page-list"><?php wp_list_categories (array(
					  'title_li'           => ''
					  )); ?></ul>
              
              </div>
              <div class="two-third">   
                 <h4>All Blog Posts:</h4>
                      <ul class="blog-list"><?php $archive_query = new WP_Query('showposts=1000&cat=-8');
                        while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
                         <li>
                          <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
                          (<?php comments_number('0', '1', '%'); ?>)
                          </li>
                         <?php endwhile; ?>
                       </ul>
</div>
<div class="one-third">
                 <h4>Archives</h4>
                      <ul class="page-list">
                          <?php wp_get_archives('type=monthly&show_post_count=true'); ?>
                      </ul>
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
      