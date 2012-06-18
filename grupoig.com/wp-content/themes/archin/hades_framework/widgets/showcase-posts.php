<?php 


class ShowcasePost extends WP_Widget {
	
	function ShowcasePost() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ShowcasePost', 'description' => __('Show posts or recent work in a scroller.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200);
		 parent::WP_Widget(false,__("Showcase Posts",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			$instance['count']= strip_tags($new_instance['count']); 
			$instance['title']= strip_tags($new_instance['title']); 
			$instance['post_type']= strip_tags($new_instance['post_type']); 
			return $instance;
	}
	function form($instance) {
		 
		$count = esc_attr($instance['count']);
			$title = $instance['title'];
		$post_type = $instance['post_type'];	
	
		 ?>
        
        <p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('post_type'); ?>"> <?php _e('Post Type','h-framework'); ?> </label>
		<select name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>">
		 <?php 
		 $array = array("popular","recent","featured","portfolio");
		 foreach($array as $val){
		 
		 if($val==$post_type)
		 echo "<option value='$val' selected>$val</option>";
		 else
		 echo "<option value='$val'>$val</option>";
		 
		 }
		 ?>
        </select>
		</p>
        
        
        <p class="hades-custom-media"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        
		<p class="hades-custom-media"> 
        <label for="<?php echo $this->get_field_id('count'); ?>"> <?php _e('Number of posts to display','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
		</p>
		
           
       
        
        
<?php
		
		 }
	function widget($args, $instance) { 
	global $more;
	extract($args); 
	$post_type = $instance['post_type'];	
		$count = esc_attr($instance['count']);
	$title = esc_attr($instance['title']);
		echo $before_widget;
		if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
	
	if($count=="")
	$count = '&nopaging=true';
	else
	$count  = "&showposts={$count}";	
		
		?>
  
  
 
 <div class="scroller-posts-wrapper">      
  <a href="#" class="showcase-next"></a>
 <a href="#" class="showcase-prev"></a>
 <div class="scroller-posts">
  

 <ul class="clearfix" >
            			<?php 
						$popPosts = new WP_Query();
						
						if($post_type=="popular")
						$popPosts->query('caller_get_posts=1'.$count.'&orderby=comment_count');
					    else if($post_type=="recent")
						$popPosts->query('caller_get_posts=1='.$count.'&orderby=date&order=DESC');
						else if($post_type=="featured") 
						$popPosts->query(''.$count.'&tag=featured');
						else if($post_type=="portfolio") 
						$popPosts->query(''.$count.'&post_type=portfolio');
						 
						while ($popPosts->have_posts()) : $popPosts->the_post();  $more = 0;?>
                        
                        <li class="clearfix" >
                        	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                            <div class="image">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(215,9999)); ?></a>
                            </div><!--image-->
                            <?php endif; ?>
                        </li>
                        
                        <?php endwhile; ?>
                        
                        <?php wp_reset_query(); ?>

                    </ul>
        
		</div>
        </div>
					
		<?php
			echo $after_widget; 
	
	  
		
		}
		
	
	}

	   
add_action('widgets_init', create_function('', 'return
register_widget("ShowcasePost");'));
?>