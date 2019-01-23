<?php

namespace SyncSDK\Response;

use SyncSDK\Model\Error;

class ErrorResponse implements \Countable, \ArrayAccess
{
    /**
     * @var mixed
     */
    private $errors;

    /**
     * @var mixed
     */
    private $statusCode;

    /**
     * @param $statusCode
     * @param array $errors
     */
    public function __construct($statusCode, array $errors)
    {
        $this->statusCode = $statusCode;
        $this->errors     = array_map(
            function ($error) {
                return new Error($error);
            }, $errors['errors']
        );
    }

    public function count()
    {
        return count($this->errors);
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $offset
     */
    public function offsetExists($offset)
    {
        return isset($this->errors[$offset]);
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->errors[$offset];
    }

    /**
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        $this->errors[$offset] = $value;
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->errors[$offset]);
    }
}
