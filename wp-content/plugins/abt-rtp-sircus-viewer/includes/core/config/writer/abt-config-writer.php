<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/2/14
 * Time: 3:59 PM
 * To change this template use File | Settings | File Templates.
 */
interface AbtConfigWriterInterface {

    /**
     * Read config.
     *
     * @param string $key
     * @param mixed $data
     * @return mixed
     */
    public function save_config( $key = '',  $value );
}