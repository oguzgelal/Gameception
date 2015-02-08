$(document).ready(function(){

	// init variables
	var playedmatchids = [];
	var playedquestionids = [];
	var totalrate = 1;
	var deposit = 0;
	// load coupons saved to session
	var savedToSession = getCouponSession();
	if (savedToSession){
		$.each(savedToSession, function(index, element){
			var exploded = element.split(":");
			var type = exploded[0];
			if (type == 0){
				var matchid = exploded[1];
				var team = exploded[2];
				playedmatchids.push(matchid);
				loadCouponMatch(matchid, team);
			}
			else {
				var questionid = exploded[1];
				var answerid = exploded[2];
				playedquestionids.push(matchid);
				loadCouponQuestion(questionid, answerid);
			}
		});
	}

	// Download Coupon clicked
	$('.simplelist#kuponprint input#downloadcoupon').on('click', function(){
		html2canvas($('.kuponholder'), {
			onrendered: function(canvas) {
				var couponimg = Canvas2Image.saveAsPNG(canvas, true);
				var cs = new CanvasSaver('/index.php?a=ajax&b=public&c=saveimage', canvas, 'kupon');
			}
		});
	});

	// show no elements label if nothing added
	showLabelIfEmpty();

	$('.simplelist#kuponplay #clearcoupon').on('click', function(){
		resetList();
	});

	// play coupon button clicked
	$('.simplelist#kuponplay #playthis').on('click', function(){
		// get selections from played coupon htmls
		var selections = getSelections();
		// send played data to db
		$.ajax({
			type: "POST",
			url: "/index.php?a=ajax&b=public&c=playbet",
			async: false,
			data: { 'deposit':deposit, 'selections':selections },
			success: function(msg){
				console.log(msg);
				var splitted = msg.split(':');
				if (splitted[0] == "E"){
					//$('.modal#error .modalmsg').html(splitted[1]);
					//$('.modal#error').modal('show');
					addNotif("Error: " + splitted[1]);
				}
				else if (splitted[0] == "S"){
					//$('.modal#success .modalmsg').html(splitted[1]);
					//$('.modal#success').modal('show');
					addNotif(splitted[1]);
					// clear coupon list if saved succesfully
					resetList();
				}
			}
		});
	});



	// special bets mouseover effect
	$('.simplelist#special').on('mouseenter', '.answer', function(){
		$(this).find('.selectedmark').css('display', 'inline-block');
	});
	$('.simplelist#special').on('mouseleave', '.answer', function(){
		$(this).find('.selectedmark').css('display', 'none');
	});


	// default bet click
	$('.simplelist#special').on('click', '.answer.defaultanswer', function(){
		var matchid = $(this).parent().find('input#matchid').val();
		var team = $(this).parent().find('input#selection').val();
		if ($.inArray(matchid, playedmatchids) == -1) {
			// insert into played matches
			playedmatchids.push(matchid);
			// load match into coupon
			loadCouponMatch(matchid, team);
			// update session coupon
			saveCouponToSession();
		}
		else{
			//$('.modal#error .modalmsg').html("You have already bet on this match.");
			//$('.modal#error').modal('show');
			addNotif("Bu maça önceden oynadınız.");
		}
	});

	// special bets click
	$('.simplelist#special').on('click', '.answer.specialanswer', function(){
		var matchid = $(this).parent().find('input#matchid').val();
		var questionid = $(this).parent().find('input#questionid').val();
		var answerid = $(this).parent().find('input#answerid').val();
		if ($.inArray(questionid, playedquestionids) == -1) {
			// insert into played questions
			playedquestionids.push(questionid);
			// load question into coupon
			loadCouponQuestion(questionid, answerid);
			// update session coupon
			saveCouponToSession();
		}
		else{
			//$('.modal#error .modalmsg').html("You have already bet on this.");
			//$('.modal#error').modal('show');
			addNotif("Bu maça önceden oynadınız.");
		}
	});


	// text entered in deposit textbox
	$('.simplelist#kuponplay input.totalbar_money_input').on('input', function(){
		// get entered text
		var newval = $(this).val();
		// update global deposit variable
		if ($.isNumeric(newval)){ deposit = newval; }
		else if (newval == ""){ deposit = 0; }
		// update total bar 
		updateTotalBar(totalrate, deposit);
	});

	// clicked on match
	$('.tablist_content').on('click', '.betlistdata .team', function(){
		// find selected team
		var team = 0;
		if ($(this).hasClass('team1')){	team = 1; }
		else{ team = 2;	}
		// find match id
		var matchid = $(this).parent().find('#matchid').val();
		// check if played before
		if ($.inArray(matchid, playedmatchids) == -1) {
			// insert into played matches
			playedmatchids.push(matchid);
			// load match into coupon
			loadCouponMatch(matchid, team);
			// update session coupon
			saveCouponToSession();
		}
		else{
			//$('.modal#error .modalmsg').html("You have already bet on this match.");
			//$('.modal#error').modal('show');
			addNotif("Bu maça önceden oynadınız.");
		}
	});

	// remove match from coupon clicked 
	$('.simplelist#kuponplay .simplelist_ul').on('click', '.simplelist_element#kupon .cancel', function(e){
		e.stopImmediatePropagation();
		var container = $(this).parent().parent();
		var type = container.find('#type').val();
		if (type == 0){	
			var id = container.find('#matchid').val();
			var indexof = playedmatchids.indexOf(id);
			if (indexof != -1){ playedmatchids.splice(indexof, 1); }
		}
		else if (type == 1){ 
			var id = container.find('#questionid').val();
			var indexof = playedquestionids.indexOf(id);
			if (indexof != -1){ playedquestionids.splice(indexof, 1); }
			
		}
		var rate = parseFloat(container.find('.rate').html());
		totalrate /= rate;
		updateTotalBar(totalrate, deposit);
		container.slideUp('fast', function(){
			$(this).remove();
			saveCouponToSession();
			showLabelIfEmpty();
		});
	});

	function loadCouponQuestion(questionid, answerid) {
		// row type : 0-match 1-question
		var type = 1;
		// retrieve data
		var question = retrieveQuestion(questionid);
		var answer = retrieveAnswer(answerid);
		var answerrate = retrieveAnswerRate(answerid);
		var matchid = retrieveMatdcIDFromQuestion(questionid);
		// update current data
		totalrate *= answerrate;
		updateTotalBar(totalrate, deposit);
		// print element
		var appendhtml = "\
		<li class='simplelist_element' id='kupon'>\
		<div class='gamename'><div class='questionicon'> <span class='glyphicon glyphicon-star'></span> </div></div>\
		<div class='kuponquestions'>\
		<div class='questionText'>"+question+"</div>\
		<div class='questionAnswer'>"+answer+"</div>\
		<div class='clearfix'></div>\
		</div>\
		<div class='kuponmatchrate'>\
		<div class='ratetext'>Oran </div>\
		<div class='rate'>"+answerrate+"</div>\
		</div>\
		<div class='kuponmatchcancel'><span class='cancel'>x</span></div>\
		<input type='hidden' id='questionid' value='"+questionid+"'>\
		<input type='hidden' id='answerid' value='"+answerid+"'>\
		<input type='hidden' id='matchid' value='"+matchid+"'>\
		<input type='hidden' id='type' value='"+type+"'>\
		<input type='hidden' id='selections' value='"+type+":"+questionid+":"+answerid+"'>\
		<div class='clearfix'></div>\
		</li>\
		";
		// if user bet on this match, find it on the coupon list and append after that
		// if user didnt bet on the match, append to the end of the list
		var appent = false;
		$('.simplelist#kuponplay .selectedmatches .simplelist_element#kupon').each(function(){
			if ($(this).find('input#type').val()=="0" && $(this).find('input#matchid').val()==matchid){
				$(this).after(appendhtml);
				appent = true;
			}
		});
		if (!appent){
			$('.simplelist#kuponplay .selectedmatches').append(appendhtml);
		}
		showLabelIfEmpty();
	}

	function loadCouponMatch(matchid, team) {
		var charlimit = 10;
		// row type : 0-match 1-question
		var type = 0;
		// retrieve data
		var matchdata = retrieveMatchData(matchid);
		var gamer1name = trimChars(retrieveGamerName(matchdata['gamer1_id']),charlimit);
		var gamer2name = trimChars(retrieveGamerName(matchdata['gamer2_id']),charlimit);
		var gameabbr = retrieveGameAbbr(matchdata['game_id']);
		// calculate data
		var rate = (team == 1) ? matchdata['gamer1_rate'] : matchdata['gamer2_rate'];
		var gamer1class = (team == 1) ? "selected" : "";
		var gamer2class = (team == 2) ? "selected" : "";
		// update current data
		totalrate *= rate;
		updateTotalBar(totalrate, deposit);
		// print element
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
		<input type='hidden' id='type' value='"+type+"'>\
		<input type='hidden' id='selections' value='"+type+":"+matchid+":"+team+"'>\
		<div class='clearfix'></div>\
		</li>\
		";
		$('.simplelist#kuponplay .selectedmatches').append(appendhtml);
		showLabelIfEmpty();
	}

	function resetList(){
		totalrate = 1;
		deposit = 0;
		updateTotalBar(totalrate, deposit);
		playedmatchids = [];
		$('.simplelist#kuponplay .selectedmatches').html("");
		$('.simplelist#kuponplay input.totalbar_money_input').val("");
		showLabelIfEmpty();
		updateUserMoney();
		unsetCouponSession();
	}

});

