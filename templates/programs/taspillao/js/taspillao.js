/** Televen 10.0 framework */
var root = "http://localhost/omicron/?"
var index = 1;

$(function(){
	$(".send-opinion").live("click", function(){
		_gaq.push(['_trackEvent', 'Tas Pillao', 'Clic', 'SendOpinion']);
		sendInfo($(".opinion").val());
	});
	$(".send-joke").live("click", function(){
		_gaq.push(['_trackEvent', 'Tas Pillao', 'Clic', 'SendJoke']);
		sendJoke($(".joke-text").val(), $(this).data("id"));
	});
	$(".like").live("click", function(){
		$(this).fadeOut();
		$(".message").fadeIn();
		_gaq.push(['_trackEvent', 'Tas Pillao', 'Clic', 'LikePiropo']);
	});
	
	setTimeout("movePiropo()", 10000);
	setTimeout("moveJoke()", 10000);
	
	$(".close").live("click", function(){
		$(".message").fadeOut();
	});
});

function movePiropo(){
	console.debug(index);
	if(index < 4){
		$(".piropos").animate({"left":(index*640)*(-1) + "px"}, 500);
		index++;
	}else{
		$(".piropos").animate({"left":"0px"}, 500);
		index=1;
	}
	$(".like").fadeIn();
	$(".message").fadeOut();
	setTimeout("movePiropo()", 10000);
}

function moveJoke(){
	if(index < 4){
		$(".jokes").animate({"left":(index*640)*(-1) + "px"}, 500);
		index++;
	}else{
		$(".jokes").animate({"left":"0px"}, 500);
		index=1;
	}
	$(".message").fadeOut();
	setTimeout("moveJoke()", 10000);
}

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
				show	: "taspillao",
				action	: "addOpinion"
			},
			dataType: "json",
			error: function(xhr, txt, error){
				showMessage(4);
			},
			success: function(data, txt, xhr){
				if(data){
					showMessage(5);
				}else{
					showMessage(4)
				}
			},
			timeout: 10000,
			type: "POST",
			url: root + "ajax=true",
		});
	}
}

function sendJoke(info, id){
	showMessage(1);
	if($.trim(info) === ""){
		showMessage(2);
	}else{
		$.ajax({
			complete: function(xhr, txt){
				//showMessage(3);
			},
			data:{
				message : info+"<>"+id,
				show	: "taspillao",
				action	: "addJoke",
			},
			dataType: "json",
			error: function(xhr, txt, error){
				showMessage(4);
			},
			success: function(data, txt, xhr){
				if(data){
					showMessage(5);
				}else{
					showMessage(4)
				}
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
		case 4: html = html + "<p>Error: No pudimos guardar el mensaje en nuestra base de datos.</p>"; break;
		case 5: html = html + "<p>&iexcl;Listo! Recibimos tu opini&oacute;n</p>"; break;
	}
	$(".message").html(html).fadeIn();;
}/** Televen 10.0 framework */