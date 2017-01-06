<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       bplv.com.np
 * @since      1.0.0
 *
 * @package    Wes
 * @subpackage Wes/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<?php 
		$order = wes_option('wes_social_order');  
		$enabled= wes_option('wes_enable_social'); 
		$perm = get_permalink($post_id);
        $title = get_the_title($post_id);
        $excerpt = get_the_excerpt($post_id);
        $url['facebook'] = 'https://www.facebook.com/sharer/sharer.php?u=' . esc_url($perm);
        $url['twitter'] = "https://twitter.com/intent/tweet?text=$title&amp;url=".urlencode(esc_url($perm));
        $url['google-plus'] = 'https://plus.google.com/share?url=' . esc_url($perm);
        $url['pinterest'] = 'javascript:pinIt()';
        $url['linkedin'] = "http://www.linkedin.com/shareArticle?mini=true&amp;title=" . esc_attr($title) . "&amp;url=" . esc_url($perm) . "&amp;summary=" . esc_attr($excerpt);
        $url['digg'] ="http://digg.com/submit?phase=2%20&amp;url=" . esc_attr($excerpt) . "&amp;title=" . esc_attr($title);
        $new_tab = wes_option('wes_new_tab') == 1 ? 'target = _blank' : '';
?>
<div id="social-platforms">
<h3><?php echo esc_html(wes_option('wes_social_title')); ?></h3>
	<ul class="wes-social-icons">
		<?php foreach ($order as $key => $value) { ?>
			<?php if(array_key_exists($value, $enabled)){ ?>
				<li class="wes-icon-list">
					<a class="btn btn-icon btn-<?php echo esc_attr(($value)); ?>" href="<?php echo esc_html($url[$value]);?>" <?php echo $new_tab; ?> ><i class="fa fa-<?php echo esc_attr($value); ?>"></i></a>
				</li>
			<?php
			}
		}
		?>
	</ul>

</div>
