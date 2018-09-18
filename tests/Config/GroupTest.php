<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;

use Spiral\Config\Patch\AppendPatch;
use Spiral\Config\Patch\DeletePatch;
use Spiral\Config\Patch\GroupPatch;
use Spiral\Config\Patch\PrependPatch;

class GroupTest extends BaseTest
{
    public function testPatch()
    {
        $cf = $this->getFactory();
        $this->assertEquals(['value' => 'value!'], $cf->getConfig('scope'));

        $cf->modify('scope', new GroupPatch(
            new PrependPatch('.', 'other', ['a' => 'b']),
            new DeletePatch('other', 'a'),
            new AppendPatch('other', 'c', 'd')
        ));

        $this->assertEquals([
            'other' => ['c' => 'd'],
            'value' => 'value!'
        ], $cf->getConfig('scope'));
    }
}