<?php

/**
 * Een interface om alle compressors te groeperen
 */
interface CompressorInterface
{
    public function compress($str);
}
