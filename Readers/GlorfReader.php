<?php
/**
 * Engine for read data from Glorf feeds
 */

namespace Readers;

use Readers\Interfaces\ReaderInterface;

class GlorfReader extends FileReader implements ReaderInterface
{
    private $dirFeeds;
    private $prefix;

    /**
     * @param string $dirFeeds
     * @param string $prefix
     */
    public function __construct(
        $dirFeeds = __DIR__ . '/../feed-exports',
        $prefix = 'glorf'
    ) {
        $this->dirFeeds = $dirFeeds;
        $this->prefix = $prefix;
    }

    /**
     * Read the data from all feeds of glorf
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
            'json'
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

    private function readFilmsData($file)
    {
        $data = json_decode(
            file_get_contents(
                $file
            ),
            true
        );
        $dataFilms = null;

        if (!empty($data)
            && isset($data['videos'])
            && !empty($data['videos'])
        ) {
            $dataFilms = [];
            foreach ($data['videos'] as $item) {
                $dataFilms[] = $this->fillFilmData($item);
            }
        }

        return $dataFilms;
    }

    private function fillFilmData($item)
    {
        $dataFilm = null;

        $tags = null;
        if (isset($item['tags'])) {
            $tags = $this->fillFilmTags($item['tags']);
        }
        $dataFilm = [
            'id'   => '',
            'name' => $item['title'],
            'url'  => $item['url'],
            'tags' => $tags
        ];

        return $dataFilm;
    }

    private function fillFilmTags($tags)
    {
        $tagsData = null;
        if (!empty($tags)) {
            $tagsData = [];
            foreach ($tags as $tag) {
                $tagsData[] = $tag;
            }
        }

        return $tagsData;
    }
}