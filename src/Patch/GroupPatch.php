<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Patch;

use Spiral\Config\PatchInterface;

class GroupPatch implements PatchInterface
{
    /** @var array|PatchInterface[] */
    private $patches = [];

    /**
     * @param PatchInterface ...$patch
     */
    public function __construct(PatchInterface ...$patch)
    {
        $this->patches = $patch;
    }

    /**
     * @param array $config
     * @return array
     */
    public function patch(array $config): array
    {
        foreach ($this->patches as $patch) {
            $config = $patch->patch($config);
        }

        return $config;
    }
}