<?php

declare(strict_types = 1);

namespace ValanticSpryker\Shared\Sentry;

interface SentryConstants
{
    /**
     * @var string
     */
    public const PROJECT_DSN = 'SENTRY:CONFIG:DSN';

    /**
     * @var string
     */
    public const IGNORED_EXCEPTIONS = 'SENTRY:CONFIG:IGNORED_EXCEPTIONS';

    /**
     * @var string
     */
    public const TRACE_SAMPLE_RATE = 'SENTRY:CONFIG:TRACE_SAMPLE_RATE';

    /**
     * @var string
     */
    public const APPLICATION_VERSION = 'SENTRY:CONFIG:APPLICATION_VERSION';

    /**
     * @var string
     */
    public const HTTP_TIMEOUT = 'SENTRY:CONFIG:HTTP_TIMEOUT';

    /**
     * @var string
     */
    public const HTTP_CONNECT_TIMEOUT = 'SENTRY:CONFIG:HTTP_CONNECT_TIMEOUT';
}
