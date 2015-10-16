<?php
/**
 * A factory for create a Tag
 */

namespace Domain\Factories;

use Domain\Core\Interfaces\TagInterfaceEntity;
use Domain\Core\Tag;

class TagFactory
{
    /**
     * @param TagInterfaceEntity $tagEntity
     * @param string             $tag
     * @param string             $id
     *
     * @return Tag
     */
    public static function buildTag(
        TagInterfaceEntity $tagEntity,
        $tag,
        $id = ''
    ) {
        return new Tag(
            $tagEntity,
            $id,
            $tag
        );
    }
}