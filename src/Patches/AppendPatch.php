<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Patches;

use Spiral\Config\Exceptions\DotNotFoundException;
use Spiral\Config\Exceptions\PatchException;
use Spiral\Config\Patches\Traits\DotTrait;
use Spiral\Config\PatchInterface;

class AppendPatch implements PatchInterface
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
    public function __construct(string $position, ?string $key, $value)
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
                $target[$this->key] = $this->value;
            } else {
                $target[] = $this->value;
            }
        } catch (DotNotFoundException $e) {
            throw new PatchException($e->getMessage(), $e->getCode(), $e);
        }

        return $config;
    }
}