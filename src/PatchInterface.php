<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Configurator;

interface PatchInterface
{
    /**
     * Patches loaded config file with new values and/or sections. Multiple modifiers can be
     * applied at once.
     *
     * @param array $config
     *
     * @return array
     *
     * @throws \Spiral\Configurator\Exceptions\PatchException
     */
    public function patch(array $config): array;
}