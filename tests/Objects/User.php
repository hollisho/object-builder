<?php
namespace hollisho\objectbuilderTests\Objects;

use hollisho\objectbuilder\BaseObject;
use hollisho\objectbuilder\Traits\ObjectAttributesTrait;

class User extends BaseObject
{
    use ObjectAttributesTrait;

    public $id;

    public $username;

}