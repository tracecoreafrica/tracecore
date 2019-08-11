<?php
/*
Plugin Name: Foton Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Mikado Themes
Version: 1.0
*/
define('FOTON_INSTAGRAM_FEED_VERSION', '1.0');
define('FOTON_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('FOTON_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));
define( 'FOTON_INSTAGRAM_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'FOTON_INSTAGRAM_ASSETS_PATH', FOTON_INSTAGRAM_ABS_PATH . '/assets' );
define( 'FOTON_INSTAGRAM_ASSETS_URL_PATH', FOTON_INSTAGRAM_URL_PATH . 'assets' );
define( 'FOTON_INSTAGRAM_SHORTCODES_PATH', FOTON_INSTAGRAM_ABS_PATH . '/shortcodes' );
define( 'FOTON_INSTAGRAM_SHORTCODES_URL_PATH', FOTON_INSTAGRAM_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'foton_instagram_theme_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function foton_instagram_theme_installed() {
        return defined( 'MIKADO_ROOT' );
    }
}

if ( ! function_exists( 'foton_instagram_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function foton_instagram_feed_text_domain() {
		load_plugin_textdomain( 'foton-instagram-feed', false, FOTON_INSTAGRAM_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'foton_instagram_feed_text_domain' );
}