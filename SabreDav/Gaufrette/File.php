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

use Sabre\DAV\Exception;
use Sabre\DAV\File as BaseFile;
use Sabre\DAV\Sabre;

class File extends BaseFile
{
    /**
     * @var \Gaufrette\File
     */
    protected $file;

    /**
     * Constructor
     *
     * @param \Gaufrette\File $file
     */
    public function __construct(\Gaufrette\File $file)
    {
        $this->file = $file;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->file->getName();
    }

    /**
     * @inheritdoc
     */
    public function getSize()
    {
        return $this->file->getSize();
    }

    /**
     * @inheritdoc
     */
    public function getLastModified()
    {
        return $this->file->getMtime();
    }

    /**
     * @inheritdoc
     */
    public function put($data)
    {
        $this->file->setContent($data);
    }

    /**
     * @inheritdoc
     */
    public function get()
    {
        return $this->file->getContent();
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        $this->file->delete();
    }
}
