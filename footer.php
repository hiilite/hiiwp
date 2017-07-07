<?php
$hiilite_options = Hii::$hiiwp->get_options();
do_action( 'hii_after_content' );

?>			

<!-- FOOTER -->
<footer id="main_footer">
<?php if(is_customize_preview()) echo '<div class="customizer_quick_links"><button class="customizer-edit" data-control=\'{"name":"footer_background_color"}\'>Edit Footer</button><button class="customizer-edit font-edit" data-control=\'{"name":"typography_footer_headings_font"}\'>Footer Fonts</button></div>';?>
	<?php 
	do_action ( 'hii_footer' );
	
	if(get_theme_mod( 'show_footer_top_yesno', true )): 
		echo '<div id="footer_top"><div class="container_inner">';
		
		if($hiilite_options['footer_in_grid']) echo '<div class="in_grid">';
	
	
		$footer_top_columns = get_theme_mod( 'footer_top_columns');
		if(is_array($footer_top_columns) && count($footer_top_columns) > 0):
			$col_count_str ='';
			switch(count($footer_top_columns)){
				case 1:
					$col_count_str = 'col-12';
				break;
				case 2:
					$col_count_str = 'col-6';
				break;
				case 3:
					$col_count_str = 'col-4';
				break;
				case 4:
					$col_count_str = 'col-3';
				break;
			}
			
			
			
			// FOOTER TOP COLUMN
		
			foreach($footer_top_columns as $footer_top_column):
			 	echo '<div id="'.$footer_top_column.'" class="flex-item '.$col_count_str.' text-block">';
				if ( is_active_sidebar( $footer_top_column ) ) :
					dynamic_sidebar( $footer_top_column );
				endif;
				echo '</div>';
				 
		
			endforeach;
			
			
			
		endif;//end footer top columns
		
		if($hiilite_options['footer_in_grid']) echo '</div>';
		echo '</div></div>';
	endif; //end footer top 
	
		
		
	
	if(get_theme_mod( 'footer_page_on') == true && get_theme_mod('footer_page_content') != false){
		$footerpage_id = get_theme_mod('footer_page_content');
		$footerpage = new WP_Query(array('page_id' => $footerpage_id));
		if($footerpage->have_posts()){
			echo '<div id="footer_page">';
			while($footerpage->have_posts()){
				$footerpage->the_post();
				
				the_content();
			}
			echo '</div>';
		}
	} 
	

		
		
		

		echo '<div id="footer_bottom" class="container_inner">';
	
		if(get_theme_mod('footer_bottom_in_grid')) { echo '<div class="in_grid">'; }
		
		
		$footer_bottom_columns = get_theme_mod( 'footer_bottom_columns', false);
		if(is_array($footer_bottom_columns)) {
			$col_count_str ='';
			switch(count($footer_bottom_columns)){
				case 1:
					$col_count_str = 'col-12';
				break;
				case 2:
					$col_count_str = 'col-6';
				break;
				case 3:
					$col_count_str = 'col-4';
				break;
			}
	
			foreach($footer_bottom_columns as $footer_bottom_column):
			 	echo '<div id="'.$footer_bottom_column.'" class="flex-item '.$col_count_str.' text-block">';
				if ( is_active_sidebar( $footer_bottom_column ) ) :
					dynamic_sidebar( $footer_bottom_column );
				endif;
				echo '</div>';
			endforeach;
		}
		
		
		wp_nav_menu(array(
						'menu' =>  'footer-menu',
						'container' => 'nav',
						'container_class' => 'flex-item',
						'container_id' => 'main-nav',
						'items_wrap'  => '<ul id="%1s" class="%2$s main-menu">%3$s</ul>',
						'theme_location' => 'footer-menu',
						'fallback_cb'    => false
					)); 
		
		if(get_theme_mod('footer_bottom_in_grid')) { echo '</div>'; }
		 
		?>
			<div class="full-width align-center">
				<?php echo get_theme_mod('footer_bottom_copyright_text', '<small>Copyright © '.date('Y').'  All rights reserved. <a href="https://hiilite.com/" target="_blank" title="Hiilite Creative Group | Web + Marketing">Web Design by Hiilite Creative Group Kelowna</a></small>'); ?>
			</div>
		
	</div>
	<?php  ?>
</footer>
<?php do_action( 'hii_after_footer' ); ?>
			
	</div>
	<?php wp_footer(); ?>
	
</body>
</html>
