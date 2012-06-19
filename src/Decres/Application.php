<?php
/**
 * This is a file in the Decres project.
 * The Decres project is released under a MIT
 * license.
 *
 * @copyright 2012 - Wouter J
 * @version 1.0
 */

namespace Decres;

use Decres\Config\config;
use Decres\Compressor\Compressor;
use Symfony\Component\Yaml\Yaml;
use Symfony\component\Finder\Finder;

/**
 * The main class of this project
 *
 * @author Wouter J
 */
class Application
{
    protected $config;

    /**
     * Constructor.
     *
     * Get all registered compressors and load them into the config object
     */
    public function __construct()
    {
        $yaml = new Yaml();
        $compressors = $yaml->parse(ROOT.'config/compressors.yml');
        
        $this->config = new Config(
                            array_map(function($compressor) {
                                return new Compressor($compressor);
                            }, $compressors)
                                  );
    }

    /**
     * Begin compressing the project
     */
    public function run()
    {
        $finder = new Finder();
        var_dump($finder->files()->in(__DIR__);
    }
}
