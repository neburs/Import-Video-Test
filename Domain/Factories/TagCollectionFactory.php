<?php
/**
 * A factory for create a Collection Of Tags
 */

namespace Domain\Factories;

use Domain\Core\Interfaces\TagInterfaceEntity;
use Domain\Core\TagCollection;

class TagCollectionFactory
{
    /**
     * Create a Collection of Tags from a simple array data
     *
     * @param \Domain\Core\Interfaces\TagInterfaceEntity $tagEntity
     * @param array                                      $tags
     *
     * @return \Domain\Core\Tag
     */
    public static function buildTagCollectionFromArray(
        TagInterfaceEntity $tagEntity,
        $tags
    ) {
        $tagCollection = null;

        if (!empty($tags)) {
            $tagCollection = new TagCollection();

            foreach ($tags as $tag) {
                $tagItem = TagFactory::buildTag(
                    $tagEntity,
                    $tag
                );
                try {
                    $tagCollection->add($tagItem);
                } catch (\Exception $e) {
                    /**
                     * You can choose what to do in this case.
                     */
                }
            }
        }

        return $tagCollection;
    }
}