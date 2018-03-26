<?php

namespace CDevelopers\AdminClearTheme;

if ( ! defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly

function clear_dash(){
    $side = &$GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];
    $normal = &$GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];

    unset($side['dashboard_quick_press']); //Быстрая публикация
    unset($side['dashboard_recent_drafts']); // Последние черновики
    unset($side['dashboard_primary']); //Блог WordPress
    unset($side['dashboard_secondary']); //Другие Новости WordPress

    unset($normal['dashboard_incoming_links']); //Входящие ссылки
    unset($normal['dashboard_recent_comments']); //Последние комментарии
    unset($normal['dashboard_plugins']); //Последние Плагины
    if( ! current_user_can( 'edit_pages' ) ) {
        unset($normal['dashboard_right_now']);
    }
}

if( ! Utils::get('clear_dash') ) {
    add_action('wp_dashboard_setup', __NAMESPACE__ . '\clear_dash' );
}
