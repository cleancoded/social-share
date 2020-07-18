<?php

/*
Plugin Name: Cleancoded Social Share
Plugin URI: https://www.cleancoded.com
Description: Sharing buttons that doesn't track user behaviour.
Version: 1.0
Author: Cleancoded
Author URI: https://www.cleancoded.com
*/

//Include functions file with all necessary code
require_once  'functions.php';


//Setup plugin options on activation
if( class_exists( 'CleancodedSSSetup' ) ) {
    $SocialShares = new CleancodedSSSetup();

    //Call Activation method plugin activation
    register_activation_hook( __FILE__, array( &$SocialShares, 'SocialShareActivate') );
}

//Load Textdomain after plugin is loaded
add_action( 'plugins_loaded', 'CLEANCODED_load_textdomain' );

/**
 * Load plugin textdomain.
 *
 * @since 1.0
 */
function CLEANCODED_load_textdomain() {
    load_plugin_textdomain( 'cleancoded-ssb', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

//Initialize Frontend/Admin
$adminInstance = new CleancodedSSAdmin();
$frontendInstance = new CleancodedSSFrontend();
