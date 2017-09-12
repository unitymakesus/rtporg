<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/2/14
 * Time: 3:21 PM
 * To change this template use File | Settings | File Templates.
 */
class WordPressAbtFeedCacheRequest extends AbtFeedRequest
{
    /**
     *
     */
    const TRANSIENT_KEY = 'sircus_viewer_cache';

    /**
     *
     */
    const CACHE_LIFETIME_DEFAULT = 60;

    /**
     *
     */
    const LIMIT_KEY_LENGTH = 45;

    /**
     * @var bool
     */
    protected $_enabled = true;

    /**
     * @var int
     */
    protected $_cache_lifetime = self::CACHE_LIFETIME_DEFAULT;

    /**
     * @var
     */
    protected $_request;

    /**
     * @var
     */
    protected $_cache_hit = false;

    /**
     * @param mixed $request
     */
    public function setRequest( $request )
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
     * @param int $cache_lifetime
     */
    public function setCacheLifetime( $cache_lifetime = self::CACHE_LIFETIME_DEFAULT )
    {
        $this->_cache_lifetime = $cache_lifetime;
    }

    /**
     * @return int
     */
    public function getCacheLifetime()
    {
        return $this->_cache_lifetime;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->_enabled = $enabled;
    }

    /**
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->_enabled;
    }

    /**
     * @return
     */
    public function enable() {
        $this->setEnabled( true );
    }

    /**
     * @return
     */
    public function disable() {
        $this->setEnabled( false );
    }

    /**
     * @return boolean
     */
    public function isEnabled() {
        return $this->getEnabled();
    }

    /**
     * @param array $options
     * @return bool|mixed
     */
    public function fetch( $options = array() )
    {
        $request = $this->getRequest();

        $this->_setCacheMiss();

        $key = md5(implode('_',$options));

        $options['key'] = $key;

        // Case 1: No request object provided
        if ( !isset( $request ) )
            return false;

        // Case 2: Request object provided, but cache is disabled
        if ( !$this->isEnabled() ) {
            $this->_delete( $key );
            $data = $request->fetch( $options );
            return $data;
        }

        // Case 3: Request object provided, cache is enabled
        //if ( true || false === ( $data = $this->_retrieve( $key ) ) ) {
        if ( false === ( $data = $this->_retrieve( $key ) ) ) {
            // The cache is empty, yo'
            $data = $request->fetch($options);
            $this->_store( $key, $data, $this->getCacheLifetime() );
            $data = $this->_injectCacheInfo( $data, $options );
            return $data;
        } else {
            $this->_setCacheHit();
            $data = $this->_injectCacheInfo( $data, $options );
            return $data;
        }
    }

    /**
     * @param $key
     * @return bool
     */
    private function _delete( $key )
    {
        return delete_transient( $this->_makeKey( $key ) );
    }

    /**
     * @param $key
     * @return mixed
     */
    private function _retrieve( $key )
    {
        $data = get_transient( $this->_makeKey( $key ) );
        return $data && strlen( $data ) > 0 ? json_decode( $data  ) : false;
    }

    /**
     * @param $key
     * @param $data
     * @param $lifetime
     * @return bool
     */
    private function _store( $key, $data, $lifetime )
    {
        return set_transient( $this->_makeKey( $key ), json_encode( $data ), $lifetime );
    }

    /**
     * @param $key
     * @return string
     */
    private function _makeKey( $key )
    {
        return substr( self::TRANSIENT_KEY . $key, 0, self::LIMIT_KEY_LENGTH );
    }

    /**
     * @param $value
     * @return bool
     */
    public function update( $value )
    {
        if (!$this->isEnabled()) {
            return false;
        }

        return
            set_transient(
                self::TRANSIENT_KEY, $value,
                $this->getCacheLifetime()
            );
    }


    /**
     * @return bool
     */
    public function refresh()
    {
        if ( $this->isEnabled() && false !== ( $value = $this->fetch() ) ) {
            $this->update( $value );
        } else {
            return false;
        }
    }

    /**
     *
     */
    public function initialize()
    {
        $configReader  = $this->getConfigReader();
        $request       = $this->getRequest();

        if ( isset( $config ) && isset( $request ) ) {
            $request->setConfigReader( $configReader );
            $request->initialize();
        }
    }

    /**
     *
     */
    private function _setCacheHit()
    {
        $this->_cache_hit = true;
    }

    /**
     *
     */
    private function _setCacheMiss()
    {
        $this->_cache_hit = false;
    }

    /**
     * @return bool
     */
    public function getCacheHit()
    {
        return $this->_cache_hit;
    }

    /**
     * @param $data
     * @return bool
     */
    private function _requestDataHasCache( $data )
    {
        return
            $this->isEnabled() &&
            $this->getCacheHit() &&
            isset( $data->cache);
    }


    /**
     * @param $data
     */
    private function _injectCacheInfo( $data, $options = array() )
    {
        $cache = new StdClass;

        $cache->hit     = $this->getCacheHit();
        $cache->enabled = $this->isEnabled() ? true : false;

        if ( $this->isEnabled()) {
            $cache->lifetime  = $this->getCacheLifetime();
            $cache->timestamp = time();
            $cache->until     = time() + $this->getCacheLifetime();
        }

        $cache->options = $options;

        if (is_array($data)) {
            $data['cache'] = $cache;
        } else {
            $data->cache = $cache;
        }

        return $data;
    }
}