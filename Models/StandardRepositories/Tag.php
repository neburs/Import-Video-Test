<?php
/**
 * Standard Repository for show the data of the tag when try
 * to persist
 */

namespace Models\StandardRepositories;

use Domain\Core\Interfaces\TagInterfaceEntity;

class Tag implements TagInterfaceEntity
{
    /**
     * @param \Domain\Core\Tag $tag
     *
     * @return bool
     */
    public function persist($tag)
    {
        echo $tag->getTag();

        return true;
    }
}