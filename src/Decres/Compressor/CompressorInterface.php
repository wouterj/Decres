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
 * Een interface om alle compressors te groeperen
 *
 * @author Wouter J
 */
interface CompressorInterface
{
    /**
     * @param  string $str The code which needs to be compressed
     * @return string $str The compressed code
     */
    public function compress($str);
}
