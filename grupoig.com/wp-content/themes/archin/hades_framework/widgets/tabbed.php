<?php 


class TabbedWidget extends WP_Widget {
	
	function TabbedWidget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'TabbedWidget', 'description' => __('A tabbed widget for showing popular, most commented and recent posts.','h-framework') );

		/* Widget control settings. */
		$control_ops = array();
		 parent::WP_Widget(false,__("Tabbed Widget",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance; 
		$instance['title'] =  strip_tags($new_instance['title']);  
		return $instance;
		}
	function form($instance) { 
	$title = $instance['title'];
	?> 
    
    <p class="hades-custom">
     <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>  
	
	<?php 
	
	}
	function widget($args, $instance) { 
	extract($args); 
	
	$title = esc_attr($instance['title']);
	
	echo $before_widget; 
		if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
	?>
    
     <div class="tabs">
          <ul>
              <li><a href="#tabs-1"><?php _e('Recent','h-framework'); ?></a></li>
              <li><a href="#tabs-2"><?php _e('Popular','h-framework'); ?></a></li>
              <li><a href="#tabs-3"><?php _e('Viewed','h-framework'); ?></a></li>
          </ul>
         <div id="tabs-1">
           <ul class="posts-sidebar" >
				  <?php 
                  $popPosts = new WP_Query();
                  $popPosts->query('showposts=5');
                  while ($popPosts->have_posts()) : $popPosts->the_post(); ?>
            
                  <li class="clearfix" >
                      <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                      <div class="image">
                          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(50,999)); ?></a>
                      </div><!--image-->
                      <?php endif; ?>
                      
                      <div class="description">
                          <h3><a href="<?php the_permalink(); ?>"><?php $this->short_title(29,get_the_title()); ?></a></h3>
                           <p><?php $this->short_title( 40 , get_the_content() ); ?></p>
                      </div><!--details-->
                  </li>
            
            <?php endwhile; 
			 wp_reset_query(); ?>

            </ul>
    </div>  
       <div id="tabs-2">
              <ul class="posts-sidebar" >
				  <?php 
                  $popPosts = new WP_Query();
                  $popPosts->query('caller_get_posts=1&showposts=5&orderby=comment_count');
                  while ($popPosts->have_posts()) : $popPosts->the_post(); ?>
                  
                  <li class="clearfix" >
                      <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                      <div class="image">
                          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(50,999)); ?></a>
                      </div><!--image-->
                      <?php endif; ?>
                      
                      <div class="description">
                          <h3><a href="<?php the_permalink(); ?>"><?php $this->short_title(29,get_the_title()); ?></a></h3>
                          <p><?php $this->short_title( 70 , get_the_content() ); ?></p>
                      </div><!--details-->
                  </li>
            
            <?php endwhile;
			wp_reset_query(); ?>
    
        </ul>
      </div>
     
    <div id="tabs-3">
              <ul class="posts-sidebar" >
				  <?php 
				
				   
                //  $query = new WP_Query();
                 query_posts('posts_per_page=-1');
				  $viewed_posts = array();
				  $viewflags = array();
				  
				  $i = 0;
				  
                  while (have_posts()) : the_post(); 
				  
				
				   if(get_post_meta(get_the_ID(), "view",true)!="")
	              {
		
		               $viewflags[$i] = get_post_meta(get_the_ID(), "view",true);
					   $viewed_posts[$viewflags[$i].''] = get_the_ID();
					   $i++;
	              }
				  
				  
				
				   endwhile; 
			 wp_reset_query(); 
			  sort($viewflags,SORT_NUMERIC );
				 $viewflags =   array_reverse ( $viewflags  );   
			 
			  
			 for($i=0;$i<count($viewflags);$i++)
			 {
				 if($i>5)
				 break;
				 if($pid!=$viewed_posts[$viewflags[$i]])
				 {
				 $pid = $viewed_posts[$viewflags[$i]];
				 $tpost = get_post($pid,ARRAY_A);
				 ?>
				 
                   <li class="clearfix" >
                      <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail($pid))  ) : /* if post has post thumbnail */ ?>
                      <div class="image">
                          <a href="<?php echo $tpost["guid"]; ?>"><?php echo get_the_post_thumbnail($pid,array(50,999)); ?></a>
                      </div><!--image-->
                      <?php endif; ?>
                      
                      <div class="description">
                          <h3><a href="<?php  echo $tpost["guid"]; ?>"><?php $this->short_title(29,$tpost["post_title"]); ?></a></h3>
                          
                        <?php  if((int)$viewflags[$i]<=1)
						       echo "<p> $viewflags[$i] view </p>";
							   else
                                echo "<p> $viewflags[$i] views </p>";
                          
						  
						 ?> 
                          
                          
                      </div><!--details-->
                  </li>
                  
				 
				 <?php
				 }
			 }
			 ?>

            </ul>
       </div>
 </div>
 

    
    <?php
	echo $after_widget; 
		
		}
	function short_title($num,$stitle) {

$limit = $num+1;
$title = str_split($stitle);
$length = count($title);
if ($length>=$num) {
$title = array_slice( $title, 0, $num);
$title = implode("",$title)."...";
_e( $title ,'h-framework');
} else {
_e( $stitle ,'h-framework');
}

}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("TabbedWidget");'));
?>