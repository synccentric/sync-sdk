<?php

namespace SyncSDK\Exceptions;

class SynccentricArgumentException extends SynccentricException
{
    /**
     * @param $message
     * @param $code
     * @param null\Exception $previous
     */
    public function __construct($message, $code = null, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return mixed
     */
    public function getErrorResponse()
    {
        return $this->message;
    }
}
