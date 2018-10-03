<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;

class ConfigFactoryTest extends BaseTest
{
    public function testGetConfig()
    {
        $cf = $this->getFactory();
        $config = $cf->getConfig('test');

        $this->assertEquals(
            [
                'id'       => 'hello world',
                'autowire' => new \Spiral\Core\Container\Autowire('something')
            ],
            $config
        );

        $this->assertSame($config, $cf->getConfig('test'));
    }

    public function testExists()
    {
        $cf = $this->getFactory();
        $this->assertTrue($cf->exists('test'));
        $this->assertFalse($cf->exists('magic'));

        $cf->setDefaults('magic', ['key' => 'value']);

        $this->assertTrue($cf->exists('magic'));
    }

    /**
     * @expectedException \Spiral\Config\Exception\LoaderException
     */
    public function testConfigError()
    {
        $cf = $this->getFactory();
        $cf->getConfig('other');
    }

    /**
     * @expectedException \Spiral\Config\Exception\InvalidArgumentException
     */
    public function testDirectoryError()
    {
        $cf = $this->getFactory("other");
    }
}