<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/2/14
 * Time: 3:45 PM
 * To change this template use File | Settings | File Templates.
 *
 * Shamelessly adapted from here: http://codereview.stackexchange.com/questions/4162/php-config-file-loader-class
 */
class AbtConfigObject {

    /**
     * @var null
     */
    private static $_instance = null;

    /**
     * @var array
     */
    public $options = array();

    /**
     * Retrieves php array file, json file, or ini file and builds array
     * @param $filepath Full path to where the file is located
     * @param $type is the type of file.  can be "ARRAY" "JSON" "INI"
     */
    private function __construct( $data = array() )
    {
        $this->_parse( $data );
    }

    /**
     * @param array $data
     */
    private function _parse( $data = array() )
    {
        $data = json_decode( json_encode( $data ) );

        if ( $this->_is_data_valid( $data ) ) {
            foreach ( $data as $key => $value ) {
                $this->__set( $key, $value );
            }
        }
    }

    /**
     * @param $data
     * @return AbtConfigObject|null
     */
    public static function get_instance( $data )
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self( $data );
        }

        return self::$_instance;
    }

    /**
     * @param $data
     * @return bool
     */
    private function _is_data_valid( $data )
    {
        return
            isset($data) &&
            (
                is_array($data) ||
                $data instanceof Traversable ||
                $data instanceof StdClass
            );
    }

    /**
     * Retrieve value with constants being a higher priority
     * @param $key Array Key to get
     */
    public function __get($key)
    {
        return $this->options[$key];
    }

    /**
     * Set a new or update a key / value pair
     * @param $key Key to set
     * @param $value Value to set
     */
    public function __set($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     *
     */
    public static function destroy()
    {
        if ( isset( self::$_instance ) ) {
            self::$_instance = null;
        }
    }
}