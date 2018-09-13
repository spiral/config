<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Configurator;

interface LoaderInterface
{
    /**
     * @param string $section
     *
     * @return array
     *
     * @throws \Spiral\Configurator\Exceptions\LoaderException
     */
    public function loadData(string $section): array;
}