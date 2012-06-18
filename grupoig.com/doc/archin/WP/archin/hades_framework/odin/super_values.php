<?php
function setMedia()
{
	$p_slides =   array ( 
	   "src" => URL."/sprites/i/default.jpg",
	   "link" => "",  "description" => "" , "type" => "upload" , 
	   "title" => "" );
	 
	 $path = __FILE__;
     $pathwp = explode( 'wp-content', $path );
     $wp_url = $pathwp[0]."wp-content/uploads/default.jpg";

	 $cstatus =   copy( TEMPLATEPATH."/sprites/i/default.jpg",  $wp_url  );
	 
	
	 $wp_query = new WP_Query("post_type=portfolio&posts_per_page=-1");
	 
	 while ( $wp_query->have_posts() ) : $wp_query->the_post();
	 
	 $no = rand(2,7);
	 $portfolio_slides = array();
	 for($i=0;$i<$no;$i++)
     $portfolio_slides[] = $p_slides;
	 
	 $id =  get_the_ID();
	 update_post_meta($id,"gallery_items",$portfolio_slides);
	 
	 if($cstatus) {
	 
	 $filename = "default.jpg";
	 $wp_filetype = wp_check_filetype(basename($filename), null );
     $attachment = array(
     'post_mime_type' => $wp_filetype['type'],
     'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
     'post_content' => '',
     'post_status' => 'inherit'
      );
      $attach_id = wp_insert_attachment( $attachment, $filename, $id );
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
      wp_update_attachment_metadata( $attach_id, $attach_data );
      set_post_thumbnail($id,   $attach_id );
	 }
	 
	 
	endwhile;
	
	 $wp_query = new WP_Query("post_type=gallery&posts_per_page=-1");
	 
	 while ( $wp_query->have_posts() ) : $wp_query->the_post();
	 
	 $no = rand(2,7);
	 $portfolio_slides = array();
	 for($i=0;$i<$no;$i++)
     $portfolio_slides[] = $p_slides;
	 
	 $id =  get_the_ID();
	 update_post_meta($id,"gallery_items",$portfolio_slides);
	 
	 if($cstatus) {
	 
	 $filename = "default.jpg";
	 $wp_filetype = wp_check_filetype(basename($filename), null );
     $attachment = array(
     'post_mime_type' => $wp_filetype['type'],
     'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
     'post_content' => '',
     'post_status' => 'inherit'
      );
      $attach_id = wp_insert_attachment( $attachment, $filename, $id );
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
      wp_update_attachment_metadata( $attach_id, $attach_data );
      set_post_thumbnail($id,   $attach_id );
	 }
	 
	 
	endwhile;
	
	 $wp_query = new WP_Query("post_type=post&posts_per_page=-1");
	 
	 while ( $wp_query->have_posts() ) : $wp_query->the_post();
	 
	 $id =  get_the_ID();
	 
	 if($cstatus) {
	 
	 $filename = "default.jpg";
	 $wp_filetype = wp_check_filetype(basename($filename), null );
     $attachment = array(
     'post_mime_type' => $wp_filetype['type'],
     'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
     'post_content' => '',
     'post_status' => 'inherit'
      );
      $attach_id = wp_insert_attachment( $attachment, $filename, $id );
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
      wp_update_attachment_metadata( $attach_id, $attach_data );
      set_post_thumbnail($id,   $attach_id );
	 }
	 
	 
	endwhile;
	
	
	 $wp_query = new WP_Query("post_type=events&posts_per_page=-1");
	 
	 while ( $wp_query->have_posts() ) : $wp_query->the_post();
	 
	  $no = rand(2,7);
	 $portfolio_slides = array();
	 for($i=0;$i<$no;$i++)
     $portfolio_slides[] = $p_slides;
	 
	 $id =  get_the_ID();
	 update_post_meta($id,"gallery_items",$portfolio_slides);
	 
	 if($cstatus) {
	 
	 $filename = "default.jpg";
	 $wp_filetype = wp_check_filetype(basename($filename), null );
     $attachment = array(
     'post_mime_type' => $wp_filetype['type'],
     'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
     'post_content' => '',
     'post_status' => 'inherit'
      );
      $attach_id = wp_insert_attachment( $attachment, $filename, $id );
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
      wp_update_attachment_metadata( $attach_id, $attach_data );
      set_post_thumbnail($id,   $attach_id );
	 }
	 
	 
	endwhile;
}

