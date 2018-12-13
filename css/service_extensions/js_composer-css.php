<?php if(false): ?><style><?php endif; ?>
.wpb_button, .wpb_content_element, ul.wpb_thumbnails-fluid>li {
	margin-bottom: 0;
}
<?php
	if(is_user_logged_in()): ?>
.compose-mode .vc_element.vc_vc_column.vc_container-block > .flex-item {
    width: 100%;
}
.compose-mode .vc_vc_video {
	padding-top: 0;
}
@media (min-width: 768px){
	.vc_col-sm-1, .vc_col-sm-10, .vc_col-sm-11, .vc_col-sm-12, .vc_col-sm-2, .vc_col-sm-3, .vc_col-sm-4, .vc_col-sm-5, .vc_col-sm-6, .vc_col-sm-7, .vc_col-sm-8, .vc_col-sm-9 {
	    float: none;
	}
}
<?php endif; ?>