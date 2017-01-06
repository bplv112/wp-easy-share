<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       bplv.com.np
 * @since      1.0.0
 *
 * @package    Wes
 * @subpackage Wes/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wes
 * @subpackage Wes/public
 * @author     Biplav Subedi <bplv.me@gmail.com>
 */
class Wes_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		/**
		 * Template css
		 */
		if(wes_option('wes_template') == 'default'){
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wes-public.css', array(), $this->version, 'all' );
		}
		elseif( wes_option('wes_template') == 'one'){

			wp_enqueue_style( $this->plugin_name.'layout-one', plugin_dir_url( __FILE__ ) . 'css/wes-layout-one.css', array(), $this->version, 'all' );

		}
		else{
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wes-public.css', array(), $this->version, 'all' );
		}
		/**
		 * Disable fa
		 */
		if(wes_option('wes_font_awesome') == 1 ) :
			wp_enqueue_style( 'fontawesome', WES_FILE_URL .'/public/css/font-awesome-4.6.3/css/font-awesome.css', array(), '4.6.3', 'all'  );
		endif;

		/**
		 * Template align
		 */

		if(wes_option('wes_template_align') == 'left'){
	        $custom_css = ".wes-container, #social-platforms{ text-align: left; } ";
        	wp_add_inline_style( $this->plugin_name, $custom_css );
        	wp_add_inline_style( $this->plugin_name.'layout-one', $custom_css );
		}
		elseif (wes_option('wes_template_align') == 'right') {
	        $custom_css = ".wes-container, #social-platforms{ text-align: right; }";
        	wp_add_inline_style( $this->plugin_name, $custom_css );
        	wp_add_inline_style( $this->plugin_name.'layout-one', $custom_css );
		}
		else{
	        $custom_css = ".wes-container, #social-platforms{ text-align: center; }";
        	wp_add_inline_style( $this->plugin_name, $custom_css );
        	wp_add_inline_style( $this->plugin_name.'layout-one', $custom_css );
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wes-public.js', array( 'jquery' ), $this->version, false );

	}

}
