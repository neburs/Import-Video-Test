<?php
/**
 * Command to import and persist the films for the indicated reader.
 */

namespace Commands;

use Domain\Commands\SaveCommand;
use Models\StandardRepositories\Film;
use Models\StandardRepositories\Tag;
use Readers\Interfaces\ReaderInterface;
use Readers\ReaderFactory;

class ImportCommand
{
    /**
     * Launch the Import command with the reader indicated
     *
     * @param string $provider
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function execute($provider)
    {

        $readerEngine = ReaderFactory::buildReaderEngine($provider);

        /**
         * @todo Improve this creating a custom Exception
         */
        if (is_null($readerEngine)) {
            throw new \Exception('Impossible build the reader engine');
        }

        return $this->executeWithProvider($readerEngine);
    }

    /**
     * Launch the Import command with the reader injected
     *
     * @param ReaderInterface $readerEngine
     *
     * @return bool
     */
    protected function executeWithProvider(ReaderInterface $readerEngine)
    {
        $data = $this->readData($readerEngine);

        $res = false;

        if (!empty($data)) {
            foreach ($data as $item) {
                $cmd = new SaveCommand(
                    new Film(),
                    new Tag()
                );

                $res = $cmd->execute($item);

                if (false == $res) {
                    break;
                }
            }
        }

        return $res;

    }

    /**
     * @param ReaderInterface $readerEngine
     * @see /Readers Dir
     *
     * @return array
     */
    private function readData(ReaderInterface $readerEngine)
    {
        return $readerEngine->readData();
    }

}