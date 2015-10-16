<?php
/**
 * Unit Test for Film Factory
 */
namespace Tests\Unit\Domain\Factories;

use Domain\Core\Interfaces\FilmInterfaceEntity;
use Domain\Factories\FilmFactory;

class FilmFactoryTest extends \PHPUnit_Framework_TestCase
{
    public $dummyFilmEntity;

    public function setUp()
    {
        $this->dummyFilmEntity = $this->getMockBuilder(FilmInterfaceEntity::class)
            ->getMock();
    }

    /**
     * @test
     */
    public function testBuildFilmWithOutId()
    {
        $item = FilmFactory::buildFilm(
            $this->dummyFilmEntity,
            'film test',
            'url test'
        );

        $this->assertNotEmpty(
            $item->getId(),
            'The value of the Id can not be empty'
        );
    }

    /**
     * @test
     */
    public function testBuildFilmWithId()
    {
        $item = FilmFactory::buildFilm(
            $this->dummyFilmEntity,
            'film test',
            'url test',
            '1'
        );

        $this->assertEquals(
            '1',
            $item->getId(),
            'The value of the is not correct'
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
