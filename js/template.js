$.ajax({
	type: "POST",
	url: "/index.php?a=ajax&b=public&c=playbet",
	data: { 'deposit':deposit, 'selections':selections },
	success: function(msg){
		var splitted = msg.split(':');
		if (splitted[0] == "E"){
			//$('.modal#error .modalmsg').html(splitted[1]);
			//$('.modal#error').modal('show');
			addNotif("Error: "+splitted[1]);
		}
		else if (splitted[0] == "S"){
			$('.modal#success .modalmsg').html(splitted[1]);
			$('.modal#success').modal('show');
			addNotif(splitted[1]);
		}
	}
});


/*

			$.ajax({
				type: "POST",
				url: "/index.php?a=ajax&b=public&c=getmatchdata",
				data: { 'matchid':matchid },
				success: function(msg){
					var matchdata = $.parseJSON(msg);
					
					//var rate = parseFloat($(this).find('.teamrate').text());
					var rate = (team == 1) ? matchdata['gamer1_rate'] : matchdata['gamer2_rate'];
					totalrate *= rate;
					updateTotalBar(totalrate, deposit);
					//var gamer1name = $(this).parent().find('.team span.gamer1').text();
					//var gamer2name = $(this).parent().find('.team span.gamer2').text();
					var gamer1name = "";
					var gamer2name = "";
					var gamer1id = matchdata['gamer1_id'];
					var gamer2id = matchdata['gamer2_id'];

					$.ajax({
						type: "POST",
						url:"/index.php?a=ajax&b=public&c=getgamername",
						data:{ 'gamerid':gamer1id },
						success:function(result){
							gamer1name = result;

							$.ajax({
								type: "POST",
								url:"/index.php?a=ajax&b=public&c=getgamername",
								data:{ 'gamerid':gamer2id },
								success:function(result){
									gamer2name = result;

									var gamer1class = (team == 1) ? "selected" : "";
									var gamer2class = (team == 2) ? "selected" : "";
									var gameabbr = $('.tablist_tab.betlist.active').find('.tablist_title').text();



									var appendhtml = "\
									<li class='simplelist_element' id='kupon'>\
									<div class='gamename'><div class='gamenametext'>"+gameabbr+"</div></div>\
									<div class='kuponmatchgamers'>\
									<div class='kupongamer kupongamer1 "+gamer1class+"'>"+gamer1name+"</div>\
									<div class='vs'>vs</div>\
									<div class='kupongamer kupongamer2 "+gamer2class+"'>"+gamer2name+"</div>\
									</div>\
									<div class='kuponmatchrate'>\
									<div class='ratetext'>Oran </div>\
									<div class='rate'>"+rate+"</div>\
									</div>\
									<div class='kuponmatchcancel'><span class='cancel'>x</span></div>\
									<input type='hidden' id='matchid' value='"+matchid+"'>\
									<input type='hidden' id='selections' value='"+matchid+":"+team+"'>\
									<div class='clearfix'></div>\
									</li>\
									";

									$('.selectedmatches').append(appendhtml);
									saveCouponToSession();
									emptylist();

								}
							});
}
});

}
});

*/