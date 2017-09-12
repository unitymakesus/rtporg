<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/5/14
 * Time: 9:51 AM
 * To change this template use File | Settings | File Templates.
 */
class WordPressLocalizable
{
    /**
     * @var AbtConfigReaderInterface
     */
    protected $_config_reader;

    /**
     * @param mixed $config_reader
     */
    public function setConfigReader($config_reader)
    {
        $this->_config_reader = $config_reader;
    }

    /**
     * @return mixed
     */
    public function getConfigReader()
    {
        return $this->_config_reader;
    }

    /**
     * Performs wp_localize on this object using the provided
     * handle and name (which are passed to wp_localize_script)
     *
     * @param $handle
     * @param $name
     * @return array
     */
    public function localize( $handle, $name )
    {
        $vars = get_object_vars( $this );

        wp_localize_script( $handle, $name, $vars );

        return $vars;
    }

    /**
     *
     */
    public static function expose()
    {
        echo format(get_object_vars( $this ));
    }
}