<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Tests;

use Spiral\Config\Patch\Append;
use Spiral\Config\Patch\Delete;
use Spiral\Config\Patch\Group;
use Spiral\Config\Patch\Prepend;

class GroupTest extends BaseTest
{
    public function testPatch()
    {
        $cf = $this->getFactory();
        $this->assertEquals(['value' => 'value!'], $cf->getConfig('scope'));

        $cf->modify('scope', new Group(
            new Prepend('.', 'other', ['a' => 'b']),
            new Delete('other', 'a'),
            new Append('other', 'c', 'd')
        ));

        $this->assertEquals([
            'other' => ['c' => 'd'],
            'value' => 'value!'
        ], $cf->getConfig('scope'));
    }
}