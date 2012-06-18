 <div class="sidebar"><!-- start of one-third column -->

<?php 
    $dsidebar = get_post_meta($post->ID,'_dynamic_sidebar',true);

   
	if ( $dsidebar!="none" || trim($dsidebar)!=""  ) {
	 
	
			dynamic_sidebar ($dsidebar); 
			
			
	}
	else if (  ( is_page_template('page-blog-default-template.php') ||  is_page_template('page-blog-template.php') && function_exists ( dynamic_sidebar("Blog Sidebar") )  ) || (is_single()) ) {
	 
	
			dynamic_sidebar ("Blog Sidebar"); 
			
			
	}
	elseif (  is_page_template('page-contact-template.php') && function_exists ( dynamic_sidebar("Contact Sidebar") ) ) {
	 
	
			dynamic_sidebar ("Contact Sidebar"); 
			
			
	}
	elseif( is_page() &&  !is_page_template('page-blog-default-template.php') && !is_page_template('page-blog-template.php') &&!is_page_template('page-contact-template.php') ) {
   

	     dynamic_sidebar ("Page Sidebar");  
	
	}
	else
	{
		dynamic_sidebar ("Blog Sidebar"); 
	}
	
	?>  
</div><!-- end of one-third column -->