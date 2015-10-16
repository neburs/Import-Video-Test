<?php
/**
 * Unit Test for FlubReader engine
 */
namespace Tests\Unit\Readers;

use Readers\FlubReader;

class FlubReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testReadData()
    {
        $reader = new DummyFlubReader();
        $result = [
            [
                "id" => "",
                "name" => "name test1",
                "url" => "url test1",
                "tags" => ["label1", "label2"]
            ],
            [
                "id" => "",
                "name"=>  "name test2",
                "url" => "url test2",
                "tags" => null
            ]
        ];
        $data = $reader->readData();

        $this->assertEquals(
            $result,
            $data,
            'The result of the FlubReader file dummy is not correct'
        );
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}

/**
 * Dummy class for inject a stubs directory
 *
 * Class DummyFlubReader
 * @package Tests\Unit\Readers
 */
class DummyFlubReader extends FlubReader
{
    protected function getOriginPaths($dir, $prefix, $format)
    {
        return [
            __DIR__ . '/Stubs/flub.'.$format
        ];
    }
}