var playing = false;
var actual_audio = "";
var actual = 0;
$(function(){
	var html = "";
	$.each(questions, function(i, item){
		html = html + "<li class='trivia'><div class='question'>";
		html = html + "<h4>" + item.question + "</h4>";
		html = html + "<ol>";
		$.each(item.options, function(i, item){
			html = html + "<li>" + item + "</li>";
		});
		html = html + "</ol>";
		html = html + "<div class='btn-toolbar'><button class='btn btn-primary' type='button'  onclick='" + ((item.correct == 0) ? "nextTrivia()" : "badAnswer()") + "'>1</button><button class='btn btn-large btn-primary' type='button' onclick='" + ((item.correct == 1) ? "nextTrivia()" : "badAnswer()") + "'>2</button><button" + "  onclick='" + ((item.correct == 2) ? "nextTrivia()" : "badAnswer()") + "' class='btn btn-large btn-primary' type='button'>3</button></div>";
		html = html + "</div>";
		html = html + "<div class='reproductor'><img src='templates/programs/pepsimusics/assets/logo_trivia.png' width='290'/>";
		html = html + "<div class='btn_wrapper' onclick='playPause(this)'>";
		html = html + "<div class='play_btn'></div><div class='pause'><div class='pause_bar'></div><div class='pause_bar'></div></div>";
		html = html + "<audio>";
		html = html + "<source src='templates/programs/pepsimusics/media/" + item.music + ".mp3' type='audio/mpeg'>";
		html = html + "<source src='templates/programs/pepsimusics/media/" + item.music + ".ogg' type='audio/ogg'>";
		html = html + "</audio></a></div></li>";
	});
	$(".trivias ul").html(html);
	init();
});

function init(){
	$(".mensaje").html("&iexcl;Conecta tus aud&iacute;fonos!").fadeIn(500, function(){
		$(".mensaje").fadeOut(300).fadeIn(300);
		setTimeout();
	});
	actual_audio = $(".reproductor").children('audio');
	setTimeout("clearMessage()", 3000);
}

function nextTrivia(){
	console.debug(actual_audio);
	actual--;
	actual_audio.trigger('pause');
	$(".mensaje").html("&iexcl;Correcto!").fadeIn(500);
	$(".trivias").animate({"left":(actual*640) + "px"}, 1000);
	setTimeout("clearMessage()", 1500);
	_gaq.push(['_trackEvent', 'PPM13', 'Tendency-TriviaPassed', (actual*(-1))]);
}

function badAnswer(){
	$(".mensaje").html(":(").fadeIn(500);
	setTimeout("clearMessage()", 1000);
	_gaq.push(['_trackEvent', 'PPM13', 'Tendency-TriviaPassed', (actual*(-1))]);
}

function clearMessage(){
	$(".mensaje").fadeOut(500).css("left","0px");
}

