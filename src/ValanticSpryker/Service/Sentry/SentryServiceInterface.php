<?php

declare(strict_types = 1);

namespace ValanticSpryker\Service\Sentry;

use Generated\Shared\Transfer\SentryUserTransfer;
use Sentry\Tracing\Span;
use Sentry\Tracing\Transaction;
use Sentry\Tracing\TransactionContext;
use Throwable;

/**
 * @method \ValanticSpryker\Service\Sentry\SentryServiceFactory getFactory()
 */
interface SentryServiceInterface
{
    /**
     * Captures and sends the exception to Sentry.io.
     *
     * @param \Throwable $throwable
     *
     * @return void
     */
    public function captureException(Throwable $throwable): void;

    /**
     * Adds a tag to the Sentry.io exception issue so
     * you can search your issue in a better way.
     *
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function setTag(string $key, string $value): void;

    /**
     * @param \Sentry\Tracing\TransactionContext $transactionContext
     *
     * @return \Sentry\Tracing\Transaction
     */
    public function startTransaction(TransactionContext $transactionContext): Transaction;

    /**
     * @return void
     */
    public function finishCurrentTransaction(): void;

    /**
     * @param \Generated\Shared\Transfer\SentryUserTransfer $sentryUserTransfer
     *
     * @return void
     */
    public function setUser(SentryUserTransfer $sentryUserTransfer): void;

    /**
     * @param string $name
     * @param array $context
     *
     * @return void
     */
    public function setContext(string $name, array $context): void;

    /**
     * @param \Sentry\Tracing\Span|null $span
     *
     * @return void
     */
    public function setSpan(?Span $span): void;
}
