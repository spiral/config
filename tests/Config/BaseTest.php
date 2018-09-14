<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;


use PHPUnit\Framework\TestCase;
use Spiral\Config\ConfigFactory;
use Spiral\Config\Loaders\DirectoryLoader;
use Spiral\Core\Container;

abstract class BaseTest extends TestCase
{
    protected function getFactory(string $directory = null, bool $strict = true): ConfigFactory
    {
        if (is_null($directory)) {
            $directory = __DIR__ . '/fixtures';
        }

        return new ConfigFactory(
            new DirectoryLoader($directory, new Container()),
            $strict
        );
    }
}