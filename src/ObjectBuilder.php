<?php

namespace hollisho\objectbuilder;


use hollisho\objectbuilder\Exceptions\BuilderException;
use Throwable;

/**
 * @author Hollis
 * @desc 对象构造器
 * Class ObjectBuilder
 * @package hollisho\objectbuilder
 */
class ObjectBuilder
{
    /**
     * @var static[]
     */
    private static $instances = [];

    /**
     * @param string $class
     * @param array $attributes
     * @return BaseObject
     * @throws BuilderException
     * @author Hollis
     */
    public static function build(string $class, array $attributes): BaseObject
    {
        try {
            /** @var BaseObject $objectBuilder */
            $classReflection = new \ReflectionClass($class);
            if (!isset(static::$instances[$classReflection->getName()])) {
                static::$instances[$classReflection->getName()] = $classReflection;
            }
            $objectBuilder = static::$instances[$classReflection->getName()]->newInstance();
            $objectBuilder->setAttributes($attributes);
            return $objectBuilder;
        } catch (Throwable $throwable) {
            throw new BuilderException('Cant build object', 0, $throwable);
        }
    }
}