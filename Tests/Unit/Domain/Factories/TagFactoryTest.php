<?php
/**
 * Unit Test for Tag Factory
 */
namespace Tests\Unit\Domain\Factories;

use Domain\Core\Interfaces\TagInterfaceEntity;
use Domain\Factories\TagFactory;

class TagFactoryTest extends \PHPUnit_Framework_TestCase
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
    public function testBuildTagWithOutId()
    {
        $item = TagFactory::buildTag(
            $this->dummyTagEntity,
            'tag test'
        );

        $this->assertNotEmpty(
            $item->getId(),
            'The value of the Id can not be empty'
        );
    }

    /**
     * @test
     */
    public function testBuildTagWithId()
    {
        $item = TagFactory::buildTag(
            $this->dummyTagEntity,
            'tag test',
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
            $this->dummyTagEntity
        );

        parent::tearDown();
    }
}
