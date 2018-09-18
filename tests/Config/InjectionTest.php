<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;

use Spiral\Config\Patch\AppendPatch;
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

        $this->assertSame($config, $this->container->get(TestConfig::class));
    }

    /**
     * @expectedException \Spiral\Config\Exception\PatchDeliveredException
     */
    public function testModifyAfterInjection()
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

        $cf->modify('test', new AppendPatch(".", null, "value"));
    }

    public function testNonStrict()
    {
        $cf = $this->getFactory(null, false);
        $this->container->bind(ConfiguratorInterface::class, $cf);

        $config = $this->container->get(TestConfig::class);

        $this->assertEquals(
            [
                'id'       => 'hello world',
                'autowire' => new \Spiral\Core\Container\Autowire('something')
            ],
            $config->toArray()
        );

        $cf->modify('test', new AppendPatch(".", 'key', "value"));

        $config = $this->container->get(TestConfig::class);

        $this->assertEquals(
            [
                'id'       => 'hello world',
                'autowire' => new \Spiral\Core\Container\Autowire('something'),
                'key'      => 'value'
            ],
            $config->toArray()
        );
    }
}

class TestConfig extends InjectableConfig
{
    const CONFIG = "test";
}