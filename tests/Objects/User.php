<?php
namespace hollisho\objectbuilderTests\Objects;

use hollisho\objectbuilder\BaseObject;
use hollisho\objectbuilder\Traits\ObjectAttributesTrait;

class User extends BaseObject
{
    use ObjectAttributesTrait;

    private $id;

    private $username;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }


    public function __construct(int $id, string $username)
    {
        $this->id = $id;
        $this->username = $username;
    }

}