<?php

class Filters
{
    function __construct()
    {
        add_filter( 'clear_page_hide_menu', array(__CLASS__, 'woocommerce_shop_order_filter'), 10, 1 );
        add_filter( 'clear_page_hide_submenu_parent', array(__CLASS__, 'woocommerce_shop_order_filter'), 10, 1 );
    }

    static function woocommerce_shop_order_filter( $menu )
    {
        if( 'edit.php?post_type=shop_order' === $menu )
            $menu = 'woocommerce';

        return $menu;
    }
}
new Filters();