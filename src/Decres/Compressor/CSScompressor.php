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

class CSScompressor implements CompressorInterface
{
    /**
     * Remove the CSS comments
     *
     * @param  string $str The code
     * @return string
     */
    public function removeComments($str)
    {
        // remove /* ... */
        //
        // \/\*  = /*
        // (?!!) = don't remove /*!
        // .*?   = the comment text
        // \*\/  = */
        // /s    = dotall (. matches new line characters)
		return preg_replace('/\/\*(?!!).*?\*\//s', '', $str);
    }

    /**
     * Remove the last semicolon of a declaration block
     *
     * @param  string $str The code
     * @return string
     */
    public function removeLastSemicolon($str)
    {
        // change foo: bar; } into foo: bar }
        //
        // \;    = ;
        // .*    = spaces or new lines between last value and closing brace
        // (?=}) = }
        // /s    = dotall (. matches new line characters)
		return preg_replace('/\;.*(?=})/s', '', $str);
    }

    /**
     * Remove the whitespace
     *
     * @param  string $str The code
     * @return string
     */
    public function removeWhitespace($str)
    {
        // remove new lines
        //
        // \R = linebreaks (\n, \r, \n\r)
		$str = preg_replace('/\R/s', '', $str);

        // capture all properties and values in a declaration block
		$str = preg_replace_callback('/({.*?})/s', function( $match ) {
            // capture everything between ; and :
			$s = preg_replace_callback('/(;.*?(:|}))/', function( $m ) {
                // remove whitespace
				return preg_replace('/\s/s', '', $m[1]);
			}, $match[1]);

            // capture everything between { and the first property
			$s = preg_replace_callback('/({.*?\w)/', function( $m ) {
                // remove whitespace
				return preg_replace('/\s/s', '', $m[1]);
			}, $s);

            return $s;
		}, $str);

        // remove whitespace around :
        return preg_replace('/\s*:\s*/', ':', $str);
    }

    public function compress($str)
    {
        $str = $this->removeComments($str);
        $str = $this->removeLastSemicolon($str);
        $str = $this->removeWhitespace($str);

        return $str;
    }
}
