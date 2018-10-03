<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;

class DefaultsTest extends BaseTest
{
    public function testGetNonExistedByDefaultConfig()
    {
        $cf = $this->getFactory();
        $cf->setDefault("magic", ['key' => 'value']);

        $config = $cf->getConfig('magic');

        $this->assertEquals(
            ['key' => 'value'],
            $config
        );

        $this->assertSame($config, $cf->getConfig('magic'));
    }

    /**
     * @expectedException \Spiral\Core\Exception\ConfiguratorException
     */
    public function testDefaultsTwice()
    {
        $cf = $this->getFactory();
        $cf->setDefault("magic", ['key' => 'value']);
        $cf->setDefault("magic", ['key' => 'value']);

    }

    /**
     * @expectedException \Spiral\Core\Exception\ConfiguratorException
     */
    public function testDefaultToAlreadyLoaded()
    {
        $cf = $this->getFactory();

        $cf->getConfig('test');
        $cf->setDefault("test", ['key' => 'value']);
    }

    public function testOverwrite()
    {
        $cf = $this->getFactory();

        $cf->setDefault("test", [
            'key' => 'value'
        ]);

        $config = $cf->getConfig('test');

        $this->assertEquals(
            [
                'key'      => 'value',
                'id'       => 'hello world',
                'autowire' => new \Spiral\Core\Container\Autowire('something')
            ],
            $config
        );

        $this->assertSame($config, $cf->getConfig('test'));
    }
}