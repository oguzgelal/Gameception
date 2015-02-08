$(document).ready(function(){
	var sliderheight = $('.slidernews').height();
	var newsnum = $('.slidernewslink').length;
	var padding = 10;
	var changeSlide = true;
	// setup
	$('.slidernewslink').height(sliderheight/newsnum);
	$('.slidernewslink').css('padding', padding+'px');
	$('.slidernewsimgs').height(sliderheight);
	// load first slide
	loadSliderSlide($('.slidernewslink:first-of-type'));
	// clicked to slide
	$('.slidernewslink').click(function(){
		loadSliderSlide($(this));
	});
    // change slide every 5 secs
    setInterval(function(){
    	if (changeSlide){ loadSliderSlide(findNextSlide()); }
    }, 5000);
    // mouseover slider : stop slide show
    $('.slidernews').mouseenter(function(){ changeSlide = false; });
    $('.slidernews').mouseleave(function(){ changeSlide = true; });
});

// load slide
function loadSliderSlide(slide){
	$('.slidernewslink').removeClass('active');
	slide.addClass('active');
	var thisimg = slide.find('.hiddenimg').html();
	var thistext = slide.find('.hiddentext').html();
	$('.slidernewsimgs .slidernewsimgcont').html(thisimg);
	$('.slidernewsimgs .slidernewstextcont').html(thistext);
}

// find next slide
function findNextSlide(){
	var activeslide = $('.slidernewslink.active');
	var index = $('.slidernewslink').index(activeslide);
	var next = index+1;
	if (next >= $('.slidernewslink').length){
		next = 0;
	}
	return $($('.slidernewslink').get(next));
}