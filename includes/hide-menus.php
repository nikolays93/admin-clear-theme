<?php

namespace CDevelopers\AdminClearTheme;

if ( ! defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly

/**
 * Hide menu
 */
function hide_menus_init() {
    if( 'on' !== Utils::get('pre_menu') && ($menu_str = Utils::get('menu')) ) {
        foreach (explode(',', $menu_str) as $menu) {
            if( empty( $menu ) ) continue;

            $menu = str_replace("admin.php?page=", "", $menu);

            remove_menu_page( apply_filters( 'clear_page_hide_menu', $menu ) );
        }
    }
}

/**
 * Hide submenu
 */
function hide_submenus_init() {
    if( 'on' !== Utils::get('pre_sub_menu') && ($sub_menu_str = Utils::get('sub_menu')) ) {
        foreach (explode(',', $sub_menu_str) as $sub_menu) {
            if( empty( $sub_menu ) ) continue;

            $sub_menu = str_replace("admin.php?page=", "", $sub_menu);
            $group = explode('>', $sub_menu);

            if( empty( $group[1] ) ) continue; // на случай ошибки
            remove_submenu_page(
                apply_filters( 'clear_page_hide_submenu_parent', $group[0] ),
                apply_filters( 'clear_page_hide_submenu', $group[1] ) );
        }
    }
}

// echo "<pre style='padding-left: 150px'>";
// var_dump( Utils::get('menu') );
// echo "</pre>";
$page = isset($_GET['page']) ? $_GET['page'] : false;
if( empty($_COOKIE['developer']) && $page !== Utils::get_option_name() ) {

    add_action( 'admin_menu', __NAMESPACE__ . '\hide_menus_init', 9999 );
    add_action( 'admin_menu', __NAMESPACE__ . '\hide_submenus_init', 9999 );
}
