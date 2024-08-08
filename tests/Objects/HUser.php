<?php

namespace hollisho\objectbuilderTests\Objects;

use hollisho\objectbuilder\HObject;

class HUser extends HObject
{
    public $id;

    public $username;

    public function setGrade($value)
    {
        $this->username = $value . ':' . $this->username;
    }
}