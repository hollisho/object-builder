<?php

namespace hollisho\objectbuilder;


use hollisho\helpers\ArrayHelper;
use hollisho\objectbuilder\Exceptions\BuilderException;
use ReflectionClass;
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
     * @param bool $alwaysNewInstance
     * @param bool $initConstructArgs
     * @return object|null
     * @throws BuilderException
     * @author Hollis
     */
    public static function build(string $class, array $attributes = [], bool $alwaysNewInstance = true, bool $initConstructArgs = false): ?object
    {
        try {
            $key = sprintf("%s_%s", $class, md5(json_encode($attributes)));
            if ($alwaysNewInstance || !isset(static::$instances[$key])) {
                $classReflection = new ReflectionClass($class);
                static::$instances[$key] = $classReflection;

            }

            /** @var $classReflection ReflectionClass */
            $classReflection = static::$instances[$key];
            $constructor = $classReflection->getConstructor();
            if ($initConstructArgs && $constructor) {
                $parameters = $constructor->getParameters();
                $args = [];
                foreach ($parameters as $parameter) {
                    $defaultValue = $parameter->isDefaultValueAvailable() ? $parameter->getDefaultValue() : null;
                    $args[$parameter->getName()] = ArrayHelper::getValue($attributes, $parameter->getName(), $defaultValue);
                }

                $objectBuilder = $classReflection->newInstanceArgs($args);
            } else {
                $objectBuilder = $classReflection->newInstance();
            }

            if (!empty($attributes)) {
                $objectBuilder->setAttributes($attributes);
            }

            return $objectBuilder;
        } catch (Throwable $throwable) {
            throw new BuilderException('Cant build object:' . $throwable->getMessage(), 0, $throwable);
        }
    }

}