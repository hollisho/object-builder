<?php
namespace hollisho\objectbuilder\tests\Unit;

use hollisho\objectbuilder\tests\Objects\User;
use PHPUnit\Framework\TestCase;

class ObjectBuilderTest extends TestCase
{
    public function test()
    {
        $objectBuilder = User::build([
            'id' => 1,
            'username' => 'Hollis Ho'
        ]);

        var_dump($objectBuilder->username);
    }
}