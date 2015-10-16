<?php
/**
 * Unit test for Film Repository
 */
namespace Tests\Unit\Models\StandardRepositories;

use Domain\Factories\FilmFactory;
use Domain\Factories\TagCollectionFactory;
use Models\StandardRepositories\Film;
use Models\StandardRepositories\Tag;

class FilmTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testPersistWithoutTag()
    {
        $this->expectOutputString("importing: \"name test\"; Url: url test\n");

        $film = new Film();

        $film->persist(FilmFactory::buildFilm(
            $film,
            'name test',
            'url test'
        ));
    }

    /**
     * @test
     */
    public function testPersistWithTag()
    {
        $this->expectOutputString("importing: \"name test\"; Url: url test; Tags: tag 1,tag 2\n");

        $film = new Film();
        $tag = new Tag();

        $tagCollection = TagCollectionFactory::buildTagCollectionFromArray(
            $tag,
            ['tag 1', 'tag 2']
        );

        $film->persist(FilmFactory::buildFilm(
            $film,
            'name test',
            'url test',
            '',
            $tagCollection
        ));
    }


    public function tearDown()
    {
        parent::tearDown();
    }

}
