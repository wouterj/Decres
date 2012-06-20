<?php

namespace Decres\Tests\Compressor;

use Decres\Compressor\CSScompressor;

class CSScompressorTest extends \PHPUnit_Framework_TestCase
{
    protected $compressor;

    public function setUp()
    {
        $this->compressor = new CSScompressor();
    }

    public function testCommentsRemoving()
    {
        $css = '/* CSS reset */ body { margin: 0; } /*! Important comment */';
        $css = $this->compressor->removeComments($css);

        $this->assertEquals(' body { margin: 0; } /*! Important comment */', $css);
    }

    public function testSemicolonRemoving()
    {
        $this->assertEquals('bar}', $this->compressor->removeLastSemicolon('bar;}'));
        $this->assertEquals('bar}', $this->compressor->removeLastSemicolon('bar; }'));
        $this->assertEquals('bar}', $this->compressor->removeLastSemicolon('bar; 
    }'));
    }

    public function testWhitespaceRemoving()
    {
        $this->assertEquals('{foo:bar;}', $this->compressor->removeWhitespace('{foo: bar;}'));
        $this->assertEquals('{foo:bar;}', $this->compressor->removeWhitespace('{foo : bar;}'));
        $this->assertEquals('{foo:bar;}', $this->compressor->removeWhitespace('{
            foo : bar;
    }'));
        $this->assertEquals('{foo:1px bar;}', $this->compressor->removeWhitespace('{foo : 1px bar;}'));
    }

    /**
     * Test everything
     *
     * Skip this test as long as the TODO isn't fixed
     *
     * @see Decres\Compressor\CSScompressor::removeWhitespace()
     */
    public function testEverything()
    {
        $this->markTestSkipped('TODO needs to be fixed first');
        $input = <<<CSS
/*!
 * This is a test stylesheet created by Wouter J
 */
/* Some reset */
html, body
{
    width: 100%;
    height: 100%;
}
* {
    margin: 0;
    padding: 0;
    border: 1px solid #000;
}

/* Header */
header h1    {
    font-size: 20pt;
    color: #666;
}
CSS;
        $expected = <<<CSS
/*!
 * This is a test stylesheet created by Wouter J
 */
html,body{width:100%;height:100%}*{margin:0;padding:0;border:1px solid #000}header h1{font-size:20pt;color: #666}
CSS;

        $this->assertEquals($expected, $this->compressor->compress($input));
    }
}
