<?php

declare(strict_types = 1);

namespace ValanticSpryker\Service\Sentry\Exception;

use Throwable;
use ValanticSpryker\Service\Sentry\Gateway\SentryGateway;
use ValanticSpryker\Service\Sentry\SentryConfig;

class SentryExceptionHandler
{
    /**
     * @var \ValanticSpryker\Service\Sentry\Gateway\SentryGateway
     */
    private $sentryGateway;

    /**
     * @var \ValanticSpryker\Service\Sentry\SentryConfig
     */
    private $config;

    /**
     * @param \ValanticSpryker\Service\Sentry\Gateway\SentryGateway $sentryGateway
     * @param \ValanticSpryker\Service\Sentry\SentryConfig $config
     */
    public function __construct(SentryGateway $sentryGateway, SentryConfig $config)
    {
        $this->sentryGateway = $sentryGateway;
        $this->config = $config;
    }

    /**
     * @param \Throwable $throwable
     *
     * @return void
     */
    public function captureException(Throwable $throwable): void
    {
        if ($this->isExceptionIgnored($throwable)) {
            return;
        }

        $eventId = $this->sentryGateway->captureException($throwable);

        if ($eventId === null) {
            $this->sentryGateway->captureException(UnreportableException::fromThrowable($throwable));
        }
    }

    /**
     * @param \Throwable $throwable
     *
     * @return bool
     */
    private function isExceptionIgnored(Throwable $throwable): bool
    {
        $ignoredExceptions = $this->config->getIgnoredExceptions();

        foreach ($ignoredExceptions as $ignoredException) {
            if ($throwable instanceof $ignoredException) {
                return true;
            }
        }

        return false;
    }
}
