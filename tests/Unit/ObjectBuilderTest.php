<?php
namespace hollisho\objectbuilder\tests\Unit;

use hollisho\objectbuilder\ObjectBuilder;
use hollisho\objectbuilder\tests\Objects\HUser;
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

    public function testObject()
    {
        $baseObject = HUser::build([
            'id' => 1,
            'username' => '张三'
        ]);
        $baseObject1 = HUser::build([
            'id' => 2,
            'username' => '李四'
        ]);

        $this->assertNotSame($baseObject, $baseObject1);
    }

    public function testObject02()
    {
        $baseObject = HUser::build();
        $baseObject1 = HUser::build();

        $baseObject->id = 1;
        $baseObject->username = '张三';

        $baseObject1->id = 2;
        $baseObject1->username = '李四';

        $this->assertTrue($baseObject->id === $baseObject1->id);
    }
}