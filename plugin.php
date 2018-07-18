<?php

/*
Plugin Name: Admin Settings
Plugin URI: https://github.com/nikolays93/admin-settings
Description: Hidding unused Wordpress admin functionality
Version: 1.0
Text Domain: admin-settings
Domain Path: /languages/
Author: NikolayS93
Author URI: https://vk.com/nikolays_93
Author EMAIL: nikolayS93@ya.ru
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

namespace NikolayS93\AdminSettings;

if ( ! defined( 'ABSPATH' ) )
    exit; // disable direct access

const PLUGIN_DIR = __DIR__;
const PLUGIN_FILE = __FILE__;
const DOMAIN = 'admin-settings';

__('Admin Settings', DOMAIN);
__('Hidding unused Wordpress admin functionality', DOMAIN);

require PLUGIN_DIR . '/utils.php';

include PLUGIN_DIR . '/.install.php';
include PLUGIN_DIR . '/.uninstall.php';

add_action( 'plugins_loaded', __NAMESPACE__ . '\initialize', 10 );
function initialize()
{
    load_plugin_textdomain( DOMAIN, false, basename(PLUGIN_DIR) . '/languages/' );

    if( is_admin() ) {
        include( PLUGIN_DIR . '/includes/actions/hide-menus.php' );
        include( PLUGIN_DIR . '/includes/actions/clear-dash.php' );
    }

    if( is_user_logged_in() ) {
        include( PLUGIN_DIR . '/includes/actions/clear-toolbar.php' );
    }

    include( PLUGIN_DIR . '/includes/filters.php' );
    include( PLUGIN_DIR . '/includes/admin-settings-page.php' );
    include( PLUGIN_DIR . '/includes/actions/disable-check-updates.php' );
}
