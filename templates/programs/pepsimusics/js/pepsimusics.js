/** Televen 10.0 framework */
var photos = new Array();
var KEYCODE_ESC = 27;
var counter = 0;
var tweets = [];
var counter = 0;

$(function(){	
	$('.tweet').each(function(i){
		tweets.push($(this));
	});
	animateTweetsIn();
	
	$('.photo-gallery li').each(function(i){
		photos.push($(this));
	});
	animatePhotosIn();
	
	$('.photo-gallery li').mouseenter(function(){
		$(this).children('.bigger').animate({'top':'-80px'}, 200).animate({'top':'-120px'}, 100).animate({'top':'-100px'}, 50);
		$(this).children('.smaller').animate({'top':'-70px'}, 100).animate({'top':'-50px'}, 50).animate({'top':'-60px'}, 25);
	}).mouseleave(function(){
		$(this).children('.bigger').animate({'top':'-120px'}, 200).animate({'top':'-80px'}, 100).animate({'top':'-320px'}, 50);
		$(this).children('.smaller').animate({'top':'-50px'}, 100).animate({'top':'-70px'}, 50).animate({'top':'-130px'}, 25);
	});
	
	$('.zoom-wrapper').live('click', function(){
		animatePhotoWrapperIn($(this).parent('li').data('img'));
		_gaq.push(['_trackEvent', 'PPM13', 'Gallery-OpenPhoto', $('.photo img').data('id')]);
	});
	
	$('.close-photo').click(function(){
		animatePhotoWrapperOut();
	});
	
	$('.like-photo').click(function(){
		console.debug($('.photo img').data('id'));
		_gaq.push(['_trackEvent', 'PPM13', 'Gallery-Like', $('.photo img').data('id')]);
	});
	
	$('.dislike-photo').click(function(){
		_gaq.push(['_trackEvent', 'PPM13', 'GalleryDisLike', $('.photo img').data('id')]);
	});
	
	$(window).keyup(function(e){
		if(e.which == KEYCODE_ESC){
			animatePhotoWrapperOut();
		}
	});
	
	loadCategories();
	
	$(".clasifications li").live("mouseenter", function(){
		$(this).children(".like_tendency").fadeIn();
	}).live("mouseleave", function(){
		$(this).children(".like_tendency").fadeOut();
	});
	
	$(".like_tendency").live("click", function(){
		_gaq.push(['_trackEvent', 'PPM13', 'Tendency-Like', $(this).data("id")]);
	});
	
	$(".right_arrow").live("click", function(){
		counter = (counter >= 9520) ? 9520 : counter - 100;
		$(".holder").animate({"left": counter + "px"});
		_gaq.push(['_trackEvent', 'PPM13', 'Tendency-CategoriesRight', $(this).data("id")]);
	});
	
	$(".left_arrow").live("click", function(){
		counter = (counter <= 0) ? 0 : counter + 100;
		$(".holder").animate({"left": counter + "px"});
		_gaq.push(['_trackEvent', 'PPM13', 'Tendency-CategoriesLeft', $(this).data("id")]);
	});
	
	$("nav a").live("click", function(){
		$(".wrapper_pictures").animate({"top": (parseInt($(this).data("category")) * - 480) + "px" });
		_gaq.push(['_trackEvent', 'PPM13', 'Tendency-OpenCategory', $(this).data("category")]);
	});
	
	$("#rm_container ul li img").live("click", function(e){
		$("#heartsp").css({"left" : e.pageX + "px","top" : e.pageY + "px"}).fadeIn(100);
		setTimeout("outHeart()", 100);
		_gaq.push(['_trackEvent', 'PPM13', 'Tendency-LikeDress', $(this).data("id")]);
	});
});

function animateTweetsIn(){
	if(tweets.length > 0 && counter < 100){
		tweets[tweets.length - 1].css({'top': ((tweets[tweets.length - 1].data("position-y")) * 10) + "px", 'left': ((tweets[tweets.length - 1].data("position-x") * 10) + "px"), 'background' : tweets[tweets.length - 1].data("color")}).animate({width:'10px', height:'10px'}, 300);
		tweets.pop();
		counter++;
		setTimeout('animateTweetsIn()', 200);
	}else{
		console.debug("end");
	}
}

function outHeart(){
	$("#heartsp").fadeOut(1000);
}

function animatePhotoWrapperIn(img){
	$('.photo-holder').css({'top':'0px'});
	$('.photo-background').animate({'top':'0px'}, 300).animate({'top':'120px'}, 150).animate({'top':'0px'}, 150).animate({'top':'60px'}, 150).animate({'top':'0px'}, 150,function(){
		$('.photo-wrapper').animate({'top':'88px'}, 300).animate({'top':'120px'}, 150).animate({'top':'88px'}, 150).animate({'top':'60px'}, 150).animate({'top':'88px'}, 150, function(){
			$('.photo img').attr('src', 'templates/programs/pepsimusics/assets/' + img).fadeIn("slow").data('id', img);
			_gaq.push(['_trackEvent', 'PPM13', 'OpenPicture', img]);
		});
	});
}

function animatePhotoWrapperOut(){
	$('.photo img').fadeOut("slow", function(){
		$('.photo-wrapper').animate({'top':'60px'}, 150).animate({'top':'480px'}, 150, function(){
			$('.photo-background').fadeOut("slow", function(){
				$(this).css({'top':'480px'}).show();
			});
			$('.photo-holder').css({'top':'480px'});
		});
	});
}

function animatePhotosIn(){
	if(photos.length > 0){
		var photo = photos.shift();
		var img = new Image();
		$(img).load(function(){
			$(this).hide();
			photo.append(this);
			$(this).fadeIn("slow");
			photo.append($('.zoom-holder').html());
			photo.children('.zoom-wrapper').addClass((photo.hasClass('big')) ? "bigger" : "smaller");
		})
		.attr('src', 'templates/programs/pepsimusics/assets/' + photo.data('img'));
		setTimeout('animatePhotosIn()', 200);
	}
}

function loadCategories(){
	if ($(".open_round").length > 0){
		var html = "";
		var html2 = "<nav><a class='left_arrow' href='#'>&lsaquo;</a><div class='holder'>";
		$.each(contestants, function(i, item){
			html = html + "<div class='wrapper_ul'><ul>";
			names = item.nominees;
			$.each(item.pictures, function(i, item){
				html = html + '<li data-id="'+ item +'"><a href="#"><img src="templates/programs/pepsimusics/assets/bios/' + item + '.jpg" alt="' + names[i] + '"><h4>' + names[i] + '</h4></a><span class="like_tendency" data-id="'+ item +'"><img src="templates/programs/pepsimusics/assets/like.png" width="100" /></span></li>'
				html = html + '<li data-id="'+ item +'"><a href="#"><img src="templates/programs/pepsimusics/assets/bios/' + item + '.jpg" alt="' + names[i] + '"><h4>' + names[i] + '</h4></a><span class="like_tendency" data-id="'+ item +'"><img src="templates/programs/pepsimusics/assets/like.png" width="100" /></span></li>'
			});
			html = html + "</ul></div>";
			html2 = html2 + '<a href="#" data-category="' + (i-1) + '">' + item.title + '</a>';
		});
		$('.clasifications').html("<div class='wrapper_pictures'>" + html + "</div>" + html2 + "</div><a class='right_arrow' href='#'>&rsaquo;</a></nav>");
		$('ul').roundabout();
	}
}