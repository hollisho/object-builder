<?php

namespace hollisho\objectbuilder;


use hollisho\objectbuilder\Traits\ObjectAttributesTrait;

/**
 * @author Hollis
 * @desc 对象构造器
 * Class ObjectBuilder
 * @package hollisho\objectbuilder
 */
class ObjectBuilder extends BaseObject
{
    use ObjectAttributesTrait;

    /**
     * @var static[]
     */
    private static $instances = [];

    /**
     * ObjectBuilder::build(array)
     * @param array $attributes
     * @return ObjectBuilder
     */
    public static function build(array $attributes): ObjectBuilder
    {
        $objectBuilder = new static();
        $objectBuilder->setAttributes($attributes);
        return $objectBuilder;
    }
}