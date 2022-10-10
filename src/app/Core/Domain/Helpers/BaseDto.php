<?php

declare(strict_types=1);

namespace App\Core\Domain\Helpers;

use App\Core\Domain\Helpers\Contracts\BaseDtoContract;
use InvalidArgumentException;
use JsonSerializable;
use RuntimeException;

abstract class BaseDto implements JsonSerializable, BaseDtoContract
{    
    /**
     * Method values
     *
     * @return array
     */
    public function values(): array
    {
        return get_object_vars($this);
    }
    
    /**
     * Method get
     *
     * @param string $property 
     *
     * @return mixed
     */
    public function get(string $property): mixed
    {
        $getter = "get" . ucfirst($property);

        if (method_exists($this, $getter)) {
            return $this->{$getter}();
        }

        if (!property_exists($this, $property)) {
            throw new InvalidArgumentException(sprintf(
                "The property '%s' doesn't exists in '%s' DTO Class",
                $property,
                get_class()
            ));
        }
        
        return $this->{$property};
    }
    
    /**
     * Method jsonSerialize
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return $this->values();
    }
    
    /**
     * __get
     *
     * @param string $name
     * 
     * @return mixed
     * 
     */
    public function __get(string $property): mixed
    {
        if (!property_exists($this, $property)) {
            throw new InvalidArgumentException(sprintf(
                "The property '%s' doesn't exists in '%s' DTO Class",
                $property,
                get_class()
            ));
        }

        return $this->{$property};
    }
    
    /**
     * Method __set
     *
     * @param string $name 
     * @param mixed $value 
     *
     * @return void
     */
    public function __set(string $name, mixed $value)
    {
        throw new InvalidArgumentException(
            sprintf("The property '%s' is read-only", $name)
        );
    }    
    
    /**
     * Method __isset
     *
     * @param string $name 
     *
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return property_exists($this, $name);
    }
}
