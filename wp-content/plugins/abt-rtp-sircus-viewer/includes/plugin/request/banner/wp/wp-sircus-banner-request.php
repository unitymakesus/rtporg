<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/2/14
 * Time: 3:21 PM
 * To change this template use File | Settings | File Templates.
 */
class WordPressAbtFeedBannerRequest extends AbtFeedRequest
{
    protected $_featured_banner_id = false;

    /**
     * @var
     */
    protected $_request;

    /**
     * @param mixed $request
     */
    public function setRequest( $request )
    {
        $this->_request = $request;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * @param boolean $featured_banner_id
     */
    public function setFeaturedBannerId($featured_banner_id)
    {
        $this->_featured_banner_id = $featured_banner_id;
    }

    /**
     * @return boolean
     */
    public function getFeaturedBannerId()
    {
        return $this->_featured_banner_id;
    }

    /**
     * @param array $options
     * @return bool|mixed
     */
    public function fetch( $options = array() )
    {
        $request = $this->getRequest();

        // Case 1: No request object provided
        if ( !isset( $request ) )
            return false;

        $data = $request->fetch( $options );

        // Get items from feed data
        $items = isset( $data['data'] ) ? $data['data'] : array();

        // Use Featured HP Banner
        $featured_banner =
            isset( $options ) &&
            isset( $options['banner'] ) &&
            intval($options['banner']) == 1 ?
                true : false;

        // Provide ability to disable / skip banner
        $disabled =
            isset( $options ) &&
            isset( $options['skip_banner'] ) &&
            intval($options['skip_banner']) == 1 ?
                true : false;

        if (!$disabled) {
            // Perform banner injection
            $data['data'] = $this->_inject_banners( $items, $featured_banner );
        }

        return $data;
    }


    /**
     * @param array $items
     * @return array
     */
    private function _inject_banners( $items = array(), $featured_banner = false )
    {
        if (
            is_array( $items) &&
            count( $items ) > 0 &&
            ( $banner = $this->_get_banner( $featured_banner ) )
        ) {
            array_unshift( $items, $banner );
        }

        return $items;
    }



    private function _get_banner_featured()
    {
        return
            array(
                'p'         => $this->getFeaturedBannerId(),
                'post_type' => 'banner',
            );
    }

    private function _get_banner_order_random()
    {
        return
            array(
                'post_type'      => 'banner',
                'post_status'    => 'publish',
                'orderby'        => 'rand',
                'posts_per_page' => 1
            );
    }

    /**
     * @return array
     */
    private function _get_banners( $featured_banner = false )
    {
        $banners = array();

        wp_reset_query();

        if ( $featured_banner && $this->getFeaturedBannerId() ) {
            $args = $this->_get_banner_featured();
        } else {
            $args = $this->_get_banner_order_random();
        }

        // Per http://wordpress.org/support/topic/wp_query-orderby-random-not-working
        // We have another plugin for ordering that prevents random ordering
        // from working
        remove_all_filters('posts_orderby');

        query_posts( $args );

        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();

                // Global variables
                global $post;

                $banner = new stdClass;

                $banner->type = 'banner';
                $banner->id   = $post->ID;

                $banner->slug      = get_post( $post )->post_name;
                $banner->theme_dir = get_stylesheet_directory_uri();

                $banner->title        = types_render_field( "banner-title", array( "raw" => "true" ) );
                $banner->subtitle     = types_render_field( "banner-subtitle", array( "raw" => "true" ) );
                $banner->graphic      = types_render_field( "banner-graphic", array( "raw" => "true" ) );
                $banner->theme        = types_render_field( "banner-theme", array( "raw" => "true" ) );
                $banner->display_type = types_render_field( "banner-type", array( "raw" => "true" ) );
                $banner->description  = types_render_field( "banner-description", array( "raw" => "true" ) );
                $banner->quote        = types_render_field( "banner-quote", array( "raw" => "true" ) );
                $banner->tagline      = types_render_field( "display-brand-and-tagline", array( "raw" => "true" ) );

                $banner->apply_type          = ($banner->type != '') ? $banner->display_type . ' ' : '';
                $banner->apply_subtitle      = ($banner->subtitle != '') ? $banner->subtitle : '';
                $banner->apply_description   = ($banner->description != '') ? do_shortcode( $banner->description ) : '';
                $banner->apply_graphic       = ($banner->graphic != '') ? 'background-image:url(\'' . $banner->graphic .'\')' : '';
                $banner->apply_graphic_class = ($banner->graphic == '') ? ' no-graphic' : '';
                $banner->apply_theme         = ($banner->theme != '') ? $banner->theme : '';

                // People variables
                $banner->job_title           = types_render_field( "person-job-title", array( "raw" => "true" ) );
                $banner->thumb               = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                $banner->thumb_url           = isset( $thumb['0'] ) ? $thumb['0'] : '';

                $banner->blog = array( 'name' => get_bloginfo('name'), 'description' => get_bloginfo('description') );

                array_push($banners, $banner);
            }


            wp_reset_query();
        }

        return $banners;
    }

    /**
     * @return null
     */
    private function _get_banner( $featured_banner = false  )
    {
        $banners = $this->_get_banners( $featured_banner );

        return isset( $banners[0] ) ? $banners[0] : null;
    }


}