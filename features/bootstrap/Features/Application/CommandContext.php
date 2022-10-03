<?php

declare(strict_types=1);

namespace Features\Application;

use Behat\Gherkin\Node\PyStringNode;

class CommandContext extends AbstractCommandContext
{
    /**
     * @When I execute command :name
     * @When I execute command :name with input
     */
    public function iExecuteCommandWithInput(string $name, PyStringNode $input = null)
    {
        $this->executeCommand($name, $this->getJsonInput($input));
    }

    /**
     * @Then on the output should display
     */
    public function onTheOutputShouldDisplay(PyStringNode $output)
    {
        $this->matchTextLine($output->getRaw(), $this->commandTester->getDisplay());
    }

    /**
     * @Then on the output should contain
     */
    public function onTheOutputShouldContain(PyStringNode $output)
    {
        $this->assertContainsOutput($output->getRaw(), $this->commandTester->getDisplay());
    }
}
