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

/**
 * Хуки плагина:
 * $pageslug . _after_title (default empty hook)
 * $pageslug . _before_form_inputs (default empty hook)
 * $pageslug . _inside_page_content
 * $pageslug . _inside_side_container
 * $pageslug . _inside_advanced_container
 * $pageslug . _after_form_inputs (default empty hook)
 * $pageslug . _after_page_wrap (default empty hook)
 *
 * Фильтры плагина:
 * "get_{DOMAIN}_option_name" - имя опции плагина
 * "get_{DOMAIN}_option" - значение опции плагина
 * "load_{DOMAIN}_file_if_exists" - информация полученная с файла
 * "get_{DOMAIN}_plugin_dir" - Дирректория плагина (доступ к файлам сервера)
 * "get_{DOMAIN}_plugin_url" - УРЛ плагина (доступ к внешним файлам)
 *
 * $pageslug . _form_action - Аттрибут action формы на странице настроек плагина
 * $pageslug . _form_method - Аттрибут method формы на странице настроек плагина
 *
 * clear_page_hide_menu
 * clear_page_hide_submenu_parent
 * clear_page_hide_submenu
 *
 * NikolayS93\AdminSettings\DisableUpdates
 */

namespace NikolayS93\AdminSettings;

if ( ! defined( 'ABSPATH' ) )
  exit; // disable direct access

const PLUGIN_DIR = __DIR__;
const DOMAIN = 'admin-settings';

__('Admin Settings', DOMAIN);
__('Hidding unused Wordpress admin functionality', DOMAIN);

// Нужно подключить заранее для активации и деактивации плагина @see activate(), uninstall();
require __DIR__ . '/utils.php';

class Plugin
{
    private static $initialized;
    private function __construct() {}

    static function activate()
    {
        $defaults = apply_filters( 'project_settings_activate', array(
            'menu'     => 'edit-comments.php,users.php,tools.php,',
            'sub_menu' => 'index.php>index.php,index.php>update-core.php,edit.php?post_type=shop_order>edit.php?post_type=shop_order,edit.php?post_type=shop_order>edit.php?post_type=shop_coupon,edit.php?post_type=shop_order>admin.php?page=wc-reports,options-general.php>options-discussion.php,',
        ) );

        add_option( Utils::get_option_name(), $defaults );
    }

    static function uninstall() { delete_option( Utils::get_option_name() ); }

    public static function initialize()
    {
        if( self::$initialized )
            return false;

        load_plugin_textdomain( DOMAIN, false, basename(PLUGIN_DIR) . '/languages/' );
        self::include_required_files();
        Utils::get_plugin_dir('/includes/filters.php');

        self::$initialized = true;
    }

    /**
     * Подключение файлов нужных для работы плагина
     */
    private static function include_required_files()
    {
        $plugin_dir = Utils::get_plugin_dir();

        $classes = array(
            'NikolayS93\WPAdminForm\Version' => $plugin_dir . '/vendor/nikolays93/WPAdminForm/init.php',
            'NikolayS93\WPAdminPage\Version' => $plugin_dir . '/vendor/nikolays93/WPAdminPage/init.php',
        );

        foreach ($classes as $classname => $path) {
            if( class_exists($classname) ) continue;

            Utils::load_file_if_exists( $path );
        }

        // includes
        Utils::load_file_if_exists( $plugin_dir . '/includes/admin-settings-page.php' );

        if( is_admin() ) {
            Utils::load_file_if_exists( $plugin_dir . '/includes/actions/hide-menus.php' );
            Utils::load_file_if_exists( $plugin_dir . '/includes/actions/clear-dash.php' );
        }

        if( is_user_logged_in() ) {
            Utils::load_file_if_exists( $plugin_dir . '/includes/actions/clear-toolbar.php' );
        }

        Utils::load_file_if_exists( $plugin_dir . '/includes/actions/disable-check-updates.php' );
    }
}

register_activation_hook( __FILE__, array( __NAMESPACE__ . '\Plugin', 'activate' ) );
register_uninstall_hook( __FILE__, array( __NAMESPACE__ . '\Plugin', 'uninstall' ) );
// register_deactivation_hook( __FILE__, array( __NAMESPACE__ . '\Plugin', 'deactivate' ) );

add_action( 'plugins_loaded', array( __NAMESPACE__ . '\Plugin', 'initialize' ), 10 );
