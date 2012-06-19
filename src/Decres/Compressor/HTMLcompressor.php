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

class HTMLcompressor implements CompressorInterface
{
    /**
     * Remove the HTML comments
     *
     * @param  string $str The code
     * @return string
     */
    public function removeComments($str)
    {
        // remove <!-- ... -->
		return preg_replace('/<!--.*?-->/s', '', $str);
    }

    /**
     * Remove the whitespace
     *
     * @param  string $str The code
     *
     * @return string
     */
    public function removeWhitespace($str)
    {
        // remove new lines
        //
        // \R = linebreaks (\n, \r, \n\r)
		$str = preg_replace('/\R/s', '', $str);

        $str = preg_replace('/>(\s|\t)*?</', '><', $str);

        return $str;
    }

    public function compress($str)
    {
        $str = $this->removeComments($str);
        $str = $this->removeWhitespace($str);

        return $str;
    }
}
