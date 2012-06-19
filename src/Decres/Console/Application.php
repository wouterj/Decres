<?php
/**
 * This is a file in the Decres project.
 * The Decres project is released under a MIT
 * license.
 *
 * @copyright 2012 - Wouter J
 * @version 1.0
 */

namespace Decres\Console;

use Decres\Console\Command\CompressCommand;

use Symfony\Component\Console\Application as BaseApplication;

/**
 * The main class of this project
 *
 * @author Wouter J
 */
class Application extends BaseApplication
{
    protected $config;

    /**
     * Constructor.
     *
     * Get all registered compressors and load them into the config object
     */
    public function __construct()
    {
        parent::__construct('Decres', '1.0');

        $this->add(new CompressCommand());
    }
}
