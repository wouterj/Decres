<?php
/**
 * This is a file in the Decres project.
 * The Decres project is released under a MIT
 * license.
 *
 * @copyright 2012 - Wouter J
 * @version 1.0
 */

namespace Decres\Config;

use Decres\Compressor\EmptyCompressor;

class Config
{
    protected $compressors;

    /**
     * Constructor.
     *
     * @param array $compressors An assoc array with all registered compressors with their classname and extensions
     *
     * @throws \InvalidArgumentException When $compressors is not an array
     */
    public function __construct($compressors)
    {
        if (!is_array($compressors)) {
            throw new \InvalidArgumentException(sprintf('Argument 1 of Application::__construct() needs to be an array, %s given',
                                                       gettype($compressors)));
        }

        $this->compressors = $compressors;
    }

    /**
     * @return array
     */
    public function getCompressors()
    {
        return $this->compressors;
    }

    /**
     * Find a compressor by matching his extension
     *
     * @param string $extension
     *
     * @return boolean
     */
    public function findCompressor($extension)
    {
        foreach ($this->compressors as $compressor)
        {
            if ($compressor->match($extension)) {
                return $compressor->getCompressor();
            } else {
                return new EmptyCompressor();
            }
        }
    }
}
