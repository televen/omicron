$(function(){ // when DOM ready
	$('#image').reel({
		indicator:   5, // For no indicator just remove this line
		stitched:    5224,
		steps:       100,
		step:        23,
		speed:       -0.005,
		clickfree:   true,
		wheelable:   false
	});
});