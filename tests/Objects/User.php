<?php
namespace hollisho\objectbuilderTests\Objects;

use hollisho\objectbuilder\BaseObject;
use hollisho\objectbuilder\Traits\ObjectAttributesTrait;

class User extends BaseObject
{
    use ObjectAttributesTrait;

    public $id;

    public $username;

    public function __construct(int $id, string $username)
    {
        $this->id = $id;
        $this->username = $username;
    }

}