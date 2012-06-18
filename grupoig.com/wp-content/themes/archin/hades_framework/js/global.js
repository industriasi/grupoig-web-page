/*
*

Author - Abhin Sharma (WPTitans)
Description - Contains global functions

This code cannot be used anywhere without the permission of the Author.

*
*/



jQuery(function($){

/* ========================================================================================================= */	
/* ================================= Code to invoke default WP Uploader ==================================== */	
/* ========================================================================================================= */
	
var pID = jQuery('#post_ID').val(),ed,
   temp,wp_default_send_to_editor, override = false;

// Listen to click for upload 
jQuery('.custom_upload_image_button').live('click',
       function (e) {
		  temp = jQuery(this); 
		  override = true; // notify we are using the uploading system
		  
		  wp_default_send_to_editor = window.send_to_editor;
          window.send_to_editor = function (html) {
          
		    if(override==true) {
		        imgurl = jQuery('img', html).attr('src');
                temp.prev().val(imgurl);
			    override = false;
		    }
		    else {
			   wp_default_send_to_editor(html);
			     }
			
			tb_remove();
        
		}
      
tb_show('', 'media-upload.php?post_id='+pID+'&TB_iframe=true&type=image');
return false;
		
		
    });

/* ========================================================================================================= */	
/* ========================================= Widget Skinning Code ========================================== */	
/* ========================================================================================================= */

if($(".hades-custom").length>0)
$(".hades-custom").parents(".widget").addClass("hades-widget-custom");	

/* ========================================================================================================= */	
/* ========================================= Delete the parent ============================================= */	
/* ========================================================================================================= */


$(".uploaded-fonts a.delete , .sidebarmanager .active-sidebars a.delete , .sidebarmanager .inactive-sidebars a.delete").live("click",function(e){
		$(this).parent().remove();
		e.preventDefault();
		});


/* ========================================================================================================= */	
/* =========================================== Sidebar Code ================================================ */	
/* ========================================================================================================= */

if($(".sidebarmanager .active-sidebars").length>0) {
	
	$(".sidebarmanager .active-sidebars").sortable({ placeholder:'sidebar-holder' ,connectWith: '.inactive-sidebars' 
	,  stop: function(event, ui) { ui.item.find("input").attr("name","inactive_sidebars[]"); }
	});
	$(".sidebarmanager .inactive-sidebars").sortable({ placeholder:'sidebar-holder' , connectWith: '.active-sidebars'
	,  stop: function(event, ui) { ui.item.find("input").attr("name","active_sidebars[]"); }
	 });
	
	$(".add-sidebar-button").click(function(){
		
		if(jQuery.trim($("#sidebar_name").val())=="")
		return;
		
		 $(".active-sidebars").prepend(" <li><span>"+$("#sidebar_name").val()+"</span><input type=\"hidden\" value=\""+$("#sidebar_name").val()+"\" name=\"active_sidebars[]\" /> <a href=\"#\" class=\"delete\"></a></li>");
		 $("#sidebar_name").val("")
		});
	}			


$(".import_shortcode").live("click",function(){
			
			ed = tinyMCE.activeEditor;
			ed.focus();
			ed.execCommand('mceInsertContent', false, $(this).prev().val());
			
			});
	
$(".done_shortcode").live("click",function(){
		  
		 
		  if($(".shortcode_value").val()=="image")
		  {
			   var temp = jQuery("#TB_ajaxContent"),button = "[button border_radius='"+$("#shortcode_border_radius").val()+"' bg_color='"+rgb2hex(temp.find("#bgcolorSelector>div").css("background-color"))+"' color='"+rgb2hex(temp.find("#colorSelector>div").css("background-color"))+"' to='"+temp.find("#shortcode_link").val()+"'  style='"+temp.find("#button-styler").val()+"'] "+temp.find("#button_title").val()+" [/button] ";
			   
			  ed = tinyMCE.activeEditor;
			ed.focus();
			ed.execCommand('mceInsertContent', false, button);
		  }
		  else if($(".shortcode_value").val()=="list")
		  {
			   var temp = jQuery("#TB_ajaxContent"),button = "[list style='"+temp.find("#shortcode-list-preview").val()+"'] insert your list [/list] ";
			   
			  ed = tinyMCE.activeEditor;
			ed.focus();
			ed.execCommand('mceInsertContent', false, button);
		  }
		   else if($(".shortcode_value").val()=="contact")
		   {
			     var temp = jQuery("#TB_ajaxContent"),form = "[contactform id='"+temp.find("#shortcode-contact-preview").val()+"' /] ";
			 ed = tinyMCE.activeEditor;
			ed.focus();
			ed.execCommand('mceInsertContent', false, form); 
		   }
		  
			tb_remove();
		
		});	


$("#shortcode-list-preview").live("change",function(){
	
	$("#list-preview").removeClass();
	$("#list-preview").addClass($(this).val()+" styled");
	
	})			
				
});

function rgb2hex(rgb){
 rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
 return "#" +
  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2);
}