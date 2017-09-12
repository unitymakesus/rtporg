<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/2/14
 * Time: 3:18 PM
 * To change this template use File | Settings | File Templates.
 */
abstract class AbtFeedRequest
{
    /**
     * @var
     */
    protected $_parser;

    /**
     * @var
     */
    protected $_uri;

    /**
     * @param mixed $parameters
     */
    public function setParameters($parameters)
    {
        $this->_parameters = $parameters;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->_parameters;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri)
    {
        $this->_uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * @var
     */
    protected $_parameters;

    /**
     * @param mixed $parser
     */
    public function setParser($parser)
    {
        $this->_parser = $parser;
    }

    /**
     * @return mixed
     */
    public function getParser()
    {
        return $this->_parser;
    }

    /**
     * @param array $options
     * @return mixed
     */
    abstract public function fetch( $options = array() );
}