<?php
/**
 * Unit test form Tag Repository
 */
namespace Tests\Unit\Models\StandardRepositories;

use Domain\Factories\TagFactory;
use Models\StandardRepositories\Tag;

class TagTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testPersist()
    {
        $this->expectOutputString('test tag');

        $tag = new Tag();

        $tag->persist(TagFactory::buildTag(
            $tag,
            'test tag'
        ));
    }


    public function tearDown()
    {
        parent::tearDown();
    }

}
