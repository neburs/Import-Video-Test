<?php
/**
 * Unit Test for Glorf Reader engine
 */
namespace Tests\Unit\Readers;

use Readers\GlorfReader;

class GlorfReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testReadData()
    {
        $reader = new DummyGlorfReader();
        $result = [
            [
                "id" => "",
                "name" => "name test1",
                "url" => "url test1",
                "tags" => ["tag1", "tag2"]
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
 * Class DummyGlorfReader
 * @package Tests\Unit\Readers
 */
class DummyGlorfReader extends GlorfReader
{
    protected function getOriginPaths($dir, $prefix, $format)
    {
        return [
            __DIR__ . '/Stubs/glorf.'.$format
        ];
    }
}