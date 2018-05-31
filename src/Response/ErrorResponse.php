<?php

namespace SyncSDK\Response;

use SyncSDK\Model\Error;

class ErrorResponse implements \Countable, \ArrayAccess
{
	private $statusCode;
	private $errors;

    public function __construct($statusCode, array $errors) {
        $this->statusCode = $statusCode;
        $this->errors = array_map(function ($error) {
            return new Error($error);
        }, $errors['errors']);
    }

    public function getStatusCode() {
        return $this->statusCode;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function count() {
        return count($this->errors);
    }

    public function offsetExists($offset) {
        return isset($this->errors[$offset]);
    }

    public function offsetGet($offset) {
        return $this->errors[$offset];
    }

    public function offsetSet($offset, $value) {
        $this->errors[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->errors[$offset]);
    }
}