<?php

namespace SyncSDK\Exceptions;

class SynccentricException extends \Exception
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
}
