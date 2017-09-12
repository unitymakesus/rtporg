<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/4/14
 * Time: 12:55 PM
 * To change this template use File | Settings | File Templates.
 */
abstract class WordPressShortCodeHandler
{
    /**
     * @param $atts
     * @return mixed
     */
    abstract function handle( $atts );
}