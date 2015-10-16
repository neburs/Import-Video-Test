<?php
/**
 * Interface to define how interact the domain with the DBO
 */

namespace Domain\Core\Interfaces;

interface TagInterfaceEntity
{
    /**
     * Persist the tag indicated with all related data.
     *
     * @param \Domain\Core\Tag $tag
     */
    public function persist($tag);
}