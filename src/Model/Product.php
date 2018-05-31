<?php

namespace SyncSDK\Model;

class Product extends BaseModel
{
	private static $READONLYFIELDS = [];

	public function __construct(array $properties = [])
	{
		parent::__construct(self::$READONLYFIELDS, $properties);
	}
}