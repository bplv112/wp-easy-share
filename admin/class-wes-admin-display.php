<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       bplv.com.np
 * @since      1.0.0
 *
 * @package    Wes
 * @subpackage Wes/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * This class is only for the backend page display.
 *
 * @package    Wes
 * @subpackage Wes/admin
 * @author     Biplav Subedi <bplv.me@gmail.com>
 */

 Class Wes_Admin_Display{


 	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * 
	 */


 	public function __construct(  ) {

 		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 *		
	 * Initialize plugin page
	 *
	 * @since 1.0.0
	 */

	public function add_plugin_page()
    {
        // This page will be under "Settings"
        $my_page = add_menu_page(
            'Settings Admin', 
            __('WP Easy Social Share','wp-easy-share'), 
            'manage_options', 
            'social-share-settings', 
            array( $this, 'create_admin_page' ),
            '',
            80
        );
        add_action( 'load-' . $my_page, array( $this,'load_admin_js' ) );

    }

    public function load_admin_js(){
       
        add_action( 'admin_enqueue_scripts', array( $this,'enqueue_admin_js' ) );
    }

    public function enqueue_admin_js(){
        wp_enqueue_script( 'wes-select2', plugin_dir_url( __FILE__ ) . 'js/select2.js', array( 'jquery'), '', false );
    }

    /**
     * Options page callback
     *
     * 
     */
   
    public function create_admin_page()
    {
      require_once WES_BASE_PATH . '/admin/class-wes-meta-tabs.php';
      ?>
        <div class="wrap">
          <div class="wes-settings wes-settings-boxed">
            <h1><?php _e('WP Easy Share Settings', 'wp-easy-share'); ?></h1>
            <form method="post" action="options.php">
            <?php settings_fields( 'wes-settings-group' ); ?>
            <?php do_settings_sections( 'wes-settings-group' ); ?>
            
                    <?php 
                        $tab_args = array(
                            'container_id' => 'wes-setting-control',
                            'content_wrap_class' => 'wes-setting-wrap',
                            'tabs' => array(
                                array(
                                    'id' => 'basic',
                                    'title' => __( 'Basic Settings', 'wp-easy-share' ),
                                    'is_active' => true,
                                    'content' => self::wes_tab('basic')
                                ),  
                                array(
                                    'id' => 'adv',
                                    'title' => __( 'Advanced', 'wp-easy-share' ),
                                    'is_active' => false,
                                    'content' => self::wes_tab('adv')
                                ), 
                                array(
                                    'id' => 'layout-settings',
                                    'title' => __( 'Layout Settings', 'wp-easy-share' ),
                                    'is_active' => false,
                                    'content' => self::wes_tab('layout')
                                ),  
                            )           
                        );
                        Wes_Meta_Tabs::create( $tab_args )
                    ?>      
             <?php submit_button(); ?>
            </form>
          </div>
        </div>
      <?php
    }
    /**
     * Init the settings api fields
     *
     *
     * @since 1.0.0
     */

     public function page_init()
    {        

        /**
         * Basic Settings
         * 
         */
        register_setting( 'wes-settings-group', 'wes_enable_social', array($this, 'sanitize_checkbox'));
        register_setting( 'wes-settings-group', 'wes_social_order', array($this, 'sanitize_sortable'));

        //  * 
        //  * Advance settings
        //  * 
        //  */
        register_setting( 'wes-settings-group', 'wes_select_post_types', array($this,'sanitize_text') );

        register_setting( 'wes-settings-group', 'wes_all_post_types', array($this,'sanitize_checkbox'));
        
        register_setting( 'wes-settings-group', 'wes_font_awesome', array($this, 'sanitize_checkbox')  );

        register_setting( 'wes-settings-group', 'wes_new_tab', array($this, 'sanitize_checkbox')  );
        
        register_setting( 'wes-settings-group', 'wes_disable_auto_code', array($this, 'sanitize_checkbox')  );
        
        

        // /**
        //  * Appearance Settings
        //  * 
        //  */
        register_setting( 'wes-settings-group', 'wes_social_title', array($this,'sanitize_text'));

        register_setting( 'wes-settings-group', 'wes_template', array($this,'sanitize_text') );
        
        register_setting( 'wes-settings-group', 'wes_template_align', array($this,'sanitize_text') );
    
    }

    /**
     *
     *  Function to sanitize checkbox
     * 
     *  @param $input [int]
     *   
     *  @since 1.0.0
     */
    public function sanitize_checkbox($input){

    	if(is_array($input)){
	        $new_input = array();
	        foreach ($input as $key => $value) {   
	          $new_input[$key] = absint( $value ) ;
	        }
	    }
	    else{
        	$new_input = absint($input);
	    	
	    }

        return $new_input;

    } 
    /**
     *
     *  Function to sanitize checkbox
     * 
     *  @param $input [int]
     *   
     *  @since 1.0.0
     */
    public function sanitize_sortable($input){
    	$input = explode( ',', $input );
    	if(is_array($input)){
	        $new_input = array();
	        foreach ($input as $key => $value) {   
	          $new_input[$key] = esc_html( $value ) ;
	        }
	    }
	    else{
        	$new_input = esc_html($input);
	    	
	    }

        return $new_input;

    } 

    /**
     *
     *  Function to sanitize text
     * 
     *  @param $input [raw text]
     *   
     *  @since 1.0.0
     */

    public function sanitize_text($input){
      if(is_array($input)){
        $new_input = array();
        foreach ($input as $key => $value) {   
          $new_input[$key] = esc_html( $value ) ;
        }
      }
      else{
        $new_input = esc_html($input);

      }

        return $new_input;
    }  

    /**
     *
     *  Function to sanitize URL
     * 
     *  @param $input [Raw URL]
     *   
     *  @since 1.0.0
     */

    public function sanitize_url($input){
        $input = esc_url_raw($input);
        return $input;

    }

    /**
     *
     *  Function to sanitize Number 
     * 
     *  @param $input [Negative or postive number ]
     *   
     *  @since 1.0.0
     */

    public function sanitize_value($input){

        $input = (int) filter_var($input, FILTER_SANITIZE_NUMBER_INT);
        return $input;
    } 

    /**
     *
     *  Function to sanitize CSS
     * 
     *  @param $input [raw input]
     *   
     *  @since 1.0.0
     */

    public function sanitize_css($input){
        $input = wp_strip_all_tags($input);
        return $input;

    } 

    public function wes_tab($type = ''){
        $data= '';
        switch ($type) {
            case "basic":
                  ob_start();
                  include_once WES_BASE_PATH . '/admin/partials/wes-basic-tab.php';
                  $data .= ob_get_contents();
                  ob_end_clean();

            break;            
            case "adv":
                  ob_start();
                  include_once WES_BASE_PATH . '/admin/partials/wes-adv-tab.php';
                  $data .= ob_get_contents();
                  ob_end_clean();

            break;            
            case "layout":
                  ob_start();
                  include_once WES_BASE_PATH . '/admin/partials/wes-layout-tab.php';
                  $data .= ob_get_contents();
                  ob_end_clean();

            break;
            default:
             $data = __("No settings Found, please make sure the params are passed correctly.", 'wp-easy-share' );
        }

        return $data;
      
    } 

 }

$this->loader = new Wes_Loader();
$plugin_admin = new Wes_Admin( $this->get_plugin_name(), $this->get_version() );
$backend = new Wes_Admin_Display();
$this->loader->add_action( 'plugins_loaded', $plugin_admin, $backend);
