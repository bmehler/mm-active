<?php
/**
* Plugin Name: Active Plugin
* Plugin URI: http://www.mehler-medial.de
* Description: Zeigt aktivierte und deaktivierte Plugins in einem Dashboard Widget an.
* Version: 0.0.1
* Author: Bernhard Mehler
* Author URI: http://www.mainwp.com
* License: GPL2
* Text Domain: mm-active
*/

namespace MM\Active;

add_action( 'plugins_loaded', 'MM\Active\init' );

function init() {
    loadTextdomain();
    include_once('includes/mm-active-dashboard.php');
    add_action( 'admin_enqueue_scripts', 'MM\Active\register_plugin_styles' );
    add_action('wp_dashboard_setup', 'MM\Active\active_plugins_widget');
}

function loadTextdomain() {
    load_plugin_textdomain( 'mm-active', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

function register_plugin_styles() {
    wp_register_style( 'font-awesome-css', plugins_url('mm-active/assets/font-awesome/css/font-awesome.css'));
    wp_enqueue_style( 'font-awesome-css' );
}
?>