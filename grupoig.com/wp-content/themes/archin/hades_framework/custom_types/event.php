<?php


add_action('init', 'event_register');
 
function event_register() {
 
	$labels = array(
		'name' => _x('event', 'post type general name'),
		'singular_name' => _x('Event', 'post type singular name'),
		'add_new' => _x('Add New Event', 'event item'),
		'add_new_item' => __('Add New Event Item'),
		'edit_item' => __('Edit Event'),
		'new_item' => __('New Event'),
		'view_item' => __('View Event'),
		'search_items' => __('Search Event'),
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
		'menu_icon' => HURL. '/css/i/event.png',
		'rewrite' => true,
		'capability_type' => 'post',
	    '_edit_link' => 'post.php?post=%d',
		'rewrite'=>true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','comments','excerpt')
	  ); 
 
	register_post_type( 'event' , $args );
}

register_taxonomy("event_category", array("event"), array("hierarchical" => true, "label" => "Event Category", "singular_label" => "type", "rewrite" => true));

add_action("admin_init", "event_admin_init");
 
function event_admin_init(){
 
  add_meta_box("event_credits_meta", "Custom Links", "event_credits_meta", "event", "normal", "low");
}
 

function event_credits_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $data = $custom["event_data"][0];
   $data = unserialize($data);
    echo '<input type="hidden" name="events_noncename" id="events_noncename" value="'.wp_create_nonce('events_noncename').'" />';
  ?>
  <p><label>Starting  Date:</label><br />
  <input type="text" cols="20" name="starting_date" value="<?php echo $data["starting_date"]; ?>" class="event_datepicker" /></p>
  
  <p><label>Ending  Date:</label><br />
  <input type="text" cols="20" name="ending_date" value="<?php echo $data["ending_date"]; ?>" class="event_datepicker" /></p>
  
  <p>
  <label for="">Time From:</label>
   <select name="time_from_hr" id="">
      <?php
	  $temp = '';
	  $arr = array('01','02','03','04','05','06','07','08','09','10','11','12');
	  foreach($arr as $val)
	  {
		  if($val==$data["time_from_hr"])
		  $temp = $temp."<option value='{$val}' selected>$val</option>";
		  else
		  $temp = $temp."<option  value='{$val}'>$val</option>";
	  }
	  echo $temp;
	   ?>
   </select>
   <select name="time_from_min" id="">
      <?php
	  $temp = '';
	  $arr = array('00','05','10','15','20','25','30','35','40','45','50','55');
	  foreach($arr as $val)
	  {
		  if($val==$data["time_from_min"])
		  $temp = $temp."<option value='{$val}' selected>$val</option>";
		  else
		  $temp = $temp."<option  value='{$val}'>$val</option>";
	  }
	  echo $temp;
	   ?>
   </select>
   <select name="time_from_zone">
      <?php
	  $temp = '';
	  $arr = array('AM','PM');
	  foreach($arr as $val)
	  {
		  if($val==$data["time_from_zone"])
		  $temp = $temp."<option value='{$val}' selected>$val</option>";
		  else
		  $temp = $temp."<option  value='{$val}'>$val</option>";
	  }
	  echo $temp;
	   ?>
   </select>
  </p>
  
   <p>
  <label for="">Time To:</label>
   <select name="time_to_hr" id="">
     <?php
	  $temp = '';
	  $arr = array('01','02','03','04','05','06','07','08','09','10','11','12');
	  foreach($arr as $val)
	  {
		  if($val==$data["time_to_hr"])
		  $temp = $temp."<option value='{$val}' selected>$val</option>";
		  else
		  $temp = $temp."<option  value='{$val}'>$val</option>";
	  }
	  echo $temp;
	   ?>
   </select>
   <select name="time_to_min" id="">
     <?php
	  $temp = '';
	  $arr = array('00','05','10','15','20','25','30','35','40','45','50','55');
	  foreach($arr as $val)
	  {
		  if($val==$data["time_to_min"])
		  $temp = $temp."<option value='{$val}' selected>$val</option>";
		  else
		  $temp = $temp."<option  value='{$val}'>$val</option>";
	  }
	  echo $temp;
	   ?>
   </select>
   <select name="time_to_zone">
      <?php
	  $temp = '';
	  $arr = array('AM','PM');
	  foreach($arr as $val)
	  {
		  if($val==$data["time_to_zone"])
		  $temp = $temp."<option value='{$val}' selected>$val</option>";
		  else
		  $temp = $temp."<option  value='{$val}'>$val</option>";
	  }
	  echo $temp;
	   ?>
   </select>
  </p>
  
  <p><label>Address :</label><br />
  <textarea name="address"><?php echo $data["address"]; ?></textarea>
  </p>
  <p><label>City :</label><br />
  <input type="text" cols="20" name="city" value="<?php echo $data["city"]; ?>" /></p>
  
   <p><label>State :</label><br />
  <input type="text" cols="20" name="state" value="<?php echo $data["state"]; ?>" /></p>
  
   <p><label>Country :</label><br />
  <input type="text" cols="20" name="country" value="<?php echo $data["country"]; ?>" /></p>
  
  
  <?php
}

