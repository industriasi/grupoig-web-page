// JavaScript Document

/* ==================================================================== */
/* ============================ Javascript Code ======================= */
/* ==================================================================== */




/* ==================================================================== */
/* ================= Things need to be ready at first ================= */
/* ==================================================================== */

jQuery(document).ready(function(){
	
	// Check the effect type 
	
	if(jQuery("#image_invert").val()=="true")
	{
		 if(jQuery(".portfolio").length>0)  
	     jQuery(".portfolio").find("img").css("visibility","hidden");
	}
	
	
	// remove unecessart p tags generated from autop
	
	jQuery(".content").find("p:not(.separator)").each(function(){
	  if(jQuery.trim(jQuery(this).html())=="")
		jQuery(this).remove();
	});
	
});	


/* ==================================================================== */
/* ======================== Main Javascript Code ====================== */
/* ==================================================================== */

jQuery(function($){


/* ==================================================================== */
/* ========================== Variable Declaration ==================== */
/* ==================================================================== */
	
var obj,flickr_limit = 5,temp,temp_parent,taxonomy_parent = jQuery(".portfolio-taxonomy li:first")
    ,portfolio = jQuery(".portfolio li")
    , parent,arr,src,block,index=0
    , counter = 0
    , current_cthumb = jQuery(".custom-gallery-thumbs .thumbnails a").first().addClass('iactive')	
    , i =0,sidebar = jQuery(".sidebar"),menu = jQuery("#menu"), wall_height,
      pre_values =  [ 
			    
				[ -15 , -15 ],
				[ 568 , -14],
				[ 568 , 143],
				[ -15 , 323],
				
				[ 233 , 323],
				[ 488 , 323],
				[ -15 , 593],
				[ -15 , 747],
				[ 422 , 747]
			
			];


/* ==================================================================== */
/* ========================== Dynamic Sidebar Check =================== */
/* ==================================================================== */
  
sidebar.children().removeClass('dynamic-wrap');
if(sidebar.find(".current_page_item").length>0)
{
  var c_menu = sidebar.find(".current_page_item");
  c_menu.prev().find("a").css("border","none");
   
}
  

/* ==================================================================== */
/* ============================ Menu Settings ========================= */
/* ==================================================================== */
  
jQuery("#menu>li>.sub-menu").append("<span class='tooltip'></span>");
menu.children("li").each(function(){
	
    if(!jQuery(this).hasClass("rel"))
      jQuery(this).find(".tooltip").css("left",jQuery(this).position().left+jQuery(this).width()/2);

});

menu.find("li").hover(function(){
   jQuery(this).children('.sub-menu').hide().slideDown('normal');
  },function(){
  jQuery(this).children('.sub-menu').stop(true,true).hide(); 
  });	

menu.children("li").each(function(){
		
		if(jQuery(this).children().hasClass("sub-menu"))
		jQuery(this).addClass("showdropdown");
		
		});
		
/* ==================================================================== */
/* ============================ Portfolio  Stuff ====================== */
/* ==================================================================== */

if(jQuery(".portfolio-wall-column").length>0)
{
   i =0;
   wall_height = 0;
   
  jQuery(".portfolio-wall-column>ul>li").each(function(){
	  temp = pre_values[i];
	  
	  jQuery(this).css({ left:temp[0] , top:temp[1]   });
	
	  i++;
	  }); 
		wall_height = 1010;
	jQuery(".portfolio-wall-column>ul").height(wall_height);  
}


	jQuery(".portfolio-taxonomy li a").click(function(e){
		taxonomy_parent.removeClass("active");
		taxonomy_parent = jQuery(this).parent();
		taxonomy_parent.addClass("active");
		
		var query = jQuery(this).html();
		var flag= false;
		
		if(jQuery.trim(query)=="All")
		{
			portfolio.fadeIn('normal');	
			e.preventDefault();
			return;
		}
		portfolio.hide();
		portfolio.each(function(){
			flag= false;
			jQuery(this).removeClass('clearleft');
			jQuery(this).find("small a").each(function(){
				if(jQuery(this).html()==query)
				{
					flag = true; 
				}
				});
				
			if(flag==false)
			jQuery(this).fadeOut('fast');
			else
			jQuery(this).fadeIn('normal');	
			
			});
		
		e.preventDefault();
		});
			   
jQuery(window).load(function(){
 
   if(jQuery(".portfolio").length>0)  
    create_effect(jQuery(".portfolio"));
});
	  
/* ==================================================================== */
/* ============================ Slider Stuff ========================== */
/* ==================================================================== */

var blog_scrollable = jQuery(".scrollable-posts-wrapper").scrollable({ api:true , vertical:true  });
var test_scrollable = jQuery(".testimonials").scrollable({ api:true , vertical:true  });
    
jQuery(".scrollable-next").click(function(e){ test_scrollable.next(); e.preventDefault(); });
jQuery(".scrollable-prev").click(function(e){ test_scrollable.prev(); e.preventDefault(); });
jQuery(".scrollable-posts-next").click(function(e){ blog_scrollable.next(); e.preventDefault(); });
jQuery(".scrollable-posts-prev").click(function(e){ blog_scrollable.prev(); e.preventDefault(); });
  

/* ==================================================================== */
/* ========================== Home page Stuff ========================= */
/* ==================================================================== */


jQuery(".homepage-wrap").each(function(){
   if(i==4)
   i=0;
 
   if(i==3)
   jQuery(this).addClass('clearleft').css("background","none");
   i++;
});


/* ==================================================================== */
/* =========================== Footer Stuff =========================== */
/* ==================================================================== */

 jQuery(".footer-wrap ul").each(function(){
	  jQuery(this).find("li").last().css("background","none");
  });
  
   jQuery("#footer-menu li:first a").css("border-left","none");
   jQuery(".footer-notes li:last").css({ "border-bottom":"none" , paddingBottom:0 }); 

/* ==================================================================== */
/* ============================ Misc Stuff ============================ */
/* ==================================================================== */


// contact input settings
  
jQuery("#qemail , #qmsg ,#qname").focusin(function(){ jQuery(this).val('');});

// lightbox initialization 
  
jQuery(".lightbox").prettyPhoto({animationSpeed:'slow'});

// Tabs call

jQuery( ".tabs" ).tabs({ fx: { opacity: 'toggle' }});
jQuery(".ui-tabs .ui-tabs-nav li:first").css("borderLeft","none");

if(jQuery("#flickr-images").length>0)
{
		var temp,i,flickr_limit = jQuery("#flickr-nos").val();
var fid =  jQuery("#flickr-id").val();
	i =0;
	jQuery.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id="+fid+"&lang=en-us&format=json&jsoncallback=?", function(data){
		
jQuery.each(data.items, function(i,item){
		
		if(i>=flickr_limit) 
		return;
		jQuery("<img/>").css({  width:70,height:56 }).attr({
			"src": item.media.m,
			"alt" : item.media.m
			}).appendTo("#flickr-images").wrap("<a href='" + item.link + "'></a>");
			
		
		i++;
	});
	
  });
  
}
	
	
		
