<?php

namespace SyncSDK\Exceptions;

use SyncSDK\Response\ErrorResponse;

class SynccentricApiException extends SynccentricException
{
	private $errorResponse;

	public function __construct(ErrorResponse $errorResponse, \Exception $previous)
	{
		parent::__construct($errorResponse[0]->getId(), null, $previous);

		$this->errorResponse = $errorResponse;
	}

	public function getErrorResponse()
	{
		return $this->errorResponse;
	}
}