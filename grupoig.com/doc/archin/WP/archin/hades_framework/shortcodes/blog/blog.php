<?php

/* ===================================================== */
/* -------------------- Recent Posts ------------------- */
/* ===================================================== */
function createRecentPosts($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"class"=> '',
		"id" => '' ,
		"count" => 4 ,
		"excerpt" => true,
		"excerpt_length" =>100
    ), $atts)); 
	
	 global $post;
     global $helper;
	 $myposts = get_posts('numberposts='.$count.'&order=DESC&orderby=post_date');
     $retour="<div class='recentposts_shortcode'><ul class='clearfix' >";
       foreach($myposts as $post) :
                setup_postdata($post);
			
			 $retour.='<li>';	
				
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
	$retour.='<a href="'.$ar[0].'"  class="lightbox"  ><img src="'.get_bloginfo('template_directory').'/timthumb.php?src='.urlencode($theImageSrc).'&h=115&w=180"  /></a>';
	             
			          
             $retour.='<h4><a href="'.get_permalink().'">'.the_title("","",false).'</a></h4>';
			 if($excerpt==true)
			$retour.= "<p>".$helper->getShortenContent($excerpt_length,get_the_content())."</p>";
			 $retour.= "</li>";
        endforeach;
        $retour.='</ul></div> ';
        return $retour;
}

add_shortcode("recentposts","createRecentPosts");

/* ===================================================== */
/* -------------------- Popular Posts ------------------ */
/* ===================================================== */

function createPopularPosts($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"class"=> '',
		"id" => '' ,
		"count" => 4 ,
		"excerpt" => true,
		"excerpt_length" =>100
    ), $atts)); 
	
	 global $post;
     global $helper;
	 $myposts = get_posts('numberposts='.$count.'&order=DESC&orderby=comment_count');
      $retour="<div class='popularposts_shortcode'><ul class='clearfix'>";
       foreach($myposts as $post) :
                setup_postdata($post);
			
			 $retour.='<li>';	
				
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
	$retour.='<a href="'.$ar[0].'"  class="lightbox"  ><img src="'.get_bloginfo('template_directory').'/timthumb.php?src='.urlencode($theImageSrc).'&h=115&w=180"  /></a>';
	             
			          
             $retour.='<h4><a href="'.get_permalink().'">'.the_title("","",false).'</a></h4>';
			 if($excerpt==true)
			$retour.= "<p>".$helper->getShortenContent($excerpt_length,get_the_content())."</p>";
			 $retour.= "</li>";
        endforeach;
        $retour.='</ul></div> ';
        return $retour;
}

add_shortcode("popularposts","createPopularPosts");


/* ===================================================== */
/* -----------------------  Posts ---------------------- */
/* ===================================================== */

function createPosts($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"class"=> '',
		"id" => '' ,
		"count" => 4 ,
		"excerpt" => true,
		"excerpt_length" =>100,
		"author_name" => '',
		"category_name" => '',
		 "tag"=>''
    ), $atts)); 
	
	 global $post;
     global $helper;
	 
	 if($author_name!="")
	 $author_name = "&author_name={$author_name}";
	 
	 if($category_name!="")
	 $category_name = "&category_name={$category_name}";
	 
	 if($tag!="")
	 $tag = "&tag={$tag}";
	 
	
	 
	 $myposts = get_posts('numberposts='.$count."&order=DESC{$author_name}{$category_name}{$tag}");
      $retour="<div class='posts_shortcode'><ul class='clearfix'>";
     
             foreach($myposts as $post) :
                setup_postdata($post);
			
			 $retour.='<li>';	
				
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
	$retour.='<a href="'.$ar[0].'"  class="lightbox"  ><img src="'.get_bloginfo('template_directory').'/timthumb.php?src='.urlencode($theImageSrc).'&h=115&w=180"  /></a>';
	             
			          
             $retour.='<h4><a href="'.get_permalink().'">'.the_title("","",false).'</a></h4>';
			 if($excerpt==true)
			 $retour.= "<p>".$helper->getShortenContent($excerpt_length,get_the_content())."</p>";
			 $retour.= "</li>";
        endforeach;
      
        $retour.='</ul></div> ';
        return $retour;
}

