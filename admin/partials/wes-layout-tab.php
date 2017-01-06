<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       bplv.com.np
 * @since      1.0.0
 *
 * @package    Wes
 * @subpackage Wes/admin/partials
 */

  
?>

<div class="wes-layout-settings" id="wes-layout">
	<h2>
		<?php _e('Layout Settings', 'wes'); ?>	
	</h2>
	<div class="wes-layout-select-wrap">
		<div class= "wes-layout-text">
			<label class="wes-layout-label"> <?php _e('Social Share title', 'wes' ); ?></label>
			<input type="text" name="wes_social_title" value="<?php echo esc_html(wes_option('wes_social_title')); ?>">
		</div>		
		<div class= "wes-layout-align">
			<label class="wes-layout-label"> <?php _e('Social Share align', 'wes' ); ?></label>
			<div class="wes-layout-select-align">
				<input type="radio" name="wes_template_align" value="left" <?php checked( wes_option('wes_template_align'), 'left' ); ?> > 
				<span><?php _e('Left', 'wes' ); ?></span>
			</div>				
			<div class="wes-layout-select-align">
				<input type="radio" name="wes_template_align" value="center" <?php checked( wes_option('wes_template_align'), 'center' ); ?> > 
				<span><?php _e('Center', 'wes' ); ?></span>
			</div>				
			<div class="wes-layout-select-align">
				<input type="radio" name="wes_template_align" value="right" <?php checked( wes_option('wes_template_align'), 'right' ); ?> > 
				<span><?php _e('Right', 'wes' ); ?></span>
			</div>	
		</div>
		<div class="wes-layout-select-wrap">
			<label class="wes-layout-label"><?php _e('Select a template', 'wes' ); ?></label>
			<div class="wes-layout-select">
				<input type="radio" name="wes_template" id="default-layout" value="default" <?php checked( wes_option('wes_template'), 'default' ); ?> > 
				<label for="default-layout">
					<img src="<?php echo esc_url(WES_IMG_URL.'default.png'); ?>" height="59">
				</label> 
				<span><?php _e('Default', 'wes' ); ?></span>
			</div>		
			<div class="wes-layout-select">
				<input type="radio" name="wes_template" id="layout-1" value="one" <?php checked( wes_option('wes_template'), 'one' ); ?> > 
				<label for="layout-1">
					<img src="<?php echo esc_url(WES_IMG_URL.'layout-one.png'); ?>" height="59">
				</label> 
				<span><?php _e('Layout One', 'wes' ); ?></span>
			</div>
		</div>
	</div>
</div>