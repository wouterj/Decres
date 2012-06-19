<?php
/**
 * This is a file in the Decres project.
 * The Decres project is released under a MIT
 * license.
 *
 * @copyright 2012 - Wouter J
 * @version 1.0
 */

namespace Decres\Compressor;

/**
 * This class represents each compressor
 *
 * @author Wouter J
 */
class Compressor
{
    protected $compressor;
    protected $extensions;

    /**
     * Constructor.
     *
     * @param Decres\Compressor\CompressorInterface $compressor The compressor which needs to be hold
     * @param array|string                          $extensions The extensions which match this compressor
     *
     * @throws \InvalidArgumentException When $compressor is of a wrong instance
     */
    public function __construct($compressor, $extensions)
    {
        if (!$compressor instanceof CompressorInterface) {
            throw new \InvalidArgumentException(sprintf('The first argument of Compressor::__construct() needs to be an instance of Decres\Compressor\CompressorInterface, %s given',
                                                       get_class($compressor)));
        }

        $this->compressor = $compressor;
        $this->extensions = (is_array($extensions)
                                ? $extensions
                                : array($extensions)
                            );
    }

    /**
     * Checks if the extension matches this compressor
     *
     * @param string $extension
     *
     * @return boolean
     */
    public function match($extension)
    {
        return in_array($extension, $this->extensions);
    }

    /**
     * @return Decres\Compressor\CompressorInterface The compressor
     */
    public function getCompressor()
    {
        return $this->compressor;
    }
}
