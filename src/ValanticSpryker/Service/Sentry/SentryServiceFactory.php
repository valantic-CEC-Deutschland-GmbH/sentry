<?php

declare(strict_types = 1);

namespace ValanticSpryker\Service\Sentry;

use Sentry\State\HubInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;
use ValanticSpryker\Service\Sentry\Exception\SentryExceptionHandler;
use ValanticSpryker\Service\Sentry\Gateway\SentryGateway;

/**
 * @method \ValanticSpryker\Service\Sentry\SentryConfig getConfig()
 */
class SentryServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \Sentry\State\HubInterface
     */
    protected function getSentryHub(): HubInterface
    {
        return $this->getProvidedDependency(SentryDependencyProvider::SENTRY_HUB);
    }

    /**
     * @return \ValanticSpryker\Service\Sentry\Gateway\SentryGateway
     */
    public function createSentryGateway(): SentryGateway
    {
        return new SentryGateway(
            $this->getSentryHub()
        );
    }

    /**
     * @return \ValanticSpryker\Service\Sentry\Exception\SentryExceptionHandler
     */
    public function createSentryExceptionHandler(): SentryExceptionHandler
    {
        return new SentryExceptionHandler(
            $this->createSentryGateway(),
            $this->getConfig()
        );
    }
}
