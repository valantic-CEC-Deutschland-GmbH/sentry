<?php

declare(strict_types = 1);

namespace ValanticSpryker\Service\Sentry\Gateway;

use Generated\Shared\Transfer\SentryUserTransfer;
use Sentry\State\HubInterface;
use Sentry\State\Scope;
use Sentry\Tracing\Span;
use Sentry\Tracing\Transaction;
use Sentry\Tracing\TransactionContext;
use Throwable;

class SentryGateway
{
    /**
     * @var \Sentry\State\HubInterface
     */
    private $sentryHub;

    /**
     * @param \Sentry\State\HubInterface $sentryHub
     */
    public function __construct(HubInterface $sentryHub)
    {
        $this->sentryHub = $sentryHub;
    }

    /**
     * @param \Throwable $exception
     *
     * @return \Sentry\EventId|null
     */
    public function captureException(Throwable $exception)
    {
        return $this->sentryHub->captureException($exception);
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function setTag(string $key, string $value): void
    {
        $this->sentryHub->configureScope(function (Scope $scope) use ($key, $value) {
            $scope->setTag($key, $value);
        });
    }

    /**
     * @param \Sentry\Tracing\TransactionContext $transactionContext
     *
     * @return \Sentry\Tracing\Transaction
     */
    public function startTransaction(TransactionContext $transactionContext): Transaction
    {
        $transaction = $this->sentryHub->getTransaction();

        if ($transaction instanceof Transaction) {
            return $transaction;
        }

        return $this->sentryHub->startTransaction($transactionContext);
    }

    /**
     * @return void
     */
    public function finishCurrentTransaction(): void
    {
        /** @var \Sentry\Tracing\Transaction|null $transaction */
        $transaction = $this->sentryHub->getTransaction();

        if ($transaction instanceof Transaction) {
            $transaction->finish();
        }
    }

    /**
     * @param \Generated\Shared\Transfer\SentryUserTransfer $user
     *
     * @return void
     */
    public function setUser(SentryUserTransfer $user): void
    {
        $this->sentryHub->configureScope(function (Scope $scope) use ($user) {
            $scope->setUser($user->modifiedToArray());
        });
    }

    /**
     * @param string $name
     * @param array $context
     *
     * @return void
     */
    public function setContext(string $name, array $context): void
    {
        $this->sentryHub->configureScope(function (Scope $scope) use ($name, $context) {
            $scope->setContext($name, $context);
        });
    }

    /**
     * @param \Sentry\Tracing\Span|null $span
     *
     * @return void
     */
    public function setSpan(?Span $span): void
    {
        $this->sentryHub->setSpan($span);
    }
}
