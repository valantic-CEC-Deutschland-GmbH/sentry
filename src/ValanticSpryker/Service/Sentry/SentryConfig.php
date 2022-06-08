<?php

declare(strict_types = 1);

namespace ValanticSpryker\Service\Sentry;

use Spryker\Service\Kernel\AbstractBundleConfig;
use ValanticSpryker\Shared\Sentry\SentryConstants;

class SentryConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getDataSourceName(): string
    {
        return $this->get(SentryConstants::DSN);
    }

    /**
     * @return string
     */
    public function getApplicationEnvironment(): string
    {
        return APPLICATION_ENV;
    }

    /**
     * @return string[]
     */
    public function getIgnoredExceptions(): array
    {
        return $this->get(SentryConstants::IGNORED_EXCEPTIONS, []);
    }

    /**
     * @return string
     */
    public function getReleaseVersion(): string
    {
        return $this->get(SentryConstants::APPLICATION_VERSION, 'development');
    }

    /**
     * @return float
     */
    public function getTraceSampleRate(): float
    {
        return (float)$this->get(SentryConstants::TRACE_SAMPLE_RATE, 1.0);
    }

    /**
     * @return int
     */
    public function getErrorTypes()
    {
        return E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED;
    }

    /**
     * @return bool
     */
    public function getCaptureSilencedErrors(): bool
    {
        return false;
    }
}
