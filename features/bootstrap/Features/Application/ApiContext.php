<?php

declare(strict_types=1);

namespace Features\Application;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

class ApiContext extends HttpContext
{
    use DataMatcherTrait;

    /**
     * @Given There is set request header :name to :value
     */
    public function thereIsSetRequestHeaderTo(string $name, string $value): void
    {
        $this->setHeader($name, $value);
    }

    /**
     * @Given There are set request headers
     */
    public function thereIsSetHeadersForRequest(PyStringNode $string): void
    {
        $headers = json_decode($string->getRaw(), true);

        foreach ($headers as $name => $value) {
            $this->setHeader($name, $value);
        }
    }

    /**
     * @When I send a :method request on :url
     * @When I send a :method request to :url
     */
    public function iSendARequestOn(string $method, string $url): void
    {
        $this->sendRequest($method, $this->locatePath($url));
    }

    /**
     * @When I send a :method request to :url with json:
     */
    public function iSendARequestToWithJson(string $method, string $url, PyStringNode $string): void
    {
        $this->sendAjaxRequest($method, $url, [], trim((string)$string));
    }

    /**
     * @When I send a :method request to :url with data:
     */
    public function iSendARequestToWithData(string $method, string $url, TableNode $table)
    {
        $this->sendFollowRequest($method, $url, $table->getRowsHash());
    }

    /**
     * @Then should contain header :name with value :value
     * @Then the response should contain header :name with value :value
     */
    public function theResponseShouldContainsHeaderWithValue(string $name, string $value): void
    {
        $this->assertSession()->responseHeaderContains($name, $value);
    }

    /**
     * @Then should contain headers:
     * @Then the response should contain headers:
     */
    public function theResponseShouldContainsHeaders(PyStringNode $string): void
    {
        $headers = json_decode($string->getRaw(), true);

        foreach ($headers as $name => $value) {
            $this->theResponseShouldContainsHeaderWithValue($name, $value);
        }
    }

    /**
     * @Then should be a :status with json:
     * @Then the response should be a :status with json:
     */
    public function theResponseShouldBeAWithJson(int $status, PyStringNode $content): void
    {
        $this->theResponseStatusCodeShouldBe($status);
        $this->jsonResponseShouldMatch($content);
    }

    /**
     * @Then the response status code should be :code
     */
    public function theResponseStatusCodeShouldBe(int $code): void
    {
        $this->assertSession()->statusCodeEquals($code);
    }

    /**
     * @Then json response should match:
     * @Then should contain json:
     * @Then the response should contain json:
     */
    public function theResponseShouldContainJson(PyStringNode $expectedJson): void
    {
        $this->match((string) $expectedJson, $this->getContent());
    }

    /**
     * @Then should contain :fileName json
     * @Then the response should contain :fileName json
     */
    public function theResponseShouldContainJsonWithData(string $fileName)
    {
        $file = sprintf('%s/%s.json', FIXTURES_DIR, str_replace(' ', '-', $fileName));
        $expectedJson = file_get_contents($file);

        $this->match($this->getContent(), (string) $expectedJson);
    }

    /**
     * @Then I should be on url :url
     */
    public function iShouldBeOnUrl(string $url): void
    {
        $this->match($url, $this->getSession()->getCurrentUrl());
    }
}
