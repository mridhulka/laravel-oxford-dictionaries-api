<?php

namespace Mridhulka\LaravelOxfordDictionariesApi\Exceptions;

use Exception;

class MissingArgumentException extends Exception
{
    public static function create(string $argumentName): self
    {
        return new self("Missing argument: " . $argumentName);
    }
}
