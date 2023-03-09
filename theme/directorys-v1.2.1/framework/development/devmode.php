<?php

define('DEV_MODE', false);
define('HT_ENVIRONMENT', 'dev');

if ( defined('DEV_MODE') && DEV_MODE ) {

    error_reporting(E_ALL ^ E_STRICT);

    add_action ('wp_enqueue_scripts', 'wpcs_init');
    add_action ('admin_enqueue_scripts', 'wpcs_init');

}

function wpcs_init() {
    global $wp_scripts;
    if (isset($wp_scripts->registered['jquery']->ver)) {
        $jquery_version = $wp_scripts->registered['jquery']->ver;
        wp_deregister_script ('jquery');
        wp_register_script ('jquery', "http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.js");
    }
}

if ( defined('HT_ENVIRONMENT') && HT_ENVIRONMENT == 'test' ) {

    include_once( HOLO_FRAMEWORK_DIR . '/development/environment.php');

}