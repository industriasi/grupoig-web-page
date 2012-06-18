<?php

function addShortcodesstuff() {
	
	if ( !is_admin() ) {
		
	 wp_enqueue_style("shortcodes", HURL."/shortcodes/css/shortcodes.css", false, "1.0", "all");
	 wp_register_script('shorcodes-js', HURL. '/shortcodes/js/shortcodes.js', array('jquery','jQuery UI'), '1.8' );
	 wp_enqueue_script("shorcodes-js");
	 
	}
	
	
   
	 
}    
add_action('init', 'addShortcodesstuff');
include('blog/blog.php');
include('layout/layout.php');
include('UI/ui.php');
include('typography/typography.php');
include('widgets/widgets.php');
include('media/media.php');
include('gallery/gallery.php');
