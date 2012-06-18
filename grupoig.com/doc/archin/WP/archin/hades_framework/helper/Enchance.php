<?php
/*
Hades Framework version 3.0
ENCHANCE class
Author - WP Titans
Description - Class to handle extra features.

===============================
======= Functions List ========
===============================

Public functions
-------------------------

1. enableBlurb
2. enableCustomThumbnails
3. controlBackground
4. customFormatter
5. megaMenu

Private functions
-------------------------


*/
class Enchance
{
	
	
	function __construct()
	{
		
	}
	
	function Enchance()
	{
		
	}
	
	public function enableBlurb()
	{
		function custom_blurb_add_custom_box() {
			
			
			 add_meta_box('custom_blurb', 'Intro Blurb', 'custom_blurb_custom_box','page', 'side', 'high');
		}
		
		
		
		/* Use the admin_menu action to define the custom boxes */
        add_action('admin_menu', 'custom_blurb_add_custom_box');
		/* prints the custom field in the new custom post section */
		function custom_blurb_custom_box() {
			 //get post meta value
			 global $post;
			 $title = get_post_meta($post->ID,'_title',true);
			 $info = get_post_meta($post->ID,'_info',true)  ;
			 $link = get_post_meta($post->ID,'_link',true)  ;
			 $link_text = get_post_meta($post->ID,'_link_text',true)  ;
			
			
			
		
			 ?>
			 <div id="intro_blurb_box">
             <p><label for="title">Blurb Title</label><input type="text" name="title" id="title" value="<?php echo $title; ?>" /></p>
             <p><label for="info">Blurb Text</label><textarea name="info" id="info"><?php echo $info; ?></textarea></p>
             <p><label for="link">Blurb Link</label><input type="text" name="link" id="link"  value="<?php echo $link; ?>" /></p>
              <p><label for="link_text">Blurb Link Text</label><input type="text" name="link_text" id="link_text"  value="<?php echo $link_text; ?>" /></p>
			</div>
			 
			 <?php
		}

		/* use save_post action to handle data entered */
		add_action('save_post', 'custom_blurb_save_postdata');
		
		/* when the post is saved, save the custom data */
		function custom_blurb_save_postdata($post_id) {
			 
		
			 // do not save if this is an auto save routine
			 if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		
			  
			  update_post_meta($post_id, "_link_text", $_POST["link_text"]);
			  update_post_meta($post_id, "_title", $_POST["title"]);
			 update_post_meta($post_id, '_info',  $_POST["info"]);
			 update_post_meta($post_id, '_link',  $_POST["link"]);
			
			
			
			
		}
		
	
	}
	
	
	public function enableUnlimitedSidebars()
	{
		function ulsidebars_add_custom_box() {
			
			
			 add_meta_box('ulsidebars', 'Sidebars', 'ulsidebars_custom_box','page', 'side', 'high');
			 add_meta_box('ulsidebars', 'Sidebars', 'ulsidebars_custom_box','post', 'side', 'high');
			  
		}
		
		
		
		/* Use the admin_menu action to define the custom boxes */
        add_action('admin_menu', 'ulsidebars_add_custom_box');
		/* prints the custom field in the new custom post section */
		function ulsidebars_custom_box() {
			 //get post meta value
			 global $post;
			 $align = get_post_meta($post->ID,'_sidebar_align',true);
			 $sidebar = get_post_meta($post->ID,'_dynamic_sidebar',true)  ;
			  $enable_sidebar = get_post_meta($post->ID,'_enable_sidebar',true)  ;
			
		
			 
			  $active_sidebars = get_option("archin_active_sidebars");
		
		 if(!$active_sidebars)
	     $active_sidebars = array();
		 
		 $active_sidebars[] = "Blog Sidebar";
		 $active_sidebars[] = "Page Sidebar";
		 
		 $sidebar_array = '<select name="dynamic_sidebars"><option value="none">none</option>';
	     foreach($active_sidebars as $bar )
	      {
			 if($sidebar==$bar)
			 $sidebar_array = $sidebar_array."<option value='{$bar}' selected>{$bar}</option>";
			 else 
		    $sidebar_array = $sidebar_array."<option value='{$bar}'>{$bar}</option>";
	      }
	      $sidebar_array =  $sidebar_array.'</select>';
		
			 ?>
			 <div id="sidebar_box">
             <p>
                 <label>Sidebar Alignment</label>
                 <label for="algin_left">Left</label><input type="radio" id="algin_left" name="align" value="left" <?php if($align=="left") echo "checked='checked'"; ?> />
                 <label for="algin_right">Right</label><input type="radio" id="algin_right" name="align" value="right" <?php if($align!="left") echo "checked='checked'"; ?>/>
             </p>
             <p><label for="dynamic_sidebars">Dynamic Sidebars</label>
             <?php echo  $sidebar_array; ?>
             </p>
             <p>
             <label for="">Enable Sidebar</label><input type="checkbox" value="true" name="enable_sidebar" <?php if($enable_sidebar=="true") echo"checked='checked'"; ?> />
             </p>
			</div>
			 
			 <?php
		}

		/* use save_post action to handle data entered */
		add_action('save_post', 'ulsidebars_save_postdata');
		
		/* when the post is saved, save the custom data */
		function ulsidebars_save_postdata($post_id) {
			 
		
			 // do not save if this is an auto save routine
			 if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		
			  
			  update_post_meta($post_id, "_sidebar_align", $_POST["align"]);
			  update_post_meta($post_id, "_dynamic_sidebar", $_POST["dynamic_sidebars"]);
			   update_post_meta($post_id, "_enable_sidebar", $_POST["enable_sidebar"]);
			
			
			
			
			
		}
		
	
	}
	
	
	public function enableCustomThumbnails()
	{
				
        	function custom_thumbnails_add_custom_box() {
			
			
			 add_meta_box('custom_thumbnails', 'Custom Thumbnails', 'custom_thumbnails_custom_box','post', 'side', 'high');
		}
		
		
		
		/* Use the admin_menu action to define the custom boxes */
        add_action('admin_menu', 'custom_thumbnails_add_custom_box');
		/* prints the custom field in the new custom post section */
		function custom_thumbnails_custom_box() {
			 //get post meta value
			 global $post;
			 $custom = get_post_meta($post->ID,'_custom_thumbnail_video',true);
			 $slides = get_post_meta($post->ID,'_custom_thumbnail_gallery',true)  ;
			 $type = get_post_meta($post->ID,'_custom_thumbnails_select',true)  ;
			
			 if(!$slides) $slides = array( array( "src"=>'' ));
		   
			 // use nonce for verification
			 echo '<input type="hidden" name="custom_thumbnails_noncename" id="custom_thumbnails_noncename" value="'.wp_create_nonce('custom_thumbnails_noncename').'" />';
		
			 ?>
			 
			 <div class="custom_thumbnails_wrap">
			  <input type="hidden" id="post_ID" value="<?php echo $post->ID ?>" />
			
				 <span class="h-heading"> Select Thumbnail Type </span>
					 <p class="clearfix selection">   
						<label for="custom_thumbnails_select_video">Video</label> 
						<input type="radio" id="custom_thumbnails_select_video" name="custom_thumbnails_select" value="video" <?php if( $type=="video") echo  'checked="checked"'; ?> />
						<label for="custom_thumbnails_select_slideshow">Slideshow</label>
						<input type="radio" id="custom_thumbnails_slideshow" name="custom_thumbnails_select" value="slideshow"  <?php if( $type=="slideshow") echo  'checked="checked"'; ?> />
						 <label for="custom_thumbnails_none">None</label>
						<input type="radio" id="custom_thumbnails_none" name="custom_thumbnails_select" value="none"  <?php if( $type=="none") echo  'checked="checked"'; ?> />
						
					   <a href="#" id="addslide">Add item</a>
					 </p>
			 
					 <p class="clearfix video_module">  
					   <label for="custom_thumbnail_video">Embed Code (only the iframe or embed code!)</label>
					   <textarea name="custom_thumbnail_video" id="custom_thumbnail_video" ><?php echo $custom; ?></textarea>
					 </p>
			 
			 <div class="slideshow_module">
			 
			 
						 
						 <div class="slider-lists">
							  <ul>
							  <?php  foreach($slides as $slide) { ?>
								  <li class="clearfix">
				  
				  
										
										 <div class="slide-body">
										   
										   <div class="image-slide clearfix">
										   <a href="#" class="delete-slide-button removeslide">Delete</a>
											<div class="separator clearfix">
												<label for="">Upload Image:</label>
											   <p class="clearfix"> 
											   <input type="text" class="" name="imagesrc[]" value="<?php echo $slide['src'] ?>" />
											   <input class="custom_upload_image_button button"  type="button"  value="Insert Image" />
											   </p>
												
										   </div>     
										   </div>
										  
										  </div>
				  
				  
				   <input type="hidden" name="slide_type[]" value="upload" class="slide_type" />
				  </li>
				  <?php } ?>
			  </ul>
			  
		   </div>
		   
		   
			 </div>
			
			
			
			 
			 </div>
			 
			 <?php
		}

		/* use save_post action to handle data entered */
		add_action('save_post', 'custom_thumbnails_save_postdata');
		
		/* when the post is saved, save the custom data */
		function custom_thumbnails_save_postdata($post_id) {
			 // verify this with nonce because save_post can be triggered at other times
			 if (!wp_verify_nonce($_POST['custom_thumbnails_noncename'], 'custom_thumbnails_noncename')) return $post_id;
		
			 // do not save if this is an auto save routine
			 if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		
			 $video = $_POST['custom_thumbnail_video'];
			 $type = $_POST['custom_thumbnails_select'];
			 
			 if(isset($_POST['slide_type'])) {
				
				
					$slides = array();
					
					
					 foreach ( $_POST['slide_type'] as $key => $value )
					{
						$id = '';
							
						$urlimage = $_POST['imagesrc'][$key];
						$ilink =  ''; // $_POST['link_src'][$key];
						$idesc =  ''; //$_POST['description'][$key];
									
						
						$slides[] = array(
						'src' => $urlimage,
						'link' => $ilink ,
						'description' => $idesc ,
						'type' => $value,
						
						);
						
						
						
					}
					
			
			}
			
			  update_post_meta($post_id, "_custom_thumbnail_gallery", $slides);
			 update_post_meta($post_id, '_custom_thumbnail_video', $video);
			 update_post_meta($post_id, '_custom_thumbnails_select', $type);
			
			
			
			
		}
		
		function add_thumbnail_scripts()
		{
			
			wp_register_script('my-upload', HURL.'/js/custom_thumbs.js', array('jquery','media-upload','thickbox'));
			wp_enqueue_script('my-upload');
			
		}
		
		
		add_action('admin_init', 'add_thumbnail_scripts'); 
		
	}
	
