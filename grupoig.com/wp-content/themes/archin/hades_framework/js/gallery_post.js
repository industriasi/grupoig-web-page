/*
*

Author - Abhin Sharma (WPTitans)
This code cannot be used anywhere without the permission of the Author.

*
*/

/* ========================================================================================================= */	
/* ======================================== Gallery Functionality ========================================== */	
/* ========================================================================================================= */
jQuery(function($){
	
	// Make it before WP Editor
	$("#gallery_credits_meta").insertBefore("#postdivrich");
	
	var temp,slide = $("#hades_gallery .slider-lists>ul>li:first").clone(),hgallery=$("#hades_gallery");
	
	// get a slide and reset it
	slide.find("input[type=text]").val('');
	slide.find("textarea").html('');
	slide.find("img").attr('src','');
	slide.find('.slide-toggle-button').removeClass('max-slide-button').addClass('min-slide-button').html('Collapse');
	
	
	hgallery.find("  .contract .slide-body").hide();
	hgallery.find( ".slider-lists>ul" ).sortable({
			placeholder: "drag-highlight"
		});
		
	hgallery.find("#addslide").click(function(e){
		    temp = slide.clone();
	    	$(".slider-lists>ul").append(temp);
		    e.preventDefault();
		});
		
	hgallery.find(".slide-toggle-button").live('click',function(e){
		temp = $(this);
		
		  $(this).parent().next().slideToggle('normal',function(){ 
	    		if($(this).is(":visible"))
		          temp.html("Collapse").removeClass('max-slide-button').addClass('min-slide-button');
		        else
		          temp.html("Expand").addClass('max-slide-button').removeClass('min-slide-button');
		
		 });
		e.preventDefault();
	});	
			
	hgallery.find(".removeslide").live("click",function(e){
		
		$(this).parents("li").remove();
		
		e.preventDefault();
		});		
	
});
	
	
	