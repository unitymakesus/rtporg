<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/2/14
 * Time: 3:22 PM
 * To change this template use File | Settings | File Templates.
 *
 * Have no fear, this is being used for development only, so
 * excuse all PHP and programming sins. Though the sins be many
 * may your face palms be few.
 *
 */
class SircusFeedMockRequest extends AbtFeedRequest
{
    /**
     * @param array $options
     * @return mixed
     */
    public function fetch($options = array())
    {
        $response = new StdClass;
        $response->items = $this->_makeRandomItems();

        return $response;
    }

    /**
     * @return array
     */
    private function _makeRandomItems()
    {
        $num = rand(8, 24);

        $items = array();

        for ($i = 0; $i < $num; $i++) {
            array_push( $items, $this->_makeRandomItem($i));
        }

        return $items;
    }

    /**
     * @return StdClass
     */
    private function _makeRandomItem($i)
    {
        //$id = rand(10000000, 99999999);
        $id = $i+1;
        $statuses = array( 'featured', 'standard' );
        $title = 'Test item ' . file_get_contents('http://randomword.setgetgo.com/get.php');
        $timestamp = ( time() - rand(100, 31556900) ) * 1000;
        // You got a 1 in 4 chance of makin' it big, baby
        $likes =  rand(1,4) == 2 ? rand(51, 80085) : rand(1,50);
        $author = $this->_makeRandomAuthor();
        $type = 'text';
        $status = $statuses[array_rand($statuses)];

        return $this->_makeItem( $id, $title, $timestamp, $likes, $author, $type, $status );
    }

    /**
     * @return StdClass
     */
    private function _makeRandomAuthor()
    {
        $names =
            array(
                'Sunshine',
                'Poopsie',
                'Moon',
                'Darla',
                'Stew',
                'Mark',
                'Yolanda',
                'John',
                'Darth',
                'Brian',
                'Jon',
                'James',
                'Ryan',
                'Glenwood',
                'Jenny',
                'Cupcake',
                'Sparkles',
                'Tera',
                'Walt',
                'Speckles',
                'McFluffy',
                'Andrea',
                'Potato',
                'Meowington',
                'Blue',
                'Hippo',
                'Obama',
                'Smith',
                'Fester',
                'Doe'
            );

        $name  = $names[array_rand($names)] . ' ' . $names[array_rand($names)];
        $image = 'https://lh3.googleusercontent.com/-aD01iSxuGZ8/AAAAAAAAAAI/AAAAAAAAAAA/jJv6M3FTHt8/s46-c-k-no/photo.jpg';

        return $this->_makeAuthor( $name, $image );
    }

    /**
     * @param $title
     * @param $timestamp
     * @param $likes
     * @param $author
     * @param $type
     * @param $status
     * @return StdClass
     */
    private function _makeItem( $id, $title, $timestamp, $likes, $author, $type, $status )
    {
        $item = new StdClass;
        $item->id = $id;
        $item->title = $title;
        $item->timestamp = $timestamp;
        $item->likes = $likes;
        $item->author = $author;
        $item->type = $type;
        $item->status = $status;
        $item->debugTs = time();
        $item->source = 'http://bit.ly/' . substr(uniqid('', true), -1);
        return $item;
    }

    /**
     * @param $name
     * @param $image
     * @return StdClass
     */
    private function _makeAuthor( $name, $image )
    {
        $author = new StdClass;
        $author->name = $name;
        $author->image = $image;

        return $author;
    }
}