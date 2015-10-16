<?php
/**
 * The representation of the Tag Model in own Domain.
 */

namespace Domain\Core;

use Domain\Core\Interfaces\TagInterfaceEntity;

class Tag
{
    /**
     * @var \Domain\Core\Interfaces\TagInterfaceEntity
     */
    private $tagEntity;
    /**
     * @var \Domain\Core\Id
     */
    private $id;
    /**
     * @var string
     */
    private $tag;

    /**
     * @param TagInterfaceEntity $tagEntity
     * @param string             $id
     * @param string             $tag
     *
     * @throws \Exception
     */
    public function __construct(
        TagInterfaceEntity $tagEntity,
        $id,
        $tag
    ) {
        /**
         * @todo Improve this creating a custom Exception
         */
        if (empty($tag)) {
            throw new \Exception('Tag param can\'t be empty');
        }

        if (empty($id)) {
            $this->id = new Id();
        } else {
            $this->id = new Id($id);
        }

        $this->tagEntity = $tagEntity;
        $this->tag = $tag;
    }

    /**
     * @return TagInterfaceEntity
     */
    public function getTagEntity()
    {
        return $this->tagEntity;
    }

    /**
     * @return Id
     */
    public function getId()
    {
        return $this->id->getId();
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Persist the data
     *
     * @return bool
     */
    public function persist()
    {
        return $this->tagEntity->persist($this);
    }
}