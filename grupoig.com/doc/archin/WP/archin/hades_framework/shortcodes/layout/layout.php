<?php

/* ============================================ */
/* ================= Column =================== */
/* ============================================ */



function createfull_width($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
		
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearfix full_width' $id> $data </div>";

	return $data;
}
add_shortcode("full_width","createfull_width");

/*

function createColumn($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
		
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearfix hlayout' $id> $data </div>";

	return $data;
}
add_shortcode("columns","createColumn");

*/

/* ============================================ */
/* ================= Layouts =================== */
/* ============================================ */


// 4/5 default

function createfour_fifth($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearfix four-fifth' $id> $data </div>";

	return $data;
}
add_shortcode("four_fifth","createfour_fifth");



function createfour_fifth_last($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearright clearfix four-fifth' $id> $data </div> <div class='clearfix'></div>";

	return $data;
}
add_shortcode("four_fifth_last","createfour_fifth_last");


// 1/5


function createonefifth($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
	
	$data = do_shortcode($content);
	$data = "<div class='$class clearfix one-fifth' $id> $data </div>";

	return $data;
}
add_shortcode("one_fifth","createonefifth");


function createonefifth_last($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
	
	$data = do_shortcode($content);
	$data = "<div class='$class clearright clearfix one-fifth' $id> $data </div><div class='clearfix'></div>";

	return $data;
}
add_shortcode("one_fifth_last","createonefifth_last");



function createone_fourth($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
		
	if($id!="")
	$id='id = "$id" ';	
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearfix one-fourth' $id> $data </div>";

	return $data;
}
add_shortcode("one_fourth","createone_fourth");

function createone_fourth_last($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
		
	if($id!="")
	$id='id = "$id" ';	
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearright clearfix one-fourth' $id> $data </div><div class='clearfix'></div>";

	return $data;
}
add_shortcode("one_fourth_last","createone_fourth_last");



function createone_half($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearfix half-col' $id> $data </div>";

	return $data;
}
add_shortcode("one_half","createone_half");


function createone_half_last($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearright clearfix half-col' $id> $data </div><div class='clearfix'></div>";

	return $data;
}
add_shortcode("one_half_last","createone_half_last");


function createone_third($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearfix one-third' $id> $data </div>";

	return $data;
}
add_shortcode("one_third","createone_third");


function createone_third_last($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearright clearfix one-third' $id> $data </div><div class='clearfix'></div>";

	return $data;
}
add_shortcode("one_third_last","createone_third_last");


function createthree_fourth($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearfix three-fourth' $id> $data </div>";

	return $data;
}
add_shortcode("three_fourth","createthree_fourth");

function createthree_fourth_last($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearright clearfix three-fourth' $id> $data </div><div class='clearfix'></div>";

	return $data;
}
add_shortcode("three_fourth_last","createthree_fourth_last");



function createtwo_third($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearfix two-third' $id> $data </div>";

	return $data;
}
add_shortcode("two_third","createtwo_third");

function createtwo_third_last($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "class" => '',
		"id"=>""
	    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
		
	$data = do_shortcode($content);
	$data = "<div class='$class clearright clearfix two-third' $id> $data </div><div class='clearfix'></div>";

	return $data;
}
add_shortcode("two_third_last","createtwo_third_last");