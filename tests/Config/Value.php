<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace Spiral\Config\Tests;

class Value
{
    private $value;

    public function __construct(string $value = 'value!')
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