add_action('save_post', 'event_save_details');

function event_save_details(){
  global $post;
   if (!wp_verify_nonce($_POST['events_noncename'], 'events_noncename')) return $post_id;
   if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
  
  $data = array(
  "starting_date" => $_POST["starting_date"] , 
  "ending_date" => $_POST["ending_date"],
  
  "time_from_hr" => $_POST["time_from_hr"],
  "time_from_min" => $_POST["time_from_min"],
  "time_from_zone" => $_POST["time_from_zone"],
  
   "time_to_hr" => $_POST["time_to_hr"],
  "time_to_min" => $_POST["time_to_min"],
  "time_to_zone" => $_POST["time_to_zone"],
  
  "address" => $_POST["address"],
  "state" => $_POST["state"],
  "city" => $_POST["city"], 
  "country" => $_POST["country"],
  );
  

  update_post_meta($post->ID, "event_data",$data);

}

function addEventScripts()
{
	if(is_admin() && ( (isset($_GET["post_type"]) && $_GET["post_type"]=="event") || isset($_GET["post"])  )) {
	
	wp_deregister_script('jquery-ui-core');
	wp_deregister_script('jquery-ui-sortable');
	
	wp_enqueue_script("jquery-ui-core", HURL."/js/jquery.ui.core.js", array('jquery'), "1.0");
    wp_enqueue_script("jquery-ui-widget", HURL."/js/jquery.ui.widget.js", array('jquery-ui-core'), "1.0");
	wp_enqueue_script("jquery-ui-mouse", HURL."/js/jquery.ui.mouse.js",array('jquery','jquery-ui-core','jquery-ui-widget'), "1.0");
	wp_enqueue_script("jquery-ui-sortable", HURL."/js/jquery.ui.sortable.js", array('jquery','jquery-ui-mouse',"jquery-ui-widget"), "1.0");
	wp_enqueue_script("jquery-ui-datepicker", HURL."/js/jquery.ui.datepicker.js", array('jquery','jquery-ui-core'), "1.0");
	wp_enqueue_script("event-admin", HURL."/js/event.js", array('jquery','jquery-ui-core'), "1.0");
	wp_enqueue_style("event-admin-css", HURL."/css/event.css");
	  
	}
	 
}

add_action("init","addEventScripts");


add_action("manage_posts_custom_column",  "events_custom_columns");
add_filter("manage_edit-event_columns", "events_edit_columns");
 
function events_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Event Title",
    "description" => "Description",
    "start" => "Starts",
    "end" => "Ends",
  );
 
  return $columns;
}
function events_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "start":
      $custom = get_post_custom($post->ID);
      $data = $custom["event_data"][0];
       $data = unserialize($data);
      echo $data["starting_date"].", ".$data["time_from_hr"].":".$data["time_from_min"].':'.$data["time_from_zone"];
      break;
    case "end":
      $custom = get_post_custom($post->ID);
      $data = $custom["event_data"][0];
       $data = unserialize($data);
      echo $data["starting_date"].", ".$data["time_to_hr"].":".$data["time_to_min"].':'.$data["time_to_zone"];
      break;
  }
}