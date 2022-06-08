<?php

namespace TurbineTest\Service\Sentry;

use Codeception\Test\Unit;
use Exception;
use Sentry\EventId;
use Sentry\State\HubInterface;
use Sentry\Tracing\Transaction;
use Sentry\Tracing\TransactionContext;
use ValanticSpryker\Service\Sentry\SentryDependencyProvider;
use ValanticSpryker\Service\Sentry\SentryServiceInterface;
use ValanticSpryker\Shared\Sentry\SentryConstants;

/**
 * Auto-generated group annotations
 *
 * @group ValanticSprykerTest
 * @group Client
 * @group Sentry
 * Add your own group annotations below this line
 * @property \ValanticSprykerTest\Service\Sentry\SentryServiceTester $tester
 */
class SentryServiceTest extends Unit
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->tester->setupProjectConfigs();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\Sentry\State\HubInterface
     */
    private function createHubMock(): HubInterface
    {
        $hubMock = $this->createMock(HubInterface::class);

        $this->tester->setDependency(
            SentryDependencyProvider::SENTRY_HUB,
            $hubMock
        );

        return $hubMock;
    }

    /**
     * @return void
     */
    public function testCaptureExceptionReportsToSentry(): void
    {
        $mock = $this->createHubMock();
        $exception = new Exception('example exception');

        $mock
            ->expects($this->once())
            ->method('captureException')
            ->with($exception)
            ->willReturn(new EventId('3eaf8ee807450b5aea065aec50b95451'));

        $this->getService()->captureException($exception);
    }

    /**
     * @return void
     */
    public function testCaptureUnreportableExceptionReportsToSentry(): void
    {
        $mock = $this->createHubMock();
        $exception = new Exception('example exception');

        $mock
            ->expects($this->exactly(2))
            ->method('captureException')
            ->willReturn(null);

        $this->getService()->captureException($exception);
    }

    /**
     * @return void
     */
    public function testCaptureIgnoredExceptionDoesntReportToSentry(): void
    {
        $mock = $this->createHubMock();
        $exception = new Exception('example exception');
        $this->tester->setConfig(
            SentryConstants::IGNORED_EXCEPTIONS,
            [ Exception::class]
        );

        $mock
            ->expects($this->never())
            ->method('captureException');

        $this->getService()->captureException($exception);
    }

    /**
     * @return void
     */
    public function testCanStartTransaction(): void
    {
        $context = new TransactionContext();
        $mock = $this->createHubMock();

        $mock
            ->expects($this->once())
            ->method('startTransaction')
            ->willReturn(new Transaction($context));

        $this->getService()->startTransaction($context);
    }

    /**
     * @return void
     */
    public function testCanSetATag(): void
    {
        $mock = $this->createHubMock();

        $mock
            ->expects($this->once())
            ->method('configureScope');

        $this->getService()->setTag('test', 'hello');
    }

    /**
     * @return \ValanticSpryker\Service\Sentry\SentryServiceInterface
     */
    private function getService(): SentryServiceInterface
    {
        return $this->tester->getLocator()->sentry()->service();
    }
}
