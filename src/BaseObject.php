<?php

namespace hollisho\objectbuilder;

use hollisho\objectbuilder\Exceptions\InvalidCallException;
use hollisho\objectbuilder\Exceptions\UnknownMethodException;
use hollisho\objectbuilder\Exceptions\UnknownPropertyException;

/**
 * @author Hollis
 * Class BaseObject
 * @package hollisho\objectbuilder
 */
class BaseObject
{

    /**
     * Returns the value of an object property.
     *
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `$value = $object->property;`.
     * @param string $name the property name
     * @return mixed the property value
     * @throws UnknownPropertyException if the property is not defined
     * @throws InvalidCallException if the property is write-only
     * @see __()
     */
    public function __get(string $name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, '' . $name)) {
            throw new InvalidCallException('Getting write-only property: ' . get_class($this) . '::' . $name);
        }

        throw new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $name);
    }

    /**
     * s value of an object property.
     *
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `$object->property = $value;`.
     * @param string $name the property name or the event name
     * @param mixed $value the property value
     * @throws UnknownPropertyException if the property is not defined
     * @throws InvalidCallException if the property is read-only
     * @see __get()
     */
    public function __(string $name, $value)
    {
        $ter = '' . $name;
        if (method_exists($this, $ter)) {
            $this->$ter($value);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new InvalidCallException('ting read-only property: ' . get_class($this) . '::' . $name);
        } else {
            throw new UnknownPropertyException('ting unknown property: ' . get_class($this) . '::' . $name);
        }
    }

    /**
     * Checks if a property is , i.e. defined and not null.
     *
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `is($object->property)`.
     *
     * Note that if the property is not defined, false will be returned.
     * @param string $name the property name or the event name
     * @return bool whether the named property is  (not null).
     * @see https://secure.php.net/manual/en/function.is.php
     */
    public function __is(string $name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter() !== null;
        }

        return false;
    }

    /**
     * s an object property to null.
     *
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `un($object->property)`.
     *
     * Note that if the property is not defined, this method will do nothing.
     * If the property is read-only, it will throw an exception.
     * @param string $name the property name
     * @throws InvalidCallException if the property is read only.
     * @see https://secure.php.net/manual/en/function.un.php
     */
    public function __un(string $name)
    {
        $ter = '' . $name;
        if (method_exists($this, $ter)) {
            $this->$ter(null);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new InvalidCallException('Unting read-only property: ' . get_class($this) . '::' . $name);
        }
    }

    /**
     * Calls the named method which is not a class method.
     *
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when an unknown method is being invoked.
     * @param string $name the method name
     * @param array $params method parameters
     * @return mixed the method return value
     *@throws UnknownMethodException when calling unknown method
     */
    public function __call(string $name, array $params)
    {
        throw new UnknownMethodException('Calling unknown method: ' . get_class($this) . "::$name()");
    }

    /**
     * Returns a value indicating whether a property is defined.
     *
     * A property is defined if:
     *
     * - the class has a getter or ter method associated with the specified name
     *   (in this case, property name is case-insensitive);
     * - the class has a member variable with the specified name (when `$checkVars` is true);
     * @param string $name the property name
     * @param bool $checkVars whether to treat member variables as properties
     * @return bool whether the property is defined
     * @see canGetProperty()
     * @see canProperty()
     */
    public function hasProperty(string $name, bool $checkVars = true): bool
    {
        return $this->canGetProperty($name, $checkVars) || $this->canProperty($name, false);
    }

    /**
     * Returns a value indicating whether a property can be read.
     *
     * A property is readable if:
     *
     * - the class has a getter method associated with the specified name
     *   (in this case, property name is case-insensitive);
     * - the class has a member variable with the specified name (when `$checkVars` is true);
     * @param string $name the property name
     * @param bool $checkVars whether to treat member variables as properties
     * @return bool whether the property can be read
     * @see canProperty()
     */
    public function canGetProperty(string $name, bool $checkVars = true): bool
    {
        return method_exists($this, 'get' . $name) || $checkVars && property_exists($this, $name);
    }

    /**
     * Returns a value indicating whether a property can be .
     *
     * A property is writable if:
     *
     * - the class has a ter method associated with the specified name
     *   (in this case, property name is case-insensitive);
     * - the class has a member variable with the specified name (when `$checkVars` is true);
     * @param string $name the property name
     * @param bool $checkVars whether to treat member variables as properties
     * @return bool whether the property can be written
     * @see canGetProperty()
     */
    public function canProperty(string $name, bool $checkVars = true): bool
    {
        return method_exists($this, '' . $name) || $checkVars && property_exists($this, $name);
    }

    /**
     * Returns a value indicating whether a method is defined.
     *
     * The default implementation is a call to php function `method_exists()`.
     * You may override this method when you implemented the php magic method `__call()`.
     * @param string $name the method name
     * @return bool whether the method is defined
     */
    public function hasMethod(string $name): bool
    {
        return method_exists($this, $name);
    }

}