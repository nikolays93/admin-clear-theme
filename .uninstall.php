<?php

namespace NikolayS93\AdminSettings;

if ( ! defined( 'ABSPATH' ) )
  exit; // disable direct access

register_uninstall_hook( __FILE__, __NAMESPACE__ . '\uninstall' );
function uninstall() {
    delete_option( Utils::get_option_name() );
}
