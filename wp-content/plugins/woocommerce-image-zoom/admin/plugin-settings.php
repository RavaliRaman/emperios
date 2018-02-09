<?php

/**
 * WpBean settings API class
 *
 * @author WpBean
 */

if ( !class_exists('WPB_WIZ_Plugin_Settings' ) ):
class WPB_WIZ_Plugin_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WPB_WIZ_WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( esc_html__( 'WooCommerce Image Zoom Settings', 'woocommerce-image-zoom' ), esc_html__( 'Woo Zoom Settings', 'woocommerce-image-zoom' ), 'delete_posts', 'wpb_woocommerce_image_zoom_settings', array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'wpb_general_settings',
                'title' => esc_html__( 'General Settings', 'woocommerce-image-zoom' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'wpb_general_settings' => array(
                array(
                    'name'  => 'wpb_wiz_disable_zoom_mobile',
                    'label' => esc_html__( 'Disable Zooming in Mobile', 'woocommerce-image-zoom' ),
                    'desc'  => esc_html__( 'Yes Please!', 'woocommerce-image-zoom' ),
                    'type'  => 'checkbox',
                )
            ),
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;

new WPB_WIZ_Plugin_Settings();


/**
 * Getting the setting options
 */

if ( ! function_exists('wpb_wiz_get_option') ) {

    function wpb_wiz_get_option( $option, $section, $default = '' ) {
     
        $options = get_option( $section );
     
        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }
     
        return $default;
    }

}