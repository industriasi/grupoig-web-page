<?php 

/* =============================================================== */
/* ------------------------- CONSTANTS --------------------------- */
/* =============================================================== */

define("HPATH",TEMPLATEPATH."/hades_framework");
define("HURL",get_bloginfo('template_url')."/hades_framework");

define("PATH",TEMPLATEPATH);
define("URL",get_template_directory_uri());


$themename = "Archin";
$shortname = "arc";


/* =============================================================== */
/* ------------------------- INIT HELPER ------------------------- */
/* =============================================================== */

include(HPATH."/helper/init_helper.php");



$helper = new Helper();
$enchance = new Enchance();

/* =============================================================== */
/* ------------------------- Typopgraphy ------------------------- */
/* =============================================================== */
include(HPATH."/helper/Typography.php");

/* =============================================================== */
/* --------------------- Basic rountines ------------------------- */
/* =============================================================== */

$helper->initScripts();
$helper->initStyles();
$helper->customExcerpt();
/* =============================================================== */
/* ---------------------------- MENUS ---------------------------- */
/* =============================================================== */


$menus =  array(
		  	'primary_nav' => 'Primary Menu',
			'footer_nav' => 'Bottom Footer Menu'
		  );
$helper->registerMenus($menus);		 

/* ================================================================ */
/* ------------------------ Custom Features ----------------------- */
/* ================================================================ */

//$enchance->enableCustomThumbnails();
//$enchance->enableBlurb();
//$enchance->controlBackground();
$enchance->customFormatter();
$enchance->enableUnlimitedSidebars();


/* ================================================================ */
/* --------------------------- Mega Menu -------------------------- */
/* ================================================================ */

include(HPATH."/helper/megamenu.php");


/* ================================================================ */
/* ------------------------ Custom POST types --------------------- */
/* ================================================================ */

include(HPATH."/custom_types/portfolio.php");
include(HPATH."/custom_types/gallery.php");
include(HPATH."/custom_types/event.php");
include(HPATH."/custom_types/message.php");

/* ================================================================ */
// ------------------------ Options Panel--------------------------
/* ================================================================ */


include(HPATH."/option_panel/options.php");
include(HPATH.'/option_panel/elements.php');

/* ================================================================ */
/* -------------------------- Font Mangaer ------------------------ */
/* ================================================================ */

include(HPATH."/font_manager/init.php");

/* ================================================================ */
/* --------------------------- Sidebars --------------------------- */
/* ================================================================ */

include(HPATH."/helper/sidebar.php");


/* ================================================================ */
/* -------------------------- Smart Sense-------------------------- */
/* ================================================================ */

include(HPATH."/smart_sense/prototype.php");

/* ================================================================ */
/* -------------------------- Shortcodes -------------------------- */
/* ================================================================ */

include(HPATH."/shortcodes/init_shortcodes.php");

/* ================================================================ */
/* ------------------------ Slider Manager ------------------------ */
/* ================================================================ */

include(HPATH."/slidermanager/init_slider.php");

/* ================================================================ */
/* -------------------------- FormBuilder ------------------------- */
/* ================================================================ */

include(HPATH."/formbuilder/init.php");

/* ================================================================ */
/* ------------------------ Titan Installer ----------------------- */
/* ================================================================ */

include(HPATH."/odin/init.php");


/* ================================================================ */
// --------------------------- Widgets ----------------------------
/* ================================================================ */

$widgets = array( "ads125", "ads300" , "ads300100" ,  "ads234" ,"tabbed" ,"flickr-widget" , "paypal" , "contact-form" , "facebook-like" , 'latest-tweets', "googlemap"  , "contact-set" , "video","custombox","featured-posts","scrollable-posts");

foreach($widgets as $widget)
include(HPATH."/widgets/$widget.php");

