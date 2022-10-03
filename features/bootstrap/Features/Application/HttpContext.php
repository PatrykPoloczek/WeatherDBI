<?php

declare(strict_types=1);

namespace Features\Application;

use Behat\Mink\Driver\DriverInterface;
use Behat\MinkExtension\Context\RawMinkContext;
use Symfony\Component\BrowserKit\AbstractBrowser;

class HttpContext extends RawMinkContext
{
    use DataMatcherTrait;

    /**
     * @var array
     */
    protected $baseParameters = [];

    /**
     * @var array
     */
    protected $serverParameters = [];

    /**
     * @inheritDoc
     */
    public function getMinkParameter($name)
    {
        if ($this->hasBaseParameter($name)) {
            return $this->getBaseParameter($name);
        }

        return parent::getMinkParameter($name);
    }

    public function hasBaseParameter(string $name): bool
    {
        return array_key_exists($name, $this->baseParameters);
    }

    /**
     * @param mixed $value
     */
    public function setBaseParameter(string $name, $value): void
    {
        $this->baseParameters[$name] = $value;
    }

    /**
     * @return mixed
     */
    public function getBaseParameter(string $name)
    {
        if ($this->hasBaseParameter($name)) {
            return $this->baseParameters[$name];
        }

        return null;
    }

    public function getDriver(): DriverInterface
    {
        return $this->getSession()->getDriver();
    }

    public function getClient(): AbstractBrowser
    {
        return $this->getDriver()->getClient();
    }

    public function sendRequest(
        string $method,
        string $url,
        array $parameters = [],
        string $body = null,
        array $files = [],
        array $server = [],
        bool $follow = false
    ): void {
        $client = $this->getClient();

        $isFollowingRedirects = $client->isFollowingRedirects();

        $server += $this->serverParameters;

        $client->followRedirects($follow);
        $client->request($method, $this->locatePath($url), $parameters, $files, $server, $body);
        $client->followRedirects($isFollowingRedirects);

        $this->serverParameters = [];
    }

    public function sendFollowRequest(
        string $method,
        string $url,
        array $parameters = [],
        string $body = null,
        array $files = [],
        array $server = []
    ): void {
        $this->sendRequest($method, $url, $parameters, $body, $files, $server, true);
    }

    public function sendAjaxRequest(
        string $method,
        string $url,
        array $parameters = [],
        string $body = null,
        array $files = [],
        array $server = []
    ): void {
        $this->setHeader('X-Requested-With', 'XMLHttpRequest');

        $this->sendJsonRequest($method, $url, $parameters, $body, $files, $server);
    }

    public function sendJsonRequest(
        string $method,
        string $url,
        array $parameters = [],
        string $body = null,
        array $files = [],
        array $server = [],
        bool $follow = false
    ): void {
        $this->setHeader('CONTENT_TYPE', 'application/json', false);

        $this->sendRequest($method, $url, $parameters, $body, $files, $server, $follow);
    }

    public function getResponseHeaders(): array
    {
        return $this->getSession()->getResponseHeaders();
    }

    public function getResponseHeader(string $name): ?string
    {
        $header = null;
        $headers = $this->getResponseHeaders();

        if (isset($headers[$name])) {
            $header = $headers[$name];
        }

        $name = strtolower($name);

        if (isset($headers[$name])) {
            $header = $headers[$name];
        }

        if (is_array($header)) {
            $header = current($header);
        }

        return $header;
    }

    public function setHeader(string $name, string $value, bool $http = true): void
    {
        $this->serverParameters += [($http ? 'HTTP_' : '') . $name => $value];
    }

    public function setCookie(string $name, string $value): void
    {
        $this->getSession()->setCookie($name, $value);
    }

    public function getContent(): string
    {
        return $this->getSession()->getPage()->getContent();
    }
}
