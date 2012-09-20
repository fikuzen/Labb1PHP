$(function(){
	$.fn.toggleHeight = function(button, toAnimate, speed){
		$(button).on('click', function() {
			$(toAnimate).animate({
				height: 'toggle'
			}, speed);
		});
	};
	
	$('#loginShowButton').toggleHeight('#loginShowButton', '#loginForm', 300);
	$('#loginShowButton').toggleHeight('#loginShowButton', '#loginShowButton', 300);
	$('#loginShowButton').toggleHeight('#loginFormClose', '#loginForm', 300);
	$('#loginShowButton').toggleHeight('#loginFormClose', '#loginShowButton', 300);
	
})();