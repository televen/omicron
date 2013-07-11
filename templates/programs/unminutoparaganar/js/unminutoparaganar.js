/** Televen 10.0 framework */
var images 		= [];
var loader 		= [];
var id 			= 0;
var opacity		= 0.1;
var counter		= 0;

$(function(){
	init();
	
	$(".min li").live("click", function(){
		_gaq.push(['_trackEvent', 'UMPG', 'Clic', 'change glass - ' + $(this).data("id")]);
		$(".active").fadeOut("slow", function(){
			$(this).removeClass(".active");
		});
		$("#max-" + $(this).data("id")).addClass("active").fadeIn();
	});
});



function init(){
	$('.glasses .min li, .glasses .max li').each(function(i){
		images.push($(this));
	});
	
	if((images.length / 2) < 9){
		$('.arrow-left, .arrow-right').hide();
	}
	
	counter = Math.floor(images.length * 0.2);
	
	$.each($(".loader_sq li"), function(i,item){
		loader.push(item);
	});
	
	animateImagesIn();
	
	interval = setInterval("moveLoader()", 500);
}

function moveLoader(){
	$(loader[id]).css("opacity", opacity);
	opacity = opacity + 0.01; id++;
	if(id == 11){
		$(".loader_sq li").css("opacity", "1");
		opacity = 0.1;
		id = 0;
	}
}

function animateImagesIn(){
	console.debug(counter);
	if(images.length > 0){
		var image = images.shift();
		var img = new Image();
		$(img).load(function(){
			$(this).hide();
			image.append(this);
			counter--;
		})
		.attr('src', image.data('img-src')).fadeIn(1000);
		setTimeout('animateImagesIn()', 200);
	}
	
	if(counter <= 0){
		clearInterval(interval);
		$(".loader").fadeOut(500, function(){
			$("img").fadeIn(1000); 
		});
	}
}