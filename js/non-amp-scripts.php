<script>
(function($){$(document).ready(function(){
	
	$('#main-nav').on('click tap', function(){
		$(this).trigger("mouseover");
	});
	
	/*
	AMP-CAROUSEL	
	*/
	
	var $carousel = $('amp-carousel.slider[type=slides]');
	
	var carousel_width = $carousel.attr('width'),
		carousel_height = $carousel.attr('height'),
		carousel_ratio = carousel_height / carousel_width;
		
		carousel_width = $(window).width();
		carousel_height = carousel_width * carousel_ratio;
		
	$carousel.width(carousel_width);
	$carousel.height(carousel_height);
	
	$(window).on('resize',function(){
		
		carousel_width = $(window).width();
		carousel_height = carousel_width * carousel_ratio;
		
		$carousel.width(carousel_width);
		$carousel.height(carousel_height);
	});
	
	if($carousel.find('.slide').length > 1) {
		$carousel.find('.slide:first-child').show().siblings('.slide').hide();
		$carousel.append('<div class="amp-carousel-button amp-carousel-button-prev" role="button" aria-label="previous"></div><div class="amp-carousel-button amp-carousel-button-next" role="button" aria-label="next"></div>');
		
		$('.amp-carousel-button-prev').hide();
		$carousel.on('click','.amp-carousel-button-next', function(){
			$carousel.find('.slide:visible').hide(500).next().show(500, function(){
				if($carousel.find('.slide:visible').index() == ($carousel.find('.slide').length) - 1) {
					$('.amp-carousel-button-next').hide();
					$('.amp-carousel-button-prev').show();
				}
			});
		});
		
		$carousel.on('click','.amp-carousel-button-prev', function(){
			$carousel.find('.slide:visible').hide(500).prev().show(500, function(){
				if($carousel.find('.slide:visible').index() == 0) {
					$('.amp-carousel-button-next').show();
					$('.amp-carousel-button-prev').hide();
				}
			});
		});
		 
	}
	
	

	function trackingLink($this, type){
		var href = $this.html();
		return "ga('send', 'event', 'Contact Links', '"+type+"','"+href+"')";
	}

	
	$('[href*=tel]').attr("onclick", function(){
	return trackingLink($(this), "user-phoned");
	}).addClass('number');
	
	$('[href*=mailto]').attr("onclick", function(){
	return trackingLink($(this), "user-emailed");
	}).addClass('email');
	
	$('[href*=fax]').attr("onclick", function(){
	return trackingLink($(this), "user-faxed");
	}).addClass('fax');


	
});})(jQuery);	
	
</script>