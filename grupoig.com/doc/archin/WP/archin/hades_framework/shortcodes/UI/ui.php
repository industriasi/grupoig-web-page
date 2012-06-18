<?php
function add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
     add_filter('mce_buttons', 'register_button');  
   }  
}  

function register_button($buttons) {
   array_push($buttons, "button");
   return $buttons;
}
function add_plugin($plugin_array) {
   $plugin_array['button'] = HURL.'/shortcodes/js/customcodes.php';
   return $plugin_array;
}


add_action('init', 'add_button');  


function createAction($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "link" => '' ,
		"class"=> '',
		"id" => '' ,
		"buttontitle" => 'ACTION BUTTON' ,
		"width" => "650px"
    ), $atts)); 
	
	$content = do_shortcode($content);
	if($id!="")
	$id='id = "$id" ';
	
	$temp = "<div class='action-box clearfix $class' $id style='width:$width'><a href='$link' class='action'>$buttontitle</a><p> $content </p></div>";
	
	return $temp;
}

add_shortcode("action","createAction");


function createBox($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "type" => 'error' ,
		"class"=> '',
		"id" => '' ,
		"title" => 'Box' ,
		"width" => "600px"
    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
	
	$content = do_shortcode($content);
	$button = "<div class='$type-box $class' $id style='width:$width'>";
	
	if($title!="")
	$button = $button . "<h4> $title </h4> ";
	
	$button = $button."<p> $content </p> </div>";
	
	return $button;
}

add_shortcode("box","createBox");

function createButton($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "to" => '' ,
		"class"=> '',
		"id" => '' ,
		"color" => '#fff',
		'bg_color'=>'#282d35',
		'style' => 'default' ,
		'border_radius' => '2'
    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
	 
	 

    $border_color = $bg_color;
	$border_radius = $border_radius.'px';
	
	$code = "style=' color: {$color}; background-color:{$bg_color}; border-radius:{$border_radius}; -moz-border-radius:{$border_radius}; border:1px solid {$border_color}; '";
	
	$button = "<a $code   href='$to' class=' button-{$style} $class' $id> $content </a>";
	
	
	return $button;
}

add_shortcode("button","createButton");

function createList($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "style" => 'style1' ,
		"class"=> '',
		"id" => '' ,
		"color" => 'blue' 
    ), $atts)); 
	$content = do_shortcode($content);
	if($style!="style1")
	$color = '';
	else
	$style='';
	
	if($id!="")
	$id='id = "$id" ';
	
	return "<div class='$style $class list{$color} styled' $id>$content</div>";
}

add_shortcode("list","createList");


function createSeparator($atts)
{
	extract(
	shortcode_atts(array(  
        "class"=>"narrow",
		"width" => "100%"
    ), $atts)); 
	
	if($class=="narrow")
	$class = "separator-narrow";
	else
	$class = "separator-full";
	

	$temp = "<p class='separator {$class} clearfix clearleft' ></p>";
   
	
	return $temp;
}

add_shortcode("separator","createSeparator");

function createLinkSeparator($atts,$content)
{
	extract(
	shortcode_atts(array(  
       "class"=>"narrow",
		"width" => "100%"
    ), $atts)); 
	
	if($class=="narrow")
	$class = "separator1-narrow";
	else
	$class = "separator1-full";
	
	
    $temp = "<p class='separator1 clearfix $class '><a href='#'>Top</a></p>";
 
	
	return $temp;
}

add_shortcode("separator1","createLinkSeparator");

function createTable($atts,$content)
{
	
	return "<div class='styled-table'>$content</div>";
}

add_shortcode("styledTable","createTable");


function createBigButtons($atts,$content)
{
	
	
	extract(
	shortcode_atts(array(  
        "to" => '' ,
		"class"=> '',
		"id" => '' ,
		"color" => 'blue' 
    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
	
	$button = "<a href='$to' class='{$color}-bigroundbutton $class clearfix' $id><img src='".get_bloginfo('template_url')."/hades_framework/shortcodes/css/i/rbig{$color}-begin.png' alt='button' /> $content</a>  ";
	
	
	return $button;
}

add_shortcode("bigbutton","createBigButtons");


function createRoundedButtons($atts,$content)
{
	
	
	extract(
	shortcode_atts(array(  
        "to" => '' ,
		"class"=> '',
		"id" => '' ,
		"color" => 'blue' 
    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
	
	$button = "<a href='$to' class='{$color}-roundbutton $class clearfix' $id><img src='".get_bloginfo('template_url')."/hades_framework/shortcodes/css/i/r{$color}-begin.png' alt='button' /> $content</a>  ";
	
	
	return $button;
}

add_shortcode("roundbutton","createRoundedButtons");
