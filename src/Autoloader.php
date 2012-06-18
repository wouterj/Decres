<?php

namespace Decres;

/**
 * This class is the autoloader for all classes in Decres
 *
 * @package Decres
 */
class Autoloader
{
	protected $namespaces = array();
	protected $prefixes = array();
    protected $classes = array();
	protected $base = '';

    /**
     * Set predefined classnames into a path
     *
     * @param array|string $name The name of the classes, if it's a array the key is the name and the value the path
     * @param string       $path Optional The path of the class
     */
    public function setClasses($name, $path = null)
    {
        if (is_array($name) && (null === $path)) {
            $this->classes = $name;
        } else {
            $this->classes[$name] = $path;
        }
    }

	/**
	 * Set predefined prefixes if $name is a array, and add prefix if $name is a string
	 *
	 * @param array|string $name All the prefixes if is array, if this is a string the prefixes name
	 * @param string       $path Optional The path of the prefix
	 */
	public function setPrefixes($name, $path = null)
	{
		if (is_array($name) && (null === $path)) {
			$this->prefixes = $name;
        } else {
			$this->prefixes[$name] = $path;
        }
	}

	/**
	 * Set predefined namespaces if $name is a array, and add a namespace if $name is a string
	 *
	 * @param array|string $name All the namespaces if is array, if this is a string the namespace name
	 * @param string       $path Optoinal The path of the namespace
	 */
	public function setNamespaces($name, $path = null)
	{
		if (is_array($name) && (null === $path)) {
			$this->namespaces = $name;
        } else {
			$this->namespaces[$name] = $path;
        }
	}

	/**
	 * Set the base directory
	 *
	 * @param string $dir This dir must be absolute
	 */
	public function setBaseDir($dir)
	{
		if (!in_array(substr($dir, -1), Array('/', '\\'))) {
			$dir .= DIRECTORY_SEPARATOR;
        }
		$this->base = $dir;
	}

	/**
	 * Get the base directory
	 *
	 * @return string $dir The directory
	 */
	public function getBaseDir()
	{
		return $this->base;
	}

	/**
	 * Register the classloader as a spl autolader
	 */
	public function register()
	{
		spl_autoload_register(array($this, 'loadClass'), true);
	}

	/**
	 * The actuall loading of classes
	 *
	 * @param string $className The name of the path inclusive namespaces
	 */
	public function loadClass($className)
	{
		$file = $this->getFilePath($className);

		if(file_exists($file)) {
			require_once $this->base.$file;
		}
	}

	/**
	 * Get the path of the class file, this function use {@link https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md the PSR-0 standards}
	 *
	 * @param  string  $className The name of the class inclusive namespaces
	 * @return string  $path      The path
	 */
	public function getFilePath($className)
	{
		$className = ltrim($className, '\\');
		$path = '';
		$namespace = '';

        foreach ($this->classes as $name => $path) {
            if ($className == $name) {
                $className = $path;
            }
        }

		if ($lastNsPos = strripos($className, '\\')) {
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			
			foreach ($this->namespaces as $name => $path) {
				$namespace = str_replace($name, $path, $namespace);
            }
			
			$path = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}

		foreach ($this->prefixes as $prefixName => $prefixPath) {
			$className = str_replace($prefixName, $prefixPath.'_', $className);
		}

		$path .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

		return $path;
	}
}
