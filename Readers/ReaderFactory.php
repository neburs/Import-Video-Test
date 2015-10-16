<?php
/**
 * Factory to create the Readers Engine dynamically
 */

namespace Readers;

class ReaderFactory
{

    /**
     * Build an instance of requested provider reader
     *
     * @param string $provider
     *
     * @return \Readers\Interfaces\ReaderInstance Instance implementing
     *                                            this interface
     */
    public static function buildReaderEngine($provider)
    {
        $providerFinal = null;
        $class = __NAMESPACE__ . '\\'.ucfirst($provider).'Reader';
        if (class_exists($class))
        {
            $providerFinal = new $class();
        }

        return $providerFinal;
    }
}