<?php

namespace NikolayS93\AdminSettings;

use NikolayS93\WPAdminFormBeta\Form;

if ( ! defined( 'ABSPATH' ) )
    exit; // disable direct access

class AdminSettingsPage
{
    function __construct()
    {
        $page = new WP_Admin_Page( Utils::get_option_name() );
        $page->set_args( array(
            'parent' => 'options-general.php',
            'title' => __('Admin settings.', DOMAIN),
            'menu' => __('Admin settings', DOMAIN),
            'callback'    => array(__CLASS__, 'page_render'),
            'permissions' => 'manage_options',
            'tab_sections'=> null,
            'columns'     => 1,
        ) );

        $page->set_assets( array($this, '_assets') );
    }

    /**
     * Подключает CSS и JS на административные страницы
     */
    function _assets()
    {
        $ver = false;
        if( is_file(PLUGIN_DIR . '/' . DOMAIN . '.php') ) {
            $plugin_info = get_plugin_data(PLUGIN_DIR . '/' . DOMAIN . '.php');
            $ver = $plugin_info['Version'];
        }

        wp_enqueue_style( 'admin-settings-style',
            Utils::get_plugin_url('/assets/admin.css'), array(), $ver );
        wp_enqueue_script( 'admin-settings-script',
            Utils::get_plugin_url('/assets/admin.js'),  array('jquery'), $ver, true );

        wp_localize_script( 'admin-settings-script',
            'admin_settings', array(
                'menu' => Utils::get( 'menu' ),
                'sub_menu' => Utils::get( 'sub_menu' ),
                'cookie_name' => Utils::get_cookie_name(),
            )
        );
    }

    /**
     * Основное содержимое страницы
     *
     * @access
     *     must be public for the WordPress
     */
    static function page_render()
    {
        printf('<p><input type="button" id="admin_mode" class="button%s" value="%s"></p>',
            esc_attr( !empty($_COOKIE[ Utils::get_cookie_name() ]) ? ' button-primary' : '' ),
            __( 'Set super-admin mode in my browser', DOMAIN )
        );

        $form = new Form( Utils::get_settings( 'global' ), true );
        $form->display();

        submit_button( 'Сохранить', 'primary', 'save_changes' );

        echo '<input type="hidden" name="page[]" value="project-settings" />';
    }
}
new AdminSettingsPage();
