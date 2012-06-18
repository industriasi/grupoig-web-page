<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        
        <title><?php
	    
		 $body_font = get_option("arc_body_font");
		 
		 $body_font_color = get_option("arc_font_color");
		 $body_font_color = (!$body_font_color) ? "888888" : $body_font_color; 
		 
		 $link_font_color = get_option("arc_link_font_color");
		 $link_font_color = (!$link_font_color) ? "888888" : $link_font_color; 
		 
		 $link_hover_font_color = get_option("arc_link_hover_font_color");
		 $link_hover_font_color = (!$link_hover_font_color) ? "888888" : $link_hover_font_color; 
		  
	    $body_font = ($body_font == "") ? 'Arial' : $body_font;
	  
	
	  
	  if($body_font=="Lucida Sans")
	  $body_font = "Lucida";
	  switch($body_font)
	  {
		  case "PT Sans": $body_font_script = "http://fonts.googleapis.com/css?family=PT+Sans"; 
		                  $body_code= "font-family: 'PT Sans', arial, serif"; $body_font = "custom_body_font"; break;
		  case "Arimo"  : $body_font_script = "http://fonts.googleapis.com/css?family=Arimof" ;  
		                   $body_code= "font-family: 'Arimo', arial, serif";  $body_font = "custom_body_font"; break;
		  case "Crimson": $body_font_script = "http://fonts.googleapis.com/css?family=Crimson+Text" ;
		                   $body_code= "font-family: 'Crimson Text', arial, serif";  $body_font = "custom_body_font";  break;
		  case "Droid Serif": $body_font_script = "http://fonts.googleapis.com/css?family=Droid+Serif" ;
		                       $body_code= "font-family: 'Droid Serif', arial, serif";  $body_font = "custom_body_font"; break;
		  case "Droid Sans" :  $body_font_script = "http://fonts.googleapis.com/css?family=Droid+Sans" ;
		                       $body_code= "font-family: 'Droid Sans', arial, serif"; $body_font = "custom_body_font";  break;
	  }
	   if($body_font == "custom_body_font")
	   wp_enqueue_style("webfont-body",$body_font_script);
	   
		$logo = (get_option("arc_logo") == "") ? URL.'/sprites/i/logo.png' : get_option("arc_logo");
		$favico =  (get_option("arc_favico") == "") ? URL.'/images/favicon.ico' : get_option("arc_favico");
		
					  if(is_home()) {
					        echo bloginfo(__('name') , 'h-framework' );
					  } elseif(is_category()) {
					         _e('Browsing the Category ' , 'h-framework' );
					          wp_title(' ', true, '');
					  } elseif(is_archive()){
					       
					        wp_title(__(' ' , 'h-framework'), true,__( '' , 'h-framework') );
					  } elseif(is_search()) {
					          _e( 'Search Results for "'.$s.'"' , 'h-framework' );
					  } elseif(is_404()) {
					          _e( '404 - Page got lost!'  , 'h-framework');
					  } else {
					        bloginfo(__('name' , 'h-framework')); wp_title(__('-' , 'h-framework'), true, '');
					  }
?></title>
        
         <link href="<?php echo URL."/style.css"; ?>" rel="stylesheet" type="text/css" /><!-- Stylesheet  -->
       <?php include(HPATH."/helper/dynamic.php"); ?><!-- Dynamic Stylesheet  -->
        <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" /><!-- Feed  -->
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="shortcut icon" href="<?php echo $favico; ?>" />
    
       

       <?php if ( is_singular() && get_option( 'thread_comments' ) )
		      wp_enqueue_script( 'comment-reply' );
		     wp_head(); ?>
        
      <!--[if IE 8]>
            <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/ie8.css" />
        <![endif]-->
      <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/ie7.css" />
        <![endif]-->  
      <?php 
	 
	   echo "<style type='text/css'> \n";
	   
	    if($body_font == "custom_body_font")
	  echo ".custom_body_font  {   $body_code   } "; 
	  
	   echo "    body { color:#{$body_font_color}; } 
		   
		   a { color:#{$link_font_color}; }
		   a:hover { color:#{$link_hover_font_color}; }  ";
		echo "    </style>";
	  ?>
</head>
 
<body class="<?php echo  $body_font; ?>">



<div id="top-bar" class="clearfix" >
    <div class="container">
	     <a href="<?php echo home_url(); ?>" id="logo"><img src="<?php echo $logo; ?>" alt="logo" /></a>
       
            
        <?php 
				if(function_exists("wp_nav_menu"))
				{
					wp_nav_menu(array(
								'theme_location'=>'primary_nav',
								'container'=>'',
								'depth' => 3,
								'menu_id' => 'menu',
								'walker' => new H_Menu_Frontend() )
								);
				}
			?>
     
       
    </div>
 </div>
 
