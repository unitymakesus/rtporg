<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/3/14
 * Time: 10:52 AM
 * To change this template use File | Settings | File Templates.
 */
class AbtAjaxResponder
{
    /**
     *
     */
    const STATUS_STRING_SUCCESS = 'success';
    /**
     *
     */
    const STATUS_STRING_ERROR   = 'error';
    /**
     *
     */
    const STATUS_STRING_KEY     = 'status';
    /**
     *
     */
    const STATUS_CODE_SUCCESS   = 1;
    /**
     *
     */
    const STATUS_CODE_ERROR     = 2;
    /**
     *
     */
    const STATUS_CODE_KEY       = 'code';
    /**
     *
     */
    const CONTENT_STRING_KEY    = 'content';
    /**
     *
     */
    const ERROR_NO_RESULTS      = '404';
    /**
     *
     */
    const ERROR_NO_TYPE_DEFINED = '900';

    /**
     * @var array
     */
    protected $_handlers;

    /**
     * Actions define what functionality is instantiated
     * when the ajax handler is passed the provided key.
     *
     * @param string $key
     * @param AbtAjaxHandler $handler
     */
    public function add_handler(
        $key = '',
        AbtAjaxHandler $handler
    )
    {
        $handlers       = $this->_get_handlers();
        $handlers[$key] = $handler;

        $this->_set_handlers( $handlers );
    }

    /**
     * Remove an action.
     * @param string $key
     */
    public function remove_handler( $key = '' )
    {
        $handlers = $this->_get_handlers();
        $handlers[$key] = null;
        unset( $handlers[$key] );
        $this->_set_handlers( $handlers );
    }

    /**
     * Determine if the action is registered.
     *
     * @param string $key
     * @return bool
     */
    public function has_handler( $key = '' )
    {
        $handlers = $this->_get_handlers();
        return isset( $handlers[$key] );
    }

    /**
     * get the list of actions that have bene registered
     *
     * @return array
     */
    protected function _get_handlers()
    {
        return
            isset( $this->_handlers ) && is_array( $this->_handlers ) ?
                $this->_handlers :
                array();
    }

    /**
     * set the complete action array
     *
     * @return array
     */
    protected function _set_handlers( $handlers )
    {
        $this->_handlers = $handlers;
    }

    /**
     * get a specific action
     *
     * @param $key
     * @return null | array
     */
    protected function _get_handler( $key )
    {
        if ( $this->has_handler( $key ) ) {
            $handlers = $this->_get_handlers();
            return $handlers[$key];
        }

        return null;
    }

    /**
     * Primary handler function
     * Routes requests, responds
     */
    public function respond( $arguments = array() )
    {
        // This is being done to support testing (maybe)
        if ( isset( $_REQUEST ) ) {
            $arguments = $_REQUEST;
        }



        $options = $arguments;
        $type    = $arguments['type'];

        return $this->_do_method( $type, $options );
    }

    /**
     * Do the action listed by type & given otpions
     *
     * @param string $action
     * @param array $options
     */
    private function _do_method( $type, $options = array() )
    {
        if ( isset( $type) && $this->has_handler( $type ) ) {
            $handler = $this->_get_handler( $type );
            if ( ( $content = $handler->handle( $options ) ) ) {
                $this->_send_success( $content );
            } else {
                $this->_send_error( 'No Results Found', self::ERROR_NO_RESULTS );
            }
        }

        $this->_send_error( 'No action defined for ' . $type . ' with ' . print_r( $options, true ), self::ERROR_NO_TYPE_DEFINED );
    }

    /**
     * send ajax response
     *
     * @param string $status
     * @param int $code
     * @param string $content
     */
    private function _send( $status = self::STATUS_STRING_SUCCESS, $code = self::STATUS_CODE_SUCCESS, $content = '' )
    {
        $result = array();
        $result[self::STATUS_STRING_KEY]  = $status;
        $result[self::STATUS_CODE_KEY]    = $code;
        $result[self::CONTENT_STRING_KEY] = $content;

        ob_clean();
        echo json_encode( $content );
        die();
    }

    /**
     * send success response message
     *
     * @param $content
     */
    private function _send_success( $content )
    {
        $this->_send( self::STATUS_STRING_SUCCESS, self::STATUS_CODE_SUCCESS, $content );
    }

    /**
     * send an error response message
     *
     * @param $message
     * @param $code
     */
    private function _send_error( $message, $code )
    {
        $this->_send( self::STATUS_STRING_ERROR, self::STATUS_CODE_ERROR, $message );
    }
}