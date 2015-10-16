<?php
/**
 * Unit test for TagCollection Factory
 */
namespace Tests\Unit\Domain\Factories;

use Domain\Core\Interfaces\TagInterfaceEntity;
use Domain\Factories\TagCollectionFactory;

class TagCollectionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public $dummyTagEntity;

    public function setUp()
    {
        $this->dummyTagEntity = $this->getMockBuilder(TagInterfaceEntity::class)
            ->getMock();
    }

    /**
     * @test
     */
    public function testBuildTagCollectionFromArrayWithEmptyArray()
    {
        $collection = TagCollectionFactory::buildTagCollectionFromArray(
            $this->dummyTagEntity,
            []
        );

        $this->assertEmpty(
            $collection,
            'The collection must be empty'
        );
    }

    /**
     * @test
     */
    public function testBuildTagCollectionFromArrayWithItemsInArray()
    {
        $tags = ['tag1', 'tag2'];
        $collection = TagCollectionFactory::buildTagCollectionFromArray(
            $this->dummyTagEntity,
            $tags
        );

        $tagsResult = [];
        foreach ($collection as $item) {
            $tagsResult[] = $item->getTag();
        }

        $this->assertEquals(
            $tags,
            $tagsResult,
            'Some think has not got well when you are build a collection from a not empty array'
        );
    }

    public function tearDown()
    {
        unset(
            $this->dummyTagEntity
        );

        parent::tearDown();
    }
}
