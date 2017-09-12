<?php

class SampleTest extends WP_UnitTestCase {


    function tearDown()
    {
        AbtConfigObject::destroy();
        parent::tearDown();
    }

    function simplePrint( $var )
    {
        echo PHP_EOL . print_r($var, true) . PHP_EOL;
    }


    function testNewAbtConfigObjectGetWithEmptyDataReturnsEmptyConfig()
    {
        $data   = array();

        $config = AbtConfigObject::get_instance( $data );

        $this->assertTrue( isset( $config ) );

        $this->tearDown();
    }




    function testAbtConfigObjectWithSimpleDataStructure()
    {
        $data   = array( 'success' => true );

        $config = AbtConfigObject::get_instance( $data );

        $this->assertTrue( $config->success );



        $this->tearDown();
    }

    function testAbtConfigObjectWithSimpleDataStructureMissingKeyReturnsNull()
    {
        $data   = array( 'success' => true );

        $config = AbtConfigObject::get_instance( $data );

        $this->assertFalse( isset( $config->fail ) );

        $this->tearDown();
    }


    function testAbtConfigObjectWithNestedDataStructure()
    {
        $data =
            array(
                'result' => array(
                    'success' => true
                )
            );

        $config = AbtConfigObject::get_instance( $data );

        $this->assertTrue( $config->result->success );

        $this->tearDown();
    }

    function testAbtConfigObjectWithNestedDataStructureMissingKeyReturnsNull()
    {
        $data =
            array(
                'result' => array(
                    'success' => true
                )
            );

        $config = AbtConfigObject::get_instance( $data );

        $this->assertFalse( isset( $result->fail ) );

        $this->tearDown();
    }

    function testAbtWordPressConfigWriter()
    {
        $data =
            array(
                'result' => array(
                    'success' => true
                )
            );

        $key = 'test_config';

        $writer = new WordPressOptionConfigWriter();
        $writer->save_config( $key, $data );

        $option = get_option( $key );

        $this->assertTrue( isset( $option ) && is_array( $option ) );

        $this->tearDown();
    }

    function testAbtWordPressConfigReader()
    {
        $data =
            array(
                'result' => array(
                    'success' => true
                )
            );

        $key = 'test_config';

        update_option( $key, $data );

        $reader = new  WordPressOptionConfigReader();
        $value  = $reader->get_config( $key );

        $this->assertTrue( $value === $data );

        $this->tearDown();
    }
}

