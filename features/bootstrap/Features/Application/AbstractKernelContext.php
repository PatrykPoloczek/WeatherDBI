<?php

declare(strict_types=1);

namespace Features\Application;

use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractKernelContext implements KernelAwareContext
{
    use KernelDictionary;

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
