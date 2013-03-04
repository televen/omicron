var tweets = new Array();

$(function(){
	$('.tweet').each(function(i){
		tweets.push($(this));
	});
	animateTweetsIn();
	
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

function animateTweetsIn(){
	if(tweets.length > 0){
		tweets[tweets.length - 1].css({'top': (tweets[tweets.length - 1].data("position-y")) * 10, 'left': (tweets[tweets.length - 1].data("position-x") * 10), 'background' : tweets[tweets.length - 1].data("color")}).animate({width:'10px', height:'10px'}, 300);
		tweets.pop();
		setTimeout('animateTweetsIn()', 200);
	}else{
		console.debug("end");
	}
}

function animateButtonsOut(){
	if(btns.length > 0){
		btns[btns.length - 1].animate({left:'10px'}, 75).animate({left:'-20px'}, 150).animate({left:'700px'}, 300);
		btns.pop();
		setTimeout('animateButtonsOut()', 200);
	}
}