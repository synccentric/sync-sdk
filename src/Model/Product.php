<?php

namespace SyncSDK\Model;

class Product extends BaseModel
{
    /**
     * @var array
     */
    private static $READONLYFIELDS = [];

    /**
     * @param array $properties
     */
    public function __construct(array $properties = [])
    {
        parent::__construct(self::$READONLYFIELDS, $properties);
    }
}
