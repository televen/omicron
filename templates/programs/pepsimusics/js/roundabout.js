function initRound(){
	$('ul').roundabout();
}

var contestants = {
	1: {
		"title"			: "Artista cl&aacute;sico",
		"nominees"		: ["Alexis C&aacute;rdenas","Edicson Ruiz","Pacho Flores","Aquiles Machado","Gabriela Montero"],
		"pictures"		: ["a01", "e01", "p01", "a02", "g01"],
		"twitter"		: ["@alexiscardenas3", "@ruizedicson", "@pacho_flores", "@aquilesmachado", "@monterogabriela"]
	}, 2 : {
		"title"			: "Artista electr&oacute;nico del a&ntilde;o",
		"nominees"		: ["Electrotribal","Los humanoides","Trujillo","Famasloop","Masseratti 2LTS"],
		"pictures"		: ["e02", "l01", "t01", "f01", "m01"],
		"twitter"		: ["@electrotribal", "@loshumanoides", "@djtrujillo", "@famasloop", "@masseratti2lts"]
	}, 3: {
		"title"			: "Canci&oacute;n electr&oacute;nico del a&ntilde;o",
		"nominees"		: ["Electrotribal","Masseratti","Trujillo","Famasloop","Samsara"],
		"pictures"		: ["e02", "m01", "t01", "f01", "s01"],
		"twitter"		: ["@electrotribal", "@loshumanoides", "@djtrujillo", "@famasloop", "@akasamsara"]
	}, 4: {
		"title"			: "Disco electr&oacute;nico del a&ntilde;o",
		"nominees"		: ["Famasloop","Masseratti 2LTS","Sunsplash","La Clem de la Clem","Samsara"],
		"pictures"		: ["f01", "m01", "-", "-", "s01"],
		"twitter"		: ["@famasloop", "@masseratti2lts", "@sunsplashmusic", "@LaClemdeLaClem", "@akasamsara"]
	}, 5: {
		"title"			: "Video electr&oacute;nico del a&ntilde;o",
		"nominees"		: ["Electrotribal","Los humanoides", "Trujillo","Famasloop","Masseratti 2LTS"],
		"pictures"		: ["e02", "l01", "t01", "f01", "m01"],
		"twitter"		: ["@electrotribal", "@loshumanoides", "@djtrujillo", "@famasloop", "@masseratti2lts"]
	}, 6: {
		"title"			: "Artista gaita del a&ntilde;o",
		"nominees"		: ["Cardenales del &eacute;xito","Maracaibo 15","Rinc&oacute;n Morales","Gran Coquivacoa","Melody Gaita"],
		"pictures"		: ["-", "-", "-", "-", "-"],
		"twitter"		: ["@", "@", "@", "@", "@melodygaita"]
	}, 7: {
		"title"			: "Disco gaita del a&ntilde;o",
		"nominees"		: ["Cardenales del &eacute;xito","Melody gaita","Rinc&oacute;n Morales","Maracaibo 15","Pajarito Vola Show"],
		"pictures"		: ["-", "-", "-", "-", "-"],
		"twitter"		: ["@", "@melodygaita", "@", "@", "@"]
	}, 8: {
		"title"			: "Artista Hip Hop del a&ntilde;o",
		"nominees"		: ["Apache","Cuarto Poder","Nigga","Canserbero","Mcklopedia"],
		"pictures"		: ["a03", "c01", "n01", "c02", "m02"],
		"twitter"		: ["@apachelasminas", "@4topoder", "@elniggasibilino", "@elcanserbero", "@macklopedia"]
	}, 9: {
		"title"			: "Canci&oacute;n Hip Hop del a&ntilde;o",
		"nominees"		: ["Apache","El Prieto","Mcklopedia","Cuarto Poder","La corte"],
		"pictures"		: ["a03", "e03", "m02", "c01", "c03"],
		"twitter"		: ["@apachelasminas", "@elprietoflowmaf", "@macklopedia", "@4topoder", "@lacorte_hiphop"]
	}, 10: {
		"title"			: "Disco Hip Hop del a&ntilde;o",
		"nominees"		: ["Apache","Cuarto poder","Reke","Canserbero","Nigga"],
		"pictures"		: ["a03", "c01", "r01", "c02", "n01"],
		"twitter"		: ["@apachelasminas", "@4topoder", "@rekeson", "@elcanserbero", "@elniggasibilino"]
	}, 11: {
		"title"			: "Video Hip Hop del a&ntilde;o",
		"nominees"		: ["El prieto","Mcklopedia", "Reke","La causa","NK Profeta"],
		"pictures"		: ["e03", "m02", "r01", "c04", "n02"],
		"twitter"		: ["@elprietoflowmaf","@macklopedia","@rekeson","@lacausaLCD", "@NkProfeta"]
	}, 12: {
		"title"			: "Artista m&uacute;sica tradicional instrumental del a&ntilde;o",
		"nominees"		: ["Aquiles B&aacute;ez","Hu&aacute;scar Barradas","Los Crema Para&iacute;so","C4Tr&iacute;o","Jorge Glem"],
		"pictures"		: ["a04", "h01", "c05", "c06", "j01"],
		"twitter"		: ["@aquiles_baez","@HuascarBarrada","@loscremaparaiso","@C4trio", "@jorgeglem"]
	}, 13: {
		"title"			: "Compositor m&uacute;sica tradicional instrumental del a&ntilde;o",
		"nominees"		: ["&Aacute;lvaro Paiva","H&eacute;ctor Molina", "Los sinverg&uuml;enzas","Gonzalo Grau","Jos&eacute; Luis 'Cheo' Pardo"],
		"pictures"		: ["a05", "h02", "s02", "g02", "-"],
		"twitter"		: ["@apaivab","@hectorcuatrista","@lossinverguenza","@gonzograu", "@"]
	}, 14: {
		"title"			: "Disco m&uacute;sica tradicional instrumental del a&ntilde;o",
		"nominees"		: ["Carlos Urbaneja Silva","Edwar Ram&iacute;rez","Miguel Siso","Eddy Marcano","Los sinverg&uuml;enzas"],
		"pictures"		: ["-", "-", "-", "-", "s02"],
		"twitter"		: ["@","@edward4ramirez","@miguelsiso4","@", "@lossinverguenza"]
	}, 15: {
		"title"			: "Artista m&uacute;sica tradicional instrumental del a&ntilde;o",
		"nominees"		: ["C4 tr&iacute;o y Gualberto Ibarreto","La parranda de Liliam","Tober&iacute;as","Francisco Pacheco","Mar&iacute;a Teresa Chac&iacute;n"],
		"pictures"		: ["c06", "p02", "t02", "f02", "m03"],
		"twitter"		: ["@C4trio","@laparranda","@toberiasbanda","@", "@mteresachacin"]
	}, 16: {
		"title"			: "Canci&oacute;n m&uacute;sica trandicional vocal del a&ntilde;o",
		"nominees"		: ["Alberto Vergara con Diego Alvarez [Yo soy]","Carlos Teran [Si nos gana el tiempo]","La parranda de Liliam [Ya lleg&oacute; diciembre]","C4 tr&iacute;o  y Gualberto Ibarreto [La carta]","Jos&eacute; Alejandro Delgado [Rueda libre]"],
		"pictures"		: ["-", "-", "p02", "c06", "-"],
		"twitter"		: ["@maestrovergara","@carlosteran","@laparranda","@C4trio", "@"]
	}, 17: {
		"title"			: "Disco m&uacute;sica tradicional vocal del a&ntilde;o",
		"nominees"		: ["Alberto Vergara [Escultura sonora]","Ensamble F&eacute;nix [Guayoyo]","Mar&iacute;a Teresa Chac&iacute;n [Canta cuentos]","C4 tr&iacute;o y Gualberto Ibarreto [Gualberto+C4]","Jos&eacute; Alejandro Delgado [Rueda libre]"],
		"pictures"		: ["-", "-", "m03", "c06", "-"],
		"twitter"		: ["@maestrovergara","@EnsambleFenix","@mteresachacin","@C4trio", "@"]
	}, 18: {
		"title"			: "Artista pop del a&ntilde;o",
		"nominees"		: ["Judy Buend&iacute;a","Ulises Hadjis","Victor Mu&ntilde;oz","Lasso","Victor Drija"],
		"pictures"		: ["-", "-","v01", "l02", "v02"],
		"twitter"		: ["@JudyBuendia","@uliseshadjis","@VictorMuñozVzla","@lassoMusica", "@Victordrija"]
	}, 19: {
		"title"			: "Canci&oacute;n pop del a&ntilde;o",
		"nominees"		: ["Judy Buend&iacute;a [Me retiro elegantemente]","San Luis [Mi coraz&oacute;n]","Victor Mu&ntilde;oz [Mi princesa]","Lasso[Te veo]","Ulises Hadjis [Donde va]"],
		"pictures"		: ["-", "-", "v01", "l02", "-"],
		"twitter"		: ["@JudyBuendia","@SanLuisOficial","@VictorMuñozVzla","@lassoMusica", "@uliseshadjis"]
	}, 20: {
		"title"			: "Disco pop del a&ntilde;o",
		"nominees"		: ["Alfred G&oacute;mez JR [Simple]","Manuel Diquez [Anti &iacute;dolo]","Vocal song [Vocal song les canta...]","Lasso [Sin otro sentido]","Ulises Hadjis"],
		"pictures"		: ["a06", "m04", "v03", "l02", "-"],
		"twitter"		: ["@alfredgomezjr","@manueldiquez","@vocalsong","@lassoMusica", "@uliseshadjis"]
	}, 21: {
		"title"			: "Video pop del a&ntilde;o",
		"nominees"		: ["Judy Buend&iacute;a [Me retiro elegantemente]","San Luis [Mi coraz&oacute;n]","Victor Mu&ntilde;oz [Mi princesa]","Lasso[Te veo]","Victor Drija [Amanecer]"],
		"pictures"		: ["-", "-", "v01", "l02", "v02"],
		"twitter"		: ["@JudyBuendia","@SanLuisOficial","@VictorMuñozVzla","@lassoMusica", "@Victordrija"]
	}, 22: {
		"title"			: "Artista reggae/ska del a&ntilde;o",
		"nominees"		: ["Desorden p&uacute;blico","Nou Vin Lakay","Wahala","Lebronch","Rawayana"],
		"pictures"		: ["d01", "n03", "w01", "l03", "r02"],
		"twitter"		: ["@desordenpublico","@nouvinlakay1","@grupowahala","@lebronch", "@rawayana"]
	}, 23: {
		"title"			: "Canci&oacute;n reggae/ska del a&ntilde;o",
		"nominees"		: ["Desorden p&uacute;blico [Cristo Navaja]","Lebronch [El juez]","Wahala [Tiempo]","El gran tombo [Tombo celebration ft. Onechot]","Rawayana [Falta poco]"],
		"pictures"		: ["d01", "l03", "w01", "-", "r02"],
		"twitter"		: ["@desordenpublico","@lebronch","@grupowahala","@elgrantombo", "@rawayana"]
	}, 24: {
		"title"			: "Disco reggae/ska del a&ntilde;o",
		"nominees"		: ["Bigmandrake [La fant&aacute;stica maquina m&aacute;gica]","Desorden p&uacute;blico [Desorden p&uacute;blico]","Lebronch [De chow]","Clio [Humble songs]","Jahkogba [Revelaci&oacute;n]"],
		"pictures"		: ["b01", "d01", "l03", "-", "j02"],
		"twitter"		: ["@bigmandrake","@desordenpublico","@lebronch","@","@jahkogba"]
	}, 25: {
		"title"			: "Video reggae del a&ntilde;o/ska del a&ntilde;o",
		"nominees"		: ["Bigmandrake [Yo quiero]","El forever [V&aacute;monos pa Cuyagua]","Rawayana [Falta poco]","Desorden p&uacute;blico [Cristo Navaja]","Rastamaika [Ansiedad de ti]"],
		"pictures"		: ["b01", "f03", "r02", "d01", "r03"],
		"twitter"		: ["@bigmandrake","@elforever", "@rawayana","@desordenpublico","@rastamaika"]
	}, 26: {
		"title"			: "Artista rock del a&ntilde;o",
		"nominees"		: ["Caramelos de Cianuro","Okills","Viniloversus","Los mesoneros", "Tomates fritos"],
		"pictures"		: ["c07", "o01", "v04", "l04", "t03"],
		"twitter"		: ["@cdcrock","@somosokills", "@viniloversus","@losmesoneros","@tomatesfritos"]
	}, 27: {
		"title"			: "Canci&oacute;n rock del a&ntilde;o",
		"nominees"		: ["Desorden p&uacute;blico [El poder emborracha]","Malanga [Livin in Am&eacute;rica]","Viniloversus [Ares]","Los mesoneros [Indeleble]","Tomates fritos [Eterna soledad]"],
		"pictures"		: ["d01", "m05", "v04", "l04", "t03"],
		"twitter"		: ["@desordenpublico","@Malangaoficial", "@viniloversus","@losmesoneros","@tomatesfritos"]
	}, 28: {
		"title"			: "Disco rock del a&ntilde;o",
		"nominees"		: ["Alef [Encadenado]","Luz verde [El final del mundo vol. 1]","Viniloversus [Cambi&eacute; de nombre]","Holysexybastards [Holysexybastards]","Tomates Fritos [Hotel Miramar]"],
		"pictures"		: ["a07", "l05", "v04", "h03", "t03"],
		"twitter"		: ["@alef","@luzverdebcn", "@viniloversus","@holysexyb","@tomatesfritos"]
	}, 29: {
		"title"			: "Video rock del a&ntilde;o",
		"nominees"		: ["Candy66 [Invisible]","Los mesoneros [Indeleble]","Viniloversus [Tu ambici&oacute;n]","Caramelo de Cianuro [Verano]","Tomates fritos [Eterna soledad]"],
		"pictures"		: ["c08", "l04", "v04", "c07", "t03"],
		"twitter"		: ["@candy66oficial","@losmesoneros", "@viniloversus","@cdcrock","@tomatesfritos"]
	}, 30: {
		"title"			: "Artista salsa del a&ntilde;o",
		"nominees"		: ["Alfredo Naranjo y Guajeo","Nelson Arrieta","Porfi Baloa y sus Adoslescentes","Los l&aacute;zaros de la salsa","Orquesta Adolescentes"],
		"pictures"		: ["a08", "n04", "p03", "l06", "o02"],
		"twitter"		: ["@naranjoguajeo","@nelsonarrieta7", "@porfibaloa","@loslazaros","@losadolescentes"]
	}, 31: {
		"title"			: "Canci&oacute;n salsa del a&ntilde;o",
		"nominees"		: ["Alfredo Naranjo[ Videoso City]","Nelson Arrieta [So&ntilde;&eacute;]","Servando y Florentino [Vete]","Los l&aacute;zaros de la salsa [No puedo con ella]","Oscarcito [Si t&uacute; me besas remix]"],
		"pictures"		: ["a08", "n04", "s03", "l06", "o03"],
		"twitter"		: ["@naranjoguajeo","@nelsonarrieta7", "@servando+@florentino","@loslazaros","@oscarcitomundo"]
	}, 32: {
		"title"			: "Video salsa del a&ntilde;o",
		"nominees"		: ["Antony Lebron [Amo]","Jonathan Moly [Mi ni&ntilde;a hermosa","Orquesta Adoslescentes [Si&eacute;nteme]","Icarus [Otro en mi lugar]","Nelson Arrieta [So&ntilde;&eacute;]"],
		"pictures"		: ["a09", "j03", "o02", "i01", "n04"],
		"twitter"		: ["@antonylebron33","@jonathanmoly", "@losadolescentes","@icarusoficial","@nelsonarrieta7"]
	}, 33: {
		"title"			: "Artista tropical del a&ntilde;o",
		"nominees"		: ["Chino y Nacho","Guaco","Santoral","Grupo Treo","Omar Acedo"],
		"pictures"		: ["c09", "g03", "-", "t04", "o04"],
		"twitter"		: ["@chinoynacho","@oficialguaco", "@gruposantoral"," @grupotreo","@omaracedo"]
	}, 34: {
		"title"			: "Canci&oacute;n tropical del a&ntilde;o",
		"nominees"		: ["Chino y Nacho [Reg&aacute;lame un muack]","Guaco [Vivo]","Rawayana [Gatos oliva ft. Diego 'El negro Alvarez']","Grupo Treo [Sin miedo]","Omar Acedo [Yo te quiero]"],
		"pictures"		: ["c09", "g03", "t04", "o04", "r02"],
		"twitter"		: ["@chinoynacho","@oficialguaco", "@rawayana","@grupotreo","@omaracedo"]
	}, 35: {
		"title"			: "Disco tropical del a&ntilde;o",
		"nominees"		: ["Benavides [Benavides aqu&iacute; estoy]","Guaco [Escultura]","Tecupae [Suerte]","Fania evolution [Fania evolution]","Sundin Galue [Sundin Galue]"],
		"pictures"		: ["b02", "g03", "t05", "f04", "s04"],
		"twitter"		: ["@benavidesmusic","@oficialguaco", "@tecupae"," @","@sundingalue"]
	}, 36: {
		"title"			: "Video tropical del a&ntilde;o",
		"nominees"		: ["Benavides [Mi ex]","Grupo Treo [Sin miedo]","Omar Acedo [Yo te quiero]","Chino y Nacho [Reg&aacute;lame un muack]","Guaco [Vivo]"],
		"pictures"		: ["b02", "t05", "o04", "c09", "g03"],
		"twitter"		: ["@benavidesmusic","@grupotreo", "@omaracedo","@chinoynacho","@oficialguaco"]
	}, 37: {
		"title"			: "Artista urbano del a&ntilde;o",
		"nominees"		: ["Calle ciega","Gustavo y Rein","Oscarcito","Franco","Los Cadillacs"],
		"pictures"		: ["-", "g04", "o03", "f05", "c10"],
		"twitter"		: ["@calleciegave","@gustavolosnene+@reinlosnene", "@oscarcitomundo","@francolsq","@loscadillacs_"]
	}, 38: {
		"title"			: "Canci&oacute;n urbano del a&ntilde;o",
		"nominees"		: ["Chino y Nacho [Beb&eacute; Bonita]","Los Cadillacs [Como yo]","Oscarcito [Me gusta feat El Potro &Aacute;lvarez]","Gustavo y Rein [Como te amo yo]","Mermelada Bunch[Bipolar]"],
		"pictures"		: ["c09", "c10", "o03", "g04", "m06"],
		"twitter"		: ["@chinoynacho","@loscadillacs_", "@oscarcitomundo","@gustavolosnene+@reinlosnene","@mermeladabunch"]
	}, 39: {
		"title"			: "Video urbano del a&ntilde;o",
		"nominees"		: ["Calle ciega [Am&aacute;ndote m&aacute;s]","Gustavo y Rein [Como te amo yo]","Oscarcito [Me gusta feat El Potro &Aacute;lvarez]","Chino y Nacho [Beb&eacute; Bonita]","Los Cadillacs [Como yo]"],
		"pictures"		: ["-", "g04", "o03", "c09", "c10"],
		"twitter"		: ["@calleciegave","@gustavolosnene+@reinlosnene", "@oscarcitomundo","@chinoynacho","@loscadillacs_"]
	}
}