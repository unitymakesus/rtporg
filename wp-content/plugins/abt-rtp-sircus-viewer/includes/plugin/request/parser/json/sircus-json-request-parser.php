<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/4/14
 * Time: 11:32 AM
 * To change this template use File | Settings | File Templates.
 */
class SircusJsonRequestParser extends AbtRequestParser
{
    public function parse( $response, $options = array() ) {
        return json_decode( $response );
    }
}