<?php

namespace NikolayS93\AdminSettings;

$form = array(
    array(
        'type'  => 'checkbox',
        'id'    => 'dash][normal][dashboard_incoming_links',
        'label' => __('Show incoming links widget', DOMAIN), // Входящие ссылки
    ),
    array(
        'type'  => 'checkbox',
        'id'    => 'dash][normal][dashboard_recent_comments',
        'label' => __('Show recent comments widget', DOMAIN), // Последние комментарии
    ),
    array(
        'type'  => 'checkbox',
        'id'    => 'dash][normal][dashboard_plugins',
        'label' => __('Show recent plugins widget', DOMAIN), // Последние Плагины
    ),
    array(
        'type'  => 'checkbox',
        'id'    => 'dash][normal][dashboard_right_now',
        'label' => __('Show "right now" (Site status) widget', DOMAIN), // Статус сайта
    ),
    array(
        'type'  => 'checkbox',
        'id'    => 'dash][side][dashboard_quick_press',
        'label' => __('Show "right now" (Site status) widget', DOMAIN), // Быстрая публикация
    ),
    array(
        'type'  => 'checkbox',
        'id'    => 'dash][side][dashboard_recent_drafts',
        'label' => __('Show "right now" (Site status) widget', DOMAIN), // Последние черновики
    ),
    array(
        'type'  => 'checkbox',
        'id'    => 'dash][side][dashboard_primary',
        'label' => __('Show "right now" (Site status) widget', DOMAIN), // Блог WordPress
    ),
    array(
        'type'  => 'checkbox',
        'id'    => 'dash][side][dashboard_secondary',
        'label' => __('Show "right now" (Site status) widget', DOMAIN), // Другие Новости WordPress
    ),
);

return $form;