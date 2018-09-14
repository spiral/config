<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Patches;

use Spiral\Config\Exceptions\DotNotFoundException;
use Spiral\Config\Patches\Traits\DotTrait;
use Spiral\Config\PatchInterface;

class DeletePatch implements PatchInterface
{
    use DotTrait;

    /** @var string */
    private $position;

    /** @var null|string */
    private $key;

    /** @var mixed */
    private $value;

    /**
     * @param string      $position
     * @param null|string $key
     * @param mixed       $value
     */
    public function __construct(string $position, ?string $key, $value = null)
    {
        $this->position = $position === '.' ? '' : $position;
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function patch(array $config): array
    {
        try {
            $target = &$this->dotGet($config, $this->position);

            if ($this->key !== null) {
                unset($target[$this->key]);
            } else {
                foreach ($target as $key => $value) {
                    if ($value === $this->value) {
                        unset($target[$key]);
                        break;
                    }
                }
            }
        } catch (DotNotFoundException $e) {
            // doing nothing when section not found
        }

        return $config;
    }
}