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
  $wes_social = NULL != wes_option('wes_enable_social') ? wes_option('wes_enable_social') : $default['wes_enable_social'];
  $wes_icon = NULL != wes_option('wes_social_fields') ? wes_option('wes_social_fields') : $default['wes_social_fields'];
  $order = NULL != wes_option('wes_social_order') ? wes_option('wes_social_order') : $default['wes_social_order'];
?>

<div class="wes-social-networks" id="wes-social">
	<h2>
		<?php _e('Social Media Selector', 'wp-easy-share'); ?>	
	</h2>
	<span class="wes-desc">
		<?php _e('Here you can enable/disable sharing option for different social media. You can also set the order of the social icons, drag and drop to sort the order', 'wp-easy-share'); ?>
	</span>
	<div class="wes-sortable-wrap" id="wes-sortable">
		<?php foreach ( $order as $key => $val ) { ?>
			<div class="wes-option-wrapper">
				<div class="wes-option-field">
					<label class="clearfix">
						<span class="left-icon"><i class="fa fa-arrows"></i></span>
						<span class="social-name"><?php echo $wes_icon[$val]; ?></span>
						<input type="checkbox" data-key='<?php echo $val; ?>' name="wes_enable_social[<?php echo $val; ?>]" value="1" <?php checked($wes_social[$val],1);?>/>
					</label>
				</div>
			</div>
		<?php } ?>
	</div>
	<input type="hidden" name="wes_social_order" id="wes_social_order" value="<?php echo implode( ',', $order ); ?>">
</div>
