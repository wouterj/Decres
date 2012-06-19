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
 * An empty compressor if no compressor was created for the file format
 *
 * @author Wouter J
 */
class EmptyCompressor implements CompressorInterface
{
    public function compress($str)
    {
        return $str;
    }
}
