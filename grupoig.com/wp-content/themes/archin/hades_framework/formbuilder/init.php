<?php

/* =================================================================== */
/* ====================== Formbuilder Manager ======================== */
/* =================================================================== */

/*

Author - Abhin Sharma ( WPTitans )

*/

add_action('admin_init', 'formbuilder_add_init');
add_action('admin_menu', 'formbuilder_add_admin');

function formbuilder_add_admin() {
	 	add_submenu_page("elements.php","Form Builder","Form Builder", 'administrator',"form_builder", 'formbuilder_admin');
}



function formbuilder_add_init() { 
    
	$path = URL;
  
	if(isset($_GET['page'])&&($_GET['page']=='form_builder')){	
	
	
	wp_enqueue_script('jquery-ui-sortable');
	
	
	wp_enqueue_style( 'formbuilder-css',$path.'/hades_framework/formbuilder/css/style.css',false);
    wp_enqueue_script('formbuilder-js',$path.'/hades_framework/formbuilder/js/formbuilder.js', array('jquery'), '0.1' );

	
	}
	

}



function formbuilder_admin() {
	  
	 
	   if(isset($_POST["action"]))
	  {
		   $forms = get_option("archin_forms");
	       if(!$forms)
	            $forms = array();
	  
		  $key = '';
		  for ($i=0; $i<10; $i++) { 
		  $d=rand(1,30)%2; 
		  $key = $key. ( $d ? chr(rand(65,90)) : chr(rand(48,57))  ); 
		  }
          	
		  $email_notification = $_POST["email_notification"];
		  $email_notification_mail = $_POST["email_notification_mail"];
		  
		  $captacha_verification = $_POST["captacha_verification"];
		  $auto_respond = $_POST["auto_respond"];
		  $layout_style = $_POST["layout_style"];
		  $name_value = $_POST["name_value"];
		  $form_element = $_POST["form_element"];
		  
		  $label_values = $_POST["label_value"];
		  
		  $contact_form = array(
		      "key" => $key,
		     "email_notification" => $email_notification,
			 "captacha_verification" => $captacha_verification,
			 "auto_respond" => $auto_respond,
			 "layout_style" => $layout_style,
			 "label_values" => $label_values,
			 "name_value" => $name_value,
			 "form_element" => $form_element,
			 "email_notification_mail" => $email_notification_mail
			 );
			
		 // print_r($contact_form);  
		  	
		if(isset($_GET["key"]))
		{
			$contact_form["key"] = $_GET["key"];
			
			 foreach($forms as &$form)
		      {
			    if($_GET["key"] == $form["key"]  )
			    {
				   $form = $contact_form; break;
			    }
				
		      }
		  
		//	print_r($form);
			update_option("archin_forms", $forms);
		//   header("Location: admin.php?page=form_builder&action=true&saved_key=".$_GET["key"]);
			
		}
		else
		{
			 $forms[] =  $contact_form;
			 update_option("archin_forms", $forms);
			
		}
	
		
	
	    
		
	// delete_option("archin_forms");
	  }
	  $forms = get_option("archin_forms");
	  
	  if(!$forms)
	  $forms = array();
	  
	  
		
	  $keys = array();
	   foreach($forms as $form)
	   {
		 $keys[] = $form["key"];
	   }
	
	 
	 
	  
	  if(isset($_GET["key"]))
	  $key = $_GET["key"];
	  
	  if(isset($_GET["key"]))
	  {
		 
		   $forms = get_option("archin_forms");
	      $cform = '' ;
	  
		  foreach($forms as $form)
		  {
			  if($_GET["key"] == $form["key"]  )
			  {
				  $cform = $form; break;
			  }
		  }
		 
	  }
	   ?>
	  
     <?php  if(isset($_REQUEST["action"])) echo '<div class="hades_information"><p><strong>Form saved , use this shortcode to retrive it [contactform id='.$key.'].</strong></p></div>'; ?>
    
      
     <div class="hades_wrap formbuilder">
  <div id="hades_theme">

            
     
	
   
    <div class="hades-head clearfix">
    
       <span id="iloader"></span>
    	<a href="#" id="logo"></a>
       
       
    </div>
    <div class="notice-bar">
    <p>Form Builder: 1.0 </p>
    </div>

<div id="hades_opts" class="clearfix">
  
   
     
  
     <div class="form-options clearfix">
       <p>
        <form method="get">
           <input type="hidden" name="page" value="form_builder" />
          <span>Available Forms</span>
          <select name="key" id="form-builder">
             <?php 
			 $forms = get_option("archin_forms");
	               foreach($forms as $tkey)
				   {
					   echo "<option value='{$tkey[key]}'>{$tkey[key]}</option>";
				   }
	          ?>
         </select>
         <input type="submit" class="button-edit" value="Edit" />
        <?php $url = explode("?",$_SERVER['REQUEST_URI']); if(isset($_GET["key"])) echo "<a href='".$url[0]."?page=form_builder'> New Form </a>"; ?>
        
        
         </form>
         
       </p>  
       
      <form method="post"  enctype="multipart/form-data" action="" class="clearfix" >
     
      
       <input name="save" type="submit" value="Save changes" class="builder-admin-button" />  
       
      <div class="divider"></div>
      
      <p class="info-text">Inisde this Form Builder your able to create your own personalized form, click on the elements you want inside the form, once selected your able to ad labels, description and you can drag elements around to the proper place.</p> <p class="info-text">Available elements are Text fields, Text areas, Dropdowns, Notification, Captcha and Auto respond. To edit your messages you have to head up to the <a href="/wp-admin/edit.php?post_type=message">Message</a> section where you can ad your own text for the Auto respnd and Notification.</p>
      
      <div class="divider"></div>
       
           
       <ul class="clearfix options">
         <li>
               <a href="#" class="buttonfield">Add TextField</a> 
               <input type="hidden" value='text' class="type" />
               <input type="text" value='text' class="element" name="" /> 
         </li>
         <li>
               <a href="#" class="buttontext">Add Textarea</a>
               <input type="hidden" value='textarea' class="type" />
               <textarea name="" id="" cols="30" rows="10" class="element"  > </textarea> 
         </li>
         <!-- <li>  
               <a href="#" class="button">Add Checkbox</a>
               <input type="hidden" value='checkbox' class="type" />
               <input type="checkbox" value='' class="element" /> 
         </li>
         <li>
               <a href="#" class="button">Add Radio button</a>
               <input type="hidden" value='radio' class="type" />
               <input type="radio" value='' class="element" /> 
         </li> -->
         <li>
               <a href="#" class="buttonselect">Add Select box</a>
               <input type="hidden" value='select' class="type" />
               <select name="" id="" class="element" ></select>
         </li>
         </ul>
         <ul class="clearfix right-items">
         <li>
                <label for="email_notification">Email Notification</label>
                <input type="checkbox" value='true' id="email_notification" name="email_notification" <?php if($cform["email_notification"]=="true") echo "checked='checked'"; ?>  /> 
                <input type="hidden" value='text' name="type" />
                <input type="text" name="email_notification_mail" class="email_notification_mail <?php if($cform["email_notification"]!="true") echo "hide"; ?>" value="<?php if($cform["email_notification"]=="true") echo $cform["email_notification_mail"]; ?>" />
         </li>
         <li>
                <label for="captacha_verification">Captcha</label>
                <input type="checkbox" class="select" value='true' id="captacha_verification" name="captacha_verification" <?php if($cform["captacha_verification"]=="true") echo "checked='checked'"; ?>  /> 
                <input type="hidden" value='text' name="type" />
         </li>
         <li>
                <label for="auto_respond">Auto Respond</label>  
                <input type="checkbox" value='true' id="auto_respond" name="auto_respond"  <?php if($cform["auto_respond"]=="true") echo "checked='checked'"; ?> />
               <input type="hidden" value='text' name="type" />
         </li>
         
       </ul>
     
             <ul class="clearfix">
             <li>
             <span  class="hide">Layout style </span>
             <select name="layout_style" id="form-builder"  class="hide">
        <?php 
		$ar = array( "block" => "Block" , "row" => "Row" , "animated" => "Animated" );
		foreach ($ar as $k => $item)
		{
			if($cform["layout_style"]==$k)
			echo "<option value='{$k}' selected >{$item}</option>";
			else
			echo "<option value='{$k}'>{$item}</option>";
		}
		?>
         	</select>
         	</li>
         	</ul>
    
       
    <div id="panel-wrapper" class="clearfix">
  
     <div id="formbuilder">
     
     <?php 
	 
	 if(isset($_GET["key"]))
	 {
	  
	   $name_value = $cform["name_value"];
	   $form_element = $cform["form_element"];
	   $label_values = $cform["label_values"];
	   $i =0;
	   
	   if(!is_array($form_element))
	   $form_element = array();
	   
	   foreach($form_element as $element)
	   {
		   $temp_options = '';
		   $label = $label_values[$i];
		$name = $name_value[$i];
		
		
		
		   ?>
			
            <p class='hades_input clearfix'> <input type='hidden'  class='form_element' name='form_element[]' value="<?php echo $element; ?>" /> 
	            <a href='#' class='remove'></a> 
				<label class='label'> 
				  <input type='text' value='<?php echo $label ?>' /> 
				  <input type='hidden' value='<?php echo $label ?>' class='label_value' name='label_value[]' /><span><?php echo $label ?></span></label> 
				<label class='name'><input type='text' value='<?php echo $name ?>' /> <input type='hidden' value='<?php echo $name ?>' class='name_value' name='name_value[]' /> <span><?php if($name=="") echo 'Click to edit name, optional '; else echo $name ?></span></label> 
                <?php 
				
				switch($element)
				{
					case "text" :  echo "<input type='text' value=''  /> ";  break;
					case "textarea" : echo " <textarea  /></textarea> "; break;
					default :  echo " <select  >";
								 $options = explode(":",$element);
								 $options = $options[1];
								 $temp_options = $options;
								 $options = explode(",",$options);
								  foreach($options as $option)
									echo"<option value='{$option}'>{$option}</option>";
								echo"</select>";	
								if($temp_options=="")
								$temp_options = "enter options followed by comma";
								?>
								
                                 <label class='label'> 
				                 <input type='text' value='<?php echo $temp_options; ?>' class='option_value' /> 
				                  <span><?php echo $temp_options; ?></span></label>
                  
								
								<?php
								  break;			  			  
				}
				
				
				?>
                
               
                  
             </p>
                
			
			<?php
			$i++;
	   }
	
	 }
	 
	 
	 ?>
     
     </div>
       <input type="hidden" value="" name="form_data" />
     <input type="hidden" value="save" name="action" />
    
                 
    </div>
</form>
</div>
</div> 
	  
      
	  <?php
	
	
	 }