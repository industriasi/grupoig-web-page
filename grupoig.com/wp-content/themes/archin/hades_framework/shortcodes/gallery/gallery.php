<?php

function createSlide($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "src" => ''
	    ), $atts)); 
	$content = do_shortcode($content);	
	$tab = " <li>
	               <a href=\"{$src}\">
			<img src=\"{$src}\" alt=\"$content\">
			       </a>
			 </li>";
	return $tab;
}

add_shortcode("slide","createSlide");

function createSliderWidget($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "width" => 300,
		"height" => 250
		
	    ), $atts)); 
		
		
	$data = "	 
	  <div class=\"ppy shortcode_slider\"> 
            <ul class='ppy-imglist'>".do_shortcode($content)."</ul>
            <div class=\"ppy-outer\"> 
                <div class=\"ppy-stage\"> 
                    <div class=\"ppy-nav\"> 
                        <a class=\"ppy-prev\" title=\"Previous image\">Previous image</a> 
                        <a class=\"ppy-switch-enlarge\" title=\"Enlarge\">Enlarge</a> 
                        <a class=\"ppy-switch-compact\" title=\"Close\">Close</a> 
                        <a class=\"ppy-next\" title=\"Next image\">Next image</a> 
                    </div> 
                </div> 
            </div> 
            <div class=\"ppy-caption\"> 
                <div class=\"ppy-counter\"> 
                    Image <strong class=\"ppy-current\"></strong> of <strong class=\"ppy-total\"></strong> 
                </div> 
                <span class=\"ppy-text\"></span> 
            </div> 
        </div>";
		
	return $data;
}
add_shortcode("slider","createSliderWidget");



function createItem($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "src" => ''
	    ), $atts)); 
	$content = do_shortcode($content);	
	$tab = "<a href=\"{$src}\">
			  <img src=\"{$src}\" alt=\"$content\">
			</a>";
	return $tab;
}

add_shortcode("item","createItem");

function createGalleria($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "width" => 300,
		"height" => 250
		
	    ), $atts)); 
		
		
	$data = "<div class=\"shortcode_gallery\" style='width:{$width}px;height:{$height}px;'> ".do_shortcode($content)."</div>";
		
	return $data;
}
add_shortcode("galleria","createGalleria");