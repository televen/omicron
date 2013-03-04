var btns = new Array();

$(function(){
	$('.btn').each(function(i){
		btns.push($(this));
	});
	animateButtonsIn();
	
	$('.btn').click(function(e){
		$('.btn').each(function(i){
			btns.push($(this));
		});
		animateButtonsOut();
		$('.salutation').css({'top' : (e.pageY - 100) + 'px', 'left' : e.pageX + 'px'}).fadeIn("slow", function(){
			setTimeout('hideSalutation()', 1500);
		});
	});
});

function hideSalutation(){
	$('.salutation').fadeOut();
}

function animateButtonsIn(){
	if(btns.length > 0){
		btns[btns.length - 1].animate({left:'20px'}, 300).animate({left:'-10px'}, 150).animate({left:'0px'}, 75);
		btns.pop();
		setTimeout('animateButtonsIn()', 200);
	}
}

function animateButtonsOut(){
	if(btns.length > 0){
		btns[btns.length - 1].animate({left:'10px'}, 75).animate({left:'-20px'}, 150).animate({left:'700px'}, 300);
		btns.pop();
		setTimeout('animateButtonsOut()', 200);
	}
}