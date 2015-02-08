$(document).ready(function(){

	// register button
	$('.reg_submit').click(function(){
		var formdata = $('.reg_form').serialize();
		$.ajax({
			type: "POST",
			url: "/index.php?a=ajax&b=public&c=register",
			data: formdata,
			success: function(msg){
				console.log(msg);
				var splitted = msg.split(':');
				if (splitted[0] == "E"){
					addNotif("Error: "+splitted[1]);
				}
				else if (splitted[0] == "S"){
					//addNotif(splitted[1]);
					//window.location.href = '/index.php';
					$('.reg_form').fadeOut('fast');
					$('.registrationCompleted').fadeIn('fast');
				}
			}
		});	
	});

});