<?php

namespace NikolayS93\AdminSettings;

use NikolayS93\WPAdminFormBeta\Form;
use NikolayS93\WPAdminPageBeta as Admin;
// use NikolayS93\WPAdminPageBeta\Page;
// use NikolayS93\WPAdminPageBeta\Callback;

if ( ! defined( 'ABSPATH' ) )
    exit; // disable direct access

class AdminSettingsPage
{
    function __construct()
    {
        $page = new Admin\Page( Utils::get_option_name(), __('Admin settings.', DOMAIN), array(
            'parent' => 'options-general.php',
            'menu' => __('Admin settings', DOMAIN),
            // 'callback' => array(__CLASS__, 'page_render'),
            // 'validate' => callback,
            'permissions' => 'manage_options',
            'columns'     => 1,
        ) );

        $page->set_assets( new Admin\Callback( array($this, '__assets') ) );

        $page->set_content( new Admin\Callback( array($this, 'page_render') ) );

        // $page->add_metabox( new Metabox( 'MetaboxID', __('Metabox Title'), array($this, 'callback'),
        //     $position = 'normal', $priority = 'high' ) );

        $page->add_section( new Admin\Section(
            'Console',
            __('Console'),
            new Admin\Callback( array($this, 'console_section') )
        ) );

        $page->add_section( new Admin\Section(
            'Toolbar',
            __('Toolbar'),
            new Admin\Callback( array($this, 'toolbar_section') )
        ) );

        $page->add_section( new Admin\Section(
            'Menu',
            __('Menu'),
            new Admin\Callback( array($this, 'menu_section') )
        ) );
    }

    /**
     * Основное содержимое страницы
     *
     * @access
     *     must be public for the WordPress
     */
    static function page_render()
    {
        echo "<p>Эти настройки позволяют скрыть не раскрытый функционал WordPress. Если вы хотите отключить все функции для вашего браузера, воспользуйтесь следующей кнопкой.</p>";

        printf('<p><input type="button" id="admin_mode" class="button%s" value="%s"></p>',
            esc_attr( !empty($_COOKIE[ Utils::get_cookie_name() ]) ? ' button-primary' : '' ),
            __( 'Set super-admin mode in my browser', DOMAIN )
        );

        // echo '<input type="hidden" name="page" value="project-settings" />';
    }

    /**
     * Подключает CSS и JS на административные страницы
     */
    function __assets()
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

    function console_section()
    {
        $form = new Form( Utils::get_settings( 'console' ), true );
        $form->display();

        submit_button( 'Сохранить', 'primary', 'save_changes' );
    }

    function toolbar_section()
    {
        $form = new Form( Utils::get_settings( 'toolbar' ), true );
        $form->display();

        submit_button( 'Сохранить', 'primary', 'save_changes' );
    }

    function menu_section()
    {
        $form = new Form( Utils::get_settings( 'menu' ), true );
        $form->display();

        submit_button( 'Сохранить', 'primary', 'save_changes' );
    }
}
new AdminSettingsPage();