function showLabelIfEmpty(){
	if ($('.simplelist#kuponplay .selectedmatches li').length == 0){
		$('.simplelist#kuponplay .selectedmatches').append("<div class='noelement' style='display: none;'> Maç eklenmedi. </div>");
		$('.simplelist#kuponplay .selectedmatches').find('.noelement').slideDown('fast');
	}
	else {
		$('.simplelist#kuponplay .selectedmatches').find('.noelement').remove();
	}
}

function retrieveMatchData(matchid){
	var matchdata = [];
	$.ajax({
		type: "POST",
		url: "/index.php?a=ajax&b=public&c=getmatchdata",
		async: false,
		data: { 'matchid':matchid },
		success: function(msg){
			matchdata = $.parseJSON(msg);
		}
	});
	return matchdata;
}

function retrieveGamerName(gamerid){
	var gamername = "";
	$.ajax({
		type: "POST",
		url:"/index.php?a=ajax&b=public&c=getgamername",
		async: false,
		data:{ 'gamerid':gamerid },
		success:function(result){ gamername = result; }
	});
	return gamername;
}

function retrieveGameAbbr(gameid){
	var gamerabbr = "";
	$.ajax({
		type: "POST",
		url:"/index.php?a=ajax&b=public&c=getgameabbr",
		async: false,
		data:{ 'gameid':gameid },
		success:function(result){ gamerabbr = result; }
	});
	return gamerabbr;
}

