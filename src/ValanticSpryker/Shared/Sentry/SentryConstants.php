<?php

declare(strict_types = 1);

namespace ValanticSpryker\Shared\Sentry;

interface SentryConstants
{
    public const PROJECT_DSN = 'SENTRY:CONFIG:DSN';
    public const IGNORED_EXCEPTIONS = 'SENTRY:CONFIG:IGNORED_EXCEPTIONS';
    public const TRACE_SAMPLE_RATE = 'SENTRY:CONFIG:TRACE_SAMPLE_RATE';
    public const APPLICATION_VERSION = 'SENTRY:CONFIG:APPLICATION_VERSION';
    public const HTTP_TIMEOUT = 'SENTRY:CONFIG:HTTP_TIMEOUT';
    public const HTTP_CONNECT_TIMEOUT = 'SENTRY:CONFIG:HTTP_CONNECT_TIMEOUT';
}
