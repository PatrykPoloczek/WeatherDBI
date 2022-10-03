<?php

declare(strict_types=1);

namespace Features\Application\Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

abstract class AbstractBasePage extends Page
{
    /**
     * @var bool
     */
    protected $followRedirection = true;

    /**
     * @var bool
     */
    protected $checkResponse = true;

    /**
     * @var string
     */
    protected $path = '{path}';

    protected function verifyUrl(array $urlParameters = []): void
    {
        if (!$this->followRedirection) {
            parent::verifyUrl($urlParameters);
        }
    }

    protected function verifyResponse(): void
    {
        if ($this->checkResponse) {
            parent::verifyResponse();
        }
    }

    public function openPage(string $path = null): AbstractBasePage
    {
        $this->open(['path' => (string) $path]);

        return $this;
    }

    public function isOpened(): bool
    {
        return $this->getDriver()->getCurrentUrl() === $this->getUrl();
    }
}
