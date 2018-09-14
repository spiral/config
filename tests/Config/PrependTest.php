<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;

use Spiral\Config\Patches\PrependPatch;

class PrependTest extends BaseTest
{
    public function testPushPatch()
    {
        $cf = $this->getFactory();

        $this->assertEquals(['value' => 'value!'], $cf->getConfig('scope'));

        $cf->modify('scope', new PrependPatch('.', 'other', ['a' => 'b']));

        $this->assertSame([
            'other' => ['a' => 'b'],
            'value' => 'value!',
        ], $cf->getConfig('scope'));

        $cf->modify('scope', new PrependPatch('other.', null, 'c'));

        $this->assertSame([
            'other' => [
                'c',
                'a' => 'b',
            ],
            'value' => 'value!',
        ], $cf->getConfig('scope'));
    }

    /**
     * @expectedException \Spiral\Config\Exceptions\PatchException
     */
    public function testException()
    {
        $cf = $this->getFactory();
        $config = $cf->getConfig('scope');
        $this->assertEquals(['value' => 'value!'], $config);

        $cf->modify('scope', new PrependPatch('other', 'other', ['a' => 'b']));
    }
}