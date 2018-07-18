<?php

namespace NikolayS93\AdminSettings;

if ( ! defined( 'ABSPATH' ) )
  exit; // disable direct access

class Utils
{
    private static $options;
    private function __construct() {}
    private function __clone() {}

    public static function get_cookie_name() {

        return apply_filters("get_{DOMAIN}_cookie_name", DOMAIN);
    }

    /**
     * Получает название опции плагина
     *     Чаще всего это название плагина
     *     Чаще всего оно используется как название страницы настроек
     * @return string
     */
    public static function get_option_name() {

        return apply_filters("get_{DOMAIN}_option_name", DOMAIN);
    }

    /**
     * Получает настройку из self::$options || из кэша || из базы данных
     * @param  mixed  $default Что вернуть если опции не существует
     * @return mixed
     */
    private static function get_option( $default = array() )
    {
        if( ! self::$options )
            self::$options = get_option( self::get_option_name(), $default );

        return apply_filters( "get_{DOMAIN}_option", self::$options );
    }

    /**
     * Получаем url (адресную строку) до плагина
     * @param  string $path путь должен начинаться с / (по аналогии с __DIR__)
     * @return string
     */
    public static function get_plugin_url( $path = '' ) {

        return apply_filters( "get_{DOMAIN}_plugin_url",
            plugins_url( basename(PLUGIN_DIR) ) . $path, $path );
    }

    /**
     * Получает параметр из опции плагина
     * @todo Добавить фильтр
     *
     * @param  string  $prop_name Ключ опции плагина
     * @param  mixed   $default   Что возвращать, если параметр не найден
     * @return mixed
     */
    public static function get( $prop_name, $default = false )
    {
        $option = self::get_option();

        return isset( $option[ $prop_name ] ) ? $option[ $prop_name ] : $default;
    }

    /**
     * Установить параметр в опцию плагина
     * @todo Подумать, может стоит сделать $autoload через фильтр, а не параметр
     *
     * @param mixed  $prop_name Ключ опции плагина || array(параметр => значение)
     * @param string $value     значение (если $prop_name не массив)
     * @param string $autoload  Подгружать опцию автоматически @see update_option()
     * @return bool             Совершились ли обновления @see update_option()
     */
    public static function set( $prop_name, $value = '', $autoload = null )
    {
        $option = self::get_option();
        if( ! is_array($prop_name) ) $prop_name = array($prop_name => $value);

        foreach ($prop_name as $prop_key => $prop_value) {
            $option[ $prop_key ] = $prop_value;
        }

        return update_option( self::get_option_name(), $option, $autoload );
    }

    /**
     * Получить настройки из файла
     * @param  string $filename Название файла в папке настроек ex. 'main.php'
     * @param  array  $args     Параметры что нужно передать в файл настроек
     * @return mixed
     */
    public static function get_settings( $filename, $args = array() ) {
        $filename = PLUGIN_DIR . '/includes/settings/' . $filename . '.php';
        if( file_exists( $filename ) )
            return include $filename;

        return false;
    }
}