<?php

namespace Mridhulka\LaravelOxfordDictionariesApi\Exceptions;

use Exception;

class UnwantedArgumentException extends Exception
{
    public static function create(string $argumentName): self
    {
        return new self("Unwanted argument: " . $argumentName);
    }
}
