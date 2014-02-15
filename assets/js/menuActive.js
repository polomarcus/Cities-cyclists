$(document).ready(function(){
	active = $('#active').val();
	//console.log("active " +  '#' + active);
	
	//remove all the active from the main menu
	$('#conseil').removeClass('active');
	$('#tourisme').removeClass('active');
	$('#planifier').removeClass('active');
	$('#virtuelle').removeClass('active');
	$('#index').removeClass('active');
	
	name = '#' + active;
	//console.log(name);
	//add a new active in the main menu
	$(name).addClass("active");
});