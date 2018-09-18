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

    protected function getFactory(string $directory = null, bool $strict = true): ConfigFactory
    {
        if (is_null($directory)) {
            $directory = __DIR__ . '/fixtures';
        }

        return new ConfigFactory(new DirectoryLoader($directory, $this->container), $strict);
    }
}