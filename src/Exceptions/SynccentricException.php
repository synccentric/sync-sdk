<?php

namespace SyncSDK\Exceptions;

class SynccentricException extends \Exception
{
	public function __construct($message, $code = null, \Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}