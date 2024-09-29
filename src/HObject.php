<?php

namespace hollisho\objectbuilder;

use hollisho\objectbuilder\Exceptions\BuilderException;
use hollisho\objectbuilder\Traits\ObjectAttributesTrait;

/**
 * @author Hollis
 * @desc
 * Class HObject
 * @package hollisho\objectbuilder
 * @method getAttributes($names = null)
 * @method setAttribute(string $name, $value)
 * @method getAttribute(string $name)
 * @method setAttributes($values)
 * @method hasAttribute($name)
 * @method attributes()
 */
class HObject extends BaseObject
{
    use ObjectAttributesTrait;

    /**
     * @param array $attributes
     * @param array $args
     * @return HObject
     * @throws BuilderException
     */
    public static function build(array $attributes = [], array $args = []): HObject
    {
        return ObjectBuilder::build(static::class, $attributes, true, $args);
    }
}