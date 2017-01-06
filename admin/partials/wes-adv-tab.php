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

  $default = wes_default_option();
  $wes_social = !empty(wes_option('wes_enable_social')) ? wes_option('wes_enable_social') : $default['wes_enable_social'];
  $wes_icon = !empty(wes_option('wes_social_fields')) ? wes_option('wes_social_fields') : $default['wes_social_fields'];
  $order = !empty(wes_option('wes_social_order')) ? wes_option('wes_social_order') : $default['wes_social_order'];
  $post_types = get_post_types( '', 'names'  );
?>

<div class="wes-adv-wrap" id="wes-type">
	<div class="wes-display-wrap">
		<h2> <?php _e('Select Display Options', 'wes'); ?></h2>
	</div>
	<div class="wes-layout-wrap">
		<div class= "wes-auto-code">
			<i class="wes-help fa fa-question-circle" title="Enable social share"></i>
			<label class= "wes-switch-label"> <?php _e('Enable social share','wes'); ?></label>
			<label class="switch">
	        	<input type="checkbox" class="switch-input" name="wes_disable_auto_code" value="1" <?php checked( wes_option('wes_disable_auto_code'), '1' ); ?>>
            	<span class="switch-label" data-on="On" data-off="Off"></span> 
            	<span class="switch-handle"></span> 
        	</label>
		</div>
		<div class="wes-all">
			<i class="wes-help fa fa-question-circle" title="Disable to restrict share options to certain post types"></i>
			<label class= "wes-switch-label"> <?php _e('Allow social share for all posts','wes'); ?></label>
			<label class="switch">
	        	<input type="checkbox" id="allpost_allow" class="switch-input" name="wes_all_post_types" value="1" <?php checked( wes_option('wes_all_post_types'), '1' ); ?>>
            	<span class="switch-label" data-on="On" data-off="Off"></span> 
            	<span class="switch-handle"></span> 
        	</label>
		</div>
		<div class="wes-selected" id="wes_select_post">
			<i class="wes-help fa fa-question-circle" title="Select post types"></i>
			<label class="wes-switch-label"><?php _e('Select Post type','wes');?></label>
			<select id="post-type-select" class= "wes-select" name="wes_select_post_types[]" multiple>
	        	<?php foreach ($post_types as $key => $value) { ?>
	        		<?php if($value != 'revision' && $value != 'nav_menu_item' && $value != 'custom_css' && $value != 'customize_changeset' ){ ?>
		       			<option value="<?php echo esc_html($value); ?>" <?php if (wes_option('wes_select_post_types')!=NULL) if ( in_array($value, wes_option('wes_select_post_types') ) == TRUE ) echo 'selected'; ?>> <?php _e($value, 'wes'); ?> 
		       			</option>
					<?php
						}
	        		}	
	       		?>
			</select>
		</div>	
		<div class= "fontawesome-disable">
			<i class="wes-help fa fa-question-circle" title="Disable if your theme already loads fontawesome"></i>
			<label class= "wes-switch-label"> <?php _e('Enable fontawesome','wes'); ?></label>
			<label class="switch">
	        	<input type="checkbox" class="switch-input" name="wes_font_awesome" value="1" <?php checked( wes_option('wes_font_awesome'), '1' ); ?>>
            	<span class="switch-label" data-on="On" data-off="Off"></span> 
            	<span class="switch-handle"></span> 
        	</label>
		</div>		
		<div class= "wes-new-tab">
			<i class="wes-help fa fa-question-circle" title="Disable to share in the sametab"></i>
			<label class= "wes-switch-label"> <?php _e('Share in new tab','wes'); ?></label>
			<label class="switch">
	        	<input type="checkbox" class="switch-input" name="wes_new_tab" value="1" <?php checked( wes_option('wes_new_tab'), '1' ); ?>>
            	<span class="switch-label" data-on="On" data-off="Off"></span> 
            	<span class="switch-handle"></span> 
        	</label>
		</div>		
	</div>
</div>
