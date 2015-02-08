$(document).ready(function(){



	// main page item change button
	$('input#mainpageitemchange').click(function(){
		var changestr = $('textarea#mainpageitem').val();
		$.ajax({
			type: "POST",
			url: "/index.php?a=ajax&b=admin&c=changemainitem",
			data: { 'mainitem':changestr },
			success: function(msg){
				//location.reload();
				console.log(msg);
			}
		});
console.log(changestr);
	});

	// new reg code
	$('input#addregcode').on('click', function(){
		$.ajax({
			type: "POST",
			url: "/index.php?a=ajax&b=admin&c=newRegCode",
			success: function(msg){
				location.reload();
			}
		});
	});
	// sent reg code
	$('input.sendbutton').on('click', function(){
		var id = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/index.php?a=ajax&b=admin&c=sendRegCode",
			data: { 'codeid':id },
			success: function(msg){
				location.reload();
			}
		});
	});
	// sent reg code
	$('input.unsendbutton').on('click', function(){
		var id = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/index.php?a=ajax&b=admin&c=unsendRegCode",
			data: { 'codeid':id },
			success: function(msg){
				location.reload();
			}
		});
	});
	// block reg code
	$('input.blockbutton').on('click', function(){
		var id = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/index.php?a=ajax&b=admin&c=blockRegCode",
			data: { 'codeid':id },
			success: function(msg){
				location.reload();
			}
		});
	});
	// unblock reg code
	$('input.unblockbutton').on('click', function(){
		var id = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/index.php?a=ajax&b=admin&c=unblockRegCode",
			data: { 'codeid':id },
			success: function(msg){
				location.reload();
			}
		});
	});


	// delete match button clicked
	$('.tablist#adminmatch').on('click', '.deletematch', function(){
		var matchrow = $(this).parent();
		var matchid = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/index.php?a=ajax&b=admin&c=deletematch",
			data: { 'matchid':matchid },
			success: function(msg){
				var splitted = msg.split(':');
				if (splitted[0] == "E"){
					addNotif("Error: "+splitted[1]);
				}
				else if (splitted[0] == "S"){
					matchrow.slideUp('fast');
					addNotif(splitted[1]);
				}
			}
		});
	});

	// delete special button clicked
	$('.simplelist#adminspecials').on('click', '.deletespecial', function(){
		var questionrow = $(this).parent();
		var questionid = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/index.php?a=ajax&b=admin&c=deletespecial",
			data: { 'questionid':questionid },
			success: function(msg){
				console.log(msg);
				var splitted = msg.split(':');
				if (splitted[0] == "E"){
					addNotif("Error: "+splitted[1]);
				}
				else if (splitted[0] == "S"){
					questionrow.slideUp('fast');
					addNotif(splitted[1]);
				}
			}
		});
	});

	// popover content profile page
	$('.infopopover').on('mouseenter', function(e){ $(this).popover('show'); });
	$('.infopopover').on('mouseleave', function(e){ $(this).popover('hide'); });

	// specialbetekle page add answer button clicked
	$('.saveanswer').on('click', function(){
		var answer = $('.answer_add').val();
		var rate = $('.answer_rate_add').val();
		var questionid = $('.questionid_add').val();

		if (questionid != '-1'){
			$.ajax({
				type: "POST",
				url: "/index.php?a=ajax&b=admin&c=addanswer",
				data: { 'answer':answer, 'rate':rate, 'questionid':questionid, 'editmode':'-1' },
				success: function(msg){
					var splitted = msg.split(':');
					if (splitted[0] == "E"){
						addNotif("Error: "+splitted[1]);
					}
					else if (splitted[0] == "S"){
						var answerid = splitted[1];
						var toappend = "\
						<div class='answergroup' id='"+answerid+"'> \
						<input type='text' style='width: 50%; float:left; margin-bottom:10px;' class='form-control answer' name='answer' id='a"+answerid+"' value='"+answer+"'> \
						<input type='text' style='width: 10%; float:left; margin-left: 10px; margin-bottom:10px;' class='form-control answer_rate' name='answer_rate' id='a"+answerid+"' value='"+rate+"'> \
						<label style='margin-left: 10px;'><input type='radio' name='correctanswer_radio' id='a"+answerid+"' value='"+answerid+"'> Correct Answer </label> \
						<input type='hidden' class='questionid' id='a"+answerid+"' value='"+questionid+"'> \
						<input type='button' style='width: 8%; float:left; margin-left: 10px; margin-bottom:10px;' id='"+answerid+"' class='form-control btn btn-primary updateanswer' value='Save'> \
						<input type='button' style='width: 8%; float:left; margin-left: 10px; margin-bottom:10px;' id='"+answerid+"' class='form-control btn btn-danger deleteanswer' value='Delete'> \
						<div class='clearfix'></div> \
						</div> \
						";
						$('.added_answers').append(toappend);
						$('.answer_add').val("");
						$('.answer_rate_add').val("");
					}
				}
			});
}
});

// update question button clicked
$(document).on('click', '.updateanswer', function(){
	var answerupdated = $(this).attr('id');
	var answer = $('input.answer#a'+answerupdated).val();
	var rate = $('input.answer_rate#a'+answerupdated).val();
	var questionid = $('input.questionid#a'+answerupdated).val()
	console.log(answerupdated+" "+answer+" "+rate+" "+questionid);
	$.ajax({
		type: "POST",
		url: "/index.php?a=ajax&b=admin&c=addanswer",
		data: { 'answer':answer, 'rate':rate, 'questionid':questionid, 'editmode':answerupdated },
		success: function(msg){
			var splitted = msg.split(':');
			if (splitted[0] == "E"){
				addNotif("Error: "+splitted[1]);
			}
			else if (splitted[0] == "S"){
				addNotif('Answer updated');
			}
			else{
				addNotif(msg);
			}
		}
	});
});

// delete question button clicked
$(document).on('click', '.deleteanswer', function(){
	var answerrow = $(this).parent();
	var answerid = $(this).attr('id');
	$.ajax({
		type: "POST",
		url: "/index.php?a=ajax&b=admin&c=deleteanswer",
		data: { 'answerid':answerid },
		success: function(msg){
			var splitted = msg.split(':');
			if (splitted[0] == "E"){
				addNotif("Error: "+splitted[1]);
			}
			else if (splitted[0] == "S"){
				answerrow.slideUp('fast');
				addNotif(splitted[1]);
			}
		}
	});
});


// update team button clicked
/*
$(document).on('click', '.updateteambutton', function(){
	var teamid = $(this).attr('id');
	var data = new FormData($('.gamersform'));
	$.ajax({
		type: "POST",
		url: "/index.php?a=ajax&b=admin&c=updateteam",
		data: { 'teamid':teamid },
		success: function(msg){
			var splitted = msg.split(':');
			if (splitted[0] == "E"){
				addNotif("Error: "+splitted[1]);
			}
			else if (splitted[0] == "S"){
				answerrow.slideUp('fast');
				addNotif(splitted[1]);
			}
			console.log(msg);
		}
	});
});
*/




});