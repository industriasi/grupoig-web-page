<?php


function createTab($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => 'Tab title'
	    ), $atts)); 
	$content = do_shortcode($content);	
	$tab = $title." <hades> ".$content ."<tabend>";
	return $tab;
}

add_shortcode("tab","createTab");
function createTestimonial($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "name" => ''
	    ), $atts)); 
	// $content = do_shortcode($content);	
	$tab = " <li> <p>".$content ."</p> <span> $name </span></li>";
	return $tab;
}


function createTestimonials($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => "Testimonials"
	    ), $atts)); 
	 $content = do_shortcode($content);	
	$tab = "<div class='testimonials-wrapper'><h4 class='custom-font'>{$title}</h4><a href='#' class='scrollable-next' ></a> <a href='#' class='scrollable-prev' ></a> <div class='testimonials'><ul class='items'>".$content ."</ul></div></div>";
	return $tab;
}


add_shortcode("testimonial","createTestimonial");
add_shortcode("testimonials","createTestimonials");

function createSuperWidget($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => 'Sidebar title',
		"id" => ''
	    ), $atts)); 
		
	ob_start();
	dynamic_sidebar($id);
	$data = ob_get_contents();
	ob_end_clean();
	ob_end_flush();
			
			
	return $data;
}

add_shortcode("superwidget","createSuperWidget");



function createTabWidget($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => 'Tab title'
	    ), $atts)); 
		
	$data = explode("<tabend>",do_shortcode($content));
	array_pop($data);
	$i =0;

    $titles = array();
	$contents = array();
	for($i=0;$i<count($data);$i++)
	{
		
			$temp = explode("<hades>",$data[$i]);
			$titles[$i] = $temp[0]; 
			$contents[$i] = $temp[1];
		
	}

   $tab = "<div class='shortcodes-tabs'><ul>";
   
	for($i=0;$i<count($titles);$i++)
	$tab = $tab."<li><a href='#shortcodetabs-{$i}'> $titles[$i] </a></li>";
	
	$tab = $tab."</ul>";
	
	for($i=0;$i<count($contents);$i++)
	$tab = $tab."<div id='shortcodetabs-{$i}'> $contents[$i] </div>	";
	  
	  
   $tab = $tab."</div>";
	
	return $tab;
}
add_shortcode("tabs","createTabWidget");


function createSection($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => 'Tab title'
	    ), $atts)); 
		$content = do_shortcode($content);
	$tab =  "<h3><a href=\"#\" >$title</a></h3>	<div> $content 	</div>";
	return $tab;
}

add_shortcode("section","createSection");

function createAccordion($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"width"=>"100%"
	    ), $atts)); 
		
	$data = do_shortcode($content);
	$data = "<div class='shortcodes-accordion' style='width:$width'> $data </div>";

	return $data;
}
add_shortcode("accordion","createAccordion");


function createToggleBox($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => 'Box title',
		"width"=>"100%"
	    ), $atts)); 
		
	$data = do_shortcode($content);
	$data = "<div class='shortcodes-togglebox' style='width:$width'> <div class='toggletitle shortcodes-slidedown custom-font'> $title </div>  <div class='togglecontent'>  $data  </div></div>";

	return $data;
}
add_shortcode("toggle","createToggleBox");

function createPieChart($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => 'PieChart title',
		"width"=>"250",
		"height" => "100",
		"values" => "30,50,20",
		"labels" => "Label 1, Label 2,Label 3"
		
	    ), $atts)); 
		
		$labels = str_replace(",","|",$labels);
	
	$data = "<img src=\"https://chart.googleapis.com/chart?chs={$width}x{$height}&amp;chd=t:{$values}&amp;cht=p3&amp;chl={$labels}\" />.";

	return $data;
}
add_shortcode("pie","createPieChart");


function createLineChart($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => 'LineChart title',
		"width"=>"250",
		"height" => "100",
		"values" => "30,50,20",
		"labels" => "Label 1, Label 2,Label 3"
		
	    ), $atts)); 
		
		$labels = str_replace(",","|",$labels);
	
	$data = "<img src=\"https://chart.googleapis.com/chart?chs={$width}x{$height}&amp;chd=t:{$values}&amp;cht=lc&amp;chl={$labels}\" />.";

	return $data;
}
add_shortcode("line","createLineChart");

function createBarChart($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => 'BarChart title',
		"width"=>"250",
		"height" => "100",
		"values" => "30,50,20,100,10,23,45,45",
		"labels" => "Label 1, Label 2,Label 3"
		
	    ), $atts)); 
		
		$labels = str_replace(",","|",$labels);
	
	$data = "<img src=\"https://chart.googleapis.com/chart?chs={$width}x{$height}&amp;chd=t:{$values}&amp;cht=bvg&amp;chl={$labels}\" />.";

	return $data;
}
add_shortcode("bar","createBarChart");



//Google Maps Shortcode
function fn_googleMaps($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '300',
      "height" => '250',
      "src" => ''
   ), $atts));
   return "<iframe width='{$width}' height=\"{$height}\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"{$src}&amp;output=embed\"></iframe><br /><small><a href=\"{$src}\" style=\"color:#0000FF;text-align:left\">View Larger Map</a></small>";
}
add_shortcode("googlemap", "fn_googleMaps");


function createCalendar($atts, $content = null) {

   return "<div class='shortcode-calendar'></div>";
}
add_shortcode("calendar", "createCalendar");



