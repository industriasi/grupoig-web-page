<?php 

function createFormat($atts,$content)
{
	extract(
	shortcode_atts(array(  
        
		"class"=> '',
		"id" => '' ,
		
    ), $atts)); 
	
	
	if($id!="")
	$id=' id = "$id"';
	
	$temp = "<p class='$class formatter' $id > $content </p>";
    
	
	return $temp;
}
add_shortcode("format","createFormat");

function createPreStyle($atts,$content)
{
	extract(
	shortcode_atts(array(  
      
		"class"=> '',
		"id" => '' ,
		
    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
	
	$temp = "<pre class='$class ' $id> $content </pre>";

	
	return $temp;
}


add_shortcode("pre","createPreStyle");

function createQuotes($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"class"=> '',
		"id" => '' ,
		
    ), $atts)); 
	if($id!="")
	$id='id = "$id" ';
	$content = do_shortcode($content);
	
	$temp = "<blockquote class='blockcode-center $class' $id> $content </blockquote>";

	
	return $temp;
}

function createQuotesLeft($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"class"=> '',
		"id" => '' ,
		
    ), $atts)); 
	
	
	if($id!="")
	$id='id = "$id" ';
	$temp = "<blockquote class='blockcode-left $class' $id> $content </blockquote>";

	
	return $temp;
}

function createQuotesRight($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"class"=> '',
		"id" => '' ,
		
    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
	
	$temp = "<blockquote class='blockcode-right $class' $id> $content </blockquote>";

	
	return $temp;
}

add_shortcode("quotes","createQuotes");
add_shortcode("quotes_left","createQuotesLeft");
add_shortcode("quotes_right","createQuotesRight");


function createDropcaps($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "style" =>"style1",
		"class"=> '',
		"id" => '' ,
		
    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
	if(is_single()||is_page())
	$temp = "<span class='$class dropcaps-{$style} custom-font' $id> $content </span>";
    else
	return $content;
	
	return $temp;
}


add_shortcode("caps","createDropcaps");

function createCustomFont($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"class"=> '',
		"id" => '' ,
		
    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
	
	$temp = "<div class='$class custom-font' $id> $content </div>";
  
	
	return $temp;
}


add_shortcode("custom_font","createCustomFont");



function createHighlight($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"style"=> 'style1',
		
		
    ), $atts)); 
	

	
	$temp = "<span class='{$style}-highlight-text'> $content </span>";
  
	
	return $temp;
}


add_shortcode("highlight","createHighlight");