function playPause(a){
	if(playing){
		$(a).children('audio').trigger('pause');
		playing = false;
		$(".pause").fadeOut(100,function(){
			$(".play_btn").fadeIn(100);
	_gaq.push(['_trackEvent', 'PPM13', 'Tendency-Play', (actual*(-1))]);
		});
	}else{
		actual_audio = $(a).children('audio');
		$(a).children('audio').trigger('play');
		playing = true;
		$(".play_btn").fadeOut(100,function(){
			$(".pause").fadeIn(100);
	_gaq.push(['_trackEvent', 'PPM13', 'Tendency-Pause', (actual*(-1))]);
		});
	}
}
var questions = {
	1: {
		"question"		: "&iquest;Qui&eacute;n es el compositor de &eacute;ste tema?",
		"options"		: ["Asier Cazalis", "Jos&eacute; Luis 'Cheo' Pacheco", "&Aacute;lvaro Paiva"],
		"correct"		: 0,
		"music"			: "a-1"
	},2: {
		"question"		: "&iquest;A qu&eacute; disco pertenece &eacute;ste tema?",
		"options"		: ["Frisbee", "Miss Mujerzuela", "Lobby"],
		"correct"		: 0,
		"music"			: "a-1"
	},3: {
		"question"		: "&iquest;La vendedora ten&iacute;a...?",
		"options"		: ["Un ojo de vidrio", "Una camisa rosa", "Unos tacones altos"],
		"correct"		: 0,
		"music"			: "b-1"
	},4: {
		"question"		: "&iquest;Desde donde se canta esta canci&oacute;n? ",
		"options"		: ["Caracas-Venezuela ", "Londres-Inglaterra", "Maracaibo-Venezuela "],
		"correct"		: 0,
		"music"			: "b-1"
	},5: {
		"question"		: "&iquest;Oscarcito te buscar&eacute; para?",
		"options"		: ["Saludarte", "Darte un Beso", "Abrazarte"],
		"correct"		: 1,
		"music"			: "c-1"
	},6: {
		"question"		: "&iquest;Te la tiras de?",
		"options"		: ["Seria y Odiosa ", "Lista, artista ", "Sexy"],
		"correct"		: 1,
		"music"			: "c-1"
	},7: {
		"question"		: "&iquest;Cu&aacute;l es el nombre del disco a donde pertenece este tema? ",
		"options"		: ["La Rosa", "Las Razones ", "La Guerra "],
		"correct"		: 2,
		"music"			: "d-1"
	},8: {
		"question"		: "&iquest;Qui&eacute;n es el compositor de este tema? ",
		"options"		: ["Gonzalo Gram ", "Al&aacute;n G&oacute;mez ", "H&eacute;ctor Motura "],
		"correct"		: 1,
		"music"			: "d-1"
	},9: {
		"question"		: "&iquest;Sab&iacute;as que Ram&oacute;n Castro est&aacute; a cargo de la guitarra y teclado en la banda Jack Budy? ",
		"options"		: ["No lo sab&iacute;a ", "S&iacute;, Buen&iacute;simo ", "Gracias por la informaci&oacute;n"],
		"correct"		: 0,
		"music"			: "f-1"
	},10: {
		"question"		: "&iquest;D&oacute;nde nace la banda Jack Bundy? ",
		"options"		: ["Caracas", "Maracay", "Valencia"],
		"correct"		: 0,
		"music"			: "f-1"
	},11: {
		"question"		: "&iquest;Gustavo y Rein son? ",
		"options"		: ["Los ni&ntilde;os del merengue ", "Los Nenes ", "Los Traviesos"],
		"correct"		: 1,
		"music"			: "e-1"
	},12: {
		"question"		: "&iquest;No hay dinero en el mundo que?",
		"options"		: ["Alcance para enamorarte ", "Alcance para enamorarte ", "Compre un sentimiento real "],
		"correct"		: 2,
		"music"			: "e-1"
	},13: {
		"question"		: "&iquest;Con una tinta Indeleble?",
		"options"		: ["Yo jugu&eacute;", "Fue que yo me manche ", "Quedara  nuestra  piel "],
		"correct"		: 0,
		"music"			: "g-1"
	},14: {
		"question"		: "&iquest;Cu&aacute;l es el nombre del disco donde puedes disfrutar de esta canci&oacute;n? ",
		"options"		: ["Un segundo ", "Indeleble", "Malos Tiempos "],
		"correct"		: 1,
		"music"			: "g-1"
	},15: {
		"question"		: "&iquest;Qui&eacute;n es el compositor de este tema? ",
		"options"		: ["&Aacute;lvaro Paiva ", "Klaver Camero ", "Gonzalo Gran "],
		"correct"		: 1,
		"music"			: "h-1"
	},16: {
		"question"		: "&iquest;Cu&aacute;l es el nombre de este tema?",
		"options"		: ["Let me go ", "Sometimes", "Driving"],
		"correct"		: 0,
		"music"			: "i-1"
	},17: {
		"question"		: "&iquest;Cu&aacute;l es el nombre de los vocalistas de Expos&eacute;?",
		"options"		: ["Ann Curles, Jeanette Jurado, Giorgia Bruno", "Jam Stuart, Bruno Mars ", "Sandra Casa&ntilde;as "],
		"correct"		: 0,
		"music"			: "i-1"
	},18: {
		"question"		: "&iquest;El Reggae music esta sonando...?",
		"options"		: ["En la calle ", "En la party ", "En el parque "],
		"correct"		: 0,
		"music"			: "j-1"
	},19: {
		"question"		: "&iquest;En qu&eacute; a&ntilde;o se formo Nou Vin Lakay? ",
		"options"		: ["2000", "2005", "2003"],
		"correct"		: 1,
		"music"			: "j-1"
	},20: {
		"question"		: "&iexcl;Canta con nosotros! 'Yo sufro, yo lloro...'",
		"options"		: ["Yo sue&ntilde;o contigo ", "Yo me pongo triste ", "Yo no soy de nadie "],
		"correct"		: 0,
		"music"			: "k-1"
	},21: {
		"question"		: "&iquest;Cu&aacute;l es el nombre real de Oscarcito?",
		"options"		: ["&&Oacute;acute;scar Jim&eacute;nez", "&&Oacute;acute;scar Hern&aacute;ndez ", "&&Oacute;acute;scar M&eacute;ndez "],
		"correct"		: 1,
		"music"			: "k-1"
	},22: {
		"question"		: "&iquest;Cu&aacute;l es el nombre de este disco?",
		"options"		: ["Fuego Azul ", "El mundo ", "Licencia para ser libre "],
		"correct"		: 2,
		"music"			: "l-1"
	},23: {
		"question"		: "&iexcl;Canta con Nosotros! 'El viernes en la noche, a la disco...'",
		"options"		: ["El Domingo, a dormir ", "El S&aacute;bado a cenar ", "El lunes a trabajar "],
		"correct"		: 1,
		"music"			: "l-1"
	},24: {
		"question"		: "&iquest;Cu&aacute;l es el nombre de esta canci&oacute;n?",
		"options"		: ["Fuego Azul ", "Granjuanco", "Gatos Oliva "],
		"correct"		: 2,
		"music"			: "m-1"
	},25: {
		"question"		: "&iquest;Cu&aacute;l es el nombre del vocalista de Rawayana?",
		"options"		: ["Beto Cuevas", "Beto Montenegro", "Mario Delgado"],
		"correct"		: 1,
		"music"			: "m-1"
	},26: {
		"question"		: "&iquest;Cu&aacute;l es el nombre de este tema?",
		"options"		: ["Something", "Some Somebody", "My Body "],
		"correct"		: 1,
		"music"			: "n-1"
	},27: {
		"question"		: "&iquest;Cu&aacute;l es el ombre de esta agrupaci&oacute;n? ",
		"options"		: ["Samsara", "Play with me ", "Words By"],
		"correct"		: 0,
		"music"			: "n-1"
	},28: {
		"question"		: "&iquest;A qu&eacute; disco pertenece este tema? ",
		"options"		: ["Hotel Miramar", "Hombre Bala", "Molly"],
		"correct"		: 0,
		"music"			: "o-1"
	},29: {
		"question"		: "&iquest;D&oacute;nde se formo la banda Tomates Fritos? ",
		"options"		: ["Caracas ", "Maracay", "Puerto la Cruz "],
		"correct"		: 2,
		"music"			: "o-1"
	},30: {
		"question"		: "&iquest;En que ciudad naci&oacute; Ulises Hadjis?",
		"options"		: ["Cuman&aacute;  ", "M&eacute;rida", "Maracaibo "],
		"correct"		: 2,
		"music"			: "p-1"
	},31: {
		"question"		: "&iquest;Cu&aacute;l es el nombre de este tema?",
		"options"		: ["Aquel lugar", "Aquella Ciudad", "Aquel pa&iacute;s"],
		"correct"		: 1,
		"music"			: "p-1"
	},32: {
		"question"		: "&iquest;A que disco pertenec&iacute;a el siguiente tema?",
		"options"		: ["Pasado, presente y futuro", "Amanecer", "&Eacute;xitos V&iacute;ctor Drija "],
		"correct"		: 1,
		"music"			: "q-1"
	},33: {
		"question"		: "-&iexcl;Canta con Nosotros! 'La noche empieza a arder, sediento de tu cuerpo en busca de...'",
		"options"		: ["Placer", "Felicidad", "Besarte"],
		"correct"		: 1,
		"music"			: "q-1"
	},34: {
		"question"		: "&iquest;Cu&aacute;l es el nombre del vocalista de esta banda?",
		"options"		: ["Mario G&oacute;mez ", "Rodrigo Gonsalves ", "Miguel Montefusa "],
		"correct"		: 1,
		"music"			: "r-1"
	},35: {
		"question"		: "&iquest;El odio te quema , la vengaza es...? ",
		"options"		: ["La rivalidad es una maldad", "Parte de tu ser", "El perd&oacute;n no llega "],
		"correct"		: 1,
		"music"			: "r-1"
	},36: {
		"question"		: "&iquest;Cu&aacute;l es el nombre del compositor de esta canci&oacute;n?",
		"options"		: ["Eddy Marcano ", "B&aacute;rbara Mu&ntilde;oz ", "Edwar Ram&iacute;rez"],
		"correct"		: 1,
		"music"			: "s-1"
	},37: {
		"question"		: "&iquest;Cu&aacute;l es el nombre de este tema?",
		"options"		: ["No te tengo ", "Ser", "Aire "],
		"correct"		: 1,
		"music"			: "s-1"
	},38: {
		"question"		: "&iquest;Qui&eacute;n interpreta este tema?",
		"options"		: ["Andrea Chac&iacute;n", "Andrea Lacoste", "Andrea Mathies"],
		"correct"		: 1,
		"music"			: "t-1"
	},39: {
		"question"		: "Andrea Lacoste usa varios idiomas ¿Cu&aacute;les son?",
		"options"		: ["Espa&ntilde;ol, Frances, Alem&aacute;n y Ingl&eacute;s", "-Espa&ntilde;ol, Ruso , Ingl&eacute;s , Alem&aacute;n ", "Espa&ntilde;ol e Ingl&eacute;s"],
		"correct"		: 0,
		"music"			: "t-1"
	},
}