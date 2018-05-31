<?php

namespace SyncSDK\Model;

class BaseModel
{
	private $properties;
	private $readOnlyProperties;

	public function __construct(array $readOnlyProperties = [], array $properties = [])
	{
		$this->readOnlyProperties = $readOnlyProperties;
		$this->properties = $properties;
	}

	public function __get($key)
	{
		if ($this->__isset($key)) {
			return $this->properties[$key];
		}

		return null;
	}

	public function __isset($key)
	{
		return isset($this->properties[$key]);
	}

	public function getProperties()
	{
		return $this->properties;
	}

	public function getAttributes()
	{
		return $this->attributes;
	}

}