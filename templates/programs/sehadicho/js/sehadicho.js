/** Televen 10.0 framework */
var demandant 	= "";
var defendant 	= "";
var cases		= "";
var root 		= "http://localhost/omicron/?";
var html 		= "";

$(function(){

	$('.form_wrapper').jrumble({speed:15});
	
	$(".send-form").live("click", function(e){
		e.preventDefault();
		if(validateForm($(this).data("form"), $(this).data("step"))){
			switch($(this).data("step")){
				case "two"		: demandant 	= $("#"+$(this).data("form")).serializeArray();break;
				case "three"	: defendant 	= $("#"+$(this).data("form")).serializeArray();break;
				case "four"		: cases 		= $("#"+$(this).data("form")).serializeArray();break;
			}
			moveForm($(this).data("form"), $(this).data("step"));
		}else{
			$("#" + $(this).data("form")).parent('.form_wrapper').trigger('startRumble');
			setTimeout("stopRumble('" + "#" + $(this).data("form") + "')", 250);
		}
	});
	
});

function stopRumble(form){
	$(form).parent('.form_wrapper').trigger('stopRumble');
}

function validateForm(form, step){
	valid = true;
	$('.control-group').removeClass('error');
	var input = (step === "four") ? " textarea" : " input";
	$('#' + form + input).each(function(i, item){
		if(!$(item).data("optional") && $.trim(item.value) === ""){
			valid = false;
			$(item).parent('.controls').parent('.control-group').addClass("error");
		}
	});
	return valid;
}

function moveForm(form, step){
	$("#"+form).parent(".form_wrapper").animate({"left":"150px"}, 125).animate({"left":"-1000px"}, 250, function(){
		$("#step-"+step).parent(".form_wrapper").animate({"left":"0px"}, 250);
	});
	if(step==="four"){
		sendInformation();
	}
}

function sendInformation(){
	var dem = {
		"name" 		: demandant[0].value,
		"lastname" 	: demandant[1].value,
		"email"		: demandant[2].value,
		"phone" 	: demandant[3].value
	};
	
	var def = {
		"name" 		: defendant[0].value,
		"lastname" 	: defendant[1].value,
		"email"		: defendant[2].value,
		"phone" 	: defendant[3].value
	};
	
	var cas = {
		"description": cases[0].value
	}
	
	$.ajax({
			complete: function(xhr, txt){
				//showMessage(3);
			},
			data:{
				demandant : dem,
				defendant : def,
				cases	  : cas,
				message	  : "sending",
				show	: "sehadicho",
				action	: "addCase"
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

function showMessage(id){
	switch(id){
		case 1: html = html + "<p class='title'>Enviando tu caso...</p>"; break;
		case 3: html = html + "<p class='title'>Recibida por el servidor...</p>"; break;
		case 4: html = html + "<p class='title'>Error: No pudimos guardar el caso en nuestra base de datos. Intenta de nuevo</p>"; break;
		case 5: html = html + "<p class='title'>&iexcl;Listo! Recibimos tu caso</p>"; break;
	}
	html = html + "<p><a class='btn btn-warning end-btn'>Regresar</a></p>"
	$("#step-four").html(html);
}