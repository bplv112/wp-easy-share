<?php



function wes_option( $key = '' ) {

		$author_box_default_option = wes_default_option();
		if ( empty( $key ) ) {
			return;
		}
		$default = ( isset( $author_box_default_option[ $key ] ) ) ? $author_box_default_option[ $key ] : '';

		$value = get_option( $key, $default );
		return $value;

	}

function wes_default_option(){

	$default_values = array(

		'wes_enable_social' 	=> array(
								'facebook'=>'1',
								'twitter'=>'1',
								'google-plus'=>'1',
								'pinterest'=>'1',
								'linkedin'=>'1',
								'digg'=>'1',
								),
		'wes_social_order'  	=> array(								
								'0'=>'facebook',
								'1'=>'twitter',
								'2'=>'google-plus',
								'3'=>'pinterest',
								'4'=>'linkedin',
								'5'=>'digg',
							),
		'wes_social_fields' 	=> array( 
								'facebook' => ' <span class="media-icon"><i class="fa fa-facebook"></i></span> Facebook',
								'twitter' => ' <span class="media-icon"><i class="fa fa-twitter"></i></span> Twitter',
								'google-plus' => '<span class="media-icon"><i class="fa fa-google-plus"></i></span> Google Plus',
								'pinterest' => '<span class="media-icon"> <i class="fa fa-pinterest"></i> </span>Pinterest',
								'linkedin' => '<span class="media-icon"><i class="fa fa-linkedin"></i></span> Linkedin',
								'digg' => '<span class="media-icon"><i class="fa fa-digg"></i></span> Digg',
							),
		'wes_select_post_types' => array('post','page'),
		'wes_all_post_types'	=> 1,
		'wes_font_awesome'		=> 1,
		'wes_new_tab'			=> 1,
		'wes_disable_auto_code'	=> 1,
		'wes_template'			=> 'default',
		'wes_social_title'		=> 'Share it people',
		'wes_template_align'	=> 'left',

		);

	$default_values = apply_filters('wes_default_value', $default_values );
	
	return $default_values;

}

function wes_url_helper($perm, $title, $excerpt){
	$url['facebook'] = 'https://www.facebook.com/sharer/sharer.php?u=' . esc_url($perm);
    $url['twitter'] = "https://twitter.com/intent/tweet?text=$title&amp;url=".urlencode(esc_url($perm));
    $url['google-plus'] = 'https://plus.google.com/share?url=' . esc_url($perm);
    $url['pinterest'] = 'javascript:pinIt()';
    $url['linkedin'] = "http://www.linkedin.com/shareArticle?mini=true&amp;title=" . esc_attr($title) . "&amp;url=" . esc_url($perm) . "&amp;summary=" . esc_attr($excerpt);
    $url['digg'] ="http://digg.com/submit?phase=2%20&amp;url=" . esc_attr($excerpt) . "&amp;title=" . esc_attr($title);

    return $url;
}