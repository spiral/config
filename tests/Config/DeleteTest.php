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

class DeleteTest extends BaseTest
{
    public function testPatch()
    {
        $cf = $this->getFactory();

        $this->assertEquals(['value' => 'value!'], $cf->getConfig('scope'));

        $cf->modify('scope', new AppendPatch('.', 'other', ['a' => 'b']));
        $cf->modify('scope', new DeletePatch('.', 'value'));

        $this->assertSame([
            'other' => ['a' => 'b']
        ], $cf->getConfig('scope'));

        $cf->modify('scope', new AppendPatch('.', null, 'c'));

        $this->assertSame([
            'other' => ['a' => 'b'],
            'c'
        ], $cf->getConfig('scope'));

        $cf->modify('scope', new DeletePatch('.', null, 'c'));

        $this->assertSame([
            'other' => ['a' => 'b']
        ], $cf->getConfig('scope'));

        $cf->modify('scope', new DeletePatch('other', 'a'));
        $this->assertSame([
            'other' => []
        ], $cf->getConfig('scope'));

        $cf->modify('scope', new AppendPatch('.', 'other', ['a' => 'b']));
        $this->assertSame([
            'other' => ['a' => 'b']
        ], $cf->getConfig('scope'));

        $cf->modify('scope', new DeletePatch('other', null, 'b'));
        $this->assertSame([
            'other' => []
        ], $cf->getConfig('scope'));
    }

    public function testException()
    {
        $cf = $this->getFactory();
        $this->assertEquals(['value' => 'value!'], $cf->getConfig('scope'));

        $cf->modify('scope', new DeletePatch('something.', 'other'));
        $this->assertEquals(['value' => 'value!'], $cf->getConfig('scope'));
    }
}