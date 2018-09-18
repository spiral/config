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
     * @param string $section
     *
     * @return array
     *
     * @throws \Spiral\Config\Exception\LoaderException
     */
    public function loadData(string $section): array;
}