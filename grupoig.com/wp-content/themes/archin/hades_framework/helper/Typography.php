<?php
/*
File to include custom font settings and other typographic related functions.


*/

if(is_admin())
return;

$font_option = (!get_option("arc_toggle_custom_font")) ? "Google Webfonts" : get_option("arc_toggle_custom_font");
$blurb_font = get_option('arc_blurb_font');
if($font_name=="")
		$font_name = "Droid";



 switch($blurb_font)
		 {
			case "Droid": $mainfont = "http://fonts.googleapis.com/css?family=Droid+Serif" ;
						  $bcode  =  "font-family: 'Droid Serif', arial, serif;";
			 break;
			case "Kreon" : $mainfont = "http://fonts.googleapis.com/css?family=Kreon"; $bcode ="font-family: 'Kreon', arial, serif;" ; break;
			case "Dancing Script" : $mainfont = "http://fonts.googleapis.com/css?family=Dancing+Script"; $bcode = "font-family: 'Dancing Script', arial, serif;"; break;
			
			case "Gruppo" : $mainfont = "http://fonts.googleapis.com/css?family=Gruppo"; $bcode = "font-family: 'Gruppo', arial, serif;" ; break;
			case "Cousine" :$mainfont = "http://fonts.googleapis.com/css?family=Cousine"; $bcode = "font-family: 'Cousine', arial, serif;";  break;
			case "Cabin" : $mainfont ="http://fonts.googleapis.com/css?family=Cabin:bold" ; $bcode = "font-family: 'Cabin', arial, serif;"; break; 
			case "Copse" :$mainfont ="http://fonts.googleapis.com/css?family=Copse" ; $bcode ="font-family: 'Copse', arial, serif;";  break;
			case "Droid Mono" : $mainfont = "http://fonts.googleapis.com/css?family=Droid+Sans+Mono"; $bcode =  "font-family: 'Droid Sans Mono', arial, serif;"; break;
			case "Cuprum" :$mainfont ="http://fonts.googleapis.com/css?family=Cuprum" ; $bcode = "font-family: 'Cuprum', arial, serif;";  break;
			case "Inconsolata":$mainfont ="http://fonts.googleapis.com/css?family=Inconsolata" ; $bcode =  "font-family: 'Inconsolata', arial, serif;";  break;
			case "Cantarell" :$mainfont = "http://fonts.googleapis.com/css?family=Cantarell"; $bcode = "font-family: 'Cantarell', arial, serif;";  break;
			case "Lobster" :$mainfont ="http://fonts.googleapis.com/css?family=Lobster" ; $bcode = "font-family: 'Lobster', arial, serif;";  break;
			case "Droid Sans" : $mainfont ="http://fonts.googleapis.com/css?family=Droid+Sans" ; $bcode ="font-family: 'Droid Sans', arial, serif;" ; break; 
			case "Yanone Kaffeesatz" : $mainfont =  "http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz"; $bcode = "font-family: 'Yanone Kaffeesatz', arial, serif;"; break;
			case "Josefin Slab" : $mainfont = "http://fonts.googleapis.com/css?family=Josefin+Slab"; $bcode = "font-family: 'Josefin Slab', arial, serif;"; break; 
			case "Josefin Sans" : $mainfont = "http://fonts.googleapis.com/css?family=Josefin+Sans"; $bcode = "font-family: 'Josefin Sans', arial, serif;"; break; 
			case "Terminal Dosis Light" : $mainfont = "http://fonts.googleapis.com/css?family=Terminal+Dosis+Light"; $bcode = "font-family: 'Terminal Dosis Light', arial, serif;"; break; 
			case "PT Sans Narrow" :$mainfont = "http://fonts.googleapis.com/css?family=PT+Sans+Narrow"; $bcode = "font-family: 'PT Sans Narrow', arial, serif;";  break;
		}
	 wp_enqueue_style("blurbfont",$mainfont);	
function addblurbingstyle()
 {
	global $bcode;
	 $style = "<style type='text/css'>
		 
		
		
		.blurb p { $bcode }
		 
		 </style> ";
	 echo $style;
 }
 
 add_action("wp_head","addblurbingstyle"); 		
		

$mainfont = '';
$fcode = 'no font';

