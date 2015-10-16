<?php
/**
 * Interface to define how interact the domain with the DBO
 */

namespace Domain\Core\Interfaces;

interface FilmInterfaceEntity
{
    /**
     * Persist the film indicated with all related data.
     *
     * @param \Domain\Core\Film $film
     */
    public function persist($film);
}