<?php

namespace NikolayS93\AdminSettings;

$form = array(
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