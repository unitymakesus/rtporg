<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/2/14
 * Time: 3:59 PM
 * To change this template use File | Settings | File Templates.
 */
interface AbtConfigReaderInterface {

    /**
     * Read config.
     *
     * @param string $key
     * @return mixed
     */
    public function get_config( $key = '' );
}