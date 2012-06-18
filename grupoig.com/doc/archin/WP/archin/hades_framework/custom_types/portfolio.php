<?php


add_action('init', 'portfolio_register');
 
function portfolio_register() {
 
	$labels = array(
		'name' => _x('Portfolio', 'post type general name'),
		'singular_name' => _x('Portfolio Item', 'post type singular name'),
		'add_new' => _x('Add New', 'portfolio item'),
		'add_new_item' => __('Add New Portfolio Item'),
		'edit_item' => __('Edit Portfolio Item'),
		'new_item' => __('New Portfolio Item'),
		'view_item' => __('View Portfolio Item'),
		'search_items' => __('Search Portfolio'),
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
		'menu_icon' => HURL. '/css/i/image.png',
		'rewrite' => true,
		'capability_type' => 'post',
	    '_edit_link' => 'post.php?post=%d',
		'rewrite'=>true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt')
	  ); 
 
	register_post_type( 'portfolio' , $args );
}

register_taxonomy("portfoliocategory", array("portfolio"), array("hierarchical" => true, "label" => "Portfolio Category", "singular_label" => "type", "rewrite" => true));


add_action("admin_init", "portfolio_admin_init");
 
function portfolio_admin_init(){
 
  add_meta_box("portfolio_credits_meta", "Upload Images", "portfolio_credits_meta", "portfolio", "normal", "high");
 
}
 

function portfolio_credits_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $link = $custom["_portfolio_link"][0];
   if(!$slides) $slides = array( array( "src"=>'' , "link"=>'your link here', "description" => ' some information ' ));
  ?>
  
  <div id="hades_portfolio">
  
  
   <label for="portfolio_link">Project Link</label><input type="text" name="portfolio_link" id="portfolio_link" value="<?php echo $link; ?>" />
  
  
  </div>
  
  <?php
 
}

add_action('save_post', 'portfolio_save_details');

function portfolio_save_details(){
  global $post;
  update_post_meta($post->ID, "_portfolio_link", $_POST["portfolio_link"]);

}

