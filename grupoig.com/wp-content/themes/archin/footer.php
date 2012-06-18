<?php 

$footer_columns = (!get_option("arc_footer_columns")) ? "4 Columns" : get_option("arc_footer_columns"); 
$fcount = 4;
switch($footer_columns)
	{
		
		case "2 Columns" : $footer_columns = "column2"; $fcount = 3; break;
		case "3 Columns" : $footer_columns = "column3"; $fcount = 4;  break;
		case "4 Columns" : $footer_columns = "column4"; $fcount = 5; break;
	}
?>
   <div id="footer" class="clearfix footer-<?php echo $footer_columns; ?>">
        <div class="container clearfix">
             
                  <?php 
				 
				  
                  for($i=1;$i<5;$i++)
				  {
                  if ( function_exists ( dynamic_sidebar("Footer Column $i") ) ) : 
                      dynamic_sidebar ("Footer Column $i"); 
                  endif; 
				  }
                  ?>
                  
         </div>    	
         <div id="footer-menu" class="clearfix">
      <div class="container">
        <?php 
				if(function_exists("wp_nav_menu"))
				{
					wp_nav_menu(array(
								'theme_location'=>'footer_nav',
								'container'=>'ul',
								'depth' => 1
								)
								);
				}
			?>
          <p class="footer-text"><?php echo stripslashes(get_option("arc_footer_bottom_text")); ?></p>  
       </div> 
    </div>
    </div>
    
<?php 
$image_effect = (!get_option("arc_image_effect")) ? "Greyscale" : get_option("arc_image_effect");
$invert = (!get_option("arc_toggle_image_invert")) ? "false" : get_option("arc_toggle_image_invert");
$image_effect_toggle = (!get_option("arc_toggle_image_effect")) ? "true" : get_option("arc_toggle_image_effect");

if($image_effect_toggle=="false")
$image_effect = "Disabled";

echo "<form action='' method='get'><input type='hidden' id='image_effect' value='{$image_effect}' /><input type='hidden' id='image_invert' value='{$invert}' /></form> ";
?>


<script type="text/javascript">
<?php if (get_option("arc_ga")) { 
  stripslashes(get_option("arc_ga")); } ?>
</script>

<?php  wp_footer();  ?>
</body>
</html>
