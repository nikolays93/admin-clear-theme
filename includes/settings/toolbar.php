<?php

namespace NikolayS93\AdminSettings;

$form = array(
	array(
		'type'      => 'checkbox',
		'id'        => 'clear_toolbar',
		'label'		=> __('Show all toolbar elements', DOMAIN),
		'desc'      => __('Show all built in toolbar links', DOMAIN),
	),
);

return $form;