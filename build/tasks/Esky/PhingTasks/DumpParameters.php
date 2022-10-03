<?php

namespace Esky\PhingTasks;

class DumpParameters extends \Task
{
    /**
     * @var Parameter[]
     */
    private $parameters = [];

    /**
     * @var string
     */
    private $file;

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    public function addParameter(Parameter $parameter)
    {
        $this->parameters[] = $parameter;
    }

    public function main()
    {
        $body = "parameters:\n";

        foreach ($this->parameters as $parameter) {
            $body .= sprintf("    %s: %s\n", $parameter->getName(), $parameter->getValue());
        }

        if (file_exists($this->file)) {
            $this->log(sprintf('File %s exists, it will be overriden!', $this->file), \Project::MSG_WARN);
        }

        file_put_contents($this->file, $body);

        $this->log('Parameters dumped to file: ' . $this->file);
    }
}