add_shortcode("posts","createPosts");

/* ===================================================== */
/* -------------------- Related Posts ------------------ */
/* ===================================================== */

function createRelatedPosts($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"class"=> '',
		"count" => 4 ,
		
    ), $atts)); 
	
	global $wpdb, $post, $table_prefix;
    
	$i =0;
   
	if ($post->ID) {
		$retval = '<div class="relatedposts_shortcode'.$class.'"><ul>';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);

		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
				if($i>=$count)
				break;
				
				$i++;
			}
		} else {
			$retval .= '
	<li>No related posts found</li>';
		}
		$retval .= '</ul></div>';
		return $retval;
	}
	return;
}

add_shortcode("relatedposts","createRelatedPosts");

/* == =Blog ================ */

function createcontactform($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"id" => '' ,
		"width" => "300px"
    ), $atts)); 
	
	if($id=="")
	{
		return "Invalid ID";
	}
	
	  $forms = get_option("archin_forms");
	  $cform = '' ;
	 $test_flag = true; 
	foreach($forms as $form)
	{
		if($id == $form["key"]  )
		{
			$cform = $form;$test_flag = false;  break; 
		}
	}
	
	if($test_flag)
	{
		return "Invalid ID";
	}
	
	
	
	$form = "    <div class=\"dynamic_forms clearfix\" style='{$width}'> 
	
	 <div class='loader success-box clearfix'>
          <p> Message Sent ! </p>
          </div>
      <form action='".get_bloginfo('template_url')."/hades_framework/helper/form_request.php' method='post' />
	   <span class='ajax-loading-icon'></span>";
	 
	$name_value = $cform["name_value"];
	$form_element = $cform["form_element"];
	$email_notification_mail = $cform["email_notification_mail"];
	
	$captacha_verification  = $cform["captacha_verification"];
	
	
	if($cform["email_notification"]!="true")
	$email_notification_mail = "none";
	
	$label_values = $cform["label_values"];
	$i =0;
	foreach($form_element as $input)
	{
		$label = $label_values[$i];
		$name = $name_value[$i];
		
		if($name=="Click to edit name, optional" || trim($name) == "" )
		{
			$name = $input.$i;
		}
		 
		switch($input)
		{
			case "text" :  $form = $form." <p class='clearfix'>
						    <label for='{$name}'> $label </label>
							<input type='text' value='' name='{$name}' id='{$name}' />
						  </p> ";
			              break;
			case "textarea" :  $form = $form." <p class='clearfix'>
						    <label for='{$name}'> $label </label>
							<textarea name='{$name}' id='{$name}' /></textarea>
						  </p> ";
			              break;
			default :  
			             $form = $form." <p class='clearfix'>
						    <label for='{$name}'> $label </label>
							<select id='{$name}' name='{$name}' >";
						 $options = explode(":",$input);
						 $options = $options[1];
						 $options = explode(",",$options);
						  foreach($options as $option)
							$form = $form."<option value='{$option}'>{$option}</option>";
						 $form = $form."</select></p>";	
						
			              break;			  			  
		}
		$i++;
	}
	// print_r($cform);
	
	if($captacha_verification=="true")
	{
		require(HPATH."/helper/recaptchalib.php");
		$publickey = get_option("arc_captcha_public_key"); // you got this from the signup page
        $form = $form. recaptcha_get_html($publickey);
	}
	
	
	$form = $form."  <input type='hidden' name='notify_email' value='{$email_notification_mail}' class='notify_email' /><input type='hidden' name='form_key' value='{$id}' class='form_key' /><input type='submit' name='qsubmit' value='Send' class='d_submit' /></form></div>";
	return $form;
}


add_shortcode("contactform","createcontactform");