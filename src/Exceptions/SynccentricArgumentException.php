<?php

namespace SyncSDK\Exceptions;

class SynccentricArgumentException extends SynccentricException
{
	public function __construct($message, $code = null, \Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

	public function getErrorResponse()
	{
		return $this->message;
	}
}