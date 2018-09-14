<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Loaders;

use Spiral\Config\Exceptions\LoaderException;

interface DataLoaderInterface
{
    /**
     * Load file content.
     *
     * @param string $section
     * @param string $filename
     * @return array
     *
     * @throws LoaderException
     */
    public function loadFile(string $section, string $filename): array;
}