<?php
/**
 * This is a file in the Decres project.
 * The Decres project is released under a MIT
 * license.
 *
 * @copyright 2012 - Wouter J
 * @version 1.0
 */

namespace Decres\Console\Command;

use Decres\Config\Config;
use Decres\Compressor\Compressor;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class CompressCommand extends Command
{
    protected $config;

    public function __construct()
    {
        parent::__construct();

        // parse compressors config
        $yaml = new Yaml();
        $compressors = $yaml->parse(ROOT.'config/compressors.yml');
        
        // save all compressors
        $this->config = new Config(
                            array_map(function($compressor) {
                                return new Compressor($compressor['class'], $compressor['extensions']);
                            }, $compressors)
                                  );
    }

    protected function configure()
    {
        $this
            ->setName('compress')
            ->setDescription('Compress a file or a project')
            ->addOption('no-gitignore', null, InputOption::VALUE_NONE, 'Do not use the gitignore file to ignore files');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        // find all files in the project
        $finder = new Finder();

        $files = $finder->files()->in(PROJECT_ROOT);

        // ignore files which are ingnored by .gitignore when --no-gitignore is not set
        if (!$input->getOption('no-gitignore') && file_exists(PROJECT_ROOT.'.gitignore')) {
            foreach (file(PROJECT_ROOT.'.gitignore') as $line) {
                $files->notName(trim($line));
            }
        }

        // compress the files
        foreach ($files as $file) {
            $compressor = $this->config->findCompressor(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
            $output->writeln($compressor->compress(file_get_contents($file->getRealpath())));
        }
    }
}