if(jQuery(".scroller-posts").length>0)
  {
     var showcase = jQuery(".scroller-posts").scrollable({api:true});
     jQuery(".showcase-next").click(function(e){ showcase.next(); e.preventDefault(); });
	 jQuery(".showcase-prev").click(function(e){ showcase.prev(); e.preventDefault(); });
  }
  
if(jQuery(".single-scroller-posts").length>0)
  {
	  var showcase = jQuery(".single-scroller-posts").scrollable({api:true});
	   jQuery(".single-showcase-next").click(function(e){ showcase.next(); e.preventDefault(); });
	 jQuery(".single-showcase-prev").click(function(e){ showcase.prev(); e.preventDefault(); });
  }
	

/* ==================================================================== */
/* =========================== Gallery Stuff ========================== */
/* ==================================================================== */  

var gstage = jQuery(".image-stage");	
var ptitle = jQuery(".title").find("a").html();     
  
jQuery(".gallery-menus1 ul li").each(function(){
	  temp = jQuery(this).find("a");
	  
	  if(jQuery.trim(temp.html())==jQuery.trim(ptitle))
	  temp.addClass("active");
	  
});
	   
jQuery(".custom-prev").click(function(e){
	   jQuery(".custom-gallery-thumbs .thumbnails a").removeClass("iactive");
	   
	   if( current_cthumb.prev().length == 0 )
	   current_cthumb =    jQuery(".custom-gallery-thumbs .thumbnails a").last();
	   else
	   current_cthumb =  current_cthumb.prev();
	   
	  
	  
	 setCustomGallery(current_cthumb);
	  
e.preventDefault();  });
	
