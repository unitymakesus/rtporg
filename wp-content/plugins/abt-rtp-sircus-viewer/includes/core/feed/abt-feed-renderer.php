<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/3/14
 * Time: 10:52 AM
 * To change this template use File | Settings | File Templates.
 */
class AbtFeedRenderer
{
    public function render( $data, $options = array() )
    {
        // Maybe use include templates/ajax/data.php but for now, just return data
        // no rendering may be needed
        return $data;
    }
}