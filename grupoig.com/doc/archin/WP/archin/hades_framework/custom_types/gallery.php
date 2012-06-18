<?php
add_action('init', 'gallery_register');
 
function gallery_register() {
 
	$labels = array(
		'name' => _x('Gallery', 'post type general name'),
		'singular_name' => _x('Gallery Page', 'post type singular name'),
		'add_new' => _x('New Page', 'gallery item'),
		'add_new_item' => __('Add New Gallery Page'),
		'edit_item' => __('Edit Gallery Page'),
		'new_item' => __('New Gallery Page'),
		'view_item' => __('View Gallery Page'),
		'search_items' => __('Search Galleries'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => "gallery", // This goes to the WP_Query schema	
		'menu_icon' => HURL  . '/css/i/gallery.png',  	
		'rewrite' => true, // Permalinks format
		'capability_type' => 'page',
	    '_edit_link' => 'post.php?post=%d',
 		'_builtin' => false, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt')
	  ); 
 
	register_post_type( 'gallery' , $args );
}

register_taxonomy("gallery_category", array("gallery"), array("hierarchical" => true, "label" => "Gallery Category", "singular_label" => "type", "rewrite" => true));

add_action("admin_init", "gallery_admin_init");
 
function gallery_admin_init(){
 
  add_meta_box("gallery_credits_meta", "Upload Images", "gallery_credits_meta", "gallery", "normal", "high");
  add_meta_box("gallery_columns_credits_meta", "Columns", "gallery_columns_credits_meta", "gallery", "side", "high");
}
 
function gallery_columns_credits_meta() {
	  global $post;
  $custom = get_post_custom($post->ID);
  $gallery_column = $custom["gallery_column"][0];
   $options = array("custom"=>"Gallery Style 1","flickr"=>"Flickr Gallery");
	?>
	<label for="gallery_column">Select Columns : </label>
    <select name="gallery_column" id="gallery_column">
     <?php 
	 $temp = '';
	 foreach($options as $key => $val)
	 {
		 
		 if($key==$gallery_column)
		 $temp = "<option value='$key' selected>$val</option>";
		 else
		  $temp = "<option value='$key' >$val</option>";
		  echo $temp;
	 }
	 ?>
	</select>
	<?php
	}
function gallery_credits_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $slides = unserialize($custom["gallery_items"][0]);
   if(!$slides) $slides = array( array( "src"=>'' , "link"=>'your link here', "description" => ' some information ' ));
  ?>
  
  <div id="hades_gallery">
  
  
   <div class="toppanel clearfix">
          <a href="#" id="addslide" class="button">Add item</a>
   </div>
   <div class="slider-lists">
      <ul>
      <?php  foreach($slides as $slide) { ?>
          <li class="clearfix contract">
          
          
         <div class="slide-head">
         <a href="#" class="move-icon"></a>
          <a href="#" class="max-slide-button slide-toggle-button">Expand</a>
         <a href="#" class="delete-slide-button removeslide">Delete</a>
         
         
          
           </div>
         <div class="slide-body">
           
           <div class="image-slide">
            <div class="separator clearfix">
                <label for="">Upload Image:</label>
                <input type="text" class="" name="imagesrc[]" value="<?php echo $slide['src'] ?>" />
                <a href="#" class="custom_upload_image_button button"> Upload </a>
           </div>     
            <div class="separator clearfix">
                <label for="">Image Link:</label>
                <input type="text" class="" name="link_src[]" value="<?php echo $slide['link'] ?>" />
           </div>
           <div class="separator clearfix">
                <label for="">Image Title:</label>
                <input type="text" class="" name="title[]" value="<?php echo $slide['title'] ?>" />
           </div>
            <div class="lseparator clearfix">     
                <label for="">Description:</label>
                <textarea  cols="30" rows="10" class="" name="description[]"><?php echo $slide['description'] ?></textarea>
           </div>   
                
                
          </div>
          </div>
          
          <input type="hidden" class="hide_mercury" />
           <input type="hidden" name="slide_type[]" value="upload" class="slide_type" />
          </li>
          <?php } ?>
      </ul>
      
   </div>
  
  
  
  </div>
  
  <?php
 
}

add_action('save_post', 'gallery_save_details');

function gallery_save_details(){
  global $post;
  
   
   
	if(isset($_POST['slide_type'])) {
		
		
			$slides = array();
			
			 foreach ( $_POST['slide_type'] as $key => $value )
			{
				$urlimage = $_POST['imagesrc'][$key];
				$ilink =  $_POST['link_src'][$key];
				$idesc =  $_POST['description'][$key];
				$title =  $_POST['title'][$key];
					
				
				$slides[] = array(
				'src' => $urlimage,
				'link' => $ilink ,
				'description' => $idesc ,
				'type' => $value,
				'title' => $title
				);
				
				
				
			}
			
	 update_post_meta($post->ID, "gallery_items", $slides);
	  update_post_meta($post->ID, "gallery_column", $_POST['gallery_column']);
	}
 

// update_post_meta($post->ID, "video_link", $_POST["video_link"]);

}

function add_gallery_scripts()
{
     
  wp_enqueue_script('gallerymanager', HURL . '/js/gallery_post.js', array('jquery'), '0.1' );
  wp_enqueue_script('jquery-ui-core');
  wp_enqueue_script('jquery-ui-sortable');
	
    
}

add_action('admin_init','add_gallery_scripts');