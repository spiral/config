<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;


use PHPUnit\Framework\TestCase;
use Spiral\Config\ConfigManager;
use Spiral\Config\Loader\DirectoryLoader;
use Spiral\Core\Container;

abstract class BaseTest extends TestCase
{
    /**
     * @var Container
     */
    protected $container;

    public function setUp()
    {
        $this->container = new Container();
    }

    protected function getFactory(string $directory = null, bool $strict = true): ConfigManager
    {
        if (is_null($directory)) {
            $directory = __DIR__ . '/fixtures';
        }

        return new ConfigManager(new DirectoryLoader($directory, $this->container), $strict);
    }
}