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
     */
    public function removeComments($str)
    {
        // remove <!-- ... -->
		return preg_replace('/<!--.*?-->/s', '', $str);
    }

    /**
     * Change to small doctype
     */
    public function changeDoctype($str)
    {
        return preg_replace('/<!doctype html.*?>/i', '<!doctype html>', $str);
    }

    /**
     * Remove the whitespace
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

    /**
     * Remove optional start and end tags
     *
     * @link http://youtu.be/WxmcDoAxdoY?t=16m11s
     */
    public function removeOptionalTags($str)
    {
        $optionalTags = array(
            /* Let's keep this tags
            '<html>',
            '<head>',
            '<body>', */

            // closing tags
            '</html>',
            //'</head>',
            '</body>',

            // lists
            '</dt>',
            '</dd>',
            '</li>',

            // tables
            '</th>',
            '</tr>',
            '</td>',

            // others
            '</p>',
            '</option>',

            // empty elements
            '</br>',
            '</link>',
            '</meta>',
            '</hr>',
        );

        foreach ($optionalTags as $tag) {
            $str = preg_replace('|'.preg_quote($tag).'|', '', $str);
        }

        return $str;
    }

    /**
     * Remove attribute quotes when possible
     */
    public function removeAttributeQuotes($str)
    {
        // select all attribute values
        return preg_replace_callback('/(?<=\=)("|\')(.*?)("|\')(?=(\>|\s))/', function($match) {
            // is there an illegal character in the value?
            return (preg_match('/[ <>\'"=`]/', $match[2])
                        ? '"'.$match[2].'"'
                        // no? remove the quotes!!
                        : $match[2]
                   );
        }, $str);
    }

    /**
     * Remove optional attributes
     */
    public function removeOptionalAttributes($str)
    {
        // remove <link ... type="text/css"
        $str = preg_replace('/<link([^>]*?) type=.*?(?=(\s|>))/', '<link\\1', $str);

        // remove <script ... type="text/javascript"
        $str = preg_replace('/<script([^>]*?) type=.*?(?=(\s|>))/', '<script\\1', $str);

        return $str;
    }

    public function compress($str)
    {
        $str = $this->removeComments($str);
        $str = $this->removeWhitespace($str);
        $str = $this->changeDoctype($str);
        $str = $this->removeOptionalTags($str);
        $str = $this->removeOptionalAttributes($str);
        $str = $this->removeAttributeQuotes($str);

        return $str;
    }
}
