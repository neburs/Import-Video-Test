<?php
/**
 * Unit test for ReaderFactory
 */
namespace Tests\Unit\Readers;


use Readers\ReaderFactory;

class ReaderFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @dataProvider providerReaderEngine
     */
    public function testBuildReaderEngineFlubReader(
        $nameReader,
        $nameSpaceReader
    ) {
        $reader = ReaderFactory::buildReaderEngine($nameReader);

        $this->assertEquals(
            $nameSpaceReader,
            get_class($reader),
            "The ReaderFactory not return an instance of $nameSpaceReader"
        );
    }

    public function providerReaderEngine()
    {
        return [
            [
                'flub',
                'Readers\FlubReader'
            ],
            [
                'glorf',
                'Readers\GlorfReader'
            ]
        ];
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
