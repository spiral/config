<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config;

/**
 * Provides ability to modify configs values in runtime.
 */
interface ModifierInterface
{
    /**
     * Modifies selected config section. Must throw `PatchDeliveredException` if modification is
     * not allowed due config has already been delivered.
     *
     * @param string         $section
     * @param PatchInterface $patch
     *
     * @return array
     *
     * @throws \Spiral\Core\Exceptions\ConfiguratorException
     */
    public function modify(string $section, PatchInterface $patch): array;
}