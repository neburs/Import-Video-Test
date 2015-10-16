<?php
/**
 * Unit Test for Tag Collection
 */
namespace Tests\Unit\Domain\Core;


use Domain\Core\Tag;
use Domain\Core\TagCollection;

class TagCollectionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function testAddTag()
    {
        $tagId = 1;
        $dummyTag = $this->buildDummyTag($tagId);

        $list = new TagCollection();

        $list->add($dummyTag);

        $product = $list->current();

        $this->assertEquals(
            $dummyTag,
            $product,
            'The object has not added correctly to the list'
        );
    }

    /**
     * @test
     * @expectedException        \Exception
     * @expectedExceptionMessage The tag is already included in this collection
     */
    public function testAddSomeTagMoreThatOneTime()
    {
        $dummyTag1 = $this->buildDummyTag(1);
        $dummyTag2 = $this->buildDummyTag(1);

        $list = new TagCollection();

        $list->add($dummyTag1);
        $list->add($dummyTag2);
    }

    /**
     * @test
     */
    public function testDeleteTag()
    {
        $dummyTag1 = $this->buildDummyTag(1);
        $dummyTag2 = $this->buildDummyTag(2);
        $dummyTag3 = $this->buildDummyTag(3);

        $list = new TagCollection();

        $list->add($dummyTag1);
        $list->add($dummyTag2);
        $list->add($dummyTag3);

        $list->remove(1);

        $listFinal = [];
        foreach ($list as $item) {
            $listFinal[] = $item;
        }

        $this->assertEquals(
            2,
            count($listFinal),
            'The number of objects is not equals to the real number'
        );

        $this->assertNotContains(
            $dummyTag2,
            $listFinal,
            'The tag with id 2 is not deleted correctly'
        );
    }

    private function buildDummyTag($id)
    {
        $dummyTag = $this->getMockBuilder(Tag::class)
            ->disableOriginalConstructor()
            ->getMock();

        $dummyTag->expects($this->any())
            ->method('getId')
            ->will($this->returnValue($id));

        return $dummyTag;
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
