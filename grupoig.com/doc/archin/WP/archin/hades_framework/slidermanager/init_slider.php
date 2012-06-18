<?php
include('backend/include_scripts.php');

add_action('admin_menu','slider_admin_menu');
add_action('admin_init','slider_admin_init');
	$flag =false;

function slider_admin_menu () {
	
	if(isset($_GET['page'])&&$_GET['page']=='slidermanager'){
	
		if(isset($_POST['action'])&&$_POST['action']=='save')
		{
			global $flag;
			$flag =true;
            $slides = array();
			
			
			 foreach ( $_POST['slide_type'] as $key => $value )
			{
				$id = '';
				
				$urlimage =  $_POST['imagesrc'][$key];
				$ilink =  $_POST['link_src'][$key];
				$title =  $_POST['title'][$key];
				$idesc =  $_POST['description'][$key];
				$type = "upload";
			
				
				$slides[] = array(
				'src' => $urlimage,
				'link' => $ilink ,
				'description' => $idesc ,
				'type' => $value,
				'id' => $id,
				'title' => $title
				);
				
			}
	
			update_option('arc_slides',$slides);
		}
	}
	if(function_exists('add_submenu_page'))
	{
		 add_submenu_page("elements.php", 'Slider Manager','Slider Manager', 'edit_themes','slidermanager', 'slider_admin_wrap');
	}
	else
	  add_menu_page('Slider Manager', 'Slider Manager', 'edit_themes','slidermanager', 'slider_admin_wrap');
	
	} 
function slider_admin_wrap () {
	global $flag;
	?>
	
    <div class="wrap" id="slider_manager_wrap">
    
      <h2>Slider Manager</h2>
      
     <?php if ($flag ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>'; ?>
 <div id="slidermanager">
    
     <form action="" method="post" enctype="multipart/form-data">
      
          <div class="toppanel clearfix">
          <a href="#" id="addslide">Add</a>
          <input type="submit" class="button-submit" value="Save" name="managersubmit" />
          </div>
          <div class="slider-lists">
      <ul>
      
      <?php if(get_option("arc_slides")){ 
	  $slides = get_option("arc_slides");
	  
	  foreach($slides as $slide) {
		  
        $type = $slide['type'];
		
	  ?>
       
       <li class="clearfix contract">
         <div class="slide-head">
             <a href="#" class="move-icon"></a>
             <a href="#" class="max-slide-button slide-toggle-button">Expand</a>
             <a href="#" class="delete-slide-button removeslide">Delete</a>
         </div>
         <div class="slide-body">
                  
          <div class="image-slide slide-panels"> 
          
                  
         
           <div class="separator clearfix">
                <label for="">Upload Image:</label>
                <input type="text" class="" name="imagesrc[]" value="<?php echo $slide['src'] ?>" />
                 <a href="#" class="custom_upload_image_button button"> Upload Image </a>
             
           </div>     
            <div class="separator clearfix">
                <label for="">Image Link:</label>
                <input type="text" class="inputs" name="link_src[]" value="<?php echo $slide['link'] ?>" />
           </div>
            <div class="separator clearfix">
                <label for="">Slide Title:</label>
                <input type="text" class="inputs" name="title[]" value="<?php echo $slide['title'] ?>" />
           </div>
            <div class="lseparator clearfix">     
                <label for="">Description:</label>
                <textarea  cols="30" rows="10" class="inputs" name="description[]"><?php echo stripslashes($slide['description']); ?></textarea>
           </div>      
                
          
          </div>
          
         
          
         
           
          </div> 
          <input type="hidden" name="slide_type[]" value="<?php echo $slide['type'] ?>" class="slide_type" />
        </li>
      
      
      <?php }
	  } else { ?>
        <li class="clearfix">
         <div class="slide-head">
         <a href="#" class="move-icon"></a>
          <a href="#" class="min-slide-button slide-toggle-button">Collapse</a>
         <a href="#" class="delete-slide-button removeslide">Delete</a>
         
         
          
           </div>
         <div class="slide-body">
           
          
           
          <div class="image-slide slide-panels"> 
           <div class="separator clearfix">
                <label for="">Upload Image:</label>
                <input type="text" class="" name="imagesrc[]" value="<?php echo $slide['src'] ?>" />
                 <a href="#" class="custom_upload_image_button button"> Upload Image </a>
           </div>     
            <div class="separator clearfix">
                <label for="">Image Link:</label>
                <input type="text" class="inputs" name="link_src[]" value="<?php echo $slide['link'] ?>" />
           </div>
              <div class="separator clearfix">
                <label for="">Slide Title:</label>
                <input type="text" class="inputs" name="title[]" value="<?php echo $slide['title'] ?>" />
           </div>
            <div class="lseparator clearfix">     
                <label for="">Description:</label>
                <textarea  cols="30" rows="10" class="inputs" name="description[]"><?php echo stripslashes($slide['description']); ?></textarea>
           </div>   
                
                
          
          </div>
          
         
          
          
           
          </div> 
          <input type="hidden" name="slide_type[]" value="upload" class="slide_type" />
        </li>
        
       <?php } ?> 
      </ul>
     </div> 
      <input type="hidden" name="action" value="save" />
      </form>
  </div>   
	
</div>	
	<?php
	
	} 
function slider_admin_init () {
    if(isset($_GET['page'])&&$_GET['page']=='slidermanager'){	
	  wp_enqueue_style( 'slidermanager',HURL.'/slidermanager/css/slidermanager.css',false);
	  wp_enqueue_script('slidermanager-script', HURL. '/slidermanager/js/slidermanager.js', array('jquery'), '0.1' );
	  wp_enqueue_script('jquery-ui-core');
	  wp_enqueue_script('jquery-ui-sortable');
	   
	  wp_enqueue_script('thickbox');
	  wp_enqueue_style('thickbox');
    }
	
	} 
	