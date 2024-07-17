<?php
namespace hollisho\objectbuilder\tests\Unit;

use hollisho\objectbuilder\ObjectBuilder;
use hollisho\objectbuilder\tests\Objects\User;
use PHPUnit\Framework\TestCase;

class ObjectBuilderTest extends TestCase
{
    public function test()
    {
        $object01 = ObjectBuilder::build(User::class, [
            'id' => 1,
            'username' => 'Hollis'
        ]);

        $object02 = ObjectBuilder::build(User::class, [
            'id' => 10086,
            'username' => 'Hollis Ho'
        ]);

        $this->assertNotSame($object01, $object02);
    }
}