/** Televen 10.0 framework */

var root = "http://localhost/omicron/?"

$(function(){
	$(".send-opinion").live("click", function(){
		_gaq.push(['_trackEvent', 'El Avispero', 'Clic', 'SendOpinion']);
		sendInfo($(".opinion").val());
	});
	
	$(".close").live("click", function(){
		$(".whattohave > .message").fadeOut();
	});
});

function sendInfo(info){
	showMessage(1);
	if($.trim(info) === ""){
		showMessage(2);
	}else{
		$.ajax({
			complete: function(xhr, txt){
				//showMessage(3);
			},
			data:{
				message : info,
				show	: "elavispero",
				action	: "addOpinion"
			},
			dataType: "json",
			error: function(xhr, txt, error){
				showMessage(4);
			},
			success: function(data, txt, xhr){
				showMessage(5);
			},
			timeout: 10000,
			type: "POST",
			url: root + "ajax=true",
		});
	}
}

function showMessage(id){
	var html = '<div class="close">&times;</div>';
	switch(id){
		case 1: html = html + "<p>Enviando tu opinion...</p>"; break;
		case 2: html = html + "<p>Error: Debes escribir tu opini&oacute;n</p>"; break;
		case 3: html = html + "<p>Recibida por el servidor...</p>"; break;
		case 4: html = html + "<p>Error: No pudimos guardar en nuestra base de datos.</p>"; break;
		case 5: html = html + "<p>&iexcl;Listo! Recibimos tu opini&oacute;n</p>"; break;
	}
	$(".whattohave > .message").html(html).fadeIn();;
}