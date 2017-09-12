<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/3/14
 * Time: 10:52 AM
 * To change this template use File | Settings | File Templates.
 */
class SircusFeaturedBannerAjaxHandler extends AbtAjaxHandler
{

    private $_config_writer;

    /**
     * @param AbtConfigWriterInterface $config_writer
     */
    public function setConfigWriter( AbtConfigWriterInterface $config_writer )
    {
        $this->_config_writer = $config_writer;
    }

    /**
     * @return AbtConfigWriterInterface
     */
    public function getConfigWriter()
    {
        return $this->_config_writer;
    }


    /**
     * @param array $options
     * @return bool|null
     */
    public function handle( $options = array() )
    {
        $post_id = $options['post_id'];
        $post = get_post( $post_id, OBJECT );

        // Make sure we're saving a banner
        if ( $post->post_type == 'banner' ) {
            $this->getConfigWriter()->save_config( 'featured-banner', $post_id );
            return array( 'post' => $post_id );
        } else {
            return false;
        }
    }

}