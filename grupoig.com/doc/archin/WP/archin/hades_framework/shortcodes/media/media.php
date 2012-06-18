<?php

function createYoutube($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "width" => "300",
		"height" => "250",
		"id" => '' ,
		
    ), $atts)); 
	
	
	
	$temp = "<iframe title=\"YouTube video player\" width=\"{$width}\" height=\"{$height}\" src=\"http://www.youtube.com/embed/{$id}?rel=0\" frameborder=\"0\" allowfullscreen></iframe>";
  
	
	return $temp;
}


add_shortcode("youtube","createYoutube");



function createVimeo($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "width" => "300",
		"height" => "250",
		"id" => '' ,
		
    ), $atts)); 
	
	
	
	$temp = "<iframe title=\"Vimeo video player\" width=\"{$width}\" height=\"{$height}\" src=\"http://player.vimeo.com/video/{$id}\" frameborder=\"0\" ></iframe>";
  
	
	return $temp;
}


add_shortcode("vimeo","createVimeo");

function createImageBox($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "align" => 'none' ,
		"class"=> '',
		"id" => '' ,
		"caption" => "",
		"src"=>'',
		"width"=>"300",
		"height"=>"300"
    ), $atts)); 
	
	$content = do_shortcode($content);
	if($id!="")
	$id='id = "$id" ';
	if($caption!="")
	$caption = "<span class='caption'>".$caption."<span>";
	
	$temp = "<div class='image-wrapper $class' $id style='float:$align'> <img src='$src' alt='image' width='{$width}'  height='{$height}' /> $caption </div> ";
	

	
	return $temp;
}

add_shortcode("imagewrapper","createImageBox");