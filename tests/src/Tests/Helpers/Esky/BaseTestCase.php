<?php

declare(strict_types=1);

namespace Tests\Helpers\Esky;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class BaseTestCase extends WebTestCase
{
    /**
     * @var Client
     */
    protected static $client;

    protected function setUpBeforeClient()
    {

    }

    protected function setUpAfterClient()
    {

    }

    protected function setUp(): void
    {
        $this->setUpBeforeClient();

        static::$client = static::createClient();

        $this->setUpAfterClient();
    }

    protected function tearDown(): void
    {
        static::ensureKernelShutdown();
    }

    protected function getContainer(): ContainerInterface
    {
        return static::$kernel->getContainer();
    }

    /**
     * @return object
     */
    protected function get(string $id, int $invalidBehavior = ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE)
    {
        return $this->getContainer()->get($id, $invalidBehavior);
    }

    /**
     * @return mixed
     */
    protected function getParameter(string $name)
    {
        return $this->getContainer()->getParameter($name);
    }
}
