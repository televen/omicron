/** Televen 10.0 framework */
var buttons = [];

$(function(){
	$('.button img').each(function(i, item){
		buttons.push(item);
	});
	
	$('.button').live("mouseenter",function(){
		$('.light_box').attr('class', 'light_box lb_' + $(this).data('lb')).fadeIn().children('.text_holder').html();
	}).live("mouseleave", function(){
		$('.light_box').fadeOut(100);
	});
	
	animateButtons();
});

function animateButtons(){
	if(buttons.length > 0){
		icon = buttons.shift();
		$(icon).animate({'width':'75px', 'height':'75px'}, 500).animate({'width':'55px', 'height':'55px'}, 250).animate({'width':'60px', 'height':'60px'}, 125);
		setTimeout('animateButtons()', 500);
	}
}
