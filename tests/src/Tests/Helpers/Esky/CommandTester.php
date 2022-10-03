<?php

declare(strict_types=1);

namespace Tests\Helpers\Esky;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Tester\TesterTrait;

class CommandTester
{
    use TesterTrait;

    private Command $command;

    private ArrayInput $input;

    private int $statusCode;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    public function init(array $input, array $options = []): self
    {
        if (!isset($input['command'])
            && (null !== $application = $this->command->getApplication())
            && $application->getDefinition()->hasArgument('command')
        ) {
            $input = array_merge(['command' => $this->command->getName()], $input);
        }

        $this->input = new ArrayInput($input);
        $this->input->setStream(self::createStream($this->inputs));

        if (isset($options['interactive'])) {
            $this->input->setInteractive($options['interactive']);
        }

        if (!isset($options['decorated'])) {
            $options['decorated'] = false;
        }

        $this->initOutput($options);

        return $this;
    }

    public function execute(): int
    {
        return $this->statusCode = $this->command->run($this->input, $this->output);
    }

    public function run(array $input, array $options = []): int
    {
        $this->init($input, $options);

        return $this->execute();
    }
}
