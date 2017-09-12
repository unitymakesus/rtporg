<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/2/14
 * Time: 5:18 PM
 * To change this template use File | Settings | File Templates.
 */
class WordPressOptionConfigReader implements AbtConfigReaderInterface {
    /**
     * Read config.
     *
     * @param string $key
     * @return mixed
     */
    public function get_config( $key = '' )
    {
        return get_option( $key, null );
    }
}