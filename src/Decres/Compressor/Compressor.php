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
    protected $compressorName;
    protected $extensions;

    /**
     * Constructor.
     *
     * @param array         $compressor The name of the compressor
     * @param array|string  $extensions The extensions which match this compressor
     *
     * @throws \InvalidArgumentException When $compressor is of a wrong instance
     */
    public function __construct($compressor, $extensions)
    {
        $this->compressorName = $compressor;
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
        $compressorClass = $this->compressorName;

        return new $compressorClass();
    }
}
