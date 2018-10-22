<?php if(false): ?><style><?php endif; ?>
/*
 //	note: amp-slider	
 */
 amp-carousel{
	overflow: hidden;
	display: block;
    position: relative;
    max-width: 100vw;
}
amp-carousel[type=slides] .slide {
	position: absolute;
    top: 0;
    left: 0;
    bottom: 0; 
    right: 0;
    display: flex;
    min-width: 100%;
    max-width: 100%;
    height: 100%;
    margin: auto;
}

.amp-carousel-button {
    position: absolute;
    background: white;
    box-sizing: border-box;
    top: 50%;
    height: 34px;
    width: 34px;
    border-radius: 100%;
    opacity: 1;
    pointer-events: all;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    visibility: visible;
    z-index: 10;
    
    display: inline-block;
    font: normal normal normal 14px/34px FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
}
amp-carousel[data-arrow_size="small"] .amp-carousel-button{
	height: 24px;
    width: 24px;
    font-size: 10px;
    line-height: 24px;
}
amp-carousel[data-arrow_size="large"] .amp-carousel-button{
	height: 44px;
    width: 44px;
    font-size: 30px;
    line-height: 44px;
}

amp-carousel .amp-carousel-button.amp-disabled {
    -webkit-animation: none;
    animation: none;
    opacity: 0;
    visibility: hidden;
}
.amp-carousel-button-next {
    right: 5px;
}
.amp-carousel-button-next:before {
    content: "\f054";
}
.amp-carousel-button-prev {
    left: 5px;
}
.amp-carousel-button-prev:before {
    content: "\f053";
}

amp-carousel[data-arrow_icon="arrow"] .amp-carousel-button-next:before { content:"\f061"; }
amp-carousel[data-arrow_icon="arrow"] .amp-carousel-button-prev:before { content:"\f060"; }

amp-carousel[data-arrow_icon="arrow-alt-circle"] .amp-carousel-button-next:before { content:"\f18e"; font-size: 1.5em;}
amp-carousel[data-arrow_icon="arrow-alt-circle"] .amp-carousel-button-prev:before { content:"\f190"; font-size: 1.5em;}

amp-carousel[data-arrow_icon="caret"] .amp-carousel-button-next:before { content:"\f0da"; }
amp-carousel[data-arrow_icon="caret"] .amp-carousel-button-prev:before { content:"\f0d9"; }

amp-carousel[data-arrow_icon="chevron-circle"] .amp-carousel-button-next:before { content:"\f138"; font-size: 1.5em; }
amp-carousel[data-arrow_icon="chevron-circle"] .amp-carousel-button-prev:before { content:"\f137"; font-size: 1.5em;}

amp-carousel[data-arrow_background_type="none"] .amp-carousel-button { background: none; }
amp-carousel[data-arrow_background_type="circle"] .amp-carousel-button { }
amp-carousel[data-arrow_background_type="square"] .amp-carousel-button { border-radius: 0; }
amp-carousel[data-arrow_background_type="round-square"] .amp-carousel-button { border-radius: 4px; }

@media (max-width:768px) { amp-carousel[data-hide_arrows_on_mobile="true"] .amp-carousel-button { display: none; } }

amp-carousel ul.bullets_navigation {
    position: absolute;
    bottom: 0;
    width: 100%;
    left: 0;
    padding: 0;
    margin: 0;
    text-align: center;
}

amp-carousel li.bullet_item {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-width: 1px;
    border-style: solid;
    border-radius: 10px;
    margin: 5px;
    background-color: rgba(0,0,0,0.4);
}

amp-carousel.slider {
	min-width: 100%;
	display: block;
	position: relative;
	
}
amp-carousel.slider_full_height {
	min-height: 100vh;
}

amp-carousel.slider .slide-text-overlay {
	flex: 1 1 auto;
    margin: auto;
	<?php echo (isset($slider_slide_styles))?$slider_slide_styles:'';?>
}
amp-carousel.slider .slide-text-overlay amp-fit-text {
	height: 100%;
}
amp-carousel.slider amp-img img {
    height: auto;
}
amp-carousel[type=slides] .slide {
	transition: none;
}

/*for when image bleeds beyond edges*/
amp-carousel.slider img {
	max-height: 100%;
	max-width: 100%;
}


amp-carousel.carousel {
	width: 100%;
	position: relative;
}
.smooth-scroll-wrapper.kinetic-active {
    overflow: hidden;
}
.smooth-scroll-wrapper.kinetic-active .carousel-wrapper {
	white-space: nowrap;
}

amp-carousel.carousel .carousel-wrapper:after {
    content: '';
    display: block;
    clear: both;
}
amp-carousel.carousel .slide {
	display: inline-block;
	white-space: normal;
	margin-right: 10px;
}
amp-carousel.carousel .slide > img {
    max-height: 100%;
    display: block;
}
amp-carousel.carousel .slide  .slide_img_container {
	width: 300px;
	padding-top: 75%;
	overflow: hidden;
}
amp-carousel.carousel .slide  .slide_img_container img {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: auto;
}
amp-carousel.carousel .carousel-wrapper{
	position: relative;
    white-space: nowrap;
	width: auto;
}
amp-carousel.slider .hide {
	display:none;	
}
amp-carousel.slider .show {
	display:block;	
}

amp-carousel.rounded .vc_tta-panel-heading {
	border-radius: 6px;
	padding: 0.3em 0.5em;	
}
amp-carousel.round .vc_tta-panel-heading {
	border-radius: 2em;
	padding: 0.3em 0.5em;
}
amp-carousel.square .vc_tta-panel-heading {
	border-radius: 0;
	padding: 0.3em 0.5em;
}

amp-carousel.left .vc_tta-panel-heading {
	text-align:left;
}
amp-carousel.center .vc_tta-panel-heading {
	text-align:center;
}
amp-carousel.right .vc_tta-panel-heading {
	text-align:right;
}