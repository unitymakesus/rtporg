<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/3/14
 * Time: 10:52 AM
 * To change this template use File | Settings | File Templates.
 */
class SircusFeedAjaxHandler extends AbtAjaxHandler
{
    /**
     * @var
     */
    protected $_feed;

    /**
     * @param mixed $feed
     */
    public function setFeed($feed)
    {
        $this->_feed = $feed;
    }

    /**
     * @return mixed
     */
    public function getFeed()
    {
        return $this->_feed;
    }

    /**
     * @param array $options
     * @return bool|null
     */
    public function handle( $options = array() )
    {
        $feed = $this->getFeed();

        return
            $this->_process( $feed, $options );
    }

    /**
     * make request, process response
     *
     * @param array $options
     * @return bool|null
     */
    private function _process( $feed, $options = array() )
    {
        // Get data from feed
        $data = isset( $feed ) ? $feed->fetch( $options ) : null;

        return $data;
    }
}