function retrieveQuestion(questionid){
	var question = "";
	$.ajax({
		type: "POST",
		url:"/index.php?a=ajax&b=public&c=getquestion",
		async: false,
		data:{ 'questionid':questionid },
		success:function(result){ question = result; }
	});
	return question;
}

function retrieveAnswer(answerid){
	var answer = "";
	$.ajax({
		type: "POST",
		url:"/index.php?a=ajax&b=public&c=getanswer",
		async: false,
		data:{ 'answerid':answerid },
		success:function(result){ answer = result; }
	});
	return answer;
}

function retrieveAnswerRate(answerid){
	var answerrate = 0;
	$.ajax({
		type: "POST",
		url:"/index.php?a=ajax&b=public&c=getanswerrate",
		async: false,
		data:{ 'answerid':answerid },
		success:function(result){ answerrate = result; }
	});
	return answerrate;
}

function retrieveMatdcIDFromQuestion(questionid){
	var matchid = "";
	$.ajax({
		type: "POST",
		url:"/index.php?a=ajax&b=public&c=getmatchidfromquestion",
		async: false,
		data:{ 'questionid':questionid },
		success:function(result){ matchid = result; }
	});
	return matchid;
}

function trimChars(str, limit){
	var res = str;
	if (str.length >= limit){
		res = str.substring(0,(limit-3))+"...";
	}
	return res;
}

function updateTotalBar(total, deposit){
	var earnings = total * deposit;
	$('.simplelist#kuponplay .totalbar').find('span.ratetxt').html(total.toFixed(2));
	$('.simplelist#kuponplay .totalbar').find('span.earningtxt').html(earnings.toFixed(2));
}

function updateUserMoney(){
	$.ajax({
		type: "POST",
		url: "/index.php?a=ajax&b=public&c=getmoney",
		success: function(msg){
			var money = parseInt(msg);
			$('#usermoney').html(money.toFixed(0));
		}
	});
}

function getSelections(){
	var selections = [];
	$('.simplelist#kuponplay .simplelist_element#kupon input#selections').each(function(){
		selections.push($(this).val());
	});
	return selections;
}

function saveCouponToSession(){
	var selections = getSelections();
	$.ajax({
		type: "POST",
		url: "/index.php?a=ajax&b=public&c=savecouponsession",
		data: { 'coupon':selections }
	});
}
function unsetCouponSession(){
	$.ajax({ url: "/index.php?a=ajax&b=public&c=unsetcouponsession"	});
}
function getCouponSession(){
	var couponsession = [];
	$.ajax({
		type: "POST",
		url: "/index.php?a=ajax&b=public&c=getcouponsession",
		async: false,
		success: function(msg){
			couponsession = $.parseJSON(msg);
		}
	});
	return couponsession;
}