<?php

declare(strict_types=1);

namespace Features\Application;

use Behat\Gherkin\Node\PyStringNode;
use PHPUnit\Framework\Assert;
use Symfony\Bridge\Monolog\Handler\ConsoleHandler;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\OutputInterface;
use Tests\Helpers\Esky\CommandTester;

abstract class AbstractCommandContext extends AbstractKernelContext
{
    use DataMatcherTrait;

    protected CommandTester $commandTester;

    protected function executeCommand(string $name, array $input = []): CommandTester
    {
        $this->commandTester = $this->createCommandTester($name);

        $this->commandTester->init($input, [
            'verbosity' => OutputInterface::VERBOSITY_DEBUG
        ]);

        $output = $this->commandTester->getOutput();
        $this->get(ConsoleHandler::class)->setOutput($output);

        $this->commandTester->execute();

        return $this->commandTester;
    }

    protected function createCommandTester(string $name): CommandTester
    {
        $application = new Application($this->getKernel());
        $command = $application->find($name);

        return new CommandTester($command);
    }

    protected function getJsonInput(PyStringNode $input = null): array
    {
        if (!is_null($input)) {
            return json_decode($input->getRaw(), true);
        }

        return [];
    }

    protected function assertContainsOutput(string $excepted, string $result): void
    {
        $excepted = explode(PHP_EOL, trim($excepted));
        $result = trim($result);

        foreach ($excepted as $row) {
            Assert::assertStringContainsString(trim($row), $result);
        }
    }
}
