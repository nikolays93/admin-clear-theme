<?php

namespace NikolayS93\AdminSettings;

if ( ! defined( 'ABSPATH' ) )
  exit; // disable direct access

register_activation_hook( PLUGIN_FILE, __NAMESPACE__ . '\install' );
function install() {
    $defaults = apply_filters( 'NikolayS93\AdminSettings\activate', array(
        'menu'     => 'edit-comments.php,users.php,tools.php,',
        'sub_menu' => 'index.php>index.php,index.php>update-core.php,edit.php?post_type=shop_order>edit.php?post_type=shop_order,edit.php?post_type=shop_order>edit.php?post_type=shop_coupon,edit.php?post_type=shop_order>admin.php?page=wc-reports,options-general.php>options-discussion.php,',
    ) );

    add_option( Utils::get_option_name(), $defaults );
}