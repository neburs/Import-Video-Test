<?php
/**
 * Functional test for test the Import Command.
 */
namespace Tests\Functional;

use Commands\ImportCommand;
use Readers\Interfaces\ReaderInterface;

class ImportCommandTest extends \PHPUnit_Framework_TestCase
{
    public $dummyReaderEngine;

    public function setUp()
    {
        $this->dummyReaderEngine = $this->getMockBuilder(ReaderInterface::class)
            ->getMock();
    }

    /**
     * @test
     * @dataProvider providerDummyReaderForImportCommandTest
     */
    public function testImportCommand($data, $res)
    {
        $this->dummyReaderEngine->expects($this->any())
            ->method('readData')
            ->will($this->returnValue($data));

        $this->expectOutputString($res);

        $cmd = new DummyImportCommand();
        $cmd->executeWithProvider($this->dummyReaderEngine);
    }

    public function providerDummyReaderForImportCommandTest()
    {
        return [
            [
                [
                    [
                        'id'   => '',
                        'name' => 'name test 1',
                        'url'  => 'url test 1',
                        'tags' => ['tag1', 'tag2']
                    ]
                ],
                "importing: \"name test 1\"; Url: url test 1; Tags: tag1,tag2\n"
            ],
            [
                [
                    [
                        'id'   => '',
                        'name' => 'name test 2',
                        'url'  => 'url test 2',
                        'tags' => null
                    ]
                ],
                "importing: \"name test 2\"; Url: url test 2\n"
            ],
            [
                [
                    [
                        'id'   => '',
                        'name' => 'name test 1',
                        'url'  => 'url test 1',
                        'tags' => ['tag1', 'tag2']
                    ],
                    [
                        'id'   => '',
                        'name' => 'name test 2',
                        'url'  => 'url test 2',
                        'tags' => null
                    ]
                ],
                "importing: \"name test 1\"; Url: url test 1; Tags: tag1,tag2\nimporting: \"name test 2\"; Url: url test 2\n"
            ]
        ];
    }

    public function tearDown()
    {
        unset(
            $this->dummyReaderEngine
        );
        parent::tearDown();
    }
}

class DummyImportCommand extends ImportCommand
{
    public function executeWithProvider(ReaderInterface $readerEngine)
    {
        parent::executeWithProvider($readerEngine);
    }
}

;
