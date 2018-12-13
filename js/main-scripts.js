/**
 * HiiWP: Main-Scripts
 *
 * Main JS file
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.1
 */
(function($){
$('body').ready(function(){
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
		$('#main_search input[name=s]').focus();
	});
	
	$(window).scroll(function () {
		$('.vc_row-parallax').each(function(index){
			var $parallax_row = $(this);
			$parallax_row.css("background-position","50% " + (($(window).scrollTop() / 4) - $parallax_row.offset().top / 2) + "px");
	    });
	}); 
	
	/*
	Video Player size fix	
	*/
	$('.blog-article embed, .blog-article iframe, .blog-article object').height(function(){
		height = ( $(this).attr('height') / $(this).attr('width') ) * $(this).width();
		return height;
	});
	
	/*
	AMP-CAROUSEL carousel	
	*/
	
	/**
	 * goToSlide function.
	 * 
	 * @access public
	 * @param mixed slider
	 * @param mixed slideIndex
	 * @return void
	 */
	function goToSlide(slider, slideIndex) {
		var current_height = slider.height();
		slider.find('.slide.on')
			.fadeOut(500)
			.removeClass('on');
		
		slider.find('.slide:eq('+slideIndex+')')
			.fadeIn(500, function(){
				var slide_height = $(this).children().height();
				if(slide_height > current_height) 
					slider.height(slide_height);
			})
			.addClass('on');
		slider.find('.bullets_navigation li.on')
			.css('background-color', '')
			.removeClass('on');
		slider.find('.bullets_navigation li:eq('+slideIndex+')')
			.addClass('on')
			.css('background-color', slider.data('bullet_color'));
	}
	
	/**
	 * Find all amp-carousels on site and iterate through their settings.
	 *
	 */
	$('amp-carousel').each(function(index){
		console.log(index);
		var $carousel = $(this);
		var width = ($carousel.attr('width') != undefined)?$carousel.attr('width'):1000,
			height = ($carousel.attr('height') != undefined)?$carousel.attr('height'):500,
			ratio = height / width,
			length = $carousel.find('.slide').length,
			delay = ($carousel.attr('delay') != undefined)?$carousel.attr('delay'):false,
			type = $carousel.attr('type');
			
			
		/* testimonial slider */
		if($carousel.hasClass('testimonial-slider')){
			width = $carousel.parent().width();
			
			var elementHeights, maxHeight;
				elementHeights = $carousel.find('.flex-item').map(function() {
				    return $(this).outerHeight();
				}).get();
				maxHeight = Math.max.apply(null, elementHeights);
			
				height = maxHeight;

				$carousel.height(height);
				
			
			$carousel.width(width);
			if($carousel.data('show_bullets') === true){
				if(length > 1) {
					$carousel.append('<ul class="bullets_navigation"></ul>')
					for(i=1;i <= length;i++){
						$carousel.find('.bullets_navigation')
							.append('<li class="bullet_item" data-slide="'+i+'"></li>')
							.find('li:last')
							.css('border-color', $carousel.data('bullet_color'));
					}
				}
			}
			
			
			$(window).on('resize',function(){
				elementHeights = $carousel.find('.flex-item').map(function() {
				    return $(this).outerHeight();
				}).get();
				
				maxHeight = Math.max.apply(null, elementHeights);
				height = maxHeight;	
				width = $carousel.parent().width();	
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
				if($carousel.data('show_bullets') === true){
					if(length > 1) {
						$carousel.append('<ul class="bullets_navigation"></ul>')
						for(i=1;i <= length;i++){
							$carousel.find('.bullets_navigation')
								.append('<li class="bullet_item" data-slide="'+i+'"></li>')
								.find('li:last')
								.css('border-color', $carousel.data('bullet_color'));
						}
					}
				}
			}
			
			contentHeights = $carousel.find('.slide-text-overlay').map(function() {
				    return $(this).outerHeight(); 
				    
				}).get();
			maxContentHeight = Math.max.apply(null, contentHeights);
			
			height = (maxContentHeight);
			$carousel.height(height);	
			$(window).on('resize',function(){
				width = $carousel.parent().width();
				
				
				contentHeights = $carousel.find('.slide-text-overlay').map(function() {
				    return $(this).outerHeight();
				}).get();
				maxContentHeight = Math.max.apply(null, contentHeights);
				height = (maxContentHeight);

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
				/*$carousel.find('.slide').each(function(){
					$(this).css('max-width', function(){
						col_name = this.className.match(/\bcol-[0-9]/);
						return Math.max($carousel.width() / (12 / col_name[0].match(/[0-9]/)), 250);
					});
				});*/
			});
			
			$carousel.find('a.slide').on('touchend', function(e){
				if($(this).data('moved') == 0){
					window.location.href = $(this).attr('href');
	            }
				
			})
			.on('touchstart', function () {
            	$(this).data('moved', '0');
	        })
	        .on('touchmove', function () {
	            $(this).data('moved', '1');
	        });
		}
		
		$carousel.width(width);
		
		
		if(length > 1) {
			
			
			/* SLIDES */
			if(type == 'slides'){
				/* Add Bullets */
				$carousel.find('.bullets_navigation li:first-child')
					.addClass('on')
					.css('background-color', $carousel.data('bullet_color'));
					
				$carousel.find('.slide:first-child')
					.show()
					.addClass('on')
					.siblings('.slide')
					.hide()
					.removeClass('on');
					
				/* AUTO SLIDE */
				if(delay !== false && delay > 0){
					var autoSlider;
					var autoPlayInterval = function (){
						autoSlider = setInterval(function(){
							current_index = $carousel.find('.slide.on').index();
							
							if(current_index < (length - 1)) {
								goToSlide($carousel, (current_index + 1));
							} else {
								goToSlide($carousel, 0);
							}
						}, delay);
					}
					autoPlayInterval();
				}

				if($carousel.data('show_arrows') == true) {
					
					$carousel.append('<div class="amp-carousel-button amp-carousel-button-prev" role="button" aria-label="previous"></div><div class="amp-carousel-button amp-carousel-button-next" role="button" aria-label="next"></div>');
					
					$prev_button = $carousel.find('.amp-carousel-button-prev');
					$next_button = $carousel.find('.amp-carousel-button-next');
					
					
					if($carousel.data('arrow_background_type') !== 'none'){
						$prev_button.css('background-color', $carousel.data('arrow_background_color')); 
						$next_button.css('background-color', $carousel.data('arrow_background_color'));
					}
					if($carousel.data('arrow_color') != ''){
						$prev_button.css('color', $carousel.data('arrow_color')); 
						$next_button.css('color', $carousel.data('arrow_color'));
					}
					/*
						NEXT BUTTON CLICKED
					*/
					$next_button.on('click', function(){ 
						current_index = $carousel.find('.slide.on').index();
						if(delay) { clearInterval(autoSlider); autoPlayInterval(); }
						
						if(current_index < (length - 1)) {
							goToSlide($carousel, (current_index + 1));
						} else {
							goToSlide($carousel, 0);
						}
											
					});
					
					/*
						PREVIOUS BUTTON CLICKED
					*/
					$prev_button.on('click', function(){
						current_index = $carousel.find('.slide.on').index();
						if(delay) { clearInterval(autoSlider); autoPlayInterval(); }
						
						if(current_index > 0) {
							goToSlide($carousel, (current_index - 1));							
								
						} else {
							goToSlide($carousel, (length - 1));
						}
						
					});
				} // end show_arrows
				
				if($carousel.data('show_bullets') === true) {
					/*
						BULLET CLICKED
					*/
					$carousel.find('.bullets_navigation li').on('click', function(){
						if(delay) { clearInterval(autoSlider); autoPlayInterval(); }
						slide_index = ($(this).data('slide') - 1);
						
						goToSlide($carousel, slide_index);
					});
				} // end show_bullets
				
				/*
					THUMBNAIL CLICKED
				*/
				if($carousel.hasClass('has_thumbs')){
					$carousel.on('click', '.thumbnail', function(){
						if(delay) { clearInterval(autoSlider); autoPlayInterval(); }
						var $this = $(this),
							eq = $this.data('img');
						
						goToSlide($carousel, eq);
						
					});
				}

			} 
			
			/* CAROUSEL */
			else if(type == 'carousel') {
				
				$carousel.smoothTouchScroll({
					continuousScrolling: false,
					scrollWrapperClass:  'smooth-scroll-wrapper',
					scrollableAreaClass: 'carousel-wrapper'
				}); 
				
				var total_width = 0,
					$wrapper = $carousel.find('.smooth-scroll-wrapper'),
					position = $wrapper.scrollLeft();
					
				$wrapper.find('.slide').each(function(){
					total_width += $(this).outerWidth(true);
					/*$(this).css('max-width', function(){
						col_name = this.className.match(/\bcol-[0-9]/);
						return (col_name)?Math.max($carousel.width() / (12 / col_name[0].match(/[0-9]/)), 250):false;
					});*/
				});
				
				// slider.width = carousel.width / (12 / col-#) 
				

				//$wrapper.find('.carousel-wrapper').width(total_width);
				
				var item_width = total_width / length,
					left_indent = position.left;
				
				
				if($carousel.data('show_arrows') === true) {
					
					$carousel.append('<div class="amp-carousel-button amp-carousel-button-prev" role="button" aria-label="previous"></div><div class="amp-carousel-button amp-carousel-button-next" role="button" aria-label="next"></div>');
					
					$prev_button = $carousel.find('.amp-carousel-button-prev');
					$next_button = $carousel.find('.amp-carousel-button-next');
					
					if($carousel.data('arrow_background_type') !== 'none'){
						$prev_button.css('background-color', $carousel.data('arrow_background_color')); 
						$next_button.css('background-color', $carousel.data('arrow_background_color'));
					}
					if($carousel.data('arrow_color') != ''){
						$prev_button.css('color', $carousel.data('arrow_color')); 
						$next_button.css('color', $carousel.data('arrow_color'));
					}
					
					
					$carousel.on('click', '.amp-carousel-button-next', function(){
						var $next_button = $(this),
							$prev_button = $(this).siblings('.amp-carousel-button-prev');
						
						width = $carousel.width();
						position = $wrapper.scrollLeft();
						left_indent = position + item_width;
						
						$wrapper.animate({scrollLeft: left_indent}, 500, function(){});
						
						$prev_button.show();
					});
					
					$carousel.on('click', '.amp-carousel-button-prev', function(){
						var $prev_button = $(this),
							$next_button = $(this).siblings('.amp-carousel-button-next');
						width = $carousel.width();
						position = $wrapper.scrollLeft();
						left_indent = position - item_width;
						
						
						//if(position <= 0){
							$wrapper.animate({scrollLeft: left_indent}, 500, function(){});
							$next_button.show();
						//}
					});
				} // end show_arrows
				
				
				
				
				/* AUTO SLIDE */
				if(delay){
					var autoSlider = setInterval(function(){
						width = $carousel.width();
						position = $wrapper.position();
						left_indent = position.left - item_width;
						
						if(left_indent < (-total_width + width)){ 
							left_indent = 0;
						}
						
						if(position.left > (-total_width + width)){
							$wrapper.animate({left: left_indent}, 500, function(){});
						}
						if($carousel.data('show_arrows') === 'true') $prev_button.show();
						
					}, (delay * 1000));
				}
			}
		}
	});
			
	
	/* HII POST CAROUSEL */
	
	/* get number of items */
	var hii_post_count = $('.hii_post_carousel .hii_post_carousel_wrap > div').length;
	
	if(hii_post_count > 0) {
	
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
	} // end if hii_post_cout
	
	
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
	
	
	if (typeof window.viewportUnitsBuggyfill == 'function') { 
		window.viewportUnitsBuggyfill.init(); 
	}

	$.fn.change = function(cb, e) {
	    e = e || { subtree:true, childList:true, characterData:true };
	    $(this).each(function() {
	      function callback(changes) { cb.call(node, changes, this); }
	      var node = this;
	      (new MutationObserver(callback)).observe(node, e);
	    });
	  };
	  
	  
	/*
	LAYOUT FILTERS
	*/
	
	$('.layout-switcher').on('click', '[data-layout]', function(e){
		var layout_type = $(this).data('layout');
		var container = $('.' + $(this).data('container') );
		
		container.removeClass('boxed masonry full-width')
		container.addClass(layout_type);
		switch(layout_type){
			case 'boxed':
				container.addClass('square');
			break;
			case 'masonry':
				container.removeClass('square');
			break;
		}
	});
  	 
});})(jQuery);