jQuery(".custom-next").click(function(e){
	   jQuery(".custom-gallery-thumbs .thumbnails a").removeClass("iactive");
	   
	   if( current_cthumb.next().length == 0 )
	   current_cthumb =    jQuery(".custom-gallery-thumbs .thumbnails a").first();
	   else
	   current_cthumb =  current_cthumb.next();
	   
	  
	  
	 setCustomGallery(current_cthumb);
	  
e.preventDefault();  });
	    
  
jQuery(".custom-gallery-thumbs .thumbnails a").click(function(e){
	  jQuery(".custom-gallery-thumbs .thumbnails a").removeClass("iactive");
	  current_cthumb = jQuery(this);
	 setCustomGallery(current_cthumb);
	  e.preventDefault();
});
   
function setCustomGallery(element)
{
	  gstage.find("span").hide();
	  element.addClass("iactive");
	  temp = element.attr("href");
	  src = element.children("img").attr("alt");
	 
	  var title = element.children("img").attr("title");
	 
	 
	  gstage.children("a").attr("href",element.attr("alt"));
	  gstage.children("a").children("img").attr("title",title);
	   
	  
	  gstage.find("img").fadeOut("fast",function(){
	  jQuery(this).attr("src",temp);
	  
	  jQuery(this).load(function(){ jQuery(this).fadeIn("normal",function(){ 
	  gstage.find("span").html("<h2 class='custom-font'>"+jQuery(this).attr("title")+"</h2>"+src).fadeIn("normal");  });   });
	  });
   
}

  
  
if(jQuery(".blog-container").length>0)
	{
		jQuery(".blog-container .posts-list ul li").last().css("background","none");
	}
	
/* ==================================================================== */
/* =========================== Event Stuff ============================ */
/* ==================================================================== */  

jQuery(".events-list>ul>li:last").css("border","none"); 
jQuery(".posts-list").find("li.separator").last().remove();
jQuery("#calendar table td ").each(function(){ 
	
	if(jQuery(this).find('.event-details').length>0)
	jQuery(this).find(".event-wrapper").jScrollPane();
	else
	jQuery(this).find(".event-div").remove();
	
});

 jQuery("#calendar table td").hover(function(){
		
	if(jQuery(this).find('.event-details').length>0)
	jQuery(this).find('.event-div').css( "visibility" , "visible").stop(true,true).animate({opacity:1,bottom:-90},500);
	},function(){
	temp = jQuery(this);
	jQuery(this).find('.event-div').stop(true,true).animate({opacity:0,bottom:-70},500,function(){ jQuery(this).css("visibility" ,"hidden") });	
});


/* ==================================================================== */
/* ===================== HTML5 Effects Generator ====================== */
/* ==================================================================== */ 

	
	function create_effect(parent)
	{
		counter = 0;
		parent.find("img").each(function(){
			 temp = jQuery(this);
			 temp_parent = temp.parent();
			 
			 if(temp_parent.parent().hasClass("mainslider"))
			 return;
			 
			 if(jQuery("#image_effect").val()!="Disabled"&&!(jQuery.browser.msie))
			 {
			   generateEffect(temp,counter,temp.height(),temp.width());
			   	
					temp_parent.parent().hover(function(){
						  
						  if(parent.hasClass("gallery"))
						  {
							  
							  
							  jQuery(this).find('.title').fadeOut('fast');
							  
						  }
							   
						  jQuery(this).find('.icon-panel').hide();
						  
						  if(jQuery("#image_invert").val()=="false")
						  {
						  jQuery(this).find('canvas').stop(true,true).fadeIn('normal');
						  jQuery(this).find('.icon-panel').css("z-index",21).stop(true,true).fadeIn('normal');
						  }
						  else	
						  { 
						   jQuery(this).find('canvas').stop(true,true).fadeOut('normal',function(){
							  jQuery(this).find('.icon-panel').stop(true,true).fadeIn('normal');
							  }); 
						  }
						   if(parent.hasClass("gallery"))
						     jQuery(this).find('.link-icon').css("z-index",21).stop(true,true).fadeIn('normal');
						  
						  },function(){ 
						  
						  if(parent.hasClass("gallery"))
						  {
							  
							  
							  jQuery(this).find('.title').fadeIn('fast');
						  }
						  
							  jQuery(this).find('.icon-panel').css("z-index",8).hide();
							   
							    if(parent.hasClass("gallery"))
								 jQuery(this).find('.link-icon').css("z-index",8).hide();
								
						   if(jQuery("#image_invert").val()=="false")	  
						  jQuery(this).find('canvas').stop(true,true).fadeOut('normal');
						  else
						   jQuery(this).find('canvas').stop(true,true).fadeIn('normal');
			        });
			 }
			 else
			 {
				 temp.css( "visibility" , "visible");
				// temp.after("<span class='image-icon' href='#'></span><span class='link-icon' href='#'></span>");
				 temp_parent.parent().hover(function(){
						  
						  if(parent.hasClass("gallery"))
							  jQuery(this).find('.title').fadeOut('fast');
					
						    jQuery(this).find('.icon-panel').stop(true,true).fadeIn('normal');
							   if(parent.hasClass("gallery"))
						     jQuery(this).find('.link-icon').css("z-index",21).stop(true,true).fadeIn('normal');
						  },function(){ 
						  
						  if(parent.hasClass("gallery"))
						    if(parent.hasClass("gallery"))
								 jQuery(this).find('.link-icon').css("z-index",8).hide();
						   jQuery(this).parent().find('.title').fadeIn('fast');
						 	  jQuery(this).parent().find('.icon-panel').fadeOut('fast');
						 
			        });
			 }
            
			 
			 counter++;
			 
			 
			});
			
			
	}
	  
	
		
	
