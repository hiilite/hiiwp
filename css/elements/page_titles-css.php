<?php if(false): ?><style><?php endif; ?>
.page-title {
	overflow: hidden;
	<?php 
	if (Hii::$options['header_above_content'] == false){ echo 'top:0;'; } 
	echo 'position: relative;'; 
	echo get_background_css(Hii::$options['title_background']);
	echo (!empty(Hii::$options['title_height']))?'min-height:'.Hii::$options['title_height'].';':'';
	echo (!empty(Hii::$options[ 'title_padding' ]))?'padding:'.get_spacing(Hii::$options[ 'title_padding' ]).';':'';
	echo (!empty(Hii::$options[ 'title_font' ]['text-align']))?'text-align:'.Hii::$options['title_font']['text-align'].';':'';
	?>
	display: block;
	width:100%;
}

.page-title h1 {
	margin-bottom: 0;
	<?php 
	echo get_font_css(Hii::$options['title_font']);
	?>
}
.page-title .back_to_blog, 
.page-title small, 
.page-title small a {
	color: <?php echo Hii::$options['title_font']['color'];?>;
}
