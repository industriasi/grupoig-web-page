<?php 

define('VPATH',TEMPLATEPATH."/hades_framework/smart_sense");
 
   
function vmenu() 
  {
	  if(function_exists('add_submenu_page'))
	  {
		  add_submenu_page("elements.php","Smart Sense (Vulcan)","Smart Sense", "edit_themes","vmenu","vwrap");
	  }
	  else
	  add_menu_page("Smart Sense (Vulcan)","Smart Sense", "edit_themes","vmenu","vwrap", HURL."/smart_sense/images/ico.png" );  
	
   }
function vinit() {
	
	if(isset($_GET['page']) && $_GET['page']=='vmenu')
	  {
	    wp_enqueue_style("vulcan",  HURL."/smart_sense/vulcan.css", false, "1.0", "all");
	    wp_enqueue_script("vulcan-js", HURL."/smart_sense/vulcan.js","1.0");
	  }
} 
function vwrap() {
	
	 
	global $query_string;
	global $wpdb;
    global $post;
	$api_key = get_option('arc_api_key');
 
    
	
    $myposts  = get_posts( array( 
	'numberposts'     => -1, 
	'orderby'         => 'post_date',
    'order'           => 'DESC',
    'post_type'       => 'post',
    'post_status'     => 'publish' ) );
   

	?>
    
    <script type="text/javascript">
(function() {
var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
s.type = 'text/javascript';
s.async = true;
s.src = 'http://widgets.digg.com/buttons.js';
s1.parentNode.insertBefore(s, s1);
 })();
</script>

	<div class="wrap" id="vulcan_wrap">
       <h2>Smart Sense</h2>
       <?php 
	   if($api_key=="")
	   {
		   ?>
		   
		   <div  class="updated fade">Google API KEY not set, shortened urls are disabled .To enable it goto Option Panel > Misc > Google API KEY.</div>
		   <?php
	   }
	   ?>
       <div>
       <table class="widefat post fixed" cellspacing="0"> 
	<thead> 
	<tr> 
	<th scope="col" class="manage-column" style="">POST TITLE</th> 
    <th scope="col" class="manage-column" style="">POST LINK</th> 
    <th scope="col" class="manage-column vgl" style="">POST SHORTENED URL</th>
    <th scope="col" class="manage-column vshrink" style="">ANALYTICS</th>
    <th scope="col" class="manage-column vexpand" style="">Spread the word</th>  
	</tr> 
	</thead> 
 
	<tfoot> 
	<tr> 
	<th scope="col" class="manage-column" style="">POST TITLE</th> 
    <th scope="col" class="manage-column" style="">POST LINK</th> 
    <th scope="col" class="manage-column" style="">POST SHORTENED URL</th>
    <th scope="col" class="manage-column" style="">ANALYTICS</th>
    <th scope="col" class="manage-column" style="">Spread the word</th>  
	</tr> 
	</tfoot> 
 
	<tbody>
   <?php 
   include(VPATH."/google.php");
   //The Loop
   $icon =  HURL."/hades_framework/smart_sense/images/";
   $shortUrl  = "";
  
   $twitter_via = (get_option("arc_twitter_id")=="") ? "" : "&via=".get_option("arc_twitter_id");
   
	foreach( $myposts as $post ) :	setup_postdata($post);
	$url = get_permalink();
	$tags = get_tags();
	$hash_tags = '';
	$hash_count = 0;
	foreach($tags as $tag)
	{
		if($hash_count>4)
		break;
		$hash_tags = $hash_tags." #".$tag->name;
		$hash_count++;		
	}
	$id = get_the_ID();
	
	if($api_key!="") {
	
	if(get_post_meta($id, "glurl",true)=="")
	{
      $objGoogl = new Googl($api_key);
      $shortUrl = $objGoogl->shorten($url);
 	  add_post_meta($id, "glurl",$shortUrl,true);
	}
	else
	{
		$shortUrl = get_post_meta($id, "glurl",true);
	}
	
	}
	else
	$shortUrl = "Disabled";
   
    
	
	
	
	?>
    
	<tr><td><?php the_title(); ?></td><td><?php the_permalink(); ?></td><td><?php echo $shortUrl; ?></td>
    <td><?php 
	if(get_post_meta($id, "view",true)=="")
	echo "Total View : 0"; 
	else
	echo "Total View : ".get_post_meta($id, "view",true);
	
	?>
  
   
    </td>
    <td>
    <ul class="clearfix social-panel">
   
       <li><a href="http://www.reddit.com/submit?url=<?php echo urlencode(get_permalink())."&title=".(str_replace(" ","+",get_the_title())); ?>" class="vshare-button reddit-button"><span class="reddit"></span> Reddit</a></li>
       
      
       <li><a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(get_permalink()); ?>" class="vshare-button stumble-button"><span class="stumbleupon"></span> Stumble </a></li>
      
       
       <li><a href="http://digg.com/submit?style=no&url=<?php echo urlencode(get_permalink())."&title=".(urlencode(get_the_title())); ?>" class="vshare-button DiggThisButton DiggIcon "></a></li>
       
       
       <li><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink())."&t=".(urlencode(get_the_title())); ?>" class="vshare-button fb-button"><span class="facebook"></span> Share</a>
       </li>
        
       <li><a href="http://twitter.com/share?url=<?php 
	   
	   if($shortUrl=="Disabled")
	    echo urlencode(get_permalink())."{$twitter_via}&text=".(urlencode(get_the_title()." $hash_tags")); 
	   else
	   echo urlencode($shortUrl)."{$twitter_via}&text=".(urlencode(get_the_title()." $hash_tags")); 
	   
	   ?>&count=none" class="vshare-button tweet-button"><span class="tweet"></span> Tweet</a></li>
        
        
        
   </ul> 
    </td>
    </tr>
	
	<?php
	endforeach;

//Reset Query

   
   ?>
    </tbody>
    
    </table>
  <?php   posts_nav_link();  wp_reset_query();?>
      </div>
    </div>
   
	
	<?php
	
	
	 }


add_action('admin_menu','vmenu');
add_action('admin_init','vinit');


?>