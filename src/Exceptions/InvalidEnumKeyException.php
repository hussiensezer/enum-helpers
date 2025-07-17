<?php

namespace Sezer\EnumHelpers\Exceptions;

use InvalidArgumentException;

class InvalidEnumKeyException extends InvalidArgumentException
{
    public function __construct(string $enumClass, array $invalidKeys)
    {
        $message = sprintf(
            "Invalid enum keys [%s] for enum %s.",
            implode(', ', $invalidKeys),
            $enumClass
        );
        parent::__construct($message);
    }
}