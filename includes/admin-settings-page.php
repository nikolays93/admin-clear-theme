<?php

namespace CDevelopers\AdminClearTheme;

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
            'callback'    => array(__CLASS__, 'start_page'),
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

        wp_enqueue_style( 'admin-clear-theme-style', Utils::get_plugin_url('/assets/admin.css'), array(), $ver );
        wp_enqueue_script( 'admin-clear-theme-script', Utils::get_plugin_url('/assets/admin.js'),  array('jquery'), $ver, true );

        wp_localize_script( 'admin-clear-theme-script',
            'menu_disabled', array(
                'menu' => Utils::get( 'menu' ),
                'sub_menu' => Utils::get( 'sub_menu' ),
            )
        );
    }

    /**
     * Основное содержимое страницы
     *
     * @access
     *     must be public for the WordPress
     */
    static function start_page()
    {
        $add_class = (!empty($_COOKIE['developer'])) ? 'button button-primary': 'button';

        echo sprintf('<p><input type="button" id="admin_mode" class="%s" value="%s"></p>',
            esc_attr( $add_class ),
            __( 'Set super-admin mode in my browser', DOMAIN )
        );

        $form = new WP_Admin_Forms(
            Utils::get_settings('global.php'),
            $is_table = true );

        echo $form->render();

        submit_button( 'Сохранить', 'primary', 'save_changes' );

        echo '<input type="hidden" name="page[]" value="project-settings" />';
        echo '<input type="hidden" name="page[]" value="project-settings-start-page" />';
    }
}
new AdminSettingsPage();
