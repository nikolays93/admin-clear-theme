<?php

namespace NikolayS93\AdminSettings;

if ( ! defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly

if( empty($_COOKIE[ Utils::get_cookie_name() ]) )
    add_action('wp_dashboard_setup', __NAMESPACE__ . '\clear_dash' );

function clear_dash() {
    $clear = Utils::get('clear_dash');

    $normal = &$GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];
    $side = &$GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];

    unset($normal['dashboard_incoming_links']); //Входящие ссылки
    unset($normal['dashboard_recent_comments']); //Последние комментарии
    unset($normal['dashboard_plugins']);  //Последние Плагины
    if( ! current_user_can( 'edit_pages' ) ) {
        unset($normal['dashboard_right_now']); // Site status
    }

    unset($side['dashboard_quick_press']); //Быстрая публикация
    unset($side['dashboard_recent_drafts']); // Последние черновики
    unset($side['dashboard_primary']); //Блог WordPress
    unset($side['dashboard_secondary']); //Другие Новости WordPress
}
