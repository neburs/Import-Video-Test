<?php
/**
 * A factory for create A Film
 */

namespace Domain\Factories;

use Domain\Core\Interfaces\FilmInterfaceEntity;
use Domain\Core\Film;
use Domain\Core\TagCollection;

class FilmFactory
{
    /**
     * @param FilmInterfaceEntity $filmEntity
     * @param string              $name
     * @param string              $url
     * @param string              $id
     * @param TagCollection       $tags
     *
     * @return Film
     */
    public static function buildFilm(
        FilmInterfaceEntity $filmEntity,
        $name,
        $url,
        $id = '',
        TagCollection $tags = null
    ) {
        return new Film(
            $filmEntity,
            $id,
            $name,
            $url,
            $tags
        );
    }
}