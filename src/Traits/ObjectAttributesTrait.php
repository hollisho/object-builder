<?php

namespace hollisho\objectbuilder\Traits;

trait ObjectAttributesTrait
{
    /**
     * @param null $names
     * @return array
     */
    public function getAttributes($names = null): array
    {
        $values = [];

        if ($names === null) {
            $names = $this->attributes();
        }
        foreach ($names as $name) {
            $values[$name] = $this->$name;
        }
        return $values;
    }

    /**
     * @param $values
     * @param bool $onlyDefined
     */
    public function setAttributes($values, bool $onlyDefined = true) {
        if (is_array($values)) {
            $attributes = array_flip($this->attributes());
            foreach ($values as $name => $value) {
                if (!$onlyDefined || isset($attributes[$name])) {
                    $this->$name = $value;
                }
            }
        }
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getAttribute(string $name)
    {
        $attributes = $this->getAttributes([$name]);
        return $attributes[$name] ?? null;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setAttribute(string $name, $value)
    {
        if ($this->hasAttribute($name)) {
            $this->$name = $value;
        } else {
            throw new \InvalidArgumentException(get_class($this) . ' has no attribute named "' . $name . '".');
        }
    }


    /**
     * @return array
     */
    public function attributes(): array
    {
        $class = new \ReflectionClass($this);
        $names = [];
        foreach ($class->getProperties() as $property) {
            if (!$property->isStatic()) {
                $names[] = $property->getName();
            }
        }

        return $names;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasAttribute($name): bool
    {
        $attributes = $this->attributes();
        return isset($attributes[$name]) || in_array($name, $attributes, true);
    }
}