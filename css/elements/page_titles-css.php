<?php if(false): ?><style><?php endif; ?>
.page-title {
	overflow: hidden;
	<?php 
	if ($hiilite_options['header_above_content'] == false){ echo 'z-index:100;top:0;'; } 
	echo 'position: relative;'; 
	get_background_css($hiilite_options['title_background']);
	?>
	min-height: <?=$hiilite_options['title_height'];?>;
	padding: <?=get_spacing($hiilite_options[ 'title_padding' ]);?>;
	display: block;
	width:100%;
}
.page-title, .page-title h1 {
	margin-bottom: 0;
	<?php 
	get_font_css($hiilite_options['title_font']);
	?>
}
.page-title .back_to_blog, .page-title small, .page-title small a {
	color: <?=$hiilite_options['title_font']['color'];?>;
}
