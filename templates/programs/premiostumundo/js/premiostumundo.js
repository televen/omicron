/** Televen 10.0 framework */
var people 		= new Array();
var index 		= 0;
var multiplier 	= 3.333333333333333;
var ind 		= 29;
var root 		= "http://localhost/omicron/?";
var inter1 		= 0;
var inter2 		= 0;
var btns		= new Array();

$(function(){
	$('.people').each(function(i){
		people.push($(this));
	});
	setPeople();
	
	$(".votes a").live("click", function(){
		yes = 0; no = 0;
		if($(this).attr("class") == "btn btn-success"){
			yes = 1; _gaq.push(['_trackEvent', 'PremiosTuMundo', 'Blue Carpet', 'like']);
		}else{
			 no = 1; _gaq.push(['_trackEvent', 'PremiosTuMundo', 'Blue Carpet', 'dislike']);
		}
		sendVote($(this).attr("id"), yes, no);
		reset();
	});
	
	$(".nominee").live("click", function(){
		$(".nominee").hide();
		$(this)
			.css("display", "block")
			.animate({"position": "absolute","top": "75px","left": "25px","width": "315px"}, 500)
			.children("img")
			.removeClass("grayscale colorshift");
		$(".photo_title").css("top", "-20px");
		sendVoteNominee($(this).attr("id"), $(this).data("categories"));
		_gaq.push(['_trackEvent', 'PremiosTuMundo', 'Nominees', $(this).attr("id")]);
	});
	
	$('.btn').each(function(i){
		btns.push($(this));
	});
	animateButtonsIn();
	
	$(".show a").live("click", function(){
		_gaq.push(['_trackEvent', 'PremiosTuMundo', 'Show', $(this).attr("id")]);
		$('.btn').each(function(i){
			btns.push($(this));
		});
		animateButtonsOut();
		$('.salutation').css({'top' : (e.pageY - 100) + 'px', 'left' : e.pageX + 'px'}).fadeIn("slow", function(){
			setTimeout('hideSalutation()', 1500);
		});
	});
});

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

function animateHorizontalIn(item){
	$(item).animate({left:'20px'}, 300).animate({left:'-10px'}, 150).animate({left:'0px'}, 75);
}

function animateHorizontalOut(item){
	$(item).animate({left:'10px'}, 75).animate({left:'-20px'}, 150).animate({left:'700px'}, 300);
}

function sendVoteNominee(id, cat){
	$.ajax({
		complete: function(xhr, txt){
		},
		data:{
			id			: id,
			cat			: cat,
			message	  	: "sending",
			show		: "premiostumundo",
			action		: "addVoteNominee"
		},
		dataType: "json",
		error: function(xhr, txt, error){
		},
		success: function(data, txt, xhr){
			$(".percentage").html(Math.floor((data.votes/data.total)*100) + "%").fadeIn();
			console.debug(data);
		},
		timeout: 10000,
		type: "POST",
		url: root + "ajax=true",
	});
}

function sendVote(id, yes, no){
	$.ajax({
		complete: function(xhr, txt){
		},
		data:{
			yes 		: yes,
			no 			: no,
			id			: id,
			message	  	: "sending",
			show		: "premiostumundo",
			action		: "addVote"
		},
		dataType: "json",
		error: function(xhr, txt, error){
		},
		success: function(data, txt, xhr){
		},
		timeout: 10000,
		type: "POST",
		url: root + "ajax=true",
	});
}

function reset(){
	console.debug(inter1);
	window.clearTimeout(inter1);
	ind = 30;
	index++;
	$(".bar").stop().css("width", "640px");
	changePeople();
}

function setPeople(){
	arrayShuffle(people);
	$(".picture img").attr("src", "templates/programs/premiostumundo/assets/pictures/" + $(people[0]).data("url") + ".jpg");
	$(".names").html($(people[0]).data("name"));
	$(".votes a").attr("id", $(people[0]).data("id"));
	inter1 = window.setTimeout("changePeople()", 30000);
	$(".bar").animate({"width":"0%"}, 30000, function(){
		$(".bar").css("width", "100%");
	});
}

function changePeople(){
	index = (index > (people.length - 2)) ? 0 : index + 1;
	$(".picture img").attr("src", "templates/programs/premiostumundo/assets/pictures/" + $(people[index]).data("url") + ".jpg");
	$(".names").html($(people[index]).data("name"));
	$(".votes a").attr("id", $(people[index]).data("id"));
	$(".bar").animate({"width":"0"}, 30000, function(){
		$(".bar").css("width", "640px");
	});
	inter1 = window.setTimeout("changePeople()", 30000);
}

function arrayShuffle(theArray) {
 	var len = theArray.length;
	var i = len;
	 while (i--) {
	 	var p = parseInt(Math.random()*len);
		var t = theArray[i];
  		theArray[i] = theArray[p];
	  	theArray[p] = t;
 	}
};