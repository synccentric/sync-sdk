<?php

namespace SyncSDK\Model;

class BaseModel
{
    /**
     * @var mixed
     */
    private $properties;

    /**
     * @var mixed
     */
    private $readOnlyProperties;

    /**
     * @param array $readOnlyProperties
     * @param array $properties
     */
    public function __construct(array $readOnlyProperties = [], array $properties = [])
    {
        $this->readOnlyProperties = $readOnlyProperties;
        $this->properties         = $properties;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        if ($this->__isset($key)) {
            return $this->properties[$key];
        }

        return null;
    }

    /**
     * @param $key
     */
    public function __isset($key)
    {
        return isset($this->properties[$key]);
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return mixed
     */
    public function getProperties()
    {
        return $this->properties;
    }
}
