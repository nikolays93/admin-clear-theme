<?php

namespace NikolayS93\AdminSettings;

$form = array(
	// array(
	// 	'type'      => 'checkbox',
	// 	'id'        => 'check_updates',
	// 	'label'		=> __('Allow updates', DOMAIN),
	// 	'desc'      => __('Allow WordPress to check for updates and indicate that They are available.', DOMAIN),
	// 	),
	array(
		'type'      => 'checkbox',
		'id'        => 'clear_dash',
		'label'		=> __('Show all dashboard elements', DOMAIN),
		'desc'      => __('Show all built in dashboard elements', DOMAIN),
		),
	array(
		'type'      => 'checkbox',
		'id'        => 'clear_toolbar',
		'label'		=> __('Show all toolbar elements', DOMAIN),
		'desc'      => __('Show all built in toolbar links', DOMAIN),
		),
	array(
		'type'      => 'checkbox',
		'id'        => 'pre_menu',
		'label'		=> __('Show hidden menu items', DOMAIN),
		'desc'      => '',
		),
	array(
		'type'      => 'checkbox',
		'id'        => 'pre_sub_menu',
		'label'		=> __('Show hidden sub menu items', DOMAIN),
		'desc'      => '',
		),
	array(
		'type'      => 'hidden',
		'id'        => 'menu',
		),
	array(
		'type'      => 'hidden',
		'id'        => 'sub_menu',
		)
	);

return $form;