/* ==================================================================== */
/* ===================== Contact Form Settings ======================== */
/* ==================================================================== */ 
	
	
	jQuery("#qsubmit").click(function(e){
	 temp = jQuery(this).parent().find(".loader");
	 //temp.fadeIn("slow");
	 var loader = jQuery(this).parent().find(".ajax-loading-icon").fadeIn("slow");
	 
	 jQuery.post( jQuery(this).parent().find("#ajax_contact_path").val(),{ 
	 notify_email : jQuery(this).parent().find("#notify_email").val(),
	 name : jQuery(this).parent().find("#qname").val(),
	 email : jQuery(this).parent().find("#qemail").val(),
	 message : jQuery(this).parent().find("#qmsg").val()
	 
	 },function(data){
		
		
		if(data=="success") {
		loader.fadeOut("slow",function(){
			 temp.addClass('success-box').removeClass('error-box').fadeToggle("slow");
			 setTimeout(function(){ temp.fadeToggle("normal"); },4000);
			 });
			 
		 }
		else
		{
		  loader.fadeOut("slow");
			temp.removeClass('success-box').addClass('error-box').html("<p>Error</p>");
			 temp.fadeToggle("slow");
			 setTimeout(function(){ temp.fadeToggle("normal"); },4000);
			 
		}	 
		
		});
		
		
		e.preventDefault();
		
	});
    
	jQuery(".d_submit").click(function(e){
		
		
		obj = jQuery(this);
		var msg = obj.parents(".dynamic_forms").find(".loader");
		var array = obj.parent().serializeArray();
		var loader = jQuery(this).parents(".dynamic_forms").find(".ajax-loading-icon").fadeIn("slow");
		
		jQuery.post( obj.parent().attr("action"), { key:obj.parent().find(".form_key").val() , values : array , notify_email : obj.parent().find(".notify_email").val() , recaptcha_challenge_field:obj.parent().find("#recaptcha_challenge_field").val()   , recaptcha_response_field:obj.parent().find("#recaptcha_response_field").val()  } , function(data){
			
			if(data=="success")
			{
				loader.fadeOut("slow");
			    msg.addClass('success-box').removeClass('error-box').html("<p> Your Message been sent </p>");
			    msg.fadeIn("slow");
			}
			else
			{
				loader.fadeOut("slow");
				msg.removeClass('success-box').addClass('error-box').html("<p>"+data+"</p>");
				msg.fadeIn("slow");
			}
			
			}  );
		
		e.preventDefault();
		
		});
	
			
			
	});
	
	
	
	
