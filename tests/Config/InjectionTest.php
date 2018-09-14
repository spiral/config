<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;

use Spiral\Core\ConfiguratorInterface;
use Spiral\Core\InjectableConfig;

class InjectionTest extends BaseTest
{
    public function testInjection()
    {
        $cf = $this->getFactory();
        $this->container->bind(ConfiguratorInterface::class, $cf);

        $config = $this->container->get(TestConfig::class);

        $this->assertEquals(
            [
                'id'       => 'hello world',
                'autowire' => new \Spiral\Core\Container\Autowire('something')
            ],
            $config->toArray()
        );
    }
}

class TestConfig extends InjectableConfig
{
    const CONFIG = "test";
}