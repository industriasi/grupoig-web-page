<?php
/*
Template Name: Full Page Template
*/
?>
<?php get_header();
$label = get_option("arc_blurb_label"); ?>   

<div class="blurb-wrapper">

            <div class="blurb clearfix">
          <p class="custom-font"><?php echo get_option("arc_blurb_text"); ?></p>
          <?php if($label) : ?> <a href="<?php echo get_option("arc_blurb_link"); ?>"> <?php echo $label; ?></a> <?php endif; ?>
          </div>

</div>
 <div class="page-body-wrapper"></div>    
 
<div class="container clearfix page">

       
   	<div>
        <div class="clearfix content-wrapper">
         	<?php 	if(have_posts()): while(have_posts()) : the_post(); ?>
            
            <div class="title">
            <h4 class="custom-font heading"><?php the_title(); ?></h4>
            </div>
            
            
            <div class="page-content">
			  
              <div class="breadcrumb clearfix"><?php $helper->the_breadcrumb();?></div>
			  <div class="content clearfix">
			  <?php the_content(); ?>
              </div>
            
            </div>
            
			<?php endwhile; endif; ?>
                  
                
                  
          </div>
    </div><!-- End of two third column -->

</div>
<?php get_footer(); ?>
      