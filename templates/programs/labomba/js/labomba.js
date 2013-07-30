/** Televen 10.0 framework */
$(function () {
	var LaBombaHour = new Date();
	if(LaBombaHour.getHours() <= 10){
		LaBombaHour = new Date(LaBombaHour.getFullYear(), LaBombaHour.getMonth(), LaBombaHour.getDate(), 11,0,0,0);
		$('.countdown_holder').countdown({
			until: LaBombaHour,
			expiryText: "&iexcl;Ya empezamos!"
		});
	}else{
		$('.countdown_holder').addClass('hasCountdown').html("<span class='countdown_row contdown_show3'>&iexcl;Nos vemos ma&ntilde;ana!</span>")
	}
	
});