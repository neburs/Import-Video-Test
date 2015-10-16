<?php
/**
 * Unit Test for Tag Model
 */
namespace Tests\Unit\Domain\Core;

use Domain\Core\Tag;
use Domain\Core\Interfaces\TagInterfaceEntity;

class TagTest extends \PHPUnit_Framework_TestCase
{
    private $dummyTagEntity;

    public function setUp()
    {
        $this->dummyTagEntity = $this->getMockBuilder(TagInterfaceEntity::class)
            ->getMock();
    }

    /**
     * @test
     */
    public function testConstructWithoutId()
    {
        $item = new Tag(
            $this->dummyTagEntity,
            '',
            'tag test'
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
        $item = new Tag(
            $this->dummyTagEntity,
            '1',
            'tag test'
        );

        $this->assertEquals(
            '1',
            $item->getId(),
            'The Id attribute can not created correctly'
        );
    }

    /**
     * @test
     * @expectedException        Exception
     * @expectedExceptionMessage Tag param can't be empty
     */
    public function testConstructWithoutTag()
    {
        new Tag(
            $this->dummyTagEntity,
            '',
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
        $this->dummyTagEntity->expects($this->once())
            ->method('persist')
            ->willReturn(true);

        $item = new Tag(
            $this->dummyTagEntity,
            '',
            'tag test'
        );

        $this->assertTrue(
            $item->persist(),
            'The persist method will return true'
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
