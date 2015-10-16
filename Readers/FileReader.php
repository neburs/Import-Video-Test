<?php
/**
 * For Readers that need to know all absolute paths files
 */
namespace Readers;

class FileReader
{
    /**
     * Return an array with all absolute path files in $dir
     * directory that start with prefix and have the $format
     * requested.
     *
     * @param string $dir
     * @param string $prefix
     * @param string $format
     *
     * @return array
     */
    protected function getOriginPaths($dir, $prefix, $format)
    {
        return glob($dir . '/' . $prefix . '*.' . $format);
    }

}