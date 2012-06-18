// JavaScript Document

jQuery(function($){
	
	var temp,obj,parent,str_temp,menu_panel = $(".form-options");
	var form_canvas = $("#formbuilder");
	var ajax_loading_icon = $("#iloader");
	var element  = jQuery("<p class='hades_input clearfix'> <input type='hidden' value='' class='form_element' name='form_element[]' /> \
	            <a href='#' class='remove'></a> \
				<label class='label'> \
				  <input type='text' value='click to edit' /> \
				  <input type='hidden' value='click to edit label' class='label_value' name='label_value[]' /><span>Click to edit label</span></label> \
				<label class='name'><input type='text' value='' /> <input type='hidden' value='' class='name_value' name='name_value[]' /> <span>Click to edit name, optional </span></label> </p>"); 
	
	form_canvas.sortable({ placeholder: 'form-highlight' ,
	 start: function(event,ui){
		 
		 ui.placeholder.height( ui.item.height() );
		 
		 } });
	
	$(".options").find("a").click(function(e){
		ajax_loading_icon.stop(true,true).fadeIn("slow");
		
		obj = $(this);
		parent = obj.parent();
		temp = element.clone();
		
		
		form_canvas.append(temp);
		temp.append(parent.find(".element").clone());
		temp.find(".form_element").val(parent.find(".type").val());
		
		if(parent.find(".type").val()=="select")
		{
			temp.append("<label class='label'> \
				  <input type='text' value='enter options followed by comma' class='option_value' /> \
				  <span>enter options followed by comma </span></label> ");
				
		}
		
		
		ajax_loading_icon.fadeOut("fast");
		
		e.preventDefault();
		});
	
	 $(".option_value").live("focusout",function(){
		 if(jQuery.trim($(this).val())!="")
		 $(this).parents(".hades_input").find(".form_element").val("select : "+$(this).val());
		 });
	
	 form_canvas.delegate(".label , .name ","click",function(){
		 
		 $(this).find("input[type=text]").fadeIn('fast');
		 $(this).find("span").css("visibility","hidden");
		 });
	 
	 
	 $(".remove").live("click",function(e){
		 ajax_loading_icon.stop(true,true).fadeIn("slow");
		 
		 $(this).parent().animate({height:0 , opacity:0 },"normal",function(){  
		 $(this).remove();
		 ajax_loading_icon.fadeOut("slow");
		 });
		 e.preventDefault();
		 });
	 
	 
	 $(".label input[type=text] , .name input[type=text]").live("focusout",function(){ 
	 if(jQuery.trim($(this).val())!="") {
	 obj = $(this);
	 obj.parent().children("span").html(obj.val()); 
	 obj.parent().children("input[type=hidden]").val(obj.val()); 
	 obj.parent().find("span").css("visibility","visible");
	 }
	 obj.hide();
	 
	 });
	 
	 
	 $(".form-options .admin-button").click(function(e){ 
	 
	 
	ajax_loading_icon.stop(true,true).fadeIn("slow");
	 }); 
	 
	 $("#email_notification").click(function(){
		 
		 if($(this).is(":checked"))
		 $(".email_notification_mail").fadeIn("normal");
		 else
		  $(".email_notification_mail").hide();
		 
		 });
	
	
	
	});