<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;

use Spiral\Config\Patches\AppendPatch;

class AppendTest extends BaseTest
{
    public function testPushPatch()
    {
        $cf = $this->getFactory();
        $config = $cf->getConfig('scope');
        $this->assertEquals(['value' => 'value!'], $config);

        $cf->modify('scope', new AppendPatch('.', 'other', ['a' => 'b']));

        $config = $cf->getConfig('scope');
        $this->assertSame([
            'value' => 'value!',
            'other' => [
                'a' => 'b'
            ]
        ], $config);


        $cf->modify('scope', new AppendPatch('other', null, 'c'));

        $config = $cf->getConfig('scope');
        $this->assertSame([
            'value' => 'value!',
            'other' => [
                'a' => 'b',
                'c'
            ]
        ], $config);
    }

    /**
     * @expectedException \Spiral\Config\Exceptions\PatchException
     */
    public function testPushException()
    {
        $cf = $this->getFactory();
        $config = $cf->getConfig('scope');
        $this->assertEquals(['value' => 'value!'], $config);

        $cf->modify('scope', new AppendPatch('other', 'other', ['a' => 'b']));
    }
}