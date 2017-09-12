<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/2/14
 * Time: 3:11 PM
 * To change this template use File | Settings | File Templates.
 */
class AbtFeedHandler
{
    /**
     *@var int
     */
    const MODE_PRODUCTION  = 1;

    /**
     *@var int
     */
    const MODE_DEVELOPMENT = 2;

    /**
     *@var int
     */
    const MODE_TESTING     = 3;

    /**
     * @var int
     */
    protected $_mode = self::MODE_PRODUCTION;

    /**
     * @var
     */
    protected $_cache;

    /**
     * @var
     */
    protected $_endpoint;

    /**
     * @var
     */
    protected $_parser;

    /**
     * @var
     */
    protected $_renderer;

    /**
     * @var
     */
    protected $_request;

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
     * @param mixed $renderer
     */
    public function setRenderer($renderer)
    {
        $this->_renderer = $renderer;
    }

    /**
     * @return mixed
     */
    public function getRenderer()
    {
        return $this->_renderer;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->_request = $request;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->_endpoint = $endpoint;
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->_endpoint;
    }

    /**
     * @param mixed $cache
     */
    public function setCache($cache)
    {
        $this->_cache = $cache;
    }

    /**
     * @return mixed
     */
    public function getCache()
    {
        return $this->_cache;
    }

    /**
     * @param mixed $mode
     */
    public function setMode($mode)
    {
        $this->_mode = $mode;
    }

    /**
     * @return mixed
     */
    public function getMode()
    {
        return $this->_mode;
    }

    /**
     *
     */
    public function fetch( $options = array() )
    {
        $request = $this->getRequest();

        if ( isset( $request ) ) {
            $content = $request->fetch( $options );
            return $this->_process( $content, $options );
        }
    }

    protected function _process( $content, $options = array() )
    {
        $parser   = $this->getParser();
        $renderer = $this->getRenderer();

        if (  isset( $parser ) )
            $content = $parser->parse( $options );

        if (  isset( $renderer ) )
            $content = $renderer->render( $options );

        return $content;
    }
}