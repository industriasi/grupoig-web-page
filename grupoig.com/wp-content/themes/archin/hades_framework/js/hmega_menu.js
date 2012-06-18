// JavaScript Document

jQuery(function($){
	var temp, type ;
	$(".h_megamenu_box input[type=checkbox]").live("click",function(){
		temp = $(this);
		if(temp.is(":checked"))
		{
			temp.parents("li.menu-item").find(".item-type-hmenu").show();
			// menu-item-data-parent-id
			type = temp.parent().find("select").val();
			
			if(type="column")
			{
				set_column_tree(temp.parents("li.menu-item"));
			}
			
		}
		else
		{
			temp.parents("li.menu-item").find(".item-type-hmenu").hide();
			restruct_tree(temp.parents("li.menu-item"));
		}
		
		});
	
	
	
	$(".enable_textbox").live("click",function(){
		temp = $(this);
		if(temp.is(":checked"))
		{
			temp.next().fadeIn("normal");
			
		}
		else
		{
			temp.next().hide();
		}
		
		});
		
		
	 $("#menu-to-edit").find(".menu-item").each(function(){
		 if(!$(this).hasClass("menu-item-depth-0"))
		{
			 $(this).find(".h_megamenu_box").hide();
			  $(this).find(".item-type-hmenu").hide();
			 if($(this).find(".h_megamenu_box input[type=checkbox]").is(":checked"))
			 {
				 $(this).find(".h_megamenu_box input[type=checkbox]").removeAttr("checked");
			 }
		}
		 else
		{
			type = $(this).find("select").val();
			
			if(type="column")
			{
				set_column_tree($(this));
				
			}
			
			
			 $(this).find(".h_megamenu_box").show();
			  $(this).find(".h_megamenu_row_box").hide();
			 // $(this).find(".item-type-hmenu").show();
		}
		 });
		 
		 
	
	$(".h_megamenu_box input[type=checkbox]").each(function(){
		
		if($(this).is(":checked"))
		$(this).parents("li.menu-item").find(".item-type-hmenu").show();
		});
	
	$("#menu-to-edit").bind( "sortstop", function(event, ui) {
    temp = $(this);
	
	type = $(this).find(".h_megamenu_box select").val();
	
	var flag=false,dragel = ui;
	
		
		setTimeout(function(){
		
		var pindex = "#menu-item-"+($(dragel.item).find(".menu-item-data-parent-id").val());	
	
	   if( $(pindex).find(".h_megamenu_box input[type=checkbox]").is(":checked") )
	   flag = true;
	   else
	   flag = false;
	
		
	 temp.find(".menu-item").each(function(){
		
		 
		 if(!$(this).hasClass("menu-item-depth-0"))
		{
		 
		 	if(flag==true)
			{
			 $(this).find(".h_megamenu_box").hide();
			  $(this).find(".item-type-hmenu").hide();
			 if($(this).find(".h_megamenu_box input[type=checkbox]").is(":checked"))
			 {
				 $(this).find(".h_megamenu_box input[type=checkbox]").removeAttr("checked");
			 }
			 
			$(this).find(".h_megamenu_row_box").show();
			$(this).find(".item-type-h-column").show();
			}
			else
			{
				 $(this).find(".h_megamenu_box").hide();
			}
		
		}
		 else
		{
			 $(this).find(".h_megamenu_row_box").hide();
			 $(this).find(".h_megamenu_box").show();
			 $(this).find(".item-type-h-column").hide();
			 // $(this).find(".item-type-hmenu").show();
			 
			  if($(this).find(".h_megamenu_row_box input[type=checkbox]").is(":checked"))
			 {
				 $(this).find(".h_megamenu_row_box input[type=checkbox]").removeAttr("checked");
			 }
			 
		}
		
		if($(this).hasClass("menu-item-depth-2"))
		{
		  $(this).find(".h_megamenu_row_box").hide();	
		  $(this).find(".item-type-h-column").hide();
		  $(this).find(".h_megamenu_box").hide();
		  $(this).find(".item-type-hmenu").hide();
		 
		  if($(this).find(".h_megamenu_row_box input[type=checkbox]").is(":checked"))
			 {
				 $(this).find(".h_megamenu_row_box input[type=checkbox]").removeAttr("checked");
			 }
		  if($(this).find(".h_megamenu_box input[type=checkbox]").is(":checked"))
			 {
				 $(this).find(".h_megamenu_box input[type=checkbox]").removeAttr("checked");
			 }
		}
		
		 });
	},500);
	 
});

function set_column_tree(parent)
{
	var test,obj,id = parent.attr("id");
	if(parent.find(".h_megamenu_box input[type=checkbox]").is(":checked"))
	{
	
	$("#menu-to-edit").find(".menu-item").each(function(){
		obj = $(this);
		test = parseInt($(this).find(".menu-item-data-parent-id").val());
		if(test>0)
		{
			test = "menu-item-"+test;
			if(id==test)
			{
				obj.find(".item-type-h-column").show();
				obj.find(".h_megamenu_row_box").show();
			}
		}
		
		});
		
	}
}


function restruct_tree(parent)
{
	var test,obj,id = parent.attr("id");
	
	
	$("#menu-to-edit").find(".menu-item").each(function(){
		obj = $(this);
		test = parseInt($(this).find(".menu-item-data-parent-id").val());
		if(test>0)
		{
			test = "menu-item-"+test;
			if(id==test)
			{
				obj.find(".item-type-h-column").hide();
				obj.find(".h_megamenu_row_box").hide();
			}
		}
		
		});
	
}

	if(typeof wpNavMenu != 'undefined'){ 
	
	wpNavMenu.addItemToMenu = function(menuItem, processMethod, callback) {
			var menu = $('#menu').val(),
				nonce = $('#menu-settings-column-nonce').val();

			processMethod = processMethod || function(){};
			callback = callback || function(){};

			params = {
				'action': 'H_MegaMenu_AJAX_Menu',
				'menu': menu,
				'menu-settings-column-nonce': nonce,
				'menu-item': menuItem
			};

			$.post( ajaxurl, params, function(menuMarkup) {
				var ins = $('#menu-instructions');
				
				
				
				processMethod(menuMarkup, params);
				if( ! ins.hasClass('menu-instructions-inactive') && ins.siblings().length )
					ins.addClass('menu-instructions-inactive');
				callback();
				
				
			});
		}; 
		
		}
		
	
	
	});