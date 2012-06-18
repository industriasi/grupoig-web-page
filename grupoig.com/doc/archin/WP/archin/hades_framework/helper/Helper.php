<?php
/*
Hades Framework version 2.0
HELPER class
Author - WP Titans
Description - Class to handle basic rountines in WP themes.

===============================
======= Functions List ========
===============================

Public functions
-------------------------

1. Constructors
2. registerMenus
3. customExcerpt
4. initScripts
5. initStyles
6. shortenContent
7. getShortenContent
8. showPosts
9. showEventPosts
10. showPortfolioPosts
11. the_breadcrumb
Private functions
-------------------------

1. init

*/

class Helper
{
	
	// --------------------------- Constructors -----------------------------------
	
	function __construct()
	{
		
		// Enable basic wordpress stuff
		add_filter('widget_text', 'do_shortcode');
        add_theme_support( 'post-thumbnails' );
		
		/* DISABLING FILTERS */
		//remove_filter('the_content', 'wptexturize');
	//	remove_filter( 'the_content', 'wpautop' );
	//	remove_filter( 'the_excerpt', 'wpautop' );
		function valid_search_form ($form) {
			return str_replace('role="search" ', '', $form);
		}
		add_filter('get_search_form', 'valid_search_form');
		
		

	}
	public function Helper()
	{
		echo "Constructor action";
		// Enable basic wordpress stuff
		add_filter('widget_text', 'do_shortcode');
        add_theme_support( 'post-thumbnails');
		
		/* DISABLING FILTERS */
	//	remove_filter('the_content', 'wptexturize');
	//	remove_filter( 'the_content', 'wpautop' );
	//	remove_filter( 'the_excerpt', 'wpautop' );
		function valid_search_form ($form) {
			return str_replace('role="search" ', '', $form);
		}
		add_filter('get_search_form', 'valid_search_form');
		
	
	}
	
	
	// --------------------------- registerMenus -----------------------------------
	
	
	public function registerMenus($menus)
	{
		

		  if ( function_exists( 'register_nav_menus' ) ) {
			 
			  register_nav_menus($menus);
		  }
	}
	
	// --------------------------- Custom Excerpt -----------------------------------
	
	public function customExcerpt()
	{
		function new_excerpt_length($length) {
			return 20;
		}
		add_filter('excerpt_length', 'new_excerpt_length');
		
		add_filter( 'excerpt_more', 'add_excerpt_more' );
		function add_excerpt_more( $more ) {
        global $post;
        return '… <a href="'. get_permalink($post->ID) . '" class="more-link">' . 'more' . '</a>';
           }
	}
	
	// --------------------------- initScripts -----------------------------------
	
	public function initScripts()
	{
	 if(!is_admin()) {
		 	
	  function scripts() {	
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', URL . '/js/jquery.js', '', '1.6' );
	   wp_enqueue_script('jquery');  
	   wp_enqueue_script("jquery-tools", URL . "/js/jquery.tools.min.js");
	   
	   wp_register_script('jQuery UI', URL . '/js/jquery-ui-1.8.7.custom.min.js', array('jquery'), '1.8.7' );
	   wp_enqueue_script("swf-object", URL . "/js/swfobject.js", array('jquery'), "1.0");
	   wp_enqueue_script("jquery-twitter", URL . "/js/jquery.twitter.js", array('jquery'), "1.0");
	   wp_enqueue_script("pretty-photo", URL . "/js/jquery.prettyPhoto.js", array('jquery'), "1.0");
	   wp_enqueue_script("jquery-quartz", URL . "/js/jquery.quartz.3.0.js", array('jquery'), "1.0"); 
       wp_register_script('custom_script', URL . '/js/custom.js', array('jquery'), '0.1' );
	 // Important scripts
	            
	  
	   wp_enqueue_script('jQuery UI');
	    wp_enqueue_script('custom_script');
	  }
	  
	  
	  add_action("init","scripts");
	  
	  }
	 if(is_admin())
	 {
		  function init_admin_scripts() {
			   wp_enqueue_script("global-js", URL . "/hades_framework/js/global.js", array('jquery'), "1.0");
			   wp_enqueue_style("global-css", URL . "/hades_framework/css/global.css", false, "1.0", "all"); 
			   wp_enqueue_style("colorpicker-style", HURL . "/css/colorpicker.css", false, "1.0", "all");
               wp_enqueue_script("admin-colorpicker",HURL."/js/colorpicker.js",array('jquery'),"1.0");
		  }
		  add_action("init","init_admin_scripts");  
	 }
	}
	
