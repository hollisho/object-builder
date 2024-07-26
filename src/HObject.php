<?php

namespace hollisho\objectbuilder;

use hollisho\objectbuilder\Traits\ObjectAttributesTrait;

class HObject extends BaseObject
{
    use ObjectAttributesTrait;

    /**
     * @param array $attributes
     * @return BaseObject
     * @throws Exceptions\BuilderException
     */
    public static function build(array $attributes = []): BaseObject
    {
        return ObjectBuilder::build(static::class, $attributes);
    }
}