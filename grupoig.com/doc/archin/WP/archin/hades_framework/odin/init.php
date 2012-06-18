<?php

/* =================================================================== */
/* ==================== Visual Importer Manager ====================== */
/* =================================================================== */

/*

Author - Abhin Sharma ( WPTitans )

*/

add_action('admin_init', 'odin_add_init');
add_action('admin_menu', 'odin_add_admin');

function odin_add_admin() {
	 	add_submenu_page("elements.php","Titan Installer","Titan Installer", 'administrator',"visual_import", 'odin_admin');
}



function odin_add_init() { 
    
	$path = URL;
  
	if(isset($_GET['page'])&&($_GET['page']=='visual_import')){	
	
	
	
	
	wp_enqueue_style( 'odin-css',$path.'/hades_framework/odin/css/odin.css',false);
    wp_enqueue_script('odin-js',$path.'/hades_framework/odin/js/odin.js', array('jquery'), '0.1' );

	
	}
	

}



function odin_admin() {
	  
$url = get_admin_url()."admin.php?page=visual_import"; 
include("super_values.php");	

 
	   ?>
	  
   
   
  
      
<div class="hades_wrap odin">
  <div id="hades_theme">

    <div class="hades-head clearfix">
       <span id="iloader"></span>
    	<a href="#" id="logo"></a>
    </div>
    <div class="notice-bar">
    <p>Titan Installer: 1.0 </p>
    </div>

<?php if(isset($_GET["stage"])) : ?>
   
   
   <?php if($_GET["stage"]=="home_page") : 
    $gmes = "Home page";
  
     global $wpdb;
	 
	 $wpdb->query("UPDATE $wpdb->usermeta SET meta_value=\"false\" WHERE meta_key = \"show_admin_bar_front\"");
	 
	 $home_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'Home'");
	   
	 update_option( 'page_on_front' , $home_id );
	 update_option( 'show_on_front' , 'page');
    
     endif; ?>
     
     
      <?php if($_GET["stage"]=="options") : 
   $gmes = "Options";
   enable_theme_content();
   
     endif; ?>
     
     
        <?php if($_GET["stage"]=="menus") : 
  
      $gmes = "Menus ";
	// print_r( wp_get_nav_menu_items("Sidebar menu 1") );     
//	set_theme_mod( 'nav_menu_locations', array_map( 'absint', array( 'top_nav' => '21' , 'primary_nav' => '21' ,'footer_nav' => '21') ) );
	
	
    global $wpdb;
    $table_db_name = $wpdb->prefix . "terms";
    $rows = $wpdb->get_results("SELECT * FROM $table_db_name where name='Main Menu' OR name='Footer Menu'",ARRAY_A);
    $menu_ids = array();
	foreach($rows as $row)
	$menu_ids[$row["name"]] = $row["term_id"] ; 


	
	set_theme_mod( 'nav_menu_locations', array_map( 'absint', array(  'primary_nav' =>$menu_ids['Main Menu'] ,'footer_nav' => $menu_ids['Footer Menu']) ) );
	
	
	
	$items = wp_get_nav_menu_items( $menu_ids['Main Menu']); 
	
	$i = 0;
	$subtitles = array("Sweet home","View our work","What's inside","Gallery inside","What's possible","Our thoughts","Contact Us");
	foreach($items as $item)
	{
		if($item->menu_item_parent==0)
		{
			
			update_post_meta($item->ID,"menu-item-megamenu-subtitle-".$item->ID,$subtitles[$i++]);
		}
		
		if($item->title=="Features")
		{
			update_post_meta($item->ID,"menu-item-megamenu-".$item->ID,"on");
			update_post_meta($item->ID,"menu-item-megamenu-layout-".$item->ID,"column");
			
			
		}
		if($item->title=="Text menu")
		{
			update_post_meta($item->ID,"menu-item-textbox-".$item->ID,"<p>Ut ut egestas mi. Suspendisse scelerisque ante mattis est condimentum at hendrerit massa volutpat. Morbi dapibus feugiat ipsum, a mattis velit pharetra in.</p><p>
Aliquam mattis egestas sapien eu eleifend. Maecenas condimentum euismod libero, in egestas ipsum venenatis pharetra.</p>");
			update_post_meta($item->ID,"menu-item-enable-textbox-".$item->ID,"on");
			
			
			
			
			
		}
		
	}
	
	if(!get_option("titan_menus"))
	{
		add_option("titan_menus","yes");
	}
	
     endif; ?>
     
     <?php if($_GET["stage"]=="media") : 
     
	 $gmes = "Media Items ( portfolios and galleries ) ";
	 
	setMedia();
	 
	 
	 endif; ?>
     <?php if($_GET["stage"]=="widgets") : 
	 
	 $gmes = "Widgets ";
	 
	enable_widgets();
	enable_custom_sidebars();
	 
	 endif; ?>
     
     
       <?php if($_GET["stage"]=="home_page") : 
     
	   
     sethomecolumns();
    

endif; 
?>

<?php if($_GET["stage"]=="titan_templates") : 
  $gmes = "Titan Templates ";
 install_templates(); 
 endif; ?>
 
       <?php if($_GET["stage"]=="slider") : 
   
   $gmes = "Slider ";
   
    update_option( 'arc_slides' ,  $h_slides  );
	
     endif; ?>
     
      <?php if($_GET["stage"]=="import") : 
   
    if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
	require_once ABSPATH . 'wp-admin/includes/import.php';
    $importer_error = false;
	
	if ( !class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		if ( file_exists( $class_wp_importer ) )
		{
			require_once($class_wp_importer);
		}
		else
		{
			$importer_error = true;
		}
    }
	
	if ( !class_exists( 'WP_Import' ) ) {
	  $class_wp_import = HPATH . '/odin/importer/wordpress-importer.php';
	  if ( file_exists( $class_wp_import ) )
	  require_once($class_wp_import);
	  else
	  $importerError = true;
	  
    }

	  if($importer_error)
	  {
		  die("Error in import :(");
	  }
	  else
	  {
		  if ( class_exists( 'WP_Import' )) 
		  {
			  include_once('importer/odin-import-class.php');
		  }
		  
		  
		  if(!is_file(HPATH."/odin/dummy.xml"))
		  {
			  echo "The XML file containing the dummy content is not available or could not be read in <pre>".HPATH."</pre><br/> You might want to try to set the file permission to chmod 777.<br/>If this doesn't work please use the wordpress importer and import the XML file (should be located in your themes folder: dummy.xml) manually <a href='/wp-admin/import.php'>here.</a>";
		  }
		  else
		  {
	  
			  $wp_import = new odin_wp_import();
			  $wp_import->fetch_attachments = true;
			  $wp_import->import(HPATH."/odin/dummy.xml");
			  $wp_import->saveOptions();
			
		  }
	  }
   
   
    
     endif; ?>
    
   
<?php endif; ?>
   
   
<div id="starter-kit" class="clearfix">
  
  <?php 
 

  if(isset($gmes) && $gmes!= "" )
  	echo '<div class="highlight2"><p>' . __( $gmes.' has been activated succesfully   ' )  . '</p></div>';
  
  ?>
  
 <h4>Welcome to Titans Installer</h4>
 <p>The installer is the perfect solution for everybody who's in a hurry and doesn't have time to read the docs or wait for support. With a few steps your new theme should look exactly like the demo. There are a few thing you need to consider before using this great and powerful function. Each section has it's own explanation, useful links and warnings. Please read them carefully before clicking on any buttons ;)</p>

 <h4>Echea is using TimThumb to resize the images.</h4>
 <p>TimThumb requires<a href="http://www.libgd.org/Main_Page" target="blank">the GD library</a>, which is available on any host sever with PHP 4.3+ installed. <em>Please use <a href="http://www.computerhope.com/jargon/a/absopath.htm" target="blank">absolute paths</a> for your script and images and if the images are not showing please set the cache folder permission to 777. Still encountering problems with your images, then please visit this <a href="http://themeforest.net/forums/thread/tim-thumb-problem/32860?page=1#311234">post</a> for help about this topic.</em></p>

<div class="highlight1">
<h4>Before you begin here are a few points you need to consider.</h4>
<ul>
<li>Only use the TitanInstaller on a fresh Install, already have content inside your set-up then use the documentation for a manual guide.
</li>
<li>Please delete the default page and post, that WordPress creates for you, before you start.</li>
<li>Don't look at the front-end until all steps are finished, this to avoid confusing.</li>
</ul>
</div>       

  <ul class="helper-tree" >
   <li class="clearfix  <?php if(get_option("titan_install_done")) echo "importer_disabled"; ?>">
      <h4>Import Theme Content</h4>  
      
        <div class="formatted">
        
        
        <div class="highlight">
        <p>Please be warned, activation only works once. Each time you click on the <strong>Activate Theme Content</strong> button the content will duplicates it selves!</p>
        </div>
        
        
        <h5>What will happen after i click on the <strong>Activate Theme Content</strong> button</h5>
        <p>This process is comparable with importing the dummy content by uploading the xml inside the WordPress Importer. Only now you wont have to search for an xml file within the download package and install the importer plugin first. Just one click and your done. </p>
                
        <div class="highlight1">
        <p>Do not close this window until you see the message <strong>All Done!!!</strong></p>
        </div>

      </div>

      <div class="highlight2">
      <p><a href="<?php echo $url."&stage=import"; ?>" id="importer">Click here to Import the Theme's Content.</a></p>
      </div>
   </li>
   

      
   <li class="clearfix <?php if(!get_option("titan_install_done")) echo "disabled"; ?>">
      <h4>Activate Home Page Settings</h4>  
     
        <div class="formatted">
        
        <h5>What will happen after i've activated the homepage settings</h5>
        <p>This process will activate the home pages setting and will place all elements in it's place. Please don't look at the front-end until all steps are finished, this to avoid confusing.</p>

       
      <div class="highlight2">    
      <p><a href="<?php echo $url."&stage=home_page"; ?>" class="tbutton">Activate Home Page Settings</a></p>
      </div>
      
      
      </div>
    </li>
    
    
    
   <li class="clearfix <?php if(!get_option("titan_install_done")){   echo "disabled"; } if(get_option("titan_menus")=="yes") echo "disable_menu"; ?>">
      <h4>Activate Menu Settings</h4>  
    
        <div class="formatted">
   
        
        <h5>What will happen after i've activated the menu settings</h5>
        <p>After you've activated this option the custom menus are added in it's place and will look exactly as the demo set up. Main Menu, Top Menu, Footer Menu and Mega Menu will be acitvated, populated and added to it's proper place.</p>

     
      
      <div class="highlight2">       
      <p><a href="<?php echo $url."&stage=menus"; ?>" class="tbutton">Click here to Activate Menu Settings</a></p>
      </div>
      
       </div>
    </li>
    
    
    
   <li class="clearfix <?php if(!get_option("titan_install_done")) echo "disabled"; ?>">
      <h4>Activate Theme Options</h4> 
         
        <div class="formatted">
   
        
        <h5>What will happen after i've activated the theme options</h5>
        <p>This option will activate and populate the theme options such as testimonials and form builder options and contents, exactly as shown inside the demo set up.</p>

     
      
      <div class="highlight2">  
      <p><a href="<?php echo $url."&stage=options"; ?>" class="tbutton">Click here to activate the theme options</a></p>
      </div>
      
       </div>
   </li> 
   
  
   <li class="clearfix <?php if(!get_option("titan_install_done")) echo "disabled"; ?>">
      <h4>Activate the Widgets</h4>  
          
        <div class="formatted">
   
        
        <h5>What will happen after i've activated the widgets</h5>
        <p>Well, that's simple. you ahve activated the widgets and popluated them. They now should look exactly as advertised in the demo set up.</p>

    
      
      <div class="highlight2">  
      <p><a href="<?php echo $url."&stage=widgets"; ?>" class="tbutton" id="populate_widgets">Click here to activate the widgets</a></p> 
      </div>
      
        </div>
   </li>
   
   
   <li class="clearfix <?php if(!get_option("titan_install_done")) echo "disabled"; ?>">
      <h4>Activate the Homepage Slider</h4> 
          
        <div class="formatted">
   
        
        <h5>What will happen after i've activated the slider</h5>
        <p>This will activate the slider settings and populate the slider as advertised inside the demo package.</p>

      
      
      <div class="highlight2">   
      <p><a href="<?php echo $url."&stage=slider"; ?>" class="tbutton">Click here to activate the slider</a></p>
      </div>
      
      </div></li>
      
      
      
    <li class="clearfix <?php if(!get_option("titan_install_done")) echo "disabled"; ?>">
      <h4>Activate Galleries and Portfolios</h4> 
      
        <div class="formatted">
   
        
        <h5>What will happen after i've activated the Gallery and Portfolio</h5>
        <p>This will set up the gallery and portfolio for you, settings, images and text will be added just as advertised.</p>

      
      
      <div class="highlight2">   
       
     <p><a href="<?php echo $url."&stage=media"; ?>" class="tbutton">Click here to activate the Galleries and Portfolios</a><p>
     </div>
     </div>
     </li> 
     
     
 </ul>
 

 
</div>
</div> 
	  
      
	  <?php
	
	
	 }