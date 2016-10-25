<?php
global $hiilite_options;
if($hiilite_options['fromApp']) echo '</div>';
if(!$hiilite_options['subpage']):
if($hiilite_options['subdomain'] != 'iframe'):
?>			

			<!-- FOOTER -->
			<footer id="main_footer">
				<?php if(get_theme_mod('show_footer_top_yesno') == true): ?>
				<div id="footer_top">
					<div class="container_inner">
				<?php if($hiilite_options['footer_in_grid']) { echo '<div class="in_grid">'; } 
				// FOOTER COLUMN 1
				
				if(is_array(get_theme_mod('footer_top_columns'))):
					$footer_top_columns = get_theme_mod('footer_top_columns');
					$col_count_str = '';
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
					foreach ($footer_top_columns as $footer_top_column) :
						 echo '<div id="'.$footer_top_column.'" class="flex-item '.$col_count_str.' text-block">';  
							if ( is_active_sidebar( $footer_top_column ) ) :
								dynamic_sidebar( $footer_top_column );
							endif; 
						 echo '</div>'; 
					endforeach; 
				endif;
					 
					 
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
				
		
					
					
					
					if(get_theme_mod('footer_text_yesno') == true):
				?>
				<div id="footer_bottom"><div class="container_inner">
					<?php 
					if(get_theme_mod('footer_bottom_in_grid')) { echo '<div class="in_grid">'; } 
					
					if($footer_bottom_columns = get_theme_mod('footer_bottom_columns') && is_array(get_theme_mod('footer_bottom_columns'))):
						foreach (get_theme_mod('footer_bottom_columns') as $footer_bottom_column) :
							 echo '<div id="'.$footer_bottom_column.'" class="flex-item">';  
								if ( is_active_sidebar( $footer_bottom_column ) ) :
									dynamic_sidebar( $footer_bottom_column );
								endif; 
							 echo '</div>'; 
						endforeach; 
					endif;
							
					if(get_theme_mod('footer_bottom_in_grid')) { echo '</div>'; } ?></div>
					<div class="full-width align-center">
		<small>Copyright © <?=date('Y')?> <?=do_shortcode('[business_name]')?>. All rights reserved. <a href="https://hiilite.com/" target="_blank" title="Hiilite Creative Group | Web + Marketing">Web Design by Hiilite Creative Group</a></small>
	</div>
<?php endif; //end iframe check ?>
		</div>
				</div>
				<?php endif; //end footer bottom  ?>
			</footer>
			
	</div>
	<?php wp_footer(); 
if(get_post_meta(get_the_ID(), 'amp', true) == 'nonamp'){
	$hiilite_options['amp'] = false;
} else {
	$hiilite_options['amp'] = (!isset($hiilite_options['amp']))?get_theme_mod('amp'):false;
}

if(!$hiilite_options['amp']){
	include_once('js/non-amp-scripts.php');
}
	?>
	
</body>
</html>
<?php endif; // end if subpage ?>