<?php

/* =================================================================== */
/* ========================== Font Manager =========================== */
/* =================================================================== */

/*

Author - Abhin Sharma ( WPTitans )

*/

add_action('admin_init', 'sidebarmanager_add_init');
add_action('admin_menu', 'sidebarmanager_add_admin');

function sidebarmanager_add_admin() {
	 	add_submenu_page("elements.php","Sidebar Manager","Sidebar Manager", 'administrator',"sidebar_manager", 'sidebarmanager_admin');
}



function sidebarmanager_add_init() { 
    
	$path = URL;
  
	if(isset($_GET['page'])&&($_GET['page']=='sidebar_manager')){	
	wp_enqueue_script('jquery-ui-sortable');
	}
	

}



function sidebarmanager_admin() {
	  
	  if(isset($_POST["action"]))
	  {
		  $abars =  $_POST["active_sidebars"];
		   $inbars = $_POST["inactive_sidebars"];
		  
		
		   
	  	  update_option("archin_active_sidebars", $abars);
		  update_option("archin_inactive_sidebars", $inbars);
	  }
	 
	  $active_sidebars = get_option("archin_active_sidebars");
	  $inactive_sidebars= get_option("archin_inactive_sidebars");
	   
	  if(!$active_sidebars)
	  $active_sidebars = array();
	  
	   if(!$inactive_sidebars)
	  $inactive_sidebars = array();
	  
	
	  
	   ?>
	  
     <?php  if(isset($_POST["action"])) echo '<div class="hades_information"><p><strong>Saved.</strong></p></div>'; ?>
      
     <div class="hades_wrap sidebarmanager">
  <div id="hades_theme">

            
     
	
   
    <div class="hades-head clearfix">
    
       
    	<a href="#" id="logo"></a>
       
       
    </div>
    <div class="notice-bar">
    <p>Sidebar Manager : 1.0 </p>
    </div>

<div id="hades_opts" class="clearfix">
    
    <div id="side-panel-wrapper" class="clearfix">
    <form method="post"   action="" class="clearfix" >
        <input name="save" type="submit" value="Save changes" class="admin-button" />  
        
      <div class="upload-area clearfix"> 
        <label for="file_upload">Add Sidebar</label>
        <input id="sidebar_name" name="sidebar_name" type="text" />
        <input name="save" type="button" value="Add" class="add-sidebar-button" /> 
      </div>
       
     <div class="manage-sidebars clearfix">
     
     <div class="active-wrapper clearfix">
         <h4>Active Sidebars</h4> 
         <ul class="active-sidebars">
             <?php foreach($active_sidebars as $bars) : 
	 
	  echo "<li><a href='#' class='delete' /></a><input type='hidden' name='active_sidebars[]' value='".$bars."'/> <span> ".$bars." </span> </li>";
	  
	   endforeach; ?>
         </ul>
     </div>
     
      <div class="inactive-wrapper clearfix">
         <h4>Inactive Sidebars</h4> 
         <ul class="inactive-sidebars">
            <?php foreach($inactive_sidebars as $abars) : 
	 
	  echo "<li><a href='#' class='delete' /></a><input type='hidden' name='inactive_sidebars[]' value='".$abars."'/> <span> ".$abars." </span> </li>";
	  
	   endforeach; ?>
         </ul>
     </div>
     
    
     </div>
     <input type="hidden" value="save" name="action" />
    </form>
                 
</div>

</div> 
	  
      
	  <?php
	
	
	 }