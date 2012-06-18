<?php

/* =================================================================== */
/* ========================== Font Manager =========================== */
/* =================================================================== */

/*

Author - Abhin Sharma ( WPTitans )

*/

add_action('admin_init', 'fontmanager_add_init');
add_action('admin_menu', 'fontmanager_add_admin');

function fontmanager_add_admin() {
	 	add_submenu_page("elements.php","Font Manager","Font Manager", 'administrator',"font_manager", 'fontmanager_admin');
}



function fontmanager_add_init() { 
    
	$path = URL;
  
	if(isset($_GET['page'])&&($_GET['page']=='font_manager')){	
	
	
	wp_enqueue_script('jquery-ui-sortable');
	
	
	wp_enqueue_style( 'uploadify-css',$path.'/js/uploadify/uploadify.css',false);
	
	wp_enqueue_script('uploadify-swfobject',$path.'/js/uploadify/swfobject.js', array('jquery'), '0.1' );
	wp_enqueue_script('uploadify',$path.'/js/uploadify/jquery.uploadify.js', array('jquery'), '0.1' );
	
	}
	

}

function init_uploadify()
{
	$path = URL;
	?>
	
    <script type="text/javascript">
	jQuery(document).ready(function($) {
		  var name ;
		  var path = '<?php echo $path ?>/js/cufon-fonts/';
		  jQuery('#file_upload').uploadify({
		  'swf' : '<?php echo $path ?>/js/uploadify/uploadify.swf',
		  'uploader' : '<?php echo $path ?>/js/uploadify/uploadify.php',
		  'cancelImage' : '<?php echo $path ?>/js/uploadify/cancel.png',
		  'fileTypeExts' : '*.js',
		  'onUploadSuccess' : function(stats){
			  
			  if(jQuery.trim(stats.name)=="")
			  return;
			  
			  name = "custom_"+stats.name;
			  jQuery(".uploaded-fonts").append("<p class='clearfix'><a href='#' class='delete' /></a><input type='hidden' name='font_name[]' value='"+name+"'/> <span> "+stats.name+" </span> </p>");
			  
			  },
		  'multi':true,
		  'auto' : true
		  });
	});
    </script>

	
	<?php
}
if(isset($_GET['page'])&&($_GET['page']=='font_manager'))
add_action("admin_head","init_uploadify");

function fontmanager_admin() {
	  
	  if(isset($_POST["action"]))
	  {
		  $arr_font = $_POST["font_name"];
	  	  update_option("archin_custom_fonts", $arr_font);
	  }
	  $custom_fonts = get_option("archin_custom_fonts");
	  if(!$custom_fonts)
	  $custom_fonts = array();
	  
	  
	   
	  
	   ?>
	  
     <?php  if(isset($_POST["action"])) echo '<div class="hades_information"><p><strong>Saved.</strong></p></div>'; ?>
      
     <div class="hades_wrap fontmanager">
  <div id="hades_theme">

            
     
	
   
    <div class="hades-head clearfix">
    
       
    	<a href="#" id="logo"></a>
       
       
    </div>
    <div class="notice-bar">
    <p>Font Manager : 1.0 </p>
    </div>

<div id="hades_opts" class="clearfix">
     <p class="info-text">To add a font first <a href="http://cufon.shoqolate.com/generate/">http://cufon.shoqolate.com/generate/</a> , convert the font into cufon javascript file and upload it here.</p> 
     
    <div id="font-panel-wrapper" class="clearfix">
    <form method="post"  enctype="multipart/form-data" action="" class="clearfix" >
        <input name="save" type="submit" value="Save changes" class="admin-button" />  
        
      <div class="upload-area clearfix"> 
        <label for="file_upload">Upload Cufon Font</label>
        <input id="file_upload" name="file_upload" type="file" />
      </div>
       
     <div class="uploaded-fonts">
      <?php foreach($custom_fonts as $fonts) : 
	  $key = substr ($fonts,7); 
	  echo "<p class='clearfix'><a href='#' class='delete' /></a><input type='hidden' name='font_name[]' value='".$fonts."'/> <span> ".$key." </span> </p>";
	  
	   endforeach; ?>
     </div>
     <input type="hidden" value="save" name="action" />
    </form>
                 
</div>

</div> 
	  
      
	  <?php
	
	
	 }