<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;

class PhpLoaderTest extends BaseTest
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
    }

    /**
     * @expectedException \Spiral\Config\Exceptions\LoaderException
     */
    public function testEmpty()
    {
        $cf = $this->getFactory();
        $cf->getConfig('empty');
    }

    /**
     * @expectedException \Spiral\Config\Exceptions\LoaderException
     */
    public function testBroken()
    {
        $cf = $this->getFactory();
        $cf->getConfig('broken');
    }

    public function testScope()
    {
        $cf = $this->getFactory();
        $config = $cf->getConfig('scope');

        $this->assertEquals(
            [
                'value' => 'value!'
            ],
            $config
        );
    }
}

class Value
{
    public function getValue()
    {
        return "value!";
    }
}