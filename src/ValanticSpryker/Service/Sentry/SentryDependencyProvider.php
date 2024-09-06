<?php

declare(strict_types = 1);

namespace ValanticSpryker\Service\Sentry;

use Sentry\ClientBuilder;
use Sentry\SentrySdk;
use Sentry\State\Hub;
use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;
use ValanticSpryker\Shared\Sentry\SentryVersion;

/**
 * @method \ValanticSpryker\Service\Sentry\SentryConfig getConfig()
 */
class SentryDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SENTRY_CLIENT_BUILDER = 'SENTRY_CLIENT_BUILDER';

    /**
     * @var string
     */
    public const SENTRY_HUB = 'SENTRY_HUB';

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideServiceDependencies(Container $container): Container
    {
        $container = $this->addSentryClientBuilder($container);
        $container = $this->addSentryHub($container);

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    private function addSentryClientBuilder(Container $container): Container
    {
        $container->set(self::SENTRY_CLIENT_BUILDER, function () {
            $options = [
                'environment' => $this->getConfig()->getApplicationEnvironment(),
                'dsn' => $this->getConfig()->getDataSourceName(),
                'release' => $this->getConfig()->getReleaseVersion(),
                'traces_sample_rate' => $this->getConfig()->getTraceSampleRate(),
                'capture_silenced_errors' => $this->getConfig()->getCaptureSilencedErrors(),
                'error_types' => $this->getConfig()->getErrorTypes(),
                'http_timeout' => $this->getConfig()->getHttpTimeout(),
                'http_connect_timeout' => $this->getConfig()->getHttpConnectTimeout(),
            ];

            $clientBuilder = ClientBuilder::create($options);
            $clientBuilder->setSdkIdentifier(SentryVersion::SDK_IDENTIFIER);
            $clientBuilder->setSdkVersion(SentryVersion::SDK_VERSION);

            return $clientBuilder;
        });

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    private function addSentryHub(Container $container): Container
    {
        $container->set(self::SENTRY_HUB, function (Container $container) {
            /** @var \Sentry\ClientBuilderInterface $clientBuilder */
            $clientBuilder = $container->get(self::SENTRY_CLIENT_BUILDER);

            $hub = new Hub($clientBuilder->getClient());

            SentrySdk::setCurrentHub($hub);

            return $hub;
        });

        return $container;
    }
}
