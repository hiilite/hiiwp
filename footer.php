<?php
/**
 * HiiWP: Footer
 *
 * WordPress footer file
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2021, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.8
 */
$hiilite_options = Hii::get_options();
do_action( 'hii_after_content' );

do_action( 'hii_before_footer' );
?>			
<!-- FOOTER -->
<footer id="main_footer">
	<?php 
	do_action ( 'hii_footer' );
	
	if($hiilite_options[ 'show_footer_top_yesno' ] == 'true'): 
		do_action ( 'hii_before_footer_top' );
		echo '<div id="footer_top"><div class="container_inner">';
		
		if($hiilite_options['footer_in_grid']) echo '<div class="in_grid">';
	
		$footer_top_columns = $hiilite_options[ 'footer_top_columns' ];
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
			
		do_action ( 'hii_after_footer_top' );	
			
		endif;//end footer top columns
		
		if($hiilite_options['footer_in_grid']) echo '</div>';
		echo '</div></div>';
	endif; //end footer top 
	
		
		
	
	if(get_theme_mod( 'footer_page_on') == true && get_theme_mod('footer_page_content') != false){
		do_action ( 'hii_before_footer_page' );
		
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
		do_action ( 'hii_after_footer_page' );
	} 
	

		
		
		
		do_action ( 'hii_before_footer_bottom' );
		
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
		
		do_action ( 'hii_before_footer_menu' );
		
		wp_nav_menu(array(
						'container' => 'nav',
						'container_class' => 'flex-item',
						'container_id' => 'footer-nav',
						'items_wrap'  => '<ul id="%1s" class="%2$s main-menu">%3$s</ul>',
						'theme_location' => 'footer-menu',
						'fallback_cb'    => false
					)); 
					
		do_action ( 'hii_after_footer_menu' );
		
		if(get_theme_mod('footer_bottom_in_grid')) { echo '</div>'; }
		
		do_action ( 'hii_after_footer_bottom' );
		?>
			<div class="full-width align-center">
				<?php echo wp_kses_post($hiilite_options['footer_bottom_copyright_text']); // WPCS: XSS ok. ?>
			</div>
		
	</div>
	<?php  ?>
</footer>

<?php
if($hiilite_options['btt_yesno'] == true) {
	echo '<div id="back-to-top">
			<i class="fa fa-'.get_theme_mod('btt_icon_style').'"></i>
		</div>';	
}	
?>

<?php do_action( 'hii_after_footer' ); ?>
			
	</div>
	<?php wp_footer(); ?>
	</div>
<?php do_action( 'hii_body_end' ); ?>
</body>
</html>
