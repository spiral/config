<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;

class JsonLoaderTest extends BaseTest
{
    public function testGetConfig()
    {
        $cf = $this->getFactory();

        $this->assertEquals(['name' => 'value'], $cf->getConfig('json'));
    }

    /**
     * @expectedException \Spiral\Config\Exceptions\LoaderException
     */
    public function testEmpty()
    {
        $cf = $this->getFactory();
        $cf->getConfig('empty-json');
    }

    /**
     * @expectedException \Spiral\Config\Exceptions\LoaderException
     */
    public function testBroken()
    {
        $cf = $this->getFactory();
        $cf->getConfig('broken-json');
    }
}