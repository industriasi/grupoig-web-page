$(function(){
	var hlink, position;
	
	$(".sidemenu ul li a").click(function(){
		$(".sidemenu ul li").removeClass('active');
		
		hlink = $(this).attr("href");
		
		
		position  = $(hlink).position().top;
		$('html, body').animate({scrollTop:position}, 'slow');
		
		$(this).parent().addClass('active');
		
		return false;
		
		});
	
	
	});