var btns = new Array();
var competitors = new Array();
var like = 0; var dislike = 0;

$(function(){
	$('.btn').each(function(i){
		btns.push($(this));
	});
	animateButtonsIn();
	
	$('.list li').each(function(i){
		competitors.push($(this));
	});
	animateCompetitorsIn();
	
	$('.btn-purple').click(function(e){
		$('.btn-purple').each(function(i){
			btns.push($(this));
		});
		animateButtonsOut();
		$('.salutation').css({'top' : (e.pageY - 100) + 'px', 'left' : e.pageX + 'px'}).fadeIn("slow", function(){
			setTimeout('hideSalutation()', 1500);
		});
	});
	
	$('.like').click(function(e){
		like++;
		saveLikes();
	});
	
	$('.dislike').click(function(e){
		dislike++;
		saveLikes();
	});
	
	$('.dislike').click(function(e){
		dislike++;
		refreshLikes();
	});
	
	loadImg();
	//loadImages();
});

function saveLikes(){
	console.debug(parseInt($('.id_holder').html()));
	$.ajax({
		url : ajax_url,
		data: {
			"likes" 		: like,
			"dislikes" 		: dislike,
			"piece" 		: "getSexsLikes",
			"show" 			: "HayCorazon",
			"ajax" 			: true,
			"competitor_id"	: parseInt($('.id_holder').html())
		},
		dataType: "json",
		error: function(xhr, status, error){
			console.debug(xhr);
			console.debug(status);
			console.debug(error);
		},
		success: function(data, status, xhr){
			like = data.like; dislike = data.dislike;
			refreshLikes();
			like = 0; dislike = 0;
			
		},
		timeout: 10000,
		type: 'GET', 
		complete : function(xhr, status){
		
		},
	});
}

function refreshLikes(){
	total_votes = ((like + dislike) == 0) ? 1 : like + dislike;
	$('.dislike-percentage').html(Math.floor((dislike/total_votes)*100) + "%");
	$('.like-percentage').html(Math.floor((like/total_votes)*100) + "%");
}

function hideSalutation(){
	$('.salutation').fadeOut();
}

function animateButtonsIn(){
	if(btns.length > 0){
		animateHorizontalIn(btns[btns.length - 1]);
		btns.pop();
		setTimeout('animateButtonsIn()', 200);
	}
}

function animateButtonsOut(){
	if(btns.length > 0){
		animateHorizontalOut(btns[btns.length - 1]);
		btns.pop();
		setTimeout('animateButtonsOut()', 200);
	}
}

function loadImg(){
	var secuence = $(".load_wrapper img").data("secuence");
	secuence = (secuence < 100) ? "0"+secuence : secuence;
	var id = $('.load_wrapper img').data('id');

	var img = new Image();
	$(img).load(function(){
		$(this).hide();
		$('.load_wrapper').append(this);
		$(this).fadeIn("slow");
	})
    .error(function () {

    })
    .attr('src', 'templates/programs/haycorazon/assets/competitor/' + secuence + "/" + $(".load_wrapper p").data("sign") + ".jpg")
	$('.id_holder').html(id);
	
	$(".load_img").remove();
}

function animateCompetitorsIn(){
	$('.loading').removeClass('loading');
	var first = $('.load_wrapper img').data('id');
	
	if(competitors.length > 0){
		var competitor = $(competitors[competitors.length - 1]);
		var img = new Image();
		var secuence = (competitor.data("secuence") < 100) ? "0" + competitor.data("secuence") : competitor.data("secuence");
		competitor.addClass("loading");
		$(img).load(function(){
			$(this).hide();
			$('.loading').append(this);
			$(this).fadeIn("slow");
		})
		.attr('src', 'templates/programs/haycorazon/assets/competitor/' + secuence + "/" + competitor.data("sign") + ".jpg");
		
		animateHorizontalIn(competitor);
		if(first == competitor.attr("id")){
			competitor.addClass('selected');
		}
		competitors.pop();
		setTimeout('animateCompetitorsIn()', 200);
	}else{
		setTimeout('changeCompetitor()', timer);
	}
}

function changeCompetitor(){
	if(competitors.length == 0){
		$('.list li').each(function(i){
			competitors.push($(this));
		});
	}
	var competitor = $(competitors[competitors.length - 1]);
	var img = new Image();
	var secuence = (competitor.data("secuence") < 100) ? "0" + competitor.data("secuence") : competitor.data("secuence");

	$('.load_wrapper img').attr('src', 'templates/programs/haycorazon/assets/competitor/' + secuence + "/" + competitor.data("sign") + ".jpg");
	$('.id_holder').html(competitor.attr("id"));
	$('.load_wrapper p').html(competitor.data('html-safe'));
	
	$('.selected').removeClass('selected');
	
	$("#" + competitor.attr("id")).addClass('selected');
	competitors.pop();
	
	like = 0; dislike = 0;
	refreshLikes();
	setTimeout('changeCompetitor()', timer);
}

function animateHorizontalIn(item){
	$(item).animate({left:'20px'}, 300).animate({left:'-10px'}, 150).animate({left:'0px'}, 75);
}

function animateHorizontalOut(item){
	$(item).animate({left:'10px'}, 75).animate({left:'-20px'}, 150).animate({left:'700px'}, 300);
}