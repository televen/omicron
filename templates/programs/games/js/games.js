/** Televen 10.0 framework */
var indexes 	= [];
var temp 		= [];
var pressed		= [];
var level 		= 0;
var points 		= 0;
var timeBetween = 500;

$(function(){
	init();
	
	$(".color").live("click", function(e){
		e.preventDefault();
		colorPressed(parseInt($(this).data("identifier")));
	});
});

function colorPressed(identifier){
	pressed.push(identifier);
	temp = indexes;
	var end = false;
	
	// si no le ha dado clic a todos los botones que les corresponde
	// hay que tomar el tamaño del indexes y llevarlo al tamaño de 
	// lo que ha sido presionado para compararlo
	if(!indexes.length == pressed.length){
		temp.slice(0, pressed.length);
	}else{
		end = true;
	}
	
	// Se equivoco en algun punto
	if(!temp.join() === pressed.join()){
		gameOver();
	}
	
	// Termino
	if(temp.join() === pressed.join() && end){
		play("cool");
	}
}

function init(){
	generateRandomColor();
	play();
}

function play(){
	indexes[level] = generateRandomColor();
	temp = indexes;
	showColors();
	
	if(arguments.length > 0){
		level++;
		showMessage(true);
	}
}

function showColors(){
	if(temp.length > 0){
		$("c"+temp[0]).fadeIn(timeBetween)
					  .fadeOut(timeBetween, function(){
							temp.splice(0,1);
							showColors();
					  });
	}
}

function generateRandomColor(){
	// 1: rojo; 2: azul; 3: amarillo; 4:verde
	return Math.floor(Math.random() * 4) + 1;
}

function gameover(){
	showMessage(false);
	indexes = [];
	pressed = [];
	temp = [];
	level = 0;
	point = 0;
}