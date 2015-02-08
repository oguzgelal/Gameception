$(document).ready(function(){

	// hit enter to submit
	$("input#username").keypress(function(event) {
		console.log("*");
		if (event.which == 13) {
			event.preventDefault();
			loginButtonClicked();
		}
	});
	$("input#password").keypress(function(event) {
		console.log("*");
		if (event.which == 13) {
			event.preventDefault();
			loginButtonClicked();
		}
	});

	$('#kayitolbutton').on('click', function(){
		console.log("*");
		window.location.href = '/index.php?a=register';
	});

	$('#loginbutton').on('click', function(){
		loginButtonClicked();
	});

	$('#logoutbutton').on('click', function(){
		$.ajax({
			url: "/index.php?a=ajax&b=public&c=logout",
			success: function(msg){
				var splitted = msg.split(':');
				if (splitted[0] == "E"){
					//$('.modal#error .modalmsg').html(splitted[1]);
					//$('.modal#error').modal('show');
					addNotif("Error: "+splitted[1]);
				}
				else if (splitted[0] == "S"){ window.location.reload(); }
			}
		});
	});



});

function loginButtonClicked(){
	var username = $('.logindata#username').val();
	var password = $('.logindata#password').val();
	var rememberme_dat = $('.logindata#rememberme').attr('checked');

	var rememberme = "false";
	if (rememberme_dat){ rememberme = "true"; }

	$.ajax({
		type: "POST",
		url: "/index.php?a=ajax&b=public&c=login",
		data: { 'username':username, 'password':password, 'rememberme':rememberme },
		success: function(msg){

			var splitted = msg.split(':');
			if (splitted[0] == "E"){
					//$('.modal#error .modalmsg').html(splitted[1]);
					//$('.modal#error').modal('show');
					addNotif("Error: "+splitted[1]);
				}
				else if (splitted[0] == "S"){ window.location.reload(); }
			}
		});
}