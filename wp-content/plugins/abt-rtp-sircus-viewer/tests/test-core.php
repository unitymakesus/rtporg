<?php

/**
 * Class CoreTest
 */
class CoreTest extends WP_UnitTestCase {


    /**
     *
     */
    function tearDown()
    {
        AbtConfigObject::destroy();
        parent::tearDown();
    }

    /**
     * @param $var
     */
    function simplePrint( $var )
    {
        echo PHP_EOL . print_r($var, true) . PHP_EOL;
    }

    /**
     * Can you add a handler to the responder?
     */
    function testAbtAjaxResponderAddHandlerWithHandler()
    {
        // Ajax Handler
        $sircusListAjaxHandler = new SircusFeedAjaxHandler();

        // Ajax Responder
        $sircusAjaxResponder = new AbtAjaxResponder();

        // Setup Ajaxy stuff
        $sircusAjaxResponder->add_handler( 'list', $sircusListAjaxHandler );

        $this->assertTrue( $sircusAjaxResponder->has_handler( 'list' ) );

        $this->tearDown();
    }

    /**
     * When you add a handler, does the has_handler function return true for that handler?
     */
    function testAbtAjaxResponderHasHandlerReturnsTrueWithHandler()
    {
        // Ajax Handler
        $sircusListAjaxHandler = new SircusFeedAjaxHandler();

        // Ajax Responder
        $sircusAjaxResponder = new AbtAjaxResponder();

        // Setup Ajaxy stuff
        $sircusAjaxResponder->add_handler( 'list', $sircusListAjaxHandler );

        $this->assertTrue( $sircusAjaxResponder->has_handler( 'list' ) );

        $this->tearDown();
    }

    /**
     * When you have not added a specific handler to the responder, does the
     * has_handler return false?
     */
    function testAbtAjaxResponderHasHandlerReturnsFalseWithoutHandler()
    {
        // Ajax Handler
        $sircusListAjaxHandler = new SircusFeedAjaxHandler();

        // Ajax Responder
        $sircusAjaxResponder = new AbtAjaxResponder();

        // Setup Ajaxy stuff
        $sircusAjaxResponder->add_handler( 'last', $sircusListAjaxHandler );

        $this->assertFalse( $sircusAjaxResponder->has_handler( 'list' ) );

        $this->tearDown();
    }

    /**
     * Does the remove_handler function actually remove the handler?
     */
    function testAbtAjaxResponderRemoveHandlerRemovesExistingHandler()
    {
        // Ajax Handler
        $sircusListAjaxHandler = new SircusFeedAjaxHandler();

        // Ajax Responder
        $sircusAjaxResponder = new AbtAjaxResponder();

        // Setup Ajaxy stuff
        $sircusAjaxResponder->add_handler( 'list', $sircusListAjaxHandler );

        $sircusAjaxResponder->remove_handler( 'list' );

        $this->assertFalse( $sircusAjaxResponder->has_handler( 'list' ) );

        $this->tearDown();
    }

}

