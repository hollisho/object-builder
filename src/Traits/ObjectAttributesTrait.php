<?php

namespace hollisho\objectbuilder\Traits;

trait ObjectAttributesTrait
{

    /**
     * @var int
     */
    private $filter = \ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED;

    public function getFilter(): int
    {
        return $this->filter;
    }

    public function setFilter(int $filter)
    {
        $this->filter = $filter;
    }


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
     */
    public function setAttributes($values) {
        if (is_array($values)) {
            $attributes = array_flip($this->attributes());
            foreach ($values as $name => $value) {
                if (isset($attributes[$name])) {
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
        foreach ($class->getProperties($this->getFilter()) as $property) {
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