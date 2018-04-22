<?php

namespace NikolayS93\AdminSettings;

if ( ! defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly

if( '/wp-admin/update-core.php' !== $_SERVER['REQUEST_URI'] && empty($_COOKIE[ Utils::get_cookie_name() ]) ) {
    if( apply_filters( 'NikolayS93\AdminSettings\DisableUpdates', true ) ) {
        add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
        add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
        remove_action( 'wp_version_check', 'wp_version_check' );
        remove_action( 'admin_init', '_maybe_update_core' );
        add_filter( 'pre_transient_update_core', '__return_null');
        add_filter( 'pre_site_transient_update_core', '__return_null');
        wp_clear_scheduled_hook( 'wp_version_check' );

        remove_action( 'load-plugins.php', 'wp_update_plugins' );
        remove_action( 'load-update.php', 'wp_update_plugins' );
        remove_action( 'load-update-core.php', 'wp_update_plugins' );
        remove_action( 'admin_init', '_maybe_update_plugins' );
        remove_action( 'wp_update_plugins', 'wp_update_plugins' );
        add_filter( 'pre_transient_update_plugins', '__return_null' );
        add_filter( 'pre_site_transient_update_plugins', '__return_null' );
        wp_clear_scheduled_hook( 'wp_update_plugins' );

        remove_action( 'load-themes.php', 'wp_update_themes' );
        remove_action( 'load-update.php', 'wp_update_themes' );
        remove_action( 'load-update-core.php', 'wp_update_themes' );
        remove_action( 'admin_init', '_maybe_update_themes' );
        remove_action( 'wp_update_themes', 'wp_update_themes' );
        add_filter( 'pre_transient_update_themes', '__return_null' );
        add_filter( 'pre_site_transient_update_themes', '__return_null' );
        wp_clear_scheduled_hook( 'wp_update_themes' );
    }
}

// for disable
// add_filter( 'NikolayS93\AdminSettings\DisableUpdates', '__return_false', 10, 1 );
