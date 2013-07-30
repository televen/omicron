/** Televen 10.0 framework */
$(function () {
	var VitrinaHour = new Date();
	if(VitrinaHour.getHours() <= 9){
		VitrinaHour = new Date(VitrinaHour.getFullYear(), VitrinaHour.getMonth(), VitrinaHour.getDate(), 10,0,0,0);
		$('.countdown_holder').countdown({
			until: VitrinaHour,
			expiryText: "&iexcl;Ya empezamos!"
		});
	}else{
		$('.countdown_holder').addClass('hasCountdown').html("<span class='countdown_row contdown_show3'>&iexcl;Nos vemos ma&ntilde;ana!</span>")
	}
	
});