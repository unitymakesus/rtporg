<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/5/14
 * Time: 9:51 AM
 * To change this template use File | Settings | File Templates.
 */
class WordPressLocalizableFactory
{
    /**
     *
     */
    const INSTANCE_CLASS_NAME = 'WordPressLocalizable';

    /**
     * @var array
     */protected $_handles;

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
     * @param $handle
     * @param $class_name
     * @return bool
     */public function register( $handle, $class_name )
    {
        if ( $this->_validClass( $class_name ) ) {
            $handles = $this->getHandles();
            $handles[$handle] = $class_name;
            $this->setHandles( $handles );
            return true;
        }

        return false;
    }

    /**
     * @param $class_name
     * @return bool
     */private function _validClass( $class_name )
    {
        return
            class_exists( $class_name ) &&
            is_subclass_of( $class_name, self::INSTANCE_CLASS_NAME );
    }

    /**
     * @param mixed $handles
     */
    public function setHandles($handles)
    {
        $this->_handles = $handles;
    }

    /**
     * @return mixed
     */
    public function getHandles()
    {
        if ( !isset( $this->_handles ) || !is_array( $this->_handles ) )
            $this->setHandles( array() );

        return $this->_handles;
    }

    public function getHandle( $handle )
    {
        $handles = $this->getHandles();

        return
            $this->hasHandle( $handle ) ?
                $handles[$handle] :
                false;
    }

    public function hasHandle( $handle )
    {
        $handles = $this->getHandles();

        return  isset( $handles[$handle] );
    }


    /**
     * Generate WP Localizable object.
     *
     * Currently Type is unused, but may be implemented later to
     * perform runtime selection of appropriate WordPressLocalizable
     * sub-class(es).
     *
     * Data is used to populate the object's data members.
     *
     * @param string $type
     * @param array $data
     * @return WordPressLocalizable
     */
    public function get_instance( $type = '', $data = array() )
    {
        $localizable = $this->_getLocalizableObject( $type );

        foreach ( $data as $key => $value ) {
            $localizable->$key = $value;
        }

        $localizable->setConfigReader( $this->getConfigReader() );

        return $localizable;
    }

    private function _getLocalizableObject( $type )
    {
        if ( $this->hasHandle( $type ) ) {
            $type = $this->getHandle( $type );
            return new $type();
        }

        return new WordPressLocalizable();
    }
}