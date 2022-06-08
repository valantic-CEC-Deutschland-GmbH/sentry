<?php

declare(strict_types = 1);

namespace ValanticSpryker\Service\Sentry\Exception;

use Exception;
use Throwable;

class UnreportableException extends Exception
{
    /**
     * @param \Throwable $throwable
     *
     * @return static
     */
    public static function fromThrowable(Throwable $throwable): self
    {
        return new self($throwable->getMessage(), $throwable->getCode(), $throwable->getPrevious());
    }
}
