<?php
$path = __FILE__;
$pathwp = explode( 'wp-content', $path );
$wp_url = $pathwp[0];

require_once( $wp_url.'/wp-load.php' );

$header_texture = get_option("arc_header_texture");
$header_texture = (!$header_texture) ? "diagonal-texture.png" : $header_texture.".png"; 
	
$header_bg = get_option("arc_header_bg_color");
$header_bg = (!$header_bg) ? "#0d1218" : "#".$header_bg; 	

$header_title_color = get_option("arc_header_title_color");
$header_title_color = (!$header_title_color) ? "#fff" : "#".$header_title_color; 

$header_text_color = get_option("arc_header_text_color");
$header_text_color = (!$header_text_color) ? "#fff" : "#".$header_text_color; 

$header_button_color = get_option("arc_header_button_color");
$header_button_color = (!$header_button_color) ? "#0d1218" : "#".$header_button_color; 

$header_button_text_color = get_option("arc_header_button_text_color");
$header_button_text_color = (!$header_button_text_color) ? "#fff" : "#".$header_button_text_color; 


$footer_texture = get_option("arc_footer_texture");
$footer_texture = (!$footer_texture) ? "diagonal-texture.png" : $footer_texture.".png"; 
	
$footer_bg = get_option("arc_footer_bg_color");
$footer_bg = (!$footer_bg) ? "#0d1218" : "#".$footer_bg; 	

$footer_text_color = get_option("arc_footer_title_color");
$footer_text_color = (!$footer_text_color) ? "#fff" : "#".$footer_text_color; 	

$footer_p_color = get_option("arc_footer_p_color");
$footer_p_color = (!$footer_p_color) ? "#fff" : "#".$footer_p_color; 

$footer_link_color = get_option("arc_footer_link_color");
$footer_link_color = (!$footer_link_color) ? "#eee" : "#".$footer_link_color; 

$footer_link_hover_color = get_option("arc_footer_link_hover_color");
$footer_link_hover_color = (!$footer_link_hover_color) ? "#e4e4e4" : "#".$footer_link_hover_color; 

$footer_button_color = get_option("arc_footer_button_color");
$footer_button_color = (!$footer_button_color) ? "#fff" : "#".$footer_button_color; 

 $footer_button_text_color = get_option("arc_footer_button_text_color");
$footer_button_text_color = (!$footer_button_text_color) ? "#111" : "#".$footer_button_text_color; 


 
 
 
?>

<style type="text/css">

.slider-wrapper ,  .slider-wrapper-full , .slider-wrapper-shade , .blurb-wrapper { 
      background: url(<?php echo URL."/sprites/textures/".$header_texture.") $header_bg"; ?> ; }
.description-scroller  .description h2.custom-font { color:<?php echo $header_title_color; ?>!important; }
.description-scroller  .description p { color:<?php echo $header_text_color; ?>!important; }
.description-scroller ul li a.more { color:<?php echo $header_button_text_color; ?>!important; background-color:<?php echo $header_button_color; ?>!important;  border:1px solid <?php echo $header_button_color; ?>!important;  }
#footer  { 
      background: url(<?php echo URL."/sprites/textures/".$footer_texture.") $footer_bg"; ?> ; }
#footer .footer-wrap .custom-font {  color:<?php echo $footer_text_color; ?>!important; }
#footer .footer-wrap .custom-box-content { color:<?php echo $footer_p_color; ?>!important; }
#footer .footer-wrap a {  color:<?php echo $footer_link_color; ?>!important;  }
#footer .footer-wrap a:hover {   color:<?php echo $footer_link_hover_color; ?>!important;   }

#footer .footer-wrap a.more { color:<?php echo $footer_button_text_color; ?>!important; background-color:<?php echo $footer_button_color; ?>!important;  border:1px solid <?php echo $footer_button_color; ?>!important;  }
</style>