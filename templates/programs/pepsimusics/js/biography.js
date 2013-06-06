$(function(){
	setTimeout("initBio()", 3000);
});

function initBio(){
	$(".bios").animate({"top" : "0px"});
	$(".picture").animate({"left":"195px"});
	$(".picture img").animate({"width":"100px"});
}