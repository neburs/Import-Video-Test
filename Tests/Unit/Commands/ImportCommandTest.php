<?php
/**
 * Unit Test for ImportCommand
 */
namespace Tests\Unit\Commands;


use Commands\ImportCommand;

class ImportCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException        \Exception
     * @expectedExceptionMessage Impossible build the reader engine
     */
    public function testImportCommandWithoutProvider()
    {
        $cmd = new ImportCommand();
        $cmd->execute(null);
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
