<?php
/*
Third party functions

*/


function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

if ( ! function_exists( 'hades_comment' ) ) :

function hades_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
    
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	    	<div id="comment-<?php comment_ID(); ?>">
            
		        <div class="comment-author vcard clearfix">
			        <?php echo get_avatar( $comment, 80 ); ?>
                    <ul class="date-info clearfix">
			        <li class="clearfix">
					<?php printf( sprintf( '<span class="fn">%s</span>', get_comment_author_link() ) ); ?>
		            <?php if ( $comment->comment_approved == '0' ) : ?>
		                	<em><?php _e( 'Your comment is awaiting moderation.'  , 'h-framework'); ?></em>
			  		<?php endif; ?>
                    
                    <div class="comment-meta commentmetadata">   <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
		        	<?php
				  /* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s' ,'h-framework' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)','h-framework' ), ' ' );
	        		?>
		          </div><!-- .comment-meta .commentmetadata -->
        
                  
                  </li>
                  <li>
                   <div class="comment-body"><?php comment_text(); ?></div>
                  </li>
                  </ul>
                  
                         
        
                </div><!-- .comment-author .vcard -->
		

		

		

		<div class="reply clearfix">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:' , 'h-framework' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)' , 'h-framework'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
	if($file_count==0)
	$file_post = array();
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}


			  
	function count_views()
{
	if(is_single() && !is_page()){
	global $post;
	$id = $post->ID;
	
	if(get_post_meta($id, "view",true)=="")
	{
		
		add_post_meta($id, "view", "1",true);
	}
	else
	{
		
		$view = (int)get_post_meta($id, "view",true);
		$view = $view + 1;
		update_post_meta($id, "view", $view );
	}
	
	
	}
}

add_action("wp_head","count_views");


 function my_theme_activate() {
   header("Location: admin.php?page=visual_import");
 }
 wp_register_theme_activation_hook('Echea', 'my_theme_activate');

 function my_theme_deactivate() {
    // code to execute on theme deactivation
 }

wp_register_theme_deactivation_hook('Echea', 'my_theme_deactivate');


function wp_register_theme_activation_hook($code, $function) {
    $optionKey="theme_is_activated_" . $code;
    if(!get_option($optionKey)) {
        call_user_func($function);
        update_option($optionKey , 1);
    }
}

function wp_register_theme_deactivation_hook($code, $function) {
     $GLOBALS["wp_register_theme_deactivation_hook_function" . $code]=$function;
     $fn=create_function('$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');
     add_action("switch_theme", $fn);
}