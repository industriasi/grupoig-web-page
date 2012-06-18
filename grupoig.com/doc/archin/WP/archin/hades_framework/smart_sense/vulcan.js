// JavaScript Document

jQuery(function($)
{

function loadwin(tweetlink) {
var load = window.open(tweetlink,'','scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,location=no,status=no');
}

$(".tweet-button").click(function(e){
	
	loadwin($(this).attr("href"));
	
	e.preventDefault();
	});


$(".fb-button").click(function(e){
	
	loadwin($(this).attr("href"));
	
	e.preventDefault();
	});
$(".stumble-button").click(function(e){
	
	loadwin($(this).attr("href"));
	
	e.preventDefault();
	});	
$(".reddit-button").click(function(e){
	
	loadwin($(this).attr("href"));
	
	e.preventDefault();
	});
	
		
});