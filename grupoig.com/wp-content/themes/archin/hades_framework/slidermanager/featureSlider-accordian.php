
<div class="slider-wrapper-full">
         
    <div class="accordian-slider"><!-- Start of featured slider -->
       
       
        <ul class="kwicks clearfix ">
        <?php 
		
		
		$slides = get_option('arc_slides');
		
		if(!is_array($slides))
		$slides = array( array() );
		
		$feature_count = count($slides);	
		$width =  920/( (int)$feature_count );
		//The Loop
        
		 foreach($slides as $slide) :
		 ?>  
         <li class="clearfix" style="width:<?php echo $width; ?>px;"><!-- Start of featured slide -->
            <div class="imageholder"><a href="<?php $slide["link"] ?>"><?php
			echo "<img src='$slide[src]' width='920' />";
		 
			 ?></a></div>
           <div class="description">
            <h2 class="custom-font"><?php echo $slide['title']; ?> </h2>
                <p>   <?php echo stripslashes($slide['description']); ?> </p>
             </div>
          </li><!-- End of featured slide -->
        <?php 
		 
		endforeach; 
		?>
        </ul>
        
        </div><!-- End of featured slider -->
 </div>   
    
    
    