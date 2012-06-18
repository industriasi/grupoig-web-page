// JavaScript Document

jQuery(function($){
	
	if($(".importer_disabled").length==0)
 {
	 	$(".helper-tree li:first").addClass("active"); 
 }else
	{
		
		$(".helper-tree li:first").addClass("disabled");
		$(".helper-tree li:first").children("div").hide();
	}
	$(".helper-tree li").not(".disabled, .disable_menu").children("h4").click(function(){ 
	
	$(".helper-tree li").removeClass("active"); $(this).parent().addClass("active"); 
	$(".helper-tree li").not($(this).parent()).children("div").slideUp('normal');
	
	$(this).next().slideToggle("normal"); 
	
	});
	// begin_import
	$(".tbutton").click(function(e){ $("#iloader").fadeIn("slow"); });
	$("#importer").click(function(e){ $("#iloader").fadeIn("slow");  });
	
	
	});