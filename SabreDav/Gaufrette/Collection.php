<?php

/*
 * This file is part of the SecotrustSabreDavBundle package.
 *
 * (c) Henrik Westphal <henrik.westphal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Secotrust\Bundle\SabreDavBundle\SabreDav\Gaufrette;

use Gaufrette\Filesystem;
use Sabre\DAV\Collection as BaseCollection;
use Sabre\DAV\Exception;

class Collection extends BaseCollection
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @param Filesystem $filesystem
     * @param string $prefix
     */
    public function __construct(Filesystem $filesystem, $prefix = '')
    {
        $this->filesystem = $filesystem;
        $this->prefix = $prefix;
    }

    /**
     * @inheritdoc
     */
    public function getChildren()
    {
        $children = array();

        $keys = $this->filesystem->listKeys($this->prefix);

        foreach ($this->getDirectories($keys['dirs']) as $dir) {
            $children[] = $this->getChild($dir);
        }

        foreach ($this->getFiles($keys['keys']) as $file) {
            $children[] = $this->getChild($file);
        }

        return $children;
    }

    /**
     * @inheritdoc
     */
    public function getChild($name)
    {
        $key = $this->prefix.$name;

        if (!$this->filesystem->has($key)) {
            throw new Exception\NotFound('The file with name: ' . $name . ' could not be found');
        }

        if ($this->filesystem->getAdapter()->isDirectory($key)) {
            return new Collection($this->filesystem, $key.'/');
        }

        return new File($this->filesystem->get($key));
    }

    /**
     * @inheritdoc
     */
    public function childExists($name)
    {
        return $this->filesystem->has($this->prefix.$name);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->prefix;
    }

    /**
     * @inheritdoc
     */
    public function getLastModified()
    {
        return $this->filesystem->getAdapter()->mtime($this->prefix);
    }

    /**
     * @param array $dirs
     *
     * @return array
     */
    protected function getDirectories(array $dirs)
    {
        $result = array();

        foreach ($dirs as $dir) {
            $parts = explode('/', str_replace($this->prefix, '', $dir), 2);
            $result[$parts[0]] = true;
        }

        return array_keys($result);
    }

    /**
     * @param array $files
     *
     * @return array
     */
    protected function getFiles(array $files)
    {
        $result = array();

        foreach ($files as $file) {
            $name = str_replace($this->prefix, '', $file);
            if (false === strpos($name, '/')) {
                $result[] = $name;
            }
        }

        return $result;
    }
}