	public function controlBackground()
	{
		
		function controlBackground_temp(){
			
		if(get_option("arc_bg_color_toggle")!="false")	
		$color = (!get_option("arc_bg_color")) ? "#ffffff" :  '#'.get_option("arc_bg_color");
		
		 $texture =  get_option('arc_bg_texture');
	  
	  if($texture==""||$texture=="None")
	  $texture=="";
	  else
	  {
		  switch($texture)
		  {
			  case "Diagonal Strips":  $texture="diagonal-strips"; break;
			  case "Slanting Strips" : $texture="horizotnal-strips"; break;
			  case "Vertical Strips" : $texture="vertical-strips"; break;
			  case "Crossed noise" : $texture="cross-noise"; break;
			  case "Noise" : $texture="noise"; break;
		  }
		  $texture = "url(".get_bloginfo('template_directory')."/sprites/bg-textures/{$texture}.png) ";
	  }
	
	
	  
	 
	  
	  if(!get_option("arc_bg_image_scale")||get_option("arc_bg_image_scale")=="true")
	  $img_scale = '#page-background img { width:100%; height:100%;}';
	  else
	  $img_scale = '';
	  
	 
	  
	  $fcolor = get_option("arc_font_color");
	  $fcolor  = ($fcolor == "") ? '#888888' : "#".$fcolor;


	  if(trim($texture)=="None")
	  $texture='';
	  
		$style = "<style type='text/css'>
		           $img_scale
				   body {
					   background :  $color ;
					   color: $fcolor ;
					   
					   } 
					 #texture-bg { background: $texture  ; }  
				    
		          </style>
				  ";
		
		echo $style;		  
		}
		add_action("wp_head","controlBackground_temp");
	}
	
	public function customFormatter(){
		
		
		
		}
		
	public function megaMenu(){
		
		
		}	
	
}

