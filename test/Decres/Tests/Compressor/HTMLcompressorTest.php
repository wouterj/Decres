<?php

namespace Decres\Tests\Compressor;

use Decres\Compressor\HTMLcompressor;

class HTMLcompressorTest extends \PHPUnit_Framework_TestCase
{
    protected $compressor;

    public function setUp()
    {
        $this->compressor = new HTMLcompressor();
    }

    public function testEverything()
    {
        $input = <<<HTM
<!doctype html public>
<html lang=nl>
    <head>
        <meta charset="utf-8">

        <title>Hello World</title>

        <link rel=stylesheet href="css/style.css" type="text/css">
    </head>
    <body>
        <header>
            <hgroup>
                <h1 onclick="this.style.color = '#c33';">Hello World</h1>
            </hgroup>
        </header>
    </body>
</html>
HTM;

        $expected = <<<HTM
<!doctype html><html lang=nl><head><meta charset=utf-8><title>Hello World</title><link rel=stylesheet href=css/style.css></head><body><header><hgroup><h1 onclick="this.style.color = '#c33';">Hello World</h1></hgroup></header>
HTM;

        $this->assertEquals($expected, $this->compressor->compress($input));
    }
}
