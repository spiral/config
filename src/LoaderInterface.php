<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config;

interface LoaderInterface
{
    /**
     * Return true if config section exists.
     *
     * @param string $section
     * @return bool
     */
    public function has(string $section): bool;

    /**
     * @param string $section
     * @return array
     *
     * @throws \Spiral\Config\Exception\LoaderException
     */
    public function load(string $section): array;
}