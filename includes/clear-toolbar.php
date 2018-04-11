<?php

namespace NikolayS93\AdminSettings;

if ( ! defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly

function clear_toolbar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'appearance' );
    $wp_admin_bar->remove_node( 'comments' );
    $wp_admin_bar->remove_node( 'updates' );
    $wp_admin_bar->remove_node( 'wpseo-menu' ); // hide yost seo
}

function clear_yoast_from_toolbar() {
    echo '<style>.yoast-seo-score.content-score,.yoast-seo-score.keyword-score,#wpseo-filter{display:none;}</style>';
}

if( ! Utils::get('clear_toolbar') ) {
    add_action('admin_bar_menu', __NAMESPACE__ . '\clear_toolbar', 666);
    add_action('admin_head', __NAMESPACE__ . '\clear_yoast_from_toolbar');
}
