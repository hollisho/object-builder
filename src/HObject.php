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

    public function __call($name, $params)
    {
        if ($this->hasAttribute($name)) {
            $this->setAttribute($name, $params[0]);
        }

        return $this;
    }

    /**
     * @param array $attributes
     * @param bool $initConstructArgs
     * @return ?object
     * @throws BuilderException
     */
    public static function build(array $attributes = [], bool $initConstructArgs = false): ?object
    {
        return ObjectBuilder::build(static::class, $attributes, true, $initConstructArgs);
    }
}