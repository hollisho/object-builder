<?php
namespace hollisho\objectbuilder\tests\Unit;

use hollisho\objectbuilder\ObjectBuilder;
use hollisho\objectbuilder\tests\Objects\User;
use PHPUnit\Framework\TestCase;

class ObjectBuilderTest extends TestCase
{
    public function test()
    {
        $objectBuilder = ObjectBuilder::build(User::class, [
            'id' => 1,
            'username' => 'Hollis'
        ]);

        $this->assertTrue($objectBuilder->username === 'Hollis');
    }
}