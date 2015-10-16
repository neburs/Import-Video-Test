<?php
/**
 * Domain Action to persist a film
 */

namespace Domain\Commands;

use Domain\Core\Interfaces\FilmInterfaceEntity;
use Domain\Core\Interfaces\TagInterfaceEntity;
use Domain\Factories\FilmFactory;
use Domain\Factories\TagCollectionFactory;

class SaveCommand
{
    /** @var  FilmInterfaceEntity */
    private $filmEntity;
    /** @var  TagInterfaceEntity */
    private $tagEntity;

    /**
     * Receive the strategy for persist the data.
     *
     * @param FilmInterfaceEntity $filmEntity
     * @param TagInterfaceEntity  $tagEntity
     */
    public function __construct(
        FilmInterfaceEntity $filmEntity,
        TagInterfaceEntity $tagEntity
    ) {
        $this->filmEntity = $filmEntity;
        $this->tagEntity = $tagEntity;
    }

    /**
     * Persist the film data.
     *
     * @param array $data Data of film with the next structure:
     *                    [
     *                      [
     *                          'id' => the id of the film
     *                          'name' => The name
     *                          'url' => the url of the film
     *                          'tags' => [tag1, tag2, ...]
     *                      ],
     *                      ...
     *                    ]
     *                    Note: The id and the tags can be empty
     *
     * @return bool
     */
    public function execute($data)
    {
        $tagCollection = TagCollectionFactory::buildTagCollectionFromArray(
            $this->tagEntity,
            $data['tags']
        );
        $film = FilmFactory::buildFilm(
            $this->filmEntity,
            $data['name'],
            $data['url'],
            $data['id'],
            $tagCollection
        );

        $film->persist();

        return true;
    }
}