$h_slides = array();
$h_images_sources = array(URL."/sprites/i/default.jpg",URL."/sprites/i/default.jpg",URL."/sprites/i/default.jpg",URL."/sprites/i/default.jpg",URL."/sprites/i/default.jpg");
$h_description =  array(
"Aliquam commodo, justo scelerisque suscipit varius, purus ligula posuere justo, gravida dictum odio neque in quam. Vestibulum luctus placerat tincidunt. Sed a est magna, at semper nulla. Fusce pretium bibendum vestibulum. ",
"In pretium blandit mi. Proin odio massa, sagittis a euismod ac, varius non nunc. In hac habitasse platea dictumst. Nullam commodo, urna a blandit faucibus, turpis dui porta lorem, ac varius massa est quis arcu.",
"Morbi porttitor, magna sed rhoncus semper, sapien ipsum auctor orci, in pretium orci nisi a ipsum. Morbi ut ligula purus, a blandit ante. Nullam suscipit, quam non varius tempus, mi tellus vulputate nulla, in pharetra elit ante nec tortor. ",
"Aliquam commodo, justo scelerisque suscipit varius, purus ligula posuere justo, gravida dictum odio neque in quam. Vestibulum luctus placerat tincidunt. Sed a est magna, at semper nulla. Fusce pretium bibendum vestibulum. ",
"In sem magna, pharetra eu pulvinar vitae, porta sit amet arcu. Nunc sagittis convallis egestas. Phasellus vel metus quis neque rhoncus tristique in eu sem. ",

);
$h_title =  array(
"Aliquam commodo justo scelerisque. ",
"Vestibulum luctus placerat tincidunt",
"Morbi porttitor, magna sed rhoncus semper ",
"Nullam commodo urna a blandit faucibus. ",
"Vestibulum ante ipsum primis in faucibus orci",

);

$i =0;
foreach($h_title as $title)
{
	$h_slides[] = array(
				'src' => $h_images_sources[$i],
				'link' => "http://themeforest.net/user/wptitans/portfolio" ,
				'description' => $h_description[$i++] ,
				'type' => "upload",
				'id' => "",
				'title' => $title
				);
}

function sethomecolumns()
{
  
  $blurb_text = "Do you need custom forms in a snap or create as many sidebars as you need or you want any style you please or just want to impress your clients.";
  update_option("arc_blurb_text",$blurb_text);
   update_option("arc_blurb_link","http://themeforest.net/user/wptitans");
    update_option("arc_blurb_label","Buy it now");
	
}

