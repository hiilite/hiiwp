<?php
/**
 * Welcome Page View.
 * Displays the Welcome page
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2019, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; 
 

add_thickbox(); ?>
<div class="wrap about-wrap"> 
 
    <h1><span class="dashicons dashicons-hii-hii"></span> <?php printf( __( 'Welcome to HiiWP &nbsp; %s', 'hiiwp' ), HIIWP_VERSION ); ?></h1>
 
    <div class="about-text">
        <?php printf( __( "Congratulations! You are using the most versatile WordPress theme ever - created for designers and developers to build any type website.", 'hiiwp' ), HIIWP_VERSION ); ?>
    </div>
 
    <div class="wp-badge welcome__logo"><?php printf( __( 'Version %s', 'hiiwp' ), HIIWP_VERSION ); ?></div>
 
	<p class="hiiwp-page-actions">
		<a class="button button-primary" href="<?php echo admin_url( 'admin.php?page=hii_seo_settings' ); ?>"><span class="dashicons dashicons-admin-generic"></span> Settings</a> 
		<a class="button button-primary" href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins' ); ?>"><span class="dashicons dashicons-admin-plugins"></span> Install Plugins</a>
		<a class="button button-primary" href="<?php echo admin_url( 'customize.php' ); ?>"><span class="dashicons dashicons-admin-customizer"></span> Customize</a>
	</p>
   	<h2>Getting Started</h2>
    <div class="feature-section two-col">
	    
        <div class="col">
            <h3><?php _e( 'Install the Plugins', 'hiiwp' ); ?></h3>
            <p><?php _e( 'To get the most out of the HiiWP Theme, be sure to install the required and suggested plugins before using. The WPBakery Page Builder and HiiWP Plus are required.', 'hiiwp' ); ?></p>
            <a class="button button-primary" href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins' ); ?>"><span class="dashicons dashicons-admin-plugins"></span> Install Plugins</a>
        </div>
        
        <div class="col">
            <h3><?php _e( 'Install Design', 'hiiwp' ); ?></h3>
            <?php
	        if(class_exists('OCDI_Plugin')):?>
				<p><?php _e( 'Upload and install the design you purchased from ', 'hiiwp' ); ?><a href="https://hiilite.com/shop/themes/" target="_blank">Hiilite.com</a></p>
				
				<a class="button button-primary" href="<?php echo admin_url('themes.php?page=pt-one-click-demo-import'); ?>"><span class="dashicons dashicons-schedule"></span> <?php _e( 'Install Design','hiiwp');?></a>
	        <?php
		    else: ?>
		   		<p><?php _e( 'Get a head start on your website and install content from one of our many','hiiwp');?>
			   		<a href="https://hiilite.com/shop/themes/" target="_blank"><?php _e('prebuilt designs.','hiiwp');?></a>
			   		<?php _e('prebuilt designs. First, download and activate the One Click Demo Import plugin, then head over to Appearance > Import Demo Data to get started.', 'hiiwp' ); ?>
			   	</p>
		    		
		    		<?php 
			    	if( is_multisite() ) { ?>
		    			<a href="/wp-admin/network/plugin-install.php?tab=plugin-information&amp;plugin=one-click-demo-import&amp;TB_iframe=true&amp;width=772&amp;height=677" class="thickbox open-plugin-details-modal button" aria-label="More information about One Click Demo Import" data-title="One Click Demo Import"><span class="dashicons dashicons-download"></span> <?php _e( 'Download One Click Demo Import','hiiwp');?></a><?php
			    	} else {
				    	?>
					<a href="/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=one-click-demo-import&amp;TB_iframe=true&amp;width=772&amp;height=677" class="thickbox open-plugin-details-modal button" aria-label="More information about One Click Demo Import" data-title="One Click Demo Import"><span class="dashicons dashicons-download"></span> <?php _e( 'Download One Click Demo Import','hiiwp');?></a>
		    		<?php
				} 
	        endif;
	        ?>
	        
         
        </div>
        
    </div>
 
    <div class="feature-section two-col">
	    <div class="col">
            <h3><?php _e( 'Install Child Theme', 'hiiwp' ); ?></h3>
            <p><?php _e( 'We are constantly updating the HiiWP theme to make it better for our customers. So if you plan on making edits to the theme files, and don\'t want your edits overwritten, the it\'s best to install the HiiWP Child Theme', 'hiiwp' ); ?></p>
            <a class="button button-primary" href="<?php echo get_template_directory_uri() . '/hiiwp-child.zip'; ?>"><span class="dashicons dashicons-download"></span> Download Child Theme</a>
            <a href="https://hiilite.ticksy.com/article/13193/" target="_blank">How do I install the child theme?</a>
        </div>
        
        
 
        <div class="col">
            <h3><?php _e( 'Learn How To Use HiiWP', 'hiiwp' ); ?></h3>
            <p><?php _e( 'In this section, you will find quick tips and video tutorials on how to operate with HiiWP Theme. Or you can jump right in and start customizing your theme through the WordPress customizer.', 'hiiwp' ); ?></p>
            <a class="button button-primary" href="https://hiilite.ticksy.com/articles/100012838" target="_blank"><span class="dashicons dashicons-welcome-learn-more"></span> Learn</a>
            <a class="button" href="<?php echo admin_url( 'customize.php' ); ?>"><span class="dashicons dashicons-admin-customizer"></span> Customize</a>
        </div>
    </div>	
    
    <h2>Resources</h2>
    <div class="feature-section two-col">
	    <div class="col">
	        
            <h3><?php _e( 'Licencing', 'hiiwp' ); ?></h3>
            <p>With a licence key, you can get constant updates to you theme including improvements to speed, security, browser compatibility, and an ever growing feature list. You can purchase a licence key from <a href="https://hiilite.com/shop/wordpress/themes/hiiwp/" target="_blank">Hiilite.com</a> or manage your existing subscriptions from your <a href="https://hiilite.com/my-account/" target="_blank">account dashboard</a>.</p>
            <a class="button button-primary" href="https://hiilite.com/shop/wordpress/themes/hiiwp/" target="_blank"><span class="dashicons 
dashicons-admin-network"></span> Purchase Licence Keys</a>
			<a class="button button-primary" href="https://hiilite.com/my-account/" target="_blank"><span class="dashicons dashicons-tickets-alt"></span> Manage Licence Keys</a>
        </div>
        
	    <div class="col">
	        
            <h3><?php _e( 'Support', 'hiiwp' ); ?></h3>
            <p>To get your support related question answered in the fastest timing, please head over to our <a href="https://hiilite.ticksy.com/submit/" target="_blank">support page</a> and open Support ticket. To open a support ticket you should have a valid support subscription in case if your support has expired you can purchase support extension from <a href="https://hiilite.com/shop/wordpress/themes/hiiwp/" target="_blank">Hiilite.com</a>.</p>
<p>
Before applying for support please make sure you understand the rules of support and go through all steps described and listed in <a href="https://hiilite.ticksy.com/article/13191" target="_blank">Support Policy</a> in order to get your issues solved as soon as possible.</p>
			<a class="button button-primary" href="https://hiilite.ticksy.com/submit/" target="_blank"><span class="dashicons dashicons-editor-help"></span> Get Support</a>
        </div>
        
    </div>
 
</div>