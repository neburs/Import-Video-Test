<?php
/**
 * A Collection of Tags. This class Implements The Iterator Pattern.
 * @see http://php.net/manual/es/class.iterator.php
 */

namespace Domain\Core;

class TagCollection implements \Iterator
{
    /** @var array */
    private $collection = [];

    /** @var int */
    private $position = 0;

    public function __construct()
    {
        $this->position = 0;
    }

    /**
     * Add a Tag in the collection.
     *
     * @param Tag $tag
     *
     * @throws \Exception If the tag exist in the collection
     */
    public function add(Tag $tag)
    {
        $tagId = $tag->getId();

        foreach ($this->collection as $tagItem) {
            $tagIdTmp = $tagItem->getId();
            if ($tagId == $tagIdTmp) {
                throw new \Exception('The tag is already included in this collection');
            }
        }

        $this->collection[] = $tag;
    }

    /**
     * @param int $key
     *
     * @throws \Exception
     */
    public function remove($key)
    {
        if (isset($this->collection[$key])) {
            unset($this->collection[$key]);
            $this->collection = array_values($this->collection);
        } else {
            throw new \Exception('Tag not found');
        }
    }

    function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return \Domain\Core\Tag
     * @throws \Exception
     */
    public function current()
    {
        if (isset($this->collection[$this->position])) {
            return $this->collection[$this->position];
        } else {
            throw new \Exception('Not More Tags');
        }
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->collection[$this->position]);
    }

    /**
     * Return the num of items in the Collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->collection);
    }

}