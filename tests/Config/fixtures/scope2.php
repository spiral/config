<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
return [
    'value'=>\Spiral\Core\ContainerScope::getContainer()->get(\Spiral\Config\Tests\Value::class)->getValue()
];