<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;

use Spiral\Config\Patch\AppendPatch;

class AppendTest extends BaseTest
{
    public function testPatch()
    {
        $cf = $this->getFactory();

        $this->assertEquals(['value' => 'value!'], $cf->getConfig('scope'));

        $cf->modify('scope', new AppendPatch('.', 'other', ['a' => 'b']));

        $this->assertSame([
            'value' => 'value!',
            'other' => ['a' => 'b']
        ], $cf->getConfig('scope'));

        $cf->modify('scope', new AppendPatch('other.', null, 'c'));

        $this->assertSame([
            'value' => 'value!',
            'other' => [
                'a' => 'b',
                'c'
            ]
        ], $cf->getConfig('scope'));
    }

    /**
     * @expectedException \Spiral\Config\Exception\PatchException
     */
    public function testException()
    {
        $cf = $this->getFactory();
        $config = $cf->getConfig('scope');
        $this->assertEquals(['value' => 'value!'], $config);

        $cf->modify('scope', new AppendPatch('other', 'other', ['a' => 'b']));
    }
}