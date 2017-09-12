<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/3/14
 * Time: 10:52 AM
 * To change this template use File | Settings | File Templates.
 */
class SircusPartialAjaxHandler extends AbtAjaxHandler
{

    /**
     * @param array $options
     * @return bool|null
     */
    public function handle( $options = array() )
    {
        return
            $this->_process( $options );
    }

    /**
     * make request, process response
     *
     * @param array $options
     * @return bool|null
     */
    public function _process( $options = array() )
    {
        $partial = isset( $options['partial'] ) ? $this->_extractPartial( $options['partial'] ) : '';
        return isset( $feed ) ? $feed->fetch( $options ) : null;
    }

    private function _extract_partial( $partial = array() )
    {
        $type   = isset( $partial['type'] ) ? $partial['type'] : '';
        $status = isset( $partial['status'] ) ? $partial['status'] : '';
    }
}