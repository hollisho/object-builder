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
    public static function build(string $class, array $attributes = []): BaseObject
    {
        try {
            $key = sprintf("%s_%s", $class, md5(json_encode($attributes)));
            if (!isset(static::$instances[$key])) {
                $classReflection = new \ReflectionClass($class);
                static::$instances[$key] = $classReflection->newInstance();
            }

            /** @var BaseObject $objectBuilder */
            $objectBuilder = static::$instances[$key];

            if (!empty($attributes)) {
                $objectBuilder->setAttributes($attributes);
            }

            return $objectBuilder;
        } catch (Throwable $throwable) {
            throw new BuilderException('Cant build object', 0, $throwable);
        }
    }

}