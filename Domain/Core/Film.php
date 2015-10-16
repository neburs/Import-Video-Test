<?php
/**
 * The representation of the Film Model in own Domain.
 */

namespace Domain\Core;

use Domain\Core\Interfaces\FilmInterfaceEntity;

class Film
{
    /**
     * @var \Domain\Core\Interfaces\FilmInterfaceEntity
     */
    private $filmEntity;
    /**
     * @var \Domain\Core\Id
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $url;
    /**
     * @var \Domain\Core\TagCollection
     */
    private $tags;

    /**
     * @param FilmInterfaceEntity $filmEntity
     * @param string              $id
     * @param string              $name
     * @param string              $url
     * @param TagCollection       $tags
     *
     * @throws \Exception
     */
    public function __construct(
        FilmInterfaceEntity $filmEntity,
        $id,
        $name,
        $url,
        TagCollection $tags = null
    ) {
        /**
         * @todo Improve this creating a custom Exception
         */
        if (empty($name)) {
            throw new \Exception('Name param can\'t be empty');
        } elseif (empty($url)) {
            throw new \Exception('Url param can\'t be empty');
        }

        if (empty($id)) {
            $this->id = new Id();
        } else {
            $this->id = new Id($id);
        }

        $this->filmEntity = $filmEntity;
        $this->name = $name;
        $this->url = $url;
        $this->tags = $tags;
    }

    /**
     * @return FilmInterfaceEntity
     */
    public function getFilmEntity()
    {
        return $this->filmEntity;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return TagCollection|null
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Persist the data
     *
     * @return bool
     */
    public function persist()
    {
        return $this->filmEntity->persist($this);
    }
}