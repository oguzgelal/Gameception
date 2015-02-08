$(document).ready(function(){

	// change profile image link
	$('a.changeimagelink').click(function(){
		$('input#profileimage').click();
	});
	$('input#profileimage').on('change', function(){
		$('form#profileimageform').submit();
	});

	// bio update
	$('textarea#biotextarea').blur(function(){
		$(this).fadeOut('fast');
	});
	$('a.updatebiolink').click(function(){
		$('textarea#biotextarea').fadeIn('fast');
		$('textarea#biotextarea').focus();
		$('textarea#biotextarea').select();
	});
	$('textarea#biotextarea').on('change', function(){
		$('form#biotextform').submit();
	});
	$('textarea#biotextarea').keydown(function(event) {
		if (event.keyCode == 13) {
			$('form#biotextform').submit();
			return false;
		}
	});


	//dismiss icon dismiss
	$('.dismissnotifs').on('click','.dismissicon' , function(){
		$(this).parent().fadeOut('fast');
	});

	//checkNotifs();

	// add min-width min-height property to section elements
	var pagewidth = $('.section').width();
	$('.section').css('min-width', pagewidth+'px');
	var menuwidth = $('.menucont').width();
	$('.menucont').css('min-width', menuwidth+'px');


	// popover content profile page
	$('.badgeicon').on('mouseenter', function(e){ $(this).popover('show'); });
	$('.badgeicon').on('mouseleave', function(e){ $(this).popover('hide'); });
	$('.monthlycredit').on('mouseenter', function(e){ $(this).popover('show'); });
	$('.monthlycredit').on('mouseleave', function(e){ $(this).popover('hide'); });

	// tablist load tabs
	$('.tablist').each(function(){ loadTabList($(this)); });

	// profile page short bio placement
	var shortbio_cont = $('.shortbio').height();
	var shortbio_text = $('.shortbio_text').height();
	var padding = (shortbio_cont - shortbio_text)/2;
	$('.shortbio_text').css('padding-top', padding+'px');


	/* Lists */
	function loadTabList(tablist){
		var tabscount = $(tablist).find('.tablist_tab').length;
		$(tablist).find('.tablist_tab').css('width', (100/tabscount)+"%");
		// load first tab
		loadDataStat($(tablist).find('.tablist_tab:first-of-type'));
		// clicked on tab
		$('.tablist_tab').click(function(){
			loadDataStat($(this));
		});
		// load data
		function loadDataStat(component){
			var tabscount = $(tablist).find('.tablist_tab').length;
			var parent = $(component).parent().parent();
			$(parent).find('.tablist_tab').removeClass('active');
			$(parent).find('.tablist_tab .tablist_hiddencontent').hide();
			$(component).addClass('active');
			var listdata = $(component).find('.tablist_hiddencontent').html();
			$(parent).find('.tablist_content').html(listdata);
		}
	}

});

/* Add Notification */
function addNotif(body){
	var notifhtml = "<div class='dismissnotif'><span class='dismissicon glyphicon glyphicon-remove-circle'></span>"+body+"</div>";
	$('.dismissnotifs').append(notifhtml); 
}

function checkNotifs(){
	$.ajax({
		url: "/index.php?a=ajax&b=public&c=dismissnotifchecker",
		success: function(msg){
			if (msg != ""){
				$('.dismissnotifs').append(msg);
			}
		}
	});
}

function limitText(limitField, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	}
}