function enable_widgets()
{




		

$sidebars = get_option("sidebars_widgets");

$sidebars["sidebar-1"] = array("custombox-2","scrollabepost-2");
$sidebars["sidebar-2"] = array("featurepost-2","contactform-2");
$sidebars["sidebar-3"] = array ( "tabbedwidget-2", "custombox-3" , "scrollabepost-3","contactform-3","featurepost-3","tag_cloud-2");
$sidebars["sidebar-4"] = array();
$sidebars["sidebar-5"] = array("custombox-4");
$sidebars["sidebar-6"] = array("latesttweets-2");
$sidebars["sidebar-7"] = array("links-2");
$sidebars["sidebar-8"] = array("custombox-5");
$sidebars["sidebar-9"] = array("nav_menu-2");
$sidebars["sidebar-10"] = array("nav_menu-3");
$sidebars["sidebar-11"] = array("nav_menu-4");
$sidebars["sidebar-12"] = array();
$sidebars["sidebar-13"] = array("nav_menu-5","custombox-6");

update_option("sidebars_widgets",$sidebars);


// first all the custom boxes


$custom_box = get_option("widget_custombox");	
$custom_box[2] =array(
	"link" => "",
	"description" => "<p>It's still unbranded so you don't have to worry about 
one of your clients to see your using a third party 
developer. </p>

<p>Echea has even more things to play with then our previous released themes and we're almost at a point that you won't need anymore plug-ins.</p>

<p>Packed with a tons of features which will make your life so much easier, so don't hesitate and get your's today.</p>
",
	"title" => "We're trying to improve our add-ons in both usability and styling s. That's we've decided to keep on working on the theme's option panel until we have the perfect panel build in for you'll. In Echea we've made the panel even more usable then before and removed the clutter.",
	"intro_image_link" => "http://wptitans.com/echea/files/2011/04/gear_wheel.png"
	
	
	);
$custom_box[3] =array(
	"link" => "#",
	"title" => "Custom Box",
	"description" => "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas hendrerit, dolor convallis malesuada placerat, purus ligula pulvinar velit, at hendrerit libero ligula ut nunc. Integer eget lacus quam, ut semper massa. </p>

<p>Fusce vestibulum elementum mauris vel ullamcorper. Sed scelerisque, dui non elementum mattis, mauris purus bibendum nunc, viverra ultrices lorem sapien sed erat. Sed varius dolor et nibh luctus auctor. Duis adipiscing viverra lectus, auctor egestas nulla rhoncus eu.</p>",
	"intro_image_link" => "#"
	
	
	);	

$custom_box[4] =array(
	"link" => "#",
	
	"description" => "<p>Donec eget ligula sit amet orci mattis sagittis. Nam urna purus, condimentum non dignissim vitae.</p>

<p>Maecenas imperdiet orci in velit cursus tempor. Maecenas sapien libero, varius sit amet consequat a, imperdiet a augue. </p>",
	"intro_image_link" => "#",
	"title" => "Vestibulum ultrices lacus a lorem dictum conse cte tur. Vestibulum et elit dui, vitae dictu m libero."
	
	
	);	
	 
$custom_box[5] =array(
	"link" => "#",
	
	"description" => "<p>Donec eget ligula sit amet orci mattis sagittis. Nam urna purus, condimentum non dignissim vitae.</p>

<p>Maecenas imperdiet orci in velit cursus tempor. Maecenas sapien libero, varius sit amet consequat a, imperdiet a augue. </p>",
	"intro_image_link" => "#",
	"title" => "Vestibulum ultrices lacus a lorem dictum conse cte tur. Vestibulum et elit dui, vitae dictu m libero."
	
	
	);	
	
$custom_box[6] =array(
	"link" => "#",
	
	"description" => "<p>Seen enough? Then don't hesitate and buy this awesome theme and start building. It's for sale for only 35$ at themeforest.net</p>

<p>Or take a look at our other Premium plugins and WordPress Themes.</p>",
	"intro_image_link" => "#",
	"title" => "Can't wait any longer?"
	
	
	);		
		 	 
$custom_box["_multiwidget"] =   1 ;
update_option("widget_custombox",$custom_box);

$tabbed = get_option("widget_tabbedwidget");	
$tabbed[2] = array("title" => "");
$custom_box["_multiwidget"] =   1 ;
update_option("widget_tabbedwidget",$tabbed);


$scrollable = get_option("widget_scrollabepost");	
$scrollable[2] = array( "title" => "Latest from the blog" , "post_type" => "recent");
$scrollable[3] = array( "title" => "Recent stuff" , "post_type" => "popular");
$scrollable["_multiwidget"] =   1 ;
update_option("widget_scrollabepost",$scrollable);


$contact = get_option("widget_contactform");	
$contact[2] = array(
"title" => "Quick Contact",
"email" => "test@testingemail.com",
 "messsage" =>""

);
$contact[3] = array(
"title" => "Contact Form",
"email" => "test@testingemail.com",
 "messsage" =>""

);
$contact["_multiwidget"] =   1 ;
update_option("widget_contactform",$contact);

$tag_cloud = get_option("widget_tag_cloud");	
$tag_cloud[2] = array( "title" => "Tags" , "taxonomy" => "post_tag");
$tag_cloud["_multiwidget"] =   1 ;
update_option("widget_tag_cloud",$tag_cloud);

$feature = get_option("widget_featurepost");	
$feature[2] =  array
        (
            "count" => 3,
            "title" => "Watch some of my most recent work here",
            "post_type" => "portfolio"
         );
 $feature[3] =  array
(
	"count" => 4,
	"title" => "Feature Posts",
	"post_type" => "portfolio"
 );
$feature["_multiwidget"] =   1 ;
update_option("widget_featurepost",$feature);


$tweet = get_option("widget_latesttweets");	
$tweet[2] =  array
        (
            "twitter_id" => "wptitan",
            "title" => "Latest fromTwitter",
            "count" => 2
         );
$tweet["_multiwidget"] =   1 ;
update_option("widget_latesttweets",$tweet);


global $wpdb;
$table_db_name = $wpdb->prefix . "terms";
$rows = $wpdb->get_results("SELECT * FROM $table_db_name where name='Sidebar menu 1' OR name='Sidebar Menu 2' OR name='Sidebar Menu 3'",ARRAY_A);
$menu_ids = array();
foreach($rows as $row)
$menu_ids[$row["name"]] = $row["term_id"] ; 
$nav[2] = array
        (
            "title" =>  "Shortcodes",
            "nav_menu" => $menu_ids["Sidebar menu 3"] 
        );
$nav[3] = array
        (
            "title" =>  "Features",
            "nav_menu" => $menu_ids["Sidebar Menu 1"] 
        );			
$nav[4] = array
        (
            "title" =>  "Pages",
            "nav_menu" => $menu_ids["Sidebar Menu 2"] 
        );	
$nav[5] = array
        (
            "title" =>  "Pages",
            "nav_menu" => $menu_ids["Sidebar Menu 2"] 
        );		
update_option("widget_nav_menu",$nav);

$links = get_option("widget_links");	
$links[2] = array( "images" => 0 , "name" => 1 , "description" =>  0 ,"rating" => 0, "category" => 0);
$links["_multiwidget"] =   1 ;
update_option("widget_links",$links);

//echo "<pre>"; print_r($nav);	echo "</pre>";	
		
		
		
		
}

