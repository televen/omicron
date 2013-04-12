var txts = new Array("",
			"Disfruta de las elocuentes entrevistas de Luis Chataing en ChataingTV",
			"&iquest;Disfrutas del humor irreverente, chispeante, exponencialmente creativo?",
			"&iquest;Eres noct&aacute;mbulo? No te preocupes &iexcl;Somos millones!",
			"&iexcl;Ahora m&aacute;s interactivo! escribe tus comentarios a @ChataingTV",
			"&iquest;Quieres conocer la noticia de un modo distinto? ChataingTV",
			"No dejes de irte a la cama bien informado y sobre todo con una sonrisa",
			"Led Varela, Jos&eacute; Rafael Guzm&aacute;n, Jean Mary",
			"Tus madrugadas ya no son las mismas con ChataingTV",
			"Noticias de la actualidad con un tono de humor te esperan a la media noche",
			"Conoce la tilde graciosa de los acontecimientos del d&iacute;a",
			"&iquest;Con cu&aacute;l invitado te has divertido m&aacute;s?",
			"&iquest;Qu&eacute; te gustar&iacute;a preguntarle a Mar&iacute;a Bol&iacute;var @mariabp2012?",
			"&iquest;Le dar&iacute;as una ayudaita a Mar&iacute;a Bol&iacute;var @mariabo2012?",
			"Mar&iacute;a Bol&iacute;var asegura ser la mejor opci&oacute;n para los venezolanos",
			"&iquest;Te gusta dar 'ayudaita'? No te pierdas la entrevista  a Maria Bol&iacute;var ",
			"Mar&iacute;a Bol&iacute;var propone aumento salarial de 45%",
			"Conoce lo que Mar&iacute;a Bol&iacute;var y Luis Chataing tienen para ti",
			"&iquest;Conoces la panader&iacute;a Mayami?",
			"Maria Bol&iacute;var estudio Modelaje en Globo Internacional",
			"&iquest;Por qu&eacute; la panader&iacute;a de Mar&iacute;a Bol&iacute;var se llama Mayami?");
			
$(function(){
	startBallons();
});

function startBallons(){
	$(".ballon").hide();
	var ballon 	= Math.floor((Math.random()*4)+1);
	var txt		= Math.floor((Math.random()*19)+1);
	console.debug(ballon);
	switch(ballon){
		case 1: ballon = ".blue-left";break;
		case 2: ballon = ".blue-right";break;
		case 3: ballon = ".red-left";break;
		case 4: ballon = ".red-right";break;
		default: ballon = ".blue-right";
	}
	console.debug(ballon);
	$(ballon+" p").html(txts[txt]);
	$(ballon).fadeIn();
	setTimeout("startBallons()", 10000);
}
