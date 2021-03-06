/** Televen 10.0 framework */
var photos = new Array();
var KEYCODE_ESC = 27;

$(function(){	
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
	});
	
	$('.close-photo').click(function(){
		animatePhotoWrapperOut();
	});
	
	$('.like-photo').click(function(){
		console.debug($('.photo img').data('id'));
		_gaq.push(['_trackEvent', 'Chataing', 'Like', $('.photo img').data('id')]);
	});
	
	$('.dislike-photo').click(function(){
		_gaq.push(['_trackEvent', 'Chataing', 'DisLike', $('.photo img').data('id')]);
	});
	
	$(".nano").nanoScroller();
	
	$(window).keyup(function(e){
		if(e.which == KEYCODE_ESC){
			animatePhotoWrapperOut();
		}
	});
});

function animatePhotoWrapperIn(img){
	$('.photo-holder').css({'top':'0px'});
	$('.photo-background').animate({'top':'0px'}, 300).animate({'top':'120px'}, 150).animate({'top':'0px'}, 150).animate({'top':'60px'}, 150).animate({'top':'0px'}, 150,function(){
		$('.photo-wrapper').animate({'top':'88px'}, 300).animate({'top':'120px'}, 150).animate({'top':'88px'}, 150).animate({'top':'60px'}, 150).animate({'top':'88px'}, 150, function(){
			$('.photo img').attr('src', 'templates/programs/chataing/assets/' + img).fadeIn("slow").data('id', img);
			_gaq.push(['_trackEvent', 'Chataing', 'OpenPicture', img]);
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
		.attr('src', 'templates/programs/chataing/assets/' + photo.data('img'));
		setTimeout('animatePhotosIn()', 200);
	}
}