function enable_custom_sidebars(){
	
	 $active_sidebars = array ( "Right Sidebar" ,"Right Sidebar 2","Right Sidebar 1"," Left Sidebar 2"," Left Sidebar 1","Contact Sidebar");
	  update_option("archin_active_sidebars", $active_sidebars);
	  
	  
	}

function enable_theme_content(){
	
	
	$contact_forms = array ( 
	 
	 array ( "key" => "48902EION2" , "email_notification" => "" , "captacha_verification" => "" , "auto_respond" => "", "layout_style" => "block" ,  "label_values" => array ( "Name","Email","Service","Subject" ) , "name_value" => array ("","","","" ), "form_element" => array ( "text" , "text" ,"select : Web Development, Wordpress, Graphic Design" ,"textarea" ) ,"email_notification_mail" => ""), 
		 
	 array ( "key" => "5UX0G72F38","email_notification" =>"", "captacha_verification" => true ,"auto_respond" => true ,"layout_style" => "block", "label_values" => array ( "Name","Address","Subject","What's it about","Comment" ) ,"name_value" => array ( "","","","","" ) ,"form_element" => array ( "text", "text" ,"text", "select" ,"textarea" ) ,"email_notification_mail" =>"" ) ) ;
	  
	   update_option('archin_forms',$contact_forms);
		   
	 
	}	
	
	
function install_templates()
{
	global $wpdb;
	$table_db_name = $wpdb->prefix . "teditor";
	$farray = array("query1.txt","query2.txt","query3.txt","query4.txt","query5.txt");
	
	foreach($farray as $fname) {
	$file = HPATH."/odin/$fname";
    $fh = fopen($file, 'r');
	$super_query = fread($fh, filesize($file));
    $flag = $wpdb->query("INSERT INTO $table_db_name $super_query");
	
	
	}
	
	

}