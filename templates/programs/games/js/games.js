/** Televen 10.0 framework */
var loader	 	= [];
var interval 	= "";
var id			= 0;
var opacity		= 0.1;
var images 		= [];
var indexes 	= [];
var temp 		= [];
var pressed		= [];
var level 		= 0;
var index		= 0;
var points 		= 0;
var timeBetween = 500;
var timeBetweenClic = 200;

$(function(){
	init();
	
	$(".color").live("click", function(e){
		e.preventDefault();
		colorPressed(parseInt($(this).data("identifier")));
	});
	
	$('.pre-load-img').each(function(i){
		images.push($(this));
	});
	animateImagesIn();
	
	$(".play").live("click", function(){
		$(this).fadeOut();
		$(".score").fadeIn();
		play();
	});
});

function colorPressed(identifier){
	$(".c"+identifier).fadeIn(timeBetweenClic)
					  .fadeOut(timeBetweenClic);
	pressed.push(identifier);
	temp = clone(indexes);
	
	// si no le ha dado clic a todos los botones que les corresponde
	// hay que tomar el tamaño del indexes y llevarlo al tamaño de 
	// lo que ha sido presionado para compararlo
	if(!indexes.length == pressed.length){
		temp = temp.slice(0, pressed.length);
	}else{
		end = true;
	}
	
	// Se equivoco en algun punto
	console.debug(temp.join());
	if(!temp.join() === pressed.join()){
		gameOver();
	}else if(temp.join() === pressed.join()){
		points = points + 10;
		$(".simon_says > .score > .points").html(points);
		setTimeout("play()", 500);
	}
}

function clone(a){
	var n = new Array(a.length);
	for(var i = 0; i < a.length; i++){
		n[i] = a[i];
	}
	return n;
}

function init(){
	$.each($(".loader_sq li"), function(i,item){
		loader.push(item);
	});
	
	interval = setInterval("moveLoader()", 500);
	/**/
}

function animateImagesIn(){
	if(images.length > 0){
		var image = images.shift();
		var img = new Image();
		$(img).load(function(){
			$(this).hide();
			image.append(this);
			$(this).fadeIn("slow");
			image.append($('.zoom-holder').html());
			image.children('.zoom-wrapper').addClass((image.hasClass('big')) ? "bigger" : "smaller");
		})
		.attr('src', image.data('src'));
		setTimeout('animateImagesIn()', 200);
	}else{
		clearInterval(interval);
		$(".loader").fadeOut(500);
	}
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

function play(){
	pressed = [];
	indexes.push(generateRandomColor());
	temp = clone(indexes);
	showColors();
	
	if(arguments.length > 0){
		level++;
	}
}

function showColors(){
	if(temp.length > 0){
		$(".c"+temp[0]).fadeIn(timeBetween)
					   .fadeOut(timeBetween, function(){
							temp.splice(0,1);
							showColors();
					   });
	}else{
		temp = clone(indexes);
	}
}

function generateRandomColor(){
	// 1: rojo; 2: azul; 3: amarillo; 4:verde
	return Math.floor(Math.random() * 4) + 1;
}

function gameover(){
	$(".simon_says > .score > .points").html(":(");
	indexes = [];
	pressed = [];
	temp = [];
	level = 0;
	point = 0;
}