if($font_option=="Google Webfonts") :

		$font_name = get_option('arc_custom_font');
		if($font_name=="")
		$font_name = "Droid";
		 
		 switch($font_name)
		 {
			case "Droid": $mainfont = "http://fonts.googleapis.com/css?family=Droid+Serif" ;
						  $fcode  =  "font-family: 'Droid Serif', arial, serif;";
			 break;
			case "Kreon" : $mainfont = "http://fonts.googleapis.com/css?family=Kreon"; $fcode ="font-family: 'Kreon', arial, serif;" ; break;
			case "Dancing Script" : $mainfont = "http://fonts.googleapis.com/css?family=Dancing+Script"; $fcode = "font-family: 'Dancing Script', arial, serif;"; break;
			
			case "Gruppo" : $mainfont = "http://fonts.googleapis.com/css?family=Gruppo"; $fcode = "font-family: 'Gruppo', arial, serif;" ; break;
			case "Cousine" :$mainfont = "http://fonts.googleapis.com/css?family=Cousine"; $fcode = "font-family: 'Cousine', arial, serif;";  break;
			case "Cabin" : $mainfont ="http://fonts.googleapis.com/css?family=Cabin:bold" ; $fcode = "font-family: 'Cabin', arial, serif;"; break; 
			case "Copse" :$mainfont ="http://fonts.googleapis.com/css?family=Copse" ; $fcode ="font-family: 'Copse', arial, serif;";  break;
			case "Droid Mono" : $mainfont = "http://fonts.googleapis.com/css?family=Droid+Sans+Mono"; $fcode =  "font-family: 'Droid Sans Mono', arial, serif;"; break;
			case "Cuprum" :$mainfont ="http://fonts.googleapis.com/css?family=Cuprum" ; $fcode = "font-family: 'Cuprum', arial, serif;";  break;
			case "Inconsolata":$mainfont ="http://fonts.googleapis.com/css?family=Inconsolata" ; $fcode =  "font-family: 'Inconsolata', arial, serif;";  break;
			case "Cantarell" :$mainfont = "http://fonts.googleapis.com/css?family=Cantarell"; $fcode = "font-family: 'Cantarell', arial, serif;";  break;
			case "Lobster" :$mainfont ="http://fonts.googleapis.com/css?family=Lobster" ; $fcode = "font-family: 'Lobster', arial, serif;";  break;
			case "Droid Sans" : $mainfont ="http://fonts.googleapis.com/css?family=Droid+Sans" ; $fcode ="font-family: 'Droid Sans', arial, serif;" ; break; 
			case "Yanone Kaffeesatz" : $mainfont =  "http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz"; $fcode = "font-family: 'Yanone Kaffeesatz', arial, serif;"; break;
			case "Josefin Slab" : $mainfont = "http://fonts.googleapis.com/css?family=Josefin+Slab"; $fcode = "font-family: 'Josefin Slab', arial, serif;"; break; 
			case "Josefin Sans" : $mainfont = "http://fonts.googleapis.com/css?family=Josefin+Sans"; $fcode = "font-family: 'Josefin Sans', arial, serif;"; break; 
			case "Terminal Dosis Light" : $mainfont = "http://fonts.googleapis.com/css?family=Terminal+Dosis+Light"; $fcode = "font-family: 'Terminal Dosis Light', arial, serif;"; break; 
			case "PT Sans Narrow" :$mainfont = "http://fonts.googleapis.com/css?family=PT+Sans+Narrow"; $fcode = "font-family: 'PT Sans Narrow', arial, serif;";  break;
		}
 
  wp_enqueue_style("webfont",$mainfont);
  

function addcustomheadingstyle()
 {
	global $fcode;
	 $style = "<style type='text/css'>
		 
		
		
		.custom-font { $fcode }
		 
		 </style> ";
	 echo $style;
 }
 
 add_action("wp_head","addcustomheadingstyle"); 
 
 
 elseif($font_option=="Cufon") :
 
 $font_name = (get_option("arc_cufon_font")=="") ? "Androgyne" : get_option("arc_cufon_font") ;
 
 $c_check = substr ($font_name,0,7);
 if($c_check=="custom_")
 $font_name = "uploaded/".$font_name;
 else
 $font_name = $font_name.".font.js";
 
 wp_enqueue_script("cufon", URL . "/js/cufon-yui.js", array('jquery'), "2.0");
 wp_enqueue_script("cufon-font", URL . "/js/cufon-fonts/$font_name", array('cufon'), "2.0");
 
 function addcufonscripts()
 {
	
	 $script = "<script type='text/javascript'>
		 
		
		
		Cufon.replace('.custom-font');
		 
		 </script> ";
	 echo $script;
 }
 
 if(!is_admin())
 add_action("wp_head","addcufonscripts"); 


 endif;
 
  