function unregister_default_wp_widgets() {

	unregister_widget('WP_Widget_Recent_Posts');
	
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

/* ================================================================ */
/* --------------------------- Sidebars --------------------------- */
/* ================================================================ */


$homebar = array(
  'name' => 'Blog Sidebar',
  'description' => 'Widgets in this area will be shown in the right blog sidebar.',
  'before_widget' => '<div class="sidebar-wrap clearfix">',
  'after_widget' => '</div>',
  'before_title' => '<h5 class="custom-font heading">',
  'after_title' => '</h5>',
);

$homepage_content = array(
  'name' => 'Home Page Content',
  'description' => 'Widgets in this area will be shown in the home page (3 columns per row).',
  'before_widget' => '<div class="homepage-wrap clearfix">',
  'after_widget' => '</div>',
  'before_title' => '<h5 class="custom-font heading">',
  'after_title' => '</h5>',
);

$homepage_content2 = array(
  'name' => 'Home Page Content2',
  'description' => 'Widgets in this area will be shown in the home page (1 column per row).',
  'before_widget' => '<div class="homepage2-wrap clearfix">',
  'after_widget' => '</div>',
  'before_title' => '<h5 class="custom-font heading">',
  'after_title' => '</h5>',
);

$contact = array(
  'name' => 'Contact Sidebar',
  'description' => 'Widgets in this area will be shown in the contact page sidebar.',
  'before_widget' => '<div class="contact-wrap clearfix">',
  'after_widget' => '</div>',
  'before_title' => '<h5 class="custom-font heading">',
  'after_title' => '</h5>',
);

$pagebar = array(
  'name' => 'Page Sidebar',
  'description' => 'Widgets in this area will be shown in the page sidebar.',
  'before_widget' => '<div class="page-wrap clearfix">',
  'after_widget' => '</div>',
  'before_title' => '<h5 class="custom-font heading">',
  'after_title' => '</h5>',
);


$footerbars = array(
  'name' => ("Footer Column %d"),
  'description' => 'Widgets will be shown in the footer.',
  'before_widget' => '<div class="footer-wrap">',
  'after_widget' => '</div>',
  'before_title' => '<h4 class="custom-font heading">',
  'after_title' => '</h4>',
);


$sidebars = array($homepage_content ,$homepage_content2 ,$homebar, $pagebar);

if(function_exists('register_sidebars')){
	
	foreach($sidebars as $sidebar)
	register_sidebar($sidebar);
	$footer_columns = (!get_option("arc_footer_columns")) ? "4 Columns" : get_option("arc_footer_columns");
	
	switch($footer_columns)
	{
		
		case "2 Columns" : $footer_columns = 2; break;
		case "3 Columns" : $footer_columns = 3; break;
		case "4 Columns" : $footer_columns = 4; break;
	}
	
	register_sidebars($footer_columns,$footerbars);

} 

$dynamic_menu_widgets = get_option("hmenu_widgets");
if($dynamic_menu_widgets=="")
$dynamic_menu_widgets = array();

$dynamic_active_sidebars = get_option("archin_active_sidebars");
if($dynamic_active_sidebars=="")
$dynamic_active_sidebars = array();


foreach($dynamic_menu_widgets as $key => $widget)
{
	$temp_widget = array(
  'name' => __( $widget." Menu"),
  'id' => $key,
  'description' => __('Widgets in this area will be shown in the '.$widget.' menu. '),
  'before_widget' => '<div class="menu-wrap clearfix">',
  'after_widget' => '</div>',
  'before_title' => '<h5 class="custom-font heading">',
  'after_title' => '</h5>',
);

register_sidebar($temp_widget);


}


foreach($dynamic_active_sidebars as  $widget)
{
	
	$temp_widget = array(
  'name' => __( $widget),
  'description' => __('This is a dynamic sidebar'),
  'before_widget' => '<div class="dynamic-wrap sidebar-wrap clearfix">',
  'after_widget' => '</div>',
  'before_title' => '<h5 class="custom-font heading">',
  'after_title' => '</h5>',
);

register_sidebar($temp_widget);

}

