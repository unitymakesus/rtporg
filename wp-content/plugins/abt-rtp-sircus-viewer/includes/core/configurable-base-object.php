<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/2/14
 * Time: 3:11 PM
 * To change this template use File | Settings | File Templates.
 */
class ConfigurableBaseObject
{
    /**
     * @var
     */
    private $_configReader;

    /**
     * @var
     */
    private $_configWriter;

    /**
     * @param mixed $configReader
     */
    public function setConfigReader($configReader)
    {
        $this->_configReader = $configReader;
    }

    /**
     * @return mixed
     */
    public function getConfigReader()
    {
        return $this->_configReader;
    }

    /**
     * @param mixed $configWriter
     */
    public function setConfigWriter($configWriter)
    {
        $this->_configWriter = $configWriter;
    }

    /**
     * @return mixed
     */
    public function getConfigWriter()
    {
        return $this->_configWriter;
    }

    /**
     *
     */
    public function initialize() {}
}