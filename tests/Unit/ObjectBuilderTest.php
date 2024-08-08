<?php
namespace hollisho\objectbuilderTests\Unit;

use hollisho\objectbuilder\ObjectBuilder;
use hollisho\objectbuilderTests\Objects\HUser;
use hollisho\objectbuilderTests\Objects\User;
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

        $baseObject->id = 2;
        $baseObject->username = '李四';
        $baseObject->grade = '一年级';

        $this->assertTrue($baseObject->username === '一年级:李四');
    }
}