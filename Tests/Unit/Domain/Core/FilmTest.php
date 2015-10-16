<?php
/**
 * Unit test for Film Model
 */
namespace Tests\Unit\Domain\Core;


use Domain\Core\Film;
use Domain\Core\Interfaces\FilmInterfaceEntity;

class FilmTest extends \PHPUnit_Framework_TestCase
{
    private $dummyFilmEntity;

    public function setUp()
    {
        $this->dummyFilmEntity = $this->getMockBuilder(FilmInterfaceEntity::class)
            ->getMock();
    }

    /**
     * @test
     */
    public function testConstructWithoutId()
    {
        $item = new Film(
            $this->dummyFilmEntity,
            '',
            'name test',
            'url test'
        );

        $this->assertFalse(
            empty($item->getId()),
            'The Id attribute can not be empty'
        );
    }

    /**
     * @test
     */
    public function testConstructWithId()
    {
        $item = new Film(
            $this->dummyFilmEntity,
            '1',
            'name test',
            'url test'
        );

        $this->assertEquals(
            '1',
            $item->getId(),
            'The Id attribute can not created correctly'
        );
    }

    /**
     * @test
     * @expectedException        \Exception
     * @expectedExceptionMessage Name param can't be empty
     */
    public function testConstructWithoutName()
    {
        new Film(
            $this->dummyFilmEntity,
            '',
            '',
            'url test'
        );
    }

    /**
     * @test
     * @expectedException        \Exception
     * @expectedExceptionMessage Url param can't be empty
     */
    public function testConstructWithoutUrl()
    {
        new Film(
            $this->dummyFilmEntity,
            '',
            'name test',
            ''
        );
    }

    /**
     * Test for sure that the persist method is called
     *
     * @test
     */
    public function testPersist()
    {
        $this->dummyFilmEntity->expects($this->once())
            ->method('persist')
            ->willReturn(true);

        $item = new Film(
            $this->dummyFilmEntity,
            '',
            'name test',
            'url test'
        );

        $this->assertTrue(
            $item->persist(),
            'The persist method will return true'
        );
    }

    public function tearDown()
    {
        unset(
            $this->dummyFilmEntity
        );

        parent::tearDown();
    }

}
