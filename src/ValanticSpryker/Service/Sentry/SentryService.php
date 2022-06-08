<?php

declare(strict_types = 1);

namespace ValanticSpryker\Service\Sentry;

use Generated\Shared\Transfer\SentryUserTransfer;
use Sentry\Tracing\Span;
use Sentry\Tracing\Transaction;
use Sentry\Tracing\TransactionContext;
use Spryker\Service\Kernel\AbstractService;
use Throwable;

/**
 * @method \ValanticSpryker\Service\Sentry\SentryServiceFactory getFactory()
 */
class SentryService extends AbstractService implements SentryServiceInterface
{
    /**
     * @param \Throwable $throwable
     *
     * @return void
     */
    public function captureException(Throwable $throwable): void
    {
        $this->getFactory()->createSentryExceptionHandler()->captureException($throwable);
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function setTag(string $key, string $value): void
    {
        $this->getFactory()->createSentryGateway()->setTag($key, $value);
    }

    /**
     * @param \Sentry\Tracing\TransactionContext $transactionContext
     *
     * @return \Sentry\Tracing\Transaction
     */
    public function startTransaction(TransactionContext $transactionContext): Transaction
    {
        return $this->getFactory()->createSentryGateway()->startTransaction($transactionContext);
    }

    /**
     * @return void
     */
    public function finishCurrentTransaction(): void
    {
        $this->getFactory()->createSentryGateway()->finishCurrentTransaction();
    }

    /**
     * @param \Generated\Shared\Transfer\SentryUserTransfer $sentryUserTransfer
     *
     * @return void
     */
    public function setUser(SentryUserTransfer $sentryUserTransfer): void
    {
        $this->getFactory()->createSentryGateway()->setUser($sentryUserTransfer);
    }

    /**
     * @param string $name
     * @param array $context
     *
     * @return void
     */
    public function setContext(string $name, array $context): void
    {
        $this->getFactory()->createSentryGateway()->setContext($name, $context);
    }

    /**
     * @param \Sentry\Tracing\Span|null $span
     *
     * @return void
     */
    public function setSpan(?Span $span): void
    {
        $this->getFactory()->createSentryGateway()->setSpan($span);
    }
}
