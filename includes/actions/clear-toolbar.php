<?php

namespace NikolayS93\AdminSettings;

if ( ! defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly

if( empty($_COOKIE[ Utils::get_cookie_name() ]) )
    add_action('admin_bar_menu', __NAMESPACE__ . '\clear_toolbar_menu', 999);

function clear_toolbar_menu( $wp_admin_bar ) {
    // $wp_admin_bar->remove_node( 'my-account' ); // ссылка на меню профиля (при отключенных граватарах)
    // $wp_admin_bar->remove_node( 'my-account-with-avatar' ); // ссылка на меню профиля (граватары включены)
    // $wp_admin_bar->remove_node( 'my-blogs' ); // ссылка на меню "мои сайты"
    // $wp_admin_bar->remove_node( 'get-shortlink' ); //  меню "короткая ссылка" для текущей записи
    // $wp_admin_bar->remove_node( 'edit' ); // меню "редактировать запись"
    // $wp_admin_bar->remove_node( 'new-content' ); // меню "новый материал"
    $wp_admin_bar->remove_node( 'comments' ); // меню "комментарии"
    $wp_admin_bar->remove_node( 'appearance' ); // меню "внешний вид"
    $wp_admin_bar->remove_node( 'updates' ); // меню "обновления"
}

if( $yoast = false ) {
    add_action('admin_bar_menu', __NAMESPACE__ . '\clear_toolbar_yoast', 999);
    function clear_toolbar_yoast( $wp_admin_bar ) {
        $wp_admin_bar->remove_node( 'wpseo-menu' ); // hide yoast seo
    }

    add_action('admin_head', 'clear_yoast', 999);
    function clear_yoast() {
        echo '<style>.yoast-seo-score.content-score,.yoast-seo-score.keyword-score,#wpseo-filter{display:none;}</style>';
    }
}
