<?php
/**
 * A Method for generate an Id.
 */

namespace Domain\Core;

class Id
{
    /**
     * @var string $id
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct($id = '')
    {
        if (empty($id)) {
            $id = uniqid();
        }
        $this->id = (string)$id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}