/* ==================================================================== */
/* ===================== HTML5 Effects Generator ====================== */
/* ==================================================================== */ 	
	
	 function generateEffect(image,index,height,width)
	{
		var image_effect=jQuery("#image_effect").val(),
		 im = image,
		 parent = im.parent(),
		 arr = new Array(); i =0;  j =0, 
		 src = im.attr("src");
		
		parent.append("<canvas width='"+width+"' height='"+height+"' id='s"+index+"' />");
		
		
		image = im[0];
						
		var canvas = document.getElementById('s'+index);
		var context = canvas.getContext('2d');
       
	    context.drawImage(image, 0, 0);
        var grayscale,imageData    = context.getImageData(0,0,canvas.width,canvas.height),
		data        = imageData.data;
       
	  if(image_effect=="Greyscale") {
	  
        for(var i = 0,z=data.length;i<z;i++){

            // The values for red, green and blue are consecutive elements
            // in the imageData array. We modify the three of them at once:

             grayscale = data[i  ] * .24 + data[i+1] * .01 + data[i+2] * .1;
             data[i] = grayscale;
             data[++i] = grayscale;
             data[++i] = grayscale;
 			 data[++i] = 255;
			
			}
			
	  }
		else if (image_effect=="Screen") {
		 for(var i = 0,z=data.length;i<z;i++){	
			 data[i] =    255 - ( ( 255 - data[i] ) * ( 255 - data[i] ) ) / 255;
             data[++i] =   255 - ( ( 255 - data[i] ) * ( 255 - data[i] ) ) / 255;
             data[++i] =   255 - ( ( 255 - data[i] ) * ( 255 - data[i] ) ) / 255;
 			 data[++i] = 255;
			}
			
          
		}
		else if (image_effect=="Color Burn") {
		
        for(var i = 0,z=data.length;i<z;i++){
			data[i] =     data[i] <= 0? 0 : Math.max(255 - ((255 -  data[i]) * 255 /  data[i]), 0);
            data[++i] =  data[i] <= 0? 0 : Math.max(255 - ((255 -  data[i]) * 255 /  data[i]), 0);
            data[++i] =   data[i] <= 0? 0 : Math.max(255 - ((255 -  data[i]) * 255 /  data[i]), 0);
 			data[++i] = 255;
			
          }
	         
		}
		else if (image_effect=="Overlay") {
		
        for(var i = 0,z=data.length;i<z;i++){
			  data[i] = data[i] < 128 ? ( 2 * data[i] *  data[i] ) / 255 : 255 - ( 2 * ( 255 - data[i]) * ( 255 -  data[i] ) / 255 );
            data[++i] =  data[i] < 128 ? ( 2 * data[i] *  data[i] ) / 255 : 255 - ( 2 * ( 255 - data[i] ) * ( 255 -  data[i] ) / 255 );
            data[++i] =  data[i] < 128 ? ( 2 * data[i] *  data[i] ) / 255 : 255 - ( 2 * ( 255 - data[i] ) * ( 255 -  data[i] ) / 255 );
 			data[++i] = 255;
			
          }
	         
		}
		else if (image_effect=="Red Channel") {
		
        for(var i = 0,z=data.length;i<z;i++){
			 data[i] = data[i] ;
            data[++i] = data[i-1] ;
            data[++i] = data[i-2] ;
 			data[++i] = 255;
          }
	         
		}
		else if (image_effect=="Green Channel") {
		
        for(var i = 0,z=data.length;i<z;i++){
			  data[i] = data[i+1] ;
            data[++i] = data[i] ;
            data[++i] = data[i-1] ;
 			data[++i] = 255;
			
          }
	         
		}
		else if (image_effect=="Blue Channel") {
		
        for(var i = 0,z=data.length;i<z;i++){
			   data[i] = data[i+2] ;
            data[++i] = data[i+1] ;
            data[++i] = data[i] ;
 			data[++i] = 255;
			
          }
	         
		}
		else if (image_effect=="Green Tone") {
		
        for(var i = 0,z=data.length;i<z;i++){
			 grayscale = data[i  ] * .3 + data[i+1] * .59 + data[i+2] * .11;
             data[i] = Math.min(grayscale,data[i]) ;
            data[++i] = Math.min(grayscale,data[i]) ;
            data[++i] =  Math.min(grayscale,data[i]) ;
 			data[++i] = 255;
          }
	         
		}
		else if (image_effect=="Red Tone") {
		
        for(var i = 0,z=data.length;i<z;i++){
			grayscale = data[i  ] * .3 + data[i+1] * .59 + data[i+2] * .11;
             data[i] = Math.max(grayscale,data[i]);
            data[++i] = grayscale;
            data[++i] = grayscale;
 			data[++i] = 255;
          }
	         
		}
		else if (image_effect=="Blue Tone") {
		
        for(var i = 0,z=data.length;i<z;i++){
			grayscale = data[i  ] * .3 + data[i+1] * .59 + data[i+2] * .11;
             data[i] = Math.min(grayscale,data[i]) ;
            data[++i] = Math.min(grayscale,data[i]) ;
            data[++i] =  Math.max(grayscale,data[i]) ;
 			data[++i] = 255;
          }
	         
		}
		

         // Putting the modified imageData back on the canvas.
        context.putImageData(imageData,0,0,0,0,imageData.width,imageData.height);
		
		 if(jQuery("#image_invert").val()=="false")
			jQuery("#s"+index).hide();	
			else
			jQuery("#s"+index).show();	
			
			im.css("visibility","visible");
				
			}