<?php
/**
 * Engine for read data from flub feeds
 */

namespace Readers;

use Symfony\Component\Yaml\Parser;
use Readers\Interfaces\ReaderInterface;

class FlubReader extends FileReader implements ReaderInterface
{
    private $dirFeeds;
    private $prefix;

    /**
     * @param string $dirFeeds
     * @param string $prefix
     */
    public function __construct(
        $dirFeeds = __DIR__ . '/../feed-exports',
        $prefix = 'flub'
    ) {
        $this->dirFeeds = $dirFeeds;
        $this->prefix = $prefix;
    }

    /**
     * Read the data from all feeds of flub
     *
     * @return array Whit the next structure
     *               [
     *                  [
     *                      'id' => the id of the film
     *                      'name' => The name
     *                      'url' => the url of the film
     *                      'tags' => [tag1, tag2, ...]
     *                  ],
     *                  ...
     *               ]
     *               Note: The id and the tags can be empty
     */
    public function readData()
    {
        $filesToRead = $this->getOriginPaths(
            $this->dirFeeds,
            $this->prefix,
            'yaml'
        );

        $dataFilms = [];
        foreach ($filesToRead as $file) {
            $dataFilms = array_merge(
                $dataFilms,
                $this->readFilmsData($file)
            );
        }

        return $dataFilms;
    }

    private function readFilmsData($file) {

        $yaml = new Parser();

        try {

            $data = $yaml->parse(file_get_contents($file));
        } catch (\Exception $e) {
            $data = null;
        }

        $dataFilms = null;

        if (!empty($data)) {
            $dataFilms = [];
            foreach ($data as $item) {
                $dataFilms[] = $this->fillFilmData($item);
            }
        }

        return $dataFilms;
    }

    private function fillFilmData($item)
    {
        $dataFilm = null;

        $tags = null;
        if (isset($item['labels'])) {
            $tags = $this->fillFilmTags($item['labels']);
        }
        $dataFilm = [
            'id' => '',
            'name' => $item['name'],
            'url' => $item['url'],
            'tags' => $tags
        ];

        return $dataFilm;
    }

    private function fillFilmTags($tags)
    {
        $tagsData = null;
        if (!empty($tags)) {
            $tagsData = explode(', ', $tags);
        }

        return $tagsData;
    }
}