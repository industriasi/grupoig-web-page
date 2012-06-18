// JavaScript Document

jQuery(document).ready(function($){
	
	var obj = '';
		$( ".shortcodes-tabs , .shortcodes-accordion" ).each(function(){
		   obj = $(this);
		   obj.find("br").remove();
			
		   obj.find("p,a").each(function(){
			   if($(this).is(":empty"))
			   $(this).remove();
			   });
		   
		 obj.find("p").replaceWith(function() { return $(this).contents();   });
		   
			});
			
	$( ".shortcodes-tabs").children("ul").find("li").each(function(index){
		if(index!=0)
		$(this).find("a:first").remove();
		});
	});


jQuery(function($){
	
	var temp;
	
	
	
			
	
	$("a").css("-moz-outline-style","none");
	
	
		
	
	
	$( ".shortcodes-tabs" ).tabs();
	
	
	$( ".shortcodes-accordion" ).accordion();
	$(".separator a").click(function(){ $(window).scrollTop(0); });
	
	$( ".toggletitle" ).click(function(){
		temp = $(this);
		$(this).next().slideToggle('fast', function() {
       
	   if(!$(this).is(":visible"))
	   temp.addClass("shortcodes-slideup").removeClass("shortcodes-slidedown");
	   else
	   temp.addClass("shortcodes-slidedown").removeClass("shortcodes-slideup");
	   
  });
		});
	
	$(window).load(function(){
	$(".image-wrapper").each(function(){
	   	
	$(this).find(".caption").width($(this).find("img").width());
		});
	});
	
	});