	// --------------------------- initStyles -----------------------------------
	
	public function initStyles()
	{
		 if(!is_admin()) {
		 	
	  function styles() {	
	  wp_enqueue_style( 'jquery-quartz-css',URL.'/stylesheets/quartz.css',false);
	  wp_enqueue_style( 'pretty-photo-css',get_bloginfo('template_url').'/stylesheets/prettyPhoto.css',false);
	  }
	  add_action("init","styles");
	  
	  }
	}
	
	// --------------------------- shortenContent -----------------------------------
	
	function shortenContent($num,$stitle) {
	
	$limit = $num+1;
	if (!strnatcmp(phpversion(),'5.2.10') >= 0) 
	$title = str_split($stitle);
	else
	$title = $this->str_split_php4_utf8($stitle);
	$length = count($title);
	if ($length>=$num) {
	    $title = array_slice( $title, 0, $num);
	    $title = implode("",$title)."...";
	    _e( $title, 'h-framework');
	  } else {
	    _e( $stitle, 'h-framework');
	  }
	}
	
	// --------------------------- getShortenContent -----------------------------------
	
	function getShortenContent($num,$stitle) {
	
	$limit = $num+1;
    if (!strnatcmp(phpversion(),'5.2.10') >= 0) 
	  $title = $this->str_split_php4_utf8($stitle);
	else
	  $title = str_split($stitle);
	$length = count($title);
	if ($length>=$num) {
	    $title = array_slice( $title, 0, $num);
	    $title = implode("",$title)."...";
	    return __( $title, 'h-framework');
	  } else {
	    return __( $stitle, 'h-framework');
	  }
	}
	
	function str_split_php4_utf8($str) { 
    // place each character of the string into and array 
    $split=1; 
    $array = array(); 
    for ( $i=0; $i < strlen( $str ); ){ 
        $value = ord($str[$i]); 
        if($value > 127){ 
            if($value >= 192 && $value <= 223) 
                $split=2; 
            elseif($value >= 224 && $value <= 239) 
                $split=3; 
            elseif($value >= 240 && $value <= 247) 
                $split=4; 
        }else{ 
            $split=1; 
        } 
            $key = NULL; 
        for ( $j = 0; $j < $split; $j++, $i++ ) { 
            $key .= $str[$i]; 
        } 
        array_push( $array, $key ); 
    } 
    return $array; 
} 
	// ---------------------------  showPosts ---------------------------
	function showPosts($options = array()) {
			 /*
			============== Options =============	  
			'limit',
			'image_width',
			'image_height',
			'thumbnails',
		    'post_type',
		    'disable_pagination',
		    'orderby'
			'show_categories'
			'custom_font'
			*/
			global $paged;
			global $post;
			global $more ; 
			extract($options);
			
			$image_width = (!isset($image_width)) ? 255 : $image_width;
			$image_height = (!isset($image_height)) ? 170 : $image_height;
			$thumbnails = (!isset($thumbnails)) ? true : $thumbnails;
			$post_type = (!isset($post_type)) ? 'post' : $post_type;
			$orderby = (!isset($orderby)) ? 'date' : $orderby;
			$custom_font = (!isset($custom_font)) ? false : $custom_font;
			$show_categories  = (!isset($show_categories)) ? false : $show_categories;
			
			if($custom_font)
			$custom_font = "custom-font";
			else
			$custom_font = '';
			
			if(isset($limit))
			$limit = "&posts_per_page={$limit}";
			else
			$limit = '';
			
			$disable_pagination = (!isset($disable_pagination)) ? '' : $limit =  '&nopaging=true';
			$extras  = (!isset($extras)) ? true : $extras;
			
           query_posts("orderby={$orderby}{$limit}&post_type={$post_type}".'&paged='.$paged);
		  
			?>
            
		 <ul class="clearfix">
          <?php 
	
	        if ( have_posts() ) : while ( have_posts() ) : the_post();
		    
            $more = 0;
	      ?>
                <li class="clearfix">
                <?php 
				
	          	$width = "half";
			   if(get_post_meta(get_the_ID(),"_custom_thumbnails_select",true)=="video") :  
			    echo ' <div class="imageholder videoholder"><a href="#">'.get_post_meta(get_the_ID(),"_custom_thumbnail_video",true)."</a></div>";               
				 elseif(get_post_meta(get_the_ID(),"_custom_thumbnails_select",true)=="slideshow") :
		   
		  
			
				$slides = get_post_meta(get_the_ID(),"_custom_thumbnail_gallery",true);
				
		  		$slideshow =  '<div class="thumbnail-slideshow"><div class="slideshow-holder"><ul>';
		
		
			
				foreach($slides as $slide)
				{
					 $theImageSrc = $slide['src'];
                global $blog_id;
                if (isset($blog_id) && $blog_id > 0) {
				$imageParts = explode('/files/', $theImageSrc);
				if (isset($imageParts[1])) {
					$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
				}
			}
				$slideshow = $slideshow. "<li><img src='".URL."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h=170&amp;w=255' alt='slideshow'  /></li>";
				
				}
		        $slideshow = $slideshow.'</ul></div></div>';
		        echo $slideshow;
				
							 
		        elseif (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) && $thumbnails  ) : 
				
				 
						 $id = get_post_thumbnail_id();
	          	          $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
	    	  
