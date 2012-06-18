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
}
