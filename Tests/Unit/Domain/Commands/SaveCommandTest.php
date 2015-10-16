<?php
/**
 * Unit Test for SaveCommand (action)
 */
namespace Tests\Unit\Domain\Commands;


use Domain\Commands\SaveCommand;
use Domain\Core\Interfaces\FilmInterfaceEntity;
use Domain\Core\Interfaces\TagInterfaceEntity;

class SaveCommandTest extends \PHPUnit_Framework_TestCase
{
    private $dummyFilmEntity;
    private $dummyTagEntity;

    public function setUp()
    {
        $this->dummyFilmEntity = $this->getMockBuilder(FilmInterfaceEntity::class)
            ->getMock();
        $this->dummyTagEntity = $this->getMockBuilder(TagInterfaceEntity::class)
            ->getMock();
    }

    /**
     * Test for sure that the persist method is called
     *
     * @test
     */
    public function testSaveCommandExecute()
    {
        $this->dummyFilmEntity->expects($this->once())
            ->method('persist');

        $cmd = new SaveCommand(
            $this->dummyFilmEntity,
            $this->dummyTagEntity
        );

        $cmd->execute([
            'id' => '',
            'name' => 'nameTest',
            'url' => 'url test',
            'tags' => []
         ]);
    }

    public function tearDown()
    {
        unset(
            $this->dummyFilmEntity,
            $this->dummyTagEntity
        );

        parent::tearDown();
    }
}