				          $theImageSrc = $ar[0];
							global $blog_id;
							if (isset($blog_id) && $blog_id > 0) {
							$imageParts = explode('/files/', $theImageSrc);
							if (isset($imageParts[1])) {
								$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							}
						}
				 ?>
                     <div class="imageholder"><a href="<?php echo $ar[0]; ?>" class="lightbox">
			         <?php 
	                   
	echo "<img src='".URL."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h={$image_height}&amp;w={$image_width}' alt='postimage' />";
	              
			          ?></a>
               
                     </div>
               <?php else: $width = "";  endif; ?>
                      <div class="description <?php echo $width;?> ">
                              <h2 class="<?php echo $custom_font; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php if($extras) { ?>   <small><?php echo human_time_diff(get_the_time('U'), current_time('timestamp'));  _e(' ago','h-framework'); ?> by <?php the_author_posts_link() ?>
                            
                            <?php if($show_categories) :
                            
                            $cats = wp_get_post_categories( $post->ID );
					$str = ' in ('; $temp = false;
					foreach($cats as $c)
					{
						$cat = get_category( $c );
						$link = get_category_link( $c );
						if(!$temp)
						 {
							 
							 $str = $str."  <a href=' $link' >".$cat->name."</a>";
							 $temp = true;
						 }
						 else
						  $str = $str." , <a href=' $link' >".$cat->name."</a>";
					
					}
					echo "<span> $str )</span>";
					endif; ?>
                            </small> <?php } ?>
                              <p>
                              <?php the_content(__('read more','h-framework')); ?>
                              </p>
                              
                       </div>
                </li>
          <?php  $i++; endwhile; else:
              _e( '<h4>No posts yet !</h4>','h-framework' );
            endif;
        	?>
     </ul>
        <?php
	    }
	
	// ---------------------------  showEventPosts ---------------------------
	function showEventPosts($options = array()) {
			 /*
			============== Options =============	  
			'limit',
			'image_width',
			'image_height',
			'thumbnails',
		    'post_type',
		    'disable_pagination',
		    'orderby'
			'show_categories'
			'custom_font'
			*/
			global $paged;
			global $post;
			global $more ; 
			extract($options);
			
			$image_width = (!isset($image_width)) ? 255 : $image_width;
			$image_height = (!isset($image_height)) ? 170 : $image_height;
			$thumbnails = (!isset($thumbnails)) ? true : $thumbnails;
			$post_type = (!isset($post_type)) ? 'post' : $post_type;
			$orderby = (!isset($orderby)) ? 'date' : $orderby;
			$custom_font = (!isset($custom_font)) ? false : $custom_font;
			$show_categories  = (!isset($show_categories)) ? false : $show_categories;
			
			if($custom_font)
			$custom_font = "custom-font";
			else
			$custom_font = '';
			
			if(isset($limit))
			$limit = "&posts_per_page={$limit}";
			else
			$limit = '';
			
			$disable_pagination = (!isset($disable_pagination)) ? '' : $limit =  '&nopaging=true';
			$extras  = (!isset($extras)) ? true : $extras;
			
           query_posts("orderby={$orderby}{$limit}&post_type={$post_type}".'&paged='.$paged);
		  
			?>
            
		 <ul class="clearfix">
          <?php 
	
	        if ( have_posts() ) : while ( have_posts() ) : the_post();
		    $event = get_post_custom_values("event_data");
			$event = unserialize($event[0]); 
             global $more;
			 $more = 0;
	      ?>
                <li class="clearfix">
                <?php 
				
	          	$width = "half";
			   if(get_post_meta(get_the_ID(),"_custom_thumbnails_select",true)=="video") :  
			    echo ' <div class="imageholder videoholder"><a href="#">'.get_post_meta(get_the_ID(),"_custom_thumbnail_video",true)."</a></div>";               
				 elseif(get_post_meta(get_the_ID(),"_custom_thumbnails_select",true)=="slideshow") :
		   
		  
			
				$slides = get_post_meta(get_the_ID(),"_custom_thumbnail_gallery",true);
				
		  		$slideshow =  '<div class="thumbnail-slideshow"><div class="slideshow-holder"><ul>';
		
		
			
				foreach($slides as $slide)
				{
					 $theImageSrc = $slide['src'];
                global $blog_id;
                if (isset($blog_id) && $blog_id > 0) {
				$imageParts = explode('/files/', $theImageSrc);
				if (isset($imageParts[1])) {
					$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
				}
			}
				$slideshow = $slideshow. "<li><img src='".URL."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h=170&amp;w=255' alt='slideshow'  /></li>";
				
				}
		        $slideshow = $slideshow.'</ul></div></div>';
		        echo $slideshow;
				
							 
		        elseif (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) && $thumbnails  ) : 
				
				 
						 $id = get_post_thumbnail_id();
	          	          $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
	    	  
				          $theImageSrc = $ar[0];
							global $blog_id;
							if (isset($blog_id) && $blog_id > 0) {
							$imageParts = explode('/files/', $theImageSrc);
							if (isset($imageParts[1])) {
								$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							}
						}
				 ?>
                     <div class="imageholder"><a href="<?php echo $ar[0]; ?>" class="lightbox">
			         <?php 
	                   
	echo "<img src='".URL."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h={$image_height}&amp;w={$image_width}'  />";
	              
			          ?></a>
               
                     </div>
               <?php else: $width = "";  endif; ?>
                      <div class="description <?php echo $width;?> ">
                              <h2 class="<?php echo $custom_font; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php if($extras) { ?>   <small><?php echo human_time_diff(get_the_time('U'), current_time('timestamp'));  _e(' ago','h-framework'); ?> by <?php the_author_posts_link() ?>
                            
                            <?php if($show_categories) :
                            
                            $cats = wp_get_post_categories( $post->ID );
					$str = ' in ('; $temp = false;
					foreach($cats as $c)
					{
						$cat = get_category( $c );
						$link = get_category_link( $c );
						if(!$temp)
						 {
							 
							 $str = $str."  <a href=' $link' >".$cat->name."</a>";
							 $temp = true;
						 }
						 else
						  $str = $str." , <a href=' $link' >".$cat->name."</a>";
					
					}
					echo "<span> $str )</span>";
					endif; ?>
                            </small> <?php } ?>
                              <p>
                              <?php the_content(__('read more')); ?>
                              </p>
                              
                       </div>
                       <div class="meta-event-data">
                         <ul>
                         <li><strong>Start:</strong></li>
                         <li class="clearfix"><span class="left"><?php echo $event["starting_date"]; ?></span> 
                         <span class="right"><?php echo " $event[time_from_hr] : $event[time_from_min] $event[time_from_zone]"; ?></span></li>
                         <li><strong>Ends:</strong></li>
                         <li class="clearfix"><span class="left"><?php echo $event["ending_date"]; ?></span> 
                         <span class="right"><?php echo " $event[time_to_hr] : $event[time_to_min] $event[time_to_zone]"; ?></span></li>
                        <li><strong>Place:</strong></li>
                         <li><?php echo $event["address"].",".$event["city"].",".$event["state"].",".$event["country"]; ?></li>
                         </ul>
                       </div>
                </li>
          <?php  $i++; endwhile; else:
              _e( '<h4>No posts yet !</h4>' ,'h-framework');
            endif;
        	?>
     </ul>
        <?php
	    }
	// ---------------------------  showPortfolioPosts ---------------------------
	function showPortfolioPosts($options = array()) {
			 /*
			============== Options =============	  
			'limit',
			'image_width',
			'image_height',
			'thumbnails',
		    'post_type',
		    'disable_pagination',
		    'orderby' ,
			'clear'
			'random_dimensions'
			*/
			global $paged;
			global $post;
			global $more ; 
			extract($options);
			
			$image_width = (!isset($image_width)) ? 255 : $image_width;
			$image_height = (!isset($image_height)) ? 170 : $image_height;
			$thumbnails = (!isset($thumbnails)) ? true : $thumbnails;
			$post_type =  'portfolio' ;
			$orderby = (!isset($orderby)) ? 'date' : $orderby;
			
			if(isset($limit))
			$limit = "&posts_per_page={$limit}";
			else
			$limit = '';
			
			if(!isset($clear))
			$clear = 9999;
			
			if(!isset($random_dimensions))
			$random_dimensions = false;
			
			$disable_pagination = (!isset($disable_pagination)) ? '' : $limit =  '&nopaging=true';
			$extras  = (!isset($extras)) ? true : $extras;
			
           query_posts("orderby={$orderby}{$limit}&post_type={$post_type}".'&paged='.$paged);
		  
			?>
            
		 <ul class="clearfix">
          <?php 
	         $counter = $clear; 
			 $divider = '';
	        if ( have_posts() ) : while ( have_posts() ) : the_post();
		   
			if ($counter==0) { $cclass='clearleft'; $divider = '<li class="separator separator-full"><span></span></li>';  }
			else { $cclass='';$divider = ''; }
			
			 
			if( $counter <= 0)
			{
				$counter = $clear;
			}
			
			if(!isset($content_limit))
			$content_limit = 10000;
			
            $more = 0;
	      echo $divider;
		  ?>
                
                <li class="clearfix <?php  echo $cclass;  ?>">
                <?php 
				
	          	$width = "half";
		        if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) && $thumbnails  ) :
				        $custom = get_post_custom($post->ID);
		                $id = get_post_thumbnail_id();
	          	        $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
	    	  
				          $theImageSrc = $ar[0];
							global $blog_id;
							if (isset($blog_id) && $blog_id > 0) {
							$imageParts = explode('/files/', $theImageSrc);
							if (isset($imageParts[1])) {
								$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							}
						}
				  ?>
                     <div class="imageholder"><a href="<?php echo $ar[0]; ?>"  class="lightbox"  >
			         <?php 					
	echo "<img src='".URL."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h={$image_height}&amp;w={$image_width}' alt='portfolio-image'  />";
	              
			          ?></a>
                <?php    echo "<p class='clearfix icon-panel'></p>"; ?>
                     </div>
               <?php else: $width = "";  endif; ?>
                      <div class="description <?php echo $width;?> ">
                              <h2 class="custom-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php if($extras) { ?>   <small><?php the_terms($post->ID , 'portfoliocategory' , '' ,' , ' ,'' ); ?></small> <?php } ?>
                              <div>
                              
                              <?php  
							  global $more;    // Declare global $more (before the loop).
                              $more = 1;
							  $content = get_the_content('');
							  $content = apply_filters('the_content', $content);
                              $content = str_replace(']]>', ']]&gt;', $content);
							  $this->shortenContent( $content_limit ,  strip_tags( $content  ) ); ?>
                              <a class="more-link" href="<?php the_permalink() ?>">read more</a>
                              </div>
                              
                       </div>
                </li>
          <?php  $i++; $counter--;  endwhile; else:
              _e( '<h4>No posts yet !</h4>' ,'h-framework');
            endif;
        	?>
     </ul>
        <?php
		
	    }
		
	
	function showWallPosts($options = array()) {
			 /*
			============== Options =============	  
			'limit',
			'image_width',
			'image_height',
			'thumbnails',
		    'post_type',
		    'disable_pagination',
		    'orderby' ,
			'clear'
			'random_dimensions'
			*/
			global $paged;
			global $post;
			global $more ; 
			extract($options);
			
			$pre_values =  array( 
			    
				array( 568 , 320),
				array( 365 , 137),
				array( 365 , 162),
				
				array( 233 , 255),
				array( 240 , 410),
				array( 445 , 410),
				array( 234 , 140),
				
				
				array(423,232),
				array(511,232)
			
			);
			
			$pval = $pre_values[0];
			
			$image_width = $pval[0];
			$image_height = $pval[1];
			$thumbnails = (!isset($thumbnails)) ? true : $thumbnails;
			$post_type =  'portfolio' ;
			$orderby = (!isset($orderby)) ? 'date' : $orderby;
			
			if(isset($limit))
			$limit = "&posts_per_page={$limit}";
			else
			$limit = "&posts_per_page=9";
			
			if(!isset($clear))
			$clear = 9999;
			
			if(!isset($random_dimensions))
			$random_dimensions = false;
			
			$disable_pagination = (!isset($disable_pagination)) ? '' : $limit =  '&nopaging=true';
			$extras  = (!isset($extras)) ? true : $extras;
			$i =0;
           query_posts("orderby={$orderby}{$limit}&post_type={$post_type}".'&paged='.$paged);
		  
			?>
            
		 <ul class="clearfix">
          <?php 
	         $counter = $clear; 
	        if ( have_posts() ) : while ( have_posts() ) : the_post();
		     
			$pval = $pre_values[$i];
			$image_width = $pval[0];
			$image_height = $pval[1];
			
			if ($counter==0) { $cclass='clearleft';  }
			else { $cclass=''; }
			
			 
			if( $counter <= 0)
			{
				$counter = $clear;
			}
			
            $more = 0;
	      ?>
                <li class="clearfix <?php  echo $cclass;  ?>" style=" <?php echo "width:{$image_width}px ; height:{$image_height}px"; ?>" >
                <?php 
				
	          	$width = "half";
		        if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) && $thumbnails  ) :
				        $custom = get_post_custom($post->ID);
		                $id = get_post_thumbnail_id();
	          	        $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
	    	  
				          $theImageSrc = $ar[0];
							global $blog_id;
							if (isset($blog_id) && $blog_id > 0) {
							$imageParts = explode('/files/', $theImageSrc);
							if (isset($imageParts[1])) {
								$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							}
						}
				  ?>
                     <div class="imageholder"><a href="<?php echo $ar[0]; ?>"  class="lightbox"  >
			         <?php 					
	echo "<img src='".URL."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h={$image_height}&amp;w={$image_width}' alt='portfolio-image'  />";
	              
			          ?></a>
              <?php   echo "<p class='clearfix icon-panel'><a class='link-icon' href='".get_permalink()."'></a></p>"; ?>
                     </div>
                     
               <?php else: $width = "";  endif; ?>
                      <div class="description <?php echo $width;?> ">
                              <h2 class="custom-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php if($extras) { ?>   <small><?php the_terms($post->ID , 'portfoliocategory' , '' ,' , ' ,'' ); ?></small> <?php } ?>
                              <div>
                              <?php // the_content(__('read more')); ?>
                              </div>
                              
                       </div>
                </li>
          <?php  $i++; $counter--;  endwhile; else:
              _e( '<h4>No posts yet !</h4>','h-framework' );
            endif;
        	?>
     </ul>
        <?php
		
	    }
		
	// --------------------------------- showrelated posts ------------------
	
	public function showRelatedPosts($options)
	{
		global $paged;
		global $post;
		global $more ; 
		extract($options);
		$count = (!isset($count)) ? 5 : $count;
		
//for use in the loop, list 5 post titles related to first tag on current post
		  $tags = wp_get_post_tags($post->ID);
		  if ($tags) {
			
			$first_tag = $tags[0]->term_id;
			$args=array(
			  'tag__in' => array($first_tag),
			  'post__not_in' => array($post->ID),
			  'showposts'=>$count,
			  'caller_get_posts'=>1
			 );
			$my_query = new WP_Query($args);
			if( $my_query->have_posts() ) {
			echo " <div class=\"bottom-popular-posts clearfix\"><h2 class=\"custom-font\">Related Posts</h2><ul class='clearfix'>";	
			  while ($my_query->have_posts()) : $my_query->the_post(); 
				echo "<li>";
                if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())   ) :
				        $custom = get_post_custom($post->ID);
		               	$id = get_post_thumbnail_id();
	          	        $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
	    	  
				          $theImageSrc = $ar[0];
							global $blog_id;
							if (isset($blog_id) && $blog_id > 0) {
							$imageParts = explode('/files/', $theImageSrc);
							if (isset($imageParts[1])) {
								$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							}
						}
				  ?>
                     <div class="imageholder"><a href="<?php echo $ar[0]; ?>" title="<?php the_excerpt(); ?>" class="lightbox"  >
			         <?php 					
	echo "<img src='".URL."/timthumb.php?src=".urlencode($theImageSrc)."&h=50&w=96'  />";
	              
			          ?></a></div>
                     <?php  endif; ?>
                  <div class="description">
                      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  </div></li>
                
				<?php
				
				 
			  endwhile;
			  echo "</ul>  </div>";
			  
			}
		  }
		  
		  wp_reset_query();

	}
	public function the_breadcrumb() {
	   
		$delimiter = '';
		$home = 'Home'; // text for the 'Home' link
		$before = '<span class="current">'; // tag before the current crumb
		$after = '</span>'; // tag after the current crumb
	   
		if ( !is_home() && !is_front_page() || is_paged() ) {
	   
		 
	   
		  global $post;
		  $homeLink = home_url();
		  echo '<a href="' . $homeLink . '" class="home" >' . $home . '</a> ' . $delimiter . ' ';
	   
		  if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
	   
		  } elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
	   
		  } elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
	   
		  } elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
	   
		  } elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
			  $post_type = get_post_type_object(get_post_type());
			  $slug = $post_type->rewrite;
			  echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
			  echo $before . get_the_title() . $after;
			} else {
			  $cat = get_the_category(); $cat = $cat[0];
			  echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			  echo $before . get_the_title() . $after;
			}
	   
		  } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
	   
		  } elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
	   
		  } elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;
	   
		  } elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
			  $page = get_page($parent_id);
			  $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
			  $parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
	   
		  } elseif ( is_search() ) {
			echo $before . 'Search results for "' . get_search_query() . '"' . $after;
	   
		  } elseif ( is_tag() ) {
			echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
	   
		  } elseif ( is_author() ) {
			 global $author;
			$userdata = get_userdata($author);
			echo $before . 'Articles posted by ' . $userdata->display_name . $after;
	   
		  } elseif ( is_404() ) {
			echo $before . 'Error 404' . $after;
		  }
	   
		  if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo $before .__('Page') . ' ' . get_query_var('paged'). $after;
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		  }
	   
		
	   
		}
	  }
		
}

/*
$cats = wp_get_post_categories( $post->ID );
					$str = ' in ('; $temp = false;
					foreach($cats as $c)
					{
						$cat = get_category( $c );
						$link = get_category_link( $c );
						if(!$temp)
						 {
							 
							 $str = $str."  <a href=' $link' >".$cat->name."</a>";
							 $temp = true;
						 }
						 else
						  $str = $str." , <a href=' $link' >".$cat->name."</a>";
					
					}
					echo "<span> $str )</span>";
					
					*/