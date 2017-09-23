(function($){
	
$(document).ready(function(){	
	
	/* HII POST CAROUSEL */
		
	/* get number of items */
	var hii_post_count = $('.hii_post_carousel .hii_post_carousel_wrap > div').length;
	
	/* set up initail display of items */
	$('.hii_post_carousel #hii_post-1').addClass('hii_pc_left');
	$('.hii_post_carousel #hii_post-2').addClass('hii_pc_center');
	$('.hii_post_carousel #hii_post-3').addClass('hii_pc_right');
	
	/* set initial carousel hight */
	function hiiCarouselHight() {
		var elementHeights = $('.hii_post_carousel_wrap > div').map(function() {
			return $(this)[0].getBoundingClientRect().height;
		}).get();
	
		var maxHeight = Math.max.apply(null, elementHeights);
		
		$('.hii_post_carousel').height(maxHeight);
	}
	
	hiiCarouselHight();
	
	/* hide extra posts */
	$('.hii_post_carousel_wrap > div').addClass('hii_carousel_post');
	
	/* get count of posts */
	var post_item = 0;
	$('.hii_post_carousel .hii_post_carousel_wrap div').each(function() {
		post_item++;
		$(this).attr('data-item', post_item);
	});
	
	
	function hii_pc_get_current_posts() {
		var hii_pc_current = new Array();
		hii_pc_current['left'] = $('.hii_pc_left').data('item');
		hii_pc_current['center'] = $('.hii_pc_center').data('item');
		hii_pc_current['right'] = $('.hii_pc_right').data('item');
		
		return hii_pc_current;
	}
	
	function update_carousel(direction, new_left, new_center, new_right, post_count) {
		
		var old_left = $('.hii_pc_left').data('item');
		var old_right = $('.hii_pc_right').data('item');
		
		/* remove special classes from current posts */
		$('.hii_pc_left').removeClass('hii_pc_left');
		$('.hii_pc_center').removeClass('hii_pc_center');
		$('.hii_pc_right').removeClass('hii_pc_right');
		$('.fade-out-left').removeClass('fade-out-left');
		$('.fade-out-right').removeClass('fade-out-right');
		$('.fade-in').removeClass('fade-in');
		
		/* add classes to new posts */
		$('.hii_post_carousel .hii_post_carousel_wrap div:nth-child('+new_center+')').addClass('hii_pc_center');

		if(direction == 'next') {
			$('.hii_post_carousel .hii_post_carousel_wrap div:nth-child('+old_left+')').addClass('fade-out-left');
			
			$('.hii_post_carousel .hii_post_carousel_wrap div:nth-child('+new_left+')').addClass('hii_pc_left');
			
			/* fade in new item (fade out of old iten hadled by css) */
			$('.hii_post_carousel .hii_post_carousel_wrap div:nth-child('+new_right+')').addClass('fade-in').fadeIn(1000, function() {
				$('.hii_post_carousel .hii_post_carousel_wrap div:nth-child('+new_right+')').addClass('hii_pc_right');
				$('.fade-in').removeClass('fade-in');
			});
		}

		if(direction == 'prev') {
			$('.hii_post_carousel .hii_post_carousel_wrap div:nth-child('+old_right+')').addClass('fade-out-right');
			
			$('.hii_post_carousel .hii_post_carousel_wrap div:nth-child('+new_right+')').addClass('hii_pc_right');
			
			/* fade in new item (fade out of old iten hadled by css) */
			$('.hii_post_carousel .hii_post_carousel_wrap div:nth-child('+new_left+')').addClass('fade-in').fadeIn(1000, function() {
				$('.hii_post_carousel .hii_post_carousel_wrap div:nth-child('+new_left+')').addClass('hii_pc_left');
				$('.fade-in').removeClass('fade-in');
			});
		}
	}
	
	/* Prev is clicked */
	$('.hii_post_carousel #hii_pc_prev').click(function() {
		var hii_pc_current = hii_pc_get_current_posts();
		var new_left = hii_pc_current['left'] - 1;
		var new_center = hii_pc_current['center'] - 1;
		var new_right = hii_pc_current['right'] - 1;
		
		if(new_left < 1) {
			new_left = hii_post_count;
		}
		if(new_center < 1) {
			new_center = hii_post_count;
		}
		if(new_right < 1) {
			new_right = hii_post_count;
		}
		
		if(new_left > hii_post_count) {
			new_left = 1;
		}
		if(new_center > hii_post_count) {
			new_center = 1;
		}
		if(new_right > hii_post_count) {
			new_right = 1;
		}
		
		update_carousel('prev', new_left, new_center, new_right, hii_post_count);
	});
	
	/* Next is clicked */
	$('.hii_post_carousel #hii_pc_next').click(function() {
		var hii_pc_current = hii_pc_get_current_posts();
		var new_left = hii_pc_current['left'] + 1;
		var new_center = hii_pc_current['center'] + 1;
		var new_right = hii_pc_current['right'] + 1;
		
		if(new_left < 1) {
			new_left = hii_post_count;
		}
		if(new_center < 1) {
			new_center = hii_post_count;
		}
		if(new_right < 1) {
			new_right = hii_post_count;
		}
		
		if(new_left > hii_post_count) {
			new_left = 1;
		}
		if(new_center > hii_post_count) {
			new_center = 1;
		}
		if(new_right > hii_post_count) {
			new_right = 1;
		}
		
		update_carousel('next', new_left, new_center, new_right, hii_post_count);
	});
	
	/* Window resized */
	$(window).resize(function() {
		hiiCarouselHight();
	});
	
	
	
	
	

	/* Mobile Menu */
	
	$('.mobile_menu_button').on('click tap', function(e){
		if($(window).width() <= parseInt(mobile_menu_switch)) {
			$(this).toggleClass('open').next('#main-nav').slideToggle(250);	
		}
	});
		
	$('#main_header .menu-item-has-children').on('click tap', function(e){
		if(e.target == this) {
			$(this).toggleClass('open').children('.sub-menu').slideToggle(250);
		}
	});
	
	$(window).on('resize',function(){
		if($(document).width() >= parseInt(mobile_menu_switch)) {
			$('#main-nav').fadeIn(250);	
			$('#main_header .sub-menu').removeClass('open').slideUp(250);
		} else {
			$('#main-nav').hide(0);
			$('#main_header .sub-menu').removeClass('open').slideUp(250);
		}
	});
	
	$('.search_button').on( 'click', function(e){
		$('#main_search').slideToggle(250);
		$('#main_search .search-field').focus();
	});
	/*
	AMP-CAROUSEL carousel	
	*/
	$('amp-carousel').each(function(index){
		var $carousel = $(this),
			width = ($carousel.attr('width') != undefined)?$carousel.attr('width'):1000,
			height = ($carousel.attr('height') != undefined)?$carousel.attr('height'):500,
			ratio = height / width,
			length = $carousel.find('.slide').length,
			delay = ($carousel.attr('height') != undefined)?$carousel.attr('delay'):false,
			type = $carousel.attr('type');
			
		
			
		/* testimonial slider */
		if($carousel.hasClass('testimonial-slider')){
			ratio = height.replace('px','') / width.replace('px','');
			var elementHeights = $carousel.find('.flex-item').map(function() {
			    return $(this).outerHeight();
			}).get();
			
			var maxHeight = Math.max.apply(null, elementHeights);
			
			height = maxHeight;
			  
			width = '100%';
			
			$carousel.height(height);
			
			$(window).on('resize',function(){
				elementHeights = $carousel.find('.flex-item').map(function() {
				    return $(this).outerHeight();
				}).get();
				
				maxHeight = Math.max.apply(null, elementHeights);
				height = maxHeight;				
				$carousel.height(height);
			});
		} 
		/* angled slider */
		else if($carousel.hasClass('angled') && type == 'slides'){
			width = $carousel.parent().width();
			height = width * ratio;
			
			$(window).on('resize',function(){
				width = $carousel.parent().width();
				height = width * ratio;
				$carousel.width(width);
				$carousel.height(height);
			});
		} 
		/* standard slider */
		else if(type == 'slides'){
			width = $carousel.parent().width();
			
			
			if($carousel.hasClass('has_thumbs')){
				var $thumbheight = $carousel.find('.thumbnails').height();
				if($thumbheight < 200){$thumbheight = 200; }
				$carousel.css({ 'margin-bottom': $thumbheight });
			} else {
				// Add Bullets
				if(length > 1) {
					$carousel.append('<ul class="bullets_navigation"></ul>')
					for(i=1;i <= length;i++){
						$carousel.find('.bullets_navigation').append('<li class="bullet_item" data-slide="'+i+'"></li>');
					}
				}
			}
			
			contentHeights = $carousel.find('.slide-text-overlay').map(function() {
				    return $(this).outerHeight(); 
				}).get();
			maxContentHeight = Math.max.apply(null, contentHeights);
			if(height < maxContentHeight) {
				height = (maxContentHeight);
			}
						
			$(window).on('resize',function(){
				width = $carousel.parent().width();
				
				
				contentHeights = $carousel.find('.slide-text-overlay').map(function() {
				    return $(this).outerHeight();
				}).get();
				maxContentHeight = Math.max.apply(null, contentHeights);
				if(height < maxContentHeight) {
					height = (maxContentHeight);
				}
				$carousel.width(width);
				$carousel.height(height);
				
				if($carousel.hasClass('has_thumbs')){
					$carousel.css({ 'margin-bottom': $carousel.find('.thumbnails').height() });
				}
			});
		} 
		/* carousel */
		else {
			width = $carousel.parent().width(); 
			$(window).on('resize',function(){
				width = $carousel.parent().width();
				$carousel.width(width);
			});
		}
		
		
		$carousel.width(width);
		$carousel.height(height);
		
		if(length > 1) {
			$carousel.append('<div class="amp-carousel-button amp-carousel-button-prev" role="button" aria-label="previous"></div><div class="amp-carousel-button amp-carousel-button-next" role="button" aria-label="next"></div>');
			
			
			$prev_button = $carousel.find('.amp-carousel-button-prev');
			$next_button = $carousel.find('.amp-carousel-button-next');
			
			
			/* ANGLED SLIDER */
			if($carousel.hasClass('angled') && type == 'slides'){
				$carousel.find('.slide:first-child').addClass('on').next('.slide').addClass('prev').next('.slide').addClass('next');
				
				var prev = 0, cur = 1, next = 2;
				$next_button.on('click', function(){
					
					
					
					$carousel.find('.slide:eq('+prev+')').animate({right:'-90%'}, 550, "swing",function(){
						$this = $(this);
						
						$this.addClass('next').removeClass('on').removeClass('prev');
						
					});
					
					$carousel.find('.slide:eq('+cur+')').animate({right:'0%'}, 500, "swing",function(){
						$this = $(this);
						
						$this.addClass('on').removeClass('next').removeClass('prev');
						
					});
					
					$carousel.find('.slide:eq('+next+')').animate({right:'-100%'}, 175, function(){
						$this = $(this);
						$this.css({right:'100%'}).animate({right:'90%'}, 300, "swing",function(){
							$(this).addClass('prev').removeClass('next').removeClass('on');
						});
					});
					
					next = (next < (length - 1))?next+1:0;
					cur = (cur < (length - 1))?cur+1:0;
					prev = (prev < (length - 1))?prev+1:0;
					
				});
				$next_button.trigger('click');
				
				$prev_button.on('click', function(){
					
						
					$carousel.find('.slide:eq('+prev+')').animate({right:'90%'}, 550, "swing",function(){
						$this = $(this);
						
						$this.addClass('prev').removeClass('on').removeClass('next');
						
					});
					
					$carousel.find('.slide:eq('+next+')').animate({right:'0%'}, 500, "swing",function(){
						$this = $(this);
						
						$this.addClass('on').removeClass('next').removeClass('prev');
						
					});
					
					$carousel.find('.slide:eq('+cur+')').animate({right:'100%'}, 175, function(){
						$this = $(this);
						$this.css({right:'-100%'}).animate({right:'-90%'}, 300, "swing",function(){
							$(this).addClass('next').removeClass('prev').removeClass('on');
						});
					});
					
					next = (next > 0)?next-1:length-1;
					cur = (cur > 0)?cur-1:length-1;
					prev = (prev > 0)?prev-1:length-1;
					
				});
				
				/* AUTO SLIDE */
				if(delay){
					var autoSlider = setInterval(function(){
						$next_button.trigger('click');
					}, delay);
				}
				
			}
			/* SLIDES */
			else if(type == 'slides'){
				
			
				$carousel.find('.bullets_navigation li:first-child').addClass('on');
					
				$carousel.find('.slide:first-child').show().addClass('on').siblings('.slide').hide().removeClass('on');
				
				$next_button.on('click', function(){ 
					current_index = $carousel.find('.slide.on').index();
					if(current_index < (length - 1)) {
						$carousel.find('.slide.on').fadeOut(500).removeClass('on').next().fadeIn(500, function(){ $(this).addClass('on');});
					} else {
						$carousel.find('.slide.on').fadeOut(500).removeClass('on');
						$carousel.find('.slide:eq(0)').fadeIn(500, function(){ $(this).addClass('on'); });
						
					}
					$carousel.find('.bullets_navigation li.on').removeClass('on');
					$carousel.find('.bullets_navigation li:eq('+current_index+')').addClass('on');
				});
				
				$prev_button.on('click', function(){
					current_index = $carousel.find('.slide.on').index();
					if(current_index > 0) {
						$carousel.find('.slide.on').fadeOut(500).removeClass('on').prev().addClass('on').fadeIn(500, function(){});
					} else {
						$carousel.find('.slide.on').fadeOut(500).removeClass('on');
						$carousel.find('.slide:eq('+(length-1)+')').addClass('on').fadeIn(500, function(){});
					}
					$carousel.find('.bullets_navigation li.on').removeClass('on');
					$carousel.find('.bullets_navigation li:eq('+current_index+')').addClass('on');
				});
				
				$carousel.find('.bullets_navigation li').on('click', function(){
					slide_index = ($(this).data('slide') - 1);
					$carousel.find('.slide.on').fadeOut(500).removeClass('on');
					$carousel.find('.slide:eq('+slide_index+')').addClass('on').fadeIn(500, function(){});
					$carousel.find('.bullets_navigation li.on').removeClass('on');
					$carousel.find('.bullets_navigation li:eq('+slide_index+')').addClass('on');
				});
				
				if($carousel.hasClass('has_thumbs')){
					$carousel.on('click', '.thumbnail', function(){
						var $this = $(this),
							eq = $this.data('img');
						
						$carousel.find('.slide.on').fadeOut(250).removeClass('on');
						$carousel.find('.slide:eq('+eq+')').addClass('on').fadeIn(400, function(){
							if($carousel.find('.slide.on').index() == 0) {
								$carousel.find('.amp-carousel-button-next').show();
								$carousel.find('.amp-carousel-button-prev').hide();
							} else if($carousel.find('.slide.on').index() == (length - 1)) {
								$carousel.find('.amp-carousel-button-next').hide();
								$carousel.find('.amp-carousel-button-prev').show();
							}
						});
					});
				}
				
				/* AUTO SLIDE */
				if(delay){
					var autoSlider = setInterval(function(){
						current_index = $carousel.find('.slide.on').index();
						/* last slide > first */
						if(current_index == (length - 1)) {
							$carousel.find('.slide.on').fadeOut(500).removeClass('on');
							$carousel.find('.slide').eq(0).fadeIn(500).addClass('on');
							
						} 
						/* first slide > second */
						else if(current_index == 0) {
							$carousel.find('.slide.on').fadeOut(500).removeClass('on').next().fadeIn(500).addClass('on');
							
						} 
						else if(current_index == (length - 2)) {
							$carousel.find('.slide.on').fadeOut(500).removeClass('on').next().fadeIn(500).addClass('on');
							
						} 
						/* mid slide > next */
						else {
							$carousel.find('.slide.on').fadeOut(500).removeClass('on').next().fadeIn(500).addClass('on');

						}
						$carousel.find('.bullets_navigation li.on').removeClass('on');
						$carousel.find('.bullets_navigation li:eq('+current_index+')').addClass('on');
						
					}, delay);
				}
	

			} 
			
			/* CAROUSEL */
			else if(type == 'carousel') {
				$prev_button.hide();
				var total_width = 0,
					$wrapper = $carousel.find('.carousel-wrapper'),
					position = $wrapper.position();
					
				$wrapper.find('.slide').each(function(){
					total_width += $(this).outerWidth(true);
				});
				
				var item_width = total_width / length,
					left_indent = position.left;
				
				$carousel.on('click','.amp-carousel-button-next', function(){
					width = $carousel.width();
					position = $wrapper.position();
					left_indent = position.left - item_width;
					
					if(left_indent < (-total_width + width)){ 
						left_indent = -total_width + width;
						$next_button.hide();	
					}
					
					if(position.left > (-total_width + width)){
						$wrapper.animate({left: left_indent}, 500, function(){});
					}
					$prev_button.show();
				});
				
				$carousel.on('click','.amp-carousel-button-prev', function(){
					width = $carousel.width();
					position = $wrapper.position();
					left_indent = position.left + item_width;
					
					if(left_indent > 0) {left_indent = 0;
						$prev_button.hide();
					}
					
					
					if(position.left <= 0){
						$wrapper.animate({left: left_indent}, 500, function(){});
						$next_button.show();
					}
				});
			}
			
			
			
		}
	});
			
	

	
	
	/*
	ACCORDION
	*/
	
	/* Check if Deatils and Summery are supported */
	var isDetailsSupported = (function(doc) {
	var el = doc.createElement('details');
	var fake;
	var root;
	var diff;
	if (!('open' in el)) {
		return false;
	}
	root = doc.body || (function() {
		var de = doc.documentElement;
		fake = true;
		return de.insertBefore(doc.createElement('body'), de.firstElementChild || de.firstChild);
	}());
	el.innerHTML = '<summary>a</summary>b';
	el.style.display = 'block';
	root.appendChild(el);
	diff = el.offsetHeight;
	el.open = true;
	diff = diff != el.offsetHeight;
	root.removeChild(el);
	if (fake) {
		root.parentNode.removeChild(root);
	}
		return diff;
	}(document));

	/* If not supported, use JS */
	if (!isDetailsSupported) {
		/* set to show, tabse with attr of OPEN */
		$('.wpb_accordion_section').each(function() {
			if($(this).attr('open'))
			{
				$(this).children('.wpb_accordion_content').show()
			}
			else
			{
				$(this).children('.wpb_accordion_content').hide();
			}	
		});
		
		/* on click, toggle tab */
		$('.wpb_accordion_header').click( function() {
			$(this).siblings('.wpb_accordion_content').slideToggle(500);
		});
	}
	
	/*
	GA LINK TRACKING
	*/
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


	/*
	GOOGLE MAPS SCROLL FIX
	*/
	$('.wpb_map_wraper iframe').addClass('scrolloff'); 
    $('body').on('click', '.wpb_map_wraper', function () {
        $('.wpb_map_wraper iframe').removeClass('scrolloff'); 

    });
   
    $("body").on('mouseleave', '.wpb_map_wraper', function () {
        $('.wpb_map_wraper iframe').addClass('scrolloff');
    });
    
    
    /*
	FIXED HEADER
	*/
    var $fixed_header =  $("#main_header.fixed", 'body');
    $(window).on('scroll', function(){
	  var sticky = $fixed_header,
	      scroll = $(window).scrollTop();
	
	  if (scroll >= 100) sticky.addClass('scrolled');
	  else sticky.removeClass('scrolled');
	});
	
    
});})(jQuery);



