<?php if(false): ?><style><?php endif; ?>
ul.portfolio_terms {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: space-evenly;
    width: 100%;
    text-align: center;
}

ul.portfolio_terms li {
    display: inline-block;
    flex: 1 1 auto;
    position: relative;
}

ul.portfolio_terms li:hover ul.portfolio_child_terms {
    width: 100%;
    background: white;
    box-shadow: 0 0 5px rgba(0,0,0,0.5);
    max-height: 100%;
    opacity: 1;
}

ul.portfolio_terms ul.portfolio_child_terms li a {
    color: #252525;
}

ul.portfolio_child_terms {
    max-height: 0;
    position: absolute;
    transition: all 400ms;
    opacity: 0;
    display: flex;
    justify-content: space-evenly;
    width: 0;
    left: 0;
    right: 0;
    margin: auto;
    overflow: hidden;
}

.portfolio_filter {
    border-bottom: 1px solid;
}

.layout-boxed {
	display:flex;
	flex-direction:row;
	flex-wrap:wrap;	
}
ul.portfolio_terms li a {
    line-height: 3;
}
.portfolio-masonry-item .content-box {
	display: flex;
    flex-direction: row;
    justify-content: space-between;
}
.portfolio-masonry-item .content-box h6 {
	align-self: center;
}
.portfolio-masonry-item .content-box .cat-img-small {
	min-width:30px;
	width:30px;
	height:30px;	
}


.portfolio-piece {
	padding: <?php echo Hii::$options['portfolio_add_padding']; ?>;
}
.portfolio-piece img {
	display: block;
}
.portfolio-piece-content {
	border-style: solid;
}
.portfolio-piece .content-box {
	box-shadow: inset 0 0 1px rgba(0,0,0,0.1);
}
.portfolio-piece .portfolio-item-title {
	margin: auto 0 0 0;
}
.portfolio_row .post_meta {
	position: absolute;
    width: 100%;
    bottom: 10px;
    text-align: center;
}
.portfolio_row .post_meta h3 {
	margin: 2px;
	background: rgba(255,255,255,0.8);
	display: inline-block;
	padding: 5px;
}
.portfolio_row .post_meta small {
	margin: 2px;
    background: rgba(255,255,255,0.8);
    display: inline-block;
    padding: 5px;
}
<?php
if(Hii::$options['portfolio_template'] == 'split') {
?>
.single-portfolio .portfolio {
	padding-top:3em;
	padding-bottom:3em;
	background:<?php echo Hii::$options['portfolio_background']; ?>;	
}
<?php
}
?>
.single-portfolio .portfolio-gallery {
	background:#fff;
}
.single-portfolio .port-img img,
.single-portfolio .portfolio-gallery .port-img img {
	width:100%;	
}
.single-portfolio .portfolio-gallery .project-comments {
	padding:1em;	
}
.project-info {
	padding:1em;
	min-width:300px;
	background:<?php echo Hii::$options['portfolio_panel_background']; ?>;		
	color:<?php echo Hii::$options['portfolio_info_colors']['text']; ?>;		
}
.project-info .row {
	display:flex;	
}
.project-info h1,
.project-info h2,
.project-info h3,
.project-info h4,
.project-info h5,
.project-info h6 {
	color:<?php echo Hii::$options['portfolio_info_colors']['title']; ?>;		
}
.project-info a {
	color:<?php echo Hii::$options['portfolio_info_colors']['link']; ?>;		
}
.project-info a:hover {
	color:<?php echo Hii::$options['portfolio_info_colors']['hover']; ?>;		
}
.project-info .project-title {
	justify-content: space-between;	
	align-items: center;
}
.project-info .project-title h1 {
	font-weight:bold;
	font-size:1.2em;
}

.portfolio-piece figure {
	overflow:hidden;
	position: relative;
}
.portfolio-piece-image.square {
	position: relative;
	height: 0;
	overflow: hidden;
	padding-top: 100%;
}
.portfolio-piece-image.square img {
	position: absolute;
	top: 0;
	left: 0;
}

.portfolio-piece.image-left .portfolio-piece-wrapper {
    display: flex;
}
.portfolio-piece.image-left .portfolio-piece-wrapper .portfolio-piece-image,
.portfolio-piece.image-left .portfolio-piece-wrapper .portfolio-piece-content {
    min-width: 50%;
}
.portfolio-piece.image-left .portfolio-piece-image.square {
    padding-top: 50%;
}

.portfolio-piece.image-behind .portfolio-piece-wrapper {
    position: relative;
    overflow: hidden;
}
.portfolio-piece.image-behind .portfolio-piece-content {
    position: absolute;
    bottom: -100%;
    transition: all 0.4s;
    height:100%;
    display: flex;
    flex-direction: column;
}
.portfolio-piece.image-behind:hover .portfolio-piece-content {
	bottom:0;
}

.project-info .project-icon {
	width:50px;
	flex:1 1 50px;
	min-width:0;
}
.project-info .cat-icon {
	border-radius:50%;	
	padding-top:5px;
	padding-right:10px;
}
.project-info .project-group {
	display:block;	
}
.project-info .project-group,
.project-info .project-social {
	margin-top:2em;	
}
.project-info .project-social {
	display: block;
}
.project-info .project-social a .fa {
	color:<?php echo Hii::$options['portfolio_info_colors']['link']; ?>;	
	margin-right: 0.5em;
}
.project-info .project-author {
	margin-top:3em;	
}
.project-info .author-icon {
	padding-top:5px;
	padding-right:10px;
}
.project-info .author-icon img {
	border-radius:50%;	
}
.project-info .project-author h4 {
	text-transform: none;
	font-size:1.1em;
	font-weight:bold;
	color:<?php echo Hii::$options['portfolio_info_colors']['text']; ?>;
}
.project-info .project-author small {
	margin-bottom:1em;	
}
.project-info .project-description {
	margin-top:1em;	
}
@media (max-width:912px){
	.single-portfolio .portfolio > .container_inner > .in_grid {
		flex-direction:column-reverse;	
	}	
	.portfolio-gallery, .project-info {
		width:100%;
		flex:1 1 100%;	
	}
	.project-info {
		padding:2em;	
	}
}