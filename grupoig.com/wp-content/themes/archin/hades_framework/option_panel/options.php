<?php 

/* 

======================================================================================
------------------------------- Hades Option Panel -----------------------------------
======================================================================================

Version 1.0 
Current Elements - text, textarea, checkbox, toggle button, slider, color picker, drop down lists.
Sub Panel Activated - True
======================================================================================

*/
$cfonts = get_option("archin_custom_fonts",array());
$cufon_fonts = array("Acid","Aller","Champagne__Limousines","Colaborate","Delicious","DistrictThin","Droid_Serif","GeosansLight","Lobster","Nobile","Quicksand","Ubuntu","Yanone_Kaffeesatz");

 
 if(is_array($cfonts))
	foreach($cfonts as $font)
	{
		$cufon_fonts[] = $font;
	}


$options = array (
 

  // ====================================== General Theme options [ Tab 1] ======================================

	array( 
		    "name" => "General",
	  	    "type" => "section"
		  ),
		  
	array( 
			"name" => $themename." Options",
			"type" => "information",
			"description" => "In this option panel your able to change the basic setting of Ambience. Just follow the info besides the functions and you will be ready in a snap."
		  ),
		  
	array( "type" => "open"), 
	
  // ======================================Sub Panel 1 Begins ======================================
 
				array(
						"name" => "&rarr; Basic" , 
						"type"=>"subtitle", 
						"id"=>"colorschemes"
					  ), 
			   
			 	array( 
						"name" => "Logo URL",
						"desc" => "Upload your logo. Please keep the dimensions 195x92. ",
						"id" => $shortname."_logo",
						"type" => "upload",
						"std" => URL."/sprites/i/logo.png"
					),
			
				
				array( 
						"name" => "Fav ICO",
						"desc" => "Upload your favicon.",
						"id" => $shortname."_favico",
						"type" => "upload",
						"std" => URL."/images/favico.ico"
					),	
					/*
			   array( 
						"name" => "Styles",
						"desc" => ".",
						"id" => $shortname."_stylesheet",
						"type" => "select",
						"options" => array("style.css","style1.css", "style2.css", "style3.css", "style4.css", "style5.css", "style6.css", "style7.css", "style8.css", "style9.css", "style10.css", "style11.css", "style12.css", "style13.css", "style14.css", "style15.css", "style16.css", "style17.css", "style18.css", "style19.css", "style20.css"),
						"std" => "style.css"
					  ),
					  */
					   
			 	array( 
						"name" => "Feedburner URL",
						"desc" => "Add the url from your FeedBurner account in here.",
						"id" => $shortname."_feedburner",
						"type" => "text",
						"std" => "http://feeds.feedburner.com/yourID"
					),
					
				array( 
						"name" => "FeedBurner Email URL",
						"desc" => "Add the url from your FeedBurners email subscription settings in here so visitors can subscribe to your site.",
						"id" => $shortname."_feedburner_email",
						"type" => "text",
						"std" => "http://feedburner.google.com/fb/a/mailverify?uri=yourID"
					),
					
				
				  array( "name" => "Google API Key",
					"desc" => "Required for the Smart Sense url shortener to work. For more details <a href='http://code.google.com/apis/loader/signup.html'>visit</a> Google for more info about there API",
					"id" => $shortname."_api_key",
					"type" => "text",
					"std" =>  "" ),		
					
				  array( "name" => "ReCaptacha Public Key",
					"desc" => "Required for the captcha to work, get your key from <a href='http://www.google.com/recaptcha/whyrecaptcha'>here</a>",
					"id" => $shortname."_captcha_public_key",
					"type" => "text",
					"std" =>  "" ),		
				
				   array( "name" => "ReCaptacha Private Key",
					"desc" => "Required for the captcha to work, get your key from <a href='http://www.google.com/recaptcha/whyrecaptcha'>here</a>",
					"id" => $shortname."_captcha_private_key",
					"type" => "text",
					"std" =>  "" ),				
				
			
					
					
					  
							
				array("type"=>"close_subtitle"),
				
 // ================================ End of Sub panel ==============================================
  // ======================================Sub Panel 2 Begins ======================================				
				/*
				array(
						"name" => "Background" , 
						"type"=>"subtitle" , 
						"id"=>"pagebackground"
						),	
				
				  array( 
					  "name" => "Enable/Disable Background Color",
					  "desc" => "Enable or disable the background function color here.",
					  "id" => $shortname."_bg_color_toggle",
					  "type" => "toggle",
					  "std" => "false"
					),
				
				   array( 
						"name" => "Background color",
						"desc" => "When enabled select your background color here.",
						"id" => $shortname."_bg_color",
						"type" => "colorpickerfield",
						"std" => ""
					),	

					array( 
						"name" => "Background Image",
						"desc" => "Select your background image here, this image will be blended in the background color.",
						"id" => $shortname."_bg_image_option",
						"type" => "select",
						"options" => array("Image1","Image2", "Image3", "Image4"),
						"std" => "Image1"
					  ),
					  
					 array( 
					  "name" => "Custom Image Background Upload",
					  "desc" => "Want your own background image instead of using a preset one, enable it here.",
					  "id" => $shortname."_bg_image_toggle",
					  "type" => "toggle",
					  "std" => "false"
					),	
					
					 array( 
					  "name" => "Upload Background Image",
					  "desc" => "Ad the background image in here when you've enabled this function. 1920x1200 for full effect.",
					  "id" => $shortname."_bg_image",
					  "type" => "upload",
					  "std" => ""
					),
					  
					  array( 
						"name" => "Background Image Scale",
						"desc" => "Enable/Disable if your background image should fit the browser window or stay fixed",
						"id" => $shortname."_bg_image_scale",
						"type" => "toggle",					
						"std" => "true"
					  ),	  
				
				
						
			
				array("type"=>"close_subtitle"),
				*/
  // ======================================Sub Panel 2 Begins ======================================				
				array(
						"name" => "&rarr; Footer" , 
						"type"=>"subtitle" , 
						"id"=>"subfooter"
						),	
				
				array( 
						"name" => "Footer Columns",
						"desc" => "Set the number of columns you want inside the footer area.",
						"id" => $shortname."_footer_columns",
						"type" => "select",
						"options" => array("4 Columns","3 Columns",  "2 Columns"),
						"std" => "4 Columns"
					  ),		
	
				array( 
						"name" => "Google Analytics Code",
						"desc" => "Add your Google Analytics code in here, it will be added at bottom of body tag, do not include &lt;script tags.",
						"id" => $shortname."_ga",
						"type" => "textarea",
						"std" => ""
						),		
                array( 
						"name" => "Bottom footer text",
						"desc" => "This text will appear at the bottom of the footer",
						"id" => $shortname."_footer_bottom_text",
						"type" => "text",
						"std" => ""
					),
				array("type"=>"close_subtitle"),

              	  
 // ================================ End of Sub panel ==============================================	
	array( "type" => "close"),


  // ======================================Tab 2 Begins ======================================			
 
 	array( 
			"name" => "Homepage",
			"type" => "section"
		  ),
		  
	array( 
			"name" => $themename." Options",
			"type" => "information",
			"description" => "In this option panel your able to change the slider settings of Ambience. Some cool options to chose from here and especially the Picemaker2 Slider is a cool addition."
		  ),
	
	array( "type" => "open"),
	
   // ======================================Sub Panel 1 Begins ======================================			
				array(
							"name" => "&rarr; Slider" , 
							"type"=>"subtitle", 
							"id"=>"homesliders"
						), // Sub section 1 Title	
				
				array( 
						"name" => "Auto play",
						"desc" => "Want to auto play or not then you can select it here.",
						"id" => $shortname."_auto_feature_slider",
						"type" => "toggle",
						"std" => "true"
					  ),
					  
				array( 
						"name" => "Enable Slider",
						"desc" => "Want a homepage without a slider then disable it here.",
						"id" => $shortname."_enable_feature_slider",
						"type" => "toggle",
						"std" => "true"
					  ),
					  				
				array( "name" => "Slider Type",
					"desc" => "Select the slider type between a html5 slider with 7 effects, jQuery with more then 35 effect and the piecemaker2 slider.",
					"id" => $shortname."_feature_slider",
					"type" => "select",
					"options" => array("Right Image Scroller","Left Image Scroller","Nivo Slider","3D Slider","Accordion","HTML 5 slider","jQuery Slider","Fade","Cubes Grow","Strips alternate","Strips fade","Strips half fade","Red Channel(html5)","Green Channel(html5)","Overlay","Color burn"),
					"std" => "Right Image Scroller"),
				
				array( "name" => "Slider Duration",
					"desc" => "Set the time in between the effects.",
					"id" => $shortname."_feature_slider_duration",
					"type" => "text",
					"std" => "3000"),
					
				array("type"=>"close_subtitle"),	
	// ================================ End of Sub panel ==============================================			
		
	// ======================================Sub Panel 2 Begins ======================================		
                array(
							"name" => "&rarr; action" , 
							"type"=>"subtitle", 
							"id"=>"action"
						), 
			  array("name" => "action text",
				  "desc" => "Enter the text to be displayed in action area",
				  "id" => $shortname."_blurb_text",
				  "type" => "textarea" ),
				  
				  array("name" => "action Link",
				  "desc" => "Enter the link for the action button",
				  "id" => $shortname."_blurb_link",
				  "type" => "text" ),
				  
				  array("name" => "action Label",
				  "desc" => "Enter the label for the action button",
				  "id" => $shortname."_blurb_label",
				  "type" => "text" ),
          array("type"=>"close_subtitle"),	

	array( "type" => "close"),
	
	// ======================================End of Sub Panel ======================================		

 // ====================================== Tab 3 begins ======================================		
 
 
	 array( "name" => "Blog",
			"type" => "section"),
			array( "name" => $themename."blog",
			"type" => "information",
			"description" => "Enable or Disable social setting, author bio and edit your related posts here."
			),
	array( "type" => "open"),
		array("name" => "&rarr; Posts" , "type"=>"subtitle", "id"=>"postsettings"), // Sub section 1 Title	
	

					  	
	array( 
						"name" => "Show Author BIO",
						"desc" => "Don't you need an Author Bio then just disbale it here.",
						"id" => $shortname."_author_bio",
						"type" => "toggle",
						"std" => "true"
					  ),
					
	array( 
						"name" => "Show Related Posts",
						"desc" => "Want to show your related posts? Then enable them here.",
						"id" => $shortname."_popular",
						"type" => "toggle",
						"std" => "true"
					  ),
					  
	array( 				"name" => "No of posts to be displayed",
						"desc" => "The related post section is using a scroller so you ad as many as you want.",
						"id" => $shortname."_popular_no",
						"type" => "text",
						"std" => "4"),
					
	array( 
						"name" => "Enable Social Set",
						"desc" => "Enable or disable the retweet button below the post.",
						"id" => $shortname."_social_set",
						"type" => "toggle",
						"std" => "true"
					  ),
	
					  								  	
	  array("type"=>"close_subtitle"),
	    array(
						"name" => "&rarr; Social Links" , 
						"type"=>"subtitle", 
						"id"=>"sociallinks"
					  ),
				array( 
						"name" => "Twitter Profile ID",
						"desc" => "Add your twitter profile name to enable tweet button, this is for all twitter related stuff inside the Widgets and SmartSense.",
						"id" => $shortname."_twitter_id",
						"type" => "text",
						"std" => ""
						),	
				array( 
						"name" => "Facebook Fan Page Link",
						"desc" => "Add your Facebook page URL name to enable facebook like, this is for all facebook related stuff inside the Widgets and SmartSense.",
						"id" => $shortname."_fb_id",
						"type" => "text",
						"std" => ""
						),				
               
					  
				array("type"=>"close_subtitle"),
	  
	array( "type" => "close"),
	
   
	 // ====================================== Tab  begins ======================================	
	 array( "name" => "Typography",
			"type" => "section"),
			array( "name" => $themename." theme",
			"type" => "information",
			"description" => "This panel contains the settings of heading and body font sizes and other typography related settings."
			),
	    array( "type" => "open"),
	    
	            array(
						"name" => "&rarr; Font Settings & Color" , 
						"type"=>"subtitle", 
						"id"=>"fontfamily"
					  ), 
	            array( 
						"name" => "Google Webfont or Cufon Font",
						"desc" => "In here your able to switch between Google Fonts and Cufon Fonts.",
						"id" => $shortname."_toggle_custom_font",
						"type" => "select",
						"std" => "Google Webfonts",
						"options" => array( "Google Webfonts","Cufon","None" )
					  ),
					  	
					  
			  array( 
					    "name" => "Google Web Font",
						"desc" => "When you've decided to go for Google Web Fonts then you need to select your font for the headings here.",
						"id" => $shortname."_custom_font",
						"type" => "select",
						"options" =>  array("Droid","Kreon","Dancing Script","Gruppo","Cousine","Cabin","Copse","Droid Mono","Cuprum","Inconsolata","Cantarell","Lobster","Droid Sans","Yanone Kaffeesatz","Josefin Slab","Josefin Sans","Terminal Dosis Light","PT Sans Narrow"),
						"std" => "Droid"
								),
				
			
												
			
			   array( 
						"name" => "Cufon Font",
						"desc" => "When you've decided to go for Cufon Fonts then you need to select your font for the headings here.",
						"id" => $shortname."_cufon_font",
						"type" => "select",
						"options" =>  $cufon_fonts,
						"std" => "Androgyne"
								),					
			  
			  array( 
						"name" => "Body Font",
						"desc" => "Select the main font used all over the site.",
						"id" => $shortname."_body_font",
						"type" => "select",
						"options" => array("Arial", "Georgia" , "Helvetica" ,"Lucida Sans" ,"Tahoma" ,"Verdana" ,"PT Sans","Arimo","Crimson","Droid Serif","Droid Sans" ),
						"std" => "Lucida Sans"
								),
												
			  array( 
						"name" => "Body Font Color",
						"desc" => "Your able to change the color for the body font here.",
						"id" => $shortname."_font_color",
						"type" => "colorpickerfield",
						"std" => "888888"
						),
													
			  array( 
						"name" => "Link Font Color",
						"desc" => "Your able to change the color for the link font here.",
						"id" => $shortname."_link_font_color",
						"type" => "colorpickerfield",
						"std" => "888888"
						),
												
			  array( 
						"name" => "Link Hover Font Color",
						"desc" => "Your able to change the color for the link font on hover here.",
						"id" => $shortname."_link_hover_font_color",
						"type" => "colorpickerfield",
						"std" => "888888"
						),
										
						
			  	 array( 
					    "name" => "Action Box Font",
						"desc" => "font selected here will be applied to intro blurb.",
						"id" => $shortname."_blurb_font",
						"type" => "select",
						"options" =>  array("Droid","Kreon","Dancing Script","Gruppo","Cousine","Cabin","Copse","Droid Mono","Cuprum","Inconsolata","Cantarell","Lobster","Droid Sans","Yanone Kaffeesatz","Josefin Slab","Josefin Sans","Terminal Dosis Light","PT Sans Narrow"),
						"std" => "Droid"
								),
								
	array("type"=>"close_subtitle"),	
		
	
					  			
	array( "type" => "close"),
	
	 // ====================================== Tab  begins ======================================	
	 array( "name" => "Media",
			"type" => "section"),
			array( "name" => $themename." theme",
			"type" => "information",
			"description" => "This tab contains the settings for image related effects. And the Flickr API and Username also has to be filed in here for the Gallery."
			),
	    array( "type" => "open"),
	    
		
	            array(
						"name" => "&rarr; Image effects" , 
						"type"=>"subtitle", 
						"id"=>"imageeffects"
					  ), 
	            
				 array( 
						"name" => "Enable/Disable HTML5 Image effects",
						"desc" => "Select here if you want to use the hmtl5 image effects.",
						"id" => $shortname."_toggle_image_effect",
						"type" => "toggle",
						"std" => "true"
					  ),
				
				 array( 
						"name" => "Invert Effect",
						"desc" => "When Enabled, html5 effect will show by default and fade out on hover.",
						"id" => $shortname."_toggle_image_invert",
						"type" => "toggle",
						"std" => "false"
					  ),
					  	  
					  
				array( 
						  "name" => "Image Effect",
						  "desc" => "Select the effect you want for images that is black/white , overlay or only specific tone.",
						  "id" => $shortname."_image_effect",
						  "type" => "select",
						  "options" => array("Greyscale","Screen", "Green Channel" , "Red Channel" ,"Blue Channel" ,"Overlay" ,"Color Burn","Green Tone","Blue Tone","Red Tone" ),
						  "std" => "Greyscale"
				  	 ),  
				  	 
			array("type"=>"close_subtitle"),
			
			 array(
						"name" => "&rarr; Portfolio" , 
						"type"=>"subtitle", 
						"id"=>"portfolio"
					  ), 
			array("name"=>"Portfolio 1 Column Items Limit",
			      "desc"=>"set your items per page limit here",
				   "id" => $shortname."_portfolio1_item_limit",
				   "type"=>"slider",
				   "max"=>50,
				   "std"=>6,
				   "suffix"=>"Items"),
			
			array("name"=>"Portfolio 2 Column Items Limit",
			      "desc"=>"set your items per page limit here",
				   "id" => $shortname."_portfolio2_item_limit",
				   "type"=>"slider",
				   "max"=>50,
				   "std"=>6,
				   "suffix"=>"Items"),
			
			array("name"=>"Portfolio 3 Column Items Limit",
			      "desc"=>"set your items per page limit here",
				   "id" => $shortname."_portfolio3_item_limit",
				   "type"=>"slider",
				   "max"=>50,
				   "std"=>6,
				   "suffix"=>"Items"),
			
			array("name"=>"Portfolio 4 Column Items Limit",
			      "desc"=>"set your items per page limit here",
				   "id" => $shortname."_portfolio4_item_limit",
				   "type"=>"slider",
				   "max"=>50,
				   "std"=>6,
				   "suffix"=>"Items"),	   	   	   
				   
			
			array("name"=>"Portfolio 1 Column Words Limit",
			      "desc"=>"set your word limit here",
				   "id" => $shortname."_portfolio1_limit",
				   "type"=>"slider",
				   "max"=>1000,
				   "std"=>250,
				   "suffix"=>"letters"),
				   
			array("name"=>"Portfolio 2 Column Words Limit",
			      "desc"=>"set your word limit here",
				   "id" => $shortname."_portfolio2_limit",
				   "type"=>"slider",
				   "max"=>1000,
				   "std"=>200,
				   "suffix"=>"letters"),
				   
			array("name"=>"Portfolio 3 Column Words Limit",
			      "desc"=>"set your word limit here",
				   "id" => $shortname."_portfolio3_limit",
				   "type"=>"slider",
				   "max"=>1000,
				   "std"=>170,
				   "suffix"=>"letters"),
				   
			array("name"=>"Portfolio 4 Column Words Limit",
			      "desc"=>"set your word limit here",
				   "id" => $shortname."_portfolio4_limit",
				   "type"=>"slider",
				   "max"=>1000,
				   "std"=>150,
				   "suffix"=>"letters"),	   	   
				   	   		  
			array("type"=>"close_subtitle"),
					  	  	 
  // ======================================Sub Panel 2 Begins ======================================				
				array(
						"name" => "&rarr; Flickr API" , 
						"type"=>"subtitle" , 
						"id"=>"subfooter"
						),	      
				
				array(
				  		"name" => "Flickr API Key",
				  		"desc" => "Enter your Flickr Key, to get yours visit <a target='_blank' href='http://www.flickr.com/services/api/misc.api_keys.html'> this page </a>.",
				  		"id" => $shortname."_flickr_key",
				  		"type"=> "text"
						), 
				array(
				  		"name" => "Flickr Account Name",
				  		"desc" => " Enter your Flickr account name in here.",
				  		"id" => $shortname."_flickr_name",
				 	 	"type"=> "text"
						), 
					  
			array("type"=>"close_subtitle"),	
					  			
		array( "type" => "close"),
	
	 // ====================================== Tab  begins ======================================	
	
	 array( "name" => "Visual",
			"type" => "section"),
			array( "name" => $themename." theme",
			"type" => "information",
			"description" => "This panel contains the settings for theme's background and color."
			),
	    array( "type" => "open"),
	    
	            array(
						"name" => "Header Settings " , 
						"type"=>"subtitle", 
						"id"=>"background"
					  ), 
	       
		   array( 
						  "name" => "Header Texture",
						  "desc" => "select the texture for header.",
						  "id" => $shortname."_header_texture",
						  "type" => "select",
						  "options" => array("diagonal-texture","big-doodle-texture","bokeh-texture","bow_texture","checker-texture","cloud-texture","doodle-texture ", "flower-texture" ,"gradient-light" , "industrial-texture" , "paint-textures" , "smoke-texture" , "wood-texture"),
						  "std" => "diagonal-texture" 
				  	 ), 
					 
		   array( 
						"name" => "Header Background Color",
						"desc" => "select the header background color.",
						"id" => $shortname."_header_bg_color",
						"type" => "colorpickerfield",
						"std" => "000000"
						),	
		  
		    array( 
						"name" => "Header Title Color",
						"desc" => "select the header title color.",
						"id" => $shortname."_header_title_color",
						"type" => "colorpickerfield",
						"std" => "ffffff"
						),
						
			  array( 
						"name" => "Header Text Color",
						"desc" => "select the header text color.",
						"id" => $shortname."_header_text_color",
						"type" => "colorpickerfield",
						"std" => "ffffff"
						),	
			
			array( 
						"name" => "Header Button Color",
						"desc" => "select the header button color.",
						"id" => $shortname."_header_button_color",
						"type" => "colorpickerfield",
						"std" => "111111"
						),
			
			array( 
						"name" => "Header Button Text Color",
						"desc" => "select the header button text color.",
						"id" => $shortname."_header_button_text_color",
						"type" => "colorpickerfield",
						"std" => "ffffff"
						),				
															
					  		  		  
					  
	array("type"=>"close_subtitle"),	
	
	
	
	  array(
						"name" => "Footer Settings " , 
						"type"=>"subtitle", 
						"id"=>"footer_background"
					  ), 
	       
		 array( 
						  "name" => "Footer Texture",
						  "desc" => "select the texture for footer.",
						  "id" => $shortname."_footer_texture",
						  "type" => "select",
						  "options" => array("diagonal-texture","big-doodle-texture","bokeh-texture","bow_texture","checker-texture","cloud-texture","doodle-texture ", "flower-texture" ,"gradient-light" , "industrial-texture" , "paint-textures" , "smoke-texture" , "wood-texture"),
						  "std" => "diagonal-texture" 
				  	 ), 
					 
		   array( 
						"name" => "Footer Background Color",
						"desc" => "select the footer background color.",
						"id" => $shortname."_footer_bg_color",
						"type" => "colorpickerfield",
						"std" => "000000"
						),	
		  
		    array( 
						"name" => "Footer Widgets Title Color",
						"desc" => "select the header title color.",
						"id" => $shortname."_footer_title_color",
						"type" => "colorpickerfield",
						"std" => "ffffff"
						),
						
			  array( 
						"name" => "Footer Paragraph Color",
						"desc" => "select the footer paragraph text color.",
						"id" => $shortname."_footer_p_color",
						"type" => "colorpickerfield",
						"std" => "ffffff"
						),	
			
			array( 
						"name" => "Footer Link Color",
						"desc" => "select the footer link color.",
						"id" => $shortname."_footer_link_color",
						"type" => "colorpickerfield",
						"std" => "ffffff"
						),	
						
			array( 
						"name" => "Footer Link Hover Color",
						"desc" => "select the footer link hover color.",
						"id" => $shortname."_footer_link_hover_color",
						"type" => "colorpickerfield",
						"std" => "eeeeee"
						),									
			
			array( 
						"name" => "Footer Button Color",
						"desc" => "select the footer button color.",
						"id" => $shortname."_footer_button_color",
						"type" => "colorpickerfield",
						"std" => "111111"
						),
			
			array( 
						"name" => "Footer Button Text Color",
						"desc" => "select the footer button text color.",
						"id" => $shortname."_footer_button_text_color",
						"type" => "colorpickerfield",
						"std" => "ffffff"
						),				
								
										  		  		  
					  
	array("type"=>"close_subtitle"),
		
	
					  			
	array( "type" => "close"),
	
	
	 // ====================================== Tab  begins ======================================	
	/*
	 array( "name" => "Sidebars",
			"type" => "section"),
			array( "name" => $themename." theme",
			"type" => "information",
			"description" => "This panel contains the settings for sidebar and other widgetized areas."
			),
	    array( "type" => "open"),
	    
	            array(
						"name" => "Sidebar " , 
						"type"=>"subtitle", 
						"id"=>"sidebars"
					  ), 
	       
		  	array( 
						"name" => "Enable Single Post sidebar",
						"desc" => "Don't you need a sidebar on your blog posts, then disable it here.",
						"id" => $shortname."_enable_single_sidebar",
						"type" => "toggle",
						"std" => "true"
					  ),
					  
			array( 
						"name" => "Enable Blog sidebar",
						"desc" => "Don't you need a sidebar on your blog, then disable it here.",
						"id" => $shortname."_enable_sidebar",
						"type" => "toggle",
						"std" => "true"
					  ),
					  
					  
			 array( 
						"name" => "Enable/Disable Page Sidebar",
						"desc" => "Disable or enable the sidebar on pages.",
						"id" => $shortname."_enable_single_page_sidebar",
						"type" => "toggle",
						"std" => "false"
					  ), 
				  
					  		  		  
					  
	array("type"=>"close_subtitle"),	
		
	
					  			
	array( "type" => "close"),
	*/
	
	 // ====================================== Tab  begins ======================================	
	/*
	 array( "name" => "Misc",
			"type" => "section"),
			array( "name" => $themename." theme",
			"type" => "information",
			"description" => "Settings that dont fit anywhere else."
			),
	array( "type" => "open"),
	array(
						"name" => "SmartSense", 
						"type"=>"subtitle", 
						"id"=>"branding"
					  ),
	
	
	
	
	
								
					
	
									  
	array("type"=>"close_subtitle"),			
	array( "type" => "close")
	*/
);

