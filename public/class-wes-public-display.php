<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://bplv.com.np
 * @since      1.0.0
 *
 * @package    WP_Easy_Social_Share
 * @subpackage WP_Easy_Social_Share/public/partials
 */


class Wes_Front{
    
    
    function __construct()
    {
      
       add_action( 'init', array( $this, 'wes_content_filter' ) );

    }

    public function wes_content_front( $content = null ) {

		global $post;
        $post_id = $post->ID;
    	if( wes_option('wes_disable_auto_code') != 1 )  {
    		$content .= '';
    		return $content;
    		exit;
    	}
    	elseif( wes_option('wes_all_post_types') != 1 && self::wes_is_allowed_post($post_id) != TRUE ){
    
    		$content .= '';
    		return $content;
    		exit;
    	}
    	else{
                if(  NULL != array_filter( wes_option('wes_enable_social') ) && is_single() ){

                    $template = wes_option('wes_template') ;
        			$content .= self::wes_content( $post_id, esc_html($template)); 
        		}
        		else{

        			$content .= '' ;  
        		}


  		return $content; 

  		}

	}

    public function remove_empty_tags( $content ){
        $content = preg_replace( array(
            '#<p>\s*<(div|aside|section|article|header|footer)#',
            '#</(div|aside|section|article|header|footer)>\s*</p>#',
            '#</(div|aside|section|article|header|footer)>\s*<br ?/?>#',
            '#<(div|aside|section|article|header|footer)(.*?)>\s*</p>#',
            '#<p>\s*</(div|aside|section|article|header|footer)#',
        ), array(
            '<$1',
            '</$1>',
            '</$1>',
            '<$1$2>',
            '</$1',
        ), $content );

        return preg_replace('#<p>(\s|&nbsp;)*+(<br\s*/*>)?(\s|&nbsp;)*</p>#i', '', $content);
    }

    public function wes_content_filter() {
        $filter = apply_filters( 'wes_filter', 'the_content');
        add_filter ( $filter, array($this,'wes_content_front'), 0 );
        add_filter ( $filter, array($this,'remove_empty_tags'), 100 );

    }

    public static function wes_content( $post_id, $template = ''){
        $data = '';
        $url = array();
        switch ($template) {
            case "default":
                ob_start();
                include_once WES_BASE_PATH . '/public/partials/wes-public-display.php';
                $data .= ob_get_contents();
                ob_end_clean();
            break;            
            case "one":
                ob_start();
                include_once WES_BASE_PATH . '/public/partials/wes-layout-one.php';
                $data .= ob_get_contents();
                ob_end_clean();
            break;
            default:
                ob_start();
                include_once WES_BASE_PATH . '/public/partials/wes-public-display.php';
                $data .= ob_get_contents();
                ob_end_clean();
        }
        
        $data = apply_filters( 'wes_templates', $data );
        return $data;     
    }

    private function wes_is_allowed_post($id){

    	$post_type = get_post_type($id);

    	$post = wes_option('wes_select_post_types');

        if ($post != NULL){
    	   $allowed_value = in_array($post_type, $post);
        }
        else{
            $allowed_value = FALSE;
        }
    	if  ( $allowed_value != NULL )
    		return TRUE;

    	else
    		return FALSE;

    }

}

$this->loader = new Wes_Loader();
$plugin_public = new Wes_Public( $this->get_plugin_name(), $this->get_version() );
$public = new Wes_Front();
$this->loader->add_action( 'plugins_loaded', $plugin_public, $public);

