<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/4/14
 * Time: 12:55 PM
 * To change this template use File | Settings | File Templates.
 */
class WordPressShortCodeHandlerMain extends WordPressShortCodeHandler
{
    // TODO: Major refactoring here, move into class, this is a temp solution
    /**
     * @param $atts
     * @return string
     */
    function handle( $atts ) {


        $atts = shortcode_atts( array(
            'type' => 'list',
        ), $atts );




        ob_start();

        switch ($atts['type']) {
            case 'search':
                include(SIRCUS_VIEWER_PATH_TEMPLATE . 'plugin/viewer/search.php');
                break;
            case 'list':
            default :
                include(SIRCUS_VIEWER_PATH_TEMPLATE . 'plugin/viewer/main.php');
                break;
        }

        $sircusMain = ob_get_contents();

        ob_end_clean();

        return $sircusMain;
    }
}