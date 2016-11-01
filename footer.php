<?php
global $hiilite_options;
if($hiilite_options['fromApp']) echo '</div>';
if(!$hiilite_options['subpage']):
if($hiilite_options['subdomain'] != 'iframe'):
?>			

			<!-- FOOTER -->
			<footer id="main_footer">
				<?php if(get_theme_mod( 'show_footer_top_yesno', true )): ?>
				<div id="footer_top">
					<div class="container_inner">
				<?php if($hiilite_options['footer_in_grid']) { echo '<div class="in_grid">'; } 
				$col_count = 0;$col_count_str ='';
				if($hiilite_options['footer_top_col1'])$col_count++;
				if($hiilite_options['footer_top_col2'])$col_count++;
				if($hiilite_options['footer_top_col3'])$col_count++;
				if($hiilite_options['footer_top_col4'])$col_count++;
				switch($col_count){
					case 1:
						$col_count_str = 'full-width';
					break;
					case 2:
						$col_count_str = 'half-width';
					break;
					case 3:
						$col_count_str = 'third-width';
					break;
					case 4:
						$col_count_str = 'quarter-width';
					break;
				}
				
				
				
				// FOOTER COLUMN 1
				 if($hiilite_options['footer_top_col1'] == true) { echo '<div id="footer_column_1" class="flex-item '.$col_count_str.' text-block">';
					if ( is_active_sidebar( 'footer_column_1' ) ) :
						dynamic_sidebar( 'footer_column_1' );
					endif;
						
					echo '</div>'; }
						
					// FOOTER COLUMN 2
					if($hiilite_options['footer_top_col2']) { echo '<div id="footer_column_2" class="flex-item '.$col_count_str.' text-block">'; 
						if ( is_active_sidebar( 'footer_column_2' ) ) :
							dynamic_sidebar( 'footer_column_2' );
						endif;
					echo '</div>'; }
					
					
					// FOOTER COLUMN 3	
					if($hiilite_options['footer_top_col3']) { echo '<div id="footer_column_3" class="flex-item '.$col_count_str.' text-block">';  
						if ( is_active_sidebar( 'footer_column_3' ) ) :
							dynamic_sidebar( 'footer_column_3' );
						endif; 

					echo '</div>'; } 
							
							
					// FOOTER COLUMN 4 
					if($hiilite_options['footer_top_col4']) { echo '<div id="footer_column_4" class="flex-item '.$col_count_str.' text-block">';  
						
						if ( is_active_sidebar( 'footer_column_4' ) ) :
							dynamic_sidebar( 'footer_column_4' );
						endif; 
							
					 echo '</div>'; } 
					 
					 
					 if($hiilite_options['footer_in_grid']) { echo '</div>'; } ?>
					</div>
				</div>
				<?php endif; //end footer top 
					
					
					
				
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
				
		
					
					
					
					if($hiilite_options['footer_bottom_left'] || $hiilite_options['footer_bottom_center'] || $hiilite_options['footer_bottom_right']):
				?>
				<div id="footer_bottom">
					<?php if($hiilite_options['footer_in_grid']) { echo '<div class="container_inner">'; } ?>
						<?php if($hiilite_options['footer_bottom_left']) { echo '<div id="footer_bottom_left" class="flex-item align-left">';  
							if ( is_active_sidebar( 'footer_bottom_left' ) ) :
							dynamic_sidebar( 'footer_bottom_left' );
						endif; 
						 echo '</div>'; } ?>
						<?php if($hiilite_options['footer_bottom_center']) { echo '<div id="footer_bottom_left" class="flex-item align-center">';  	
							if ( is_active_sidebar( 'footer_bottom_center' ) ) :
							dynamic_sidebar( 'footer_bottom_center' );
						endif;
						 echo '</div>'; } ?>
						<?php if($hiilite_options['footer_bottom_right']) { echo '<div id="footer_bottom_left" class="flex-item align-right">';
							if ( is_active_sidebar( 'footer_bottom_right' ) ) :
							dynamic_sidebar( 'footer_bottom_right' );
						endif;
							 echo '</div>'; } ?>
					<?php if($hiilite_options['footer_in_grid']) { echo '</div>'; } ?>
					<div class="full-width align-center">
		<small>Copyright © <?=date('Y')?> <?=do_shortcode('[business_name]')?>. All rights reserved. <a href="https://hiilite.com/" target="_blank" title="Hiilite Creative Group | Web + Marketing">Web Design by Hiilite Creative Group Kelowna</a></small>
	</div>
<?php endif; //end iframe check ?>
		</div>
				</div>
				<?php endif; //end footer bottom  ?>
			</footer>
			
	</div>
	<?php wp_footer(); 
		
if(!$hiilite_options['amp']){
	include_once('js/non-amp-scripts.php');
}
	?>
	
</body>
</html>
<?php endif; // end if subpage ?>