<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/4/14
 * Time: 11:32 AM
 * To change this template use File | Settings | File Templates.
 */
abstract class AbtRequestParser
{
    /**
     * @param $response
     * @param array $options
     * @return mixed
     */
    abstract public function parse( $response, $options = array() );
}