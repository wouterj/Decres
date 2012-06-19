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
use Symfony\Component\Finder\Finder;

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
                                return new Compressor($compressor['class'], $compressor['extensions']);
                            }, $compressors)
                                  );
    }

    /**
     * Begin compressing the project
     *
     * @todo add option for use of .gitignore
     */
    public function run()
    {
        // find all files in the project
        $finder = new Finder();

        $files = $finder->files()->in(PROJECT_ROOT);

        // ignore files which are ingnored by .gitignore
        if (file_exists(PROJECT_ROOT.'.gitignore')) {
            foreach (file(PROJECT_ROOT.'.gitignore') as $line) {
                $files->notName(trim($line));
            }
        }

        // compress the files
        foreach ($files as $file) {
            $compressor = $this->config->findCompressor(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
            var_dump($compressor->compress(file_get_contents($file->getRealpath())));
        }
    }
}
