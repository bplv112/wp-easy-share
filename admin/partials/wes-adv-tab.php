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

  $post_types = get_post_types( '', 'names'  );
?>

<div class="wes-adv-wrap" id="wes-type">
	<div class="wes-display-wrap">
		<h2> <?php _e('Select Display Options', 'wp-easy-share'); ?></h2>
	</div>
	<div class="wes-layout-wrap">
		<div class= "wes-auto-code">
			<i class="wes-help fa fa-question-circle" title="<?php _e('Enable social share','wp-easy-share'); ?>"></i>
			<label class= "wes-switch-label"> <?php _e('Enable social share','wp-easy-share'); ?></label>
			<label class="switch">
	        	<input type="checkbox" class="switch-input" name="wes_disable_auto_code" value="1" <?php checked( wes_option('wes_disable_auto_code'), '1' ); ?>>
            	<span class="switch-label" data-on="On" data-off="Off"></span> 
            	<span class="switch-handle"></span> 
        	</label>
		</div>
		<div class="wes-all">
			<i class="wes-help fa fa-question-circle" title="<?php _e( 'Disable to restrict share options to certain post types','wp-easy-share'); ?>"></i>
			<label class= "wes-switch-label"> <?php _e('Allow social share for all posts','wp-easy-share'); ?></label>
			<label class="switch">
	        	<input type="checkbox" id="allpost_allow" class="switch-input" name="wes_all_post_types" value="1" <?php checked( wes_option('wes_all_post_types'), '1' ); ?>>
            	<span class="switch-label" data-on="On" data-off="Off"></span> 
            	<span class="switch-handle"></span> 
        	</label>
		</div>
		<div class="wes-selected" id="wes_select_post">
			<i class="wes-help fa fa-question-circle" title="<?php _e('Select Post type','wp-easy-share');?>"></i>
			<label class="wes-switch-label"><?php _e('Select Post type','wp-easy-share');?></label>
			<select id="post-type-select" class= "wes-select" name="wes_select_post_types[]" multiple>
	        	<?php foreach ($post_types as $key => $value) { ?>
	        		<?php if($value != 'revision' && $value != 'nav_menu_item' && $value != 'custom_css' && $value != 'customize_changeset' ){ ?>
		       			<option value="<?php echo esc_html($value); ?>" <?php if (wes_option('wes_select_post_types')!=NULL) if ( in_array($value, wes_option('wes_select_post_types') ) == TRUE ) echo 'selected'; ?>> <?php _e($value, 'wp-easy-share'); ?> 
		       			</option>
					<?php
						}
	        		}	
	       		?>
			</select>
		</div>	
		<div class= "fontawesome-disable">
			<i class="wes-help fa fa-question-circle" title="<?php _e ('Disable if your theme already loads fontawesome','wp-easy-share'); ?>"></i>
			<label class= "wes-switch-label"> <?php _e('Enable fontawesome','wp-easy-share'); ?></label>
			<label class="switch">
	        	<input type="checkbox" class="switch-input" name="wes_font_awesome" value="1" <?php checked( wes_option('wes_font_awesome'), '1' ); ?>>
            	<span class="switch-label" data-on="On" data-off="Off"></span> 
            	<span class="switch-handle"></span> 
        	</label>
		</div>		
		<div class= "wes-new-tab">
			<i class="wes-help fa fa-question-circle" title="<?php _e('Disable to share in the same tab', 'wp-easy-share');?>"></i>
			<label class= "wes-switch-label"> <?php _e('Share in new tab','wp-easy-share'); ?></label>
			<label class="switch">
	        	<input type="checkbox" class="switch-input" name="wes_new_tab" value="1" <?php checked( wes_option('wes_new_tab'), '1' ); ?>>
            	<span class="switch-label" data-on="On" data-off="Off"></span> 
            	<span class="switch-handle"></span> 
        	</label>
		</div>		
	</div>
</div>
