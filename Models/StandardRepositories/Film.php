<?php
/**
 * Standard Repository for show the data of the film when try
 * to persist.
 */

namespace Models\StandardRepositories;

use Domain\Core\Interfaces\FilmInterfaceEntity;

class Film implements FilmInterfaceEntity
{
    /**
     * @param \Domain\Core\Film $film
     *
     * @return bool
     */
    public function persist($film)
    {
        $name = $film->getName();
        $url = $film->getUrl();

        echo 'importing: "' . $name . '"; Url: ' . $url;

        $tags = $film->getTags();
        if (!empty($tags)) {
            echo '; Tags: ';

            $total = $tags->count();
            foreach ($tags as $tag) {
                $tag->persist();

                if ($total > ($tags->key() + 1)) {
                    echo ',';
                }
            }
        }
        echo "\n";

        return true;
    }
}