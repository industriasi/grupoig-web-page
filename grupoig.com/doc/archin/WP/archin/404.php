<?php 
  get_header(); 
  $label = get_option("arc_blurb_label"); // Action Box button label
?>   


<!-- ================================================================================================ -->
<!-- ============================================ Page Begins ======================================= -->
<!-- ================================================================================================ -->

<!-- Blurb Begins -->
<div class="blurb-wrapper">
     <div class="blurb clearfix">
          <p class="custom-font"><?php echo get_option("arc_blurb_text"); ?></p>
          <?php if($label) : ?> <a href="<?php echo get_option("arc_blurb_link"); ?>"> <?php echo $label; ?></a> <?php endif; ?>
     </div>
</div>
<!-- Blurb Ends -->
 <div class="page-body-wrapper"></div>    
 
<!-- Container Begins -->
<div class="container clearfix page not-found">
     <div class="title">
           <h4 class="custom-font heading">Page not Found</h4>
     </div>
     <div class="page-content">
           <div class="breadcrumb clearfix"><?php $helper->the_breadcrumb();?></div>
    	   <div class="content clearfix">
              <div class="full-width">
                 <h2 class="custom-font"> Page Not Found </h2>
                 <p>Nulla mattis feugiat diam, vel rhoncus lorem elementum at. Nam et libero justo. Integer sed libero mi, eu porttitor risus. Cras aliquam imperdiet velit, vel venenatis massa interdum hendrerit. Etiam pulvinar semper mauris sed adipiscing. Sed luctus quam in risus iaculis nec congue ligula sodales. </p>
			     <div class="404-search"><?php get_search_form(); ?></div>
              </div>
            </div> 
      </div>           
</div>
<?php get_footer(); ?>
      