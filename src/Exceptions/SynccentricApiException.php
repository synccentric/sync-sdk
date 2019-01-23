<?php

namespace SyncSDK\Exceptions;

use SyncSDK\Response\ErrorResponse;

class SynccentricApiException extends SynccentricException
{
    /**
     * @var mixed
     */
    private $errorResponse;

    /**
     * @param ErrorResponse $errorResponse
     * @param \Exception $previous
     */
    public function __construct(ErrorResponse $errorResponse, \Exception $previous)
    {
        parent::__construct($errorResponse[0]->getId(), null, $previous);

        $this->errorResponse = $errorResponse;
    }

    /**
     * @return mixed
     */
    public function getErrorResponse()
    {
        return $this->errorResponse;
    }
}
