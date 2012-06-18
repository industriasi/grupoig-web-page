<?php


add_action('init', 'message_register');
 
function message_register() {
 
	$labels = array(
		'name' => _x('Message', 'post type general name'),
		'singular_name' => _x('message', 'post type singular name'),
		
		'add_new' => null,
		
		'search_items' => __('Search message'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' =>  HURL. '/css/i/message.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'capabilities' => array('read_post' => true ,'delete_post'=>true , 'publish_posts'=>false, 'edit_post'=>false), 
	    '_edit_link' => 'post.php?post=%d',
		'rewrite'=>true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('',''),
	
	  ); 
 
	register_post_type( 'message' , $args );
}





add_action('save_post', 'message_save_details');

function message_save_details(){
  global $post;
   if (!wp_verify_nonce($_POST['messages_noncename'], 'messages_noncename')) return $post_id;
   if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;


  update_post_meta($post->ID, "message_data",$data);

}


add_action("manage_posts_custom_column",  "message_custom_columns");
add_filter("manage_edit-message_columns", "message_edit_columns");
 
function message_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Title",
    "description" => "Description",
   
  );
 
  return $columns;
}
function message_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_content();
      break;
  
  }
}
