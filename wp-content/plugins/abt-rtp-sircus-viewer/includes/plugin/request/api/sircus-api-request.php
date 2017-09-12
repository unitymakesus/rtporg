<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/2/14
 * Time: 3:22 PM
 * To change this template use File | Settings | File Templates.
 *
 *
 * TODO: This will require major refactoring.
 *
 * I do not want the parsing to take place in this class.
 * Make use of parser objects to handle converting raw response
 * data into useable content
 */
class SircusFeedApiRequest extends AbtFeedRequest
{
    /**
     * @param array $options
     * @return mixed
     */
    public function fetch( $options = array() )
    {
        $this->setParameters( $options );

        $endpoint = $this->_getFullUrl();

        return
            $this->_maybeParse( wp_remote_get( $endpoint ) );
    }

    protected function _getFullUrl()
    {
        $url    = $this->getUri();
        $params = $this->getParameters();

        if ( isset( $params) && $params )
            $query  = http_build_query( $params );
        else
            $query = null;

        if (parse_url($url, PHP_URL_QUERY))
            return
                isset($query) && $query ?
                    $url . '&' . $query :
                    $url;
        else
            return
                isset($query) && $query ?
                    $url . '?' . $query :
                    $url;
    }

    /**
     * Guess what? Limited parsing required, so always parse, but
     * we're still gonna call it _maybeParse
     *
     * @param $response
     * @return array
     */
    protected function _maybeParse( $response )
    {
        $items   = array();
        $body    = wp_remote_retrieve_body( $response );
        $decoded = json_decode( $body );

        return
            array(
                'data'      => $decoded->data,
                'meta'      => $decoded->meta,
            );
    }


    /**
     * DEPRECATED FUNCTION, WEBSERVICES NOW PARSING AND PROVIDING STANDARDIZED DATA
     *
     * @param $data
     * @return null|StdClass
     */
    protected function _parseItemData( $data )
    {
        switch( $data->service ) {
            case 'twitter':
                return $this->_parseTwitter( $data );
                break;
            case 'instagram':
                return $this->_parseInstagram( $data );
                break;
            case 'googleplus':
                return $this->_parseGooglePlus( $data );
                break;
            default:
                return $data;
                break;
        }
    }


    /**
     * DEPRECATED FUNCTION, WEBSERVICES NOW PARSING AND PROVIDING STANDARDIZED DATA
     * @param $data
     * @return StdClass
     */
    protected function _parseTwitter( $data )
    {
        $content = json_decode( $data->content );

        $user = $content->user->screen_name;
        $id = $content->id_str;

        $item = new StdClass;
        $item->id = $data->resourcename;
        $item->title = $content->text;
        $item->timestamp = strtotime( $data->date ) * 1000; // Gotta multiply by 1000
        $item->likes = $data->like_count;
        $item->type   = 'text';//$data->service;
        $item->status = '';
        $item->debugTs = time();
        $item->source = "https://www.twitter.com/$user/status/$id";
        $item->raw = $data;
        $item->raw_content = $content;

        $item->author = new StdClass;
        $item->author->name = $content->user->name;
        $item->author->image = $content->user->profile_image_url;

        return $item;
    }


    /**
     * DEPRECATED FUNCTION, WEBSERVICES NOW PARSING AND PROVIDING STANDARDIZED DATA
     *
     * @param $data
     */
    protected function _parseRss( $data )
    {

    }


    /**
     * DEPRECATED FUNCTION, WEBSERVICES NOW PARSING AND PROVIDING STANDARDIZED DATA
     *
     * @param $data
     */
    protected function _parseYouTube( $data )
    {

    }


    /**
     * DEPRECATED FUNCTION, WEBSERVICES NOW PARSING AND PROVIDING STANDARDIZED DATA
     *
     * @param $data
     */
    protected function _parseGooglePlus( $data )
    {
        $content = json_decode( $data->content );

        $item = new StdClass;
        $item->id = $data->resourcename;
        $item->title = $content->title;
        //$item->image_url = $content->images->standard_resolution->url;
        $item->timestamp = strtotime( $data->date ) * 1000; // Gotta multiply by 1000
        $item->likes = $data->like_count;
        $item->type   = 'text';//$data->service;
        $item->status = '';
        $item->debugTs = time();
        $item->source = $content->url;
        $item->raw = $data;
        $item->raw_content = $content;

        $item->author = new StdClass;
        $item->author->name = $content->actor->displayName;
        $item->author->image = $content->actor->image->url;

        return $item;
    }


    /**
     * DEPRECATED FUNCTION, WEBSERVICES NOW PARSING AND PROVIDING STANDARDIZED DATA
     *
     * @param $data
     */
    protected function _parseInstagram( $data )
    {
        $content = json_decode( $data->content );

        $date =  $content->caption->created_time;

        $item = new StdClass;
        $item->id = $data->resourcename;
        $item->title = $content->images->standard_resolution->url;
        $item->image_url = $content->images->standard_resolution->url;
        $item->timestamp = $date * 1000; // Gotta multiply by 1000
        $item->likes = $data->like_count;
        $item->type   = 'media';//$data->service;
        $item->status = '';
        $item->debugTs = time();
        $item->source = $content->link;
        $item->raw = $data;
        $item->raw_content = $content;

        $item->author = new StdClass;
        $item->author->name = $content->user->full_name;
        $item->author->image = $content->user->profile_picture;

        return $item;
    }

}