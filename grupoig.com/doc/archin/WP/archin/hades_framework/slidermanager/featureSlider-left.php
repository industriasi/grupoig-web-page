
<div class="slider-wrapper left-side">
   
     
           
    <div class="feature-slider container clearfix"><!-- Start of featured slider -->
       
     
        
        <div class="image-scroller-wrapper">
        <span class="tip"></span>
        <div class="image-scroller">
        <div>
         <ul class="clearfix">
        <?php 
		
	$slides = get_option('arc_slides');
		
		if(!is_array($slides))
		$slides = array();
		 foreach($slides as $slide) :
		 ?>  
          <li class="clearfix"><!-- Start of featured slide -->
            <?php
             $theImageSrc = $slide["src"];
							global $blog_id;
							if (isset($blog_id) && $blog_id > 0) {
							$imageParts = explode('/files/', $theImageSrc);
							if (isset($imageParts[1])) {
								$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							}
						}
				 ?>
                    <a href="<?php the_permalink();  ?>">
			         <?php 	                   
	echo "<img src='".get_bloginfo('template_directory')."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h=251&amp;w=658'   alt='sider image'/>";
	
			 ?></a>
             
           
          </li><!-- End of featured slide -->
        <?php 
		
		endforeach; 
		?>
        </ul>
        </div>
        
        </div>
        </div>
        
           <ul id="scroll-nav" class="clearfix">
        <?php
			$slides = get_option('arc_slides');
	$count = count($slides);	
	
		for($i=0;$i<$count;$i++)
		echo "<li><a href='#'></a></li>";
		 ?>
        </ul>
        
       <div class=" description-scroller">
        <ul class="clearfix">
        <?php 
		

		if(!is_array($slides))
		$slides = array();
		 foreach($slides as $slide) :
	?>  
          <li class="clearfix"><!-- Start of featured slide -->
           
             
           <span class="description">
           
          
            <h2 class="custom-font"><?php echo $slide['title']; ?> </h2>
                <p>   <?php echo $helper->getShortenContent(180,stripslashes($slide['description'])); ?> </p>
               <a href="<?php echo $slide['link']; ?>" class="more">read more</a>
             </span>
          </li><!-- End of featured slide -->
        <?php 
		
		endforeach; 
		?>
        </ul>
        </div>
     
        
        </div><!-- End of featured slider -->
 </div>   
    
    
    