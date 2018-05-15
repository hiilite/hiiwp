<?php if(false): ?><style><?php endif; ?>
/* POST SLIDER */

.hii_post_carousel {
  width: 100%;
  height: 100%;
  background:#fff;
  display:flex;
}
.hii_post_carousel_wrap {
	position:relative;	
}
/*.hii_post_carousel_wrap > div {
	width: 80%;
}*/
.hii_carousel_post {
	display:none;
	/*width:0;*/	
	position:absolute;
	left:-1000;
	text-align:center;
	-webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.hii_pc_left {
  display: block !important;
  visibility: visible !important;
  opacity: 1 !important;
  position: absolute;
  top: 30%;
  left: 0;
  width: 20% !important;
  z-index: 1;
  -webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.hii_pc_center {
  display: block !important;
  position: absolute;
  top:0;
  left: 20%;
  width: 60% !important;
  z-index: 2;
  -webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.hii_pc_right {
  display: block !important;
  visibility: visible !important;
  opacity: 1 !important;
  position: absolute;
  top: 30%;
  left: 80%;
  width: 20% !important;
  z-index: 1;
  -webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.hii_pc_center h3, .hii_pc_center .hii_post_exc, .hii_pc_center .button {
	visibility:visible;
	opacity:1;
	-webkit-transition: visibility 500ms, opacity 500ms;
	-moz-transition: visibility 500ms, opacity 500ms;
	-o-transition: visibility 500ms, opacity 500ms;
	-ms-transition: visibility 500ms, opacity 500ms;
	transition: visibility 500ms, opacity 500ms;	
	-webkit-transition-delay: 1s;
    -moz-transition-delay: 1s;
    -o-transition-delay: 1s;
    transition-delay: 1s;
}
.hii_pc_left h3, .hii_pc_left .hii_post_exc, .hii_pc_left .button, 
.hii_pc_right h3, .hii_pc_right .hii_post_exc, .hii_pc_right .button,
.fade-out-left h3, .fade-out-left .hii_post_exc, .fade-out-left .button,
.fade-out-right h3, .fade-out-right .hii_post_exc, .fade-out-right .button,
.fade-in h3, .fade-in .hii_post_exc, .fade-in .button {
	visibility:hidden;
	opacity:0;
	height:0;
}
#hii_pc_prev, #hii_pc_next {
	text-align:center;
	align-self: center;
}
#hii_pc_prev .fa, #hii_pc_next .fa {
	font-size:2rem;
	color:#303030;
	cursor:pointer;
}
.fade-out-left {
	display: block !important;
	visibility: visible;
	opacity: 0;
	position: absolute;
	top: 30%;
	left: 0;
	width: 20% !important;
	z-index: 1;
	-webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.fade-out-right {
	display: block !important;
	visibility: visible;
	opacity: 0;
	position: absolute;
	top: 30%;
	left: 80%;
	width: 20% !important;
	z-index: 1;
	-webkit-transition: all 1s;
	-moz-transition: all 1s;
	-o-transition: all 1s;
	-ms-transition: all 1s;
	transition: all 1s;
}
.fade-in {
	display: block;
	opacity:0;
}
@media(max-width:550px) {
	.hii_pc_left, .hii_pc_right {
		display:none !important;	
	}
}
