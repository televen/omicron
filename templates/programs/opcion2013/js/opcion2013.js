/** Televen 10.0 framework */
/**/

var candidate = new Array("hc", "nm", "rs", "jm", "nu", "mb");

$(function(){
	$("#candidate").attr("class", "");
	$("#candidate").addClass("hc");
	$("#program a").attr("href", "templates/programs/opcion2013/media/programs/hc.pdf");
	setTimeout("rotateCandidate()", 15000);
});

function rotateCandidate(){
	var item = candidate[Math.floor(Math.random()*candidate.length)];
	$("#candidate").attr("class", "");
	$("#candidate").addClass(item);
	$("#program a").attr("href", "templates/programs/opcion2013/media/programs/" + item + ".pdf");
}

$(document).ready(function(){
	JBCountDown({
		secondsColor : "#ffdc50",
		secondsGlow  : "#ffdc50",
		
		minutesColor : "#9cdb7d",
		minutesGlow  : "#9cdb7d",
		
		hoursColor   : "#378cff",
		hoursGlow    : "#378cff",
		
		daysColor    : "#ff6565",
		daysGlow     : "none",
		
		startDate   : "1365937200",
		endDate     : "1365935400",
		now         : "1365908220",
		seconds     : "51"
	});
});