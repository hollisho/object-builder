<?php

namespace hollisho\objectbuilder;

use hollisho\objectbuilder\Traits\ObjectAttributesTrait;

class HObject extends BaseObject
{
    use ObjectAttributesTrait;

    /**
     * @param array $attributes
     * @return HObject
     */
    public static function build(array $attributes): HObject
    {
        $objectBuilder = new static();
        $objectBuilder->setAttributes($attributes);
        return $objectBuilder;
    }
}